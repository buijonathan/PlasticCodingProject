<?php
if($_GET['hub_mode'] == "subscribe") {
	echo $_GET['hub_challenge'];
}

?>