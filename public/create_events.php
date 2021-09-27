<?php
if (isset($_GET["id"])&& isset($_GET["number_events"])&& isset($_GET["identifier"])){
	$compet_id = $_GET["id"];
	$number_events = $_GET["number_events"];
	$partnerId = $_GET["identifier"];
}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Events Creation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
	<style>  
  
         .logo_mefit {  
            display: block;
  			margin-left: auto;
  			margin-right: auto;
  			width: 30%;  
         } 
         .error {
		   background: #F2DEDE;
		   color: #A94442;
		   padding: 10px;
		   width: 95%;
		   border-radius: 5px;
		   margin: 20px auto;
		}
		
    </style>
    <div class="container">
    <img class="logo_mefit" src="logo_mefit.png" alt="logo">
		
     <form class = "form" action="check_events.php" method="GET">

     	<h2 name = number_events value = $<?php echo $number_events; ?>>CREATE EVENTS</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php for ($i =1 ;$i<=$number_events ; $i++) {?>
     		<h3>Event #<?php echo $i?></h3>
     		<label>Name</label>
          <?php if (isset($_GET['name'.$i])) { ?>
               <input type="text" 
                      name="name<?php echo $i?>" 
                      placeholder="Name"
                      value="<?php echo $_GET['name'.$i]; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name<?php echo $i?>" 
                      placeholder="Name" required><br>
          <?php }?>

          <label>Date</label>  
            <input type="date" 
                      name="event_date<?php echo $i?>" 
                      placeholder="Date"><br>

           <label>Primary Score</label>
               <select name="primary_score<?php echo $i?>">
               	<option value = "Time ASC">Time ASC</option>
               	<option value="Time DESC">Time DESC</option>
               	<option value = "Count ASC">Count ASC</option>
               	<option value = "Count DESC">Count DESC</option>
               </select><br>
      		<label>Primary Tie-Break Score </label>
               <select name="primary_score_tb<?php echo $i?>">
               	<option value = "Time ASC">Time ASC</option>
               	<option value="Time DESC">Time DESC</option>
               	<option value = "Count ASC">Count ASC</option>
               	<option value = "Count DESC">Count DESC</option>
               	<option value = "NULL">NULL</option>
               </select> <br>
            <label>TimeCap Score</label>
               <select name="time_cap<?php echo $i?>">
               	<option value = "Time ASC">Time ASC</option>
               	<option value="Time DESC">Time DESC</option>
               	<option value = "Count ASC">Count ASC</option>
               	<option value = "Count DESC">Count DESC</option>
               	<option value = "NULL">NULL</option>
               </select> <br>
            <label>TimeCap Tie-Break Score</label>
               <select name="time_cap_tb<?php echo $i?>">
               	<option value = "Time ASC">Time ASC</option>
               	<option value="Time DESC">Time DESC</option>
               	<option value = "Count ASC">Count ASC</option>
               	<option value = "Count DESC">Count DESC</option>
               	<option value = "NULL">NULL</option>
               </select> <br>

		<?php } ?>
     		
     	<button  type="submit" name="infos" value="<?php echo $compet_id."AND".$partnerId."AND".$number_events; ?>">create</button>
          
     </form>
     
</body>
</html>