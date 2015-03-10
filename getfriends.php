<?php

$q = $_GET['q'];




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
$sql = "SELECT Name FROM Users WHERE Online=1";
$result = $conn->query($sql);
//echo $q;

if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()){
		if($q!=$row["Name"]){
		echo '<a id="'.$row["Name"].'" onclick=chatopen(this.id)>'.$row["Name"].'</a>';
		echo "<br>";}
		?>
		<html>
		<head>
		<script>
		console.log("<?php echo $row["Name"]?>");
		</script>
		</head>
		</html>
		<?php
	}
	
}
else {
	echo "No friends Currenly Online";
}

?>