<?php

/*La fonction "formCreerChantier" sert à afficher les formulaires pour créer un chantier lorsque on clique sur la carte.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function formCreerChantier(){
?>
<div id="formCreerChantier" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" id ="modal_scroll_page" ><!--id ="modal_scroll_page" Pour pouvoir scroller la page.-->

			<div class="modal-header">
			<h2 class="modal-title">Créer un chantier</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
			<form class="form-signin"  method='post' action='index.php'>
				<div class="form-group">
					<input name="nomClient" id = "idNomClient" class="form-control" placeholder="Nom du client" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
				</div>

				<div class="form-row"><!--Deux colonnes-->
					<div class="form-group col">	<!--Premiere colonne-->
						<label for="idNomChantier">Nom du chantier</label>
						<input name="nomChantier" id ="idNomChantier" class="form-control" placeholder="Nom du chantier" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
					</div>

					<div class="form-group col-md-4"><!--Deuxieme colonne-->
							<label for="typeChantier">Type de chantier</label>
							<select name="typeChantier" id="typeChantier" class="form-control">
									<option value="Sentier entretien balisage">Sentier entretien balisage</option>
									<option value="Sentier creation ou entretien plus signaletique">Sentier création ou entretien + signalétique</option>
									<option value="Ruisseau">Ruisseau</option>
									<option value="Captage entretien">Captage entretien</option>
									<option disabled>...</option>
									<option value="Autre type">Autre type</option>
							</select>
					</div>
				</div><!--Fin Deux colonnes-->

				<div class="form-label-group">
					<input  name='IdChantierAdmin' id = 'IdChantierAdmin' class="form-control" placeholder="Identifiant chantier" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
				</div>

				<div class="form-label-group">
					<input type = 'number' id = 'idNumber' name='numCommande' class="form-control" placeholder="N° du bon de commande" required="required"/>
				</div>

				<div class="form-group">
					<label for="latT">Latitude</label>
					<input  name='latitude' id="latT" class="form-control" placeholder="Latitude" required="required" readonly/>
				</div>

				<div class="form-group">
					<label for="longT">Longitude</label>
					<input  name='longitude' id="longT" class="form-control" placeholder="Longitude" required="required" readonly/>
				</div>

				<label for="identifiant_site">Créer les zones</label>
				<div class="form-group input-group">
					<input name='identifiant_site[]' id="identifiant_site" class="form-control" placeholder="Identifiant site" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
					<button class="btn  btn-primary" id="bouttAjoutChampNomZoneDefaut">+</button></br>
				</div>

        <div id='divAjoutChampNomZoneDefaut'></div><!--L'emplacement pour les champs supplémentaires-->

      </div>

				<div class="modal-footer">
					<button class="btn btn-lg btn-danger" data-dismiss="modal">Annuler</button>
					<button class="btn btn-lg btn-success" name='action' type="submit" value='Valider'>Valider</button>
				</div>

			</form>
		</div>
	</div>
</div>
<!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery.Sert à la gestion des champs supplémentaires.-->
<script type="text/javascript" src="myJS/ajouteNomsZones.js"></script>
<?php
}
