<?php

session_start();
if(isset($_SESSION['username']))
{
  ?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
  <link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="jquery.richtext.js"></script>

	<title>Admin Panel</title>
  
  

  
  

	
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="richtext.min.css">
</head>
<body>
	<section>
<nav class="navbar navbar-inverse" style="width: 100vmax;">
  <div class="container">
    
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      
      <li><a href="#">Filter Based Search</a></li>
      <li><a href="upcoming.php">Upcoming Events</a></li>
      <li><a href="userinfo.php">User Info</a></li>
      <li class="active"><a href="#">Mail</a></li>
    </ul>
    <div id="searchForm" class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" id="searcher" class="form-control" placeholder="Search on this page" name="searcher">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit" onclick="findString();" style="height:2.4em;">
        <i class="glyphicon glyphicon-search"></i>
        </div>
      </div>
    </div>

     <ul class="nav navbar-nav navbar-right">
     <li><a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span><b><?php echo  $_SESSION['username'] ;?></b></a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav></section>

		
<div class="container">
<form style="margin-top: 7%;" action="sendmail.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address (To):</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
  </div>


  <div class="form-group">
    <label for="exampleFormControlInput1">Cc:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="cc">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Subject:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email Subject" name="subject">
  </div>
  
  <div class="form-group page-wrapper box-content">
    <label for="exampleFormControlTextarea1">Body:</label>
    <textarea class="form-control content" id="exampleFormControlTextarea1" rows="5" name="body" placeholder="Email Body"></textarea>
  </div>
          
    <script>
    $('.content').richText();
    </script>

<hr>



<div class="form-group">
    <label for="exampleFormControlInput1">Attachment:</label>
    <input type="file" class="form-control" id="exampleFormControlInput1" name="attachment">
  </div>


  <button type="submit" class="btn btn-default" id="myButton">SEND</button>
</form>
</div>
</body>
</html>


<?php


}else{
   header("location:index.php");
}

?>