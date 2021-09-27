<?php

include 'config.php';
$sql = 'SELECT name, identifier,nationality,email,EXTRACT(year from age(date_of_birth))as age,sex FROM athlete ';


$filter ='';
$search='';
if (isset($_POST['filter'])){
  $filter = $_POST['filter'];
  if($filter== 'nationality ASC'){
  	$sql = $sql."ORDER BY nationality ASC";
  }else if ($filter== 'name ASC'){
  	$sql = $sql."ORDER BY name ASC";
  }
}

if (isset($_POST['search'])){
  $search = $_POST['search'];
}

$athleteInfo = pg_query($dbconn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>athletes information</title>
	<style>  
  
         .logo_mefit {  
            display: block;
  			margin-left: auto;
  			margin-right: auto;
  			width: 30%;  
         } 
         .header{
         	text-align: center;
         
         } 
      </style>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<img class="logo_mefit" src="logo_mefit.png" alt="logo">
		<h1 class="header">ATHLETES</h1>
		<form class="form" method="POST">
    <select class=filter name="filter">
      <option>-Select-</option>
      <option value="nationality ASC">nationality ASC</option>
      <option value="name ASC">name ASC</option>
      <option value="male">male</option>
      <option value="female">female</option>
    </select>
    <input type= search name = search placeholder="Enter the full name of the athlete ">
    <button class= submit type="submit">filter</button>
<table class="table">
	<thead>
		<tr>
		<th>athlete</th>
		<th>nationality</th>
		<th>email</th>
		<th>registered in</th> 
	
	</tr>
	</thead>
	<tbody>
		<?php
		while($athlete = pg_fetch_assoc($athleteInfo)){
			if($filter == 'male'){
		        if($athlete['sex'] == 'F'){
		          $v = 'visibility:collapse';
		        }else{
		          $v='';
		        }
		    }else if($filter == 'female'){
		        if($athlete['sex'] == 'M'){
		          $v = 'visibility:collapse';
		        }else{
		          $v = '';
		        }
		    }else{
		        $v = '';
		    }

		      if(!empty($search)){
		        if($athlete['name'] != $search){
		          $v='visibility:collapse';
		        }else{
		          $v='';
		        }
		      }?>
			<tr style='<?php echo $v?>'>
			<td><?php echo $athlete['name']."<br>".$athlete['sex']."/".$athlete['age']; ?> </td>
			<td><?php echo $athlete['nationality']; ?> </td>
			<td><?php echo $athlete['email']; ?></td>
			<td>
			<?php 
			$sql = 'SELECT competitions.identifier as c_identifier, competitions.name as c_name FROM register 
			JOIN competitions ON competitions.id = register.competition_id 
			JOIN athlete ON athlete.id = register.athlete_id
			WHERE athlete.identifier = $1';
				$partAndComp = pg_query_params($dbconn, $sql, [$athlete['identifier']]);

			while ($row = pg_fetch_assoc($partAndComp)){?>
				<a href="leaderboard.php?id=<?php echo $row['c_identifier'] ?>"><?php echo $row['c_name']."<br>" ?></a>

		<?php		
			}	
		}
		?>
			
				</td>
				</tr>
	</tbody>
</table>
<br>
	<br>
  	<br>
    <form class="form">
	    <a href="index.php">
	    <text style="text-align: center" ><h4>Main Page</h4></text>
	    </a><br>
  	</form>

</body>
</html>

