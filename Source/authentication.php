<?php 
session_start();
require_once "facebook.php";

// check if session isset
$app_id = "167582259974726";
$app_secret = "414b3bdfabac679124f37a86d5133012";
$canvas_page = "http://apps.facebook.com/_ithink/home.php";
$auth_url = "https://www.facebook.com/dialog/oauth?client_id="
        . $app_id . "&redirect_uri=" . urlencode($canvas_page) . "&scope=publish_stream";

/* if user clicks allow the app is authorized.The 
  oauth dialog will redirect the users browser to the redirect uri with
  an authorization code. With this code we can proceed to the next
  step(app authentication)to get the access token inorder to make the
  API calls on behalf of the user. */

  $signed_request = $_REQUEST["signed_request"];

// to get the access token for the user.

list($encoded_sig, $payload) = explode('.', $signed_request, 2);
$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
$userid = $data["user_id"];
$oauth_token = $data["oauth_token"];
$_SESSION['token'] = $oauth_token;
$_SESSION['userid'] = $userid;
 
if (empty($data["user_id"])) 
{
    echo("<script> top.location.href='" . $auth_url . "'</script>");
}  
else {

     $facebook = new Facebook(array(
    'appId' => '167582259974726',
    'secret' => '414b3bdfabac679124f37a86d5133012',
     'cookie' => true,
     ));
     }	
?>