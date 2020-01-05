<?php
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;

// Récupère le chantier courant dans la base de données.
function getChantier(){
	global $connect;

		$sql = "SELECT idChantier,typeChantier,nomClient,nomChantier,numCommande,IdChantierAdmin,longitude,latitude
						FROM chantier WHERE idChantier = ".getIdChantierfromURL(); 

        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

		return $row;
}

// Ajout de la carte et des photos
// Paramètres : Document courant, Intervention courante
function ajouterImages(\PhpOffice\PhpWord\PhpWord $phpW, array $inter ){
    
    // Tableau des Photo
    $section2 = $phpW->addSection();
    $section2->addPageBreak();  

    $table2 = $section2->addTable();
    $table2->addRow();
    $table2->addCell(1750)->addText("Photographies : ", array('size' => 11, 'bold' => true) );

    $table3 = $section2->addTable();

    $photo1 = $inter["photo1"];
    $photo2 = $inter["photo2"];
    $photo3 = $inter["photo3"];
    $photo4 = $inter["photo4"];
    $photo5 = $inter["photo5"];
    $photo6 = $inter["photo6"];

    $table3->addRow();
    if($photo1 != "null"){
        $table3->addCell(1750)->addImage('mobile/'.$photo1, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
    } else {
        $table3->addCell(1750)->addText("Il n'y a pas de photo pour cette intervention");
    }
    if($photo2 != "null")   $table3->addCell(1750)->addImage('mobile/'.$photo2, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
    if($photo3 != "null"){
        $table3->addCell(1750)->addImage('mobile/'.$photo3, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
        $table3->addRow();
        $table3->addCell(1750);
        $table3->addCell(1750);
        $table3->addCell(1750);
    }   
    
    if($photo4 != "null"){
        $table3->addRow();
        $table3->addCell(1750)->addImage('mobile/'.$photo4, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
    }   
    if($photo5 != "null")   $table3->addCell(1750)->addImage('mobile/'.$photo5, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
    if($photo6 != "null"){
        $table3->addCell(1750)->addImage('mobile/'.$photo6, array('width' => 210, 'height' => 280, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
        $table3->addRow();
        $table3->addCell(1750);
        $table3->addCell(1750);
        $table3->addCell(1750);
    }   

    //Fin du compte rendu d'intervention
    $section2->addPageBreak();  
}




/////////////////////////////////////////////////////////////////////////
///////////////////     TEMPLATES DE COMPTE RENDU    ////////////////////
/////////////////////////////////////////////////////////////////////////


///////////////////     Templates de la partie commune des interventions    ////////////////////

// Pour les interventions ponctuelles
// Paramètres : Document courant, Intervention courante
function templateCommunPonctuel(\PhpOffice\PhpWord\PhpWord $phpW, array $intersCommun ){ 
    $chantier = getChantier();   // Récupération du chantier courant

    // Champs relatifs au chantier
    $client = $chantier["nomClient"];
    $nomChantier = $chantier["nomChantier"];
    $numCommande = $chantier["numCommande"]; 

    // Champs relatifs à l'intervention 
    $identifiantSite = $intersCommun["identifiantSite"];
    $date = $intersCommun["date"]; 
    $code_equipe = $intersCommun["code_equipe"];
    $lieu_Dit = $intersCommun["lieu_Dit"];
    $observation = $intersCommun["observation"];
    $latitude = $intersCommun["latitude"];
    $longitude = $intersCommun["longitude"];

    //// Début de l'utilisation de la librairie PHPWord
    $section = $phpW->addSection(); // Ajout d'une nouvelle section au document courant
    $header = array('size' => 22, 'bold' => true);  // Définition des paramètres d'affichage du titre
    $text = array('size' => 11, 'bold' => true);
    $section->addText('Compte rendu d’intervention', $header);  // Titre du document
    $section->addText(' ');
    $table = $section->addTable();  // Ajout d'un tableau vide au document courant

    
    for ($r = 1; $r <= 3; $r++) {
        // Ajout de lignes au tableau "$table" 
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {
            // Remplissage et ajout de cellules au tableau "$table"

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Nom du chantier : " . $nomChantier);
                } else {
                    $table->addCell(1750)->addText("Client : " . $client);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("N° Bon Commande : " . $numCommande);
                } else {
                    $table->addCell(1750)->addText("Date d’intervention : " . $date);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Lieu-dit : " . $lieu_Dit);
                } else {
                    $table->addCell(1750)->addText("Identifiant site : " . $identifiantSite);
                }
                break;

                default:   
                break;
            }
        }
    }

    $table0 = $section->addTable();
    $table0->addRow();
    $table0->addCell(1750)->addText("Equipe : " . $code_equipe);
    $table0->addRow();
    $table0->addCell(1750)->addText("Coordonnées GPS :
    Latitude " . $latitude . "
    Longitude " . $longitude);

    $section->addText(' ');
    $table2 = $section->addTable();// Ajout d'un tableau vide au document courant
    $table2->addRow();
    $table2->addCell(1750)->addText("Observations : " . $observation);

    $section->addText(' ');
}

// Pour les interventions interventions segments et ponctuelles
// Paramètres : Document courant, Intervention courante
function templateCommun(\PhpOffice\PhpWord\PhpWord $phpW, array $intersCommun ){ 
    $row = getChantier();    // Récupération du chantier courant

    // Champs relatifs au chantier
    $client = $row["nomClient"];
    $nomChantier = $row["nomChantier"];
    $numCommande = $row["numCommande"]; 

    // Champs relatifs à l'intervention 
    $identifiantSite = $intersCommun["identifiantSite"];
    $date = $intersCommun["date"]; 
    $code_equipe = $intersCommun["code_equipe"];
    $lieu_Dit = $intersCommun["lieu_Dit"];
    $observation = $intersCommun["observation"];
    $latitude = $intersCommun["latitude"];
    $longitude = $intersCommun["longitude"];
    $latitude2 = ($intersCommun["latitude2"] != $latitude) ? $intersCommun["latitude2"] : " " ;
    $longitude2 = ($intersCommun["longitude2"] != $longitude) ? $intersCommun["longitude2"] : " " ;

    //// Début de l'utilisation de la librairie PHPWord
    $section = $phpW->addSection(); // Ajout d'une nouvelle section au document courant
    $header = array('size' => 22, 'bold' => true);  // Définition des paramètres d'affichage du titre
    $text = array('size' => 11, 'bold' => true);
    $section->addText('Compte rendu d’intervention', $header);  // Titre du document
    $table = $section->addTable();  // Ajout d'un tableau vide au document courant



    for ($r = 1; $r <= 3; $r++) {
        // Ajout de lignes au tableau "$table" 
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {
            // Remplissage et ajout de cellules au tableau "$table"

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Nom du chantier : " . $nomChantier);
                } else {
                    $table->addCell(1750)->addText("Client : " . $client);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("N° Bon Commande : " . $numCommande);
                } else {
                    $table->addCell(1750)->addText("Date d’intervention : " . $date);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Lieu-dit : " . $lieu_Dit);
                } else {
                    $table->addCell(1750)->addText("Identifiant site : " . $identifiantSite);
                }
                break;

                default:   
                break;
            }
        }
    }

    $table0 = $section->addTable();
    $table0->addRow();
    $table0->addCell(1750)->addText("Equipe : " . $code_equipe);
    $table0->addRow();
    $table0->addCell(1750)->addText("Coordonnées GPS : 
    Latitude " . $latitude . "      " .$latitude2 ."
    Longitude " . $longitude . "      " . $longitude2);

    $table2 = $section->addTable();
    $table2->addRow();
    $table2->addCell(1750)->addText("Observations : " . $observation);

    $section->addText(' ');
}

///////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////     Templates de la partie spécifique au type d'intervention   ////////////////////

// Template type Autre 
// Paramètres : Document courant, Intervention courante
function templateAutreControle(\PhpOffice\PhpWord\PhpWord $phpW, array $intersAutreControle ){ 
    templateCommun($phpW, $intersAutreControle);
    $text = array('size' => 11, 'bold' => true);

    $spinner_type_vegetation = $intersAutreControle["spinner_type_vegetation"];
    $spinner_nature_travaux = $intersAutreControle["spinner_nature_travaux"];
    $spinner_urgence = $intersAutreControle["spinner_urgence"];
    $checkbox_acces_oui = $intersAutreControle["checkbox_acces_oui"];

    $checkbox_acces_oui = ($checkbox_acces_oui === 'oui') ? 'Oui' : 'Non' ;

    $section = $phpW->addSection();
    $table = $section->addTable();

    for ($r = 1; $r <= 4; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Type de végétation : ", $text);
                } else {
                    $table->addCell(1750)->addText($spinner_type_vegetation);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Nature travaux : ", $text);
                } else {
                    $table->addCell(1750)->addText($spinner_nature_travaux);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Urgence : ", $text);
                } else {
                    $table->addCell(1750)->addText($spinner_urgence);
                }
                break;

                case 4:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Accès piéton : ", $text);
                } else {
                    $table->addCell(1750)->addText($checkbox_acces_oui);
                }
                break;

                default:   
                break;
            }
        }
    }
    ajouterImages($phpW, $intersAutreControle);              
}

// AJOUTER gestion Point / Segment
/// Template Captage
function templateCaptage(\PhpOffice\PhpWord\PhpWord $phpW, array $intersCaptage ){ 
    templateCommun($phpW, $intersCaptage);

    $surface = $intersCaptage["surface"];
    $autre = $intersCaptage["autre"];
    $checkbox_fauchage_oui = $intersCaptage["fauchage_oui"];

    $checkbox_fauchage_oui = ($checkbox_fauchage_oui === 'oui') ? 'Oui' : 'Non' ;

    $section = $phpW->addSection();
    $table = $section->addTable();
    for ($r = 1; $r <= 3; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Surface : ");
                } else {
                    $table->addCell(1750)->addText($surface);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Autre : ");
                } else {
                    $table->addCell(1750)->addText($autre);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Fauchage : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_fauchage_oui);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersCaptage);  
}             

