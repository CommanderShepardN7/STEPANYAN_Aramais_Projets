<?php

function getIdChantierfromURL(){
  return $_GET['id'];
}

/*La fonction "ajouterChantier" sert à ajouter des chantiers dans la base de données.*/
function ajouterChantier() {
	global $connect;

  //mysqli_real_escape_string - Protège les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL: ' " .
  //trim - — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne.

  $nomClient = trim(mysqli_real_escape_string($connect, $_POST["nomClient"]));
  $nomChantier  = trim(mysqli_real_escape_string($connect, $_POST["nomChantier"]));
  $IdChantierAdmin = trim(mysqli_real_escape_string($connect, $_POST["IdChantierAdmin"]));

		$sql = "insert into chantier (typeChantier,nomClient,nomChantier,numCommande,IdChantierAdmin,latitude,longitude) values (
		'" . 	$_POST["typeChantier"]			. "',
		'" . 	$nomClient				          . "',
		'" .	$nomChantier			          . "',
		'" .	$_POST["numCommande"]				. "',
		'" .	$IdChantierAdmin		        . "',
		'" .	$_POST["latitude"]					. "',
		'" .	$_POST["longitude"]					. "')";

		$result = mysqli_query($connect, $sql);
		addNameZoneInterventionsinDB(mysqli_insert_id($connect));
}


/*La fonction "ajouterChantierParticulier" sert à ajouter des chantiers particuliers dans la base de données.*/
function ajouterChantierParticulier() {
	global $connect;
	$typeChantier = "Custom";

  $nomClient = trim(mysqli_real_escape_string($connect, $_POST["nomClient"]));
  $nomChantier  = trim(mysqli_real_escape_string($connect, $_POST["nomChantier"]));
  $IdChantierAdmin = trim(mysqli_real_escape_string($connect, $_POST["IdChantierAdmin"]));

		$sql = "insert into chantier (typeChantier,nomClient,nomChantier,numCommande,IdChantierAdmin,latitude,longitude) values (
		'" . 	$typeChantier								. "',
		'" . 	$nomClient					        . "',
		'" .	$nomChantier				        . "',
		'" .	$_POST["numCommande"]				. "',
		'" .	$IdChantierAdmin		        . "',
		'" .	$_POST["latitude"]					. "',
		'" .	$_POST["longitude"]					. "')";

		$result = mysqli_query($connect, $sql);

		$idLastChantier = mysqli_insert_id($connect);
		addChampsParticuliers($idLastChantier);
		addNameZoneInterventionsinDB($idLastChantier);
}


/*La fonction "addNameZoneInterventionsinDB" sert à créer les noms des interventions qui appartiennent au chantier.*/
function addNameZoneInterventionsinDB($idChantier){
	global $connect;
	$tailleTab = sizeof($_POST["identifiant_site"]);
	$monTab = $_POST["identifiant_site"];

	for($i = 0; $i < $tailleTab; $i++){
		$sql = "insert into intervention (idChantier,identifiantSite) values (
			'" . 	$idChantier			                                          . "',
			'" .	trim(mysqli_real_escape_string($connect,$monTab[$i]))			. "')";
		$result = mysqli_query($connect, $sql);
	}
}

/*La fonction "addChampsParticuliers" sert à créer les champs particuliers qui appartiennent au chantier de type custom.*/
function addChampsParticuliers($idChantier){
	global $connect;
	$tailleTab = sizeof($_POST["champ_particulier"]);
	$monTab = $_POST["champ_particulier"];

	for($i = 0; $i < $tailleTab; $i++){
		$sql = "insert into champs_chantier_particulier (idChantier,champ_particulier) values (
			'" . 	$idChantier			                                          . "',
			'" .	trim(mysqli_real_escape_string($connect,$monTab[$i]))			. "')";
		$result = mysqli_query($connect, $sql);
	}
}

