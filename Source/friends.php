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

                -->
            </style>
    </head>

    <body>

        <div id="header"><img src="images/bubble.jpg" width="220" height="170" alt="Img unavailable" align="left"/><img src="images/header.jpg" alt="Img Unavailable" width="530" height="150" align="right"/></div>
        <ul id="navigation">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php">Review</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="Friends">Friends</a></li>
        </ul>
        <br/><br/>  <?php
require_once "facebook.php";
        // to send requests     
        $app_id = "167582259974726";
        $app_secret = "414b3bdfabac679124f37a86d5133012";
		$canvas_page = "http://apps.facebook.com/_ithink/index.php";
        $message = "Would you like to join me in this great app?";

        $requests_url = "https://www.facebook.com/dialog/apprequests?app_id=" 
                . $app_id . "&redirect_uri=" . urlencode($canvas_page)
                . "&message=" . $message;

         if (empty($_REQUEST["request_ids"])) {
            echo("<script> top.location.href='" . $requests_url . "'</script>");
         } else {
            echo "Request Ids: ";
            print_r($_REQUEST["request_ids"]);
         }
        ?> 
    </body>
</html>