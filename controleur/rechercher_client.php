<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once("../modele/rechercher_client.php");
	$nom = safe($_GET['nom_client']);
	$offset =0;
	$limite = 0;
	$reponse = rechercher_client($nom,$offset,$limite);
	require_once("../vue/recherche_client.php");

}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
