<?php
require_once('connection_requetes_bdd.php');
function authentification($login,$mot_de_passe){
	$bdd = connection_bdd();
	$requete = 'SELECT * FROM utilisateur WHERE login = :login AND mot_de_passe = :mot_de_passe';
	$reponse = $bdd->prepare($requete);
	$utilisateur = array('login' => $login, 'mot_de_passe' => $mot_de_passe);
	$reponse->execute($utilisateur);
	if($reponse->rowCount() != 1){
		$reponse->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse->fetch();
		$reponse->closeCursor();
		return $resultat;
	}
}
?>
