<?php
include 'config.php';
if (!isset($_GET["id"])) {
	$sql = 'SELECT * FROM partners ';
	$partnerInfo = pg_query($dbconn, $sql);
	
}else{
	$partnerId = $_GET["id"];
	$sql = 'SELECT * FROM partners WHERE identifier = $1';
	$partnerInfo = pg_query_params($dbconn, $sql, [$partnerId]);
	}

$search="";
if(isset($_POST["search"])){
  $search = $_POST["search"];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>partners information</title>
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
	 <!-- to make it looking good im using bootstrap -->
	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<img class="logo_mefit" src="logo_mefit.png" alt="logo">
		<h2 class="header">Partners information</h2>
		<form class="form" method="post" >
      <input type= search name = search placeholder="Enter the name of the company ">
      <button class= submit type="submit">search</button>
    </form>
<table class="table">
	<thead>
		<tr>
		<th>representative</th>
		<th>company_name</th>
		<th>contacts</th>
		<th>location</th>
		<th>competitions organized</th>
	
	</tr>
	</thead>
	<tbody>
		<?php
		while($partner = pg_fetch_assoc($partnerInfo)){
			$v ="";
			if(!empty($search)){
	            if($partner['company_name'] != $search){
	              $v='visibility:collapse';
	            }else{
	              $v='';
	            }
            }

			?>
			<tr style='<?php echo $v?>'>
			<td><?php echo $partner['representative']; ?> </td>
			<td><?php echo $partner['company_name']; ?> </td>
			<td><?php echo $partner['email']."<br>".$partner['phone_number']; ?></td>
			<td><?php echo $partner['address'].", ".$partner['city']; ?> </td>
			<td>
			<?php 
			$sql = 'SELECT competitions.identifier as c_identifier, competitions.name as c_name FROM partners JOIN competitions ON competitions.partner_id = partners.id WHERE partners.identifier = $1';
				$partAndComp = pg_query_params($dbconn, $sql, [$partner['identifier']]);

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
      <a href="index.php">
      <text style="text-align: center"><h4>Main Page</h4></text>
      </a><br>

</body>
</html>

