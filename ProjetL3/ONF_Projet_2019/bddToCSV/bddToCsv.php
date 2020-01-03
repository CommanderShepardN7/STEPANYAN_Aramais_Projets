<?php

function creationCsv(){
	

	$chantier = getChantierpourcsv(getIdChantierfromURL());
	if($chantier != NULL){

		$typeChantier = $chantier["typeChantier"];
	
		switch($typeChantier){
	 
			case 'Ruisseau':
				$interventions = recupereRuisseauSegment($chantier["idChantier"]);
				$interventions2 = recupereRuisseauPonctuelle($chantier["idChantier"]);
			break;
	
			case 'Captage entretien':
				$interventions = recupereCaptages($chantier["idChantier"]);
			break;
	
			case 'Autre type':
				$interventions = recupereAutreInter($chantier["idChantier"]);
			break;
	
			case 'Sentier creation ou entretien plus signaletique':
				$interventions = recupereSentierSegment($chantier["idChantier"]);
				$interventions2 = recupereSentierPonctuelle($chantier["idChantier"]);
			break;
	
			case 'Sentier entretien balisage':
				$interventions = recupereSentierBalisage($chantier["idChantier"]);
			break;
	
			case 'Custom':
				$interventions = recupereInterCustom($chantier["idChantier"]);
			break;
	
		}
	
	
	
		if((sizeof($interventions) == 0 && !isset($interventions2) )|| (isset($interventions2) && sizeof($interventions) == 0 && sizeof($interventions2) == 0)){

			return "Pas d'interventions";
		}else{

			$list[] = array("Nom du chantier : ".utf8_decode($chantier['IdChantierAdmin']),"","","","","","","","");
			$list[] = array("","","","","","","","","");
			$list[] = array("Identifiant zone","Equipe","Lieu-dit","Observations","Date","Latitude debut","Longitude debut","Latitude fin","Longitude fin");
		


			for($i =0;$i<sizeof($interventions);$i++){
				if($interventions[$i]['latitude']==$interventions[$i]['latitude2'] && $interventions[$i]['longitude'] == $interventions[$i]['longitude2']){
					$list[] = array(utf8_decode($interventions[$i]['identifiantSite']),utf8_decode($interventions[$i]['code_equipe']),utf8_decode($interventions[$i]['lieu_Dit']),utf8_decode($interventions[$i]['observation']),$interventions[$i]['date'],$interventions[$i]['latitude'],$interventions[$i]['longitude'],"","");
				}else{
					$list[] = array(utf8_decode($interventions[$i]['identifiantSite']),utf8_decode($interventions[$i]['code_equipe']),utf8_decode($interventions[$i]['lieu_Dit']),utf8_decode($interventions[$i]['observation']),$interventions[$i]['date'],$interventions[$i]['latitude'],$interventions[$i]['longitude'],$interventions[$i]['latitude2'],$interventions[$i]['longitude2']);
				}
			}
			if(isset($interventions2)){
				for($i =0;$i<sizeof($interventions2);$i++){
						$list[] = array(utf8_decode($interventions2[$i]['identifiantSite']),utf8_decode($interventions2[$i]['code_equipe']),utf8_decode($interventions2[$i]['lieu_Dit']),utf8_decode($interventions2[$i]['observation']),$interventions2[$i]['date'],$interventions2[$i]['latitude'],$interventions2[$i]['longitude'],"","");
				}
			}
		
	 
			$today = date("d-m-Y");
			function str_to_noaccent($str)
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
		$idChantierAdmin =str_to_noaccent($chantier["IdChantierAdmin"]);
		$name = "./fichier_csv/".$today."_chantier_".$idChantierAdmin.".csv";

		$fp = fopen($name, "w");
		foreach($list as $fields):
			fputcsv($fp, $fields,";");
		endforeach;
		fclose($fp);
		
		return $name;
		}
		
	}else{
		return "Pas d'interventions";
	}
			
}




?>