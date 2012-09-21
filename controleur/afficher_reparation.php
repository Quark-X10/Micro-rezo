<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once('../modele/afficher_reparation.php');
	$id = safe($_GET['reparation_id']);
	$reparation = afficher_reparation($id);
	if($reparation){
		$reparation['jour'] = date_vers_jour($reparation['date_arrivee']);
		$reparation['mois'] = date_vers_mois($reparation['date_arrivee']);
		$reparation['annee'] = date_vers_annee($reparation['date_arrivee']);
		$numero = "Réparation n°" . $id;
		$styles = array('../vue/reparation.css');
		require_once('../vue/affichage_reparation.php');
	}
	else{
		$erreur = "Cete réparation n'existe pas";
		require_once('../vue/erreur.php');
	}

}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
