<?php
namespace superLib
{
	include_once "superlibActionResult.php";
	include_once "superlibModel.php";

	class outputStruct
	{
		var $code;
		var $html;
		function __construct($_code, $_html)
		{
			$this->code = $_code;
			$this->html = $_html;
		}
	}

	class appEngine
	{
		private $include_path_models;
		private $include_pattern_views;
		private $include_pattern_controllers;
		private $class_pattern;
		private $lameRoot;
		private $stash = [];

		/**
		 * @param $_include_path_models
		 * @param $_include_pattern_views
		 * @param $_include_pattern_controllers
		 * @param $_class_pattern
		 */
		function __construct($_include_path_models,
		                     $_include_pattern_views,
		                     $_include_pattern_controllers,
		                     $_class_pattern)
		{
			$this->lameRoot = getcwd();

			$this->include_path_models = "$this->lameRoot/models/";
			$this->include_pattern_controllers = "$this->lameRoot/controllers/%s.php";
			$this->include_pattern_views = "$this->lameRoot/views/%s/%s.php";
			$this->class_pattern = "%sController";

			if($_include_path_models!=null) $this->include_path_models = $_include_path_models;
			if($_include_pattern_views!=null) $this->include_pattern_views = $_include_pattern_views;
			if($_include_pattern_controllers!=null) $this->include_pattern_controllers = $_include_pattern_controllers;
			if($_class_pattern!=null) $this->class_pattern = $_class_pattern;

			$this->saveMe();
		}

		function saveMe()
		{
			sessionStart();
			$_SESSION[APP_OBJ] = serialize($this);
		}
		static function getInstance()
		{
			sessionStart();
			$appRaw = grab($_SESSION[APP_OBJ], null);

			if($appRaw==null)
			{
				$app = new appEngine(null, null, null, null);
				return $app;
			}
			else
			{
				//as engine data is stored within appEngine object, object must be unserialized twice - first time
				//just to get paths to models, then to get real objects instead of __PHP_Uncomplete_Class
				$app = unserialize($appRaw);
				$app->reacquireModels();
				$app = unserialize($appRaw);
				return $app;
			}
		}

		function includeController($class_name)
		{
			include_once sprintf($this->include_pattern_controllers, $class_name);
		}
		/**
		 * @param string $controller
		 * @param string $action
		 * @return string
		 */
		function processView($controller, $action)
		{
			$file = sprintf($this->include_pattern_views, $controller, $action);

			ob_start();
			require_once($file);
			$contents = ob_get_contents();
			ob_end_clean();

			return $contents;
		}
		function reacquireModels()
		{
			$files = glob($this->include_path_models."*.*");
			foreach($files as $file)
			{
				include_once $file;
			}
		}

		function navigate($controller = null, $action = null)
		{
			if($controller==null)
			{
				$controller = grab_get("page", "home");
			}
			if($action==null)
			{
				$action = "index";
			}
			$this->doAction($controller, $action, true, true);
		}

		/**
		 * @param $controller
		 * @param $action
		 * @param bool $useLayout
		 * @param bool $html_only
		 */
		function doAction($controller, $action, $useLayout = false, $html_only = true)
		{
			$controllerClass = sprintf($this->class_pattern, $controller);

			$this->includeController($controllerClass);

			/** @var Controller $controllerObject */
			$controllerObject = new $controllerClass($this);

			$reflector = new \ReflectionClass($controllerClass);
			$modelClassName = $reflector->getMethod($action)->getParameters()[0]->getClass()->getName();
			/* @var Model $params */
			$params = new $modelClassName();
			$params->furlResult($_POST);
			$params->furlResult($_GET);

			/* @var \superLib\ActionResult $actionResult */
			$actionResult = $controllerObject->$action($params);

			global $superModel;
			global $superCode;
			$superModel = $actionResult->getModel();
			$superCode = $actionResult->getCode();

			global $superPage;
			$superPage = $this->processView($controller, $action);
			if($useLayout)
			{
				$html = $this->processView("_layout", "index");
			}
			else
			{
				$html = $superPage;
			}

			if($html_only)
				echo $html;
			else
				echo json_encode(new outputStruct($superCode, $html));

			$this->saveMe();
		}

		function storeInStash($key, $obj)
		{
			$this->stash[$key] = $obj;
		}
		function getFromStash($key)
		{
			return $this->stash[$key];
		}

	}
}