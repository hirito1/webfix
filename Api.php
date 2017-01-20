<?php
	require_once('koneksi.php');

	class Api{
		private $con;
 
		public function __construct(){
			$database = new database();
			$db = $database->dbConnection();
			$this->con = $db;
		}

		public function runQuery($sql){
			$stmt = $this->con->prepare($sql);
			return $stmt;
		}

		public static function fetchQuery($arg,$stmt){
        if ($arg == 1) return $stmt->fetch(PDO::FETCH_ASSOC);
        else           return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	}

		public function register($nama,$email,$pass){
			try{
				$new_password = password_hash($pass, PASSWORD_DEFAULT);

				$stmt = $this->con->prepare("INSERT INTO user(nama,email,password) VALUES(:nama, :email, :pass)");
				$stmt->bindparam(":nama", $nama);
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":pass", $new_password);

				$stmt->execute();
				return $stmt;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function Login($nama,$email,$pass){
			try{
				$stmt = $this->con->prepare("SELECT id, nama, email, password FROM user WHERE nama=:nama OR email=:email ");
				$stmt->execute(array(':nama'=>$nama, ':email'=>$email));
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
				if($stmt->rowCount() == 1){
					if(password_verify($pass, $userRow['password'])){
						$_SESSION['user_session'] = $userRow['id'];
						return true;
					}else{
						return false;
					}
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function is_loggedin(){
			if(isset($_SESSION['user_session'])){
				return true;
			}
		}

		public function redirect($url){
			header("Location: $url");
		}

		public function Logout(){
			session_destroy();
			unset($_SESSION['user_session']);
			return true;
		}

	}
?>