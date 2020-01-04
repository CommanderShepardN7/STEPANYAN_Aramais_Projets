<script>

/*La fonction "setMarkersOnMap" sert à afficher les chantiers sur la  carte.
	Pour avoir plus d'information https://leafletjs.com/.*/
function setMarkersOnMap(map, typeChantier){

  if (typeChantier == "ChantiersNonCloture"){
    setMarkersOnMapChantiersNonCloture(map);
  }
  else if (typeChantier == "ChantiersCloture"){
    setMarkersOnMapChantiersCloture(map);
  }

}

function setMarkersOnMapChantiersNonCloture(map){
  <?php $chantierPHPArray = getChantiersArray(getChantiersNonCloture());?>

  var chantierJSArray = <?php echo json_encode($chantierPHPArray); ?>; //Transformation de tableau php en tableau JS.
  //On place tous les chantiers sur la carte qui sont dans le tableau "chantierJSArray"
  for (var key in chantierJSArray) {
    L.marker([chantierJSArray[key].latitude, chantierJSArray[key].longitude]).addTo(map)
    .bindPopup('<center><b>' + chantierJSArray[key].nomChantier + '</b></center>'+
               'Nom du client: <i>' + chantierJSArray[key].nomClient + '</i>'+
               '</br>N° du bon de commande: <i>' + chantierJSArray[key].numCommande + '</i>'+
               '</br>Identifiant chantier: <i>' + chantierJSArray[key].IdChantierAdmin + '</i>'
  ).openPopup();
  }

}

function setMarkersOnMapChantiersCloture(map){
  <?php $chantierPHPArray = getChantiersArray(getChantiersCloture());?>

  var chantierJSArray = <?php echo json_encode($chantierPHPArray); ?>; //Transformation de tableau php en tableau JS.
  //On place tous les chantiers sur la carte qui sont dans le tableau "chantierJSArray"
  for (var key in chantierJSArray) {
    L.marker([chantierJSArray[key].latitude, chantierJSArray[key].longitude]).addTo(map)
    .bindPopup('<center><b>' + chantierJSArray[key].nomChantier + '</b></center>'+
               'Nom du client: <i>' + chantierJSArray[key].nomClient + '</i>'+
               '</br>N° du bon de commande: <i>' + chantierJSArray[key].numCommande + '</i>'+
               '</br>Identifiant chantier: <i>' + chantierJSArray[key].IdChantierAdmin + '</i>'
  ).openPopup();
  }

}

</script>
<?php
