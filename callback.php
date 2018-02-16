<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
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
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "CREATE DATABASE users";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
echo "data base creation stage complete";	

$sql = "CREATE TABLE userData (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
postId VARCHAR(30) NOT NULL,
reg_date TIMESTAMP)";

$fileName = "data.txt";
chmod($fileName, 0777); 
$handle = fopen($fileName, 'a');
fwrite($handle, var_export($_POST, true));
fclose($handle);
$handle = fopen($fileName, 'r');
var_dump(fread($handle, filesize($fileName)));
fclose($handle);
$conn->close();

	
	
}




?>