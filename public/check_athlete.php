<?php
	include 'config.php';

	if (isset($_POST["identifier"]) && isset($_POST["competition_id"])&& isset($_POST["athlete"]) && isset($_POST["date_of_birth"]) && isset($_POST["nationality"]) && isset($_POST["sex"]) && isset($_POST["gender"]) && isset($_POST["email"])){

		$athlete_name = validate($_POST["athlete"]);
		$dob = validate($_POST["date_of_birth"]);
		$nationality = validate($_POST["nationality"]);
		$sex = validate($_POST["sex"]);
		$gender = validate($_POST["gender"]);
		$competition_id = validate($_POST["competition_id"]);
		$email = validate($_POST["email"]);
		$partner_identifier = validate($_POST["identifier"]);

		$athleteData = "identifier=".$partner_identifier."&athlete=".$athlete_name."&nationality=".$nationality."&sex=".$sex."&gender=".$gender."&email=".$email;

		$sql = "SELECT * FROM athlete WHERE name = $1 AND date_of_birth = $2 AND sex = $3 AND nationality = $4";
			$result = pg_query_params($dbconn, $sql,[$athlete_name,$dob,$sex,$nationality]);
			$num_row = pg_num_rows($result);
			$data = pg_fetch_all($result);

			if ($num_row > 0) {
				// there is an athlete with the same informations
				$athlete_id = $data[0]['id'];
				$result = true;

			}else{
				$sql = "SELECT nextval('athletes_id_seq')as id";
				$result = pg_query($dbconn, $sql);
				$athlete_id = pg_fetch_all($result)[0]['id'];
				$sql = 'INSERT INTO athlete(id, name,date_of_birth,nationality,sex,email)
				VALUES($1,$2,$3,$4,$5,$6)';
				$result = pg_query_params($dbconn, $sql, [$athlete_id,$athlete_name,$dob,$nationality,$sex,$email]);

			}

				if ($result == true){

					$sql = "SELECT max_athlete FROM competitions WHERE competitions.id = $1";
					$result = pg_query_params($dbconn, $sql, [$competition_id]);
					$max_athlete = pg_fetch_all($result)[0]['max_athlete'];

					$sql = 'SELECT count(gender)as num_athlete FROM register JOIN competitions ON competitions.id = register.competition_id WHERE gender=$1 AND competition_id = $2 ';
					$result = pg_query_params($dbconn, $sql, [$gender,$competition_id]);
					$num_athlete = pg_fetch_all($result)[0]['num_athlete'];

					if($max_athlete > $num_athlete || empty($max_athlete)){
						$sql = "INSERT INTO register(athlete_id,competition_id,gender)
								VALUES($1,$2,$3)";
						$result = pg_query_params($dbconn, $sql, [$athlete_id,$competition_id,$gender]);
						if($result == true){
							header("Location: register.php?success=Registered successfully &identifier=$partner_identifier");
						}else{
							header("Location: register.php?error=insertion failed athlete already registered &$athleteData");
						}
						
					}else{
						header("Location: register.php?error=registration failed, maximum athlete reached for this competition &$athleteData");
					}
				}else{
					header("Location: register.php?error=insertion failed &$athleteData");
				}
			
	}
?>