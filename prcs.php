<?php
	require_once'Api.php';
	session_start();

	if(isset($_GET['act'])){
		switch($_GET['act']){
			case 'postingan':
			$stmt = Api::runQuery("INSERT INTO `post`(`user_added`, `judul`, `isi`) VALUES(?,?,?)",array($_SESSION['userdata']['id'], $_POST['judul-post'], $_POST['isi-post']));
			Api::redirect($_SERVER['HTTP_REFERER']."&msg=berhasil add data")
			break;
		}
	}
?>