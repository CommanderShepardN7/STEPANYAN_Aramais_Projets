<?php
/*La fonction "infoChantier" sert à afficher le nom d'un chantier avec les deux boutons pour sa gestion.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
function infoChantier(){
  $result = findChantierByID(getIdChantierfromURL());
  $row = mysqli_fetch_assoc($result);

  echo'
      </br>
      <div class="text-center mb-4">
        <h3>'.$row["nomChantier"].'</h3>
        <button type="button" class="btn btn-light" onclick="afficheInfoChantierDetailles()"><i class="fa fa-newspaper-o" style="font-size:36px"></i></button>
        <button type="button" class="btn btn-light" onclick="afficheChoixSupClot()"><i class="fa fa-gear" style="font-size:36px"></i></button>
      </div>';
}

/*La fonction "infoIntervention" sert à afficher les interventions dont appartient a un chantier.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.*/
  function infoIntervention(){
    ?>
    <!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery. Sert à customiser les informations de type texte de tableau.
        Exemples: "Recherche" "Afficher  chantiers par page" -->
    <script type="text/javascript" src="myJS/reglageLangageTableauChantiers.js"></script>

    <!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery. Sert a envoyer le 'id' de chantier sur quelle on a cliqué dans ulr de la page.
      Exemple: index.php?page=interventionInfo&id=3                                                                                                      .-->
    <script type="text/javascript" src="myJS/clickOnTable.js"></script>

    <?php

    infoChantier();

    $arrayInterventions = getArrayAllIterventions();

    echo"
    <div class='tableChantierAndMap'>

    <div id='tableChantiers'>
    <table class='table table-bordered table-hover' id='dtDynamicVerticalScrollExample'>
      <thead class='thead-dark'>
        <tr>
          <th class='th-sm' scope='col'>Identifiant Site</th>
          <th class='th-sm' scope='col'>Code equipe</th>
          <th class='th-sm' scope='col'>Observation</th>
          <th class='th-sm' scope='col'>Date</th>
        </tr>
      </thead>
      <tbody>
      ";

      /*On parcourt l'array avec les interventions typé*/
      for ($i = 0; $i < sizeof($arrayInterventions);$i++){
        if ($arrayInterventions[$i]->num_rows > 0){//si le restult = 0 , on peut plus cliquer
          printLigneTabInterventions($arrayInterventions[$i]);
      }
    }

     echo"
      </tbody>
      <tfoot>
        <tr>
        </tr>
      </tfoot>
    </table>
    </div>";

    creer_map(); // On affiche la carte a droite de tableau avec les chantiers.
    echo"
  </div>";
}

function printLigneTabInterventions($data){
    while($row = mysqli_fetch_assoc($data)) {
      echo "<tr onmouseup='clickTableTr()' data-href='index.php?page=interventionDetailles&amp;' data-id='".http_build_query(array('dataArray' => $row))."'>";
      echo "<td>" . $row["identifiantSite"]       . "</td>";
      echo "<td>" . $row["code_equipe"]     . "</td>";
      echo "<td>" . $row["observation"]     . "</td>";
      echo "<td>" . $row["date"] . "</td>";
      echo "</tr>";
  }
}
