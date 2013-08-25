<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
	  
	$database = new Database();
	$database->connect();
?>
		
<?php
	$sql = "SELECT * FROM itens WHERE id=".$_GET['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
?>

<div id="item_content">
	
	<?php
		if (isset($_SESSION['adm'])) {
			echo '<div id="article_adm">';
			echo '<a class="js_button" href="/edit_item.php?id='.$row['id'].'">edit</a> | <a class="js_button" href="/delete_item.php?id='.$row['id'].'">delete</a>';
			if ($row['sold'] == '0')
				echo '| <a class="js_button" href="/sold_item.php?id='.$row['id'].'&op=1">sold out</a>';
			else echo '| <a class="js_button" href="/sold_item.php?id='.$row['id'].'&op=0">not sold</a>';
			echo '</div>';
		}
	?>
	
	
	<div id="item_name">
		<?php echo $row['name']; ?>
	</div>
	<div id="item_time">
		<?php echo substr($row['time'], 8, 2).'/'.substr($row['time'], 5, 2).'/'.substr($row['time'], 0, 4); ?>
	</div>
	<div id="item_images">
		<div id="item_slideshow">
			<?php
				echo '<ul>';
				$j = 0;
				$images = explode (",", $row['images']);
				foreach ($images as $image) {
					echo '<li style="background-image: url(\'' . $image . '\');">';
					
					echo '<div class="item_down_space">';
						echo '<div class="item_slide_button"> hide </div>';
						echo '<div class="item_slide_info">';
							if ($row['sold'] == FALSE)
								echo '<div class="item_pricetag">PRICE<br /><span>€' . $row['price'] . '</span></div>';
							else
								echo '<div class="item_sold">PRICE<br /><span>SOLD OUT</span></div>';
							echo '<div class="item_size">SIZE<br /><span>' . $row['size'] . '</span></div>';
							if ($row['sold'] == FALSE)
								echo '<div class="item_buy">TO BUY, CALL<br /><span>4037-2009</span></div>';
							else
								echo '<div class="item_buy">TO ORDER, CALL<br /><span>4037-2009</span></div>';
						echo '</div>';
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
	
	<div id="item_collums">
		<div id="item_description">
			<h2>Description</h2>
			<?php echo $row['description']; ?>
		</div>
		<div id="item_ingredients">
			<h2>Ingredients</h2>
			<?php echo $row['ingredients']; ?>
		</div>
		<div id="item_nutritional">
			<h2>Nutritional Information</h2>
			<table>
				<tr>
					<th>Compound</th><th>Quantity*</th>
				</tr>
				<?php
					$compounds = explode(";", $row['nutritional_names']);
					$values = explode(";", $row['nutritional_values']);
					
					foreach ($compounds as $i => $compound) {
						echo '<tr>';
							echo '<td>'.$compound.'</td><td>'.$values[$i].'</td>';
						echo '</tr>';
					}
				?>
			</table>
			<span>*Based on 100g portion</span>
		</div>
	</div>
</div>
		
<?php 
	$database->disconnect();
	include 'footer.php'; ?>