<?php

namespace superLib;

include_once "superlib.php";
include_once "superlibAppEngine.php";
include_once "superlibModel.php";

$action = grab_get("a", null);

if($action!=null)
{
	$tokens = explode("/", $action);

	$controller = $tokens[0];
	$method = $tokens[1];

	$app = appEngine::getInstance();
	$app->doAction($controller, $method, false, false);
}