$(document).ready(function() {
$('#submit').click(function(eventObject) {
	var error = 0;
	$(':checkbox:checked').each(function() {
		if($(this).val() != "") error++;
	});
	if (error == 0) {
		eventObject.preventDefault();
		$('#error_text').show();
	}
});
});

