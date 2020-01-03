/*Pour pouvoir ajouter des champs supplémentaires pour nommer les zones d'un chantier */
$(document).ready(function() {
  var max_Champs      = 10;                                       //Le nombre des champs dont on peut creer.
  var wrapper   		= $("#divAjoutChampNomZone");                // Id de l'emplacement pour les champs.
  var add_button      = $("#bouttAjoutChampNomZone");           //Id de bouton pour ajouter les champs.
  var x = 1;                                                   //Compteur des champs.

  $(add_button).click(function(e){                           //Lorsque on clique sur le bouton.
    e.preventDefault();
    if(x < max_Champs){                                     //Si on n'a pas dépassé la limite de nombre des champs.
      x++;
      $(wrapper)
      .append('<div class="form-group input-group"><input name="identifiant_site[]" class="form-control" placeholder="Identifiant site" required="required" pattern="^[^<>]+$" title="Le caractère < ou > est interdit"/><a href="#" class="supprimeChamps btn btn-danger">-</a></div>'); //add input box
    }
  });

  $(wrapper).on("click",".supprimeChamps", function(e){      //Lorsque on clique sur le bouton pour supprimer.
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
  });
/*-------------------------------------------------------------------------------------------------------------------------------------------------------------*/

/*Pour pouvoir ajouter des champs supplémentaires pour un chantier de type particulier*/
  $(document).ready(function() {
  var max_Champs      = 10;                                             //Le nombre des champs dont on peut creer.
  var wrapper   		= $("#divAjoutChampParticulrChantier");            // Id de l'emplacement pour les champs.
  var add_button      = $("#bouttAjoutChampParticulrChantier");       //Id de bouton pour ajouter les champs.
  var x = 1;                                                         //Compteur des champs.

  $(add_button).click(function(e){                                 //Lorsque on clique sur le bouton.
    e.preventDefault();
    if(x < max_Champs){                                           //Si on n'a pas dépassé la limite de nombre des champs.
      x++;
      $(wrapper)
      .append('<div class="form-group input-group"><input name="champ_particulier[]" class="form-control" placeholder="Champ particulier" required="required"pattern="^[^<>]+$" title="Le caractère < ou > est interdit"/><a href="#" class="supprimeChamps btn btn-danger">-</a></div>'); //add input box
    }
  });

  $(wrapper).on("click",".supprimeChamps", function(e){      //Lorsque on clique sur le bouton pour supprimer.
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
  });
