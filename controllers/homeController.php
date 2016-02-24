<?php

include_once __DIR__."/../libs/superlib/superlibController.php";
include_once __DIR__."/../libs/superlib/superlibActionResult.php";

include_once __DIR__."/../models/loginModel.php";
include_once __DIR__."/../models/userModel.php";
include_once __DIR__."/../models/keyValuePair.php";

class homeController extends \superLib\Controller
{
	/**
	 * @param \superLib\Model $model
	 * @return \superLib\ActionResult
	 */
	function index(\superLib\Model $model)
	{
		return new \superLib\ActionResult();
	}

	function generateRandomString($length = 30) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	 * @param loginModel $model
	 * @return \superLib\ActionResult
	 */
	function login(loginModel $model)
	{
		$actionResult = new \superLib\ActionResult();

		$row = $this->getDbObject()->executeSQLGetRow("select * from users
			WHERE email='$model->email' and password='$model->password' ");

		if($row!=null)
		{
			$user = new userModel();
			$user->furlResult($row);

			$actionResult->setCode(0);
			$sid = $_COOKIE['PHPSESSID'];
			$this->getDbObject()->executeSQL("update users set sid=\"$sid\" where id = $user->id");


			$getAttributesProc = "SELECT attributes.name, `users-attributes`.value
			FROM `users-attributes`
 			LEFT JOIN attributes on `users-attributes`.attribute_id = attributes.id
			WHERE `users-attributes`.user_id = $user->id;";

			$user->attributes = $this->getDbObject()->executeSQLFillExactViewModelArray($getAttributesProc, "keyValuePair");

			$this->getAppHandle()->storeInStash("user", $user);
		}
		else
		{
			$actionResult->setCode(1);
		}

		return $actionResult;
	}

	/**
	 * @param userModel $model
	 * @return \superLib\ActionResult
	 */
	function signup(userModel $model)
	{
		$actionResult = new \superLib\ActionResult();

		$actionResult->setModel($model);

		if(!filter_var($model->email, FILTER_VALIDATE_EMAIL))
		{
			$actionResult->setCode(1);
		}
		else
		{
			$actionResult->setCode(0);

			$this->getDbObject()->executeSQL("insert into users (name, email, password)
				values (\"$model->name\", \"$model->email\", \"$model->password\")");
		}

		return $actionResult;
	}

	function isPersistent()
	{
		return false;
	}
}