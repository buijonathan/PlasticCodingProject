<?php

var_dump($_GET);
var_dump($_POST);

$urlArray = explode( "#", $_SERVER['REQUEST_URI']);
echo $_SERVER['REQUEST_URI'];
echo $urlArray;
?>