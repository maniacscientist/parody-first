<?php

include_once "keyValuePair.php";

class userModel extends \superLib\Model
{
	var $id;

	var $name;
	var $email;
	var $password;

	/* @var keyValuePair $attributes */
	var $attributes;
}