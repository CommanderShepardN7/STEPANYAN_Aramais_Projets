<?php
	include_once "../db/dataConnexion.php";
	include_once "../db/db.php";
	global $connect;
	
	$sql = "SELECT `IdChantierAdmin`,`identifiantSite` FROM chantier,intervention WHERE chantier.idChantier = intervention.idChantier";

	
	$result = mysqli_query($connect, $sql);

    $results_array = array();

  	while ($row  = mysqli_fetch_assoc($result)){
  		$results_array[] = $row;
  	}

    header('Content-Type: application/json');
    echo json_encode(array('idInterObject' => $results_array));
    mysqli_close($connect);


?>