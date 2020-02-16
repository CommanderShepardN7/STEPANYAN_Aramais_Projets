<?php

/********************************/
$host = "localhost";
$username = "aramais";
$my_password = "9894";
$my_db = "smartTrucker";

include_once "creationBDD.php";
/********************************/

$connect = mysqli_connect($host, $username, $my_password, $my_db);	// Connexion à la base de données,(@serveur, login, mot de passe, nom de la base de données)
mysqli_set_charset($connect,"utf-8");		//encodage utf-8


    function getFromBD($level){
      global $connect;

      $sql = "SELECT questionText,urlVideo,reponse1,reponse2,reponse3,reponse4
            FROM smartTrucker WHERE level = $level ";
      $result = mysqli_query($connect, $sql);

      return createArray($result);
    }

    function createArray($result){
      $results_array = array();
      while ($row  = mysqli_fetch_assoc($result)){
        $results_array[] = $row;
      }

      return $results_array;
    }


    header('Content-Type: application/json');

    // S'il y a une erreur de connexion on appelle à la méthode createMyDb() qui va créer la base de données.
    if (!$connect) {
      createMyDb();
    }else{

      echo json_encode(array(
      'level1' => getFromBD(1),
      'level2' => getFromBD(2),
      'level3' => getFromBD(3)));
       mysqli_close($connect);
  }

 ?>