/// Template Ruisseau Ponctuel
function templateRuisseauPonctuel(\PhpOffice\PhpWord\PhpWord $phpW, array $intersRuisseauPonctuel ){ 
    templateCommunPonctuel($phpW, $intersRuisseauPonctuel);

    $spinner_invasives = $intersRuisseauPonctuel["spinner_invasives"];
    $abattage = $intersRuisseauPonctuel["abattage"];
    $autres_invasives = $intersRuisseauPonctuel["autres_invasives"];

    $section = $phpW->addSection();
    $table = $section->addTable();

    for ($r = 1; $r <= 3; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Abattage Complexe : ");
                } else {
                    $table->addCell(1750)->addText($abattage);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Invasives - Renouée : ");
                } else {
                    $table->addCell(1750)->addText($spinner_invasives);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Autres Invasives : ");
                } else {
                    $table->addCell(1750)->addText($autres_invasives);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersRuisseauPonctuel); 
}

/// Template Ruisseau Segment
function templateRuisseauSegment(\PhpOffice\PhpWord\PhpWord $phpW, array $intersRuisseauSegment ){ 
    templateCommun($phpW, $intersRuisseauSegment);

    $checkbox_embacles_oui = $intersRuisseauSegment["checkbox_embacles_oui"];
    $checkbox_faconnage_oui = $intersRuisseauSegment["checkbox_faconnage_oui"];
    $checkbox_broyage_oui = $intersRuisseauSegment["checkbox_broyage_oui"];
    $checkbox_debroussaillage_oui = $intersRuisseauSegment["checkbox_debroussaillage_oui"];
    $checkbox_nettoyage_oui = $intersRuisseauSegment["checkbox_nettoyage_oui"];

    $checkbox_embacles_oui = ($checkbox_embacles_oui === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_faconnage_oui = ($checkbox_embacles_oui === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_broyage_oui = ($checkbox_embacles_oui === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_debroussaillage_oui = ($checkbox_embacles_oui === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_nettoyage_oui = ($checkbox_embacles_oui === 'oui') ? 'Oui' : 'Non' ;

    $section = $phpW->addSection();
    $table = $section->addTable();
    for ($r = 1; $r <= 5; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Coupe et évacuation des arbres en travers (embâcles) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_embacles_oui);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Façonnage et ébranchage / billonnage : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_faconnage_oui);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Broyage : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_broyage_oui);
                }
                break;

                case 4:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Débroussaillage et piochage : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_debroussaillage_oui);
                }
                break;

                case 5:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Nettoyage (buses, désableurs, dégrilleurs, etc) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_nettoyage_oui);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersRuisseauSegment); 
}

