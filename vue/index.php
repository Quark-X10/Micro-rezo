<?php
require_once("decor.php");
tete("Accueil",$styles,$scripts);
?>
<div class="nav">
	<?php
	if($_SESSION['login'] == 'interne'){
		?>
		<a href="../controleur/authentification.php">S'authentifier</a>
		<?php	
	}
	else{
		?>
		<a href="../controleur/administration.php">Administration</a>
		<a href="../controleur/deconnexion.php">Se déconnecter</a>
		<?php
	}
	?>
</div>
<div class="recherche_client">
	<form class ="ajax" method="get" action="../controleur/rechercher_client.php" onsubmit="return false">
		<fieldset>
			<legend>Rechercher un client</legend>
			<p>
				<label for="nom_client">Nom du client :</label>
				<input type="text" name="nom_client" id="nom_client" autofocus/><br />
			</p>
		</fieldset>
	</form>
</div>
<br />
<div class="resultats" id="resultats">
</div>
<br />
<form class="ajax" method="get" action="../controleur/liste_reparation.php">
	<fieldset>
		<legend>Réparations à afficher</legend>
		<p>
			<input type="radio" name="reparation_a_afficher" value="pas-restitue" id="pas-restitue" /><label for="pas-restitue">Non restitué</label>
			<input type="radio" name="reparation_a_afficher" value="en-cours" id="en-cours" /><label for="en-cours">En cours</label>
			<input type="radio" name="reparation_a_afficher" value="pas-commence" id="pas-commence" /><label for="pas-commence">Pas commencé</label>
			<input type="radio" name="reparation_a_afficher" value="urgence" id="urgence" /><label for="urgence">Urgence</label>
			<input type="radio" name="reparation_a_afficher" value="SAV" id="SAV" /><label for="SAV">SAV</label>
			<input type="radio" name="reparation_a_afficher" value="restitue" id="restitue"/><label for="restitue">Restitué</label>
		</p>
	</fieldset>
</form>
<br />
<div id="liste_reparation">
</div>
<?php
pied();
?>
