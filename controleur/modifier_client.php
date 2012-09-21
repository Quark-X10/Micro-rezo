<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once("../modele/modifier_client.php");
	$methode = 'post';
	$client_id = array('client_id');
	$champs = array('nom','prenom','adresse','telephone');
	$champs_requis = array('client_id','nom');
	if(presence_donnee($methode,$client_id) AND presence_donnee($methode,$champs) AND non_vide($methode,$champs_requis)){
		$id = safe($_POST['client_id']);
		$donnees = array();
		foreach($champs as $champ){
			$donnees[$champ] = safe($_POST[$champ]);
		}
		$verification = 0;
		if(!isset($_POST['verification']) OR $_POST['verification'] != 1){
			$date_derniere_modification = date_derniere_modification($id);
			$date_derniere_modification = date_time_vers_float($date_derniere_modification);
			$maintenant = date_time_vers_float(date('Y-m-d H:i:s'));
			if($date_derniere_modification + 60 > $maintenant){
				require_once('../modele/afficher_client.php');
				$donnees['client_id'] = $id;
				$donnees_en_bdd = afficher_client($id);
				$styles = array("../vue/verification_client.css");
				require_once('../vue/verification_client.php');
			}
			else{
				$verification = 1;
			}
		}
		else{
			$verification = 1;
		}
		if($verification == 1){
			$donnees['date_derniere_modification'] = date('Y-m-d H:i:s');
			$verification = modifier_client($id,$donnees);
			if($verification){
				header('Location: ../controleur/index.php');
			}
			else{
				$erreur = "Problème lors de la modification du client";
				require_once("../vue/erreur.php");
			}
		}
	}
	else{
		$erreur = "Données absentes";
		require_once("../vue/erreur.php");
	}

}
else{
	$erreur = "Vous n'etes pas authentifié<br /><a href=\"../controleur/authentification.php\">Authentifiez vous</a>";
	require_once("../vue/erreur.php");
}
?>
