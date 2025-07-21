$(document).ready(function() {


    $('#payment_status').select2();

    //////////// Image load ////////////
    $(".imageInput").change(function(){
        var input = this;
        var imageHolder = $(this).prev('.img-container-list').children('.imageHolder');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imageHolder.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    });
    //////////// Image load ////////////

});