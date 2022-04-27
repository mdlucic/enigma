<!--Registration page -->
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Crusader</title>
        <link rel="stylesheet" href="../../resources/css/style.css">
</head>

<body>
	<div class="login">
		<h1>Register Here:</h1>
		<br>
	<form action="../../src/model/register_validation.php" method="POST">
		<input class="textbox" type="text" name="first_name" placeholder="First Name" size="25" required>
		<br>
		<br>
		<input class="textbox" type="text" name="last_name" placeholder="Last Name" size="25" required>
		<br>
		<br>
		<input class="textbox" type="text" name="username" placeholder="Username" size="25" required>
		<br>
		<br>
		<input class="textbox" type="text" name="email" placeholder="Email" size="25" required>
		<br>
		<br>
		<input class="textbox" type="password" name="password" placeholder="Password" size="25" required>
		<br>
		<br>
                <br>
		<br>

		<input class="button" type="submit" value="Submit" name="submit">
	</form>
	<p style="margin-top: 50px;"><a href="login.php">Go back</a></p>
	</div>
</body>
</html>
