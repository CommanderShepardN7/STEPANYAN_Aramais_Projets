<?php
	date_default_timezone_set('Europe/Paris');

	require 'vendor/autoload.php';
	include_once "db/dataConnexion.php";
	include_once "db/creationBdD.php";
	include_once "db/db.php";
	include_once "model/connectDeconnectUtilisateur.php";
	session_start();//apres model si php objet
	include_once "template.php";
	include_once "model/infoCsvModel.php";
	include_once "creationFichierWord.php";
	include_once "bddToCSV/bddToCsv.php";
	include_once "gestionPages.php";
	include_once "lib/gestionChantier.php";
	include_once "lib/gestionIntervention.php";
	include_once "lib/setMarkersChantiersJS.php";
	include_once "formulaires/formulaire_connection.php";
	include_once "formulaires/formulaire_choixTypeCreationChantier.php";
	include_once "formulaires/formulaire_creerChantierParticulier.php";
	include_once "formulaires/formulaire_creerChantier.php";
	include_once "formulaires/formulaire_choixCloturerSupprimer.php";
	include_once "controller/action.php";
	include_once "view/view_navigation.php";
	include_once "view/view_afficherChantiers.php";
	include_once "view/view_infoDetaillesChantier.php";
	include_once "view/view_afficherInfoIterventions.php";
	include_once "view/view_nomChampsInterventions.php";
	include_once "view/view_interventionDetailles.php";
	include_once 'view/view_formulaire_creation_CR.php';
	include_once "view/view_formulaire_creation_Word.php";
	include_once "view/view_map.php";
	include_once "view/view.php";

