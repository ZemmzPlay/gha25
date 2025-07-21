$(document).ready(function(){

	$(".searchIcon").click(function(){
		var searchBlogContainer = $(this).parent('.searchBlogContainer');
		if(searchBlogContainer.hasClass('searchBlogClosed'))
		{
			searchBlogContainer.removeClass('searchBlogClosed');
		}
		else
		{
			var searchInput = $(".searchInput").val();
			var url = $(this).attr('data-url');
			window.location.href=url+"/"+searchInput;
		}
	});


	$(".closeSearchIcon").click(function(){
		var searchInput = $(".searchInput").val();
		var oldWord = $(".searchInput").attr('data-oldWord');
		if(searchInput != "" && oldWord == 'yes')
		{
			var url = $(".searchIcon").attr('data-url');
			window.location.href=url;
		}
		else
		{
			$('.searchBlogContainer').addClass('searchBlogClosed');
		}
	});


	$(".onePostLikes").click(function(){
		var loggedIn = $(this).attr('data-loggedIn');
		if(loggedIn == "yes")
		{
			var likeButton = $(this);
			var likePostUrl = $("#likePostUrl").val();
			var token = $('meta[name="csrf-token"]').attr("content");
			var postSlug = $(this).attr('data-postSlug');

			$.post(likePostUrl, {'postSlug': postSlug, '_token': token}, function(data){  
				if(!data['error']) {
					if(data['like']){
						likeButton.children('.onePostLikesIcon').addClass('onePostLikesIconLiked');
					}
					else{
						likeButton.children('.onePostLikesIcon').removeClass('onePostLikesIconLiked');
					}

					likeButton.children('.onePostLikesNumber').text(data['nbLikes']);
				}
				else {
					alert( "Error, please try again later" );
				}
			}).fail(function() {
			    alert( "Error, please try again later" );
			});
		}
		else
		{
			$(".oneModelSection").addClass("hideMe");
			$("#loginEmailModel").removeClass("hideMe");
			$("#loginRegisterModel").removeClass('hideMe');
		}
	});

});