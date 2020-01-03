<?php
/*La fonction "VerificationIdentifiant" sert à verifier le login et mot de passe tapé par l'utilisateur.*/
function VerificationIdentifiant(){
	global $connect;

	// On touve dans la BD ligne dont 'login' =  $_POST['Login'] entree par l'utilisateur.
	$sql = " SELECT idAdmin, login, motDePasse FROM administrateur WHERE login ='"
			.mysqli_real_escape_string($connect,$_POST['Login'])."' LIMIT 1";

  $result = mysqli_query($connect, $sql);	//Exécute une requête sur la base de données

	$row  = mysqli_fetch_assoc($result); //Récupère une ligne de résultat sous forme de tableau associatif

	if( $row['motDePasse'] == $_POST['motDePasse']){
					$_SESSION["connected"] = true;
					
	}else{
			?>
			<script>
					alert ("Le mot de passe ou login est incorrect ! "); 
			</script>	
			<?php
					unset($_SESSION["connected"]);
	}
}

/*La fonction "deconnection" sert à se deconnecter.*/
function deconnection(){
	unset($_SESSION["connected"]);
}
