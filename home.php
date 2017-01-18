<?php
	require_once("session.php");
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
	<title>Dashboard || GoBlog</title>
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="core/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="core/css/home.css" type="text/css"  />
	<script type="text/javascript" src="core/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="core/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="core/js/core.js"></script>
</head>
<body>
<div id="wrapper">
  <div class="overlay"></div>

  <!-- Sidebar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: black;">
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
        <li><a href="home.php">Hai, <?php echo $userRow['nama'] ?></a></li>
        <li><a href="logout.php?logout=true">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">
    <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
      <span class="hamb-top"></span>
      <span class="hamb-middle"></span>
      <span class="hamb-bottom"></span>
    </button>
    <div class="container">
      <div class="row grey">
        <div class="col-lg-12 ">
          <h1>Dashboard</h1>
          <center><h2>Selamat Datang <?php echo $userRow['nama']; ?></h2></center>
          
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
</body>
</html>