<?php
function safe($var)
{
	$var = addcslashes($var, '%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
//Fonction de test pour eviter les isset trop long et tester la presence de données POST ou GET, retourne un booleen
function presence_donnee($methode,$champs){
	if(!is_array($champs)){
		return false;
	}
	else{
		if($methode == 'get'){
			foreach($champs as $valeur){
				if(!isset($_GET[$valeur])){
					return false;
				}
			}
			return true;
		}
		elseif($methode == 'post'){
			foreach($champs as $valeur){
				if(!isset($_POST[$valeur])){
					return false;
				}
			}
			return true;
		}
		elseif($methode == 'session'){
			foreach($champs as $valeur){
				if(!isset($_SESSION[$valeur])){
					return false;
				}
			}
			return true;
		}
		else{
			return false;
		}
	}
}
//Fonction de test pour tester si des champs POST ou GET sont non-vides, retourne un booleen
function non_vide($methode,$champs){
	if(!is_array($champs)){
		return false;
	}
	else{
		if($methode == 'get'){
			foreach($champs as $valeur){
				if($_GET[$valeur] == ''){
					return false;
				}
			}
			return true;
		}
		elseif($methode == 'post'){
			foreach($champs as $valeur){
				if($_POST[$valeur] == ''){
					return false;
				}
			}
			return true;
		}
		elseif($methode == 'session'){
			foreach($champs as $valeur){
				if($_SESSION[$valeur] == ''){
					return false;
				}
			}
			return true;
		}
		else{
			return false;
		}
	}
}
//retourne les différents éléments d'une date au format ISO (aaaa-mm-jj)
function date_vers_jour($date){
	return substr($date,-2);
}
function date_vers_mois($date){
	return substr($date,5,2);
}
function date_vers_annee($date){
	return substr($date,0,4);
}
//retourne un float en prenant un "aaaa-mm-jj hh:mm:ss"
function date_time_vers_float($date_time){
	$float = substr($date_time,0,4) . substr($date_time,5,2) . substr($date_time,8,2) . substr($date_time,11,2) . substr($date_time,14,2) . substr($date_time,17,2);
	$float = (float) $float;
	return $float;
}
function verification_autorisation(){
	$methode = 'session';
	$champs = array('login');
	$autorisation = false;
	if(presence_donnee($methode,$champs)){
		$autorisation = true;
	}
	else{
		$ip = $_SERVER['REMOTE_ADDR'];
		if($ip == '::1' OR $ip == '192.168.1.20'){
			$_SESSION['login'] = 'interne';
			$autorisation = true;
		}
		elseif(strpos($ip,'192.168.') !== false){
			$_SESSION['login'] = 'interne';
			$autorisation = true;
		}
	}
	return $autorisation;
}
?>
