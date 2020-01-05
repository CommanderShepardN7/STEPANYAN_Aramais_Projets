<?php

/*La fonction "formCreerChantierParticulier" sert à afficher les formulaires pour créer un chantier de type particulier.
	Toutes les "class" servent à styliser les champs.
	Plus d'information sur chaque "class" utilisé est sur https://getbootstrap.com/.*/
function formCreerChantierParticulier(){
?>
<div id = "formCreerChantierParticulier" class="modal fade">
	<div class="modal-dialog modal-lg">
	<div class="modal-content" id ="modal_scroll_page" ><!--id ="modal_scroll_page" Pour pouvoir scroller la page.-->

	<div class="modal-header">
		<h2 class="modal-title">Créer un chantier particulier</h2>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

	<div class="modal-body">
		<form method='post' action='index.php'>
      <div class="form-row">
				<!--***************************************Colonne1************************************************-->
        <div class="col-md-4">

				<div class="form-group">
					<label for="idNomClient">Nom du client</label>
					<input name='nomClient' id = "idNomClient" class="form-control" placeholder="Nom du client" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
				</div>

				<div class="form-group">
					<label for="idNomChantier">Nom du chantier</label>
					<input name='nomChantier' id ='idNomChantier' class="form-control" placeholder="Nom du chantier" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
				</div>

				<div class="form-group">
					<input  name='IdChantierAdmin' id = 'IdChantierAdmin' class="form-control" placeholder="Identifiant chantier" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
				</div>

				<div class="form-group">
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
					<button class="btn  btn-primary" id="bouttAjoutChampNomZone">+</button></br>
				</div>

        <div id='divAjoutChampNomZone'></div><!--L'emplacement pour les champs supplémentaires-->

      </div>
				<!--************************************************************************************************-->

				<!--***************************************Colonne2************************************************-->
        <div class="col-md-8">
				<div class="ml-2"> <!--margin left-->

					<label for="champ_particulier">Créer les champs particuliers</label>
          <div class="form-group input-group">
            <input name='champ_particulier[]' id="champ_particulier" class="form-control" placeholder="Champ particulier" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
            <button class="btn  btn-primary" id="bouttAjoutChampParticulrChantier">+</button></br>
          </div>

          <div id='divAjoutChampParticulrChantier'></div><!--L'emplacement pour les champs supplémentaires-->

				</div>
        </div>
				<!--************************************************************************************************-->

    </div>
		</div>

		<div class="modal-footer">
			<button class="btn btn-lg btn-danger" data-dismiss="modal">Annuler</button>
			<button class="btn btn-lg  btn-success" name='ValiderAjoutChantierPartr' type="submit" value='Valider'>Valider</button>
		</div>

    </form>
	</div>
	</div>
</div>
	<!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery.Sert à la gestion des champs supplémentaires.-->
	<script type="text/javascript" src="myJS/ajouteChantierParticulier.js"></script>
<?php
}
