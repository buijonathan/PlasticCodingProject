<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
} else {
	
echo "trying to connect";
$servername = "aa1a0jahjffztnz.cvvm8c9essu3.us-west-2.rds.amazonaws.com:3306";
$username = "admin";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

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
echo "created data base";
$conn->close();

	
	
}




?>