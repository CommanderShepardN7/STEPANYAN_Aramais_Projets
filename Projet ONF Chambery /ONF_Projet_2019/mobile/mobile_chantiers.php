<?php

	/*$connect=mysqli_connect("localhost","onf_1", "jOfEUOUO", "onf_1");	// Connexion à la base de données,(@serveur, login, mot de passe, nom de la base de données)
	mysqli_set_charset($connect,"utf-8");		//encodage utf-8*/
	include_once "../db/dataConnexion.php";
	include_once "../db/db.php";
	global $connect;
	
    $sql = "SELECT idChantier,typeChantier,nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
            FROM chantier WHERE `cloture` = 'False'";

    $result = mysqli_query($connect, $sql);

    $results_array = array();

  	while ($row  = mysqli_fetch_assoc($result)){
  		$results_array[] = $row;
  	}

    header('Content-Type: application/json');
    echo json_encode(array('chantiersObject' => $results_array));
    mysqli_close($connect);
 ?>
