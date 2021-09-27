<?php 
	include 'config.php';

	if (isset($_GET['comp_id']) && $_GET['partner_id'] && isset($_GET['athlete_id'])){
		$competitionID = $_GET['comp_id'];
		$partnerID = $_GET['partner_id'];
		$athlete_id = $_GET['athlete_id'];
		$sql = "SELECT events.name as event_name,events.id as event_id
				FROM competitions
				JOIN events ON events.competition_id = competitions.id
				WHERE competitions.id = $1";
		$result = pg_query_params($dbconn, $sql, [$competitionID]);
		$number_events = pg_num_rows($result);
		$events = pg_fetch_all($result);
	}else{
		exit;
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
		
     <form class = "form" action="check_scores.php" method="POST">

     	<h2 name = number_events value = $<?php echo $number_events; ?>>FILL SCORES</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Event</label>
     	<select name="event_id">  
     	<?php for ($i =0 ;$i<$number_events ; $i++) {?>
     			<option value="<?php echo $events[$i]['event_id']?>"><?php echo $events[$i]['event_name']; ?></option>
          <?php }?>
          </select><br>
          <label>Reps</label>  
            <input type="number" 
            		  min = 0
                      name="number_reps" 
                      placeholder="Number of reps"><br>

           <label>Finish Time</label>
               <input type="time" 
                      name="finish_time" 
                      placeholder="Finish Time"><br>

      		<label>Best Set Time </label>
               <input type="time" 
                      name="best_set_time" 
                      placeholder="Best Set Time"><br>
          
     		
     	<button  type="submit" name="infos" value="<?php echo $competitionID."AND".$partnerID."AND".$athlete_id; ?>">ADD</button>
          
     </form>
     
</body>
</html>