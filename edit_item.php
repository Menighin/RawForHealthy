<?php
	include 'header.php';
	include 'menu.php';
	include 'database.php';

	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
	
	$database = new Database();
	$database->connect();
	
	$sql = "SELECT * FROM itens WHERE id=".$_GET['id'];
	$result = mysql_query($sql, $database->getLink());
	
	$row = mysql_fetch_assoc($result);
?>

<div id="content">
	
		<form method="post" action="save_changes_item.php" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
			<input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Item name here" required/> <br /><br />
			<div id="edit_item_imgs">
				<div id="old_imgs">
					<?php 
						$images = explode (",", $row["images"]);
						foreach ($images as $image) {
							echo '<div class="old_img">';
							echo '<img src="'.$image.'" width="150" height="auto" /><br />';
							echo '<input type="checkbox" name="check[]" value="'.$image.'" checked />';
							echo '</div>';
						}
					?>
				</div>
				
				<div id="new_imgs">
					<br />IMAGES (max width: 1000px)<br /><br />
					<input type="file" name="img[]" /><br />
				</div>
				<br /><input type="button" id="more_imgs" value="More Images" />
				<input type="button" id="less_imgs" value="Less Images" />
			</div> <br />
			
			<div id="new_item_price_size">
				<div id="new_item_price">
					<span>PRICE</span><br />
					<input type="text" name="price" value="<?php echo $row['price']; ?>" placeholder="Only numbers and dots" required />
				</div>
				<div id="new_item_size">
					<span>SIZE</span><br />
					<input type="text" name="size" value="<?php echo $row['size']; ?>" placeholder="Size of the cake" required />
				</div>
			</div>
			
			<div id="item_collums">
				<div id="item_description">
					<h2>Description</h2>
					<textarea name="description" placeholder="Describe the item"><?php echo $row['description']; ?></textarea> <br /><br />
				</div>
				<div id="item_ingredients">
					<h2>Ingredients</h2>
					<textarea name="ingredients" placeholder="What is it made of?"><?php echo $row['ingredients']; ?></textarea> <br /><br />
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
									echo '<td><input type="text" value="'.$compound.'" name="compound[]" /></td><td><input type="text" value="'.$values[$i].'" name="quantity[]" /></td>';
								echo '</tr>';
							}
						?>
					</table>
					<span>*Based on 100g portion</span>
					<br /><input type="button" id="more_rows" value="More Rows" />
					<input type="button" id="less_rows" value="Less Rows" />
				</div>
			</div>
			
			
			<br /><br />
			<div id="edit_article_mini_img">
				<img src="<?php echo $row['mini_img']; ?>" width="180" height="180"/><br />
				Change image:<input type="file" name="mini_img" />
			</div><br />
			
			<input type="submit" value="Save"/>
			
		</form>
	
	</div>


<?php
 $database->disconnect(); 
 include 'footer.php'; ?>
