<!DOCTYPE html>
<?php 
if($_GET["action"] == 'verified')
{
	echo "<p>You can login now</p>";
}
?>


<!-- Main page -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Crusader</title>
	<link rel="stylesheet" href="../../resources/css/style.css">
</head>
<body>
<div class="login">
<h1>Login</h1>
<br>
		<form action="../../src/model/login_verification.php" method="POST">
			<input class="textbox" type="text" name="username" placeholder="Username or Email">
			<br>
			<br>
			<input class="textbox" type="password" name="password" placeholder="Password">
			<br>
			<br>
			<input class="button" type="submit" value="Log in">
			<br>
			<br>
		</form>
	<p style="text-align:center;"><a href="register.php">Click to register</a></p>
	</div>
</body>
</html>
