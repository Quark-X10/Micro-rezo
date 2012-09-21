<?php
//Affiche le formulaire décrivant la réparation dans un div avec une modification possible via le controle correspondant
require_once("decor.php");
tete($numero,$styles,NULL);
?>
	<div class="affichage_reparation">
		<form method="post" action="../controleur/modifier_reparation.php">
			<fieldset>
				<legend><?php echo $numero; ?> pour M ou Mme <a href="../controleur/afficher_client.php?client_id=<?php echo $reparation['client']; ?>"><?php echo $reparation['nom']; ?></a>, tel : <?php echo $reparation['telephone']; ?></legend>
				<p>
					<input type="hidden" name="client" id="client" value="<?php echo $reparation['client']; ?>"/>
					<input type="hidden" name="reparation_id" id="reparation_id" value="<?php echo $reparation['reparation_id']; ?>"/>
					Date d'arrivée (jj/mm/aaaa) :
					<input type="number" name="jour" min="0" max="31" step="1" id="jour" size="3" maxlength="2" value="<?php echo $reparation['jour']; ?>"/>
					<input type="number" name="mois" min="0" max="12" step="1 id="mois" size="3" maxlength="2" value="<?php echo $reparation['mois']; ?>"/>
					<input type="number" name="annee" min="0" max="9999" step="1 id="annee" size="5" maxlength="4" value="<?php echo $reparation['annee']; ?>"/> Date du jour automatique si vide
					<p class="description_panne">
						<label for="description_panne">Description<br />et panne : </label>
						<textarea name="description_panne" id="description_panne" rows="4" required autofocus><?php echo $reparation['description_panne']; ?></textarea>
					</p>
					<p class="documents">
						<label for="documents">Sauvegarde et<br />emplacement<br />des documents : </label>
						<textarea name="documents" id="documents" rows="4"><?php echo $reparation['documents']; ?></textarea>
					</p>
					<p class="priorite">
						Priorité : <br />
						<input type="radio" name="priorite" id="normal" value="Normal" <?php echo ($reparation['priorite'] == "Normal") ? 'checked' : ''; ?>/><label for="normal">Normal</label>
						<input type="radio" name="priorite" id="SAV" value="SAV" <?php echo ($reparation['priorite'] == "SAV") ? 'checked' : ''; ?>/><label for="SAV">SAV</label>
						<input type="radio" name="priorite" id="urgence" value="Urgence" <?php echo ($reparation['priorite'] == "Urgence") ? 'checked' : ''; ?>/><label for="urgence">Urgence</label>
						<input type="radio" name="priorite" id="diag-urgent" value="Diag urgent" <?php echo ($reparation['priorite'] == "Diag urgent") ? 'checked' : ''; ?>/><label for="diag-urgent">Diag Urgent</label><br /><br />
						<input type="checkbox" name="sacoche" id="sacoche" <?php echo ($reparation['sacoche'] == 1) ? 'checked' : ''; ?>/>
						<label for="sacoche">Sacoche</label>
						<input type="checkbox" name="chargeur" id="chargeur" <?php echo ($reparation['chargeur'] == 1) ? 'checked' : ''; ?>/>
						<label for="chargeur">Chargeur</label>
					</p>
					<div class="clear"></div>
					<br />
					<label for="mot_de_passe">Mot de passe : </label>
					<input type="text" name="mot_de_passe" id="mot_de_passe" value="<?php echo $reparation['mot_de_passe']; ?>" required/>
					<label for="emplacement">Emplacement : </label>
					<input type="text" name="emplacement" id="emplacement" value="<?php echo $reparation['emplacement']; ?>"/><br />
					<label for="responsable">Responsable : </label>
					<input type="text" name="responsable" id="responsable" value="<?php echo $reparation['responsable']; ?>"/>
					<label for="accord_client">Accord du client : </label>
					<input type="text" name="accord_client" id="accord_client" value="<?php echo $reparation['accord_client']; ?>"/>
					<p>
						Etat : <br />
						<input type="radio" name="etat" id="pas commencé" value="pas commencé" <?php echo ($reparation['etat'] == "pas commencé") ? 'checked' : ''; ?>/><label for="pas commencé">Pas commencé</label>
						<input type="radio" name="etat" id="en cours" value="en cours" <?php echo ($reparation['etat'] == "en cours") ? 'checked' : ''; ?>/><label for="en cours">En cours</label>
						<input type="radio" name="etat" id="diagnostic fait" value="diagnostic fait" <?php echo ($reparation['etat'] == "diagnostic fait") ? 'checked' : ''; ?>/><label for="diagnostic fait">Diagnostic fait</label>
						<input type="radio" name="etat" id="attente pièce" value="attente pièce" <?php echo ($reparation['etat'] == "attente pièce") ? 'checked' : ''; ?>/><label for="attente pièce">Attente pièce</label>
						<input type="radio" name="etat" id="attente accord client" value="attente accord client" <?php echo ($reparation['etat'] == "attente accord client") ? 'checked' : ''; ?>/><label for="attente accord client">Attente accord client</label>
						<input type="radio" name="etat" id="devis délivré" value="devis délivré" <?php echo ($reparation['etat'] == "devis délivré") ? 'checked' : ''; ?>/><label for="devis délivré">Devis délivré</label>
						<input type="radio" name="etat" id="terminé" value="terminé" <?php echo ($reparation['etat'] == "terminé") ? 'checked' : ''; ?>/><label for="terminé">Terminé</label>
						<input type="radio" name="etat" id="restitué" value="restitué" <?php echo ($reparation['etat'] == "restitué") ? 'checked' : ''; ?>/><label for="restitué">Restitué</label>
					</p>
					<p>
						Appel : <br />
						<input type="radio" name="appel" id="non" value="non" <?php echo ($reparation['appel'] == "non") ? 'checked' : ''; ?>/><label for="non">Non</label>
						<input type="radio" name="appel" id="répondeur" value="répondeur" <?php echo ($reparation['appel'] == "répondeur") ? 'checked' : ''; ?>/><label for="répondeur">répondeur</label>
						<input type="radio" name="appel" id="oui" value="oui" <?php echo ($reparation['appel'] == "oui") ? 'checked' : ''; ?>/><label for="oui">Oui</label>
					</p>
					<p class="diagnostic">
						<label for="diagnostic">Diagnostic : </label>
						<textarea name="diagnostic" id="diagnostic" rows="4"><?php echo $reparation['diagnostic']; ?></textarea>
					</p>
					<p class="reparation_proposee">
						<label for="reparation_proposee">Réparation<br />proposée : </label>
						<textarea name="reparation_proposee" id="reparation_proposee" rows="4"><?php echo $reparation['reparation_proposee']; ?></textarea>
					</p>
					<div class="clear"></div>
					<label for="tarif">Tarif : </label>
					<input type="number" step="0.01" min="0" name="tarif" id="tarif" value="<?php echo $reparation['tarif']; ?>"/><br />
					<input type="submit" value="Modifier" />
				</p>
			</fieldset>
		</form>
	</div>
<?php
pied();
?>
