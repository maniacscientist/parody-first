<?php
namespace superLib
{
	class DB
	{
		private $db_handle;
		private $last_result;

		function __construct()
		{
			if(!isset($this->db_handle))
			{
				$this->connect();
			}
		}

		static function getConnectionInfoFile()
		{
			return __DIR__ . "/../../data/connection.dat";
		}

		static function testConnection($host, $user, $password, $database)
		{
			$link = mysqli_connect($host, $user, $password, $database);

			if(!$link) return false;

			mysqli_close($link);
			return true;
		}

		static function checkConnection()
		{
			return DB::connect();
		}

		private function connect()
		{
			$file = fopen(DB::getConnectionInfoFile(), "r");

			$host = trim(fgets($file));
			$user = trim(fgets($file));
			$password = trim(fgets($file));
			$database = trim(fgets($file));

			$this->db_handle = mysqli_connect($host, $user, $password, $database);

			fclose($file);

			if(!$this->db_handle)
			{
				return false;
			}
			else
			{
				mysqli_query($this->db_handle, "SET NAMES utf8");
				return true;
			}
		}

		function ping()
		{
			error_reporting(E_ERROR);
			if(($this->db_handle==FALSE) || (mysqli_thread_id($this->db_handle)==FALSE))
			{
				$this->connect();
			}
			error_reporting(E_ALL);
		}

		function executeSQL($query)
		{
			$this->ping();

			$this->last_result = mysqli_query($this->db_handle, $query);

			if (!$this->last_result)
			{
				$error = mysqli_error($this->db_handle);
				die_for_good($error, $query);
			}
		}

		function getResultCount()
		{
			return mysqli_num_rows($this->last_result);
		}

		/**
		 * @return array|null
		 */
		function getRows()
		{
			if(function_exists("mysqli_fetch_all"))
			{
				return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
			}
			else
			{
				$data = [];
				while ($row = mysqli_fetch_assoc($this->last_result)) {
					$data[] = $row;
				}

				return $data;
			}
		}

		function executeSQLGetRow($query)
		{
			$this->executeSQL($query);
			return mysqli_fetch_array($this->last_result);
		}

		function executeSQLGetValue($query)
		{
			$row = $this->executeSQLgetRow($query);
			return $row[0];
		}

		/**
		 * @param string $query
		 * @param string $viewModelClass
		 * @return array
		 */
		function executeSQLFillExactViewModelArray($query, $viewModelClass)
		{
			$this->executeSQL($query);
			$rows = $this->getRows();

			$view = [];

			$vars = null;

			foreach($rows as $row)
			{
				$obj = new $viewModelClass();

				if($vars==null) $vars = array_keys(get_object_vars($obj));

				foreach($vars as $property)
				{
					if(array_key_exists($property, $row))
					{
						$obj->$property = $row[$property];
					}
				}

				array_push($view, $obj);
			}

			return $view;
		}

		/**
		 * @param string $query
		 * @return string[]
		 */
		function executeSQLFillSingleStringArray($query)
		{
			$this->executeSQL($query);
			$rows = $this->getRows();

			$view = [];

			foreach($rows as $row)
			{
				array_push($view, array_values($row)[0]);
			}

			return $view;
		}

		/**
		 * @param string $table
		 * @param string $pk
		 * @param int $id
		 */
		function deleteRecord($table, $pk, $id)
		{
			$this->executeSQL("delete from $table where $pk=$id");
		}

		function makeSafe($string)
		{
			$this->ping();

			$string = str_replace("\"", "'", $string);
			$string = mysqli_real_escape_string($this->db_handle, $string);
			return $string;
		}
	}
}

