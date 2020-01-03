<?php
global $host;
global $username;
global $my_password;
global $my_db;

$connect = mysqli_connect($host, $username, $my_password, $my_db);	// Connexion à la base de données,(@serveur, login, mot de passe, nom de la base de données)

mysqli_set_charset($connect,"utf-8");		//encodage utf-8
