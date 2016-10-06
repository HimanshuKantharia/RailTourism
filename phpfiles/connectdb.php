<?php
class connect{
	public $connection;
	public $host;
	public $userName;
	public $password;
	public $db;


		public function __construct()
		{
			$this->host = "localhost";
			$this->userName = "root";
			$this->password = "";
			$this->db = "railways";
		}

		//fuction for opern connection b/w php & sql

		public function openConnection()
		{
			$this->connection = mysqli_connect($this->host,$this->userName,$this->password);
			$createDB = "create database if not exists " .$this->db;   // in sql query every space(_) is important
 			$this->connection->query($createDB);
			mysqli_select_db($this->connection,$this->db);
		} 
		//function for close connection

		public function closeConnection()
		{
			if(isset($this->connection))
				$this->connection->close();
		}

		// function for execute query

		public function exeQuery($Query){
			$this->openConnection();
			$result = $this->connection->query($Query);
			$this->closeConnection();
			return $result;
		}

}
?>