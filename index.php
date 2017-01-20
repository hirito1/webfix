<?php
	session_start();
	require_once("Api.php");
	$api = new Api();
if(isset($_SESSION['user_session'])){
	$id = $_SESSION['user_session'];

	$stmt = $api->runQuery("SELECT * FROM user WHERE id=:id");
	$stmt->execute(array(":id"=>$id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
	$stmt = $api->runQuery("SELECT * FROM post");

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>GoBLog</title>
	<link rel="icon" type="image/png" href="assets/img/goblog.png">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="core/css/primer.css">
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
	<img src="assets/img/fix1.jpg" width="100%" height="350px" style="position: absolute; margin-top: 3em; background-color: transparent;">
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
<?php if(isset($_SESSION['user_session'])): ?>
<section id="ngepost" >
	<form class="signin-form" method="post" enctype="multipart/form-data" action="prcs.php?act=postingan">
	<h2 style="margin-left: 6em;">Post Baru</h2>
	<div id="error">
					<?php if(isset($error)) { ?>
					<div class="alert alert-danger">
						<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error ?> !
					</div>
					<?php } ?>
				</div>
		<div class="form-group">
			<label>Judul</label>
			<input type="text" name="judul-post" class="form-control"  style="width: 400px;">
		</div>
		<div class="form-group">
			<label>Isi Post</label>
			<textarea class="form-control"  style="width: 500px; height: 200px;" name="isi-post"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" name="terbitkan" class="btn btn-primary">
						<i class="glyphicon glyphicon-log-in"></i> &nbsp; Terbitkan
			</button>
		</div>
	</form>
</section>
<?php endif ; ?>
<section id="tampilkan">
	<div class="container">
		<?php
		while($show=$stmt->fetch(PDO::FETCH_OBJ)){
			echo "<div class=''>

			</div>
			";
		};
		?>
	</div>
</section>
<section id="footer">
	<div class="container">
		<div class="panel-footer">
			<p>Multimedia - 2017</p>
		</div>
	</div>
</section>
</body>
</html>