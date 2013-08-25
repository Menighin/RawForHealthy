<?php
	session_start();

	include 'database.php';

	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	$sql = "UPDATE itens SET sold='".$_GET['op']."' WHERE id=".$_GET['id'];
	
	if(!mysql_query($sql))
		echo "Error in inserting new data";
	else {
		$database->disconnect();
		header("Location: /buy.php");
	}
	
	$database->disconnect();
?>