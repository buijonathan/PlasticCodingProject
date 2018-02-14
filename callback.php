<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
} else {
	$file = fopen("testData.txt", 'a');
	$getData = "";
	$putData = "";
	var_export($getData, true);
	var_export($putData, true);
	fwrite($getData . " + " . $putData);
}




?>