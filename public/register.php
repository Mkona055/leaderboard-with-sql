<?php
include 'config.php';

if (!isset($_GET["identifier"])) {
    header('Location: index.php');
    exit;
}
$partnerID = $_GET["identifier"];
$sql = 'SELECT DISTINCT athlete.id as athlete_id,athlete.name as athlete, athlete.identifier as a_identifier,nationality,athlete.email as email,EXTRACT(year from age( date_of_birth)) as age, gender
      FROM register 
      JOIN competitions ON competitions.id = register.competition_id 
      JOIN athlete ON athlete.id = register.athlete_id
      JOIN partners ON partners.id = competitions.partner_id
      WHERE partners.identifier = $1 ';
      
$filter ='';
$search='';
if (isset($_POST['filter'])){
  $filter = $_POST['filter'];
  if($filter== 'nationality ASC'){
    $sql = $sql."ORDER BY nationality ASC";
  }else if ($filter== 'name ASC'){
    $sql = $sql."ORDER BY athlete ASC";
  }
}

if (isset($_POST['search'])){
  $search = $_POST['search'];
}

$partAndAth = pg_query_params($dbconn, $sql, [$partnerID]);

$sql = 'SELECT competitions.id as comp_id, competitions.identifier as c_identifier, competitions.name as c_name FROM partners JOIN competitions ON competitions.partner_id = partners.id WHERE partners.identifier = $1';
$partAndComp = pg_query_params($dbconn, $sql, [$partnerID]);
$compsCreated = pg_fetch_all($partAndComp);
$numCompetitions = pg_num_rows($partAndComp);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Athlete Registrations</title>
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
		
     <form class = "form" action="check_athlete.php" method="POST">

     	<h2>REGISTER ATHLETES</h2>

       <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <label>Name</label>
          <?php if (isset($_GET['athlete'])) { ?>
               <input type="text" 
                      name="athlete" 
                      placeholder="Name"
                      value="<?php echo $_GET['athlete']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="athlete" 
                      placeholder="athlete"
                      required=""><br>
          <?php }?>

          <label>Date Of Birth</label>
          <?php if (isset($_GET['date_of_birth'])) { ?>
               <input type="date" 
                      name="date_of_birth" 
                      placeholder="Date Of Birth"
                      value="<?php echo $_GET['date_of_birth']; ?>"
                      required><br>
          <?php }else{ ?>
               <input type="date" 
                      name="date_of_birth" 
                      placeholder="Date Of Birth"
                      required><br>
          <?php }?>

           <label>Sex</label>
          <select name="sex" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select><br>
          <label>Identified gender</label>
          <select name="gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select><br>
        
          <label>Email</label>
          <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="email"
                      value="<?php echo $_GET['email']; ?>"><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder=" email"><br>
          <?php }?>
          <label>Nationality</label>
          <?php if (isset($_GET['nationality'])) { ?>
               <input type="text" 
                      name="nationality" 
                      placeholder="nationality"
                      value="<?php echo $_GET['nationality']; ?>"
                      required ><br>
          <?php }else{ ?>
               <input type="text"  
		               	name="nationality" 
		               	placeholder="nationality"
		               	required><br>
          <?php }?>
          <label>Register in</label>
          <select name="competition_id">
            <?php for ($i =0 ;$i<$numCompetitions ; $i++) {?>
              <option value="<?php echo $compsCreated[$i]['comp_id']?>"><?php echo $compsCreated[$i]['c_name']?></h3>
              <?php } ?>
          </select>

     	<button  type="submit" name="identifier" value="<?php echo $partnerID; ?>">Register</button>
          
     </form>
     <br>
     <h2>ATHLETES REGISTERED</h2>
     <form class="form" method="POST">
     <select class=filter name="filter">
      <option>-Select-</option>
      <option value="nationality ASC">nationality ASC</option>
      <option value="name ASC">name ASC</option>
      <option value="male">male</option>
      <option value="female">female</option>
    </select>
    <input type= search name = search placeholder="Enter the full name ">
    <button class= submit type="submit">filter</button>
  </form>
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
	    $num_row = pg_num_rows($partAndAth);
	      if ($num_row > 0) {
	        //output data of each row
	        while ($athlete = pg_fetch_assoc($partAndAth)) {
            if($filter == 'male'){
            if($athlete['gender'] == 'F'){
              $v = 'visibility:collapse';
            }else{
              $v='';
            }
          }else if($filter == 'female'){
              if($athlete['gender'] == 'M'){
                $v = 'visibility:collapse';
              }else{
                $v = '';
              }
          }else{
              $v = '';
          }
          if(!empty($search)){
            if($athlete['athlete'] != $search){
              $v='visibility:collapse';
            }else{
              $v='';
            }
          }
          ?>
	    

	          <tr style='<?php echo $v?>'>
	          <td><?php echo $athlete['athlete']."<br>".$athlete['gender']."/".$athlete['age']; ?></a></td>
	          <td><?php echo $athlete['nationality']; ?></td>
	          <td><?php echo $athlete['email']; ?></td> 
            <td>
              <?php 
              $sql = 'SELECT competitions.id as comp_id, competitions.name as c_name FROM register 
              JOIN competitions ON competitions.id = register.competition_id 
              JOIN athlete ON athlete.id = register.athlete_id
              JOIN partners ON partners.id = competitions.partner_id
              WHERE partners.identifier = $1 AND athlete.identifier = $2';
              
              $athleteAndComp = pg_query_params($dbconn, $sql, [$partnerID,$athlete['a_identifier']]);

              while ($row = pg_fetch_assoc($athleteAndComp)){?>
                <a href="scores.php?comp_id=<?php echo $row['comp_id'] ?>&partner_id=<?php echo $partnerID ?>&athlete_id=<?php echo $athlete['athlete_id'] ?>"><?php echo $row['c_name']."<br>" ; ?></a>

              <?php   
              } 
          }

            ?>
      
            </td>
            </tr>
        <?php   
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