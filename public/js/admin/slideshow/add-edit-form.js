$(document).ready(function() {

	$('#active').select2();
    $('#buttonTheme').select2();

	//////////// Image load ////////////
	function readURL(input, imageName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+imageName).attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }



    $("#image").change(function(){
        readURL(this, 'imageShow');
    });

    $("#image_mobile").change(function(){
        readURL(this, 'imageMobileShow');
    });
    //////////// Image load ////////////

});