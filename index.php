<?php
	session_start();
	require_once("Api.php");
	$api = new Api();

	$id = $_SESSION['user_session'];

	$stmt = $api->runQuery("SELECT * FROM user WHERE id=:id");
	$stmt->execute(array(":id"=>$id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>GoBLog</title>
	<link rel="icon" type="image/png" href="assets/img/goblog.png">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="core/css/index.css">
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

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="about.php">About</a>
				<?php if(isset($_SESSION['user_session'])): ?>
				<li><a href="home.php">Hai, <?php echo $userRow['nama'] ?></a></li>
				<li><a href="logout.php?logout=true">Logout</a></li>
				<?php else : ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="registrasi.php">Daftar</a></li>
			<?php endif ; ?>
			</ul>
		</div>
	</div>
</nav>

<section class="site-head-full"> 
	<img src="assets/img/fix1.jpg" width="100%" height="350px" style="position: absolute; margin-top: 1em; background-color: transparent;">
	<div class="container">
	<div class="row">
		<div class="col-md-6" style="top: 100px; position: absolute; width: 550px;">
			<header class="primary">
				<h1>GoBLog</h1>
				<p>Sudah waktunya untuk mendapatkan lebih banyak dari apa yang anda baca. Temukan dan berbagi perspektif nyata tentang topik yang penting hari ini.</p>	
			</header>
			<br />
			<?php if(isset($_SESSION['user_session'])): ?>
			<h1>Selamat Datang</h1>
			<?php else : ?>
			<div class="btn-group">
				<button class="btn btn-default btn-lg"><a href="login.php">Login</a></button>
				<button class="btn btn-default btn-lg btn-pink"><a href="registrasi.php">Daftar</a></button>
			</div>
			<?php endif ; ?>
		</div>
	</div>
	</div>
</section>
<section id="pinggiran">
	<ul class="ekstra">
		
	</ul>
</section>
</body>
</html>