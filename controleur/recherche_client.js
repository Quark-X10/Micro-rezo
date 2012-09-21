//JavaScript utilisant JQuery pour la recherche dynamique des clients
$(document).ready( function() {
	// détection de la saisie dans le champ de recherche
	$('#nom_client').keyup( function(){
		$field = $(this);
		$('#resultats').html(''); // on vide les resultats
		$('#ajax-loader').remove(); // on retire le loader
		// on commence à traiter à partir du 2ème caractère saisie
		if( $field.val().length > 1 )
		{
			// on envoie la valeur recherché en GET au fichier de traitement
			$.ajax({
				type : 'GET', // envoi des données en GET ou POST
				url : '../controleur/rechercher_client.php' , // url du fichier de traitement
				data : 'nom_client='+$(this).val() , // données à envoyer en  GET ou POST
				beforeSend : function() { // traitements JS à faire AVANT l'envoi
					$('#resultats').after('<img src="../vue/ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
				},
				success : function(data){ // traitements JS à faire APRES le retour de rechercher_client.php
					$('#ajax-loader').remove(); // on enleve le loader
					$('#resultats').html(data); // affichage des résultats dans le bloc
				}
			});
		}		
	});
});
