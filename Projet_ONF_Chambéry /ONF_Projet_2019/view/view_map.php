<?php
 /*La fonction "carteScriptConnect" fait la connexion de fichier script de la carte.*/
function carteScriptConnect(){
  ?>
  <div class="OSMap" id="OSMap"</span>></div> <!--Div pour la carte-->
  <!--JS pour la carte-->
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin="">
  </script>
  <?php
}

function chargerCarte(){
  ?>
  <script>
  var mymap = L.map('OSMap').setView([46, 5], 7); //On cree la variable "mymap" et on position la carte "setView([latitude,longitude], zoom)".
  /*"L.tileLayer": est un damier et le lien apres indique comment charger la carte.*/
  L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    /*copyright*/attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
      maxZoom: 18,
  }).addTo(mymap);
  </script>
  <?php
}

/*La fonction "creer_map" sert à afficher la carte.
Pour avoir plus d'information https://leafletjs.com/.*/
function creer_map(){
  global $page;
  carteScriptConnect();
  chargerCarte();

  /*On affiche les marqueurs sur la page 'voirTousChantiers' */
  if($page == 'chantiersEnCours'){
    echo '<script type="text/javascript">','setMarkersOnMap(mymap,"ChantiersNonCloture");','</script>';
  }

  if($page == 'voirTousChantiers'){
    echo '<script type="text/javascript">','setMarkersOnMap(mymap,"ChantiersCloture");','</script>';
  }


  /*On affiche les marqueurs des interventions.*/
  if($page == 'interventionInfo'){
    echo '<script type="text/javascript">','setInterventionMarkersOnMap(mymap);','</script>';
  }
  ?>

  <script>

  /*La fonction "onMapClick" sert à apparaitre le formulaire pour creer un chantier.*/
  function onMapClick(e) {
    $('#formChoixTypeChantier').modal("toggle");

      $("#iDtype_particulier" ).click(function() {
      $('#formChoixTypeChantier').modal("toggle");
      //On appele le formulaire dont l'identifiant est "formCreerChantier"
      $('#formCreerChantierParticulier').modal("toggle");
    });

      $( "#idButtPar_défaut" ).click(function() {
      $('#formChoixTypeChantier').modal("toggle");
      //On appele le formulaire dont l'identifiant est "formCreerChantier"
      $('#formCreerChantier').modal("toggle");
    });

    /* On recupere latitude et longitude choisie par l'administrateur après avoir cliqué dans un endroit sur la carte et on les mets
      dans les champs dont id est 'latT' et 'longT' de formulaire "formCreerChantier" ou "formCreerChantierParticulier"*/
    $('#formCreerChantier #latT').val(e.latlng.lat);
    $('#formCreerChantier #longT').val(e.latlng.lng);

    $('#formCreerChantierParticulier #latT').val(e.latlng.lat);
    $('#formCreerChantierParticulier #longT').val(e.latlng.lng);

  }
  mymap.on('click', onMapClick);  // Pour la fonction "onMapClick".

  </script><?php
}
?>
<script>

/*La fonction "setInterventionMarkersOnMap" met les marqueurs des interventions sur la carte.*/
function setInterventionMarkersOnMap(map){
  <?php
  $interventionsPHPArray = getAssocArrayAllIterventions(); //Cette variable stock le tableau php avec les chantiers.
  ?>;

  var interventionsJSarray = <?php echo json_encode($interventionsPHPArray); ?>; //Transformation de tableau php en tableau JS.

  //On place tous les chantiers sur la carte qui sont dans le tableau "chantierJSArray"
  for (var i in interventionsJSarray){
    var intervention = interventionsJSarray[i];

    /*La méthode Array.isArray() permet de déterminer si l'objet passé en argument est un objet Array,
    elle renvoie true si le paramètre passé à la fonction est de type Array et false dans le cas contraire.*/
    if (Array.isArray(intervention)){

      for (var key in intervention) {

        /*Marqueur avec les 'latitude' et 'longitude' */
        /*L.marker([intervention[key].latitude, intervention[key].longitude]).addTo(map)
        .bindPopup(intervention[key].identifiantSite).openPopup();*/

        L.marker([intervention[key].latitude, intervention[key].longitude]).addTo(map)
        .bindPopup('<center><b>' + intervention[key].identifiantSite + '</b></center>'+
                   'Code equipe: <i>' + intervention[key].code_equipe + '</i>'+
                   '</br>Date: <i>' + intervention[key].date + '</i>'
      ).openPopup();

		/*La méthode hasOwnProperty() retourne un booléen indiquant si l'objet possède la propriété spécifiée "en propre", sans que celle-ci provienne de la chaîne de prototypes de l'objet.*/
        if(intervention[key].hasOwnProperty("latitude2") && !testMemeCordonne(intervention[key].latitude, intervention[key].longitude, intervention[key].latitude2, intervention[key].longitude2) ){

          /*Marqueur avec les 'latitude2' et 'longitude2' */
          L.marker([intervention[key].latitude2, intervention[key].longitude2]).addTo(map)
          .bindPopup('<center><b>' + intervention[key].identifiantSite + '</b></center>'+
                     'Code equipe: <i>' + intervention[key].code_equipe + '</i>'+
                     '</br>Date: <i>' + intervention[key].date + '</i>'
        ).openPopup();

          /*****************La ligne entre les deux marqueurs.*****************/
          var latlngs = [
            [intervention[key].latitude, intervention[key].longitude],
            [intervention[key].latitude2, intervention[key].longitude2]
          ];
          var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

          // Zoomer la carte sur la polyligne.
          map.fitBounds(polyline.getBounds());
          /*****************Fin "La ligne entre les deux marqueurs" *****************/
        }

      }
    }
  }

/*La fonction "testMemeCordonne" return true si les coordonnées sont égales, false sinon*/
function testMemeCordonne(lat1, long1, lat2, long2){
	return (lat1 == lat2 && long1== long2);
}

}

</script>
