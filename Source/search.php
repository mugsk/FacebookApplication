
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Search Form</title>
		


        <style type="text/css">
            <!--
            body {
                background-image:url(images/background.jpg);
            }
            #left_content h1 strong {
                font-family: Comic Sans MS, cursive;
            }
			h1{
				font-family:Arial,Helvetica,sans-serif;
				font-size:10px;
				font-style:italic;
				color:#999;}
			text{
				font-family: "Times New Roman",Times,serif;
				font-size:14px;
			
				color:black;
			
			  }
            -->
        </style>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	 <script src="https://www.google.com/jsapi?key=ABQIAAAAmtf6Y-Mcxjq3zjqGNhtybxToewBUF4oN93oSw2u6KO66x8-veBRhTvXMT5dlhOqAR7MIJNcvwK5ICg"></script>

  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
     
   <script type="text/javascript">
   
      google.load("books", "0");

      function inipreview(id) {
		var isbn = document.getElementById('isbn'+id).value;
		//alert(isbn);
        var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'+id));
        
		viewer.load(isbn);
	  }

var geocoder;
  var map;
  function initialize(lat,lng,id) {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat,lng);
    var myOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"+id), myOptions);
	  map.setCenter(latlng);
		
        var marker = new google.maps.Marker({
            map: map,
            position: latlng
        });

 }
   function preview(val)
	{
	document.getElementById("div"+val).innerHTML =document.getElementById("url"+val).value ;
	
	}
		
	</script>	
		
    </head>
    <body>
	
	 <div id="header"><img src="images/bubble.jpg" width="220" height="150" alt="Img unavailable" align="left"/><img src="images/header.jpg" alt="Img Unavailable" width="530" height="150" align="right"/></div>

    <ul id="navigation">
            <li><a href="index.php">Homepage</a></li>
            <li><a href="pickcategory.php">PostReview</a></li>
            <li><a href="my_posts.php">MyPosts</a></li>
            <li><a href="home.php">MyFeed</a></li>
        </ul>
    
        <br/><br/>
	

	<div id="discussion">			
        

	
	Click <a href="search.html">here</a> to go back to the Search page.<br/>
		
	<?
	$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
    if (!$connection) 
	{
        echo 'Error occured';
        die('Could not open connection to database server');
	}
	$type = $_REQUEST['typeofsearch'];
	$searchstr = "%".strtolower($_REQUEST['param'])."%";
	if($type=='book')
	 {
	 
	 $result = pg_prepare($connection, "my_query",  'SELECT * FROM bookreview WHERE lower(title) LIKE $1');
	// Execute the prepared query. 						
	$result = pg_execute($connection, "my_query", array($searchstr)) or die("Error in query: $query. " . pg_last_error($connection));
	 $rows = pg_num_rows($result);	
	 echo $rows." books match your query string";
	
			 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table width="700" cellpadding="0" cellspacing="0">
			
			
			<tr bgcolor="#333333">
				<td width="200" bgcolor="#AFC7C7"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>	
				<td width="400" align="left" ><input type="hidden" value="bookreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
			     <h1>  By : <? echo $myrow['uname'];?> </h1>
				</td>
			
			</tr>
			<tr>
			<td width="200" bgcolor="#FFF8C6"><text><b>Author:</b><? echo "  ".$myrow['author']; ?></text></td>
			<td width="400" bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="200"><input type="hidden" id="isbn<? echo $myrow['id']; ?>" value="<? echo $myrow['isbn'];?>"  />   <div id="viewerCanvas<? echo $myrow['id']; ?>" style="width:250px; height:250px"> <? echo $myrow['url']; ?></div>
<br/><br/><button onclick="inipreview(this.value)" value="<? echo $myrow['id']; ?>" align="center" >PREVIEW</button>

<!--<image src="<? //echo $myrow['url']; ?>" width="150" height="150" align="justify" alt="NA" title="book cover"/>--></td>
			 <td width="400" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="100"></td><td width="600" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
	
	
		
                        
    <?          } //end of book query while
	
	 }
	 else if($type=='movie')
	 {
	  $result = pg_prepare($connection, "my_query",  'SELECT * FROM moviereview WHERE lower(title) LIKE $1');
	// Execute the prepared query. 						
	$result = pg_execute($connection, "my_query", array($searchstr)) or die("Error in query: $query. " . pg_last_error($connection));
	 $rows = pg_num_rows($result);	
	 echo $rows." movies match your query string";
   while ($myrow = pg_fetch_assoc($result)) {
	?>
	
			<table width="700" cellpadding="0" cellspacing="0">
		

			<tr bgcolor="#333333">
			<td bgcolor="	 #B4CFEC" width="150"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>
			<td width="550" align="left" ><input type="hidden" value="moviereview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<h1> By : <? echo $myrow['uname'];?> </h1>
			</td>
			</tr>
			
			<tr>
		       <td width="150"></td>
			<td bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="150"><image src="<? echo $myrow['url']; ?>" width="150" height="150" align="justify" alt="NA"/></td>
			 <td width="550" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="150"></td><td width="550" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			</table>
		
		
		
		
                        
    <?          } //end of movie query while	 
	 
	 }
	else if($type=='tech')
	{
	 $result = pg_prepare($connection, "my_query",  'SELECT * FROM techreview WHERE lower(model) LIKE $1 or lower(brand) LIKE $2');
	// Execute the prepared query. 						
	$result = pg_execute($connection, "my_query", array($searchstr,$searchstr)) or die("Error in query: $query. " . pg_last_error($connection));
	 $rows = pg_num_rows($result);	
	 echo $rows." result(s) match your query string";
 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table width="700" cellpadding="0" cellspacing="0">
		
			<tr bgcolor="#333333">
				<td width="150" bgcolor="#6CC417"><text> <b>Model No.:</b><? echo "  ".$myrow['model']; ?></text></td>	
				<td width="550" align="left">
				<input type="hidden" value="techreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<h1> By : <? echo $myrow['uname'];?> </h1>
				</td>
			
			</tr>
			<tr>
			<td width="150" bgcolor="#B5EAAA"><text><b>Brand:</b><? echo "  ".$myrow['brand']; ?></text></td>
			<td width="550" bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="150"><image src="<? echo $myrow['url']; ?>" width="150" height="150" align="justify" alt="NA"/></td>
			 <td width="550" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="150"></td><td width="550" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
	
		                        
    <?          } //end of tech query while loop
	 
	 
	
	
	
	}
	else if($type=='rest')
	{
	 $result = pg_prepare($connection, "my_query",  'SELECT * FROM resreview WHERE lower(name) LIKE $1 or lower(address) LIKE $2');
	// Execute the prepared query. 						
	$result = pg_execute($connection, "my_query", array($searchstr,$searchstr)) or die("Error in query: $query. " . pg_last_error($connection));
	 $rows = pg_num_rows($result);	
	 echo $rows." result(s) match your query string";
 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table cellpadding="0" cellspacing="0">
			
			<tr>  
				<td width="350"></td>
				
			</tr>
			<tr bgcolor="#333333">
				<td width="100" bgcolor="#EDDA74"><text> <b>Name:</b><? echo "  ".$myrow['name']; ?></text></td>	
				<td width="100" align="left">
				<input type="hidden" value="resreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<h1> By : <? echo $myrow['uname'];?> <h1>

				</td>
			
			</tr>
			<tr>
			<td width="100" bgcolor="#FFFFCC"><text><b>Address:</b><? echo "  ".$myrow['address']; ?></text></td>
			<td bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="400" onclick="initialize(<?echo $myrow['lat']; ?>,<?echo $myrow['lng']; ?>,<?echo $myrow['id']; ?>)"><div id="map<?echo $myrow['id'];?>" style="width: 400px; height: 300px;"><br>Click here to view map</div></td>
			 <td width="400" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="400"></td><td width="100" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
	
		    <?          } //end of res review
	}
	
?>

	
	
				
	</div>
		
    </body>
</html>