/*La fonction "getChamps_chantier_particulier" sert à recuperer les champs particuliers qui appartiennent au chantier de type custom.*/
function getChamps_chantier_particulier(){
  global $connect;

  $sql = "SELECT idChantier, champ_particulier
          FROM champs_chantier_particulier
          WHERE idChantier =".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;

}


/*La fonction "getChantiers" sert à recuperer toutes les chantiers de la base de données.*/
function getChantiers(){
	global $connect;

		$sql = "SELECT idChantier,typeChantier, nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
						FROM chantier";

		$result = mysqli_query($connect, $sql);

		return $result;
}

/*La fonction "getChantiersCloture" sert à recuperer les chantiers clôturés.*/
function getChantiersCloture(){
	global $connect;

		$sql = "SELECT idChantier,typeChantier, cloture,nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
						FROM chantier WHERE cloture =".'True';

		$result = mysqli_query($connect, $sql);

		return $result;

}

/*La fonction "getChantiersNonCloture" sert à recuperer les chantiers non clôturés.*/
function getChantiersNonCloture(){
	global $connect;

	$sql = "SELECT idChantier,typeChantier, cloture,nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
					FROM chantier WHERE cloture <>".'True';

		$result = mysqli_query($connect, $sql);

		return $result;

}

/*La fonction "findChantierByID" sert à récupérer le chantier dont id passé en paramètre.*/
function findChantierByID($idChantier){
	global $connect;

	$sql = "SELECT idChantier,typeChantier, cloture,nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
					FROM chantier WHERE idChantier =".$idChantier;

	$result = mysqli_query($connect, $sql);

	return $result;

}

/*Return True si le chantier passé en parametre est cloturé*/
function chantierEstCloture($idChantier){
	$result = findChantierByID($idChantier);
	
	//var_dump($result);
	
	$row = mysqli_fetch_assoc($result);

	return $row["cloture"] === "True";
}

/*Return True si le chantier possede des inteventions*/
function chantierPossedeInterventions(){

	$result1 = getTab_autre_controle();
	$result2 = getTab_captage();
	$result3 = getTab_ruisseau_ponctuelle();
	$result4 = getTab_ruisseau_segment();
	$result5 = getTab_sentier_balisage();
	$result6 = getTab_sentier_creation_ponctuelle();
	$result7 = getTab_sentier_creation_segment();
	$result8 = getTab_intervention_custom();

	return
				mysqli_num_rows($result1) != 0 ||
				mysqli_num_rows($result2) != 0 ||
				mysqli_num_rows($result3) != 0 ||
				mysqli_num_rows($result4) != 0 ||
				mysqli_num_rows($result5) != 0 ||
				mysqli_num_rows($result6) != 0 ||
				mysqli_num_rows($result7) != 0 ||
				mysqli_num_rows($result8) != 0 ;
}

/*La fonction "cloturerChantierUPDATE" sert à cloturer un chantier .*/
function cloturerChantierUPDATE(){
	global $connect;

	$sql = "UPDATE chantier SET cloture = 'True' WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);
}

/*La fonction "supprimerChantierDELETE" sert à supprimer un chantier avec des interventions qui l'appartiennent.*/
function supprimerChantierDELETE(){
	global $connect;

	$sql = "DELETE FROM	chantier WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	intervention WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	autre_controle WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	captage WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	champs_chantier_particulier WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	ruisseau_ponctuelle WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	ruisseau_segment WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	sentier_balisage WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	sentier_creation_ponctuelle WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);

	$sql = "DELETE FROM	sentier_creation_segment WHERE idChantier =".getIdChantierfromURL();
	$result = mysqli_query($connect, $sql);
}



/*La fonction "getChantiersArray" sert à transformer le résultat retourné par la fonction "getChantiers en tableau associative.*/
function getChantiersArray($data){
	$results_array = array();

	while ($row  = mysqli_fetch_assoc($data)){
		$results_array[] = $row;
	}
	return 	$results_array;
}
