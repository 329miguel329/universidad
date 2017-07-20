<?php
	class CRUD
	{
		protected $conn;
		public $results;
		public function __construct($host, $user, $pass, $database)
		{
			$this -> conn = new mysqli($host, $user, $pass, $database);
			$this -> conn -> query("SET NAMES 'utf8'");
		}
		
		public function Select($sql)
		{
			$query = $this -> conn -> query($sql);
			if ($query)
			{
				$this->results = array();
				while($datos = $query -> fetch_assoc())
				{
					array_push($this -> results, $datos);
				}
				$num = $query -> num_rows;
				$query->free();
				return array("num_results" => $num, "results" => $this -> results);
			}
			else
			{
				return array("error" => $this -> conn -> error);
			}
		}
		
		public function Insert($sql)
		{
			$query = $this -> conn -> query($sql);
			if ($query)
			{
				return array("afected_rows" => $this -> conn -> affected_rows, "insert_id" => $this -> conn -> insert_id);
			}
			else
			{
				return array("error" => $this -> conn -> error);
			}
		}
		
		public function UpdateDelete($sql)
		{
			$query = $this -> conn -> query($sql);
			if ($query)
			{
				return array("afected_rows" => $this -> conn -> affected_rows);
			}
			else
			{
				return array("error" => $this -> conn -> error);
			}
		}
		
		public function __destruct()
		{
			$this -> conn -> close();
		}
	}
?>