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
		$('.searchBlogContainer').addClass('searchBlogClosed');
	});












	$(document).on('click', '.shareButton_gl', function() {
		var postLink = $(this).attr('data-url');
		$(".shareLinkInput").val(postLink);
		$("#shareLinkModal").removeClass('hideMe');
	});

	$(document).on("click", ".closeShareModal", function (e) {
		$("#shareLinkModal").addClass('hideMe');
	});
	$(document).on("click", ".shareModalCancel", function (e) {
		$("#shareLinkModal").addClass('hideMe');
	});
	$(document).on("click", ".shareModalCopy", function (e) {
		var postLink = $(".shareLinkInput").val();
		navigator.clipboard.writeText(postLink);
	});

		
	// http://www.linkedin.com/shareArticle?mini=true&url=https://stackoverflow.com/questions/10713542/how-to-make-custom-linkedin-share-button/10737122&title=How%20to%20make%20custom%20linkedin%20share%20button&summary=some%20summary%20if%20you%20want&source=stackoverflow.com

	jQuery('#twitter').off('click').on('click', function() {
		var postLink = $(this).attr('data-url');
	  	var field_list = {
		    url: postLink,
		    text: '', //Some random text
		    hashtags: '', //myhashtag,anothertag
	  	}
	  	window.open('https://twitter.com/share?'+jQuery.param(field_list), '_blank', 'width=550,height=420').focus();
	});

});