<?php
//Affiche le formulaire décrivant le client dans un div avec une modification possible via le controle correspondant
require_once("decor.php");
tete('Erreur',NULL,NULL);
?>
<div class="erreur">
Une erreur s'est produite
<br />
<?php echo $erreur; ?>
<br />
<form method="post" action="../index.php">
	<input type="submit" value="Retour à l'accueil"/>
</form>
</div>
<?php
pied();
?>
