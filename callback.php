<?php
var_dump($_GET);
if($_GET['hub.mode'] == "subscribe") {
	echo $_GET['hub.challenge'];
}

?>