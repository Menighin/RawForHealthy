<?php include 'header.php';
	  include 'menu.php';
	  include 'database.php';
		
	$database = new Database();
	$database->connect();
?>
	  
	<div id="content">
		<div id="lightbox">
			<div id="imgBig"> </div>
			<div id="imgAttr"></div>
			<div id="closeButton"><img src="img/close.png" /></div>
		</div>
		<div id="black">
		</div>
		
		
		<div id="gallery">
			<?php
				$pics_by_page = 21;
				$sql = "SELECT * FROM itens ORDER BY id DESC";
				$result = mysql_query($sql, $database->getLink());
				
				$j = 0;
				$images_item = "";
				$caption_imgs = array();
				while($row = mysql_fetch_assoc($result)) {
					if ($j == 0) $images_item .= $row['images'];
					else $images_item .= ",".$row['images'];
					
					$imgs_temp = explode (",", $row['images']);
					foreach ($imgs_temp as $img) {
						$caption_imgs[$img] = $row['name'] . ";" . $row['id'];
					}
					
					$j++;
				}
				
				$images = explode(",", $images_item);
				
				if (!isset($_GET['page']) || $_GET['page'] == 1) {
					$i = 0;
					$max_i = $pics_by_page;
				} else {
					$i = ($_GET['page'] - 1) * $pics_by_page;
					$max_i = $_GET['page'] * $pics_by_page;
				}
				
				for (; isset($images[$i]) && $i < $max_i; $i++) {
					echo '<div class="gallery_image">';
					echo '<a title="'.$caption_imgs[$images[$i]].'"><img src="'.$images[$i].'"/></a>';
					echo '</div>';
				}
			?>
		</div>
		<div id="gallery_pages">
			<h5>PAGES</h5>
			<?php
				for ($i = 0; $i < ceil(count($images) / $pics_by_page); $i++) {
					if ((isset($_GET['page']) && $i == $_GET['page'] - 1) || (!isset($_GET['page']) && $i == 0))
						echo '<span>' . ($i + 1) . '</span>';
					else
						echo '<a href="/gallery.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a>';
				}
			?>
		</div>
	</div>

<?php include 'footer.php'; ?>