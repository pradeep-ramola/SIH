<?php
session_start();
if($_SESSION['username']){

  ?>
<html>
<head>
  <script type="text/javascript" src="js/snack.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
  <link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Admin Panel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="http://bio.mq.edu.au/Tools/jquery/plugins/riklomas-quicksearch/jquery.quicksearch.js"></script>

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
  






</head>
<body onload="myFunction();">
	



<br>
<section>
<nav class="navbar navbar-inverse" style="max-width: 100%;">
  <div class="container">
    <!-- <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div> -->
    <ul class="nav navbar-nav">
      <li><a href="afterlogin.php">Home</a></li>
      
      <li><a href="filter.php">Filter Based Search</a></li>
      <li><a href="upcoming.php">Upcoming Events</a></li>
      <li class="active"><a href="#">User Info</a></li>
      <li><a href="mail.php">Mail</a></li>
    </ul>
    <div id="searchForm" class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" id="searcher" class="form-control" placeholder="Search on this page" name="searcher">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit" onclick="findString();" style="height: 2.4em;">
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

<div class="container" id="beauty">
  <h2><b><u><center>Status Table</center></u></b></h2><hr>

	<?php

		include 'connection.php';

// 		$connection = new mysqli($host, $username, $password, $db);
// // Check connection
// if ($connection->connect_error) {
//     die("Connection failed: " . $connection->connect_error);
// } 

 $sql = "SELECT * FROM `user_info`";
 $result = $connection->query($sql);

if ($result->num_rows > 0) {
     

  ?>
  <table style="margin: 0 auto; color: black; margin-bottom: 2%;" border="1" bordercolor="black">
        
        <tr style="padding: 2vmax; margin:2vmax;">
          <th style="padding-left: 1vmax; padding-right: 1vmax;">Name</th>
          <th style="padding-left: 1vmax; padding-right: 1vmax;">App Status</th>
          <th style="padding-left: 1vmax; padding-right: 1vmax;">Web Status</th>
          
          
        </tr>


      
      <?php
      $count=1;
    while($row = $result->fetch_assoc()) {
?>
        <tr style="padding: 1%; margin:1%;">
          
        <td style="padding-left: 2vmax; padding-right: 1vmax;"><?php echo $row["username"]; ?></td>
          <td style="padding-left: 2vmax; padding-right: 1vmax;">

            <?php 

          // echo $row["status_app"]; 
            if($row['status_app']=='ONLINE'){

          ?>

          <span style="color: green;">ONLINE</span>

          <?php
        } else{
          ?>
          <span style="color: red;">OFFLINE</span>
          <?php
        }
          ?>
            

          </td>
          <td style="padding-left: 2vmax; padding-right: 1vmax;">

            <?php 

          // echo $row["status_app"]; 
            if($row['status_web']=='ONLINE'){

          ?>

          <span style="color: green;">ONLINE</span>

          <?php
        } else{
          ?>
          <span style="color: red;">OFFLINE</span>
          <?php
        }
          ?>
            

          </td>
         
        </tr>
        <?php
        $count++;
    }
} else {
    echo "0 results";
}

?>
</table>

 
  
</div>





</div>
</div></div>
</div>
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


<!-- Use a button to open the snackbar -->
<!-- <button onclick="myFunction()">Show Snackbar</button> -->

<!-- The actual snackbar -->
<?php
$sql = "SELECT file_number, next_hearing_on, lawyer, proceeding_number FROM latest_proceeding natural join case_info WHERE next_hearing_on <= (DATE_ADD(CURRENT_DATE,INTERVAL + $day_int DAY)) and next_hearing_on >= CURDATE()";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()){

?>


<div id="snackbar">Case of File Number: <?php echo $row['file_number']; ?> appraoching on <?php echo $row['next_hearing_on'];?><br></div>

<?php
}
}else{
  ?>
  <div id="snackbar">No upcoming Cases....<br> Click on <a href="upcoming.php" style="color: aqua;">Upcoming Events </a>to know more.</div>
  <?php
}

?>


</body>
</html>

<?php
}
else{
  header("location:index.php");
}
?>
