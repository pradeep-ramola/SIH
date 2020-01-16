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

<?php
    include 'nav/nav.php';
?>

<center>
<nav id="nav">
<img src="img/COA.png" height="100rem" id="logo" />
</nav>
<header class="main">
    <h1>E- Court Case Management System</h1>
</header>

<section class="main" id="back">
    <section id="login">
    <h3> Enter details to login</h3>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Enter your username" required><br>
            <input type="password" name="password" placeholder="Enter password" required><br>
            <input type="submit" value="submit" id="button">
        </form>
    </section>
</section>

<?php
include 'footer.php';
?>
</center>
</body>
</html>