<?php

include_once __DIR__."/../libs/superlib/superlibController.php";
include_once __DIR__."/../libs/superlib/superlibModel.php";
include_once __DIR__."/../libs/superlib/superlibActionResult.php";

class attributesController extends \superLib\Controller
{
	/**
	 * @param \superLib\Model $model
	 * @return \superLib\ActionResult
	 */
	function index(\superLib\Model $model)
	{
		$actionResult = new \superLib\ActionResult();

		$actionResult->setCode(1);

		if(isset($_COOKIE["PHPSESSID"])) {

			$sid = $_COOKIE["PHPSESSID"];

			$row = $this->getDbObject()->executeSQLGetRow("select * from users
			WHERE sid='$sid' ");
			if ($row != null) {
				$actionResult->setCode(0);
				$actionResult->setModel($this->getAppHandle()->getFromStash("user"));
			}
		}

		return $actionResult;
	}

	/**
	 * @return bool
	 */
	function isPersistent()
	{
		return false;
	}
}