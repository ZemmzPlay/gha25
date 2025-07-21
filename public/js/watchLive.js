$(document).ready(function(){

	function showResponseMsg(type, msg = "", timer = true) {
		var messageShowTime = 5000;

		if(type == "success")
		{
			$(".responseMsg").text(msg).addClass('successResp').removeClass("errorResp").removeClass("none");

			if(timer)
			{
				setTimeout(function() {
		    		$(".responseMsg").text("").addClass("none").removeClass('successResp');
		    	}, messageShowTime);
			}
		}
		else if(type == "error")
		{
			$(".responseMsg").text(msg).addClass('errorResp').removeClass("successResp").removeClass("none");

			if(timer)
			{
				setTimeout(function() {
	        		$(".responseMsg").text("").addClass("none").removeClass('errorResp');
	        	}, messageShowTime);
			}
		}
		else
		{
			$(".responseMsg").text("").addClass("none").removeClass('successResp').removeClass('errorResp');
		}
	}

	$(".submitQuestion").click(function() {
	    var token = $('meta[name="_token"]').attr('content');
	    var question = $(".questionText").val();
	    if(question != "")
	    {
	    	$(".loadingContainer").removeClass("none");
	    	// $(".questionContainer").removeClass("requiredField");
	    	showResponseMsg("hide");

		    // send the question via AJAX
		    $.ajax({
		        type: 'POST',
		        url: '/watch-live', // Update the URL to the correct endpoint
		        headers: {
		            'X-CSRF-TOKEN': token // Send CSRF token in headers
		        },
		        data: {
		            '_token': token, // Include token in data
		            'question': question
		        },
		        success: function(response) {
		        	$(".loadingContainer").addClass("none");

		            if(response.success)
		            {
		            	//// success ////
		            	$(".questionText").val('');
		            	showResponseMsg("success", "Message Sent Successfully");
		            	//// success ////
		            }
		            else
		            {
		            	//// error ////
		            	showResponseMsg("error", response.message);
		            	//// error ////
		            }
		        },
		        error: function(xhr, status, error) {
		        	$(".loadingContainer").addClass("none");

		            //// error ////
		            showResponseMsg("error", 'Error, please try again later');
	            	//// error ////
		        }
		    });
	    }
	    else
	    {
	    	// $(".questionContainer").addClass("requiredField");
	    	showResponseMsg("error", 'Question field is required', false);
	    }
	});



	// ////////// set timer for the next session //////////
	// var nextSessionSeconds = $("#nextSessionSeconds").val();
	// if(nextSessionSeconds != "")
	// {
	// 	nextSessionSeconds = parseInt(nextSessionSeconds);
	// 	if(nextSessionSeconds > 0 && nextSessionSeconds < 2147483) {
	// 		fetchNextSessionHandler(nextSessionSeconds);
	// 	}
	// }
	// ////////// set timer for the next session //////////



	// function fetchNextSessionHandler(seconds) {
	//     setTimeout(function() {
	        
	//         var token = $('meta[name="_token"]').attr('content');
	//         $.ajax({
	//             url: 'refresh-session',
	//             method: 'POST',
	//             headers: {
	// 	            'X-CSRF-TOKEN': token
	// 	        },
	// 	        data: {
	// 	            '_token': token
	// 	        },
	//             success: function(response) {
	//             	var currentSessionDateTime = response.currentSessionDateTime;
	//             	if(currentSessionDateTime != null)
	//             	{
	//             		$(".sessionTitle").addClass("none");
	//             		$(".sessionContent").addClass("none");
	//             		$("#"+currentSessionDateTime+"_title").removeClass("none");
	//             		$("#"+currentSessionDateTime+"_content").removeClass("none");
	//             	}

	//                 ///// set timer for next session /////
	// 				var nextSessionSec = response.nextSessionSeconds;
	// 				if(nextSessionSec != null)
	// 				{
	// 					nextSessionSec = parseInt(nextSessionSec);
	// 					if(nextSessionSec > 0 && nextSessionSec < 2147483)
	// 						fetchNextSessionHandler(nextSessionSec);
	// 				}
	// 				///// set timer for next session /////
	//             },
	//             error: function(xhr, status, error) {
	//             }
	//         });
	//     }, seconds * 1000);
	// }


	$(".playVideoButton").click(function(){
		$(".playVideoButtonContainer").hide();
		var youtubeLink = $("#youtubeLink").val();
		$("#youtubeVideo").attr('src', youtubeLink + '&amp;autoplay=1'); 
	});




	function updateClock() {
	    let currentTime = new Date();
	    let kuwaitTime = new Date(currentTime.toLocaleString('en-US', { timeZone: 'Asia/Kuwait' }));
	    let year = kuwaitTime.getFullYear();
	    let month = (kuwaitTime.getMonth() + 1).toString().padStart(2, '0');
	    let day = kuwaitTime.getDate().toString().padStart(2, '0');
	    let hours = kuwaitTime.getHours();
	    let minutes = kuwaitTime.getMinutes();
	    let seconds = kuwaitTime.getSeconds();

	    minutes = (minutes < 10 ? "0" : "") + minutes;
	    // seconds = (seconds < 10 ? "0" : "") + seconds;

	    // $(".localTime").text("Local Time: " + year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds);
	    $(".localTime").text("Local Time: " + hours + ":" + minutes);



	    ////////// check if I should update time //////////
	    let currentTimeNow = year+"_"+month+"_"+day+"_"+hours+"_"+minutes;
	    let allSessionsTimes = $(".allSessionsTimes").text();
	    allSessionsTimes = JSON.parse(allSessionsTimes);
	    if (allSessionsTimes.includes(currentTimeNow))
	    {
			$(".sessionTitle").addClass("none");
    		$(".sessionContent").addClass("none");
    		$("#"+currentTimeNow+"_title").removeClass("none");
    		$("#"+currentTimeNow+"_content").removeClass("none");
    		let sessionTitleTemp = $("#"+currentTimeNow+"_title").text();
    		$(".sessionTitleMobile").text(sessionTitleTemp);
		}
	    ////////// check if I should update time //////////
	    



	    // Refresh the clock every second (1000ms)
	    let secondsLeft = 60 - seconds;
		secondsLeft = secondsLeft * 1000;
	    setTimeout(updateClock, secondsLeft);
	}


	///// run first time /////
	// let currentTime = new Date();
	// let kuwaitTime = new Date(currentTime.toLocaleString('en-US', { timeZone: 'Asia/Kuwait' }));
	// let seconds = kuwaitTime.getSeconds();
	// let secondsLeft = 60 - seconds;
	// secondsLeft = secondsLeft * 1000;
    updateClock(); // Call the function to start the clock
    ///// run first time /////
});