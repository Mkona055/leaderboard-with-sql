<?php
include 'config.php';

$filter ='';
$search='';
if (!isset($_GET["id"])) {
    header('Location: index.php');
    exit;
}
if (isset($_POST['filter'])){
  $filter = $_POST['filter'];
}

if (isset($_POST['search'])){
  $search = $_POST['search'];
}

$competitionId = $_GET["id"];
$sql = 'SELECT * FROM competitions WHERE identifier = $1';
$result = pg_query_params($dbconn, $sql, [$competitionId]);
$data = pg_fetch_all($result);

$sql = "SELECT DISTINCT events.name as event, primary_score, primary_score_tb, time_cap, time_cap_tb 
FROM events JOIN competitions ON competition_id = competitions.id WHERE competitions.identifier = $1";
$events = pg_query_params($dbconn, $sql, [$competitionId]);
$eventsData = pg_fetch_all($events);
$eventsNames = pg_fetch_all_columns($events, pg_field_num($events, 'event'));
$eventsPrimary = pg_fetch_all_columns($events, pg_field_num($events, 'primary_score'));
$eventsPrimaryTb = pg_fetch_all_columns($events, pg_field_num($events, 'primary_score_tb'));
$eventsSecondary = pg_fetch_all_columns($events, pg_field_num($events, 'time_cap'));
$eventsSecondaryTb = pg_fetch_all_columns($events, pg_field_num($events, 'time_cap_tb'));



if (empty($data)) {
  $competition = null;
  $scoresArray = array();
} else {
  $competition = $data[0];
  $scoresArray = array();
  
  for ($event = 0; $event < count($eventsData); $event++){

    switch($eventsPrimary[$event]){

      case 'Time ASC':
      $eventPrimary = 'finish_time ASC';
      break;

      case 'Time DESC':
      $eventPrimary = 'finish_time DESC';
      break;

      case 'Count ASC':
      $eventPrimary = 'number_reps ASC';
      break;

      case 'Count DESC':
      $eventPrimary = 'number_reps DESC';
      break;
      default:
      $eventPrimary = "";
    }

      switch($eventsPrimaryTb[$event]){
      case 'Time ASC':
      $eventPrimaryTb = ',finish_time ASC';
      break;

      case 'Time DESC':
      $eventPrimaryTb = ',finish_time DESC';
      break;

      case 'Count ASC':
      $eventPrimaryTb = ',number_reps ASC';
      break;

      case 'Count DESC':
      $eventPrimaryTb = ',number_reps DESC';
      break;

      default:
      $eventPrimaryTb = "";
      break;
    }

      switch($eventsSecondary[$event]){
      case 'Time ASC':
      $eventSecondary = ',finish_time ASC';
      break;

      case 'Time DESC':
      $eventSecondary = ',finish_time DESC';
      break;

      case 'Count ASC':
      $eventSecondary = ',number_reps ASC';
      break;

      case 'Count DESC':
      $eventSecondary = ',number_reps DESC';
      break;

      default:
      $eventSecondary = "";
      break;
    }
      switch($eventsSecondaryTb[$event]){
      case 'Time ASC':
      $eventSecondaryTb = ',best_set_time ASC';
      break;

      case 'Time DESC':
      $eventSecondaryTb = ',best_set_time DESC';
      break;

      case 'Count ASC':
      $eventSecondaryTb = ',number_reps ASC';
      break;

      case 'Count DESC':
      $eventSecondaryTb = ',number_reps DESC';
      break;

      default:
      $eventSecondaryTb = "";
      break;
    }

 

    $sql = 'SELECT athlete.identifier as identifier ,athlete.name as athlete,events.name as event, number_reps,finish_time,best_set_time,EXTRACT (year from age(date_of_birth)) as age, gender,
    RANK()OVER( ORDER BY '.$eventPrimary.$eventPrimaryTb.$eventSecondary.$eventSecondaryTb.') as rank '.
    "FROM scores
    JOIN athlete ON athlete.id = scores.athlete_id
    JOIN events ON events.id = scores.event_id
    JOIN register ON register.athlete_id = scores.athlete_id
    JOIN competitions ON competitions.id = register.competition_id
    WHERE competitions.id = $1 AND events.name = $2";

    $result = pg_query_params($dbconn, $sql, [$competition['id'],$eventsNames[$event]]);
    array_push($scoresArray, $result);
  }
  $leaderboard = array();
  foreach ($scoresArray as $eventScores){
    while($row = pg_fetch_assoc($eventScores)){
      if (count($leaderboard) == 0){
        array_push($leaderboard, array($row['identifier'],$row['athlete'],$row['rank'],$row['age'],$row['gender']));

      }else{
        $num = count($leaderboard);
        for($i = 0 ; $i< $num ;$i++){
          if($row['identifier'] == $leaderboard[$i][0]){
            $leaderboard[$i][2]+=$row['rank'];
            break;
          }elseif($i == count($leaderboard)-1){
            array_push($leaderboard, array($row['identifier'],$row['athlete'],$row['rank'],$row['age'],$row['gender']));
            
          }
        }
      }
    }
  }

  for($i=0 ; $i< count($leaderboard) ;$i++){
    $index = $i; 

    for($j = $i+1 ; $j< count($leaderboard) ;$j++){
      if($leaderboard[$j][2] < $leaderboard[$index][2]){
        $index = $j;
      }
    }
    $temp = $leaderboard[$i];
    $leaderboard[$i] = $leaderboard[$index];
    $leaderboard[$index] = $temp;
  }
}
  


