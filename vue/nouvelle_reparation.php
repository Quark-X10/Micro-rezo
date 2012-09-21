<?php
require_once("decor.php");
tete('Nouvelle réparation',$styles,NULL);
?>
	<div class="affichage_reparation">
		<form method="post" action="../controleur/ajouter_reparation.php">
			<fieldset>
				<legend>Nouvelle réparation pour M ou Mme <a href="../controleur/afficher_client.php?client_id=<?php echo $client; ?>"><?php echo $nom_telephone['nom']; ?></a>, tel : <?php echo $nom_telephone['telephone']; ?></legend>
				<p>
					Date d'arrivée (jj/mm/aaaa) :
					<input type="number" name="jour" min="0" max="31" step="1" id="jour" size="3" maxlength="2"/>
					<input type="number" name="mois" min="0" max="12" step="1 id="mois" size="3" maxlength="2"/>
					<input type="number" name="annee" min="0" max="9999" step="1 id="annee" size="5" maxlength="4"/> Date du jour automatique si vide
					<input type="hidden" name="client" id="client" value="<?php echo $client; ?>"/>
					<p class="description_panne">
					<label for="description_panne">Description<br />et panne : </label>
					<textarea name="description_panne" id="description_panne" rows="4" required autofocus></textarea>
					</p>
					<p class="documents">
						<label for="documents">Sauvegarde et<br />emplacement<br />des documents : </label>
						<textarea name="documents" id="documents" rows="4"></textarea>
					</p>
					<p class="priorite">
						Priorité : <br />
						<input type="radio" name="priorite" id="normal" value="Normal" checked/><label for="normal">Normal</label>
						<input type="radio" name="priorite" id="SAV" value="SAV" /><label for="SAV">SAV</label>
						<input type="radio" name="priorite" id="urgence" value="Urgence" /><label for="urgence">Urgence</label>
						<input type="radio" name="priorite" id="diag-urgent" value="Diag urgent" /><label for="diag-urgent">Diag Urgent</label><br /><br />
						<input type="checkbox" name="sacoche" id="sacoche" />
						<label for="sacoche">Sacoche</label>
						<input type="checkbox" name="chargeur" id="chargeur" />
						<label for="chargeur">Chargeur</label>
					</p>
					<div class="clear"></div>
					<br />
					<label for="mot_de_passe">Mot de passe : </label>
					<input type="text" name="mot_de_passe" id="mot_de_passe" required/>
					<label for="emplacement">Emplacement : </label>
					<input type="text" name="emplacement" id="emplacement" /><br />
					<label for="responsable">Responsable : </label>
					<input type="text" name="responsable" id="responsable" />
					<label for="accord_client">Accord du client : </label>
					<input type="text" name="accord_client" id="accord_client" />
					<p>
						Etat : <br />
						<input type="radio" name="etat" id="pas commencé" value="pas commencé" checked/><label for="pas commencé">Pas commencé</label>
						<input type="radio" name="etat" id="en cours" value="en cours" /><label for="en cours">En cours</label>
						<input type="radio" name="etat" id="diagnostic fait" value="diagnostic fait" /><label for="diagnostic fait">Diagnostic fait</label>
						<input type="radio" name="etat" id="attente pièce" value="attente pièce" /><label for="attente pièce">Attente pièce</label>
						<input type="radio" name="etat" id="attente accord client" value="attente accord client" /><label for="attente accord client">Attente accord client</label>
						<input type="radio" name="etat" id="devis délivré" value="devis délivré" /><label for="devis délivré">Devis délivré</label>
						<input type="radio" name="etat" id="terminé" value="terminé" /><label for="terminé">Terminé</label>
						<input type="radio" name="etat" id="restitué" value="restitué" /><label for="restitué">Restitué</label>
					</p>
					<p>
						Appel : <br />
						<input type="radio" name="appel" id="non" value="non" checked/><label for="non">Non</label>
						<input type="radio" name="appel" id="répondeur" value="répondeur"/><label for="répondeur">répondeur</label>
						<input type="radio" name="appel" id="oui" value="répondeur"/><label for="oui">Oui</label>
					</p>
					<p class="diagnostic">
						<label for="diagnostic">Diagnostic : </label>
						<textarea name="diagnostic" id="diagnostic" rows="4"></textarea>
					</p>
					<p class="reparation_proposee">
						<label for="reparation_proposee">Réparation<br />proposée : </label>
						<textarea name="reparation_proposee" id="reparation_proposee" rows="4"></textarea>
					</p>
					<div class="clear"></div>
					<label for="tarif">Tarif : </label>
					<input type="number" step="0.01" min="0" name="tarif" id="tarif" /><br />
					<input type="submit" value="Ajouter" />
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
