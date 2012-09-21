<?php
require_once('decor.php');
if(count($liste_reparation) == 0){
	echo "Aucune réparation trouvée";
}
else{
	//Affichage dans un tableau
	?>
	<table>
		<tr>
			<th>Date d'arrivée</th>
			<th>Client</th>
			<th>Priorité</th>
			<th>Etat</th>
			<th>Emplacement</th>
			<th>Description et panne</th>
		</tr>
	<?php
	//Affichage de chacune des reparation
	foreach($liste_reparation as $reparation){
			echo '<tr class="' . style($reparation['priorite'],$reparation['etat'],$reparation['appel']) . '" title="réparation n° ' . $reparation['reparation_id'] .'" id="../controleur/afficher_reparation.php?reparation_id=' . $reparation['reparation_id'] .'">';
			ajout_case_tableau(date_vers_chaine($reparation['date_arrivee']));
			ajout_case_tableau($reparation['nom']);
			ajout_case_tableau($reparation['priorite']);
			ajout_case_tableau($reparation['etat']);
			ajout_case_tableau($reparation['emplacement']);
			ajout_case_tableau($reparation['description_panne']);
			echo '</tr>';
		}
		?>
	</table>
<?php
}
?>

