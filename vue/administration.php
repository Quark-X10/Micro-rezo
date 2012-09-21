<?php
require_once("decor.php");
tete("Administration",$styles,$scripts);
?>
<form method="post" action="../index.php">
	<input type="submit" value="Retour à l'accueil"/>
</form>
<div class="changer_mot_de_passe">
	<form method="post" action="../controleur/administration.php">
		<fieldset>
			<legend>Changer votre mot de passe :</legend>
			<p>
				<input type="hidden" name="action" id="action" value="changer_mot_de_passe"/>
				<label for="ancien_mot_de_passe">Ancien mot de passe : </label>
				<input type="password" name="ancien_mot_de_passe" id="ancien_mot_de_passe" required/><br />
				<label for="nouveau_mot_de_passe">Nouveau mot de passe : </label>
				<input type="password" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe" required/><br />
				<label for="verif_mot_de_passe">Retapez votre nouveau mot de passe : </label>
				<input type="password" name="verif_mot_de_passe" id="verif_mot_de_passe" required/><br />
				<input type="submit" value="Modifier"/>
			</p>
		</fieldset>
	</form>
</div>
<?php
if($admin){
	?>
	<div class="ajouter_utilisateur">
		<form method="post" action="../controleur/administration.php">
			<fieldset>
				<legend>Ajoutez un utilisateur :</legend>
				<p>
					<input type="hidden" name="action" id="action" value="ajouter_utilisateur"/>
					<label for="login">Login : </label>
					<input type="text" name="login" id="login" required/><br />
					<label for="mot_de_passe">Mot de passe : </label>
					<input type="password" name="mot_de_passe" id="mot_de_passe" required/><br />
					<label for="verif_mot_de_passe">Retapez votre mot de passe : </label>
					<input type="password" name="verif_mot_de_passe" id="verif_mot_de_passe" required/><br />
					<label for="droits">Droits du nouvel utilisateur :</label>
					<select name="droits" id="droits">
					   <option value="admin">Admin</option>
					   <option value="utilisateur" selected>Utilisateur</option>
					</select><br />
					<input type="submit" value="Ajouter"/>
				</p>
			</fieldset>
		</form>
	</div>
	<div class="supprimer_un_utilisateur">
		<?php
		if(!$utilisateurs){
			echo "Aucun utilisateur";
		}
		else{
			foreach($utilisateurs as $utilisateur){
				?>
				<form method="post" action="../controleur/administration.php" onsubmit="return confirm('Etes vous sur de vouloir supprimer cet utilisateur ?')">
					<input type="hidden" name="action" id="action" value="supprimer_un_utilisateur"/>
					<label for="utilisateur"><?php echo $utilisateur['login']; ?></label>
					<input type="hidden" name="utilisateur_id" id="utilisateur_id" value="<?php echo $utilisateur['utilisateur_id']; ?>"/>
					<input type="submit" value="Supprimer" />
				</form>
				<?php
			}
		}
		?>
	</div>
	<?php
}
pied();
?>
