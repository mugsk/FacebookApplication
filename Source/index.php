<?php
// start the session
session_start(); 
/** Code Reference : http://developers.facebook.com/docs/authentication/
*  modified
**/	
require_once "facebook.php";
$app_id = "167582259974726";
$app_secret = "414b3bdfabac679124f37a86d5133012";
$canvas_page = "http://apps.facebook.com/_ithink/index.php";
$auth_url = "https://www.facebook.com/dialog/oauth?client_id="
        . $app_id . "&redirect_uri=" . urlencode($canvas_page) . "&scope=publish_stream";
/* if user clicks allow , the app is authorized.The 
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
if (empty($data["user_id"])) {
    echo("<script> top.location.href='" . $auth_url . "'</script>");
}  else {
$facebook = new Facebook(array(
                'appId' => '167582259974726',
                'secret' => '414b3bdfabac679124f37a86d5133012',
                'cookie' => true,
            ));
    if ($facebook->getSession()) {
       $user = $facebook->api('/me');
       $username = $user['first_name'] . " ".$user['last_name']; 
	   $_SESSION['name'] = $username;

	   }
	   else
	   {
	   echo "NO SESSION!!";
	   } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Facebook Application</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
            <style type="text/css">
                <!--
                body {
                    background-image:url(images/background.jpg);

                }
                #stats {
                    text-align: left;
                    font-weight: bold;
                    color: #FFF;
                    font-weight: bold;
                    font-family: "Comic Sans MS", cursive;
                    font-family: "Comic Sans MS", cursive;
                }
				
				h4{
				
				  font-weight: bold;
                    color: #FFF;
				
				}

                -->
		
            </style>
<script type="text/javascript">



<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=800,left = 240,top = 0');");
}

function display(text)
{
 document.getElementById('display_content').innerHTML="<font size='2' color='white'>"+text+"</font> <br/><hr/>";
}

</script>
<script type="text/javascript">
// Google Analytics code to track the application use
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25247394-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<fb:Google-analytics uacct="UA-25247394-1"/>
</head>
    <body>
        <div id="header">
			<img src="images/bubble.jpg" width="220" height="150" alt="Img unavailable" align="left"/><img src="images/header.jpg" alt="Img Unavailable" width="530" height="150" align="right"/>
	</div>
 
        <div id="content_wrap">
            <div id="right_content">
				
				<div id="display_content"></div>
                <ul id="menu">
                   
                    <li id="post" onmouseout="display('')"> <a href="pickcategory.php" onmouseover="display('Add a new review')" > POST SOMETHING</a>
					</li>
		      <li id="mypost" onmouseout="display('')" onmouseover="display('To view/edit all your reviews')"><a href="my_posts.php" > MY POSTS</a></li>
                    <li id="comm" onmouseout="display('')" onmouseover="display('Check out what reviews friends have posted')"> <a href="home.php">FRIENDS REVIEWS</a> </li>
			<li id="comm" onmouseout="display('')" onmouseover="display('Find out the most recently published reviews by users')"> <a href="recentposts.php">RECENT USER ACTIVITY</a> </li>
                    <li id="search" onmouseout="display('')" onmouseover="display('Want another opinion about something? Check out the reviews on iThink!')"> <a href="search.html">SEARCH FOR REVIEWS</a> </li>
                    <li id="friends" onmouseout="display('')" onmouseover="display('Ask your friends to join this app and make it more useful')"><a href="friends.php"> INVITE FRIENDS </a></li>
		    <li  id="questionnaire" onmouseout="display('')" onmouseover="display('Please answer this simple questionnaire.')"><a href="javascript:popUp('http://www.surveymonkey.com/s/8GD2FCS')">GO TO QUESTIONNAIRE</a></li>
             
 </ul>
				<div id="footer">
			 Copyright &copy 2011 v 1.0.0 , Mugdha Kanhere.All rights reserved.
			
			</div>
					
            </div>
            <div id="left_content">  
			  <? echo "<b>Logged in:</b><u> ".$user['first_name']." ".$user['last_name']."</u><br/><br/>";?>
    <img src = "https://graph.facebook.com/<? echo $_SESSION['userid']; ?>/picture?type=large" width="100" height="100" alt = "profie pic NA"/> 
                    <?
                } 
                ?> 
                    <br/><br/><br/>   
         <a title="Goto Facebook Page of iThink Application" align="right" target="_top" href="http://www.facebook.com/apps/application.php?id=167582259974726" style="color:#fff;">Go to AppPage</a><br/>
		<br/>
         <iframe src="http://www.facebook.com/plugins/like.php?app_id=237113379664658&amp;href=http%3A%2F%2Fapps.facebook.com%2F_ithink&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=dark&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
				
		  </div>
	
        </div>
				
    </body>
</html>
