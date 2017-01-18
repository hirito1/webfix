<?php
	session_start();
	require_once('Api.php');
	$login = new Api();

	if($login->is_loggedin()!=""){
		$login->redirect('home.php');
	}

	if(isset($_POST['login'])){
		$nama = strip_tags($_POST['nama']);
		$email = strip_tags($_POST['nama']);
		$pass = strip_tags($_POST['pass']);

		if($login->Login($nama,$email,$pass)){
			$login->redirect('home.php');
		}else{
			$error = "Wrong Details!!!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login || GoBlog</title>
	<link rel="icon" type="image/png" href="assets/img/goblog.png">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="core/css/style.css" type="text/css"  />
	<script type="text/javascript" src="core/js/core.js"></script>
	<script type="text/javascript" src="core/js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="core/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="./" class="navbar-brand">
				<img src="assets/img/goblog.png" alt="GoBlog" width="30spx" height="30px">
			</a>
		</div>
	</div>
</nav>

	<div class="signin-form">
		<div class="container">
			<form class="form-signin" id="login-form" method="post">
				<h2 class="form-signin-heading">Masuk ke GoBlog</h2><hr />
				<div id="error">
					<?php if(isset($error)) { ?>
					<div class="alert alert-danger">
						<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error ?> !
					</div>
					<?php } ?>
				</div>
				<div class="form-group">
					<input type="text" name="nama" placeholder="Masukkan Email anda" required /> 
					<span id="check-e"></span>
				</div>

				<div class="form-group">
					<input type="password" name="pass" placeholder="Masukkan Password anda" required />
				</div>
				<hr />
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-success">
						<i class="glyphicon glyphicon-log-in"></i> &nbsp; Masuk
					</button>
				</div>
				<br />
				<label>Belum punya akun ! <a href="registrasi.php" style="color: 	#35df38">Daftar</a></label>
			</form>
		</div>
	</div>
</body>
</html>