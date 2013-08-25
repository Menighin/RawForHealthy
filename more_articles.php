<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
	 
	$database = new Database();
	$database->connect();
?>
	  
	<div id="content">
		<div id="articles_index">
			<div id="articles_header">
				<img src="img/articles_header.png" />
			</div>
			<?php
				$sql = "SELECT * FROM articles ORDER BY id DESC";
				$result = mysql_query($sql, $database->getLink());
				
				while($row = mysql_fetch_assoc($result)) {
				
					if (isset($_SESSION['adm'])) {
						echo '<div class="article_adm_mini">';
						echo '<a class="js_button" href="/edit_article.php?id='.$row['id'].'">edit</a> | <a class="js_button" href="/delete_article.php?id='.$row['id'].'">delete</a>';
						echo '</div>';
					}
				
					echo '<div class="article_mini">';
					echo '<div class="article_mini_image"><a href="/article?id='.$row['id'].'"><img src="'.$row['mini_img'].'" width="180" height="180" /> </a> </div>';
					echo '<div class="article_content_mini">';
					
					if (strlen($row['title']) > 80)
						echo '<div class="article_title_mini"><a href="/article.ph?id='.$row['id'].'">'.substr($row['title'], 0, 80).'...</a></div>';
					else
						echo '<div class="article_title_mini"><a href="/article.php?id='.$row['id'].'">'.$row['title'].'</a></div>';
						
					if (strlen($row['text']) > 800)
						echo '<div class="article_text_mini">'.substr($row['text'], 0, 800).'...</div>';
					else
						echo '<div class="article_text_mini">'.$row['text'].'</div>';
					echo '</div></div>';
				}
				
				$database->disconnect();
			?>
		</div>
	</div>
	
<?php include 'footer.php'; ?>