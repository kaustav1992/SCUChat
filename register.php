<?php
session_start();
function registerForm(){
	echo'
<div id="loginform">
<form action="databasestore.php" method="post">
<p>Please enter your name to continue:</p>
<label for="rname">Name:</label>
<input type="text" name="rname" id="name" />
<label for="rpassword">Password:</label>
<input type="password" name="rpassword" id="password" />
<br>

<input type="submit" name="register" id="register" value="Register" />
</form>

</div>
';

	
}



?>

<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php

registerForm();

?>

</html>