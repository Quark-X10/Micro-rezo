<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../modele/afficher_liste.php");
	require_once("../controleur/verification_traitement.php");
	$reparation_a_afficher = safe($_GET['reparation_a_afficher']);
	if($reparation_a_afficher == 'en-cours'){
		$condition = 'etat = \'en cours\' OR etat = \'devis délivré\' OR etat = \'diagnostic fait\'';
	}
	elseif($reparation_a_afficher == 'urgence'){
		$condition = '(priorite = \'urgence\' OR priorite = \'Diag urgent\') AND etat != \'restitué\'';
	}
	elseif($reparation_a_afficher == 'SAV'){
		$condition = 'priorite = \'SAV\'  AND etat != \'restitué\'';
	}
	elseif($reparation_a_afficher == 'pas-commence'){
		$condition = 'etat = \'pas commencé\'';
	}
	elseif($reparation_a_afficher == 'restitue'){
		$condition = 'etat = \'restitué\'';
	}
	else{
		$condition = 'etat != \'restitué\'';
	}
	$tri = array ('FIELD(priorite, \'SAV\',\'normal\')','date_arrivee','reparation_id');
	$offset = 0;
	$limite = 0;
	$liste_reparation = afficher_liste($condition,$tri,$offset,$limite);
	require_once("../vue/liste_reparation.php");

}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
