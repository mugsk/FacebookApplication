<?
$id = $_REQUEST['userid'];
$name = $_REQUEST['name'];
?>
<html>
<head>
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
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="https://www.google.com/jsapi?key=ABQIAAAAmtf6Y-Mcxjq3zjqGNhtybxToewBUF4oN93oSw2u6KO66x8-veBRhTvXMT5dlhOqAR7MIJNcvwK5ICg"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load("books", "0");
    function inipreview(id) {
		var isbn = document.getElementById('isbn'+id).value;
        var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'+id));     
		viewer.load(isbn);
	  }
  //To display the map location for a restaurant review
  var geocoder;
  var map;
  function initialize(lat,lng,id) {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat,lng);
    var myOptions = {
      zoom: 14,
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
 </script>
</head>
<body>

<?
$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
			if (!$connection) 
			{
					echo 'Error occured';
					die('Could not open connection to database server');
			} else {
			?>
			<div id="friendname">					
			 <img src = "https://graph.facebook.com/<? echo $id;?>/picture?type=small" width="50" height="40" align="left" alt = "profie pic NA"/>  
			  <?  echo "<font color='white'><b>".$name."</b></font>";?>
			</div>
			<div  id="framecontent">
			<img src="images/book.png" width="50" height="50"/><b> BOOK REVIEWS</b>
				<? 
				$query = "SELECT * FROM bookreview where userid = '" . $id. "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
				if(!($result))
				{
				 echo "No reviews to display.";
				}
				while ($myrow = pg_fetch_assoc($result)) {
				?>
		
			<table width="490" cellpadding="0" cellspacing="0">
			
			<tr>  
				<td width="100"></td>
				
			</tr>
			<tr bgcolor="#333333">
				<td width="100" bgcolor="#AFC7C7"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>				
			<td width="390"></td>
			</tr>
			<tr>
			<td width="100" bgcolor="#FFF8C6"><text><b>Author:</b><? echo "  ".$myrow['author']; ?></text></td>
			<td bgcolor="black" align="left"> <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="100"><input type="hidden" id="isbn<? echo $myrow['id']; ?>" value="<? echo $myrow['isbn'];?>"  />   <div id="viewerCanvas<? echo $myrow['id']; ?>" style="width:150px; height:150px"> <? echo $myrow['url']; ?></div>
			<br/><br/><button onclick="inipreview(this.value)" value="<? echo $myrow['id']; ?>" align="center" >PREVIEW</button>
 
			 <td width="390" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="100"></td><td width="100" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
                      
    <?          } //end of book query while
	?>
	<hr color="black" noshade="noshade" size="2" width="500" height="2"><img src="images/movie.jpg" width="50" height="50" /> <b> MOVIE REVIEWS</b></hr>
	<?		    $query = "SELECT * FROM moviereview where userid = '" . $id . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
       
                while ($myrow = pg_fetch_assoc($result)) {
	?>
	
			<table width="490" cellpadding="0" cellspacing="0">
			<tr> <td width="100"></td></tr>

			<tr bgcolor="#333333">
			<td bgcolor="#B4CFEC" width="100"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>
			<td width="390"></td>
			</tr>
			
			<tr>
		       <td width="100"></td>
			<td bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="150"><image src="<? echo $myrow['url']; ?>" width="150" height="150" align="justify" alt="NA"/></td>
			 <td width="340" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="100"></td><td width="390" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			</table>
                        
    <?          } //end of movie query while
	
	?>
	<hr color="black" noshade="noshade" size="2" width="500" height="2"><img src="images/restaurant.png" width="50" height="50"/><b> RESTAURANT REVIEWS</b></hr>
				<? $query = "SELECT * FROM resreview where userid = '" . $id . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
       

				 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table width="490" cellpadding="0" cellspacing="0">
			
			<tr>  
				<td width="100"></td>
				
			</tr>
			<tr bgcolor="#333333">
				<td width="100" bgcolor="#EDDA74"><text> <b>Name:</b><? echo "  ".$myrow['name']; ?></text></td>	
				<td width="100"></td>		
			</tr>
			<tr>
			<td width="100" bgcolor="#FFFFCC"><text><b>Address:</b><? echo "  ".$myrow['address']; ?></text></td>
			<td bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="100" onclick="initialize(<?echo $myrow['lat']; ?>,<?echo $myrow['lng']; ?>,<?echo $myrow['id']; ?>)"><div id="map<?echo $myrow['id'];?>" style="width: 250px; height: 250px;"><br/>Click here to view map</div></td>
			 <td width="400" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="100"></td><td width="390" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
		    <?          } //end of res review
	?>

			<hr color="black" noshade="noshade" size="2" width="500" height="2"><img src="images/tech.png" width="50" height="50"/><b> TECH REVIEWS</b></hr>
				<?  $query = "SELECT * FROM techreview where userid = '" . $id . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
    

				 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table width="490" cellpadding="0" cellspacing="0">
			
			<tr>  
				<td width="100"></td>
				
			</tr>
			<tr bgcolor="#333333">
				<td width="100" bgcolor="#6CC417"><text> <b>Model No.:</b><? echo "  ".$myrow['model']; ?></text></td>	
				<td width="100"></td>
			
			</tr>
			<tr>
			<td width="100" bgcolor="#B5EAAA"><text><b>Brand:</b><? echo "  ".$myrow['brand']; ?></text></td>
			<td bgcolor="black" align="left" > <h1>Posted on: <? echo " ".$myrow['time'];?></h1></td>
			</tr>
			<tr>
			 <td width="150"><image src="<? echo $myrow['url']; ?>" width="150" height="150" align="justify" alt="NA"/></td>
			 <td width="400" bgcolor="#FFFFFF" height="200"><text> <? echo $myrow['review']; ?> </text> </td>
				
			</tr>
			
			<tr><td width="100"></td><td width="100" align="right"><text><b>Rating:</b> <i><?echo " ".$myrow['rating'] ?></i></text></td></tr>
			
		</table>
		                        
    <?          } //end of tech query while loop
	?>
	</div>
 <?
			}//end of connection else

?>
</body>
</html>