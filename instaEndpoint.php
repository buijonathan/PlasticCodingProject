
<script>
  var arr = , window.location.href.split("#");
  if(arr.length == 2) {
	    window.location.href = "http://dev-env.imxpud8g9s.us-west-2.elasticbeanstalk.com/instaEndpoint.php?token=" + arr[1]; 
  } else {
	  document.write("could not find #");
  }

</script>

<?php

var_dump($_GET);
var_dump($_POST);

$urlArray = explode( "#", $_SERVER['REQUEST_URI']);
echo $_SERVER['REQUEST_URI'];
echo $urlArray;
?>