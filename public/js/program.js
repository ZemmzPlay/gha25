$(document).ready(function() {

	// Function to handle accordion state based on screen size
	function handleAccordionState() {
		if (window.innerWidth > 650) {
			// Desktop: Expand first accordion
			$('.oneProgram').first().find('.oneProgramContent').show();
			$('.oneProgram').first().find('#expandProgram').addClass("hide");
			$('.oneProgram').first().find('#collapseProgram').removeClass("hide");
		} else {
			// Mobile: Close all accordions
			$('.oneProgram').find('.oneProgramContent').hide();
			$('.oneProgram').find('#expandProgram').removeClass("hide");
			$('.oneProgram').find('#collapseProgram').addClass("hide");
		}
	}

	// Set initial state
	handleAccordionState();

	// Handle window resize
	$(window).resize(function() {
		handleAccordionState();
	});

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
