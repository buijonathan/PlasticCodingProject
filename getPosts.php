<?php

//echo "trying to connect";
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
$count = 0;
if(isset($_GET['count'])) {
	$count = $_GET['count'];
} 
//echo "Connected successfully <br>";
$sql = "SELECT * FROM posts";
$postResults = $conn->query($sql);
//echo $conn->error;
$data = array();
while ($row = $postResults->fetch_array(MYSQLI_ASSOC)) {
	$count--;
	if($count < 0) {
		array_push($data, $row);
	}
	//var_dump($row);
}
//var_dump($data);
$json = array();
$json['size'] = sizeof($data);
$json['data'] = $data;
//var_dump($json);
echo json_encode($json);

?>