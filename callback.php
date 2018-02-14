<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
} else {
	$file = fopen("testData", 'a');
	$getData = "";
	$putData = "";
	var_export($getData, true);
	var_export($putData, true);
	fwrite($getData . " + " . $putData);
}




?>