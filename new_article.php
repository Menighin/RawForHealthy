<?php 
	include 'header.php';
	include 'menu.php';

	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
?>

	<div id="content">
	
		<form method="post" action="save_article.php" enctype="multipart/form-data">
		
			<input type="text" name="title" placeholder="Title here" required/> <br /><br />
			<div id="new_article_title_img">
				IMAGE (max width: 800px)<br /><br />
				<input type="file" name="title_img" required/>
			</div> <br /><br />
			<textarea name="text1" placeholder="Your text here..." required></textarea> <br /><br />
			<div id="new_article_text_img">
				IMAGE (optional - max width: 400px)<br /><br />
				<input type="file" name="text_img" />
			</div>
			<textarea name="text2" placeholder="Continue your text (optional)..."></textarea> <br /><br />
			<textarea name="text3" placeholder="Continue your text (optional)..."></textarea> <br /><br />
			<hr><br />
			<div id="new_article_mini_img">
				IMAGE (180 x 180)<br /><br />
				<input type="file" name="mini_img" required/>
				
			</div>This image is for the miniature in the home page <br /><br />
			
			<input type="submit" value="Done"/>
			
		</form>
	
	</div>


<?php include 'footer.php'; ?>