<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
	 
	$database = new Database();
	$database->connect();
?>
	  
	<div id="content">
		<div id="buy_index">
			<div id="buy_header">
				<img src="img/buy_header.png" />
			</div>
			<?php
				if (isset($_SESSION['adm']))
					echo '<div id="new_article"><a href="new_item.php">+ New Item</a></div>';
			
				$sql = "SELECT * FROM itens ORDER BY id DESC";
				$result = mysql_query($sql, $database->getLink());
				echo '<ul>';
				while($row = mysql_fetch_assoc($result)) {
					echo '<li>';
					if (isset($_SESSION['adm'])) {
						echo '<div class="buy_adm_mini">';
						echo '<a class="js_button" href="/edit_item.php?id='.$row['id'].'">edit</a> | <a class="js_button" href="/delete_item.php?id='.$row['id'].'">delete</a>';
							if ($row['sold'] == '0')
								echo '| <a class="js_button" href="/sold_item.php?id='.$row['id'].'&op=1">sold out</a>';
							else echo '| <a class="js_button" href="/sold_item.php?id='.$row['id'].'&op=0">not sold</a>';
						echo '</div>';
					}
				
					echo '<div class="buy_mini">';
					
					echo '<div class="buy_mini_image"><a href="/item.php?id='.$row['id'].'"><img src="'.$row['mini_img'].'" width="180" height="180" /> </a> </div>';
					echo '<div class="buy_content_mini">';
					
					echo '<div class="buy_time_mini">';
					echo substr($row['time'], 8, 2).'/'.substr($row['time'], 5, 2).'/'.substr($row['time'], 0, 4);
					echo '</div>';
					
					if (strlen($row['name']) > 40)
						echo '<div class="buy_title_mini"><a href="/item.php?id='.$row['id'].'">'.substr($row['name'], 0, 40).'...</a></div>';
					else
						echo '<div class="buy_title_mini"><a href="/item.php?id='.$row['id'].'">'.$row['name'].'</a></div>';
						
					if (strlen($row['ingredients']) > 800)
						echo '<div class="buy_ingredients_mini">'.substr($row['ingredients'], 0, 800).'...</div>';
					else
						echo '<div class="buy_ingredients_mini">'.$row['ingredients'].'</div>';
					echo '</div>';
					
					echo '<div class="buy_content_right_mini">';
					
					if ($row['sold'] == FALSE)
						echo '<div class="buy_price_mini">€ '.$row['price'].'</div>';
					else
						echo '<div class="buy_sold_mini">SOLD OUT</div>';
						
					echo '<div class="buy_size_mini">Size<br /><span>'.$row['size'].'</span></div>';
					
					
					echo '<div class="buy_now_mini">';
					if ($row['sold'] == FALSE)
						echo 'Buy now! Call: <span>4037-2009</span>';
					else
						echo 'Order now! Call: <span>4037-2009</span>';
					echo '</div>';
					
					echo '</div></div>';
					
					echo '</li>';
				}
				echo '</ul>';
				$database->disconnect();
			?>
		</div>
	</div>
	
<?php include 'footer.php'; ?>