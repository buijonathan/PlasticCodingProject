

<?php
$code = $_GET["code"];
var_dump($_GET);
$url = 'https://api.instagram.com/oauth/access_token';
$data = array('client_id' => '649a75e6c43448b9b9927cee68fcf55b', 'client_secret' => '91ece73e7b864be6b3144f42a73b5ba2', 'grant_type' => 'authorization_code', 'redirect_uri' => 'http://dev-env.imxpud8g9s.us-west-2.elasticbeanstalk.com/instaEndpoint.php', 'code' => $code);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
echo( "<br><br>");
var_dump($result);
echo("<br><br>");
$json = json_decode($result, true);
echo $json['access_token'];

$token = $json['access_token'];
$id = $json['user']['id'];
$name = $json['user']['full_name'];

echo $token . "<br>";
echo $id . "<br>";
echo $name . "<br>";


echo "trying to connect";
$servername = "aa1a0jahjffztnz.cvvm8c9essu3.us-west-2.rds.amazonaws.com:3306";
$username = "admin";
$password = "password";
$dbName = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error . "<br>");
//} 
$sql = "DROP TABLE users";
$conn->query($sql);
echo "Connected successfully <br>";
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(30),
userId VARCHAR(30),
authKey VARCHAR(60) )";
$conn->query($sql);
echo $conn->error;
$sql = "SELECT * FROM users WHERE userId=" . $json['user']['id'];
echo ($sql . "<br>");

$result = $conn->query($sql);
var_dump($result->num_rows);
if ($result->num_rows > 0) {
    echo ("user already exists!<br>");
    while($row = $result->fetch_assoc()) {
        var_dump($row);
		echo "<br>";
    }
} else {
	if(trim($json['user']['id']) != ""){
		echo ("User not found, adding");
		$sql = "INSERT INTO users (name, userId, authKey)VALUES ('" . $name . "', '" . $id . "')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo ("Error: " . $sql . "<br>" . $conn->error);
		}
	} else {
		echo "User id seems to be empty";
	}

}
?>