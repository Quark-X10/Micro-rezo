<?php
session_start();
require_once("../controleur/verification_traitement.php");
$autorisation = verification_autorisation();
if($autorisation){
	require_once("../controleur/verification_traitement.php");
	require_once("../modele/modifier_reparation.php");
	$methode = 'post';
	$champs_autres = array('reparation_id','jour','mois','annee');
	$champs = array('priorite','client','description_panne','mot_de_passe','emplacement','responsable','etat','accord_client','appel','diagnostic','reparation_proposee','documents','tarif');
	$champs_requis = array('reparation_id','description_panne','mot_de_passe');
	if(presence_donnee($methode,$champs) AND presence_donnee($methode,$champs_autres) AND non_vide($methode,$champs_requis)){
		$id = safe($_POST['reparation_id']);
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
			$donnees['sacoche'] = '0';
		}
		if(isset ($_POST['chargeur']) AND $_POST['chargeur'] == 'on'){
			$donnees['chargeur'] = '1';
		}
		else{
			$donnees['chargeur'] = '0';
		}
		$verification = 0;
		if(!isset($_POST['verification']) OR $_POST['verification'] != 1){
			$date_derniere_modification = date_derniere_modification($id);
			$date_derniere_modification = date_time_vers_float($date_derniere_modification);
			$maintenant = date_time_vers_float(date('Y-m-d H:i:s'));
			if($date_derniere_modification + 60 > $maintenant){
				require_once('../modele/afficher_reparation.php');
				$donnees['jour'] = date_vers_jour($donnees['date_arrivee']);
				$donnees['mois'] = date_vers_mois($donnees['date_arrivee']);
				$donnees['annee'] = date_vers_annee($donnees['date_arrivee']);
				$donnees['reparation_id'] = $id;
				$donnees_en_bdd = afficher_reparation($id);
				$donnees_en_bdd['jour'] = date_vers_jour($donnees_en_bdd['date_arrivee']);
				$donnees_en_bdd['mois'] = date_vers_mois($donnees_en_bdd['date_arrivee']);
				$donnees_en_bdd['annee'] = date_vers_annee($donnees_en_bdd['date_arrivee']);
				$styles = array("../vue/verification_reparation.css","../vue/reparation.css");
				require_once('../vue/verification_reparation.php');
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
			$verification = modifier_reparation($id,$donnees);
			if($verification){
				header('Location: ../controleur/index.php');
			}
			else{
				$erreur = "Problème lors de la modification de la réparation";
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
