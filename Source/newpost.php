<?php
session_start();
/* Redirect browser */
			 
  header("Location: http://apps.facebook.com/_ithink/my_posts.php");
					
   require_once "facebook.php";

    //create application instance
    $facebook = new Facebook(array(
                'appId' => '167582259974726',
                'secret' => '414b3bdfabac679124f37a86d5133012',
                'cookie' => true,
            ));


    if ($facebook->getSession()) {


        $user = $facebook->api('/me');
        // echo $user['first_name'];

       $username = $user['first_name'] . " ".$user['last_name'];
        
		$userid = $_SESSION['userid'];
		//echo $user['first_name'] . " " . $user['last_name'];

                // check if data are valid
                //if (strlen($review) > 0) {
                //connect to the server
			//connect to the database	
			$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
            if (!$connection) {
                    echo 'Error occured';
                    die('Could not open connection to database server');
					}
			
			$type = trim($_POST['type']);
			if($type=='book')
				{	$username = $user['first_name'] . " ".$user['last_name'];
        
					$userid = $_SESSION['userid'];
					$title = $_REQUEST['bookname'];
					$isbn= $_REQUEST['isbn'];
					$auth= $_REQUEST['auth'];
					$url = $_REQUEST['imgurltopass'];
					$review = $_REQUEST['review'];
					$rating = $_REQUEST['rating'];
					$today = date("F j, Y, g:i a"); 
					
					
					// Prepare a query for execution
					$result = pg_prepare($connection, "my_query",  'INSERT INTO bookreview(userid,uname,title,isbn,author,url,review,rating,time) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9)');
					// Execute the prepared query. 						
					$result = pg_execute($connection, "my_query", array($userid,$username,$title, $isbn,$auth,$url,$review,$rating, $today)) or die("Error in query: $query. " . pg_last_error($connection));
				
				}
				else if($type=='tech')
				{
					$model = $_REQUEST['model'];
					$brand = $_REQUEST['brand'];
					$url = $_REQUEST['imgurltopass'];
					$review = $_REQUEST['review'];
					$rating = $_REQUEST['rating'];
					$today = date("F j, Y, g:i a");
					// Prepare a query for execution
					$result = pg_prepare($connection, "my_query",  'INSERT INTO techreview(userid,uname,model,brand,url,review,rating,time) VALUES($1,$2,$3,$4,$5,$6,$7,$8)');
					// Execute the prepared query. 						
					$result = pg_execute($connection, "my_query", array($userid,$username,$model,$brand,$url,$review,$rating, $today)) or die("Error in query: $query. " . pg_last_error($connection));
				
					
					// insert a row in techreview table
					//$query = "INSERT INTO techreview VALUES(nextval('id_seq'), '$userid','$username','$model', '$brand','$url','$review','$rating','$today');SELECT lastval();";
					
				}
				else if($type=='movie')
				{
				    $title = $_REQUEST['title'];
					$url = $_REQUEST['imgurltopass'];
					$review = $_REQUEST['review'];
					$rating = $_REQUEST['rating'];
					$today = date("F j, Y, g:i a");
					// insert a row in moviereview table
					// Prepare a query for execution
					$result = pg_prepare($connection, "my_query",  'INSERT INTO moviereview(userid,uname,title,url,review,rating,time) VALUES($1,$2,$3,$4,$5,$6,$7)');
					// Execute the prepared query. 						
					$result = pg_execute($connection, "my_query", array($userid,$username,$title,$url,$review,$rating, $today)) or die("Error in query: $query. " . pg_last_error($connection));
				
					//$query = "INSERT INTO moviereview VALUES(nextval('id_seq'), '$userid','$username','$title','$url','$review','$rating', '$today');SELECT lastval();";
				
				}
				else if($type=='res')
				{
				    $name = $_REQUEST['name'];
					$addr = $_REQUEST['addr'];
					$url = $_REQUEST['url'];
					$review = $_REQUEST['review'];
					$rating = $_REQUEST['rating'];
					$today = date("F j, Y, g:i a");
					$lat= $_REQUEST['lat'];
					$lng= $_REQUEST['lng'];
				// insert a row in resreview table
					// Prepare a query for execution
					$result = pg_prepare($connection, "my_query",  'INSERT INTO resreview(userid,uname,name,address,url,review,rating,time,lat,lng) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)');
					// Execute the prepared query. 						
					$result = pg_execute($connection, "my_query", array($userid,$username,$name,$addr,$url,$review,$rating, $today,$lat,$lng)) or die("Error in query: $query. " . pg_last_error($connection));
				
					//$query = "INSERT INTO resreview VALUES(nextval('id_seq'), '$userid','$username','$name','$addr','$url','$review','$rating', '$today','$lat','$lng');SELECT lastval();";
				
				}
				
						$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
						//$myrow = pg_fetch_row($result);
						/*$id= $myrow[0];
						// insert a row in reviewstats for each row in reviews
						$query= "INSERT INTO reviewstats VALUES('$id', '{{0}}', 0, 0, 0)";
						$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
						*/
						pg_close($connection);
						
				$publish = $_REQUEST['publish'];
				echo $publish;	
					if($publish=='publish')
					{		$message = 'Hi! I just posted a new review on iThink: '.$review;
							$url = 'https://graph.facebook.com/me/feed';
							$picture = 'http://studentweb.cs.bham.ac.uk/~mmk066/images/revpublish.png';
							$fields = array(
										'access_token'=>urlencode($_SESSION['token']),
										'message'=>urlencode($message),'picture'=>urlencode($picture)
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
					}

            } else {
                echo "No session";
            }
        ?>



