<?php

$sql = "SELECT * FROM posts";
$postResults = $conn->query($sql);
echo $conn->error;
$counter = 0;
$data = array();
while ($row = $postResults->fetch_array(MYSQLI_ASSOC)) {
	
	array_push($data, json_encode($row));
	
}

$json = array();
$json['size'] = sizeof($data);
$json['data'] = $data;
echo json_decode($json, true);


>