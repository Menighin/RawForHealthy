<?php
	session_start();
	include 'database.php';
	
	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	// Multiples images
	$img_path = array();
	$i = 0;
	foreach ($_FILES['img']['name'] as $file) {
		$img_path[$i] = "img/itens/" . basename( $file); 
		$i++;
	}
	
	$i = 0;
	$imgs_bd = $img_path[0];
	foreach ($img_path as $img) {
		if(move_uploaded_file($_FILES['img']['tmp_name'][$i], $img)) {
			echo "The file ".  basename($img)." has been uploaded<br />";
		} else{
			echo "There was an error uploading the file, please try again!<br />";
		}
		if ($i > 0) $imgs_bd .= ",".$img;
		$i++;
	}
	
	// Mini image
	$mini_img_path = "img/itens/" . basename( $_FILES['mini_img']['name']); 
	
	if(move_uploaded_file($_FILES['mini_img']['tmp_name'], $mini_img_path)) {
		echo "The file ".  basename( $_FILES['mini_img']['name'])." has been uploaded<br />";
	} else{
		echo "There was an error uploading the file, please try again!<br />";
	}
	
	//Table
	$compounds = $_POST['compound'][0];
	$i = 0;
	foreach ($_POST['compound'] as $c) {
		if ($i > 0) $compounds .= ";" . $c;
		$i++;
	}
		
	$quantities = $_POST['quantity'][0];
	$i = 0;
	foreach ($_POST['quantity'] as $q) {
		if ($i > 0) $quantities .= ";" . $q;
		$i++;
	}
	
	//Banco de dados
	$_POST['description'] = nl2br($_POST['description']);
	$_POST['ingredients'] = nl2br($_POST['ingredients']);
	
	$_POST['name'] = mysql_real_escape_string($_POST['name']);
	$_POST['description'] = mysql_real_escape_string($_POST['description']);
	$_POST['ingredients'] = mysql_real_escape_string($_POST['ingredients']);
	
	$sql = "INSERT INTO itens (name, price, size, ingredients, description, nutritional_names, nutritional_values, mini_img, images, sold, time) 
		VALUES ('".$_POST['name']."','".$_POST['price']."','".$_POST['size']."','".$_POST['ingredients']."','".$_POST['description']."','".$compounds."','".$quantities."','".$mini_img_path."','".$imgs_bd."','0','".date('Y-m-d H:i:s')."')";
	
	echo $sql;
	
	if(!mysql_query($sql))
		echo "Error in inserting new data";
	else {
		$sql = "SELECT * FROM itens ORDER BY id DESC LIMIT 0, 1";
		$result = mysql_query($sql, $database->getLink());
		while($row = mysql_fetch_assoc($result)) {
			$database->disconnect();
			header("Location: /item.php?id=".$row['id']);
		}
	}
?>