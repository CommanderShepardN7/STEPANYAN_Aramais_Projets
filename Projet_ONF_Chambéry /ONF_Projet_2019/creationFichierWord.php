<?php
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;

// Crée un document vide.
function creationFichier(){	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();

  return $phpWord;
}

// Test si "$date" est comprise entre "$dateDebut" et "$dateFin" 
function estComprisEntre( $date, $dateDebut, $dateFin ){
  $bool = ($dateDebut <= $date) && ($dateFin >= $date);
  return $bool;
}

function convertirDate( $dateAv ){
  $date = str_replace('/', '-', $dateAv );
  $dateAp = date("d-m-Y", strtotime($date));
  return $dateAp;
}

// Ajoute les informations des interventions du chantier courant, au document courant.
// Paramètre : Document courant
function constructionFichierWord( \PhpOffice\PhpWord\PhpWord $phpW, $dateDebut, $dateFin ){
  $chantier = getChantier();  // Chantier courant
  $typeInter = $chantier["typeChantier"];  // Type du chantier courant (et de ses interventions)
  $arrayInterventions = getAssocArrayAllIterventions(); // Interventions du chantier courant
  $crComplet = $dateDebut == "COMPLET" && $dateFin == "COMPLET";

  switch ($typeInter) {
    // Détermine le formattage des interventions en fonction de leurs type

    case 'Autre type':
    $array0 = $arrayInterventions[0]; // Interventions du chantier courant

    if ($array0 != null) {
      $lenArray0 = count($array0);

      for ($i=0; $i < $lenArray0 ; $i++) { 
        //  Pour chaque intervention, formattage et ajout au document courant. 
        $inter = $array0[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.

        if ($crComplet) {
          templateAutreControle($phpW, $array0[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateAutreControle($phpW, $array0[$i] );
        }
      }
    }
    break;

    case 'Captage entretien':
    $array1 = $arrayInterventions[1];

    if ($array1 != null) {
      $lenArray1 = count($array1);

      for ($i=0; $i < $lenArray1 ; $i++) { 
        $inter = $array1[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.
        
        if ($crComplet) {
          templateCaptage($phpW, $array1[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateCaptage($phpW, $array1[$i] );
        }
      }
    }
    break;

    case 'Ruisseau':
    $array3 = $arrayInterventions[3];
    $array4 = $arrayInterventions[4];

    if ($array3 != null) {
      $lenArray3 = count($array3);

      for ($i=0; $i < $lenArray3 ; $i++) { 
        $inter = $array3[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.
        
        if ($crComplet) {
          templateRuisseauPonctuel($phpW, $array3[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateRuisseauPonctuel($phpW, $array3[$i] );
        }
      }
    }

    if ($array4 != null) {
      $lenArray4 = count($array4);

      for ($i=0; $i < $lenArray4 ; $i++) { 
        $inter = $array4[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.
        
        if ($crComplet) {
          templateRuisseauSegment($phpW, $array4[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateRuisseauSegment($phpW, $array4[$i] );
        }
      }
    }
    break;

    case 'Sentier entretien balisage':
    $array5 = $arrayInterventions[5];

    if ($array5 != null) {
      $lenArray5 = count($array5);

      for ($i=0; $i < $lenArray5 ; $i++) { 
        $inter = $array5[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.

        if ($crComplet) {
          templateSentierBalisage($phpW, $array5[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateSentierBalisage($phpW, $array5[$i] );
        }
      }
    }
    break;

    case 'Sentier creation ou entretien plus signaletique':
    $array6 = $arrayInterventions[6];
    $array7 = $arrayInterventions[7];

    if ($array6 != null) {
      $lenArray6 = count($array6);

      for ($i=0; $i < $lenArray6 ; $i++) {
        $inter = $array6[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.

        if ($crComplet) {
          templateSentierCreationPonctuelle($phpW, $array6[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateSentierCreationPonctuelle($phpW, $array6[$i] );
        }
      }
    }

    if ($array7 != null) {
      $lenArray7 = count($array7);

      for ($i=0; $i < $lenArray7 ; $i++) { 
        $inter = $array7[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.

        if ($crComplet) {
          templateSentierCreationSegment($phpW, $array7[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateSentierCreationSegment($phpW, $array7[$i] );
        }
      }
    }
    break;

    case 'Custom':
    $array2 = $arrayInterventions[2];

    if ($array2 != null) {
      $lenArray2 = count($array2);

      for ($i=0; $i < $lenArray2 ; $i++) { 
        $inter = $array2[$i];  
        $date = $inter["date"]; // Date de l'intervention courante.

        if ($crComplet) {
          templateCustom($phpW, $array2[$i] );
        } else {
          $date1 = convertirDate( $dateDebut );
          $date2 = convertirDate( $dateFin );
          // L'intervention courante n'est pas ajoutée au Compte Rendu,
          // si sa date n'est pas comprise dans la fourchette spécifiée
          if (estComprisEntre($date, $date1, $date2)) templateCustom($phpW, $array2[$i] );
        }
      }
    }
    break;

    default:   
    break;
    }
}

function noaccent($str)
{
$url = $str;
$url = preg_replace('#Ç#', 'C', $url);
$url = preg_replace('#ç#', 'c', $url);
$url = preg_replace('#è|é|ê|ë#', 'e', $url);
$url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
$url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
$url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
$url = preg_replace('#ì|í|î|ï#', 'i', $url);
$url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
$url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
$url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
$url = preg_replace('#ù|ú|û|ü#', 'u', $url);
$url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
$url = preg_replace('#ý|ÿ#', 'y', $url);
$url = preg_replace('#Ý#', 'Y', $url);
$url = preg_replace('# #', '_', $url);
$url = preg_replace("#'#", '_', $url);

return ($url);
}

// Sauvegarde du document
// Paramètre : Document courant
function enregistrementFichierWord( \PhpOffice\PhpWord\PhpWord $phpW, $dateDebut, $dateFin ){
  $chantier = getChantier();
  $nomChantier = $chantier["nomChantier"];
  $dateToday = date("d-m-Y");
  $date1 = convertirDate( $dateDebut );
  $date2 = convertirDate( $dateFin );
  $dateCompteRendu = ($dateDebut == "COMPLET" && $dateFin == "COMPLET") ? 
                        "Complet du ".$dateToday : "Partiel du ".$date1." au ".$date2 ;
  $nomfichier = noaccent($nomChantier." Compte Rendu ".$dateCompteRendu.".odt");
  $cheminFichier = "fichierCR/".$nomfichier;
  
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpW, 'ODText');
  $objWriter->save($cheminFichier);

  return $cheminFichier;
}

// Génère un compte rendu avec les interventions du chantier courant
function creationCompteRendu($dateDebut, $dateFin){
  $phpW = creationFichier();
  constructionFichierWord($phpW,$dateDebut,$dateFin);
  $cheminFichier = enregistrementFichierWord($phpW,$dateDebut,$dateFin);
  $nomfichier = substr($cheminFichier,10,strlen($cheminFichier)-10);

  echo "</br><center><a id='btnDownload' href=$cheminFichier download=$nomfichier class='btn btn-primary'>Télécharger le Compte Rendu</a></center>";
}