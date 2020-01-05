<?php

function createMyDb(){

	global $host;
	global $username;
	global $my_password;
	global $my_db;

	$connectCreationBDD =  mysqli_connect($host, $username, $my_password);

	// Check connection
	if (!$connectCreationBDD) {
	    die("\nConnection failed: " . mysqli_connect_error());
	}

	/*Création de la base de données 'smartTrucker' si elle n'existe pas.*/
	$sql = "CREATE DATABASE IF NOT EXISTS ".$my_db;

	if (mysqli_query($connectCreationBDD, $sql)) {
	    echo "\nDatabase ".$my_db." created successfully !";
	} else {
	    echo "\nError creating database: " . mysqli_error($connectCreationBDD );
	}

	mysqli_close($connectCreationBDD);

	/**************************************************************************/

	$connectBDD =  mysqli_connect($host, $username, $my_password, $my_db);

	/*Création du table 'smartTrucker' dans la base de données.*/
	$sql1 = "CREATE TABLE IF NOT EXISTS `smartTrucker` (
	  `level` int(11) DEFAULT NULL,
	  `questionText` varchar(200) DEFAULT NULL,
	  `urlVideo` varchar(500) DEFAULT NULL,
	  `reponse1` varchar(30) DEFAULT NULL,
	  `reponse2` varchar(30) DEFAULT NULL,
	  `reponse3` varchar(30) DEFAULT NULL,
	  `reponse4` varchar(30) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 ";

	if (mysqli_query($connectBDD, $sql1)) {
	    echo "\nTable 'smartTrucker' created successfully !";
	} else {
	    echo "\nError creating table: " . mysqli_error($connectBDD);
	}
	/**************************************************************************/

	/*Création des questions par défaut*/
	$sql2 = "INSERT INTO `smartTrucker` (`level`, `questionText`, `urlVideo`, `reponse1`, `reponse2`, `reponse3`, `reponse4`) VALUES
	(1, 'La capitale de la Russie', 'null', 'Moscow', 'Paris', 'Madrid', 'Kaliningrad'),
	(1, 'La capitale d\'Italie ', 'null', 'Rome', 'Berlin', 'Kiev', 'Kabul'),
	(1, 'Quelle ville est-ce', 'fT4lDU-QLUY', 'New York', 'London', 'Chicago', 'Ottawa'),
	(2, 'La capitale de la Russie L2', 'null', 'Moscow', 'Paris', 'Madrid', 'Kaliningrad'),
	(2, 'La capitale d\'Italie L2', 'null', 'Rome', 'Berlin', 'Kiev', 'Kabul'),
	(3, 'La capitale de la Russie L3', 'null', 'Moscow', 'Paris', 'Madrid', 'Kaliningrad'),
	(3, 'La capitale d\'Italy L3', 'null', 'Rome', 'Berlin', 'Kiev', 'Kabul'),
	(3, 'La capitale d\'Espagne L3', 'null', 'Madrid', 'Berlin', 'Kiev', 'Kabul')";

	if (mysqli_query($connectBDD, $sql2)) {
	    echo "\nNew record created successfully !";
	} else {
	    echo "\nError: " . $sql2 . "<br>" . mysqli_error($connectBDD);
	}

	mysqli_close($connectBDD);
}
