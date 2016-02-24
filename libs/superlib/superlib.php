<?php
namespace superLib {

	use Exception;
	use ReflectionClass;

	include_once "superlibDB.php";

	const LAST_OBJ = "last_obj";
	const APP_OBJ = "app_obj";

	function grab(&$var, $default)
	{
		if(isset($var))
		{
			return $var;
		}
		else
		{
			return $default;
		}
	}

	function grab_get($var, $default)
	{
		if(isset($_GET[$var]))
		{
			return $_GET[$var];
		}
		else
		{
			return $default;
		}
	}

	function sessionStart()
	{
		if(session_id() == '') {
			session_start();
		}
	}

	function die_for_good($error, $context = null)
	{
		die("<h2 style='background-color: red; color:yellow; z-index: 9000;'>Not good: $error </h2>" .
			($context == null ? "" : "<h2 style='background-color: red; color:yellow; z-index: 9000;'>This product suxx: $context </h2>"));
	}

	abstract class SickEnum
	{
		final public function __construct($value)
		{
			$c = new ReflectionClass($this);
			if(!in_array($value, $c->getConstants())) {
				throw new Exception();
			}
			$this->value = $value;
		}

		final public function __toString()
		{
			return $this->value;
		}
	}
}

