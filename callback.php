<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
	$fileName = "data.txt";
	chmod($fileName, 0777); 
	$handle = fopen($fileName, 'a');
	fwrite($handle, var_export($_GET, true) . "<br><br>");
} else {
	
echo "trying to connect";
$servername = "aa1a0jahjffztnz.cvvm8c9essu3.us-west-2.rds.amazonaws.com:3306";
$username = "admin";
$password = "password";
$dbName = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
} 
echo "Connected successfully <br>";

$sql = "CREATE DATABASE users";
//if ($conn->query($sql) === TRUE) {
//    echo "Database created successfully <br>";
//} else {
//    echo "Error creating database: " . $conn->error . "<br>";
//}
//echo "data base creation stage complete <br>";	

//mediaId (50) 
//name (30)
//profile(150)
//image url(150)
//time(15)
//lat(15)
//long(15)
//name(50)

$sql = "CREATE TABLE posts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
mediaId VARCHAR(50) NOT NULL,
name VARCHAR(30),
profileURL VARCHAR(150),
imageURL VARCHAR(150),
time VARCHAR(15),
lat FLOAT,
lon FLOAT,
locName VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$fileName = "data.txt";
chmod($fileName, 0777);
$handle = fopen($fileName, 'a');
fwrite($handle, var_export($_POST, true) . "<br>" . var_export($_GET, true) . "<br><br>");
fclose($handle);
$handle = fopen($fileName, 'r');
var_dump(fread($handle, filesize($fileName)));
fclose($handle);
$conn->close();

	
	
}




?>