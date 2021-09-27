<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=leaderboard2 user=Soma password=bonbon");
	function validate($data){
	       $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}

	function authenticate($token,$dbconn){
      $sql = "SELECT identifier from partners WHERE identifier =$1";
      $result =pg_query_params($dbconn, $sql, [$token]);
      
      if (pg_num_rows($result)==0){
        return false;
      }
      return true;
    }
?>
