<?php
$page = "home";																// Valeur de page par defaut (page d'accueil)

if (isset($_GET["page"])) { 									//si la cle 'page' existe dans l'adresse url, sinon elle se crée
	if ($_GET["page"] == "deconnection") { 			// si dans @url la cle 'page' egale à "deconnection"
		deconnection();														// On appelle la fonction qui déconnecte la session d'utilisateur
	}else{
		$page = $_GET["page"];										//si la cle 'page' n'est pas egale à "deconnection" alors la cle 'page' egale à 'home'
	}
}
// ********************* Connexion***************************
	if (isset($_POST["connection"])){							//Si on a appuyé sur bouton dont le nom "name='connection'"
		if ($_POST["connection"]=="Se connecter"){	// On précise que son valeur egale a "value='Se connecter'"
			VerificationIdentifiant();}
	}
// ******************* FIN Connexion*************************
// ********************* Creation Chantier***************************
	if (isset($_POST["action"])){
		if ($_POST["action"]=="Valider"){
			ajouterChantier();
			$page="chantiersEnCours";						//Redirection sur la page pour voir chantiers en cours.
		}
	}

	if (isset($_POST["ValiderAjoutChantierPartr"])){
		if ($_POST["ValiderAjoutChantierPartr"]=="Valider"){
			ajouterChantierParticulier();
			$page="chantiersEnCours";						//Redirection sur la page pour voir chantiers en cours.
		}
	}
// ******************* FIN Creation Chantier*************************


// ********************* Cloture de Chantier***************************

if (isset($_POST["cloturerChantierButton"])){
	if ($_POST["cloturerChantierButton"]=="Cloturer"){

		cloturerChantierUPDATE();
		$page="voirTousChantiers";						//Redirection sur la page pour voir tous les chantiers.

	}
}

// ******************* FIN Cloture de Chantier*************************


// ********************* Suppression de Chantier***************************
if (isset($_POST["supprimerChantierButton"])){
	if ($_POST["supprimerChantierButton"]=="Supprimer"){

		supprimerChantierDELETE();
		$page="voirTousChantiers";						//Redirection sur la page pour voir tous les chantiers.

	}
}
// ******************* FIN Suppression de Chantier*************************
