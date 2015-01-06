<?php
session_start();

?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>My_Posts</title>
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
    <link rel="stylesheet" type="text/css" href="rating/rating.css" media="screen"/>
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
 // Code Reference : http://www.dynamicdrive.com/dynamicindex1/ddtabmenu.htm modified and edited
    var ddtabmenu={
	disabletablinks: false, //Disable hyperlinks in 1st level tabs with sub contents (true or false)?
	snap2original: [false, 300], //Should tab revert back to default selected when mouse moves out of menu? ([true/false, delay_millisec]
	currentpageurl: window.location.href.replace("http://"+window.location.hostname, "").replace(/^\//, ""), //get current page url (minus hostname, ie: http://www.dynamicdrive.com/)
    definemenu:function(tabid, dselected){
	this[tabid+"-menuitems"]=null
	this[tabid+"-dselected"]=-1
	this.addEvent(window, function(){ddtabmenu.init(tabid, dselected)}, "load")
     },
    showsubmenu:function(tabid, targetitem){
	var menuitems=this[tabid+"-menuitems"]
	this.clearrevert2default(tabid)
    for (i=0; i<menuitems.length; i++){
		menuitems[i].className=""
		if (typeof menuitems[i].hasSubContent!="undefined")
	    	document.getElementById(menuitems[i].getAttribute("rel")).style.display="none"
	}
	targetitem.className="current"
	if (typeof targetitem.hasSubContent!="undefined")
		document.getElementById(targetitem.getAttribute("rel")).style.display="block"
    },
isSelected:function(menuurl){
	var menuurl=menuurl.replace("http://"+menuurl.hostname, "").replace(/^\//, "")
	return (ddtabmenu.currentpageurl==menuurl)
},
isContained:function(m, e){
	var e=window.event || e
	var c=e.relatedTarget || ((e.type=="mouseover")? e.fromElement : e.toElement)
	while (c && c!=m)try {c=c.parentNode} catch(e){c=m}
	if (c==m)
		return true
	else
		return false
},

revert2default:function(outobj, tabid, e){
	if (!ddtabmenu.isContained(outobj, tabid, e)){
		window["hidetimer_"+tabid]=setTimeout(function(){
			ddtabmenu.showsubmenu(tabid, ddtabmenu[tabid+"-dselected"])
		}, ddtabmenu.snap2original[1])
	}
},

clearrevert2default:function(tabid){
 if (typeof window["hidetimer_"+tabid]!="undefined")
		clearTimeout(window["hidetimer_"+tabid])
},
addEvent:function(target, functionref, tasktype){ //assign a function to execute to an event handler (ie: onunload)
	var tasktype=(window.addEventListener)? tasktype : "on"+tasktype
	if (target.addEventListener)
		target.addEventListener(tasktype, functionref, false)
	else if (target.attachEvent)
		target.attachEvent(tasktype, functionref)
},

init:function(tabid, dselected){
	var menuitems=document.getElementById(tabid).getElementsByTagName("a")
	this[tabid+"-menuitems"]=menuitems
	for (var x=0; x<menuitems.length; x++){
		if (menuitems[x].getAttribute("rel")){
			this[tabid+"-menuitems"][x].hasSubContent=true
			if (ddtabmenu.disabletablinks)
				menuitems[x].onclick=function(){return false}
			if (ddtabmenu.snap2original[0]==true){
				var submenu=document.getElementById(menuitems[x].getAttribute("rel"))
				menuitems[x].onmouseout=function(e){ddtabmenu.revert2default(submenu, tabid, e)}
				submenu.onmouseover=function(){ddtabmenu.clearrevert2default(tabid)}
				submenu.onmouseout=function(e){ddtabmenu.revert2default(this, tabid, e)}
			}
		}
		else //for items without a submenu, add onMouseout effect
			menuitems[x].onmouseout=function(e){this.className=""; if (ddtabmenu.snap2original[0]==true) ddtabmenu.revert2default(this, tabid, e)}
		menuitems[x].onmouseover=function(){ddtabmenu.showsubmenu(tabid, this)}
		if (dselected=="auto" && typeof setalready=="undefined" && this.isSelected(menuitems[x].href)){
			ddtabmenu.showsubmenu(tabid, menuitems[x])
			this[tabid+"-dselected"]=menuitems[x]
			var setalready=true
		}
		else if (parseInt(dselected)==x){
			ddtabmenu.showsubmenu(tabid, menuitems[x])
			this[tabid+"-dselected"]=menuitems[x]
		}
	}
}
}

function deleterev(id)
{
var answer = confirm("Are you sure you want to delete this review?");
// if user confirms delete then use AJAX to delete the review in the background
if (answer)
	{	
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
                    { window.location.reload();
						alert("Your review has been deleted");	
                    } 			
				}
		  
   	var type = document.getElementById(id).value;
    xmlhttp.open("POST","deletereview.php?id="+id+"&type="+type,true);
    xmlhttp.send();	
	}
}
  function review()
	{
	  document.getElementById('text').innerHtml = 'hi';
    }
    function preview(val)
	{
	document.getElementById("div"+val).innerHTML =document.getElementById("url"+val).value ;
	}
ddtabmenu.definemenu("ddtabs1", 0) //initialize Tab Menu with ID "ddtabs1" and select 1st tab by default
 </script>
	</head>
    <body alink="blue" vlink="blue">
  <a href="index.php"><font align="right">Homepage</font></a>
   <div id="ddtabs1" class="basictab"> 
<ul class="basictab">
<li onclick="review()"><a href="" rel="book"><img src="images/book.png" width="50" height="50"/>BOOKS</a></li>
<li><a href="" rel="movie"><img src="images/movie.jpg" width="50" height="50"/>MOVIES</a></li>
<li class="selected"><a href="" rel="rest"><img src="images/restaurant.png" width="50" height="50"/>RESTAURANTS</a></li>
<li><a href="" rel="tech"><img src="images/tech.png" width="50" height="50"/>TECHNOLOGY</a></li>
</ul>
 </div>
        <br/>
 <?	
			$connection = pg_connect("host=dbteach port=5432 dbname=facebook user=mmk066 password=carowihe");
			if (!$connection) 
			{
					echo 'Error occured';
					die('Could not open connection to database server');
			} else {

				$query = "SELECT * FROM bookreview where userid = '" . $_SESSION['userid'] . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));?>
               <DIV class="tabcontainer">
			   <div id="book" class="tabcontent">
				<div  id="text">
				<div id="heading" style="background:#999; color:white;"><img src="images/book.png" width="50" height="50"/><b>MY BOOK REVIEWS</b></div>
				<? while ($myrow = pg_fetch_assoc($result)) {
				?>
			   <table width="700" cellpadding="0" cellspacing="0">		
				<tr bgcolor="#333333">
					<td width="200" bgcolor="#AFC7C7"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>	
					<td width="400" align="right" ><input type="hidden" value="bookreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
					<button onclick="deleterev(this.value)" value="<? echo $myrow['id']; ?>" align="right" ><img src="images/delete.png" width="15" height="15" title="delete review"  align="right" hspace="5"/>
					</button>
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
    <?         } //end of book query while
	?>
		</div>
