<?php

/*La fonction "afficheTitrePage" affiche le titre de la page passé en paramètre.*/
function afficheTitrePage($page){

	switch ($page) {

		case 'creationChantier':
			echo '
				</br>
				 <div class="text-center mb-4">
				<h3>Création du chantier</h3>
				</div>';
		break;

      case 'chantiersEnCours':
        echo '
          </br>
          <div class="text-center mb-4">
            <h3>Chantiers en cours</h3>
          </div>';
      break;

      case 'voirTousChantiers':
        echo '
          </br>
          <div class="text-center mb-4">
            <h3>Chantiers clôturés</h3>
          </div>';
      break;

      case 'interventionDetailles':
        echo '
          </br>
          <div class="text-center mb-4">
            <h3>Information détaillée</h3>
          </div>';
      break;

      default:
      break;
      }
}


/*La fonction "gestionPages" sert à appeler les fonctions qui changent le contenu de la page lorsque on clique sur un lien.*/
function gestionPages(){
  global $page;

  switch ($page) {

    case 'home':
      if (!isset ($_SESSION["connected"])){
        formConnexion();
      }else{
        afficheTabChantiers(getChantiersNonCloture());
      }
      break;

    default:
      connectOK($page);
      break;
  }

}

/*La fonction "connectOK" sert a vérifier si l'administrateur est connecté pour voir les pages spéciaux.*/
function connectOK($page){
  if (isset ($_SESSION["connected"])){

	afficheTitrePage($page);

    switch ($page) {

      case 'creationChantier':
        creer_map();
        choixActionTypeChantier();
        formCreerChantierParticulier();
        formCreerChantier();
      break;

      case 'type_particulier':
        formCreerChantierParticulier();
      break;

      case 'chantiersEnCours':
        afficheTabChantiers(getChantiersNonCloture());
      break;

      case 'voirTousChantiers':
        afficheTabChantiers(getChantiersCloture());
      break;

      case 'interventionInfo':
        infoIntervention();
        choixActionSupprimerCloturerChantier();
        infoDetaillesChantier();
      break;

      case 'interventionDetailles':
        affiche_detailles_intervention();
      break;

      case 'creer_ZIP':
        $idChantier=$_GET['idChantier'];
        $idChantierAdmin=$_GET['idChantierAdmin'];
        afficheFormulaireCR($idChantier,$idChantierAdmin);
      break;

      case 'creer_WORD':
      afficheFormulaireWord(); 
      break;

      case 'crCOMPLET':
      creationCompteRendu('COMPLET','COMPLET');
      break;

      case 'crPARTIEL':
      $dateDebut = $_GET['dateDeb'];
      $dateFin = $_GET['dateFin'];
      creationCompteRendu($dateDebut,$dateFin);
      break;


      default:
        afficheTabChantiers(getChantiersNonCloture());
      break;
      }

    }else {
       formConnexion();
    }

  }
 ?>
