<?php
	require_once("Api.php");
	$api = new Api();

	if($api->is_loggedin()!=""){
		$api->redirect('home.php');
	}

	if(isset($_POST['registrasi'])){
		$nama = strip_tags($_POST['nama']);
		$email = strip_tags($_POST['email']);
		$pass = strip_tags($_POST['pass']);

		if($email==""){
			$error[] = "Masukkan email !";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error[] = "Masukkan email dengan benar!";}
		else if($pass==""){
			$error[] = "Masukkan password";
		}
		else if(strlen($pass) < 8){
			$error[] = "Password minimal 8 karakter!";
		}
		else{
			try{
				$stmt = $api->runQuery("SELECT nama, email FROM user WHERE nama=:nama OR email=:email");
				$stmt->execute(array(':nama'=>$nama, ':email'=>$email));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if($row['email']==$email){
					$error[]="Maaf, email telah digunakan!";
				}else{
					if($api->register($nama,$email,$pass)){
						$api->redirect('registrasi.php?joined');
					}
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrasi || GoBlog</title>
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="core/css/style.css" type="text/css"  />
</head>
<body>
<div class="signin-form">
	<div class="container">
		<form method="post" class="form-signin">
			<h2 class="form-signin-heading">Daftar Akun GoBlog</h2><hr />
			<?php if(isset($error)){ 
				foreach($error as $error){
					?>
					<div class="alert alert-danger">
						<i class="glyphicon glyphicon-warning-signin"></i> &nbsp; <?php echo $error; ?>
					</div>
					<?php
				}
			}
			else if(isset($_GET['joined'])){
				?>
				<div class="alert alert-info">
					<i class="glyphicon glyphicon-log-in"></i> &nbsp; Berhasil mendaftar <a href="home.php">Login</a> di sini
				</div>
				<?php
			}
			?>
			<div class="form-group">
				<input type="text" name="nama" placeholder="Masukkan nama anda" class="form-control">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" placeholder="Masukkan email anda" required />
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="pass" placeholder="Masukkan password anda" required />
			</div>
			<div class="clearfix"></div><hr />
			<div class="form-group">
				<button type="submit" class="btn btn-success" name="registrasi">
					<i class="glyphicon glyphicon-open-file"></i>&nbsp;Daftar
				</button>
			</div>
			<br />
			<label>Sudah punya akun ! <a href="login.php" style="color: #35df38">Log in</a></label>
		</form>
	</div>
</div>
</body>
</html>