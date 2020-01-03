<?php

/*Tous les fonctions suivant récupèrent les interventions de la base de données.*/
function getTab_autre_controle(){
  global $connect;

  $sql = "SELECT
        idIntervention,
        typeTable,
        identifiantSite,
        date,
        code_equipe,
        observation,
        spinner_type_vegetation,
        spinner_nature_travaux,
        spinner_urgence,
        checkbox_acces_oui,
        lieu_Dit,
        latitude,
        longitude,
        latitude2,
        longitude2,
        idChantier,
        photo1,
        photo2,
        photo3,
        photo4,
        photo5,
        photo6
        FROM autre_controle
        WHERE idChantier =".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}

function getTab_captage(){
  global $connect;

  $sql = "SELECT
        idIntervention,
        typeTable,
        identifiantSite,
        date,
        code_equipe,
        observation,
        surface,
        autre,
        fauchage_oui,
        lieu_Dit,
        latitude,
        longitude,
        latitude2,
        longitude2,
        idChantier,
        photo1,
        photo2,
        photo3,
        photo4,
        photo5,
        photo6
        FROM captage
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);
  return $result;
}

function getTab_intervention_custom(){
  global $connect;

  $sql = "SELECT
          idIntervention,
          typeTable,
          identifiantSite,
          date,
          code_equipe,
          observation,
          lieu_Dit,
	        valeur_champ1,
          valeur_champ2,
	        valeur_champ3,
          valeur_champ4,
          valeur_champ5,
	        valeur_champ6,
          valeur_champ7,
          valeur_champ8,
          valeur_champ9,
	        valeur_champ10,
          valeur_champ11,
          valeur_champ12,
          valeur_champ13,
          valeur_champ14,
          valeur_champ15,
          latitude,
          longitude,
          latitude2,
          longitude2,
          idChantier,
		  idChantierAdmin,
          photo1,
          photo2,
          photo3,
          photo4,
          photo5,
          photo6,
          champ1,
          champ2,
          champ3,
          champ4,
          champ5,
          champ6,
          champ7,
          champ8,
          champ9,
          champ10,
          champ11,
          champ12,
          champ13,
          champ14,
          champ15
        FROM intervention_custom
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}




function getTab_ruisseau_ponctuelle(){
  global $connect;

  $sql = "SELECT
          idIntervention,
          typeTable,
          identifiantSite,
          lieu_Dit,
          date,
          code_equipe,
          observation,
          spinner_invasives,
          abattage,
          autres_invasives,
          latitude,
          longitude,
          idChantier,
          photo1,
          photo2,
          photo3,
          photo4,
          photo5,
          photo6
        FROM ruisseau_ponctuelle
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}

function getTab_ruisseau_segment(){
  global $connect;

  $sql = "SELECT
          idIntervention,
          typeTable,
          identifiantSite,
          date,
          code_equipe,
          lieu_Dit,
          observation,
          checkbox_embacles_oui,
          checkbox_faconnage_oui,
          checkbox_broyage_oui,
          checkbox_debroussaillage_oui,
          checkbox_nettoyage_oui,
          latitude,
          longitude,
          latitude2,
          longitude2,
          idChantier,
          photo1,
          photo2,
          photo3,
          photo4,
          photo5,
          photo6
        FROM ruisseau_segment
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}

function getTab_sentier_balisage(){
  global $connect;

  $sql = "SELECT
          idIntervention,
          typeTable,
          identifiantSite,
          date,
          code_equipe,
          lieu_Dit,
          observation,
          spinner_nature_panneau,
          spinner_etat,
          spinner_entretien,
          spinner_acces,
          checkbox_charte_oui,
          latitude,
          longitude,
          latitude2,
          longitude2,
          idChantier,
          photo1,
          photo2,
          photo3,
          photo4,
          photo5,
          photo6
        FROM sentier_balisage
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;

}

function getTab_sentier_creation_ponctuelle(){
  global $connect;

  $sql = "SELECT
          idIntervention,
          typeTable,
          identifiantSite,
          date,
          code_equipe,
          lieu_Dit,
          observation,
          spinner_acces_scp,
          abattage_scp,
          demontage,
          remise_en_etat,
          spinner_signaletique,
          signaletique_quantite,
          signaletique_action,
          spinner_medias,
          medias_quantite,
          medias_action,
          spinner_comfort,
          comfort_quantite,
          comfort_action,
          spinner_securite,
		  securite_quantite,
          securite_action,
          autre,
          autre_quantite,
          autre_action,
          latitude,
          longitude,
          idChantier,
          photo1,
          photo2,
          photo3,
          photo4,
          photo5,
          photo6
        FROM sentier_creation_ponctuelle
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}

function getTab_sentier_creation_segment(){
  global $connect;

  $sql = "SELECT
        idIntervention,
        typeTable,
        identifiantSite,
        date,
        code_equipe,
        lieu_Dit,
        observation,
        spinner_acces_scs,
        checkbox_refection,
        refection,
        checkbox_piochage_1m,
		piochage_1m,
        checkbox_piochage_1m5,
        piochage_1m5,
        checkbox_fauchage_1_cote,
        fauchage_1_cote,
        checkbox_fauchage_2_cote,
        fauchage_2_cote,
        checkbox_epierrage,
        epierrage,
        checkbox_deroctage,
        deroctage,
        checkbox_elagage_1_cote,
        elagage_1_cote,
        checkbox_elagage_2_cote,
        elagage_2_cote,
        checkbox_calage,
        calage,
        checkbox_curage,
        curage,
        checkbox_reprise_platelage,
	      reprise_platelage,
        checkbox_reprise_garde_corps,
        reprise_garde_corps,
        latitude,
        longitude,
        latitude2,
        longitude2,
        idChantier,
        photo1,
        photo2,
        photo3,
        photo4,
        photo5,
        photo6
        FROM sentier_creation_segment
        WHERE idChantier = ".getIdChantierfromURL();

  $result = mysqli_query($connect, $sql);

  return $result;
}
/************************************************************************/



function getAssocArray($data){
	$results_array = array();

	while ($row  = mysqli_fetch_assoc($data)){
		$results_array[] = $row;
	}
	return 	$results_array;
}

//Pour afficher les interventions dans le tableau avec des interventions. Return un array avec les resultats des fonctions dont recuperent les interventions qui appartien a un chantier.
//Retourne un tableau avec les résultats des fonctions dont récupèrent les interventions qui appartiennent a un chantier.
function getArrayAllIterventions(){
  $array1 = getTab_autre_controle();
  $array2 = getTab_captage();
  $array3 = getTab_intervention_custom();
  $array4 = getTab_ruisseau_ponctuelle();
  $array5 = getTab_ruisseau_segment();
  $array6 = getTab_sentier_balisage();
  $array7 = getTab_sentier_creation_ponctuelle();
  $array8 = getTab_sentier_creation_segment();

return array($array1, $array2, $array3, $array4, $array5,$array6, $array7, $array8);
}

//Pour afficher les marqueurs des interventions dans la fonction setInterventionMarkersOnMap().
//Transforme le tableau retourné par la fonction  getArrayAllIterventions() en tableau associative.
function getAssocArrayAllIterventions(){
  $dataArray = getArrayAllIterventions();
  $resultArrayWithAssocArrays = array();

for($i = 0; $i < sizeof($dataArray); $i++){
    $resultArrayWithAssocArrays[] =  getAssocArray($dataArray[$i]);

  }

return $resultArrayWithAssocArrays;
}
