<script>
/*La fonction "afficheInfoChantierDetailles" ouvre la fenêtre, après avoir cliqué sur le bouton, avec des informations d'un chantier.*/
function afficheInfoChantierDetailles(){
  $('#infoChantierModal').modal("toggle");
}

</script>

<?php

/*La fonction "infoDetaillesChantier" sert à afficher les détaillés d'un chantier.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/

function infoDetaillesChantier(){

  $result = findChantierByID(getIdChantierfromURL());
  $row = mysqli_fetch_assoc($result);

  echo '
    <div id="infoChantierModal" class="modal fade">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">

       <div class="modal-header">
       <h2 class="modal-title">'.$row["typeChantier"].'</h2>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <div class="modal-body">

      <ul class= "list-group list-group-flush">
        <li class="list-group-item"><strong>Nom du client:   </strong>'.$row["nomClient"].'</li>
        <li class="list-group-item"><strong>Nom du chantier:   </strong>'.$row["nomChantier"].'</li>
        <li class="list-group-item"><strong>Numero de la commande:   </strong>'.$row["numCommande"].'</li>
        <li class="list-group-item"><strong>Identifiant chantier:   </strong>'.$row["IdChantierAdmin"].'</li>

       </br>';

       afficheChamps_chantier_particulier();

       echo '
      </ul>

      </div>
     </div>
    </div>';

}


/*La fonction "afficheChamps_chantier_particulier" sert à afficher les champs particuliers d'un chantier custom.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function afficheChamps_chantier_particulier(){
  $i = 0;
  $result = getChamps_chantier_particulier();

  if (mysqli_num_rows($result) != 0 ){
    echo '
    <h3 class="modal-title">Champs particuliers</h2>
	</br>';

    while($row = mysqli_fetch_assoc($result)) {
      echo '
        <li class="list-group-item"><strong>Champ '.$i.':   </strong>'.$row["champ_particulier"].'</li>';
      $i++;
    }
  }
}
