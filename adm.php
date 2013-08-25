<?php include 'header.php';
	  include 'menu.php'; ?>
	  
	<div id="login">
		<form action="login.php" method="post">
			USER <br/><input type="text" name="user" /><br />
			PASSWORD <br/><input type="password" name="password" /><br />
			<input type="submit" value="Login" />
		</form>
	</div>
	
<?php include 'footer.php'; ?>