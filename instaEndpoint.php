

<?php
$code = $_GET["code"];
var_dump($_GET);
$url = 'https://api.instagram.com/oauth/access_token';
$data = array('client_id' => '649a75e6c43448b9b9927cee68fcf55b', 'client_secret' => '91ece73e7b864be6b3144f42a73b5ba2', 'grant_type' => 'authorization_code', 'redirect_uri' => 'http://dev-env.imxpud8g9s.us-west-2.elasticbeanstalk.com/instaEndpoint.php', 'code' => $code);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
echo( "<br><br>");
var_dump($result);
echo("<br>");
$json = json_decode($result, true);
echo $json['access_token'];


?>