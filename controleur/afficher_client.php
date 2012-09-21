<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once('../modele/afficher_client.php');
	require_once('../modele/afficher_reparation_client.php');
	$id = safe($_GET['client_id']);
	$client = afficher_client($id);
	if($client){
		$reparation_client = afficher_reparation_client($id);
		$numero = "Client n°" . $id;
		$styles = array('../vue/afficher_client.css','../vue/reparation.css','../vue/colorbox.css');
		$scripts = array("../controleur/jquery-1.8.0.js","../controleur/jquery.colorbox.js","../controleur/colorbox_reparation.js");
		require_once('../vue/affichage_client.php');
	}
	else{
		$erreur = "Ce client n'existe pas";
		require_once('../vue/erreur.php');
	}
}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
