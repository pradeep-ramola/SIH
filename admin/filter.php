<?php
session_start();
if($_SESSION['username']){?>

<?php 
require('connection.php');
$result ='';
  if(isset($_POST['choice'])){

    switch ($_POST['choice']) {
      case 'FileNumber':
        $fileNumber = $_POST['FileNumber'];
        $query = "SELECT file_number, case_type, court_name, lawyer, decision, next_hearing_on FROM `case_info` natural join `latest_proceeding` WHERE file_number = '$fileNumber'";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $count = mysqli_num_rows($result);
        break;

      case 'LawyerName':
        $lawyerName = $_POST['LawyerName'];
        $query = "SELECT file_number, case_type, court_name, lawyer, decision, next_hearing_on FROM `case_info` natural join `latest_proceeding` WHERE lawyer = '$lawyerName'";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $count = mysqli_num_rows($result);
        break;

      case 'CourtName':
        $courtName = $_POST['CourtName'];
        $query = "SELECT file_number, case_type, court_name, lawyer, decision, next_hearing_on FROM `case_info` natural join `latest_proceeding` WHERE court_name = '$courtName'";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $count = mysqli_num_rows($result);
        break;


      case 'Date':
        $sdate = $_POST['SDate'];
        $edate = $_POST['EDate'];
        $query = "SELECT file_number, case_type, court_name, lawyer, decision, next_hearing_on FROM `case_info` natural join `latest_proceeding` WHERE file_number in (SELECT file_number FROM `latest_proceeding` WHERE next_hearing_on >= '$sdate' AND next_hearing_on <= '$edate')";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $count = mysqli_num_rows($result);

        break;


      default:
        $query = "SELECT file_number, case_type, court_name, lawyer, decision, next_hearing_on FROM `case_info` natural join `latest_proceeding`";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
          $count = mysqli_num_rows($result);
        break;
    }
  }
?>


<html>
<head>
  <script src="js/snack.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
  
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Admin Panel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="http://bio.mq.edu.au/Tools/jquery/plugins/riklomas-quicksearch/jquery.quicksearch.js"></script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>  


<script type="text/javascript">
$(function() {
  
  //autocomplete
  $(".file").autocomplete({
    source: "search_file.php",
    minLength: 1
  });
  //autocomplete
  $(".lawyer").autocomplete({
    source: "search_lawyer.php",
    minLength: 1
  });
  //autocomplete
  $(".court").autocomplete({
    source: "search_court.php",
    minLength: 1
  });       

});
</script>




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
<nav class="navbar navbar-inverse" style="width: 100vmax;">
  <div class="container">
    <!-- <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div> -->
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      
      <li class="active"><a href="#">Filter Based Search</a></li>
      <li><a href="upcoming.php">Upcoming Events</a></li>
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
  <h2 style="color: white;">Search with Filters</h2>
  <form class="form-horizontal" action="filter.php" method="POST">
    <div class="form-group">
      <div class="col-sm-2"></div>
      <label class="control-label col-sm-2" for="FileNumber">File Number: &nbsp;<input type="radio" name="choice" value="FileNumber" checked="checked" <?php if(isset($_POST['choice'])) {if($_POST['choice'] == 'FileNumber')  echo "checked = \"checked\""; }?>></label>
      <div class="col-sm-6">
        <input type="text" class="form-control file" id="FileNumber" placeholder="Enter File Number" name="FileNumber">
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <div class="col-sm-2"></div>
      <label class="control-label col-sm-2" for="Lawyer">Lawyer Name: <input type="radio" name="choice" value="LawyerName" <?php if(isset($_POST['choice'])) {if($_POST['choice'] == 'LawyerName')  echo "checked = \"checked\""; }?>></label>
      <div class="col-sm-6">          
        <input type="text" class="form-control lawyer" id="Lawyer" placeholder="Enter Lawyer Name" name="LawyerName">
      </div>
      <div class="col-sm-2"></div>
    </div>

    <div class="form-group">
      <div class="col-sm-2"></div>
      <label class="control-label col-sm-2" for="CourtName">Court Name: &nbsp;&nbsp;<input type="radio" name="choice" value="CourtName" <?php if(isset($_POST['choice'])) {if($_POST['choice'] == 'CourtName')  echo "checked = \"checked\""; }?>></label>
      <div class="col-sm-6">          
        <input type="text" class="form-control court" id="CourtName" placeholder="Enter Court Name" name="CourtName">
      </div>
      <div class="col-sm-2"></div>
    </div>

    <div class="form-group">
      <div class="col-sm-2"></div>
      <label class="control-label col-sm-2" for="Date">Next Hearing<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Between: <input type="radio" name="choice" value="Date" <?php if(isset($_POST['choice'])) {if($_POST['choice'] == 'Date')  echo "checked = \"checked\""; }?>></label>
      <div class="col-sm-3">          
        <input type="date" class="form-control" id="SDate" placeholder="Enter Starting Date" name="SDate">
      </div> -
       <div class="col-sm-3">          
        <input type="date" class="form-control" id="EDate" placeholder="Enter Ending Date" name="EDate">
      </div>
      <div class="col-sm-2"></div>
    </div>





    <div class="form-group">      
    <div class="col-sm-3"></div>  
      <div class="col-sm-offset-2 col-sm-4">
        <button type="submit" class="btn btn-default" id="myButton">Submit</button>
        <div class="col-sm-4"></div>
      </div>
    </div>
  </form> 
</div>

<div class="container" style="background-color: rgba(255,255,255,0.5); border-radius: 1%; box-shadow: 2px 2px 5px black;">
  <div class="row">
<div id="myDiv alt-table-responsive">
   <?php
   if($result != ''){
   ?>

   <table style="margin: 0 auto; color: black; margin-bottom: 2%; margin-top:1%;" border="1" bordercolor="black">

    <caption id="cap"> Search Results for: <b><?php echo $_POST['choice'];?></b></caption>
  <thead>
    <tr>
      <th style="padding:1%;">File Number</th>
      <th style="padding:1%;">Case Type</th>
      <th style="padding:1%;">Court Name</th>
      <th style="padding:1%;">Layer</th>
      <th style="padding:1%;">Decision</th>
      <th style="padding:1%;">Next Hearing On (YYYY-MM-DD)</th>
    </tr>
  </thead>
  <tbody>
<?php
while($row = mysqli_fetch_array($result))
{?>
  <tr>
    <td style="padding:1%;"> <?php echo "<a href=\"report.php?fileNumber=".$row['file_number']."\" target=\"_blank\">".$row['file_number']."</a>";?> </td>
    <td style="padding:1%;"> <?php echo $row['case_type']; ?> </td>
    <td style="padding:1%;"> <?php echo $row['court_name']; ?> </td>
    <td style="padding:1%;"> <?php echo $row['lawyer']; ?> </td>
    <td style="padding:1%;"> <?php echo $row['decision']; ?> </td>
    <td style="padding:1%;"> <?php if($row['decision'] == "FINAL JUDGEMENT"){echo "N/A";}else{echo $row['next_hearing_on'];} ?> </td> 
  </tr>
<?php
}
?>
  </tbody>
</table>
<?php
}
?>
</div>
</div>
</div>


<script>


$("#myButton").click(function() {
    $('html, body').animate({
        scrollTop: $("#myDiv").offset().top
    }, 2000);
});
</script>





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
