<!DOCTYPE html>
<html>
 <head>
   		<meta charset="UTF-8">
      <title>ONF</title>
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <!--bootstrap-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<?php
	
	function getDateFromPhoto($idChantier,$idChantierAdmin,$identifiantSite,$nomPhoto){
		$length=strlen($idChantierAdmin."_".$idChantier."_".$identifiantSite."_");
		$date123=substr($nomPhoto,$length,10);
		$date123=str_replace("-","/",$date123);
		return($date123);
	}
	

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

	include_once "db/dataConnexion.php";
	
	global $host;
	global $username;
	global $my_password;
	global $my_db;
	$connect=mysqli_connect($host,$username,$my_password,$my_db);

	$idChantierAcc=$_GET['idChantier'];
	$idChantierAcc=intval($idChantierAcc);
    $idChantierAdminAcc=$_GET['idChantierAdmin'];
    $dateDeb=$_GET['dateDeb'];
    $dateFin=$_GET['dateFin'];


    $idChantier=str_to_noaccent($idChantierAcc);
	$idChantierAdmin=str_to_noaccent($idChantierAdminAcc);
	 //connexion a la base de données
	$tabFichiers=array();//declaration du tableau qui contiendra les chemins des elements a zipper
	////on recupere l'identifiant du site de l'intervention
	
	$sql ="SELECT identifiantSite FROM intervention WHERE idChantier='".$idChantier."' ";
	$query=mysqli_query($connect,$sql);

	//pour toutes les interventions du Chantier selectionné on vas faire (ce qui est dans la boucle)
	while($row= mysqli_fetch_array($query))
	{	
		$identifiantSite=$row['identifiantSite'];
		$identifiantSite=str_to_noaccent($identifiantSite);

		$OK=99;
		$OK1=100;
		//on ecrit le chemin dans le quels il y aura des eventuelles photos
		$dir = "mobile/photo/".$idChantierAdmin."_".$idChantier."/".$identifiantSite."/";
		if (is_dir($dir)) 
		{
		 if ($Pointeur = opendir($dir)) 
		  {
		   while (($file = readdir($Pointeur)) !== false) 
		      {
		      	if ($file=="." || $file==".." ){ $OK=1; }
		       	if ($file!="." && $file!=".." ){ $OK=0; $OK1=0;}
		       }
		   closedir($Pointeur);
		  }
		}


		if( $OK1==0){ //Si OK=0 cela signifie que le repertoire existe et surtout qu'il n'est pas vide
			if($dossier = opendir($dir)) // on ouvre le repertoire
			{	
				//tant qu'il y a des fichiers dans le dossier on vas faire :
			   while(($fichier = readdir($dossier)))
			   	{	
			   		if( ($fichier!=".") && ($fichier!="..")){
			   		// condition ajouté pour eviter de recuperer les fichiers lié au system en local mais j'ai preferé la garder quand-meme.

					    	//ici on rajoute le nom du fichier au chemin du dossier pour pouvoir le recuperer plus tard
					    	if($dateDeb==0 && $dateFin==0){
						       	$dirFichier=$dir.$fichier;
						       	array_push($tabFichiers, $dirFichier); //on ajoute donc le chemin 
						       }
						       else{
						       	$dateFichier = getDateFromPhoto($idChantier,$idChantierAdmin,$identifiantSite,$fichier);
						       	//var_dump($dateFichier);
						       	$Deb=date($dateDeb);
						       	$Dfin=date($dateFin);
						       	$Dfich=date($dateFichier);

							       	if(($Deb<=$Dfich)&&($Dfich<=$Dfin)){
							       		$dirFichier=$dir.$fichier;
							       		array_push($tabFichiers, $dirFichier); //on ajoute donc le chemi
							       	}
 								}
						       
					    }
			       	}
   			  	}
			}
		}


	require( "lib/zip.lib.php" ) ; //on fait appel a la  librairie ZIP
	 $zip = new zipfile () ; //on crée une instance ZIP


	$i=0;
	//echo("<br>");
	while (count ($tabFichiers)>$i){
		$fo = fopen($tabFichiers[$i],'r') ; //on point le contenu du tableau 
		$contenu = fread($fo, filesize($tabFichiers[$i])) ; //on enregistre le contenu
		fclose($fo) ; //on ferme fichier
	  	$zip->addfile($contenu, $tabFichiers[$i]) ; //on ajoute le fichier
		$i++;
	}

	$archive = $zip->file() ; // on associe l'archive

	 // on enregistre l'archive dans un fichier

	$today = date("d-m-Y");//on recupere la date d'aujourd'hui
	$name = "./fichiers-zip/".$today."_Photos".$idChantierAcc."_".$idChantierAdminAcc.".zip";
	$open = fopen($name , "wb");//on 
	fwrite($open, $archive);
	fclose($open);
?>
	<header>
    <!-- Mise en place de bar de navigation avec des styles dont vient de bootstrap.min.css-->
    <nav class='navbar navbar-expand-md navbar-light bg-light sticky-top'>
      <div class='container-fluid'>
        <a href='#' class='navbar-brad'><img src='img/Logo-ONF.png'></a>
		
		
				<div class='collapse navbar-collapse' id='menuAdapt'>
				<ul class='navbar-nav ml-auto'>

						<li class='nav-item active'><a href='index.php?page=interventionInfo&id=%20<?php echo($idChantier) ?>' class='nav-link'>Retour au Chantier <?php echo($idChantierAdminAcc) ?></a></li>
						<li class='nav-item active'><a href='index.php?page=chantiersEnCours' class='nav-link'>Chantiers en cours</a></li>
						 
				</ul>
				</div>

      </div>
    </nav>
  </header>
	
	
		<center>
			<font size="5">
					<B>
						<p>Votre fichier ZIP a été généré, vous pouvez desormais le télécharger </p>
					</B>
			</font>
			<img id="img_zip" src="./imgCreationZip/img-zip.png" width="350" height="300"  alt="icone_generation" />
			</br>
			<a id='btnDownload' href='download.php?name=<?php echo($name)?>'class='btn btn-primary'>Télécharger</a>
		</center>
		
	</body>