// AJOUTER gestion Point / Segment
/// Template Sentier Balisage
function templateSentierBalisage(\PhpOffice\PhpWord\PhpWord $phpW, array $intersSentierBalisage ){ 
    templateCommun($phpW, $intersSentierBalisage);

    $spinner_nature_panneau = $intersSentierBalisage["spinner_nature_panneau"];
    $spinner_etat = $intersSentierBalisage["spinner_etat"];
    $spinner_entretien = $intersSentierBalisage["spinner_entretien"];
    $spinner_acces = $intersSentierBalisage["spinner_acces"];
    $checkbox_charte_oui = $intersSentierBalisage["checkbox_charte_oui"];

    $checkbox_charte_oui = ($checkbox_charte_oui === true) ? 'Oui' : 'Non' ;

    $section = $phpW->addSection();
    $table = $section->addTable();
    for ($r = 1; $r <= 5; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Nature panneau : ");
                } else {
                    $table->addCell(1750)->addText($spinner_nature_panneau);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Etat : ");
                } else {
                    $table->addCell(1750)->addText($spinner_etat);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Entretien : ");
                } else {
                    $table->addCell(1750)->addText($spinner_entretien);
                }
                break;

                case 4:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Accès : ");
                } else {
                    $table->addCell(1750)->addText($spinner_acces);
                }
                break;

                case 5:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Charte Départementale : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_charte_oui);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersSentierBalisage); 
}

