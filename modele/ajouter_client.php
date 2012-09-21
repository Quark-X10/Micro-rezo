<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend un array contenant toutes les données clients sauf client_id (de type nom => "nom"), ajoute le client et retourne l'id si l'ajout a été fait et false sinon
function ajouter_client($donnees_client){
	$champs = array('nom','prenom','adresse','telephone','date_derniere_modification');
	$id_champs = array('client_id','nom','prenom','adresse','telephone','date_derniere_modification');
	$requete = requete_insert('client',$id_champs);
	$bdd = connection_bdd();
	$reponse_ajout = $bdd->prepare($requete);
	$client_id = array('client_id' => NULL);
	$reponse_ajout->execute($client_id + $donnees_client);
	$reponse_ajout->closeCursor();
	$requete = requete_verification('client',$champs);
	$reponse_verification = $bdd->prepare($requete);
	$reponse_verification->execute($donnees_client);
	if($reponse_verification->rowCount() != 1){
		$reponse_verification->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse_verification->fetch();
		$reponse_verification->closeCursor();
		return $resultat['client_id'];
	}
}
?>
