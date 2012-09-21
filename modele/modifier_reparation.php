<?php
require_once("connection_requetes_bdd.php");
//fonction qui prend un array contenant toutes les données réparation sauf reparation_id (de type diagnostic => "diagnostic"), modifie la réparation et retourne true si l'ajout a été fait et false sinon
function modifier_reparation($reparation_id,$donnees_reparation){
	$bdd = connection_bdd();
	$champs = array('priorite','sacoche','chargeur','date_arrivee','client','description_panne','mot_de_passe','emplacement','responsable','etat','accord_client','appel','diagnostic','reparation_proposee','documents','tarif','date_derniere_modification');
	$requete = requete_update('reparation',$champs);
	$reponse_modification = $bdd->prepare($requete);
	$reponse_modification->execute($donnees_reparation + array('reparation_id' => $reparation_id));
	$reponse_modification->closeCursor();
	$requete = requete_verification('reparation',$champs);
	$reponse_verification = $bdd->prepare($requete);
	$reponse_verification->execute($donnees_reparation);
	if($reponse_verification->rowCount() != 1){
		$reponse_verification->closeCursor();
		return false;
	}
	else{
		$reponse_verification->closeCursor();
		return true;
	}
}
function date_derniere_modification($id){
	$bdd = connection_bdd();
	$requete = "SELECT date_derniere_modification FROM reparation WHERE reparation_id = :reparation_id";
	$reponse = $bdd->prepare($requete);
	$donnees = array('reparation_id' => $id);
	$reponse->execute($donnees);
	if($reponse->rowCount() != 1){
		$reponse->closeCursor();
		return false;
	}
	else{
		$date_array = $reponse->fetch();
		$date = $date_array['date_derniere_modification'];
		$reponse->closeCursor();
		return $date;
	}	
}
?>
