/*Pour pouvoir ajouter des champs supplémentaires pour nommer les zones d'un chantier */
$(document).ready(function() {
  var max_Champs      = 10;                                       //Le nombre des champs dont on peut creer.
  var wrapper   		= $("#divAjoutChampNomZoneDefaut");                // Id de l'emplacement pour les champs.
  var add_button      = $("#bouttAjoutChampNomZoneDefaut");           //Id de bouton pour ajouter les champs.
  var x = 1;                                                   //Compteur des champs.

  $(add_button).click(function(e){                           //Lorsque on clique sur le bouton.
    e.preventDefault();
    if(x < max_Champs){                                     //Si on n'a pas dépassé la limite de nombre des champs.
      x++;
      $(wrapper)
      .append('<div class="form-group input-group"><input name="identifiant_site[]" class="form-control" placeholder="Identifiant site" required="required" pattern="^[^<>]+$" title="Le caractère < ou > est interdit"/><a href="#" class="supprimeChampsDefaut btn btn-danger">-</a></div>'); //add input box
    }
  });

  $(wrapper).on("click",".supprimeChampsDefaut", function(e){      //Lorsque on clique sur le bouton pour supprimer.
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
  });
/*-------------------------------------------------------------------------------------------------------------------------------------------------------------*/
