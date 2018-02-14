<?php
var_dump($_GET);
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
}

?>