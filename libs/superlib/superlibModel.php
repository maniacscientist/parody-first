<?php

namespace superLib
{
	class Model
	{
		private $___vars = null;
		/**
		 * @param array $result
		 */
		function furlResult($result)
		{
			if($this->___vars==null) $this->___vars = array_keys(get_object_vars($this));

			foreach($this->___vars as $property)
			{
				if(array_key_exists($property, $result))
				{
					$this->$property = $result[$property];
				}
			}
		}
	}
}

