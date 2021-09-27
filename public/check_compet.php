<?php
include 'config.php';
	function get_partner_id($identifier,$dbconn){
		$sql = "SELECT partner_id  FROM competitions JOIN partners ON partner_id = partners.id WHERE partners.identifier = $1";
		$result = pg_fetch_all(pg_query_params($dbconn, $sql, [$identifier]));
		return $result[0]['partner_id'];
	}


	if (isset($_POST["identifier"]) && isset($_POST["name"]) && isset($_POST["venue"]) && isset($_POST["compet_year"]) && isset($_POST["start_date"]) && isset($_POST["end_date"]) && isset($_POST["start_time"]) && isset($_POST["max_athlete"]) && isset($_POST["number_events"]) && isset($_POST["representative"]) && isset($_POST["email"]) && isset($_POST["phone_number"])){

		$identifier = validate($_POST["identifier"]);
		$name = validate($_POST["name"]);
		$venue = validate($_POST["venue"]);
		$compet_year = validate($_POST["compet_year"]);
		$start_date =validate($_POST["start_date"]);
		$end_date =validate($_POST["end_date"]);
		$start_time = validate($_POST["start_time"]);
		$max_athlete = validate($_POST["max_athlete"]);
		$number_events = validate($_POST["number_events"]);
		$representative = validate($_POST["representative"]);
		$email = validate($_POST["email"]);
		$phone_number = validate($_POST["phone_number"]);


		$competData = "identifier=".$identifier."&name=".$name."&venue=".$venue."&compet_year=".$compet_year."&start_date=".$start_date."&end_date=".$end_date."&number_events=".$number_events."&start_time=".$start_time."&max_athlete=".$max_athlete."&representative=".$representative."&email=".$email."&phone_number=".$phone_number;

		if(empty($name)){
			header("Location: organize_comp.php?error=Empty name field &$competData");
		}else if(empty($venue)){
			header("Location: organize_comp.php?error=Empty venue field &$competData");

		}else if(empty($compet_year)){
			header("Location: organize_comp.php?error=Empty competion year field &$competData");

		}else if (empty($start_date)){
			header("Location: organize_comp.php?error=Empty name start_date &$competData");

		}else if (empty($end_date)){
			header("Location: organize_comp.php?error=Empty end_date field &$competData");

		}else if (empty($start_time)){
			header("Location: organize_comp.php?error=Empty start_time field &$competData");

		}else if(empty($number_events)){
			header("Location: organize_comp.php?error=Empty number_events field &$competData");

		}else if (empty($representative)){
			header("Location: organize_comp.php?error=Empty representative field &$competData");

		}else if (empty($email)){
			header("Location: organize_comp.php?error=Empty email field &$competData");
			
		}else if (empty($phone_number)){
			header("Location: organize_comp.php?error=Empty phone_number field &$competData");
			
		}else{
			$partner_id = get_partner_id($identifier,$dbconn);

			$sql = "SELECT * FROM competitions WHERE partner_id = $1 AND compet_year = $2 AND name = $3";
			$result = pg_query_params($dbconn, $sql,[$partner_id,$compet_year,$name]);
			$num_row = pg_num_rows($result);

			if (empty($max_athlete)){
				$max_athlete = null;
			}
			if ($num_row > 0) {
				header("Location: organize_comp.php?error=Already a competition with the same name and competition year &$competData");
			}else{

				$sql = "SELECT nextval('competitions_id_seq')as id";
				$result = pg_query($dbconn, $sql);
				$compet_id = pg_fetch_all($result)[0]['id'];
				
				$sql = 'INSERT INTO competitions(id,partner_id, name,venue,compet_year ,start_date , end_date, start_time,max_athlete,number_events,representative,email,phone_number)
				VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)';

				$result = pg_query_params($dbconn, $sql, [$compet_id,$partner_id,$name,$venue,$compet_year,$start_date,
				$end_date,$start_time,$max_athlete,$number_events,$representative,
				$email,$phone_number]);

				if ($result == true){
					header("Location: create_events.php?id=".$compet_id."&$competData");
				}else{
					header("Location: organize_comp.php?error=insertion failed &$competData");
				}
			}
			
			
		}

		}else{
			echo "Error Occured";
		}

?>
	
