<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend un reparation_id et qui retourne un array contenant toutes les données de la reparation et false si elle n'existe pas
function afficher_reparation($reparation_id){
	$bdd = connection_bdd();
	$requete = requete_affichage_reparation();
	$reponse = $bdd->prepare($requete);
	$reponse->execute(array('reparation_id' => $reparation_id));
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
