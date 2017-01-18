<?php
	require_once('session.php');
	require_once('Api.php');
	$logout = new Api();

	if($logout->is_loggedin()!=""){
		$logout->redirect('./');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true"){
		$logout->Logout();
		$logout->redirect('./');
	}
?>