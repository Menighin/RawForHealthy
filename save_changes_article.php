<?php
	session_start();
	include 'database.php';
	
	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	//Getting the original article
	$sql = "SELECT * FROM articles WHERE id=".$_POST['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
	
	
	//Validating files
	if (!$_FILES['title_img']['type'] == "" && !($_FILES['title_img']['type'] == 'image/png' || $_FILES['title_img']['type'] == 'image/jpg' || $_FILES['title_img']['type'] == 'image/jpeg' || $_FILES['title_img']['type'] == 'image/gif'))
		echo 'Title image is not in a valid format. Valid ones are GIF, JPG, JPEG or PNG.<br />';
	
	else if (!$_FILES['text_img']['type'] == "" && !($_FILES['text_img']['type'] == 'image/png' || $_FILES['text_img']['type'] == 'image/jpg' || 
			  $_FILES['text_img']['type'] == 'image/jpeg' || $_FILES['text_img']['type'] == 'image/gif'))
		echo 'Text image is not in a valid format. Valid ones are GIF, JPG, JPEG or PNG.<br />';
	
	else  {
		//Upload title image
		if (basename( $_FILES['title_img']['name']) != "") {
			$title_img_path = "img/articles/" . basename( $_FILES['title_img']['name']); 
			
			if(move_uploaded_file($_FILES['title_img']['tmp_name'], $title_img_path)) {
				echo "The file ".  basename( $_FILES['title_img']['name'])." has been uploaded<br />";
			} else{
				echo "There was an error uploading the file, please try again!<br />";
			}
		} else $title_img_path = $row['title_img'];
		
		//Upload text image
		if (basename( $_FILES['text_img']['name']) != "") {
			$text_img_path = "img/articles/" . basename( $_FILES['text_img']['name']); 
			
			if(move_uploaded_file($_FILES['text_img']['tmp_name'], $text_img_path)) {
				echo "The file ".  basename( $_FILES['text_img']['name'])." has been uploaded<br />";
			} else{
				echo "There was an error uploading the file, please try again!<br />";
			}
		} else $text_img_path = $row['text_img'];
		
		//Upload mino image
		if (basename( $_FILES['mini_img']['name'] != "")) {
			$mini_img_path = "img/articles/" . basename( $_FILES['mini_img']['name']); 
			
			if(move_uploaded_file($_FILES['mini_img']['tmp_name'], $mini_img_path)) {
				echo "The file ".  basename( $_FILES['mini_img']['name'])." has been uploaded<br />";
			} else{
				echo "There was an error uploading the file, please try again!<br />";
			}
		} else $mini_img_path = $row['mini_img'];
		
		
		//Banco de dados
		$_POST['text1'] = nl2br($_POST['text1']);
		$_POST['text2'] = nl2br($_POST['text2']);
		$_POST['text3'] = nl2br($_POST['text3']);
		
		$_POST['title'] = mysql_real_escape_string($_POST['title']);
		$_POST['text1'] = mysql_real_escape_string($_POST['text1']);
		$_POST['text2'] = mysql_real_escape_string($_POST['text2']);
		$_POST['text3'] = mysql_real_escape_string($_POST['text3']);
		
		
		$sql = "UPDATE articles SET title='".$_POST['title']."', text='".$_POST['text1']."', text_next_img='".$_POST['text2']."', text_below_img='".$_POST['text3']."', 
		mini_img='".$mini_img_path."', title_img='".$title_img_path."', text_img='".$text_img_path."' WHERE id='".$_POST['id']."'";
		
		echo $sql;
		
		if(!mysql_query($sql))
			echo "Error in inserting new data";
		else {
			$database->disconnect();
			header("Location: /article.php?id=".$row['id']);
		}
		
	}
	
	
?>