<?php
	session_start();
	include 'database.php';
	
	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	//Getting the original article
	$sql = "SELECT * FROM itens WHERE id=".$_POST['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
	
	
	//Images!	
	$imgs_bd = "";
	
	$i = 0;
	if (isset($_POST['check']))
		foreach ($_POST['check'] as $img) {
			if ($i == 0) $imgs_bd .= $img;
			else $imgs_bd .= ",".$img;
			$i++;
		}
	
	if (basename( $_FILES['img']['name'][0]) != "") {
		// Multiples images
		$img_path = array();
		$i = 0;
		foreach ($_FILES['img']['name'] as $file) {
			$img_path[$i] = "img/itens/" . basename($file); 
			$i++;
		}
		
		$i = 0;
		if ($imgs_bd == "")
			$imgs_bd = $img_path[0];
		foreach ($img_path as $img) {
			if(move_uploaded_file($_FILES['img']['tmp_name'][$i], $img)) {
				echo "The file ".  basename($img)." has been uploaded<br />";
			} else{
				echo "There was an error uploading the file, please try again!<br />";
			}
			if ($imgs_bd != $img)
				$imgs_bd .= ",".$img;
			$i++;
		}
	}
		
	//Upload mini image
	if (basename( $_FILES['mini_img']['name'] != "")) {
		$mini_img_path = "img/itens/" . basename( $_FILES['mini_img']['name']); 
		
		if(move_uploaded_file($_FILES['mini_img']['tmp_name'], $mini_img_path)) {
			echo "The file ".  basename( $_FILES['mini_img']['name'])." has been uploaded<br />";
		} else{
			echo "There was an error uploading the file, please try again!<br />";
		}
	} else $mini_img_path = $row['mini_img'];
	
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
	
	
	$sql = "UPDATE itens SET name='".$_POST['name']."', price='".$_POST['price']."', size='".$_POST['size']."', ingredients='".$_POST['ingredients']."', 
				description='".$_POST['description']."', nutritional_names='".$compounds."', nutritional_values='".$quantities."', mini_img='".$mini_img_path."', images='".$imgs_bd."', 
				sold='".$row['sold']."', time='".$row['time']."' WHERE id='".$_POST['id']."'";
	
	echo $sql;
	
	if(!mysql_query($sql))
		echo "Error in inserting new data";
	else {
		$database->disconnect();
		header("Location: /item.php?id=".$row['id']);
	}
	
?>