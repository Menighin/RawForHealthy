<?php
	session_start();
	include 'database.php';
	
	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	//Validating files
	if (!($_FILES['title_img']['type'] == 'image/png' || $_FILES['title_img']['type'] == 'image/jpg' || $_FILES['title_img']['type'] == 'image/jpeg' || $_FILES['title_img']['type'] == 'image/gif'))
		echo 'Title image is not in a valid format. Valid ones are GIF, JPG, JPEG or PNG.<br />';
	
	else if (!$_FILES['text_img']['type'] == "" && !($_FILES['text_img']['type'] == 'image/png' || $_FILES['text_img']['type'] == 'image/jpg' || 
			  $_FILES['text_img']['type'] == 'image/jpeg' || $_FILES['text_img']['type'] == 'image/gif'))
		echo 'Text image is not in a valid format. Valid ones are GIF, JPG, JPEG or PNG.<br />';
	
	else  {
		//Upload title image
		$title_img_path = "img/articles/" . basename( $_FILES['title_img']['name']); 
		
		if(move_uploaded_file($_FILES['title_img']['tmp_name'], $title_img_path)) {
			echo "The file ".  basename( $_FILES['title_img']['name'])." has been uploaded<br />";
		} else{
			echo "There was an error uploading the file, please try again!<br />";
		}
		
		//Upload text image
		if (basename( $_FILES['text_img']['name']) != "") {
			$text_img_path = "img/articles/" . basename( $_FILES['text_img']['name']); 
			
			if(move_uploaded_file($_FILES['text_img']['tmp_name'], $text_img_path)) {
				echo "The file ".  basename( $_FILES['text_img']['name'])." has been uploaded<br />";
			} else{
				echo "There was an error uploading the file, please try again!<br />";
			}
		} else $text_img_path = null;
		
		//Upload mino image
		$mini_img_path = "img/articles/" . basename( $_FILES['mini_img']['name']); 
		
		if(move_uploaded_file($_FILES['mini_img']['tmp_name'], $mini_img_path)) {
			echo "The file ".  basename( $_FILES['mini_img']['name'])." has been uploaded<br />";
		} else{
			echo "There was an error uploading the file, please try again!<br />";
		}
		
		
		//Banco de dados
		$_POST['text1'] = nl2br($_POST['text1']);
		$_POST['text2'] = nl2br($_POST['text2']);
		$_POST['text3'] = nl2br($_POST['text3']);
		
		$_POST['title'] = mysql_real_escape_string($_POST['title']);
		$_POST['text1'] = mysql_real_escape_string($_POST['text1']);
		$_POST['text2'] = mysql_real_escape_string($_POST['text2']);
		$_POST['text3'] = mysql_real_escape_string($_POST['text3']);
		
		$sql = "INSERT INTO articles (title, text, text_next_img, text_below_img, mini_img, title_img, text_img) 
			VALUES ('".$_POST['title']."','".$_POST['text1']."','".$_POST['text2']."','".$_POST['text3']."','".$mini_img_path."','".$title_img_path."','".$text_img_path."')";
		
		echo $sql;
		
		if(!mysql_query($sql))
			echo "Error in inserting new data";
		else {
			$sql = "SELECT * FROM articles ORDER BY id DESC LIMIT 0, 1";
			$result = mysql_query($sql, $database->getLink());
			while($row = mysql_fetch_assoc($result)) {
				$database->disconnect();
				header("Location: /article.php?id=".$row['id']);
			}
		}
		
	}
	
	
?>