/// Template Sentier Creation Ponctuelle
function templateSentierCreationPonctuelle(\PhpOffice\PhpWord\PhpWord $phpW, array $intersSentierCreationPonctuelle ){ 
    templateCommunPonctuel($phpW, $intersSentierCreationPonctuelle);

    $spinner_acces_scp = $intersSentierCreationPonctuelle["spinner_acces_scp"];
    $abattage_scp = $intersSentierCreationPonctuelle["abattage_scp"];
    $demontage = $intersSentierCreationPonctuelle["demontage"];
    $remise_en_etat = $intersSentierCreationPonctuelle["remise_en_etat"];

    $spinner_signaletique = $intersSentierCreationPonctuelle["spinner_signaletique"];
    $signaletique_quantite = $intersSentierCreationPonctuelle["signaletique_quantite"];
    $signaletique_action = $intersSentierCreationPonctuelle["signaletique_action"];

    $spinner_medias = $intersSentierCreationPonctuelle["spinner_medias"];
    $medias_quantite = $intersSentierCreationPonctuelle["medias_quantite"];
    $medias_action = $intersSentierCreationPonctuelle["medias_action"];

    $spinner_comfort = $intersSentierCreationPonctuelle["spinner_comfort"];
    $comfort_quantite = $intersSentierCreationPonctuelle["comfort_quantite"];
    $comfort_action = $intersSentierCreationPonctuelle["comfort_action"];

    $spinner_securite = $intersSentierCreationPonctuelle["spinner_securite"];
    $securite_quantite = $intersSentierCreationPonctuelle["securite_quantite"];
    $securite_action = $intersSentierCreationPonctuelle["securite_action"];

    $autre = $intersSentierCreationPonctuelle["autre"];
    $autre_quantite = $intersSentierCreationPonctuelle["autre_quantite"];
    $autre_action = $intersSentierCreationPonctuelle["autre_action"];

    $section = $phpW->addSection();

    $table = $section->addTable();

    for ($r = 1; $r <= 19; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Accès : ");
                } else {
                    $table->addCell(1750)->addText($spinner_acces_scp);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Abattage (>diamètre 20) : ");
                } else {
                    $table->addCell(1750)->addText($abattage_scp);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Démontage et évacuation chablis : ");
                } else {
                    $table->addCell(1750)->addText($demontage);
                }
                break;

                case 4:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Remise en état passage de clôture : ");
                } else {
                    $table->addCell(1750)->addText($remise_en_etat);
                } 
                break;

                case 5:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Signalétique pose ou remplacement : ");
                } else {
                    $table->addCell(1750)->addText($spinner_signaletique);
                }
                break;

                case 6:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Quantité : ");
                } else {
                    $table->addCell(1750)->addText($signaletique_quantite);
                }
                break;

                case 7:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Action : ");
                } else {
                    $table->addCell(1750)->addText($signaletique_action);
                } 
                break;

                case 8:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Medias pose ou remplacement : ");
                } else {
                    $table->addCell(1750)->addText($spinner_medias);
                }
                break;

                case 9:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Quantité medias : ");
                } else {
                    $table->addCell(1750)->addText($medias_quantite);
                }
                break;

                case 10:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Action : ");
                } else {
                    $table->addCell(1750)->addText($medias_action);
                } 
                break;

                case 11:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Confort pose ou remplacement : ");
                } else {
                    $table->addCell(1750)->addText($spinner_comfort);
                }
                break;

                case 12:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Quantité comfort : ");
                } else {
                    $table->addCell(1750)->addText($comfort_quantite);
                }
                break;

                case 13:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Action : ");
                } else {
                    $table->addCell(1750)->addText($comfort_action);
                } 
                break;

                case 14:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Sécurité : ");
                } else {
                    $table->addCell(1750)->addText($spinner_securite);
                }
                break;

                case 15:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Quantité sécurité : ");
                } else {
                    $table->addCell(1750)->addText($securite_quantite);
                }
                break;

                case 16:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Action : ");
                } else {
                    $table->addCell(1750)->addText($securite_action);
                } 
                break;

                case 17:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Autre : ");
                } else {
                    $table->addCell(1750)->addText($autre);
                }
                break;

                case 18:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Quantité autre : ");
                } else {
                    $table->addCell(1750)->addText($autre_quantite);
                }
                break;

                case 19:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Action : ");
                } else {
                    $table->addCell(1750)->addText($autre_action);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersSentierCreationPonctuelle);
}

