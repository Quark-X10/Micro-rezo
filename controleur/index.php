<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
echo 'Attention ceci est la version de développement';
if($autorisation){
	$styles = array('../vue/index.css','../vue/reparation.css','../vue/colorbox.css');
	$scripts = array("../controleur/jquery-1.8.0.js","../controleur/jquery.colorbox.js","../controleur/recherche_client.js","../controleur/liste_reparation.js");
	require_once("../vue/index.php");
}
else{
	require_once("../controleur/authentification.php");
}
?>
