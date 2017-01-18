<?php
	session_start();

	require_once 'Api.php';
	$session = new Api();

	if(!$session->is_loggedin()){
		$session->redirect('./');
	}
?>