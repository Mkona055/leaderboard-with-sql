
<?php
include 'config.php';

function sql($sql, $dbconn = null)
{
  $result = pg_query($dbconn, $sql);
  return $result;
}
$search = "";
if(isset($_POST["search"])){
  $search = $_POST["search"];
}

$competitions = sql("SELECT * FROM competitions_view",$dbconn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>competitions</title>
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
    <h1 class="header">COMPETITONS</h1>
    <form class="form" method="post" >
      <input type= search name = search placeholder="Enter the name of the competition ">
      <button class= submit type="submit">search</button>
      
    </form>
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
    <th>organised by</th>
  
  </tr>
  </thead>
  <tbody>
    <?php
    $num_row = pg_num_rows($competitions);
      if ($num_row > 0) {
        $v='';
        while ($row = pg_fetch_assoc($competitions)) {
          if(!empty($search)){
            if($row['competition'] != $search){
              $v='visibility:collapse';
            }else{
              $v='';
            }
          }
        ?>

          <tr style='<?php echo $v?>'>
          <td><a href="leaderboard.php?id=<?php echo $row['c_identifier'] ?>"><?php echo $row['competition'] ?></a></td>
          <td><?php echo $row['venue']; ?></td>
          <td><?php echo $row['start_date']."<br>".$row['end_date']; ?></td> 
          <td><?php echo $row['start_time']; ?></td>
          <td><?php echo $row['max_athlete']; ?></td>
          <td><?php echo $row['number_events']; ?></td>
          <td><?php echo $row['email']."<br>".$row['phone_number']; ?></td>
          <td><a href="partners.php?id=<?php echo $row['p_identifier']?>"><?php echo $row['company_name']; ?></a></td>
          </tr>

    <?php   }
      }
    ?>

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


