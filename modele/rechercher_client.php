<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend une chaine de caractere et qui retourne un array contenant tous les clients dont le nom commence par cette chaine et false s'il y en a aucun
function rechercher_client($nom,$offset,$limite){
	$bdd = connection_bdd();
	$requete = requete_recherche($offset,$limite);
	$reponse = $bdd->prepare($requete);
	$recherche = $nom . '%';
	$reponse->execute(array('nom' => $recherche));
	if($reponse->rowCount() == 0){
		$reponse->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse->fetchAll();
		$reponse->closeCursor();
		return $resultat;
	}
}
?>
