$(document).ready( function() {
	$('tr').colorbox({
		href: function(){
			var destination = $(this).attr("id");
			return destination;
		},
	});
});
