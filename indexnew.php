<?php
session_start();
ob_start();
$set=0;

if(isset($_GET['logout'])){
unset($_SESSION[$_GET['name']]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$n=$_GET['name'];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

$sql = "UPDATE Users SET Online=0 WHERE Name='$n'";
if ($conn->query($sql) === TRUE) {
	echo "Record updated successfully";
} else {
	echo "Error updating record: " . $conn->error;
}


header("Location: indexnew.php"); //Redirect the user
}



function loginForm(){
	
echo'
<div id="loginform">
<form action="indexnew.php" method="post">
<p>Please enter your name to continue:</p>
<label for="name">Name:</label>
<input type="text" name="name" id="name" />
<label for="password">Password:</label>
<input type="password" name="password" id="password" />
<br>

<input type="submit" name="enter" id="enter" value="Enter" />
</form>
<form action="register.php">
<input type="submit" name="register" id="register" value="Register" />
</div>
';

}

if(isset($_POST['enter'])){
	if($_POST['name'] != ""){
	
	$name = $_POST['name'];
	$password1=$_POST['password'];
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
	echo "Connected successfully";
	$sql = "SELECT Name, Password FROM Users";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo " Name: " . $row["Name"]. "Password " . $row["Password"]. "<br>";
			if($row["Name"]==$name && $row["Password"]==$password1)
			{
				if(!isset($_SESSION[$name])){
				$GLOBALS['set']=1;
				$sql = "UPDATE Users SET Online=1 WHERE Name='$name'";
				if ($conn->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {
					echo "Error updating record: " . $conn->error;
				}
				echo $set;
			
				}
				break;
			}
			
		}
	} else {
		echo "0 results";
	}
	$conn->close();
	
	
	
  	if($GLOBALS['set']==1){
     $_SESSION[$name] = stripslashes(htmlspecialchars($_POST['name']));
     //$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
     //$GLOBALS['set']=0;
     //header("Location: first.php");
     
     
     
     
     
  	}
  	else 
  	{
  		echo '<span class="error">User Already Logged in or Wrong Credentials</span>';
  	}
     
     
  }
  else{
    echo '<span class="error">Please type in a name</span>';
  }
}

?>


<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php

if((!isset($_SESSION[$_POST['name']]) || $GLOBALS['set']==0 )){

loginForm();
$GLOBALS['set']=0;

}
else{
?>
<div id="wrapper">
     <div id="menu">
     <p class="welcome">Welcome <?php echo $_POST['name'] ?>;</b></p>
     <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
     <div style="clear:both"></div>
     </div>
     <div id="chatbox">
     Online Friends<br><br>
     <div id="friends">
     Friend1<br>
     Friend2<br>
     </div>
     
     </div>
 </div>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
 </script>

<script type="text/javascript">
 var count=0; 
 function chatopen(str)
 {	   
	   window.open('chatwindow.php?receiver='+str+'&sender='+'<?php echo $_POST['name'] ?>',"width=200px,height=200px");
	   
 }
 

$(document).ready(function(){
	
	
	setInterval(loadLog,2500);
  
   $("#exit").click(function(){
       var exit = confirm("Are you sure you want to end the session?");
       
       if(exit==true){window.location = 'indexnew.php?logout=true&name=<?php echo $_POST['name']  ?>';}
       
           
   });
   function loadLog(){
	   count++;
	   console.log(count);
	   //document.getElementById("friends").innerHTML=document.getElementById("friends").innerHTML+"hi";
	   //$("#friends").html(count);
	   document.getElementById("friends").innerHTML = "";
	   
	   //Ajax Code
	   if (window.XMLHttpRequest) {
           // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp = new XMLHttpRequest();
       } else {
           // code for IE6, IE5
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       }
       xmlhttp.onreadystatechange = function() {
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               document.getElementById("friends").innerHTML = xmlhttp.responseText;
              
           }
       }
       xmlhttp.open("GET","getfriends.php?q="+"<?php echo $_POST['name']   ?>",true);
       xmlhttp.send();
       
       
		
   }
  
   
	   
	   
   
   
   

   
});
</script>
     
<?php 
}
?>

</html>