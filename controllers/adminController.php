<?php

include_once __DIR__."/../libs/superlib/superlibController.php";
include_once __DIR__."/../libs/superlib/superlibDB.php";
include_once __DIR__."/../libs/superlib/superlibActionResult.php";

include_once __DIR__."/../models/loginModel.php";
include_once __DIR__."/../models/userModel.php";
include_once __DIR__."/../models/dbinfoModel.php";

class adminController extends superLib\Controller
{
	/**
	 * @param \superLib\Model $model
	 * @return \superLib\ActionResult
	 */
	function index(\superLib\Model $model = null)
	{
		$actionResult = new \superLib\ActionResult();
		$actionResult->setCustomView("index");

		if(!file_exists(\superLib\DB::getConnectionInfoFile()))
		{
			$actionResult->setCustomView("createConnectionInfo");
		}
		else
		{
			$model = $this->getDbObject()->executeSQLFillExactViewModelArray("select * from users", "userModel");

			$actionResult->setModel($model);
		}

		return $actionResult;
	}

	/**
	 * @param dbinfoModel $model
	 * @return \superLib\ActionResult
	 */
	function finishDBCreation(dbinfoModel $model = null)
	{
		if(\superLib\DB::testConnection($model->server, $model->user, $model->password, $model->dbname))
		{
			$file = fopen(\superLib\DB::getConnectionInfoFile(), "w+");

			fputs($file, "$model->server\n");
			fputs($file, "$model->user\n");
			fputs($file, "$model->password\n");
			fputs($file, "$model->dbname\n");

			fclose($file);

			$query = "
				CREATE TABLE IF NOT EXISTS users
				(
				    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				    name VARCHAR(128) NOT NULL,
				    email VARCHAR(192) NOT NULL,
				    password VARCHAR(256) NOT NULL,
				    sid VARCHAR(256) NOT NULL
				);
			";
			$this->getDbObject()->executeSQL($query);

			$query = "
				CREATE TABLE attributes
				(
				    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				    name VARCHAR(256) NOT NULL
				);
			";
			$this->getDbObject()->executeSQL($query);

			$query = "
				CREATE TABLE `users-attributes`
				(
				    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				    user_id INT NOT NULL,
				    attribute_id INT NOT NULL,
				    value VARCHAR(256) NOT NULL,
				    FOREIGN KEY (user_id) REFERENCES users (id),
				    FOREIGN KEY (attribute_id) REFERENCES attributes (id)
				);
			";
			$this->getDbObject()->executeSQL($query);

			return $this->index();
		}
		else
		{
			return $this->index();
		}
	}

	/**
	 * @return bool
	 */
	function isPersistent()
	{
		return false;
	}
}