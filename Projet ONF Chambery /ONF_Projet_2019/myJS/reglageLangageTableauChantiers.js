/*Customisation de l'information de tableau.*/
$(document).ready(function () {
$('#dtDynamicVerticalScrollExample').DataTable({
"scrollY": "50vh",
"scrollCollapse": true,
"language": {
    "lengthMenu": "Afficher _MENU_ lignes par page",
    "zeroRecords": "Rien n'a été trouvé, désolé",
    "info": "Afficher la page _PAGE_ de _PAGES_",
    "search":         "Rechercher:",
    "paginate": {
    "first":      "Premier",
    "last":       "Dernier",
    "next":       "Suivant",
    "previous":   "Précédent"},
    "infoEmpty": "Aucun résultat trouvé",
    "infoFiltered": "(filtré à partir de _MAX_ enregistrements au total)"
  }
});
});
