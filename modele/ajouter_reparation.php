<?php
require_once('connection_requetes_bdd.php');
//fonction qui prend un array contenant toutes les données réparation sauf reparation_id (de type diagnostic => "diagnostic"), ajoute la réparation et retourne l'id si l'ajout a été fait et false sinon
function ajouter_reparation($donnees_reparation){
	$id_champs = array('reparation_id','priorite','sacoche','chargeur','date_arrivee','client','description_panne','mot_de_passe','emplacement','responsable','etat','accord_client','appel','diagnostic','reparation_proposee','documents','tarif','date_derniere_modification');
	$champs = array('priorite','sacoche','chargeur','date_arrivee','client','description_panne','mot_de_passe','emplacement','responsable','etat','accord_client','appel','diagnostic','reparation_proposee','documents','tarif','date_derniere_modification');
	$requete = requete_insert('reparation',$id_champs);
	$bdd = connection_bdd();
	$reponse_ajout = $bdd->prepare($requete);
	$reparation_id = array('reparation_id' => NULL);
	$reponse_ajout->execute($reparation_id + $donnees_reparation);
	$reponse_ajout->closeCursor();
	$requete = requete_verification('reparation',$champs);
	$reponse_verification = $bdd->prepare($requete);
	$reponse_verification->execute($donnees_reparation);
	if($reponse_verification->rowCount() != 1){
		$reponse_verification->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse_verification->fetch();
		$reponse_verification->closeCursor();
		return $resultat['reparation_id'];
	}
}
function rechercher_reparation($client,$date_arrivee){
	$bdd = connection_bdd();
	$requete = 'SELECT reparation.*, client.nom FROM reparation INNER JOIN client ON reparation.client = client.client_id WHERE client = :client AND date_arrivee = :date_arrivee';
	$reponse = $bdd->prepare($requete);
	$reponse->execute(array('client' => $client, 'date_arrivee' => $date_arrivee));
	if($reponse->rowCount() == 0){
		$reponse->closeCursor();
		return false;
	}
	else{
		$resultat = $reponse->fetchAll();
		$reponse->closeCursor();
		return $resultat;
	}
}
?>
