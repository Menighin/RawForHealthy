<?php 
	include 'header.php';
	include 'menu.php';

	if (!isset($_SESSION['adm'])) {
		header("Location: http://localhost");
	}
?>

	<div id="content">
	
		<form method="post" action="save_item.php" enctype="multipart/form-data">
			<input type="text" name="name" placeholder="Item name here" required/> <br /><br />
			<div id="new_item_imgs">
				IMAGES (max width: 1000px)<br /><br />
				<div id="images">
					<input type="file" name="img[]" required /><br />
				</div>
				<br /><input type="button" id="more_imgs" value="More Images" />
			</div> <br />
			
			<div id="new_item_price_size">
				<div id="new_item_price">
					<span>PRICE</span><br />
					<input type="text" name="price" placeholder="Only numbers and dots" required />
				</div>
				<div id="new_item_size">
					<span>SIZE</span><br />
					<input type="text" name="size" placeholder="Size of the cake" required />
				</div>
			</div>
			
			<div id="item_collums">
				<div id="item_description">
					<h2>Description</h2>
					<textarea name="description" placeholder="Describe the item"></textarea> <br /><br />
				</div>
				<div id="item_ingredients">
					<h2>Ingredients</h2>
					<textarea name="ingredients" placeholder="What is it made of?"></textarea> <br /><br />
				</div>
				<div id="item_nutritional">
					<h2>Nutritional Information</h2>
					<table>
						<tr>
							<th>Compound</th><th>Quantity*</th>
						</tr>
						<tr>
							<td> <input type="text" name="compound[]" /> </td>
							<td> <input type="text" name="quantity[]" /> </td>
						</tr>
					</table>
					<span>*Based on 100g portion</span>
					<br /><input type="button" id="more_rows" value="More Rows" />
				</div>
			</div>
			
			
			<br /><br />
			<div id="new_item_mini_img">
				IMAGE (180 x 180)<br /><br />
				<input type="file" name="mini_img" required/>
				
			</div>This image is for the miniature in the buy page <br /><br />
			
			<input type="submit" value="Done"/>
			
		</form>
	
	</div>


<?php 
	
	include 'footer.php'; ?>