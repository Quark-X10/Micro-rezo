<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once("../modele/ajouter_reparation.php");
	$methode = 'post';
	$champs_date = array('jour','mois','annee');
	$champs = array('priorite','client','description_panne','mot_de_passe','emplacement','responsable','etat','accord_client','appel','diagnostic','reparation_proposee','documents','tarif');
	$champs_requis = array('description_panne','mot_de_passe');
	if(presence_donnee($methode,$champs) AND presence_donnee($methode,$champs_date) AND non_vide($methode,$champs_requis)){
		$donnees = array();
		foreach($champs as $champ){
			$donnees[$champ] = safe($_POST[$champ]);
		}
		$date = '';
		if($_POST['annee'] == ''){
			$date = date('y');
		}
		else{
			$date = safe($_POST['annee']);
		}
		$date .= '-';
		if($_POST['mois'] == ''){
			$date .= date('m');
		}
		else{
			$date .= safe($_POST['mois']);
		}
		$date .= '-';
		if($_POST['jour'] == ''){
			$date .= date('j');
		}
		else{
			$date .= safe($_POST['jour']);
		}
		$donnees['date_arrivee'] = $date;
		if($_POST['etat'] == ''){
			$donnees['etat'] = 'pas commencé';
		}
		if(isset ($_POST['sacoche']) AND $_POST['sacoche'] == 'on'){
			$donnees['sacoche'] = '1';
		}
		else{
			$donnees[':sacoche'] = '0';
		}
		if(isset ($_POST['chargeur']) AND $_POST['chargeur'] == 'on'){
			$donnees['chargeur'] = '1';
		}
		else{
			$donnees['chargeur'] = '0';
		}
		$verification = 0;
		if(!isset($_POST['verification']) OR $_POST['verification'] != 1){
			$reparations_existantes = rechercher_reparation($donnees['client'],$donnees['date_arrivee']);
			if($reparations_existantes !== false){
				for($i = 0; $i < count($reparations_existantes);$i++){
					$reparations_existantes[$i]['jour'] = date_vers_jour($reparations_existantes[$i]['date_arrivee']);
					$reparations_existantes[$i]['mois'] = date_vers_mois($reparations_existantes[$i]['date_arrivee']);
					$reparations_existantes[$i]['annee'] = date_vers_annee($reparations_existantes[$i]['date_arrivee']);
				}
				$styles = array("../vue/reparations_existantes.css","../vue/reparation.css");
				require_once("../vue/reparations_existantes.php");
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
			$ajout = ajouter_reparation($donnees);
			if($ajout){
				header('Location: ../controleur/index.php');
			}
			else{
				$erreur = "Problème lors de l'ajout de la réparation";
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
