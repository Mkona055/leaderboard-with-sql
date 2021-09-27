<?php 
include "config.php";

if (isset($_GET['id']) && isset($_GET['partnerID'])) {
	$competitionID = $_GET['id'];
	$partnerID = $_GET['partnerID'];

	$sql = "DELETE FROM competitions WHERE identifier ='$competitionID'";

	$result = pg_query($dbconn,$sql);

	if ($result == TRUE) {
		header("Location: organize_comp.php?success=Competition deleted successfully&identifier=$partnerID");
	}else{
		header("Location: organize_comp.php?error=Failed to delete&identifier=$partnerID");
	}
}

?>