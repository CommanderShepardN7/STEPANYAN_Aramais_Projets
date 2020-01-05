<?php

/*La fonction "choixActionTypeChantier" sert à afficher les boutons pour choisir le type de chantier particulier ou par défaut.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function choixActionTypeChantier(){
?>
<div id="formChoixTypeChantier" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
			<h2 class="modal-title">Créer un chantier</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-footer">
				<button class="btn btn-lg btn-danger" id='iDtype_particulier'>Type particulier</button>
				<button class="btn btn-lg btn-success" id="idButtPar_défaut">Par défaut</button>
			</div>

		</div>
	</div>
</div>

<?php
}
