$(document).ready(function() {

	$('#moderator').select2({
        placeholder: "Select Moderator",
    	allowClear: true
    });

	$('#panelist').select2({
        placeholder: "Select Panelist"
    });

	$('#facilitated').select2({
        placeholder: "Select Facilitated"
    });
    
});