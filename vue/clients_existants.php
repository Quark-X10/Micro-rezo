<?php
require_once("decor.php");
tete("Vérification",$styles,NULL);
?>
<h3>Il existe déja un ou plusieurs clients du même nom, vérifiez avant de continuer</h3>
<div class="client_bdd">
	<?php
	foreach($clients_existants as $donnees_en_bdd){
	?>
	<form method="post" action="../index.php">
		<fieldset>
			<legend>Client n° <?php echo $donnees_en_bdd['client_id']; ?></legend>
			<p>
				<input type="hidden" name="client_id" id="client_id" value ="<?php echo $donnees_en_bdd['client_id']; ?>" disabled/>
				<label for="nom">Nom : </label>
				<input type="text" name="nom" id="nom" value="<?php echo $donnees_en_bdd['nom']; ?>" disabled required/>
				<label for="prenom_client">Prénom : </label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $donnees_en_bdd['prenom']; ?>" disabled/><br />
				<label for="telephone">Téléphone : </label>
				<input type="tel" name="telephone" id="telephone" value="<?php echo $donnees_en_bdd['telephone']; ?>" disabled/><br />
				<label for="adresse">Adresse : </label>
				<textarea name="adresse" id="adresse" rows="4" disabled><?php echo $donnees_en_bdd['adresse']; ?></textarea><br />
				<input type="Submit" value="Retour à l'accueil"/>
			</p>
		</fieldset>
	</form>
	<?php
	}
	?>
</div>
<div class="client_ajoute">
	<form method="post" action="../controleur/ajouter_client.php">
		<fieldset>
			<legend>Votre nouveau client</legend>
			<p>
				<input type="hidden" name="verification" id="verification" value="1"/>
				<label for="nom">Nom : </label>
				<input type="text" name="nom" id="nom" value="<?php echo $donnees['nom']; ?>" required/>
				<label for="prenom_client">Prénom : </label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom']; ?>"/><br />
				<label for="telephone">Téléphone : </label>
				<input type="tel" name="telephone" id="telephone" value="<?php echo $donnees['telephone']; ?>"/><br />
				<label for="adresse">Adresse : </label>
				<textarea name="adresse" id="adresse" rows="4"><?php echo $donnees['adresse']; ?></textarea><br />
				<input type="submit" value="Continuer" />
			</p>
		</fieldset>
	</form>
</div>
<br />
<?php
pied();
?>
