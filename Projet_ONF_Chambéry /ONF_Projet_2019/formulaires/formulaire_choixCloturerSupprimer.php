<script>
/*Les fonctions qui activent les boutons qui ouvrent les pages de gestion d'un chantier.*/

function afficheChoixSupClot(){
  $('#formChoixCloturerSupprimer').modal("toggle");
}

function cloturerButton(){
  $('#formChoixCloturerSupprimer').modal("toggle");
  $('#cloturerModal').modal("toggle");
}

function supprimerButton(){
  $('#formChoixCloturerSupprimer').modal("toggle");
  $('#supprimerModal').modal("toggle");
}
/**********************************************************/
</script>


<?php
/*La fonction "choixActionSupprimerCloturerChantier" sert à afficher les boutons pour choisir si on veut supprimer ou cloturer un chantier.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function choixActionSupprimerCloturerChantier(){
	
?>
<div id="formChoixCloturerSupprimer" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
			<h2 class="modal-title">Gestion du chantier</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-footer">

      <?php
	  
	  /*On affiche le bouton Supprimer si le chantier ne possède pas d'interventions ou s'il est clôturé. */
        if (chantierEstCloture(getIdChantierfromURL()) ) {
          echo' <button type="button" class="btn btn-lg btn-danger" onclick="supprimerButton()">Supprimer</button>';
        }

	/*On affiche le bouton Cloturer si le chantier n'est pas clôturé. */
        if (!chantierEstCloture(getIdChantierfromURL())){
          echo '<button  type="button" class="btn btn-lg btn-success" onclick="cloturerButton()">Cloturer</button>';
        }
      ?>

      </div>

		</div>
	</div>
</div>

<?php
cloturerChantier();
supprimerChantier();
}


/*La fonction "cloturerChantier" sert à afficher une fenetre pour cloturer un chantier.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function cloturerChantier(){
  ?>

  <div id="cloturerModal" class="modal fade">
  	<div class="modal-dialog modal-lg">
  		<div class="modal-content">

  			<div class="modal-header">
  			<h2 class="modal-title">Voulez vous cloturer ce chantier ?</h2>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>


  			<div class="modal-footer">
          <form method='post'>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button class="btn btn-primary" name='cloturerChantierButton' type="submit" value='Cloturer'>Cloturer</button>

          </form>

  			</div>

  		</div>
  	</div>
  </div>

<?php
}

/*La fonction "supprimerChantier" sert à afficher une fenetre pour supprimer un chantier.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function supprimerChantier(){

  ?>
  <div id="supprimerModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
        <h2 class="modal-title">Voulez vous supprimer ce chantier ?</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-footer">
          <form method='post'>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button class="btn btn-primary" name='supprimerChantierButton' type="submit" value='Supprimer'>Supprimer</button>

          </form>

        </div>

      </div>
    </div>
  </div>

  <?php
}
?>
