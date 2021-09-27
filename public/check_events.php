<?php
	include 'config.php';

		if(isset($_GET["infos"])){
			
			list($compet_id,$partnerId,$number_events) = explode("AND",$_GET["infos"]);
			$compet_id = validate($compet_id);
			$partnerId = validate($partnerId);
			$number_events = validate($number_events);

			for($i = 1 ; $i<= $number_events ;$i++){
				if (isset($_GET["name".$i]) && isset($_GET["primary_score".$i]) && isset($_GET["primary_score_tb".$i]) && isset($_GET["time_cap".$i]) && isset($_GET["time_cap_tb".$i])&& isset($_GET["event_date".$i])) {

					$name = validate($_GET["name".$i]);
					$primary_score = validate($_GET["primary_score".$i]);
					$primary_score_tb = validate($_GET["primary_score_tb".$i]);
					$time_cap = validate($_GET["time_cap".$i]);
					$time_cap_tb = validate($_GET["time_cap_tb".$i]);
					$event_date = validate($_GET["event_date".$i]);
					
					switch($primary_score_tb){
						case "NULL":
						$primary_score_tb = null;
					}
					switch($time_cap){
						case "NULL":
						$time_cap = null;
					}
					switch($time_cap_tb){
						case "NULL":
						$time_cap_tb = null;
					}


					$eventData = "id=".$compet_id."&identifier=".$partnerId."&number_events=".$number_events.
					"&name".$i."=".$name;

					if(empty($name)){
						header("Location: create_events.php?error=Empty name field &$eventData");
					}else if(empty($event_date)){
						header("Location: create_events.php?error=Empty date field &$eventData");
					}else{
						$sql = 'INSERT INTO events(competition_id, name,primary_score, primary_score_tb, time_cap, time_cap_tb,event_date)
						VALUES($1,$2,$3,$4,$5,$6,$7)';
						$result = pg_query_params($dbconn, $sql, [$compet_id,$name,$primary_score,$primary_score_tb,$time_cap,$time_cap_tb,$event_date]);

						if ($result == true){
							header("Location: organize_comp.php?success=Competition created successfully&identifier=".$partnerId);
						}else{
							header("Location: create_events.php?error=insertion failed&$eventData");
						}
					}			
				}
			}

		}else{
			echo "Error Occured";
		}

?>