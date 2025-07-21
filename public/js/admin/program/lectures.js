$(document).ready(function() {

	$('.multipleSelect').select2({placeholder: "Select Speaker"});


	$(document).on("click", ".editSaveDeleteLectureButton", function() {

		$("#sessionAddedSuccessMsg").addClass("hide");
		$(".lecturesSuccessContainer").addClass("hide");
		$(".lecturesErrorsContainer").addClass("hide");

		var type = $(this).attr('data-type');
		var id = $(this).attr('data-id');
		var idInClass = (type == "save") ? "add_"+id : id;
		
		var lecture_title = $("[name=lecture_title_"+idInClass+"]").val();
		var lecture_start_time = $("[name=lecture_start_time_"+idInClass+"]").val();
		var lecture_end_time = $("[name=lecture_end_time_"+idInClass+"]").val();
		var speaker_id = $('[name="speaker_id_'+idInClass+'[]"]').val();
		var lecture_parts = $("[name=lecture_parts_"+idInClass+"]").val();

		var lectureData = {};
		var lectureLink = "";


		if(type == "edit") {
			lectureData = {
				session_lectures_id: id,
				lecture_title: lecture_title,
				lecture_start_time: lecture_start_time,
				lecture_end_time: lecture_end_time,
				speaker_id: speaker_id,
				lecture_parts: lecture_parts
			};
			lectureLink = "/admin/program/lectures/update";
		}
		else if(type == "delete") {
			lectureData = {
				session_lectures_id: id
			};
			lectureLink = "/admin/program/lectures/delete";
		}
		else if(type == "save") {
			lectureData = {
				session_id: id,
				lecture_title: lecture_title,
				lecture_start_time: lecture_start_time,
				lecture_end_time: lecture_end_time,
				speaker_id: speaker_id,
				lecture_parts: lecture_parts
			};
			lectureLink = "/admin/program/lectures/save";
		}


		if(lectureLink != "")
		{
			$(".loadingPanel").removeClass("hide");

			$.ajaxSetup({
	            headers: {
	                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
	            }
	        });
			$.ajax({
				method: "POST",
				url: lectureLink,
				data: lectureData,
				success: function(response) {
					$(".loadingPanel").addClass("hide");
					// Check if the response has 'success' key
					if (response.success === true) {
						var successMsgAfterResp = "Lecture Modified Successfully";
						if(type == "delete") successMsgAfterResp = "Lecture Deleted Successfully";
						if(type == "save") successMsgAfterResp = "Lecture Added Successfully";

						$(".lecturesSuccessContainer").text(successMsgAfterResp);
						$(".lecturesSuccessContainer").removeClass("hide");

						if(type == "delete") {
							$(".oneRowLecture_"+idInClass).remove();
						}

						if(type == "save") {
							$(".allRowsLecture").html(response.allRowsLecture);
							$('.multipleSelect').select2({placeholder: "Select Speaker"});
						}

					} else {
						$(".lecturesErrorMsg").text('Error, please try again later');
						$(".lecturesErrors").addClass("hide");
						$(".lecturesErrorsContainer").removeClass("hide");
					}
				},
				error: function(xhr) {
					$(".loadingPanel").addClass("hide");
					if (xhr.responseJSON && xhr.responseJSON.errors) {
						var errors = xhr.responseJSON.errors;
						var errorMessages = Object.values(errors).map(function(error) {
							return "<li>" + error + "</li>";
						}).join('');

						$(".lecturesErrorMsg").text('The following errors happened:');
						$(".lecturesErrors").html(errorMessages);
						$(".lecturesErrors").removeClass("hide");
						$(".lecturesErrorsContainer").removeClass("hide");
					} else {
						$(".lecturesErrorMsg").text('Error, please try again later');
						$(".lecturesErrors").addClass("hide");
						$(".lecturesErrorsContainer").removeClass("hide");
					}
				}
			});
		}
			
	});





});