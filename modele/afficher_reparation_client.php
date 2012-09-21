<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend un client_id et qui retourne un array contenant toutes les reparations associées à ce client
function afficher_reparation_client($client_id){
	$bdd = connection_bdd();
	$requete = 'SELECT * FROM reparation WHERE client = :client';
	$reponse = $bdd->prepare($requete);
	$reponse->execute(array('client' => $client_id));
	$resultat = $reponse->fetchAll();
	$reponse->closeCursor();
	return $resultat;
}
?>
