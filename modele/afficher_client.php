<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend un client_id et qui retourne un array contenant toutes les données du client et false s'il n'existe pas
function afficher_client($client_id){
	$bdd = connection_bdd();
	$requete = requete_affichage('client');
	$reponse = $bdd->prepare($requete);
	$reponse->execute(array('client_id' => $client_id));
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
