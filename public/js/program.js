$(document).ready(function() {


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
