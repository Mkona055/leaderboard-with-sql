<?php
include 'config.php';
$partnerId = $_GET["identifier"];
if(!authenticate($partnerId,$dbconn)){
  header('HTTP/1.0 401');
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome Partner</title>
	 <style>  
  
         .logo_mefit {  
            display: block;
  			margin-left: auto;
  			margin-right: auto;
  			width: 40%;  
         } 
      
         .btn1{
         
         	margin-left: auto;
  			margin-right: auto;
  			width: 50%;
         }
         .btn2{
         	
         	margin-left: auto;
  			margin-right: auto;
  			width: 50%;
         }
         .btn3{
         
         	margin-left: auto;
  			margin-right: auto;
  			width: 50%;
         }
         .form{
         	text-align: center;
         }
         
      </style>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
		<img class="logo_mefit" src="logo_mefit.png" alt="logo">
		
	<form class="form" action="organize_comp.php" method="GET">
		<button class="btn3"  name="identifier" value="<?php echo $partnerId; ?>"><h3>create/see competitions</h3></button>
	</form>
	<form class="form" action="register.php" method="GET">
		<button class="btn1"  name="identifier" value="<?php echo $partnerId; ?>"><h3>register athletes/fill scores</h3></button>
  	<br>
  	<br>
    <br>
    <a href="index.php">
    <text ><h4>Logout</h4></text>
    </a><br>
  </form>
</body>
</html>

