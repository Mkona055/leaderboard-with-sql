<?php
	
	include 'config.php';

		if(isset($_POST["infos"])){
			
			list($competitionID,$partnerID,$athlete_id) = explode("AND",$_POST["infos"]);
			$competitionID = validate($competitionID);
			$partnerID = validate($partnerID);
			$athlete_id = validate($athlete_id);

			if (isset($_POST["event_id"])  && isset($_POST["finish_time"]) && isset($_POST["best_set_time"]) && isset($_POST["number_reps"])) {
					$event_id = validate($_POST["event_id"]);
					$finish_time = validate($_POST["finish_time"]);
					$best_set_time = validate($_POST["best_set_time"]);
					$number_reps = validate($_POST["number_reps"]);
					if(empty($finish_time)){
						$finish_time = NULL;
					}if(empty($best_set_time)){
						$best_set_time = NULL;
					}if(empty($number_reps)){
						$number_reps = NULL;
					}
					
					$scoresData = "finish_time=".$finish_time."&best_set_time=".$best_set_time."&comp_id=".$competitionID.
					"&partner_id=".$partnerID."&athlete_id=".$athlete_id;

					
					$sql = "SELECT * FROM scores WHERE athlete_id = $1 AND event_id = $2";
					$result = pg_query_params($dbconn, $sql,[$athlete_id,$event_id]);

					if(pg_num_rows($result)>0){
						$sql = "UPDATE scores SET finish_time = $1,best_set_time = $2,number_reps = $3
						WHERE athlete_id = $4 AND event_id = $5";
						$result = pg_query_params($dbconn, $sql,[$finish_time,$best_set_time,$number_reps,$athlete_id,$event_id]);
						if ($result == true){
							header("Location: register.php?success=Scores updated successfully&identifier=$partnerID");
						}else{
							header("Location: scores.php.php?error=update failed&$scoresData");
						}
					}else{
						$sql = 'INSERT INTO scores(id, athlete_id, event_id, finish_time, best_set_time, number_reps)
						VALUES($1,$2,$3,$4,$5,$6)';
						$result = pg_query_params($dbconn, $sql, [$score_id,$athlete_id,$event_id,$finish_time,$best_set_time,$number_reps]);

						if ($result == true){
							header("Location: register.php?success=Scores updated successfully&identifier=$partnerID");
						}else{
							header("Location: scores.php?error=update failed&$scoresData");
						}
					}			
			}
			

		}else{
			echo "Error Occured";
		}