</div>

<div id="movie" class="tabcontent">
<div id="text">
	<div id="heading" style="background:#999; color:white;"><img src="images/movie.jpg" width="50" height="50" /> <b>MY MOVIE REVIEWS</b></div>
	<?		    $query = "SELECT * FROM moviereview where userid = '" . $_SESSION['userid'] . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
       
                while ($myrow = pg_fetch_assoc($result)) {
	?>
	
			<table width="700" cellpadding="0" cellspacing="0">
		

			<tr bgcolor="#333333">
			<td bgcolor="	 #B4CFEC" width="150"><text> <b>Title:</b><? echo "  ".$myrow['title']; ?></text></td>
			<td width="550" align="right" ><input type="hidden" value="moviereview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<button onclick="deleterev(this.value)" value="<? echo $myrow['id']; ?>" align="right" ><img src="images/delete.png" width="15" height="15" title="delete review" hspace="5"/>
				</button>
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
	
	?>
	</div>
</div>

<div id="rest" class="tabcontent">
<div id="text">
<div id="heading" style="background:#999; color:white;"><img src="images/restaurant.png" width="50" height="50"/><b>MY RESTAURANT REVIEWS</b></div>
				<? $query = "SELECT * FROM resreview where userid = '" . $_SESSION['userid'] . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
       

				 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table cellpadding="0" cellspacing="0">
			
			<tr>  
				<td width="350"></td>
				
			</tr>
			<tr bgcolor="#333333">
				<td width="100" bgcolor="#EDDA74"><text> <b>Name:</b><? echo "  ".$myrow['name']; ?></text></td>	
				<td width="100" align="right">
				<input type="hidden" value="resreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<button onclick="deleterev(this.value)" value="<? echo $myrow['id']; ?>" align="right" ><img src="images/delete.png" width="15" height="15" title="delete review"  align="right" hspace="5"/>
				</button>

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
	?>
	</div>
</div>

<div id="tech" class="tabcontent">
<div id="text">
		<div id="heading" style="background:#999; color:white;"><img src="images/tech.png" width="50" height="50"/><b>MY TECH REVIEWS</b></div>
				<?  $query = "SELECT * FROM techreview where userid = '" . $_SESSION['userid'] . "' ORDER BY time DESC";
				$result = pg_query($connection, $query) or die("Error in query: $query. " . pg_last_error($connection));
    

				 while ($myrow = pg_fetch_assoc($result)) {
				?>
			<table width="700" cellpadding="0" cellspacing="0">
		
			<tr bgcolor="#333333">
				<td width="150" bgcolor="#6CC417"><text> <b>Model No.:</b><? echo "  ".$myrow['model']; ?></text></td>	
				<td width="550" align="right">
				<input type="hidden" value="techreview" name="<? echo $myrow['id']; ?>" id="<? echo $myrow['id']; ?>"/>
				<button onclick="deleterev(this.value)" value="<? echo $myrow['id']; ?>" align="right" ><img src="images/delete.png" width="15" height="15" title="delete review"  align="right" hspace="5"/>
				</button>

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
	} //end of connection else
	?>
	</div>
 

</div>
</DIV>
    </body>
</html>
