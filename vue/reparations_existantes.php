<?php
require_once("decor.php");
tete("Vérification",$styles,NULL);
?>
<h3>Il existe déja une ou plusieurs réparations ajoutées ce jour pour M ou Mme <?php echo $reparations_existantes[0]['nom'] ?>, vérifiez avant de continuer</h3>
<div class="reparation_bdd">
	<?php
	foreach($reparations_existantes as $donnees_en_bdd){
	?>
	<form method="post" action="../index.php">
		<fieldset>
			<legend>Réparation n° <?php echo $donnees_en_bdd['reparation_id']; ?></legend>
			<p>
				Date d'arrivée (jj/mm/aaaa) :
				<input type="number" name="jour" min="0" max="31" step="1" id="jour" size="3" maxlength="2" value="<?php echo $donnees_en_bdd['jour']; ?>" disabled/>
				<input type="number" name="mois" min="0" max="12" step="1 id="mois" size="3" maxlength="2" value="<?php echo $donnees_en_bdd['mois']; ?>" disabled/>
				<input type="number" name="annee" min="0" max="9999" step="1 id="annee" size="5" maxlength="4" value="<?php echo $donnees_en_bdd['annee']; ?>" disabled/>
				<input type="hidden" name="client" id="client" value="<?php echo $donnees_en_bdd['client']; ?>" disabled/>
				<input type="hidden" name="reparation_id" id="reparation_id" value="<?php echo $donnees_en_bdd['reparation_id']; ?>"  disabled/>
				<p class="description_panne">
					<label for="description_panne">Description<br />et panne : </label>
					<textarea name="description_panne" id="description_panne" rows="4" required disabled><?php echo $donnees_en_bdd['description_panne']; ?></textarea>
				</p>
				<p class="documents">
					<label for="documents">Sauvegarde et<br />emplacement<br />des documents : </label>
					<textarea name="documents" id="documents" rows="4" disabled><?php echo $donnees_en_bdd['documents']; ?></textarea>
				</p>
				<p class="priorite">
					Priorité : <br />
					<input type="radio" name="priorite" id="normal" value="Normal" <?php echo ($donnees_en_bdd['priorite'] == "Normal") ? 'checked' : ''; ?> disabled/><label for="normal">Normal</label>
					<input type="radio" name="priorite" id="SAV" value="SAV" <?php echo ($donnees_en_bdd['prioritel'] == "SAV") ? 'checked' : ''; ?> disabled/><label for="SAV">SAV</label>
					<input type="radio" name="priorite" id="urgence" value="Urgence" <?php echo ($donnees_en_bdd['priorite'] == "Urgence") ? 'checked' : ''; ?> disabled/><label for="urgence">Urgence</label>
					<input type="radio" name="priorite" id="diag-urgent" value="Diag urgent" <?php echo ($donnees_en_bdd['priorite'] == "Diag urgent") ? 'checked' : ''; ?>/><label for="diag-urgent">Diag Urgent</label><br /><br />
					<input type="checkbox" name="sacoche" id="sacoche" <?php echo ($donnees_en_bdd['sacoche'] == 1) ? 'checked' : ''; ?> disabled/>
					<label for="sacoche">Sacoche</label>
					<input type="checkbox" name="chargeur" id="chargeur" <?php echo ($donnees_en_bdd['chargeur'] == 1) ? 'checked' : ''; ?> disabled/>
					<label for="chargeur">Chargeur</label>
				</p>
				<div class="clear"></div>
				<br />
				<label for="mot_de_passe">Mot de passe : </label>
				<input type="text" name="mot_de_passe" id="mot_de_passe" value="<?php echo $donnees_en_bdd['mot_de_passe']; ?>" required disabled/>
				<label for="emplacement">Emplacement : </label>
				<input type="text" name="emplacement" id="emplacement" value="<?php echo $donnees_en_bdd['emplacement']; ?>" disabled/><br />
				<label for="responsable">Responsable : </label>
				<input type="text" name="responsable" id="responsable" value="<?php echo $donnees_en_bdd['responsable']; ?>" disabled/>
				<label for="accord_client">Accord du client : </label>
				<input type="text" name="accord_client" id="accord_client" value="<?php echo $donnees_en_bdd['accord_client']; ?>" disabled/>
				<p>
					Etat : <br />
					<input type="radio" name="etat" id="pas commencé" value="pas commencé" <?php echo ($donnees_en_bdd['etat'] == "pas commencé") ? 'checked' : ''; ?> disabled/><label for="pas commencé">Pas commencé</label>
					<input type="radio" name="etat" id="en cours" value="en cours" <?php echo ($donnees_en_bdd['etat'] == "en cours") ? 'checked' : ''; ?> disabled/><label for="en cours">En cours</label>
					<input type="radio" name="etat" id="diagnostic fait" value="diagnostic fait" <?php echo ($donnees_en_bdd['etat'] == "diagnostic fait") ? 'checked' : ''; ?> disabled/><label for="diagnostic fait">Diagnostic fait</label>
					<input type="radio" name="etat" id="attente pièce" value="attente pièce" <?php echo ($donnees_en_bdd['etat'] == "attente pièce") ? 'checked' : ''; ?> disabled/><label for="attente pièce">Attente pièce</label>
					<input type="radio" name="etat" id="attente accord client" value="attente accord client" <?php echo ($donnees_en_bdd['etat'] == "attente accord client") ? 'checked' : ''; ?> disabled/><label for="attente accord client">Attente accord client</label>
					<input type="radio" name="etat" id="devis délivré" value="devis délivré" <?php echo ($donnees_en_bdd['etat'] == "devis délivré") ? 'checked' : ''; ?> disabled/><label for="devis délivré">Devis délivré</label>
					<input type="radio" name="etat" id="terminé" value="terminé" <?php echo ($donnees_en_bdd['etat'] == "terminé") ? 'checked' : ''; ?> disabled/><label for="terminé">Terminé</label>
					<input type="radio" name="etat" id="restitué" value="restitué" <?php echo ($donnees_en_bdd['etat'] == "restitué") ? 'checked' : ''; ?> disabled/><label for="restitué">Restitué</label>
				</p>
				<p>
					Appel : <br />
					<input type="radio" name="appel" id="non" value="non" <?php echo ($donnees_en_bdd['appel'] == "non") ? 'checked' : ''; ?> disabled/><label for="non">Non</label>
					<input type="radio" name="appel" id="répondeur" value="répondeur" <?php echo ($donnees_en_bdd['appel'] == "répondeur") ? 'checked' : ''; ?> disabled/><label for="répondeur">répondeur</label>
					<input type="radio" name="appel" id="oui" value="oui" <?php echo ($donnees_en_bdd['appel'] == "oui") ? 'checked' : ''; ?> disabled/><label for="oui">Oui</label>
				</p>
				<p class="diagnostic">
					<label for="diagnostic">Diagnostic : </label>
					<textarea name="diagnostic" id="diagnostic" rows="4" disabled><?php echo $donnees_en_bdd['diagnostic']; ?></textarea>
				</p>
				<p class="reparation_proposee">
					<label for="reparation_proposee">Réparation<br />proposée : </label>
					<textarea name="reparation_proposee" id="reparation_proposee" rows="4" disabled><?php echo $donnees_en_bdd['reparation_proposee']; ?></textarea>
				</p>
				<div class="clear"></div>
				<label for="tarif">Tarif : </label>
				<input type="number" step="0.01" min="0" name="tarif" id="tarif" value="<?php echo $donnees_en_bdd['tarif']; ?>" disabled/><br />
				<input type="Submit" value="Retour à l'accueil"/>
			</p>
		</fieldset>
	</form>
	<?php
	}
	?>
