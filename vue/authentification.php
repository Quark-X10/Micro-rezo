<?php
require_once("decor.php");
tete("Authentification",$styles,$scripts);
?>
<div class="authentification">
	<form method="post" action="../controleur/authentification.php">
		<fieldset>
			<legend>Authentifiez vous !</legend>
			<p>
				<label for="login">Login : </label>
				<input type="text" name="login" id="login" autofocus required/>
				<label for="mot_de_passe">Mot de passe : </label>
				<input type="password" name="mot_de_passe" id="mot_de_passe" required/><br />
				<input type="submit" value="Authentification"/>
			</p>
		</fieldset>
	</form>
</div>
<form method="post" action="../index.php">
	<input type="submit" value="Retour à l'accueil"/>
</form>
<?php
pied();
?>
