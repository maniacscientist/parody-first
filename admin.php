<?php

include_once "libs/superlib/superlib.php";
include_once "libs/superlib/superlibAppEngine.php";

$app = new \superLib\appEngine(null, null, null, null);
$app->doAction("admin", "index", true);