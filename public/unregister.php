<?php 
include "config.php";

if (isset($_GET['r_identifier']) && isset($_GET['partnerID'])) {
	$r_identifier = $_GET['id'];
	$partnerID = $_GET['partnerID'];

	$sql = "DELETE FROM register WHERE identifier ='$r_identifier'";

	$result = pg_query($dbconn,$sql);

	if ($result == TRUE) {
		header("Location: register.php?success=Competition deleted successfully&identifier=$partnerID");
	}else{
		header("Location: register.php?error=Failed to delete&identifier=$partnerID");
	}
}

?>