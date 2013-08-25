<?php
	include 'header.php';
	include 'menu.php';
	include 'database.php';

	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	$sql = "SELECT * FROM articles WHERE id=".$_GET['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
?>

<div id="content">
	
	<form method="post" action="save_changes_article.php" enctype="multipart/form-data">
	
		<input type="text" name="title" placeholder="Title here" value="<?php echo $row['title']; ?>" required/> <br /><br />
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
		<div id="edit_article_title_img">
			<img src="<?php echo $row['title_img']; ?>" /><br />
			Change image: <input type="file" name="title_img" />
		</div> <br /><br />
		<textarea name="text1" placeholder="Your text here..." required><?php echo $row['text']; ?></textarea> <br /><br />
		<div id="edit_article_text_img">
			<img src="<?php echo $row['text_img']; ?>" /><br />
			Change image:<input type="file" name="text_img" />
		</div>
		<textarea name="text2" placeholder="Continue your text (optional)..." ><?php echo $row['text_next_img']; ?></textarea> <br /><br />
		<textarea name="text3" placeholder="Continue your text (optional)..." ><?php echo $row['text_below_img']; ?></textarea> <br /><br />
		<hr><br />
		<div id="edit_article_mini_img">
			<img src="<?php echo $row['mini_img']; ?>" width="180" height="180"/><br />
			Change image:<input type="file" name="mini_img" />
		</div><br />
		
		<input type="submit" value="Save"/>
		
	</form>
	
</div>


<?php
	$database->disconnect();
	include 'footer.php';
?>