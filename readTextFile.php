<?php

$file = fopen("testData.txt", 'r');
$data = fread($file, filesize($my_file));
echo $data;

?>