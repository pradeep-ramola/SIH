<!DOCTYPE html>
<html>
<head>
    <title>Pradeep Project</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
<body>

 
 
<header class="main">
    <h1> Login</h1>
</header>

<section class="main" id="back">
    <section id="login">
    <h3> Enter details to login</h3>
        <form method="POST" action=" ">
            <input type="text" name="username" placeholder="Enter your username" required><br><br>
            <input type="password" name="password" placeholder="Enter password" required><br><br>
            <input type="submit" value="submit" id="button">
        </form>
        <a href="register.php">Already have a account  ?</a>
    </section>
</section>

 
</center>
<?php
session_start();
error_reporting(0);
require('connection.php');
  if (isset($_POST['username']) and isset($_POST['password'])){
     $username = $_POST['username'];
    $password = $_POST['password'];
     $query = "SELECT * FROM `user_info` WHERE username='$username' and password='$password'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
       
        $_SESSION['user_type']=$row['user_type'];
        }
     if ($count == 1){
        $_SESSION['username'] = $username;
    }else{
         $fmsg = "Invalid Login Credentials.";
         echo $fmsg;
         exit;
    }
}
 if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    if($_SESSION['user_type']=="client"){
        echo "<script> location.href='logout.php'; </script>";
        exit;
    }
    if($_SESSION['user_type']=="admin")
    {
        echo "<script> location.href='admin/afterlogin.php'; </script>";
        exit;
    }
     

}
?>
</body>
</html>