<?
$type = $_REQUEST['type'];
$id = $_REQUEST['id'];


        //connect to the server
				
			$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
           		 if (!$connection) 
				{
                    		echo 'Error occured';
                    		die('Could not open connection to database server');
				}


			$query= "DELETE FROM ".$type." WHERE id = '".$id."';";
			$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
			pg_close($connection);


?>