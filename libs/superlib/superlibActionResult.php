<?php

namespace superLib
{
	include_once "superlibModel.php";
	class ActionResult
	{
		/* @var \superLib\Model $model */
		private $model;
		private $customView;
		private $code;

		protected $newController;
		protected $newAction;

		function __construct($_code = null, Model $_model = null, $_customView = null)
		{
			$this->code = $_code;
			$this->model = $_model;
			$this->customView = $_customView;
		}

		/**
		 * @return string
		 */
		public function getCustomView()
		{
			return $this->customView;
		}

		/**
		 * @param int $code
		 */
		public function setCode($code)
		{
			$this->code = $code;
		}
		/**
		 * @param Model $model
		 */
		public function setModel($model)
		{
			$this->model = $model;
		}

		function getModel()
		{
			return $this->model;
		}

		function getCode()
		{
			return $this->code;
		}

		function setCustomView($_customView)
		{
			$this->customView = $_customView;
		}
	}

	class Redirect extends ActionResult
	{
		function __construct($_controller, $_action = null, ActionResult $actionResult)
		{
			parent::__construct();

			if($_action==null) $_action = "index";
			$this->newController = $_controller;
			$this->newAction = $_action;
		}
	}
}
