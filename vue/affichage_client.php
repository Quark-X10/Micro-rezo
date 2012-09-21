<?php
//Affiche le formulaire décrivant le client dans un div avec une modification possible via le controle correspondant
require_once("decor.php");
tete($numero,$styles,$scripts);
?>
<div class="affichage_client">
	<form method="post" action="../controleur/modifier_client.php">
		<fieldset>
			<legend><?php echo $numero; ?></legend>
			<p>
				<input type="hidden" name="client_id" id="client_id" value ="<?php echo $client['client_id']; ?>" />
				<label for="nom">Nom : </label>
				<input type="text" name="nom" id="nom" value="<?php echo $client['nom']; ?>" required/>
				<label for="prenom_client">Prénom : </label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $client['prenom']; ?>"/><br />
				<label for="telephone">Téléphone : </label>
				<input type="tel" name="telephone" id="telephone" value="<?php echo $client['telephone']; ?>"/><br />
				<label for="adresse">Adresse : </label>
				<textarea name="adresse" id="adresse" rows="4"><?php echo $client['adresse']; ?></textarea><br />
				<input type="submit" value="Modifier" />
			</p>
		</fieldset>
	</form>
</div>
<br />
<br />
<div class="ajouter_reparation">
	<form method="post" action="../controleur/nouvelle_reparation.php?client_id=<?php echo $client['client_id']; ?>">
		<input type="submit" value="Ajouter une réparation pour ce client" />
	</form>
	<form method="post" action="../index.php">
		<input type="submit" value="Retour à l'accueil"/>
	</form>
</div>
<div class="clear"></div>
<br />
<div class="affichage_reparation_client">
	<?php
	if(count($reparation_client) == 0){
		echo "Ce client n'a pas de réparations";
	}
	else{
	?>
		<table>
			<tr>
				<th>Date d'arrivée</th>
				<th>Priorité</th>
				<th>Etat</th>
				<th>Emplacement</th>
				<th>Description de la panne</th>
			</tr>
		<?php
		foreach($reparation_client as $reparation){
			echo '<tr class="' . style($reparation['priorite'],$reparation['etat'],$reparation['appel']) . '" title="réparation n° ' . $reparation['reparation_id'] .'" id="../controleur/afficher_reparation.php?reparation_id=' . $reparation['reparation_id'] .'">';
			ajout_case_tableau(date_vers_chaine($reparation['date_arrivee']));
			ajout_case_tableau($reparation['priorite']);
			ajout_case_tableau($reparation['etat']);
			ajout_case_tableau($reparation['emplacement']);
			ajout_case_tableau($reparation['description_panne']);
			echo '</tr>';
		}
		?>
		</table>
		<?php
	}
	?>
</div>
<?php
pied();
?>
