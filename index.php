<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
		
	$database = new Database();
	$database->connect();
?>
	  
	<div id="content">
		<div id="onsale">
			<div id="slideshow">
				<?php
					$sql = "SELECT * FROM itens ORDER BY id DESC LIMIT 0, 5";
					$result = mysql_query($sql, $database->getLink());
					echo '<ul>';
					$j = 0;
					while($row = mysql_fetch_assoc($result)) {
						$images = explode (",", $row['images']);
						echo '<li style="background-image: url(\'' . $images[0] . '\');">';
						
						if ($row['sold'] == TRUE)
							echo '<div class="slide_soldout">SOLD OUT</div>';
						else
							echo '<div class="slide_pricetag">€' . $row['price'] . '</div>';
						
						echo '<div class="slide_text_content">';
						echo '<div class="slide_title"><a href="/item.php?id='.$row['id'].'">' . $row['name'] . '</a></div>';
						echo '<div class="slide_ingredients">' . $row['ingredients'] . '</div>';
						echo '</div>';
						echo '</li>';
						$j++;
					}
					echo '</ul>';
				?>
			</div>
			<?php
				echo '<ul id="slidebuttons">';
				for ($i = 0; $i < $j; $i++) {
					echo '<li class="jsbutton" onclick="chooseSlide('.$i.');">';
					echo '<img src="img/slide_off.png" />';
					echo '</li>';
				}
				echo '</ul>';
			?>
		</div>
		<div id="publicity">
			PUBLICIDADE
		</div>
		<div id="articles_index">
			<div id="article_header">
				<img src="img/articles_header.png" />
			</div>
			<?php
				
				if (isset($_SESSION['adm']))
					echo '<br/><div id="new_article"><a href="new_article.php">+ New Article</a></div>';
				
			
				$sql = "SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5";
				$result = mysql_query($sql, $database->getLink());
				
				$i = 1;
				while($row = mysql_fetch_assoc($result)) {
					
					if (isset($_SESSION['adm'])) {
						echo '<div class="article_adm_mini">';
						echo '<a class="js_button" href="/edit_article.php?id='.$row['id'].'">edit</a> | <a class="js_button" href="/delete_article.php?id='.$row['id'].'">delete</a>';
						echo '</div>';
					}
				
					if ($i != 5)
						echo '<div class="article_mini">';
					else
						echo '<div class="last_mini_article">';
					
					echo '<div class="article_mini_image"><a href="/article.php?id='.$row['id'].'"><img src="'.$row['mini_img'].'" width="180" height="180"/> </a> </div>';
					
					echo '<div class="article_content_mini">';
					
					if (strlen($row['title']) > 80)
						echo '<div class="article_title_mini"><a href="/article.php?id='.$row['id'].'">'.substr($row['title'], 0, 80).'...</a></div>';
					else
						echo '<div class="article_title_mini"><a href="/article.php?id='.$row['id'].'">'.$row['title'].'</a></div>';
						
					if (strlen($row['text']) > 800)
						echo '<div class="article_text_mini">'.substr($row['text'], 0, 800).'...</div>';
					else
						echo '<div class="article_text_mini">'.$row['text'].'</div>';
					
					echo '</div>';
					
					echo '</div>';
					
					$i++;
				}
				$database->disconnect();
			?>
			<div id="more_articles"><a href="more_articles.php">More articles</a></div>
		</div>
	</div>

<?php include 'footer.php'; ?>