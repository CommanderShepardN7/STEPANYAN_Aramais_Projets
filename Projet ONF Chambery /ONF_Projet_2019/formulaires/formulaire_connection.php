<?php
/*La fonction "formConnexion" sert à afficher les formulaires pour se connecter.
	Toutes les classes servent à styliser les champs.
	Plus d'information sur chaque classe utilisé est sur https://getbootstrap.com/.
*/
function formConnexion(){
	?>
	<div id='formulaireConnexion'>
    <form class="form-signin" method='post' action='index.php'>
      <div class="text-center mb-4">
		<i class="fa fa-user-o" style="font-size:40px"></i>
		</br>
        <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
      </div>

      <div class="form-group">
		<label for="loginID">Login</label>
        <input  name='Login'  id='loginID' class="form-control" placeholder="Login" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
      </div>

      <div class="form-group">
		<label for="motDePasseID">Mot de passe</label>
        <input type = 'Password' name='motDePasse' id='motDePasseID' class="form-control" placeholder="Mot de passe" required="required" pattern="^[^-\s][^<>]+$" title="La chaîne doit contenir au moins 2 caractères et les caractères '<>' 'espace' sont interdits"/>
      </div>

	</br>
	 <button name='connection' class="btn btn-lg btn-primary btn-block" type="submit" value='Se connecter' >Se connecter</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy;Projet ONF 2019</p>
    </form>
	  </div>
	<?php
}
