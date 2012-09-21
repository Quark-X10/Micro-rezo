<?php
function mot_de_passe($ancien_mot_de_passe,$nouveau_mot_de_passe,$verif_mot_de_passe){
	if($nouveau_mot_de_passe == $verif_mot_de_passe){
		$mot_de_passe_crypte = sha1($nouveau_mot_de_passe);
		$changement = changer_mot_de_passe($_SESSION['utilisateur_id'],$mot_de_passe_crypte);
		if($changement){
			header('Location: ../index.php');
		}
		else{
			$erreur = "Erreur lors du changement de mot de passe";
			require_once('../vue/erreur.php');
		}
	}
	else{
		$erreur = "Tu as entré 2 nouveaux mots de passes différents";
		require_once('../vue/erreur.php');
	}
}
function ajout($login,$mot_de_passe,$verif_mot_de_passe,$droits){
	if($mot_de_passe == $verif_mot_de_passe){
		$mot_de_passe_crypte = sha1($mot_de_passe);
		$existe = verification_existence($login);
		if($existe){
			$erreur = "Ce login est deja utilisé";
			require_once('../vue/erreur.php');
		}
		else{
			$ajout = ajouter_utilisateur($login,$mot_de_passe_crypte,$droits);
			if($ajout){
				header('Location: ../index.php');
			}
			else{
				$erreur = "Erreur lors de l'ajout de l'utilisateur";
				require_once('../vue/erreur.php');
			}
		}
	}
	else{
		$erreur = "Tu as entré 2 mots de passes différents";;
		require_once('../vue/erreur.php');
	}
}
function suppression($utilisateur_id){
	$suppression = supprimer_utilisateur($utilisateur_id);
	if($suppression){
		header('Location: ../index.php');
	}
	else{
		$erreur = "Erreur lors de la suppression de l'utilisateur";
		require_once('../vue/erreur.php');
	}
}

session_start();
require_once("verification_traitement.php");
require_once("../modele/administration.php");
$methode = 'post';
$champs = array('action');
$methode2 = 'session';
$champs2 = array('utilisateur_id','login');
if(presence_donnee($methode,$champs) AND presence_donnee($methode2,$champs2)){
	if($_POST['action'] == 'changer_mot_de_passe'){
		$methode = 'post';
		$champs = array('ancien_mot_de_passe','nouveau_mot_de_passe','verif_mot_de_passe');
		if(presence_donnee($methode,$champs) AND non_vide($methode,$champs)){
			mot_de_passe(safe($_POST['ancien_mot_de_passe']),safe($_POST['nouveau_mot_de_passe']),safe($_POST['verif_mot_de_passe']));
		}
	}
	elseif($_POST['action'] == 'ajouter_utilisateur' AND $_SESSION['droits'] == 'admin'){
		$methode = 'post';
		$champs = array('login','mot_de_passe','verif_mot_de_passe','droits');
		if(presence_donnee($methode,$champs) AND non_vide($methode,$champs)){
			ajout(safe($_POST['login']),safe($_POST['mot_de_passe']),safe($_POST['verif_mot_de_passe']),safe($_POST['droits']));
		}
	}
	elseif($_POST['action'] == 'supprimer_un_utilisateur' AND $_SESSION['droits'] == 'admin'){
		$methode = 'post';
		$champs = array('utilisateur_id');
		if(presence_donnee($methode,$champs) AND non_vide($methode,$champs)){
			suppression(safe($_POST['utilisateur_id']));
		}
	}
	$erreur = "Données absentes";
	require_once('../vue/erreur.php');
}
else{
	$methode = 'session';
	$champs = array('utilisateur_id','login');
	if(presence_donnee($methode,$champs)){
		$droits = $_SESSION['droits'];
		$styles= NULL;
		$scripts = NULL;
		if($droits == 'admin'){
			$admin = true;
			$utilisateurs = liste_utilisateurs($_SESSION['utilisateur_id']);
			require_once('../vue/administration.php');
		}
		elseif($droits == 'utilisateur'){
			$admin = false;
			require_once('../vue/administration.php');
		}
		else{
			$erreur = "Vous n'êtes pas authentifié";
			require_once('../vue/erreur.php');
		}
	
	}
	else{
		$erreur = "Vous n'êtes pas authentifié";
		require_once('../vue/erreur.php');
	}
}
?>