if (empty($competition)) {
  ?><h1>Unknown competiton <?php echo $competitionId; ?></h1><?php
} elseif (empty($scoresArray)) {
  ?><h1>No events created for <?php echo $competition["name"]; ?></h1><?php
} else {
  ?>

  <!DOCTYPE html>
<html>
<head>
  <title>leaderboard</title>
  <style>  
  
         .logo_mefit {  
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 30%;  
         }  
         .header{
          text-align: center;
          text-transform: uppercase;
         } 
         .form{
          width: 100%;
         }
         .search{
          width: 100%;
         }
      </style>  
   <!-- to make it looking good im using bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <img class="logo_mefit" src="logo_mefit.png" alt="logo">
    <h1  class="header"><?php echo $competition["name"]." leaderboard "; ?></h1>
    <form class="form" method="POST">
    <select class=filter name="filter">
      <option>-Select-</option>
      <option value="rank">rank</option>
      <option value="male">male</option>
      <option value="female">female</option>
    </select>
    <input type= search name = search placeholder="Enter the full name of the athlete ">
    <button class= submit type="submit">filter</button>
  </form>

<table class="table">
  <thead>
    <tr>
    <th>athlete</th>
    <th>points</th>
    
    <?php
    foreach($eventsNames as $event){?>
        <th><?php echo $event ?></th>
        <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $finalrank = 1 ;
    $sameRankCounter=0;

    for($i = 0 ; $i< count($leaderboard) ;$i++){
      if($filter == 'rank'){
        $v='';
      }else if($filter == 'male'){
        if($leaderboard[$i][4] == 'F'){
          $v = 'visibility:collapse';
        }else{
          $v='';
        }
      }else if($filter == 'female'){
        if($leaderboard[$i][4] == 'M'){
          $v = 'visibility:collapse';
        }else{
          $v = '';
        }
      }else{
        $v = '';
      }

      if(!empty($search)){
        if($leaderboard[$i][1] != $search){
          $v='visibility:collapse';
        }else{
          $v='';
        }
      }
      
    ?>
          <tr style='<?php echo $v?>'>
          <td><?php echo $leaderboard[$i][1]."<br>".$leaderboard[$i][4]."/".$leaderboard[$i][3]; ?></td>
            <?php 
            if($i == 0 || $leaderboard[$i][2] == $leaderboard[$i - 1][2]){ 
              $sameRankCounter++;
              ?>
              <td><?php echo $finalrank.' ('.$leaderboard[$i][2].' points'.')';?></td> 
            <?php 
            }else{?>
              <td>
              <?php
              if($sameRankCounter > 1){
                $finalrank += $sameRankCounter;
                $sameRankCounter = 1; 
              }else{
                $finalrank++;
              }
              
              echo $finalrank.' ('.$leaderboard[$i][2].' points'.')';

              ?>
                
              </td> 
            <?php

            }
            foreach ($scoresArray as $eventScores){
              $athletesScores = pg_fetch_all($eventScores);
              $count = 0;
              while ($count < pg_num_rows($eventScores)){
                if ($leaderboard[$i][0] == $athletesScores[$count]['identifier']){

                  ?>

                  <td><?php echo 'rank: '.$athletesScores[$count]['rank'].'<br>'.'('.$athletesScores[$count]['finish_time'].')'."<br>".$athletesScores[$count]['number_reps']." reps <br>".'best set time:'.$athletesScores[$count]['best_set_time']; ?></td>
                  <?php 
                  break;
                }
                $count++;
              }
            }

            ?>
          </tr>

    <?php   }
    }
  

    ?>

  </tbody>
</table>
  <br>
  <br>
  <br>
    <form class="form">
      <a href="index.php">
      <text style="text-align: center"><h4>Main Page</h4></text>
      </a><br>
    </form>

</body>
</html>

