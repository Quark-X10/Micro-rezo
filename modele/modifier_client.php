<?php
require_once("connection_requetes_bdd.php");
//fonction qui prend un array contenant toutes les données client sauf client_id (de type nom => "nom"), modifie la réparation et retourne true si l'ajout a été fait et false sinon
function modifier_client($client_id,$donnees_client){
	$bdd = connection_bdd();
	$champs = array('nom','prenom','adresse','telephone','date_derniere_modification');
	$requete = requete_update('client',$champs);
	$reponse_modification = $bdd->prepare($requete);
	$reponse_modification->execute($donnees_client + array('client_id' => $client_id));
	$reponse_modification->closeCursor();
	$requete = requete_verification('client',$champs);
	$reponse_verification = $bdd->prepare($requete);
	$reponse_verification->execute($donnees_client);
	if($reponse_verification->rowCount() != 1){
		$reponse_verification->closeCursor();
		return false;
	}
	else{
		$reponse_verification->closeCursor();
		return true;
	}
}
function date_derniere_modification($id){
	$bdd = connection_bdd();
	$requete = "SELECT date_derniere_modification FROM client WHERE client_id = :client_id";
	$reponse = $bdd->prepare($requete);
	$donnees = array('client_id' => $id);
	$reponse->execute($donnees);
	if($reponse->rowCount() != 1){
		$reponse->closeCursor();
		return false;
	}
	else{
		$date_array = $reponse->fetch();
		$date = $date_array['date_derniere_modification'];
		$reponse->closeCursor();
		return $date;
	}	
}
?>
