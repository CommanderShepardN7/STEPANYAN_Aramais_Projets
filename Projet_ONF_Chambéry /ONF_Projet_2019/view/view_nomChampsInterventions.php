<?php

/*Tous les fonctions suivant font créer des tableaux avec les noms des champs pour tous les types d'intervention. */
function arrayChampsAutre_controle(){
  return array(
        "Type intervention",
        "Identifiant site",
        "Date",
        "Code equipe",
        "Observation",
        "Type de végétation",
        "Nature travaux",
        "Urgence",
        "Accès piéton",
        "Lieu-dit",
        "Latitude point 1",
        "Longitude point 1",
        "Latitude point 2",
        "Longitude point 2"
   );
 }


   function arrayChampsCaptage(){
     return array(
           "Type intervention",
           "Identifiant site",
           "Date",
           "Code equipe",
           "Observation",
           "Surface",
           "Autre",
           "Fauchage",
           "Lieu-dit",
           "Latitude point 1",
           "Longitude point 1",
           "Latitude point 2",
           "Longitude point 2"
      );
    }

function arrayIntervention_custom(){
    global $connect;

    $dataArrayInterventionAfficher = $_GET['dataArray'];

    $sql = 'SELECT
			  idChantier,
			  identifiantSite,
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
          WHERE idChantier = "'.$dataArrayInterventionAfficher["idChantier"].'"
		  AND identifiantSite = "'.$dataArrayInterventionAfficher["identifiantSite"].'"';	 

    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);


  return array(
    "Type intervention",
    "Identifiant site",
    'Date',
    "Code equipe",
    "Observation",
    "Lieu-dit",
    $row["champ1"],
    $row["champ2"],
    $row["champ3"],
    $row["champ4"],
    $row["champ5"],
    $row["champ6"],
    $row["champ7"],
    $row["champ8"],
    $row["champ9"],
    $row["champ10"],
    $row["champ11"],
    $row["champ12"],
    $row["champ13"],
    $row["champ14"],
    $row["champ15"],
    "Latitude point 1",
    "Longitude point 1",
    "Latitude point 2",
    "Longitude point 2"
  );
}

function arrayRuisseau_ponctuelle(){
  return array(
          "Type intervention",
          "Identifiant site",
		  "Lieu-dit",
          'Date',
          "Code equipe",
          "Observation",
          "Invasives - renouée",
          "Abattage complexe",
          "Autres invasives",
          "Latitude",
          "Longitude"
        );
}

function arrayRuisseau_segment(){
  return array(
          "Type intervention",
          "Identifiant site",
          'Date',
          "Code equipe",
		  "Lieu-dit",
          "Observation",
          "Coupe et évacuation des arbres en travers (embâcles)",
          "Façonnage et ébranchage / billonnage",
          "Broyage",
          "Débroussaillage et piochage",
          "Nettoyage (buses, désableurs, dégrilleurs, etc)",
          "Latitude point 1",
          "Longitude point 1",
          "Latitude point 2",
          "Longitude point 2"
        );
}

function arraySentier_balisage(){
  return array(
    "Type intervention",
    "Identifiant site",
    'Date',
    "Code equipe",
	"Lieu-dit",
    "Observation",
    "Nature panneau",
    "Etat",
    "Entretien",
    "Accès",
    "Charte Départementale",
    "Latitude point 1",
    "Longitude point 1",
    "Latitude point 2",
    "Longitude point 2"
        );
}

function arraySentier_creation_ponctuelle(){
  return array(
    "Type intervention",
    "Identifiant site",
    'Date',
    "Code equipe",
	"Lieu-dit",
    "Observation",
    "Accès",
    "Abattage (>diamètre 20)",
    "Démontage et évacuation chablis",
    "Remise en état passage de clôture",
    "Signalétique pose ou remplacement",
    "Signaletique quantite",
    "Signaletique action",
    "Medias pose ou remplacement",
    "Medias quantite",
    "Medias action",
    "Comfort pose ou remplacement",
    "Comfort quantite",
    "Comfort action",
    "Sécurité",
	"Sécurité quantité",
    "Sécurité action",
    "Autre",
    "Autre quantité",
    "Autre action",
    "Latitude",
    "Longitude"
        );
}

function arraySentier_creation_segment(){
  return array(
    "Type intervention",
    "Identifiant site",
    'Date',
    "Code equipe",
	"Lieu-dit",
    "Observation",
    "Accès",
    "Réfection complète de l'assiette",
    "",
    "Piochage 1m",
    "",
    "Piochage 1,5m",
    "",
    "Fauchage 1 côté",
    "",
    "Fauchage 2 côtés",
	"",
    "Epierrage",
    "",
    "Déroctage",
    "",
    "Elagage 1 côté",
    "",
    "Elagage 2 côtés",
    "",
    "Calage caillebottis",
    "",
    "Curage des revers d'eau",
    "",
    "Reprise platelage caillebottis / passerelle",
    "",
    "Reprise garde-corps bois normalisé",
    "",
    "Latitude point 1",
    "Longitude point 1",
    "Latitude point 2",
    "Longitude point 2"
        );
}
/**************************************************************/

/*La fonction "arrayOfChampsArrays" génère un tableau des tableaux avec les noms des champs pour tous les types d'intervention.*/
 function arrayOfChampsArrays(){
    return array(
      arrayChampsAutre_controle(),
      arrayChampsCaptage(),
      arrayIntervention_custom(),
      arrayRuisseau_ponctuelle(),
      arrayRuisseau_segment(),
      arraySentier_balisage(),
      arraySentier_creation_ponctuelle(),
      arraySentier_creation_segment()
    );

  }
