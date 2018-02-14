<?php

$fileName = "textData.txt";
$file = fopen($fileName, 'a') or die('Cannot open file:  ' . $fileName);
$data = fread($file, filesize($fileName));
echo $data;

?>