<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<section>
<nav class="navbar navbar-inverse" style="width: 100vmax;">
  <div class="container">
     
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <form id="searchForm" class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" id="myInput" class="form-control" placeholder="Search" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="button" onclick="myFunction()">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>

     <ul class="nav navbar-nav navbar-right">
     <li><a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span><b><?php echo  $_SESSION['username'] ;?></b></a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav></section>

</body>



<script>
   function myFunction(){
    var input, filter, tr, td, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    td = document.getElementsByTagName("td");
    for(i=0;i<td;i++){
      a = td[i].innerHTML;
      if(a.innerHTML.toUpperCase().indexOf(filter) > -1){
        td[i].style.display = "";
      } else{
        td[i].style.display = "none";
      }

    }
   }

</script>
</html>

