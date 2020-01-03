<?php
	
		include_once "../db/dataConnexion.php";
		include_once "../db/db.php";
		global $connect;
		
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

		//Variables intervention commun
		$IdChantier = addslashes($_POST["IdChantierAdmin"]);
		$idCleAdmin = $_POST["idUniqueChantier"]*1;
		$Type = addslashes($_POST["Type"]);
		$type_inter = addslashes($_POST["type_inter"]);
		$LatDebut = $_POST["LatDebut"]*1.0;
		$LngDebut = $_POST["LngDebut"]*1.0;
		$LatFin = $_POST["LatFin"]*1.0;
		$LngFin = $_POST["LngFin"]*1.0;
		if($LatFin == 0){
			$LatFin = $LatDebut;
		}
		if($LngFin == 0){
			$LngFin = $LngDebut;
		}
		
		$Date = substr(addslashes($_POST["Date"]),0,10);
		$Equipe = addslashes($_POST["Equipe"]);
		$Name = addslashes($_POST["Name"]);
		$lieu_Dit = addslashes($_POST["lieu_Dit"]);
		$observations = addslashes($_POST["Observations"]);
		$photo1 = $_POST["photo1"];
		$photo2 = $_POST["photo2"];
		$photo3 = $_POST["photo3"];
		$photo4 = $_POST["photo4"];
		$photo5 = $_POST["photo5"];
		$photo6 = $_POST["photo6"];
		
		
		
		if($photo1 != "null"){
			$val1 = $_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo1";
			$Nom_photo1a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val1.jpg";
			$Nom_photo1  = str_to_noaccent($Nom_photo1a);
			
		}else{
			$Nom_photo1 = $photo1;
		}
		if($photo2 != "null"){
			$val2 =$_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo2";
			$Nom_photo2a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val2.jpg";
			$Nom_photo2  = str_to_noaccent($Nom_photo2a);
		}else{
			$Nom_photo2 = $photo2;
		}
		if($photo3 != "null"){
			$val3 = $_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo3";
			$Nom_photo3a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val3.jpg";
			$Nom_photo3 = str_to_noaccent($Nom_photo3a);
		}else{
			$Nom_photo3 = $photo3;
		}
		if($photo4 != "null"){
			$val4 = $_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo4";
			$Nom_photo4a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val4.jpg";
			$Nom_photo4  = str_to_noaccent($Nom_photo4a);
		}else{
			$Nom_photo4 = $photo4;
		}
		if($photo5 != "null"){
			$val5 = $_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo5";
			$Nom_photo5a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val5.jpg";
			$Nom_photo5  = str_to_noaccent($Nom_photo5a);
		}else{
			$Nom_photo5 = $photo5;
		}
		if($photo6 != "null"){
			$val6 = $_POST["IdChantierAdmin"]."_".$_POST["idUniqueChantier"]."_".$_POST["Name"]."_".$_POST["Date"]."photo6";
			$Nom_photo6a = "photo/"."$IdChantier"."_"."$idCleAdmin"."/"."$Name"."/$val6.jpg";
			$Nom_photo6  = str_to_noaccent($Nom_photo6a);
		}else{
			$Nom_photo6 = $photo6;
		}
		
		
		if($type_inter == "Sentier creation ou entretien plus signaletique" && ($Type == "Ponctuel" || $Type == "GPSPonctuel")){
					
			//Variables intervention Sentier création ou entretien + signalétique ponctuel
			$Acces = addslashes($_POST["Acces"]);
			$Abattage = addslashes($_POST["Abattage"]);
			$Demontage = addslashes($_POST["Demontage"]);
			$Remise_en_etat = addslashes($_POST["Remise_en_etat"]);
			$Signaletique = addslashes($_POST["Signaletique"]);
			$Signaletique_quantite = addslashes($_POST["Signaletique_quantite"]);
			$Signaletique_action = addslashes($_POST["Signaletique_action"]);
			$Medias = addslashes($_POST["Medias"]);
			$Medias_quantite = addslashes($_POST["Medias_quantite"]);
			$Medias_action = addslashes($_POST["Medias_action"]);
			$Comfort = addslashes($_POST["Comfort"]);
			$Comfort_quantite = addslashes($_POST["Comfort_quantite"]);
			$Comfort_action = addslashes($_POST["Comfort_action"]);
			$Securite = addslashes($_POST["Securite"]);
			$Securite_quantite = addslashes($_POST["Securite_quantite"]);
			$Securite_action = addslashes($_POST["Securite_action"]);
			$Autre = addslashes($_POST["Autre"]);
			$Autre_quantite = addslashes($_POST["Autre_quantite"]);
			$Autre_action = addslashes($_POST["Autre_action"]);
			$id_point_segment = addslashes($_POST["id_point_segment"]);
		
			$sql = "INSERT INTO sentier_creation_ponctuelle (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`id_segment`,`identifiantSite`,`date`,`code_equipe`,`observation`,`spinner_acces_scp`,`abattage_scp`,`demontage`,`remise_en_etat`,
			`spinner_signaletique`,`signaletique_quantite`,`signaletique_action`,`spinner_medias`,`medias_quantite`,`medias_action`,`spinner_comfort`,`comfort_quantite`,`comfort_action`,`spinner_securite`,`securite_quantite`,`securite_action`,`autre`,`autre_quantite`,`autre_action`,`latitude`,`longitude`) 
			values ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$id_point_segment','$Name','$Date','$Equipe','$observations','$Acces','$Abattage','$Demontage','$Remise_en_etat',
			'$Signaletique','$Signaletique_quantite','$Signaletique_action','$Medias','$Medias_quantite','$Medias_action','$Comfort','$Comfort_quantite','$Comfort_action','$Securite','$Securite_quantite','$Securite_action','$Autre','$Autre_quantite','$Autre_action','$LatDebut','$LngDebut')";
			
		}else if ($type_inter == "Sentier creation ou entretien plus signaletique" && $Type == "Lineaire" ){	
		
			//Variables intervention Sentier création ou entretien + signalétique Lineaire
			$Acces = addslashes($_POST["Acces"]);
			$refectionAssietteOk = addslashes($_POST["refectionAssietteOk"]);
			$piochage1mOk = addslashes($_POST["piochage1mOk"]);
			$piochage1m5Ok = addslashes($_POST["piochage1m5Ok"]);
			$fauchage1coteOk = addslashes($_POST["fauchage1coteOk"]);
			$fauchage2cotesOk = addslashes($_POST["fauchage2cotesOk"]);
			$epierrageOk = addslashes($_POST["epierrageOk"]);
			$deroctageOk = addslashes($_POST["deroctageOk"]);
			$elagage1coteOk = addslashes($_POST["elagage1coteOk"]);
			$elagage2cotesOk = addslashes($_POST["elagage2cotesOk"]);
			$curageReverOk = addslashes($_POST["curageReverOk"]);
			$calageOk = addslashes($_POST["calageOk"]);
			$reprisePlatelageOk = addslashes($_POST["reprisePlatelageOk"]);
			$reprisegardecorpseOk = addslashes($_POST["reprisegardecorpseOk"]);
			
			$Refection = addslashes($_POST["Refection"]);
			$Piochage1m = addslashes($_POST["Piochage1m"]);
			$Piochage1m5 = addslashes($_POST["Piochage1m5"]);
			$Fauchage1cote = addslashes($_POST["Fauchage1cote"]);
			$Fauchage2cotes = addslashes($_POST["Fauchage2cotes"]);
			$Epierage = addslashes($_POST["Epierage"]);
			$Deroctage = addslashes($_POST["Deroctage"]);
			$Elagage1cote = addslashes($_POST["Elagage1cote"]);
			$Elagage2cotes = addslashes($_POST["Elagage2cotes"]);
			$CurageRevers = addslashes($_POST["CurageRevers"]);
			$Calage = addslashes($_POST["Calage"]);
			$ReprisePlatelage = addslashes($_POST["ReprisePlatelage"]);
			$RepriseGardeCorps = addslashes($_POST["RepriseGardeCorps"]);
			$id_point_segment = addslashes($_POST["id_point_segment"]);
			
			$sql = "INSERT INTO sentier_creation_segment (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`id_segment`,`identifiantSite`,`date`,`code_equipe`,`observation`,`spinner_acces_scs`,`checkbox_refection`,`refection`,
			`checkbox_piochage_1m`,`piochage_1m`,`checkbox_piochage_1m5`,`piochage_1m5`,`checkbox_fauchage_1_cote`,`fauchage_1_cote`,`checkbox_fauchage_2_cote`,`fauchage_2_cote`,
			`checkbox_epierrage`,`epierrage`,`checkbox_deroctage`,`deroctage`,`checkbox_elagage_1_cote`,`elagage_1_cote`,`checkbox_elagage_2_cote`,`elagage_2_cote`,`checkbox_calage`,
			`calage`,`checkbox_curage`,`curage`,`checkbox_reprise_platelage`,`reprise_platelage`,`checkbox_reprise_garde_corps`,`reprise_garde_corps`,`latitude`,`longitude`,`latitude2`,`longitude2`) 
			values ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$id_point_segment','$Name','$Date','$Equipe','$observations','$Acces','$refectionAssietteOk','$Refection','$piochage1mOk','$Piochage1m','$piochage1m5Ok',
			'$Piochage1m5','$fauchage1coteOk','$Fauchage1cote','$fauchage2cotesOk','$Fauchage2cotes','$epierrageOk','$Epierage','$deroctageOk','$Deroctage','$elagage1coteOk','$Elagage1cote',
			'$elagage2cotesOk','$Elagage2cotes','$calageOk','$Calage','$curageReverOk','$CurageRevers','$reprisePlatelageOk','$ReprisePlatelage','$RepriseGardeCorps','$RepriseGardeCorps','$LatDebut','$LngDebut','$LatFin','$LngFin')";
			
		}else if ($type_inter == "Ruisseau" && ($Type == "Ponctuel" || $Type == "GPSPonctuel")) {
			
			//Variables intervention Ruisseau ponctuel
			$Abattage_complex = addslashes($_POST["Abattage_complexe"]);
			$Autres_invasive = addslashes($_POST["Autres_invasive"]);
			$Invasive_renoue = addslashes($_POST["Invasive_renoue"]);
			$sql ="INSERT INTO ruisseau_ponctuelle (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`identifiantSite`,`date`,`code_equipe`,`observation`,`spinner_invasives`,`abattage`,`autres_invasives`,`latitude`,`longitude`)
			VALUES ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$Name','$Date','$Equipe','$observations.','$Invasive_renoue','$Abattage_complex','$Autres_invasive','$LatDebut','$LngDebut')";
			
		}else if ($type_inter == "Ruisseau" && $Type == "Lineaire" ){
			
			//Variables intervention Ruisseau lineaire
			$Embacle = addslashes($_POST["Embacle"]);
			$Debroussaillage = addslashes($_POST["Debroussaillage"]);
			$Broyage = addslashes($_POST["Broyage"]);
			$Faconnage = addslashes($_POST["Faconnage"]);
			$Nettoyage = addslashes($_POST["Nettoyage"]);
			
			$sql ="INSERT INTO ruisseau_segment (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`identifiantSite`,`date`,`code_equipe`,`observation`,`checkbox_embacles_oui`,`checkbox_faconnage_oui`,`checkbox_broyage_oui`,`checkbox_debroussaillage_oui`,`checkbox_nettoyage_oui`,`latitude`,`longitude`,`latitude2`,`longitude2`)
			VALUES ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$Name','$Date','$Equipe','$observations','$Embacle','$Faconnage','$Broyage','$Debroussaillage','$Nettoyage','$LatDebut','$LngDebut','$LatFin','$LngFin')";
			
		}else if ($type_inter == "Autre type"){
			
			//Variables Autre Type d'emprise
			$Vegetation = addslashes($_POST["Vegetation"]);
			$Nature_travaux = addslashes($_POST["Nature_travaux"]);
			$Urgence = addslashes($_POST["Urgence"]);
			$Acces_pieton = addslashes($_POST["Acces_pieton"]);
			$sql ="INSERT INTO autre_controle (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`identifiantSite`,`date`,`code_equipe`,`observation`,`spinner_type_vegetation`,`spinner_nature_travaux`,`spinner_urgence`,`checkbox_acces_oui`,`latitude`,`longitude`,`latitude2`,`longitude2`)
			VALUES ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$Name','$Date','$Equipe','$observations','$Vegetation','$Nature_travaux','$Urgence','$Acces_pieton','$LatDebut','$LngDebut','$LatFin','$LngFin')";
		
		}else if ($type_inter == "Captage entretien"){
			
			//Variables Captage entretien
			$Surface = addslashes($_POST["Surface"]);
			$Autre_captage = addslashes($_POST["Autre_captage"]);
			$Fauchage = addslashes($_POST["Fauchage"]);
			$sql ="INSERT INTO captage (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`identifiantSite`,`date`,`code_equipe`,`observation`,`surface`,`autre`,`fauchage_oui`,`latitude`,`longitude`,`latitude2`,`longitude2`)
			VALUES ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$Name','$Date','$Equipe','$observations','$Surface','$Autre_captage','$Fauchage','$LatDebut','$LngDebut','$LatFin','$LngFin')";
			
			
		}else if ($type_inter == "Sentier entretien balisage"){
			
			//Variables Sentier entretien balisage
			$Nature_panneau = addslashes($_POST["Nature_panneau"]);
			$Etat = addslashes($_POST["Etat"]);
			$Entretien = addslashes($_POST["Entretien"]);
			$Acces = addslashes($_POST["Acces"]);
			$Charte = addslashes($_POST["Charte"]);
			$id_point_segment = addslashes($_POST["id_point_segment"]);
			$sql ="INSERT INTO sentier_balisage (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`lieu_Dit`,`id_segment`,`identifiantSite`,`date`,`code_equipe`,`observation`,`spinner_nature_panneau`,`spinner_etat`,`spinner_entretien`,`spinner_acces`,`checkbox_charte_oui`,`latitude`,`longitude`,`latitude2`,`longitude2`)
			VALUES ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$lieu_Dit','$id_point_segment','$Name','$Date','$Equipe','$observations','$Nature_panneau','$Etat','$Entretien','$Acces','$Charte','$LatDebut','$LngDebut','$LatFin','$LngFin')";
			
			
		}else if($type_inter == "Custom"){
			$champ1 = addslashes($_POST["champ1"]);
			$champ2 = addslashes($_POST["champ2"]);
			$champ3 = addslashes($_POST["champ3"]);
			$champ4 = addslashes($_POST["champ4"]);
			$champ5 = addslashes($_POST["champ5"]);
			$champ6 = addslashes($_POST["champ6"]);
			$champ7 = addslashes($_POST["champ7"]);
			$champ8 = addslashes($_POST["champ8"]);
			$champ9 = addslashes($_POST["champ9"]);
			$champ10 = addslashes($_POST["champ10"]);
			$champ11 = addslashes($_POST["champ11"]);
			$champ12 = addslashes($_POST["champ12"]);
			$champ13 = addslashes($_POST["champ13"]);
			$champ14 = addslashes($_POST["champ14"]);
			$champ15 = addslashes($_POST["champ15"]);
			
			$valeur_champ1 = addslashes($_POST["valeur_champ1"]);
			$valeur_champ2 = addslashes($_POST["valeur_champ2"]);
			$valeur_champ3 = addslashes($_POST["valeur_champ3"]);
			$valeur_champ4 = addslashes($_POST["valeur_champ4"]);
			$valeur_champ5 = addslashes($_POST["valeur_champ5"]);
			$valeur_champ6 = addslashes($_POST["valeur_champ6"]);
			$valeur_champ7 = addslashes($_POST["valeur_champ7"]);
			$valeur_champ8 = addslashes($_POST["valeur_champ8"]);
			$valeur_champ9 = addslashes($_POST["valeur_champ9"]);
			$valeur_champ10 = addslashes($_POST["valeur_champ10"]);
			$valeur_champ11 = addslashes($_POST["valeur_champ11"]);
			$valeur_champ12 = addslashes($_POST["valeur_champ12"]);
			$valeur_champ13 = addslashes($_POST["valeur_champ13"]);
			$valeur_champ14 = addslashes($_POST["valeur_champ14"]);
			$valeur_champ15 = addslashes($_POST["valeur_champ15"]);
			
			
			
			$sql = "INSERT INTO intervention_custom (`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,`idChantier`,`idChantierAdmin`,`identifiantSite`,`date`,`code_equipe`,`observation`,`lieu_Dit`,
			`champ1`,`valeur_champ1`,`champ2`,`valeur_champ2`,`champ3`,`valeur_champ3`,`champ4`,`valeur_champ4`,`champ5`,`valeur_champ5`,
			`champ6`,`valeur_champ6`,`champ7`,`valeur_champ7`,`champ8`,`valeur_champ8`,`champ9`,`valeur_champ9`,`champ10`,`valeur_champ10`,
			`champ11`,`valeur_champ11`,`champ12`,`valeur_champ12`,`champ13`,`valeur_champ13`,`champ14`,`valeur_champ14`,`champ15`,`valeur_champ15`
			,`latitude`,`longitude`,`latitude2`,`longitude2`)
					values ('$Nom_photo1','$Nom_photo2','$Nom_photo3','$Nom_photo4','$Nom_photo5','$Nom_photo6','$idCleAdmin','$IdChantier','$Name','$Date','$Equipe','$observations','$lieu_Dit',
					'$champ1','$valeur_champ1','$champ2','$valeur_champ2','$champ3','$valeur_champ3','$champ4','$valeur_champ4','$champ5','$valeur_champ5',
					'$champ6','$valeur_champ6','$champ7','$valeur_champ7','$champ8','$valeur_champ8','$champ9','$valeur_champ9','$champ10','$valeur_champ10',
					'$champ11','$valeur_champ11','$champ12','$valeur_champ12','$champ13','$valeur_champ13','$champ14','$valeur_champ14','$champ15','$valeur_champ15',
					'$LatDebut','$LngDebut','$LatFin','$LngFin')";
		}else{
			echo"Erreur de type d'intervention";
		}
		
		
	
		
		if(mysqli_query($connect,$sql)){
			echo "INSERT OK";
			$id =str_to_noaccent($IdChantier);
			$idcle = str_to_noaccent($idCleAdmin);
			$nom = str_to_noaccent($Name);
			if($Nom_photo1 != "null"){
				if(!is_dir("photo/"."$id"."_"."$idcle")){
					mkdir("photo/"."$id"."_"."$idcle",0777,false);
				}
				if(!is_dir("photo/"."$id"."_"."$idcle"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idcle"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo1,base64_decode($photo1));

			}
			if($Nom_photo2 != "null"){
				if(!is_dir("photo/"."$id"."_"."$idcle")){
					mkdir("photo/"."$id"."_"."$idcle",0777,false);
					
				}
				if(!is_dir("photo/"."$id"."_"."$idcle"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idcle"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo2,base64_decode($photo2));

			}
			if($Nom_photo3 != "null"){
					if(!is_dir("photo/"."$id"."_"."$idcle")){
					mkdir("photo/"."$id"."_"."$idcle",0777,false);
				}
				if(!is_dir("photo/"."$id"."_"."$idcle"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idcle"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo3,base64_decode($photo3));

			}
			if($Nom_photo4 != "null"){
				if(!is_dir("photo/"."$id"."_"."$idcle")){
					mkdir("photo/"."$id"."_"."$idcle",0777,false);
				}
				if(!is_dir("photo/"."$id"."_"."$idcle"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idcle"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo4,base64_decode($photo4));

			}
			if($Nom_photo5 != "null"){
				if(!is_dir("photo/"."$id"."_"."$idcle")){
					mkdir("photo/"."$id"."_"."$idcle",0777,false);
				}
				if(!is_dir("photo/"."$id"."_"."$idCleAdmin"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idCleAdmin"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo5,base64_decode($photo5));
			}
			if($Nom_photo6 != "null"){
				if(!is_dir("photo/"."$id"."_"."$idCleAdmin")){
					mkdir("photo/"."$id"."_"."$idCleAdmin",0777,false);
				}
				if(!is_dir("photo/"."$id"."_"."$idCleAdmin"."/"."$nom")){
					mkdir("photo/"."$id"."_"."$idCleAdmin"."/"."$nom",0777,false);
				}
				file_put_contents($Nom_photo6,base64_decode($photo6));
			}

			
		}else{
			echo "ECHEC INSERT \n";
			echo $sql;
		}
		
		
		mysqli_close($connect);



?>