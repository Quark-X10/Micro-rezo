<?php
if(!$reponse){
	echo 'Pas de résultats';
}
else{
	?>
	<br />
	<div class="ligne"></div>
	<?php
	foreach($reponse as $donnees){
	$nom_prenom = $donnees['nom'];
	if($donnees['prenom'] != NULL){
		$nom_prenom .= ' ' . $donnees['prenom'];
	}
	?>
	<div class="resultat_client">
		<h3><a href="../controleur/afficher_client.php?client_id=<?php echo $donnees['client_id']; ?>"><?php echo $nom_prenom; ?></a></h3>
		<div class="informations_client">
		<span class="date"><?php echo $donnees['telephone']; ?></span><br />
		<span class="url"><?php echo $donnees['adresse']; ?></span><br />
		<form method="post" action="../controleur/nouvelle_reparation.php?client_id=<?php echo $donnees['client_id']; ?>">
			<input type="submit" value="Ajouter une réparation pour ce client" />
		</form>
		</div>
	</div>
	<?php
	}
}
?>
<br />
<br />
	<form method="post" action="../controleur/ajouter_client.php">
		<fieldset>
			<legend>Ajouter le client s'il n'existe pas</legend>
			<p>
				<label for="nom_client">Nom : </label>
				<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" required/>
				<label for="prenom_client">Prénom : </label>
				<input type="text" name="prenom" id="prenom" /><br />
				<label for="tel_client">Téléphone : </label>
				<input type="tel" name="telephone" id="telephone" /><br />
				<label for="adresse_client">Adresse : </label>
				<textarea name="adresse" id="adresse" rows="4"></textarea><br />
				<input type="submit" value="Ajouter" />
			</p>
		</fieldset>
	</form>
