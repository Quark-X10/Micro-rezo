<?php
//Affiche la tete et le pied de page html en incluant les pages de style et de scripts
function tete($titre,$styles,$scripts){
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Reparation_is_back : <?php echo $titre;?></title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../vue/favicon.png">
		<?php
		//On ajoute un à un les pages de styles dans le head
		if(is_array($styles)){
			foreach($styles as $style){
			?>
			<link rel="stylesheet" href="<?php echo $style ?>" />
			<?php
			}
		}
		//On ajoute un à un les fichiers de script
		if(is_array($scripts)){
			foreach($scripts as $script){
			?>
			<script type="text/javascript" src="<?php echo $script ?>"></script>
			<?php
			}
		}
		?>
	</head> 
	<body>
	<?php
}
function pied(){
	?>
	</body>
</html>
<?php
}
//ajoute une case dans un tableau HTML
function ajout_case_tableau($contenu){
	?>
	<td>
	<?php
	echo $contenu;
	?>	
	</td>
	<?php
}
//prend un booleen pour afficher la priorite
function style($priorite,$etat,$appel){
	$valeurs_appele = array('oui','répondeur',);
	$valeurs_en_cours = array('terminé','en cours','diagnostic fait','devis délivré','attente pièce','attente accord client');
	$valeurs_urgence = array('Urgence','SAV');
	if($etat == 'terminé' AND in_array($appel,$valeurs_appele)){
		return 'reparation-terminee';
	}
	elseif(in_array($priorite,$valeurs_urgence)){
		return 'reparation-urgente';
	}
	elseif($priorite == 'Diag urgent'){
		return 'reparation-diag-urgent';
	}
	elseif(in_array($etat,$valeurs_en_cours)){
		return 'reparation-en-cours';
	}
	else{
		return 'reparation';
	}
}
//prend une date aaaa-mm-jj (format ISO de la bdd) et retourne la chaine jj/mm/aaaa (format français)
function date_vers_chaine($date){
	$resultat = substr($date, -2) . '/' . substr($date,5,2) . '/' . substr($date,0,4);
	return $resultat;
}
?>
