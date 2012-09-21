<?php
require_once('connection_requetes_bdd.php');
//fonction qui renvoie des reparations verifiant la condition avec le nom du client correspondant à chaque réparation et les trie suivant les champs donnés, le nombre et l'offset permettent de faire une pagination
function afficher_liste($condition,$tri,$offset,$limite){
	$bdd = connection_bdd();
	$requete = requete_liste_reparation($condition,$tri,$offset,$limite);
	$reponse = $bdd->prepare($requete);
	$reponse->execute();
	$resultat = $reponse->fetchAll();
	$reponse->closeCursor();
	return $resultat;
}
?>
