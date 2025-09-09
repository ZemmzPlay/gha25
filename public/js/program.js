$(document).ready(function() {

	// Expand the first program section by default
	$('.oneProgram').first().find('.oneProgramContent').show();
	$('.oneProgram').first().find('#expandProgram').addClass("hide");
	$('.oneProgram').first().find('#collapseProgram').removeClass("hide");

	$('.oneProgramHeader').click(function() {
		$(this).next('.oneProgramContent').slideToggle(600);

		if($(this).children("#expandProgram").hasClass("hide")) {
			$(this).children("#expandProgram").removeClass("hide");
			$(this).children("#collapseProgram").addClass("hide");
		}
		else {
			$(this).children("#expandProgram").addClass("hide");
			$(this).children("#collapseProgram").removeClass("hide");
		}
	});



});
