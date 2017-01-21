<?php
	require_once('Api.php');
	session_start();
	$api = new Api();

	if(isset($_GET['act'])){
		switch($_GET['act']){
			case 'postingan':
			$judul = $_POST['judulp'];
			$isi = $_POST['isip'];
			$stmt = Api::runQuery("INSERT INTO post(judul, isi) VALUES($judul,$isi)");
			Api::redirect("./");
			break;
		}
	}else{
		Api::redirect("./");
	}
?>