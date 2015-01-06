<?php

session_start(); 
$message = $_GET["myreview"];
$url = 'https://graph.facebook.com/me/feed';
$fields = array(
            'access_token'=>urlencode($_SESSION['token']),
            'message'=>urlencode($message)
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection 
$ch = curl_init();

//set the url, number of POST vars, POST data

curl_setopt($ch, CURLOPT_PROXY, "http://webcache.cs.bham.ac.uk:3128");
curl_setopt($ch, CURLOPT_PROXYPORT, 3128); 
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

	?>