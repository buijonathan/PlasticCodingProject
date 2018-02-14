<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
} else {
	$fileName = "textData.txt";
	$file = fopen($fileName, 'a') or die('Cannot open file:  ' . $fileName);

	var_export($getData, true);
	var_export($putData, true);
	fwrite("writing: " . $getData . " + " . $putData);
	fclose($file);

	
	
}




?>