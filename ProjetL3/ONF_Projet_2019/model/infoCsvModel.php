<?php





function recupereCaptages($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `captage` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}
function recupereAutreInter($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `autre_controle` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}
function recupereInterCustom($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `intervention_custom` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}
function recupereRuisseauSegment($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `ruisseau_segment` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}

function recupereRuisseauPonctuelle($id){

	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude` FROM `ruisseau_ponctuelle` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}
function recupereSentierBalisage($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `sentier_balisage` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}
function recupereSentierSegment($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude`,`latitude2`,`longitude2` FROM `sentier_creation_segment` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}

function recupereSentierPonctuelle($id){
	global $connect;
	$res=[];
	$sql = "SELECT `identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,`latitude`,`longitude` FROM `sentier_creation_ponctuelle` WHERE idChantier = '$id' ORDER BY `date` ASC";
	$result =  mysqli_query($connect,$sql);
	while ($row= mysqli_fetch_assoc($result)){
		$res[]=$row;
	}
	return $res;	
}


function getChantierpourcsv($idChantier){
	
	global $connect;

	$sql = "SELECT idChantier,IdChantierAdmin,typeChantier FROM chantier WHERE idChantier ='$idChantier'"; 

    $result = mysqli_query($connect, $sql);
	$row= mysqli_fetch_assoc($result);

	return $row;
	
	
	
}


?>