<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
	  
	$database = new Database();
	$database->connect();
?>
		
<?php
	$sql = "SELECT * FROM articles WHERE id=".$_GET['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
?>

<div id="article_content">
	
	<?php
		if (isset($_SESSION['adm'])) {
			echo '<div id="article_adm">';
			echo '<a class="js_button" href="/edit_article.php?id='.$row['id'].'">edit</a> | <a class="js_button" href="/delete_article.php?id='.$row['id'].'">delete</a>';
			echo '</div>';
		}
	?>
	
	<div id="article_title">
		<?php echo $row['title']; ?>
	</div>
	
	<div id="article_title_image">
		<img src="<?php echo $row['title_img'];?>" />
	</div>
	
	<div id="article_first_text">
		<?php 
		echo $row['text']; ?>
	</div>
	
	<div id="article_second_text_content">
		<div id="article_text_image">
			<img src="<?php echo $row['text_img'];?>" />
		</div>
		<div id="article_text_next_img">
			<?php echo $row['text_next_img']; ?>
		</div>
	</div>
	
	<div id="article_text_below_img">
		<?php echo $row['text_below_img']; ?>
	</div>
</div>
		
<?php 
	$database->disconnect();
	include 'footer.php'; ?>