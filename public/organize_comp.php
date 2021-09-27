<?php
include 'config.php';
if (!isset($_GET["identifier"])) {
    header('Location: index.php');
    exit;
}
$partnerID = $_GET["identifier"];
$sql = 'SELECT * FROM partners_competition_view WHERE p_identifier = $1';
$partAndComp = pg_query_params($dbconn, $sql, [$partnerID]);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Competition Viewer</title>
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
      .success {
       background: #D4EDDA;
       color: #40754C;
       padding: 10px;
       width: 95%;
       border-radius: 5px;
       margin: 20px auto;
      }
      .part_space{
        text-align: center;
      }

		
    </style>
    <div class="container">
    <img class="logo_mefit" src="logo_mefit.png" alt="logo">
		
     <form class = "form" action="check_compet.php" method="POST">

     	<h2>CREATE COMPETITION</h2>

       <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      required><br>
          <?php }?>

          <label>Venue</label>
          <?php if (isset($_GET['venue'])) { ?>
               <input type="text" 
                      name="venue" 
                      placeholder="Venue"
                      value="<?php echo $_GET['venue']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="venue" 
                      placeholder="Venue"
                      required><br>
          <?php }?>

           <label>Competition Year</label>
          <?php if (isset($_GET['compet_year'])) { ?>
               <input type="number" 
                      name="compet_year" 
                      placeholder="Competition Year"
                      value="<?php echo $_GET['compet_year']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="number" 
                      name="compet_year" 
                      placeholder="Competition Year"
                      required><br>
          <?php }?>
          <label>Representative</label>
          <?php if (isset($_GET['representative'])) { ?>
               <input type="text" 
                      name="representative" 
                      placeholder="representative name"
                      value="<?php echo $_GET['representative']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="representative" 
                      placeholder="representative name"
                      required><br>
          <?php }?>
          <label>representative email</label>
          <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="representative email"
                      value="<?php echo $_GET['email']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder="representative email"
                      required><br>
          <?php }?>
          <label>Phone Number</label>
          <?php if (isset($_GET['phone_number'])) { ?>
               <input type="tel" 
                      name="phone_number" 
                      placeholder="representative phone number"
                      value="<?php echo $_GET['phone_number']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="tel"  
		               	name="phone_number" 
		               	placeholder="representative phone number"
		               	pattern="[0-9]{10}" required><br>
          <?php }?>

          <label>Start Date</label>
          <?php if (isset($_GET['start_date'])) { ?>
               <input type="date" 
                      name="start_date" 
                      placeholder="Start Date"
                      value="<?php echo $_GET['start_date']; ?>" required><br>
          <?php }else{ ?>
               <input type="date" 
                      name="start_date" 
                      placeholder="Start Date" required><br>
          <?php }?>

          <label>End Date</label>
          <?php if (isset($_GET['end_date'])) { ?>
               <input type="date" 
                      name="end_date" 
                      placeholder="End Date"
                      value="<?php echo $_GET['end_date']; ?>" required><br>
          <?php }else{ ?>
               <input type="date" 
                      name="end_date" 
                      placeholder="End Date" required><br>
          <?php }?>

          <label>Start Time</label>
          <?php if (isset($_GET['start_time'])) { ?>
               <input type="time" 
                      name="start_time" 
                      placeholder="Start Time"
                      value="<?php echo $_GET['start_time']; ?>" required><br>
          <?php }else{ ?>
               <input type="time" 
                      name="start_time" 
                      placeholder="Start Time" required><br>
          <?php }?>

     	<label>Number Of Events</label>
          <?php if (isset($_GET['number_events'])) { ?>
               <input type="number" 
               			min = "0" 
                      name="number_events" 
                      placeholder="Number Of Events"
                      value="<?php echo $_GET['number_events']; ?>" required><br>
          <?php }else{ ?>
               <input type="number"
               			min = "0"  
                      name="number_events" 
                      placeholder="Number Of Events" required><br>
          <?php }?>
          <label>Maximum of athletes</label>
          <?php if (isset($_GET['start_time'])) { ?>
               <input type="number" 
               			min = "0" 
                      name="max_athlete" 
                      placeholder="Maximum of athletes"
                      value="<?php echo $_GET['max_athlete']; ?>" ><br>
          <?php }else{ ?>
               <input type="number"
               		  min = "0" 
                      name="max_athlete" 
                      placeholder="Maximum of athletes" ><br>
          <?php }?>

     	<button  type="submit" name="identifier" value="<?php echo $partnerID; ?>">create</button>
          
     </form>
     <br>
     <h2>COMPETITIONS CREATED</h2>
     <table class="table">
	  <thead>
	    <tr>
	    <th>name</th>
	    <th>venue</th>
	    <th>date</th>
	    <th>time</th>
	    <th>registrations <br>(per gender)</th>
	    <th>total events</th>
	    <th>contacts</th>
	    
	  
	  </tr>
	  </thead>
	  <tbody>
	    <?php
	    $num_row = pg_num_rows($partAndComp);
	      if ($num_row > 0) {
	        //output data of each row
	        while ($row = pg_fetch_assoc($partAndComp)) {
	    ?>

	          <tr>
	          <td><a href="leaderboard.php?id=<?php echo $row['c_identifier'] ?>"><?php echo $row['name'] ?></a></td>
	          <td><?php echo $row['venue']; ?></td>
	          <td><?php echo $row['start_date']."<br>".$row['end_date']; ?></td> 
	          <td><?php echo $row['start_time']; ?></td>
	          <td><?php echo $row['max_athlete']; ?></td>
	          <td><?php echo $row['number_events']; ?></td>
	          <td><?php echo $row['email']."<br>".$row['phone_number']; ?></td>
            <td><a class="btn btn-danger" href="deletecomp.php?id=<?php echo $row['c_identifier'];?>&partnerID=<?php echo $partnerID ?>">Delete</a></td>
	          </tr>

	    <?php   }
	      }
	    ?>

	  </tbody>
</table>
    <br>
     <br>
     <br>
     <form class="form" >
    <a href="partners_space.php?identifier=<?php echo $partnerID ?>">
    <text class ="part_space"><h4>Back to partners space</h4></text>
    </a><br>
  </form>
</body>
</html>