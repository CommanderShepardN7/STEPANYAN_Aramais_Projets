<?php
/*La fonction "formStylePetitMenu" sert à afficher une icone pour regrouper les liens lorsque l'ecran devient petit.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function formStylePetitMenu(){?>
	<!--Menu pour les petits ecrans -->
		<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#menuAdapt'>
			<span class='navbar-toggler-icon'></span>	<!-- style menu -->
		</button>
		<!--FIN Menu pour les petits ecrans -->

		<div class='collapse navbar-collapse' id='menuAdapt'>
			<ul class='navbar-nav ml-auto'>
	<?php
}

//La fonction "wordZIpLink" sert à afficher des liens pour la création du fichier Word ou zip.
function wordZIpLink($page){
	if ($page == "interventionInfo"){
		
		$idChantier = getIdChantierfromURL();
		$result = findChantierByID($idChantier);			
		$row= mysqli_fetch_array($result);
		
		$idChantierAdmin= $row["IdChantierAdmin"];
		echo"
		<li class='nav-item active'>
		<a href='index.php?page=creer_WORD&amp;id=".$idChantier."&idChantier=".$idChantier."&idChantierAdmin=".$idChantierAdmin."'  class='nav-link'>Créer un Compte Rendu</a></li>
		<li class='nav-item active'>
			<a href='index.php?page=creer_ZIP&idChantier=".$idChantier."&idChantierAdmin=".$idChantierAdmin."'  class='nav-link'>Récupérer les photos</a></li>";
	}
}

//La fonction "wordZIpLink"  sert à afficher le lien pour la création du fichier CSV.
function cSVLink($page){
	if ($page == "interventionInfo"){
		$name = creationCsv();

		if($name !="Pas d'interventions"){
			$nomfichier = substr($name,14,strlen($name)-14);
			echo"
				<li class='nav-item active'>
					<a href='$name' download='$nomfichier' class='nav-link'>Generer CSV</a>
				</li>";
		}

	}
}

/*La fonction "bar_navigation_admin" sert à afficher en chapeau de la page les liens pour naviguer sur le site ->
	 ->lorsque on est connecté autant que administrateur.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function bar_navigation_admin(){
			global $page;
			formStylePetitMenu();
			echo"
					<li class='nav-item active'>
						<a href='index.php?page=creationChantier' class='nav-link'>Créer un chantier</a>
					</li>

					<li class='nav-item active'>
						<a href='index.php?page=chantiersEnCours' class='nav-link'>Chantiers en cours</a>
					</li>

					<li class='nav-item active'>
						<a href='index.php?page=voirTousChantiers' class='nav-link'>Chantiers clôturés</a>
					</li>";

			wordZIpLink($page);
			cSVLink($page);

			echo"
					<li class='nav-item active'>
						<a href='index.php?page=deconnection' class='nav-link'>Déconnexion</a>
					</li>
				</ul>
			</div>";
		}