/// Template Sentier Creation Segment
function templateSentierCreationSegment(\PhpOffice\PhpWord\PhpWord $phpW, array $intersSentierCreationSegment ){ 
    templateCommun($phpW, $intersSentierCreationSegment);

    $spinner_acces_scs = $intersSentierCreationSegment["spinner_acces_scs"];

    $checkbox_refection = $intersSentierCreationSegment["checkbox_refection"];
    $refection = $intersSentierCreationSegment["refection"];

    $checkbox_piochage_1m = $intersSentierCreationSegment["checkbox_piochage_1m"];
    $piochage_1m = $intersSentierCreationSegment["piochage_1m"];

    $checkbox_piochage_1m5 = $intersSentierCreationSegment["checkbox_piochage_1m5"];
    $piochage_1m5 = $intersSentierCreationSegment["piochage_1m5"];

    $checkbox_fauchage_1_cote = $intersSentierCreationSegment["checkbox_fauchage_1_cote"];
    $fauchage_1_cote = $intersSentierCreationSegment["fauchage_1_cote"];

    $checkbox_fauchage_2_cote = $intersSentierCreationSegment["checkbox_fauchage_2_cote"];
    $fauchage_2_cote = $intersSentierCreationSegment["fauchage_2_cote"];

    $checkbox_epierrage = $intersSentierCreationSegment["checkbox_epierrage"];
    $epierrage = $intersSentierCreationSegment["epierrage"];

    $checkbox_deroctage = $intersSentierCreationSegment["checkbox_deroctage"];
    $deroctage = $intersSentierCreationSegment["deroctage"];

    $checkbox_elagage_1_cote = $intersSentierCreationSegment["checkbox_elagage_1_cote"];
    $elagage_1_cote = $intersSentierCreationSegment["elagage_1_cote"];

    $checkbox_elagage_2_cote = $intersSentierCreationSegment["checkbox_elagage_2_cote"];
    $elagage_2_cote = $intersSentierCreationSegment["elagage_2_cote"];

    $checkbox_calage = $intersSentierCreationSegment["checkbox_calage"];
    $calage = $intersSentierCreationSegment["calage"];

    $checkbox_curage = $intersSentierCreationSegment["checkbox_curage"];
    $curage = $intersSentierCreationSegment["curage"];

    $checkbox_reprise_platelage = $intersSentierCreationSegment["checkbox_reprise_platelage"];
    $reprise_platelage = $intersSentierCreationSegment["reprise_platelage"];

    $checkbox_reprise_garde_corps = $intersSentierCreationSegment["checkbox_reprise_garde_corps"];
    $reprise_garde_corps = $intersSentierCreationSegment["reprise_garde_corps"];

    $checkbox_refection = ($checkbox_refection === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_piochage_1m = ($checkbox_piochage_1m === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_piochage_1m5 = ($checkbox_piochage_1m5 === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_fauchage_1_cote = ($checkbox_fauchage_1_cote === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_fauchage_2_cote = ($checkbox_fauchage_2_cote === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_epierrage = ($checkbox_epierrage === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_deroctage = ($checkbox_deroctage === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_elagage_1_cote = ($checkbox_elagage_1_cote === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_elagage_2_cote = ($checkbox_elagage_2_cote === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_calage = ($checkbox_calage === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_curage = ($checkbox_curage === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_reprise_platelage = ($checkbox_reprise_platelage === 'oui') ? 'Oui' : 'Non' ;
    $checkbox_reprise_garde_corps = ($checkbox_reprise_garde_corps === 'oui') ? 'Oui' : 'Non' ;

    $section = $phpW->addSection();
    $table = $section->addTable();
    for ($r = 1; $r <= 5; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("Accès : ");
                } else {
                    $table->addCell(1750)->addText($spinner_acces_scs);
                } 
                break;

                case 2:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("réfection complète de l\'assiette (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_refection." _ ".$refection);
                }
                break;

                case 3:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("piochage (ml) 1m : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_piochage_1m." _ ".$piochage_1m);
                }
                break;

                case 4:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("piochage (ml) 1,5m : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_piochage_1m5." _ ".$piochage_1m5);
                }
                break;

                case 5:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("fauchage (ml) 1 côté : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_fauchage_1_cote." _ ".$fauchage_1_cote);
                }
                break;

                case 6:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("fauchage (ml) 2 côtés : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_fauchage_2_cote." _ ".$fauchage_2_cote);
                } 
                break;

                case 7:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("épierrage (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_epierrage." _ ".$epierrage);
                }
                break;

                case 8:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("déroctage (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_deroctage." _ ".$deroctage);
                }
                break;

                case 9:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("élagage (ml) 1 côté : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_elagage_1_cote." _ ".$elagage_1_cote);
                }
                break;

                case 10:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("élagage (ml) 2 côtés : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_elagage_2_cote." _ ".$elagage_2_cote);
                }
                break;

                case 11:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("curage des revers d\'eau (à l\'unité) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_curage." _ ".$curage);
                } 
                break;

                case 12:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("calage caillebottis (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_calage." _ ".$calage);
                }
                break;

                case 13:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("reprise platelage caillebottis ou passerelle (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_reprise_platelage." _ ".$reprise_platelage);
                }
                break;

                case 14:
                if ($c <= 1) {
                    $table->addCell(1750)->addText("reprise garde-corps bois normalisé (ml) : ");
                } else {
                    $table->addCell(1750)->addText($checkbox_reprise_garde_corps." _ ".$reprise_garde_corps);
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersSentierCreationSegment);
}

/// Custom
function templateCustom(\PhpOffice\PhpWord\PhpWord $phpW, array $intersCustom ){ 
    templateCommun($phpW, $intersCustom);

    $champ1 = $intersCustom["champ1"];
    $valeur_champ1 = $intersCustom["valeur_champ1"];
    $champ2 = $intersCustom["champ2"];
    $valeur_champ2 = $intersCustom["valeur_champ2"];
    $champ3 = $intersCustom["champ3"];
    $valeur_champ3 = $intersCustom["valeur_champ3"];
    $champ4 = $intersCustom["champ4"];
    $valeur_champ4 = $intersCustom["valeur_champ4"];
    $champ5 = $intersCustom["champ5"];
    $valeur_champ5 = $intersCustom["valeur_champ5"];
    $champ6 = $intersCustom["champ6"];
    $valeur_champ6 = $intersCustom["valeur_champ6"];
    $champ7 = $intersCustom["champ7"];
    $valeur_champ7 = $intersCustom["valeur_champ7"];
    $champ8 = $intersCustom["champ8"];
    $valeur_champ8 = $intersCustom["valeur_champ8"];
    $champ9 = $intersCustom["champ9"];
    $valeur_champ9 = $intersCustom["valeur_champ9"];
    $champ10 = $intersCustom["champ10"];
    $valeur_champ10 = $intersCustom["valeur_champ10"];
    $champ11 = $intersCustom["champ11"];
    $valeur_champ11 = $intersCustom["valeur_champ11"];
    $champ12 = $intersCustom["champ12"];
    $valeur_champ12 = $intersCustom["valeur_champ12"];
    $champ13 = $intersCustom["champ13"];
    $valeur_champ13 = $intersCustom["valeur_champ13"];
    $champ14 = $intersCustom["champ14"];
    $valeur_champ14 = $intersCustom["valeur_champ14"];
    $champ15 = $intersCustom["champ15"];
    $valeur_champ15 = $intersCustom["valeur_champ15"];

    $section = $phpW->addSection();
    $table = $section->addTable();

    for ($r = 1; $r <= 15; $r++) {
        $table->addRow();
        for ($c = 1; $c <= 2; $c++) {

            switch ($r) {

                case 1:
                if ($champ1 != 'Aucune donnée' && $valeur_champ1 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ1 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ1);
                    } 
                }
                break;

                case 2:
                if ($champ2 != 'Aucune donnée' && $valeur_champ2 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ2 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ2);
                    } 
                }
                break;

                case 3:
                if ($champ3 != 'Aucune donnée' && $valeur_champ3 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ3 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ3);
                    } 
                }
                break;

                case 4:
                if ($champ4 != 'Aucune donnée' && $valeur_champ4 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ4 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ4);
                    } 
                }
                break;

                case 5:
                if ($champ5 != 'Aucune donnée' && $valeur_champ5 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ5 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ5);
                    } 
                }
                break;

                case 6:
                if ($champ6 != 'Aucune donnée' && $valeur_champ6 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ6 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ6);
                    } 
                }
                break;

                case 7:
                if ($champ7 != 'Aucune donnée' && $valeur_champ7 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ7 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ7);
                    } 
                }
                break;

                case 8:
                if ($champ8 != 'Aucune donnée' && $valeur_champ8 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ8 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ8);
                    } 
                }
                break;

                case 9:
                if ($champ9 != 'Aucune donnée' && $valeur_champ9 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ9 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ9);
                    } 
                }
                break;

                case 10:
                if ($champ10 != 'Aucune donnée' && $valeur_champ10 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ10 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ10);
                    } 
                }
                break;

                case 11:
                if ($champ11 != 'Aucune donnée' && $valeur_champ11 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ11 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ11);
                    } 
                }
                break;

                case 12:
                if ($champ12 != 'Aucune donnée' && $valeur_champ12 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ12 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ12);
                    } 
                }
                break;

                case 13:
                if ($champ13 != 'Aucune donnée' && $valeur_champ13 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ13 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ13);
                    } 
                }
                break;

                case 14:
                if ($champ14 != 'Aucune donnée' && $valeur_champ14 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ14 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ14);
                    } 
                }
                break;

                case 15:
                if ($champ15 != 'Aucune donnée' && $valeur_champ15 != 'Aucune donnée') {
                    if ($c <= 1) {
                        $table->addCell(1750)->addText($champ15 . " : ");
                    } else {
                        $table->addCell(1750)->addText($valeur_champ15);
                    } 
                }
                break;

                default:   
                break;
            }
        }
    }

    ajouterImages($phpW, $intersCustom);
}