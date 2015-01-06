<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
 background-image:url(images/background.jpg);
}
#left_content h1 strong {
    font-family: Comic Sans MS, cursive;
}

a{

color:white;

}
h2
{
 color:black;
 font-family:times new roman;
}


-->
</style>
<script type="text/javascript">
function display(text)
{
 document.getElementById('right_content').innerHTML="<br/><font size='2' bgcolor='#003' color='white'>"+text+"</font>";
}

</script>
</head>

<body>
<div id="header"><img src="images/bubble.jpg" width="220" height="150" alt="Img unavailable" align="left"/><img src="images/header.jpg" alt="Img Unavailable" width="530" height="150" align="right"/></div>
   <ul id="navigation">
			<li><a href="index.php">Homepage</a></li>
            <li><a href="my_posts.php">My Posts</a></li>
            <li><a href="home.php">My Feed</a></li>
            <li><a href="search.php">Search</a></li>
          
         
        </ul>

        <br/><br/>
 <div id="content_wrap">
 <div id="left_content"> 

 <ul id="submenu">
  Pick a category from one of the following:
 <li onmouseout="display('')"><a href="bookreview.html"  onmouseover="display('Add a review for a Book. Its easy.Type the book title and let Google Book Search find the book details for you. Add your review and rating and hit SUBMIT to share with iThink users and friends.')"><img src="images/book.png" width="50" align="right" height="50"/> BOOKS</a></li>
  <li><a href="moviereview.html" onmouseout="display('')" onmouseover="display('Add a review for a movie. Simply type the movie name, add your review and rating and a small image poster if you like and hit SUBMIT to share with iThink users and friends.')"><img  src="images/movie.jpg" width="50" align="right" height="50" /> MOVIES</a></li>
   <li><a href="resreview.html"onmouseout="display('')" onmouseover="display('Add a review for a Restaurant. Type the name and address and click on LOCATE on map.Google will find the location for you. Add your review and rating and hit SUBMIT to share with iThink users and friends.')"><img src="images/restaurant.png" width="50" align="right" height="50" /> RESTAURANTS</a></li>
    <li><a href="techreview.html" onmouseout="display('')" onmouseover="display('Add a review for an electronic gadget.Write your review and rating and a small thumbnail image if you like and hit SUBMIT to share with iThink users and friends.')"><img src="images/tech.png" width="50" align="right" height="50" /> TECHNOLOGY</a></li>
 </ul>
 </div>
 <div id="right_content">
 </div>
 </div>
</body>

</html>