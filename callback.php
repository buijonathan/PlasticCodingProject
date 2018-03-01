<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>



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

//$sql = "CREATE DATABASE users";
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


$sql = "SELECT * FROM posts";
$postResults = $conn->query($sql);
echo $conn->error;
$sql = "SELECT * FROM users";
$userResults = $conn->query($sql);
echo $conn->error;
var_dump($postResults); 
echo "<br>";
echo "<table>";
while ($row = $postResults->fetch_array(MYSQLI_ASSOC)) {
	
	echo "<tr>";
	foreach($row as $key => $value) {
		echo ("<td>" . $key . " -> " . $value . "</td>");
	}
	echo "</tr>";
}


echo "</table>";



while ($row = $userResults->fetch_array(MYSQLI_ASSOC)) {
	$url = 'http://api.instagram.com/v1/users/' . $row['userId'] . '/media/recent/?access_token=' . $row['authKey'];
	
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'GET',
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	$mediaJson = json_decode($result, true);
	foreach($mediaJson['data'] as $post) {
		
		
		echo("ID: " . $post['id'] . "<br>");
		echo("Full name " . $post['user']['full_name'] . "<br>");
		echo("profile pic url: " . $post['user']['profile_picture'] . "<br>");
		echo("image url " . $post['images']['standard_resolution']['url'] . "<br>");
		echo("time: " . $post['created_time'] . "<br>");
		echo("lat: " . $post['location']['latitude'] . "<br>");
		echo("long: " . $post['location']['longitude']	. "<br>");
		echo("name: " . $post['location']['name'] . "<br>");
		
		$sql = "SELECT * FROM posts WHERE mediaId=" . trim($post['id']);
		echo $sql;
		if ($result->num_rows > 0) {
			echo "media already exists!";
		} else {
		//id -> 1	mediaId ->	name -> 123	profileURL ->	imageURL ->	time ->	lat ->	lon ->	locName ->

			//$sql = "INSERT INTO posts (mediaId, name, profileURL, imageURL, time, lat, lon, locName) VALUES (${post['id']}, ${post['user']['full_name']},${post['user']['profile_picture']},${post['images']['standard_resolution']['url']},${post['created_time']},${post['location']['latitude']},${post['location']['longitude']},${post['location']['name']})";
			$values = "";
			$values = $values . "'" . $post['id'] . "', ";
			$values = $values . "'" . $post['user']['full_name'] . "', ";
			$values = $values . "'" . $post['user']['profile_picture'] . "', ";
			$values = $values . "'" . $post['images']['standard_resolution']['url'] . "', ";
			$values = $values . "'" . $post['created_time'] . "', ";
			$values = $values . "'" . $post['location']['latitude'] . "', ";
			$values = $values . "'" . $post['location']['longitude'] . "', ";
			$values = $values . "'" . $post['location']['name'] . "'";
			$sql = "INSERT INTO posts (mediaId, name, profileURL, imageURL, time, lat, lon, locName) VALUES (" . $values . ")";
			$conn->query($sql);
			echo $conn->error;
		}

	}
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

</body>
</html>