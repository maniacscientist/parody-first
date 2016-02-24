<?php

namespace superLib
{
	include_once "superlibDB.php";

	abstract class Controller
	{
		private $app;
		private $dbObject;

		function __construct($appHandle)
		{
			$this->app = $appHandle;
		}

		/**
		 * @return appEngine
		 */
		function getAppHandle()
		{
			return $this->app;
		}

		/**
		 * @return bool
		 */
		abstract function isPersistent();

		/**
		 * @return DB
		 */
		protected function getDbObject()
		{
			if(!isset($this->dbObject))
			{
				$this->dbObject = new DB();
			}

			return $this->dbObject;
		}
	}
}