</div>
<div class="reparation_ajoutee">
	<form method="post" action="../controleur/ajouter_reparation.php">
		<fieldset>
			<legend>Votre nouvelle réparation</legend>
			<p>
				Date d'arrivée (jj/mm/aaaa) :
				<input type="number" name="jour" min="0" max="31" step="1" id="jour" size="3" maxlength="2" value="<?php echo $donnees['jour']; ?>"/>
				<input type="number" name="mois" min="0" max="12" step="1 id="mois" size="3" maxlength="2" value="<?php echo $donnees['mois']; ?>"/>
				<input type="number" name="annee" min="0" max="9999" step="1 id="annee" size="5" maxlength="4" value="<?php echo $donnees['annee']; ?>"/> Date du jour automatique si vide
				<input type="hidden" name="client" id="client" value="<?php echo $donnees['client']; ?>"/>
				<input type="hidden" name="verification" id="verification" value="1"/>
				<p class="description_panne">
					<label for="description_panne">Description<br />et panne : </label>
					<textarea name="description_panne" id="description_panne" rows="4" required autofocus><?php echo $donnees['description_panne']; ?></textarea>
				</p>
				<p class="documents">
					<label for="documents">Sauvegarde et<br />emplacement<br />des documents : </label>
					<textarea name="documents" id="documents" rows="4"><?php echo $donnees['documents']; ?></textarea>
				</p>
				<p class="priorite">
					Priorité : <br />
					<input type="radio" name="priorite" id="normal" value="Normal" <?php echo ($donnees['priorite'] == "Normal") ? 'checked' : ''; ?> /><label for="normal">Normal</label>
					<input type="radio" name="priorite" id="SAV" value="SAV" <?php echo ($donnees_en_bdd['priorite'] == "SAV") ? 'checked' : ''; ?> /><label for="SAV">SAV</label>
					<input type="radio" name="priorite" id="urgence" value="Urgence" <?php echo ($donnees['priorite'] == "Urgence") ? 'checked' : ''; ?> /><label for="urgence">Urgence</label>
					<input type="radio" name="priorite" id="diag-urgent" value="Diag urgent" <?php echo ($donnees['priorite'] == "Diag urgent") ? 'checked' : ''; ?>/><label for="diag-urgent">Diag Urgent</label><br /><br />
					<input type="checkbox" name="sacoche" id="sacoche" <?php echo ($donnees['sacoche'] == 1) ? 'checked' : ''; ?>/>
					<label for="sacoche">Sacoche</label>
					<input type="checkbox" name="chargeur" id="chargeur" <?php echo ($donnees['chargeur'] == 1) ? 'checked' : ''; ?>/>
					<label for="chargeur">Chargeur</label>
				</p>
				<div class="clear"></div>
				<br />
				<label for="mot_de_passe">Mot de passe : </label>
				<input type="text" name="mot_de_passe" id="mot_de_passe" value="<?php echo $donnees['mot_de_passe']; ?>" required/>
				<label for="emplacement">Emplacement : </label>
				<input type="text" name="emplacement" id="emplacement" value="<?php echo $donnees['emplacement']; ?>"/><br />
				<label for="responsable">Responsable : </label>
				<input type="text" name="responsable" id="responsable" value="<?php echo $donnees['responsable']; ?>"/>
				<label for="accord_client">Accord du client : </label>
				<input type="text" name="accord_client" id="accord_client" value="<?php echo $donnees['accord_client']; ?>"/>
				<p>
					Etat : <br />
					<input type="radio" name="etat" id="pas commencé" value="pas commencé" <?php echo ($donnees['etat'] == "pas commencé") ? 'checked' : ''; ?>/><label for="pas commencé">Pas commencé</label>
					<input type="radio" name="etat" id="en cours" value="en cours" <?php echo ($donnees['etat'] == "en cours") ? 'checked' : ''; ?>/><label for="en cours">En cours</label>
					<input type="radio" name="etat" id="diagnostic fait" value="diagnostic fait" <?php echo ($donnees['etat'] == "diagnostic fait") ? 'checked' : ''; ?>/><label for="diagnostic fait">Diagnostic fait</label>
					<input type="radio" name="etat" id="attente pièce" value="attente pièce" <?php echo ($donnees['etat'] == "attente pièce") ? 'checked' : ''; ?>/><label for="attente pièce">Attente pièce</label>
					<input type="radio" name="etat" id="attente accord client" value="attente accord client" <?php echo ($donnees['etat'] == "attente accord client") ? 'checked' : ''; ?>/><label for="attente accord client">Attente accord client</label>
					<input type="radio" name="etat" id="devis délivré" value="devis délivré" <?php echo ($donnees['etat'] == "devis délivré") ? 'checked' : ''; ?>/><label for="devis délivré">Devis délivré</label>
					<input type="radio" name="etat" id="terminé" value="terminé" <?php echo ($donnees['etat'] == "terminé") ? 'checked' : ''; ?>/><label for="terminé">Terminé</label>
					<input type="radio" name="etat" id="restitué" value="restitué" <?php echo ($donnees['etat'] == "restitué") ? 'checked' : ''; ?>/><label for="restitué">Restitué</label>
				</p>
				<p>
					Appel : <br />
					<input type="radio" name="appel" id="non" value="non" <?php echo ($donnees['appel'] == "non") ? 'checked' : ''; ?>/><label for="non">Non</label>
					<input type="radio" name="appel" id="répondeur" value="répondeur" <?php echo ($donnees['appel'] == "répondeur") ? 'checked' : ''; ?>/><label for="répondeur">répondeur</label>
					<input type="radio" name="appel" id="oui" value="oui" <?php echo ($donnees['appel'] == "oui") ? 'checked' : ''; ?>/><label for="oui">Oui</label>
				</p>
				<p class="diagnostic">
					<label for="diagnostic">Diagnostic : </label>
					<textarea name="diagnostic" id="diagnostic" rows="4"><?php echo $donnees['diagnostic']; ?></textarea>
				</p>
				<p class="reparation_proposee">
					<label for="reparation_proposee">Réparation<br />proposée : </label>
					<textarea name="reparation_proposee" id="reparation_proposee" rows="4"><?php echo $donnees['reparation_proposee']; ?></textarea>
				</p>
				<div class="clear"></div>
				<label for="tarif">Tarif : </label>
				<input type="number" step="0.01" min="0" name="tarif" id="tarif" value="<?php echo $donnees['tarif']; ?>"/><br />
				<input type="submit" value="Continuer" />
			</p>
		</fieldset>
	</form>
</div>
<?php
pied();
?>
