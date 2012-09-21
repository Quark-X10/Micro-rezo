<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once("../modele/ajouter_client.php");
	$methode = 'post';
	$champs = array('nom','prenom','adresse','telephone');
	$champs_requis = array('nom');
	if(presence_donnee($methode,$champs) AND non_vide($methode,$champs_requis)){
		$donnees = array();
		foreach($champs as $champ){
			$donnees[$champ] = safe($_POST[$champ]);
		}
		$verification = 0;
		if(!isset($_POST['verification']) OR $_POST['verification'] != 1){
			require_once("../modele/rechercher_client.php");
			$clients_existants = rechercher_client($donnees['nom'],0,0);
			if($clients_existants !== false){
				$styles = array("../vue/clients_existants.css");
				require_once("../vue/clients_existants.php");
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
			$ajout = ajouter_client($donnees);
			if($ajout){
				header('Location: ../controleur/nouvelle_reparation.php?client_id=' . $ajout);
			}
			else{
				$erreur = "Problème lors de l'ajout du client";
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
