<?php
global $host;
global $username;
global $my_password;
global $my_db;


/*Données nécessaire pour la création du compte d'admimisrtateur sur la ligne 333.*/
$loginAdmin = "admin";
$motDepasseAdmin = "admin";
/**/

/*Création de la base de données 'onf_bd' si elle n'existe pas.*/
$connectCreationBDD =  mysqli_connect($host, $username, $my_password);
$sql = "CREATE DATABASE IF NOT EXISTS ".$my_db." DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
mysqli_query($connectCreationBDD, $sql);
/*FIN Création de la base de données 'onf_bd'*/

/*Création des tables pour la base de données.*/
$connectBDD =  mysqli_connect($host, $username, $my_password, $my_db);

$sql1 = "CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `motDePasse` varchar(30) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ";



  $sql2 ="CREATE TABLE IF NOT EXISTS `autre_controle` (
	`idChantierAdmin` varchar(30) NOT NULL,
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Autre controle',
    `idChantier` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `spinner_type_vegetation` varchar(30) NOT NULL,
    `spinner_nature_travaux` varchar(30) NOT NULL,
    `spinner_urgence` varchar(30) NOT NULL,
    `checkbox_acces_oui` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double DEFAULT NULL,
    `longitude2` double DEFAULT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ";

  $sql3 ="CREATE TABLE IF NOT EXISTS `captage` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Captage',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(50) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `surface` varchar(30) NOT NULL,
    `autre` varchar(50) NOT NULL,
    `fauchage_oui` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double DEFAULT NULL,
    `longitude2` double DEFAULT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";


  $sql4 ="CREATE TABLE IF NOT EXISTS `champs_chantier_particulier` (
  `idChamp_chantier_particulier` int(11) NOT NULL AUTO_INCREMENT,
  `idChantier` int(11) NOT NULL,
  `champ_particulier` varchar(50) DEFAULT 'Vide',
  PRIMARY KEY (`idChamp_chantier_particulier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";


  $sql5 ="CREATE TABLE IF NOT EXISTS `chantier` (
  `idChantier` int(11) NOT NULL AUTO_INCREMENT,
  `cloture` enum('True','False') NOT NULL DEFAULT 'False',
  `typeChantier` enum('Sentier entretien balisage','Sentier creation ou entretien plus signaletique','Ruisseau','Captage entretien','Autre type','Custom') DEFAULT NULL,
  `nomClient` varchar(30) NOT NULL DEFAULT 'Vide',
  `nomChantier` varchar(30) NOT NULL DEFAULT 'Vide',
  `numCommande` int(30) NOT NULL,
  `IdChantierAdmin` varchar(50) NOT NULL DEFAULT 'Vide',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`idChantier`),
  UNIQUE KEY `nomClient` (`nomClient`,`nomChantier`,`numCommande`,`IdChantierAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";


  $sql6 ="CREATE TABLE IF NOT EXISTS `intervention` (
  `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
  `idChantier` int(11) NOT NULL,
  `identifiantSite` varchar(30) NOT NULL DEFAULT 'Vide',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idIntervention`),
  UNIQUE KEY `idIntervention` (`idIntervention`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";

  $sql7 ="CREATE TABLE IF NOT EXISTS `intervention_custom` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Intervention custom',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` text NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `champ1` varchar(30) NOT NULL,
    `valeur_champ1` varchar(30) NOT NULL,
    `champ2` varchar(30) NOT NULL,
    `valeur_champ2` varchar(30) NOT NULL,
    `champ3` varchar(30) NOT NULL,
    `valeur_champ3` varchar(30) NOT NULL,
    `champ4` varchar(30) NOT NULL,
    `valeur_champ4` varchar(30) NOT NULL,
    `champ5` varchar(30) NOT NULL,
    `valeur_champ5` varchar(30) NOT NULL,
    `champ6` varchar(30) NOT NULL,
    `valeur_champ6` varchar(30) NOT NULL,
    `champ7` varchar(30) NOT NULL,
    `valeur_champ7` varchar(30) NOT NULL,
    `champ8` varchar(30) NOT NULL,
    `valeur_champ8` varchar(30) NOT NULL,
    `champ9` varchar(30) NOT NULL,
    `valeur_champ9` varchar(30) NOT NULL,
    `champ10` varchar(30) NOT NULL,
    `valeur_champ10` varchar(30) NOT NULL,
    `champ11` varchar(30) NOT NULL,
    `valeur_champ11` varchar(30) NOT NULL,
    `champ12` varchar(30) NOT NULL,
    `valeur_champ12` varchar(30) NOT NULL,
    `champ13` varchar(30) NOT NULL,
    `valeur_champ13` varchar(30) NOT NULL,
    `champ14` varchar(30) NOT NULL,
    `valeur_champ14` varchar(30) NOT NULL,
    `champ15` varchar(30) NOT NULL,
    `valeur_champ15` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double DEFAULT NULL,
    `longitude2` double DEFAULT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ";

  $sql8 ="CREATE TABLE IF NOT EXISTS `ruisseau_ponctuelle` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Ruisseau ponctuelle',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `spinner_invasives` varchar(30) NOT NULL,
    `abattage` varchar(30) NOT NULL,
    `autres_invasives` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";

  $sql9 ="CREATE TABLE IF NOT EXISTS `ruisseau_segment` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Ruisseau segment',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `checkbox_embacles_oui` varchar(30) NOT NULL,
    `checkbox_faconnage_oui` varchar(30) NOT NULL,
    `checkbox_broyage_oui` varchar(30) NOT NULL,
    `checkbox_debroussaillage_oui` varchar(30) NOT NULL,
    `checkbox_nettoyage_oui` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double NOT NULL,
    `longitude2` double NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ";

  $sql10 ="CREATE TABLE IF NOT EXISTS `sentier_balisage` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Sentier balisage',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `spinner_nature_panneau` varchar(30) NOT NULL,
    `spinner_etat` varchar(30) NOT NULL,
    `spinner_entretien` varchar(30) NOT NULL,
    `spinner_acces` varchar(30) NOT NULL,
    `checkbox_charte_oui` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double NOT NULL,
    `longitude2` double NOT NULL,
    `id_segment` varchar(30) NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";

  $sql11 ="CREATE TABLE IF NOT EXISTS `sentier_creation_ponctuelle` (
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Sentier creation ponctuelle',
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `spinner_acces_scp` varchar(30) NOT NULL,
    `abattage_scp` varchar(30) NOT NULL,
    `demontage` varchar(30) NOT NULL,
    `remise_en_etat` varchar(30) NOT NULL,
    `spinner_signaletique` varchar(30) NOT NULL,
    `signaletique_quantite` varchar(30) NOT NULL,
    `signaletique_action` varchar(30) NOT NULL,
    `spinner_medias` varchar(30) NOT NULL,
    `medias_quantite` varchar(30) NOT NULL,
    `medias_action` varchar(30) NOT NULL,
    `spinner_comfort` varchar(30) NOT NULL,
    `comfort_quantite` varchar(30) NOT NULL,
    `comfort_action` varchar(30) NOT NULL,
    `spinner_securite` varchar(30) NOT NULL,
    `securite_quantite` varchar(30) NOT NULL,
    `securite_action` varchar(30) NOT NULL,
    `autre` varchar(30) NOT NULL,
    `autre_quantite` varchar(30) NOT NULL,
    `autre_action` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `id_segment` varchar(30) NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";

  $sql12 ="CREATE TABLE IF NOT EXISTS `sentier_creation_segment` (
    `id_segment` varchar(30) NOT NULL,
    `typeTable` varchar(30) NOT NULL DEFAULT 'Sentier creation segment',
    `idIntervention` int(11) NOT NULL AUTO_INCREMENT,
    `idChantierAdmin` varchar(30) NOT NULL,
    `identifiantSite` varchar(30) NOT NULL,
    `date` varchar(30) NOT NULL,
    `code_equipe` varchar(30) NOT NULL,
    `observation` varchar(400) NOT NULL,
    `spinner_acces_scs` varchar(30) NOT NULL,
    `checkbox_refection` varchar(30) NOT NULL,
    `refection` varchar(30) NOT NULL,
    `checkbox_piochage_1m` varchar(30) NOT NULL,
    `piochage_1m` varchar(30) NOT NULL,
    `checkbox_piochage_1m5` varchar(30) NOT NULL,
    `piochage_1m5` varchar(30) NOT NULL,
    `checkbox_fauchage_1_cote` varchar(30) NOT NULL,
    `fauchage_1_cote` varchar(30) NOT NULL,
    `checkbox_fauchage_2_cote` varchar(30) NOT NULL,
    `fauchage_2_cote` varchar(30) NOT NULL,
    `checkbox_epierrage` varchar(30) NOT NULL,
    `epierrage` varchar(30) NOT NULL,
    `checkbox_deroctage` varchar(30) NOT NULL,
    `deroctage` varchar(30) NOT NULL,
    `checkbox_elagage_1_cote` varchar(30) NOT NULL,
    `elagage_1_cote` varchar(30) NOT NULL,
    `checkbox_elagage_2_cote` varchar(30) NOT NULL,
    `elagage_2_cote` varchar(30) NOT NULL,
    `checkbox_calage` varchar(30) NOT NULL,
    `calage` varchar(30) NOT NULL,
    `checkbox_curage` varchar(30) NOT NULL,
    `curage` varchar(30) NOT NULL,
    `checkbox_reprise_platelage` varchar(30) NOT NULL,
    `reprise_platelage` varchar(30) NOT NULL,
    `checkbox_reprise_garde_corps` varchar(30) NOT NULL,
    `reprise_garde_corps` varchar(30) NOT NULL,
    `latitude` double NOT NULL,
    `longitude` double NOT NULL,
    `latitude2` double NOT NULL,
    `longitude2` double NOT NULL,
    `lieu_Dit` varchar(30) NOT NULL,
    `idChantier` int(11) NOT NULL,
    `photo1` text NOT NULL,
    `photo2` text NOT NULL,
    `photo3` text NOT NULL,
    `photo4` text NOT NULL,
    `photo5` text NOT NULL,
    `photo6` text NOT NULL,
    PRIMARY KEY (`idIntervention`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ";
  /*FIN de création des tables pour la base de données.*/

  /*Création d'un compte pour l'administrateur.*/
  $sql13 = "INSERT INTO administrateur (idAdmin, login, motDePasse) VALUES (
          '" .    1                         . "',
          '" . 	$loginAdmin				          . "',
          '" . 	$motDepasseAdmin				    . "')";
  /*FIN de création d'un compte pour l'administrateur.*/

  /*L'envoie des requêtes sql.*/
    $i = 0;
    $arraySql = array($sql1, $sql2, $sql3, $sql4, $sql5, $sql6, $sql7, $sql8, $sql9, $sql10, $sql11, $sql12, $sql13);

    while ($i < sizeof($arraySql)){
      mysqli_query($connectBDD, $arraySql[$i]);
      $i++;
    }

?>
