<?php
//Retourne un objet PDO connecté à la BDD
function connection_bdd(){
	$bdd = NULL;
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=***', '***', '***');
	}
	catch (Exception $e)
	{
  	      die('Erreur : ' . $e->getMessage());
	}
	return $bdd;
}
//Crée une chaine de caractere de requete d'ajout (INSERT) pour la table et l'array des champs demandés
function requete_insert($table,$champs){
	if(!is_array($champs)){
		return false;
	}
	else{
		$requete = 'INSERT INTO ' . $table .'(';
		$derniere_cle = end(array_keys($champs));
		foreach($champs as $cle => $valeur){
			$requete .= $valeur;
			if($cle != $derniere_cle){
				$requete .= ', ';
			}
		}
		unset($cle);
		unset($valeur);
		$requete .= ') VALUES(';
		foreach($champs as $cle => $valeur){
			$requete .= ':' . $valeur;
			if($cle != $derniere_cle){
				$requete .= ', ';
			}
		}
		unset($cle);
		unset($valeur);
		$requete .= ')';
		return $requete;
	}
}
//Crée une chaine de caractere de requete de verification de type SELECT id FROM table WHERE champ = :champ
function requete_verification($table,$champs){
	if(!is_array($champs)){
		return false;
	}
	else{
		$requete = 'SELECT ' . $table . '_id FROM ' . $table . ' WHERE ';
		$derniere_cle = end(array_keys($champs));
		foreach($champs as $cle => $valeur){
			$requete .= $valeur . ' = :' . $valeur;
			if($cle != $derniere_cle){
					$requete .= ' AND ';
			}
		}
		unset($cle);
		unset($valeur);
		return $requete;
	}
}
//Crée une chaine de caractere de requete de type "SELECT *" suivant l'id dans la table
function requete_affichage($table){
	return 'SELECT * FROM ' . $table . ' WHERE ' . $table . '_id = :' . $table . '_id';
}
function requete_affichage_reparation(){
	return 'SELECT reparation.*, client.nom, client.telephone FROM reparation INNER JOIN client ON client.client_id = reparation.client WHERE reparation_id = :reparation_id';
}
//Crée une chaine de caractere de requete d'update de type UPDATE table SET champs = :champs WHERE table_id = :table_id
function requete_update($table,$champs){
	if(!is_array($champs)){
		return false;
	}
	else{
		$requete = 'UPDATE ' . $table . ' SET ';
		$derniere_cle = end(array_keys($champs));
		foreach($champs as $cle => $valeur){
			$requete .= $valeur . ' = :' . $valeur;
			if($cle != $derniere_cle){
					$requete .= ', ';
			}
		}
		unset($cle);
		unset($valeur);
		$requete .= ' WHERE ' . $table . '_id = :' . $table . '_id';
		return $requete;
	}

}
//Crée une chaine de caractere de requete de recherche de type "SELECT * FROM client WHERE nom LIKE nom ORDER BY nom,prenom LIMIT limit OFFSET offset"
function requete_recherche($offset,$limite){
	$requete = 'SELECT * FROM client WHERE nom LIKE :nom ORDER BY nom, prenom';
	if($limite != 0){
		$requete .= ' LIMIT ' . $limite . ' OFFSET ' . $offset;
	}
	return $requete;
}
function requete_liste_reparation($condition,$tri,$offset,$limite){
	$requete = 'SELECT reparation.reparation_id, reparation.date_arrivee, reparation.priorite, reparation.etat, reparation.emplacement, reparation.appel, reparation.description_panne, client.nom FROM reparation INNER JOIN client ON reparation.client = client.client_id WHERE ' . $condition;
	if(count($tri) != 0){
		$requete .= ' ORDER BY ';
		$derniere_cle = end(array_keys($tri));
		foreach($tri as $cle => $valeur){
			$requete .= $valeur;
			if($cle != $derniere_cle){
					$requete .= ', ';
			}
		}
	}
	if($limite != 0){
		$requete .= ' LIMIT ' . $limite . ' OFFSET ' . $offset;
	}
	return $requete;
}
?>
