<?php
	class database {

		private $host = "localhost";
		private $dbname = "webfix";
		private $user = "root";
		private $password = "";
		public $con;

		public function dbConnection(){
			$this->con = null;
			try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
			return $this->conn;
		}
	}
?>