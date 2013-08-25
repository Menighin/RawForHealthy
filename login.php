<?php 
	include 'database.php';
	$database = new Database();
	$database->connect();
	
	session_start(); 
	
	$sql = 'SELECT * FROM users WHERE user="'.$_POST['user'].'"';
	
	$result = mysql_query($sql, $database->getLink());
	
	if(!$result)
		echo '<h3>User or password incorrect!!!!!</h3>';
	else {
		if (!$row = mysql_fetch_assoc($result))
			echo "Row fucked";
		
		if (strcmp($row['password'], $_POST['password']) == 0) {
			$_SESSION['adm'] = $_POST['user'];
			echo "SESSION SET: ".$_SESSION['adm'];
			header("Location: http://localhost");
		}
		else
			echo '<h3>User or password incorrect</h3>';
	}
	
	$database->disconnect();
?>