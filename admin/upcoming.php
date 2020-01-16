<?php
session_start();
if($_SESSION['username']){?>

<?php 
require('connection.php');

?>


<html>
<head>
 <script>
   function submit(){
document.getElementById("theForm").submit();
}

 </script>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
  
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
  
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Admin Panel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="http://bio.mq.edu.au/Tools/jquery/plugins/riklomas-quicksearch/jquery.quicksearch.js"></script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>  






  <script>
   var TRange=null;

function findString () {
  var str=document.getElementById('searcher').value;
 if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  // CODE FOR BROWSERS THAT SUPPORT window.find

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1);
   while (self.find(str,0,1)) continue;
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

  // EXPLORER-SPECIFIC CODE

  if (TRange!=null) {
   TRange.collapse(false);
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange();
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera browsers not supported, sorry...")
  return;
 }
 if (!strFound) alert ("String '"+str+"' not found!")
 return;
}
  </script>
  
	
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  

<link rel="stylesheet" href="css/style.css">




</head>
<body>
	



<br>
<section>
<nav class="navbar navbar-inverse" style="width: 100vmax;">
  <div class="container">
     
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      
      <li><a href="filter.php">Filter Based Search</a></li>
      <li class="active"><a href="#">Upcoming Events</a></li>
      <li><a href="userinfo.php">User Info</a></li>
      <li><a href="mail.php">Mail</a></li>
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
  <form class="form-horizontal" method="POST" id="theForm">
    <div class="form-group" style="margin: 0 auto;">
      
      <label class="control-label col-sm-2" for="Days">Day Interval: </label>
      <div class="col-sm-6">
        <select name="days" onchange="submit();">
          <option selected="selected" disabled="">select</option>
      <option value="1">1 Day</option>
      <option value="7">A Week</option>
      <option value="15">A Fortnight</option>

    </select>
      
 </div></div>
  </form>
</div>


<?php

if(!isset($_POST['days'])){

$day_int = 1;
  }
if(isset($_POST['days'])){
$day = $_POST['days'];
$day_int = (int)$day;
}
?>


<div class="container" id="beauty">


<h1><b><center>Upcoming Cases</center></b></h1>
<h4><i><center><?php echo "Day Interval: ".$day_int." days" ?></center> </i></h4>
<hr style="color:black;">


<table border=1 style="color: black; padding: 1em;">
  <tr>
    <th style="padding: 1em;">File Number</th>
    <th style="padding: 1em;">Proceeding Number</th>
    <th style="padding: 1em;">Next Hearing On (YYYY-MM-DD)</th>
    <th style="padding: 1em;">Lawyer</th>
    

  </tr>
<?php





$sql = "SELECT file_number, next_hearing_on, lawyer, proceeding_number FROM latest_proceeding natural join case_info WHERE next_hearing_on <= (DATE_ADD(CURRENT_DATE,INTERVAL + $day_int DAY)) and next_hearing_on >= CURDATE()";

$result = $connection->query($sql);


if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()){

    ?>
    <tr>
      <td style="padding: 1em;">
        <?php echo $row['file_number']; ?>
      </td>
      <td style="padding: 1em;">
        <?php echo $row['proceeding_number']; ?>
      </td>
      <td style="padding: 1em;">
        
        <?php echo $row['next_hearing_on']; ?>
      </td>
      <td style="padding: 1em;">
        
        <?php echo $row['lawyer']; ?>
      </td>
    </tr>
    
  <?php
}}

?>
  




</div>
</body>
</html>

<?php
}
else{
  header("location:index.php");
}
?>