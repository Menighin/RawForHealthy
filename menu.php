<body>
	<div id="top">
		<div id="head">
			<a href="http://localhost"><img src="img/header.png" /></a>
			<?php
				if (isset($_SESSION['adm']))
					echo '<span>Welcome '.$_SESSION['adm'].' (<a href="logout.php"> logout </a>)</span>';
			?>
		</div>
		<div id="menu"> 
			<ul>
				<li><a class="menu_item" href="http://localhost">HOME</a>
				</li><li><a class="menu_item" href="/buy.php">BUY</a>
				</li><li><a class="menu_item" href="/more_articles.php">ARTICLES</a>
				</li><li><a class="menu_item" href="/what_is.php">WHAT IS RAW FOOD?</a>
				</li><li><a class="menu_item" href="/gallery.php">GALLERY</a>
				</li><li><a class="menu_item" href="/contact.php">CONTACT</a>
			</ul>
		</div>
	</div>