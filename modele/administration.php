<?php
require_once("connection_requetes_bdd.php");
function changer_mot_de_passe($utilisateur_id,$mot_de_passe){
	$bdd = connection_bdd();
	$requete = 'UPDATE utilisateur SET mot_de_passe = :mot_de_passe WHERE utilisateur_id = :utilisateur_id';
	$changement = $bdd->prepare($requete);
	$donnees = array('utilisateur_id' => $utilisateur_id, 'mot_de_passe' => $mot_de_passe);
	$changement->execute($donnees);
	$changement->closeCursor();
	$requete = 'SELECT utilisateur_id FROM utilisateur WHERE utilisateur_id = :utilisateur_id AND mot_de_passe = :mot_de_passe';
	$verification = $bdd->prepare($requete);
	$verification->execute($donnees);
	if($verification->rowCount() != 1){
		$verification->closeCursor();
		return false;
	}
	else{
		$verification->closeCursor();
		return true;
	}
}
function ajouter_utilisateur($login,$mot_de_passe,$droits){
	$bdd = connection_bdd();
	$requete = 'INSERT INTO utilisateur(utilisateur_id, login, mot_de_passe, droits) VALUES(:utilisateur_id, :login, :mot_de_passe, :droits)';
	$ajout = $bdd->prepare($requete);
	$utilisateur_id = array('utilisateur_id' => NULL);
	$donnees = array('login' => $login, 'mot_de_passe' => $mot_de_passe, 'droits' => $droits);
	$ajout->execute($utilisateur_id + $donnees);
	$ajout->closeCursor();
	$requete = 'SELECT utilisateur_id FROM utilisateur WHERE login = :login AND mot_de_passe = :mot_de_passe AND droits = :droits';
	$verification = $bdd->prepare($requete);
	$verification->execute($donnees);
	if($verification->rowCount() != 1){
		$verification->closeCursor();
		return false;
	}
	else{
		$verification->closeCursor();
		return true;
	}
}
function supprimer_utilisateur($utilisateur_id){
	$bdd = connection_bdd();
	$requete = 'DELETE FROM utilisateur WHERE utilisateur_id = :utilisateur_id';
	$suppression = $bdd->prepare($requete);
	$donnees = array('utilisateur_id' => $utilisateur_id);
	$suppression->execute($donnees);
	$suppression->closeCursor();
	$requete = 'SELECT utilisateur_id FROM utilisateur WHERE utilisateur_id = :utilisateur_id';
	$verification = $bdd->prepare($requete);
	$verification->execute($donnees);
	if($verification->rowCount() != 0){
		$verification->closeCursor();
		return false;
	}
	else{
		$verification->closeCursor();
		return true;
	}
}
function liste_utilisateurs($utilisateur_courant){
	$bdd = connection_bdd();
	$requete = 'SELECT utilisateur_id, login FROM utilisateur WHERE utilisateur_id != :utilisateur_courant';
	$reponse = $bdd->prepare($requete);
	$donnees = array('utilisateur_courant' => $utilisateur_courant);
	$reponse->execute($donnees);
	if($reponse->rowCount() < 1){
		$reponse->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse->fetchAll();
		$reponse->closeCursor();
		return $resultat;
	}
}
function verification_existence($login){
	$bdd = connection_bdd();
	$requete = 'SELECT utilisateur_id FROM utilisateur WHERE login = :login';
	$reponse = $bdd->prepare($requete);
	$donnees = array('login' => $login);
	$reponse->execute($donnees);
	if($reponse->rowCount() > 0){
		$reponse->closeCursor();
		return true;
	}
	else{
		$reponse->closeCursor();
		return false;
	}
}
?>
