<?php
session_start(); // start the session
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />       
	<style type="text/css">
         <!--   
            body {
                background-image:url(images/background.jpg);
            }
            #left_content h1 strong {
                font-family: Comic Sans MS, cursive;
            }
            		
    .squarebox {
        width: 100%;
        border: solid 1px #336699;
        text-align: center;
        overflow: hidden; }
    .squareboxgradientcaption {
        color: #ffffff;
        padding: 5px;
        background-image: url(../images/gradient_blue.png);
        background-repeat: repeat-x; }
    .squareboxcontent {
        background-color: #f5f5f5;
        padding: 10px;
        overflow: hidden;
        border-top: solid 1px #336699; }
    -->
        </style>
    <script type="text/javascript">
	//Reference for function code: http://bytes.com/topic/javascript/answers/94228-iframe-dynamic-create-populate-immediately
	function createIframe (iframeName, width, height) {
	var iframe;
	if (document.createElement && (iframe =
	document.createElement('iframe'))) {
	iframe.name = iframe.id = iframeName;
	iframe.width = width;
	iframe.height = height;
	iframe.src = 'about:blank';
	document.body.appendChild(iframe);
	}
	return iframe;
	}
	function changeframe(content)
	{
	iframeDoc = window.frames[0].document;
	if (iframeDoc) {
	iframeDoc.open();
	iframeDoc.write(content);

	iframeDoc.close();
}	
	}
	function test (content) {
		
		var iframe = createIframe ('iframe0', 520, 720);
		if (iframe) 
	{
		var iframeDoc;
		if (iframe.contentDocument) 
		{
			iframeDoc = iframe.contentDocument;
		}
		else if (iframe.contentWindow) 
		{
			iframeDoc = iframe.contentWindow.document;
		}
		else if (window.frames[iframe.name]) 
		{
			iframeDoc = window.frames[iframe.name].document;
		}
		if (iframeDoc) 
		{
			iframeDoc.open();
			iframeDoc.write(content);
			iframeDoc.close();
		}
	}
}

	function getfriendReview(id){
	//AJAX Request
	 var xmlhttp;

              
				if(window.XMLHttpRequest) {
                    //code for IE7 , Firefox , Chrome , Opera , Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {
                    // code fro IE6 , IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                    { 
    					changeframe(xmlhttp.responseText);	
					} 
				}
		
	   $name =  document.getElementById(id).value;  
       xmlhttp.open("POST","friendreviews.php?userid="+id+"&name="+$name,true);
       xmlhttp.send();
	}
</script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: '167582259974726', status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
	</head>
    <body onLoad="test('Click on a friend\'s name to read their reviews!')">

        <ul id="navigation">
            <li><a href="index.php">Homepage</a></li>
            <li><a href="pickcategory.php">PostReview</a></li>
            <li><a href="my_posts.php">MyPosts</a></li>
            <li><a href="search.php">Search</a></li>
        </ul>
       
<?
include "facebook.php";

//create application instance
$facebook = new Facebook(array(
            'appId' => '167582259974726',
            'secret' => '414b3bdfabac679124f37a86d5133012',
            'cookie' => true,
        ));


if ($facebook->getSession()) {
    
            $user = $facebook->api('/me');
            $username = $user['first_name'] . $user['last_name'];
          
    ?>		<!--<a href="javascript:top.window.close()">Close</a>-->
      <div id="left_content">
	    <label> <font color="white"><h3> Friends on iThink</h3></font></label>
		  
		
			<?
			
			$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
			if (!$connection) 
			{
					echo 'Error occured';
					die('Could not open connection to database server');
			} else {
			//get the uid's of friends of a user using the same app
			$queryfriends = $facebook->api(array(
			'query' => 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1',
            'method' => 'fql.query'));
			?>
			
			<table>
			<?
			foreach($queryfriends as $friend)
			{  $friendinfo = $facebook->api("/".$friend['uid']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
               $friendname = $friendinfo['first_name'] . " ".$friendinfo['last_name'];
			  
			  ?>
			<tr><td> 
			<div id="name">
			<input type="hidden" value="<?echo $friendname;?>" name="<? echo $friend['uid'];?>" id="<? echo $friend['uid'];?>"/>
			<button id="btn" style="width:220px;" type="submit" value="<? echo $friend['uid'];?>" onclick="getfriendReview(this.value)">						
			 <img src = "https://graph.facebook.com/<? echo $friend['uid'];?>/picture?type=small" width="50" height="40" align="left" alt = "profie pic NA"/>  
			  <?  echo "<b>".$friendname."</b>";?>
			  </button>
			  
		
			</div>			  
			
		
					<br/><br/>
			<hr color="black" noshade="noshade" size="2" width="220" height="2"/>
			</td></tr>
		
		<?	}//end of foreach loop?>
		</table>
		
		<?
		}
		 }else
		{
		
		echo "No session";
		}?>
      </div>
    </body>
</html>
