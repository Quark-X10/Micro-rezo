//JavaScript utilisant JQuery pour le tri automatique de la liste
$(document).ready( function() {
	$('#pas-restitue').attr('checked','checked');
	var position= $(window).scrollTop();
	var reparation_a_afficher = $("input[name='reparation_a_afficher']").val();
	setInterval("AffichageListe(window.reparation_a_afficher)", 60000);
	AffichageListe(reparation_a_afficher);
	// détection de la saisie dans le champ de recherche
	$("input[name='reparation_a_afficher']").change(function(){
		window.reparation_a_afficher = $(this).val();
		AffichageListe(window.reparation_a_afficher);	
	});
});
function AffichageListe(formulaire){
	window.position= $(window).scrollTop();
	$('#liste_reparation').html(''); // on vide les resultats
	$('#ajax-loader').remove(); // on retire le loader
	// on envoie la valeur recherché en GET au fichier de traitement
	$.ajax({
		type : 'GET', // envoi des données en GET ou POST
		url : '../controleur/liste_reparation.php' , // url du fichier de traitement
		data : 'reparation_a_afficher='+formulaire , // données à envoyer en  GET ou POST
		beforeSend : function() { // traitements JS à faire AVANT l'envoi
			$('#liste_reparation').after('<img src="../vue/ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
		},
		success : function(data){ // traitements JS à faire APRES le retour de rechercher_client.php
			$('#ajax-loader').remove(); // on enleve le loader
			$('#liste_reparation').html(data); // affichage des résultats dans le bloc
			$(window).scrollTop(window.position);
			$('tr').colorbox({
				href: function(){
					var destination = $(this).attr("id");
					return destination;
				},
			});
		}
	});
}
