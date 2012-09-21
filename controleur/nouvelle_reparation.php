<?php
session_start();
require_once("../controleur/verification_traitement.php");
require_once("../modele/nom_telephone.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("verification_traitement.php");
	$methode = 'get';
	$champs = array('client_id');
	if(presence_donnee($methode,$champs) AND non_vide($methode,$champs)){
		$client = safe($_GET['client_id']);
		$nom_telephone = nom_telephone($client);
		$styles = array('../vue/reparation.css');
		require_once("../vue/nouvelle_reparation.php");
	}
	else{
		$erreur = "Il n'y a pas de client associé";
		require_once("../vue/erreur.php");
	}

}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
