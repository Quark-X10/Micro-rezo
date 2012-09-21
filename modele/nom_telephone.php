<?php
require_once('connection_requetes_bdd.php');
function nom_telephone($client_id){
	$bdd = connection_bdd();
	$requete = 'SELECT nom, telephone FROM client WHERE client_id = :client_id';
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
