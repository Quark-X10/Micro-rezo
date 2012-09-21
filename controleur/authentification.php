<?php
session_start();
require_once("verification_traitement.php");
require_once("../modele/authentification.php");
$methode = 'post';
$champs = array('login','mot_de_passe');
if(presence_donnee($methode,$champs)){
	$methode = 'session';
	$champs = array('utilisateur_id','login');
	if(presence_donnee($methode,$champs)){
		$erreur = "Vous êtes deja authentifié";
		require_once('../vue/erreur.php');
	}
	else{
		$login = safe($_POST['login']);
		$mot_de_passe = sha1(safe($_POST['mot_de_passe']));
		$utilisateur = authentification($login,$mot_de_passe);
		if(!$utilisateur){
			$erreur = "L'authentification a échouée";
			require_once('../vue/erreur.php');
		}
		else{
			$_SESSION['login'] = $utilisateur['login'];
			$_SESSION['utilisateur_id'] = $utilisateur['utilisateur_id'];
			$_SESSION['droits'] = $utilisateur['droits'];
			header('Location: ../index.php');
		}
	}

}
else{
	$styles = NULL;
	$scripts = NULL;
	require_once("../vue/authentification.php");
}
?>
