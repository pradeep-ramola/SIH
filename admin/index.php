<?php
session_start();
require('connection.php');
  if (isset($_POST['username']) and isset($_POST['password'])){
     $username = $_POST['username'];
    $password = $_POST['password'];
     $query = "SELECT * FROM `user_info` WHERE username='$username' and password='$password'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
     if ($count == 1){
        $_SESSION['username'] = $username;
    }else{
         $fmsg = "Invalid Login Credentials.";
    }
}
 if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    include 'afterlogin.php';
}else{
     echo "<script> location.href='../login.php'; </script>";

}?>