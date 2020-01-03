<?php
//La fonction "makePhotoArray" retourne un tableau avec les chemins vers les dossiers avec les photos.
function makePhotoArray($data){
	return array($data["photo1"], $data["photo2"], $data["photo3"], $data["photo4"], $data["photo5"], $data["photo6"]);
}

//La fonction "makePhotoArray" affiche les photos d'une intervention passé en paramètre dans le "carousel" de bootstrap https://getbootstrap.com/.*/.
function affichePhotos($arrayIntervention){
  $PhotoArray = makePhotoArray($arrayIntervention);
  $i = 1;

	if($PhotoArray[0] === 'null' ){	//Si le tableau avec les chemins vers les photos est vide, on affiche l'image "img/pasDePhoto.jpg".
		echo'
			<center><img src="img/pasDePhoto.jpg" alt="Second slide" width="500" height="500"></center>';
	}else{										//Sinon on affiche le premier photo.
		echo'
			<div class="carousel-item active">
				<img  src="mobile/'.$PhotoArray[0].'" class="d-block w-100" alt="First slide">
			</div>';
		
	}

//On affiche toutes les photos.
  while($i < sizeof($PhotoArray) && $PhotoArray[$i] != 'null'){

		echo'
		<div class="carousel-item">
		  <img src="mobile/'.$PhotoArray[$i].'" class="d-block w-100" alt="Second slide">
		</div>';

	$i++;
  }
  
}

//La fonction "getChampsArray" retourne un tableau avec les noms des champs qui correspond a un type d'intervention passé en paramètre.
function getChampsArray($typeTable){

	$arrayOfChamps;
	$arrayOfChampsArrays = arrayOfChampsArrays();//Récupère un tableau avec des tableaux qui contient les noms des champs pour tout les type d'intervention.

	switch ($typeTable) {
		case 'Autre controle':
				$arrayOfChamps = $arrayOfChampsArrays[0];
			break;

		case 'Captage':
				$arrayOfChamps = $arrayOfChampsArrays[1];
			break;

		case 'Intervention custom':
				$arrayOfChamps = $arrayOfChampsArrays[2];
			break;

		case 'Ruisseau ponctuelle':
				$arrayOfChamps = $arrayOfChampsArrays[3];
			break;

		case 'Ruisseau segment':
				$arrayOfChamps = $arrayOfChampsArrays[4];
			break;

		case 'Sentier balisage':
				$arrayOfChamps = $arrayOfChampsArrays[5];
			break;

		case 'Sentier creation ponctuelle':
				$arrayOfChamps = $arrayOfChampsArrays[6];
			break;

		case 'Sentier creation segment':
				$arrayOfChamps = $arrayOfChampsArrays[7];
			break;

	}

	return $arrayOfChamps;
}

//La fonction "gestionPhoto"  permet la gestion des photos.
function gestionPhoto($dataArrayInterventionAfficher){
?>
	</ul>
	</div>

	<div id = "photoIntervention">
		  <!--Carousel Wrapper-->
		<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

		  <!--Slides-->
		  <div class="carousel-inner" role="listbox">
			  <?php
			  affichePhotos($dataArrayInterventionAfficher);//On appelle à la fonction qui va afficher les photos.
			  ?>
		  </div>
		  <!--/.Slides-->

		  <!--Controls-->
		  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Précédent</span>
		  </a>
		  
		  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Suivant</span>
		  </a>
		  <!--/.Controls-->
		  
		</div>
		<!--/.Carousel Wrapper-->
		</div>
	</div>

<?php
}

//La fonction "affiche_detailles_intervention" affiche les informations d'une intervention à gauche de la page et appelle à la fonction qui affiche les photos a droite de la page.
function affiche_detailles_intervention(){

	$dataArrayInterventionAfficher = $_GET['dataArray'];//On récupère les informations d'une intervention de URL de la page.
	$arrayOfChamps = getChampsArray($dataArrayInterventionAfficher["typeTable"]);//On obtient les noms des champs qui correspond a ce type d'intervention.
	$i = 0;

  echo "
  <div class='pageInterventionAndPhoto'>

  <div id='pageIntervention'>

      <div class='text-center mb-4'>
        <h1 class='h3 mb-3 font-weight-normal'>".$dataArrayInterventionAfficher["identifiantSite"]."</h1>
      </div>
	  
	<ul class= 'list-group list-group-flush' >
	  ";
//On affiche toutes les détailles d'une intervention..
	foreach ($dataArrayInterventionAfficher as $value) {
		if($i < sizeof($arrayOfChamps)){
			echo'
			
			<li class="list-group-item"><strong>'.$arrayOfChamps[$i].':   </strong>'.$value.'</li>';
			
			$i++;
		}
	}
	
	gestionPhoto($dataArrayInterventionAfficher);
}
