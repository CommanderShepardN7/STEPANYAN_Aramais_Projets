<?php
/*La fonction "afficheTabChantiers" sert à afficher le tableau avec les chantiers.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.
*/
  function afficheTabChantiers($result){
    ?>
    <!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery. Sert à customiser les informations de type texte de tableau.
        Exemple: "Recherche" "Afficher  chantiers par page" -->
    <script type="text/javascript" src="myJS/reglageLangageTableauChantiers.js"></script>

    <!--Connexion d'un fichier JavaScript qui contient le code écrit en jquery. Sert a envoyer le 'id' de chantier sur quelle on a cliqué dans ulr de la page.
      Exemple: index.php?page=interventionInfo&id=3                                                                                                      .-->
    <script type="text/javascript" src="myJS/clickOnTable.js"></script>

    <?php

    echo"
    <div class='tableChantierAndMap'>
    <div id='tableChantiers'>
    <table class='table table-bordered table-hover' id='dtDynamicVerticalScrollExample'>
      <thead class='thead-dark'>
        <tr>
          <th class='th-sm' scope='col'>Nom du client</th>
          <th class='th-sm' scope='col'>Nom du chantier</th>
          <th class='th-sm' scope='col'>N du bon de commande</th>
          <th class='th-sm' scope='col'>Identifiant chantier</th>
          <th class='th-sm' scope='col'>Type de chantier</th>
        </tr>
      </thead>
      <tbody>
      ";

      printLigneTabChantiers($result);

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

function printLigneTabChantiers($data){

  while($row = mysqli_fetch_assoc($data)) {
    /*Lignes de tableau cliquable*/
    echo "<tr onmouseup='clickTableTr()' data-href='index.php?page=interventionInfo&amp;' data-id='". $row["idChantier"]       ."'>";
    echo "<td>" . $row["nomClient"]       . "</td>";
    echo "<td>" . $row["nomChantier"]     . "</td>";
    echo "<td>" . $row["numCommande"]     . "</td>";
    echo "<td>" . $row["IdChantierAdmin"] . "</td>";
    echo "<td>" . $row["typeChantier"]    . "</td>";
    echo "</tr>";
  }
}
