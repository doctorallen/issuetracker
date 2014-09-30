$(document).on('ready', function(){
	if($('.error').length > 0 && $('.reply-button').length > 0){
		$('.comment-form').show();	
	}
	$(document).on('click', '.reply-button', function(){
		$('.comment-form').show();	
	});
	$.extend($.tablesorter.themes.bootstrap, {
		sortNone: 'glyphicon glyphicon-filter',
		sortAsc: 'glyphicon glyphicon-chevron-up',
		sortDesc: 'glyphicon glyphicon-chevron-down'
	});
	$('table').tablesorter({
		theme: 'bootstrap',
		headerTemplate: '{content} {icon}',
		widgets: ["uitheme", "zebra"],
		widgetOptions: {
			zebra: ["even", "odd"],
		}
	});

	$('.comment-delete-form .btn-danger').click(function(e){
		var r = confirm("Are you sure you want to delete this comment?");
		if(r != true){
			e.preventDefault();
		}
	});
});
