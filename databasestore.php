<?php
session_start();
ob_start();
//echo $_POST['rname'];


if(isset($_POST['rname']) && isset($_POST['rpassword'])){
	$name = $_POST['rname'];
	$password1=$_POST['rpassword'];
	//echo $name;
	

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "users";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";
	
	
	$sql = "INSERT INTO Users (Name,Password,Online)
	VALUES ('$name','$password1',0)";
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: indexnew.php");
	} else {
		echo '<div id="loginform">
		<span class="error">User Already exists</span>
				<form action="register.php">
<input type="submit" value="Go back" />
				
				</div>';
		
		//echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	}
	
	?>
	
	<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>



</html>