<?php

if($_GET['hub.mode'] == "subscribe") {
	echo $_GET['hub.challenge'];
}

?>