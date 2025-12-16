$(document).ready(function () {

    $('#owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        margin: 10,
        responsiveClass: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        lazyLoad: true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });




    ////////////// validate country yemen and palestine //////////////
    $('select[name="countryCode"]').change(function () {
        var countryCodeSelected = $(this).val();
        var virtualAccessValue = $('input[name="virtualAccess"]').val();
        if ((countryCodeSelected == "+967" || countryCodeSelected == "+970") && virtualAccessValue == 1) {
            $("#normalPricePay").addClass("hide");
            $("#specialPriceFree").removeClass("hide");
        }
        else {
            $("#specialPriceFree").addClass("hide");
            $("#normalPricePay").removeClass("hide");
        }
    });
    ////////////// validate country yemen and palestine //////////////





    var registrationPrice = 20;


    $(".registerCheckbox").click(function () {
        var element = $(this).attr('data-element');
        var checkBoxInput = $(this).next('.registerCheckboxReal');
        var onlyWorkshopValue = 0;
        if ($(this).hasClass('registerCheckboxChecked')) {
            // $('input[name="receive_updates"]').val(0);
            checkBoxInput.val(0);
            $(this).removeClass("registerCheckboxChecked");
        }
        else {
            onlyWorkshopValue = 1;
            // $('input[name="receive_updates"]').val(1);
            checkBoxInput.val(1);
            $(this).addClass("registerCheckboxChecked");
        }


        if (element == "onlyWorkshop") {
            var workshopSelect = $('select[name="workshop_id"]');
            var workshop_id = workshopSelect.val();
            var selectedWorkshopOption = workshopSelect.find(":selected");
            var workshopPrice = selectedWorkshopOption.attr('data-price');
            if (workshopPrice === undefined) workshopPrice = 0;

            updatePrice(onlyWorkshopValue, workshop_id, workshopPrice);
        }



        if (element == "virtualAccess") {
            if (onlyWorkshopValue == 1) {
                registrationPrice = 10;

                var countryCodeSelected = $('select[name="countryCode"]').val();
                if (countryCodeSelected == "+967" || countryCodeSelected == "+970") {
                    $("#normalPricePay").addClass("hide");
                    $("#specialPriceFree").removeClass("hide");
                }
                else {
                    $("#specialPriceFree").addClass("hide");
                    $("#normalPricePay").removeClass("hide");
                }
            }
            else {
                registrationPrice = 20;
                $("#specialPriceFree").addClass("hide");
                $("#normalPricePay").removeClass("hide");
            }

            var workshopSelect = $('select[name="workshop_id"]');
            var workshop_id = workshopSelect.val();
            var selectedWorkshopOption = workshopSelect.find(":selected");
            var workshopPrice = selectedWorkshopOption.attr('data-price');
            if (workshopPrice === undefined) workshopPrice = 0;
            var onlyWorkshopValue = $('input[name="onlyWorkshop"]').val();

            updatePrice(onlyWorkshopValue, workshop_id, workshopPrice);
        }
    });


    $('select[name="workshop_id"]').change(function () {
        var workshop_id = $(this).val();
        var onlyWorkshopValue = $('input[name="onlyWorkshop"]').val();

        var selectedWorkshopOption = $(this).find(":selected");
        var workshopPrice = selectedWorkshopOption.attr('data-price');

        updatePrice(onlyWorkshopValue, workshop_id, workshopPrice);
    });




    function updatePrice(onlyWorkshopValue, workshop_id, workshopPrice) {
        var finalRegistrationPrice = 0;
        if (onlyWorkshopValue == 1) finalRegistrationPrice = parseInt(workshopPrice);
        else {
            if (workshop_id == "") finalRegistrationPrice = registrationPrice;
            else finalRegistrationPrice = registrationPrice + parseInt(workshopPrice);
        }

        $(".finalRegistrationPrice").text(finalRegistrationPrice);
    }



    function getPrice(onlyWorkshopValue, workshop_id, workshopPrice) {
        var finalRegistrationPrice = 0;
        if (onlyWorkshopValue == 1) finalRegistrationPrice = parseInt(workshopPrice);
        else {
            if (workshop_id == "") finalRegistrationPrice = registrationPrice;
            else finalRegistrationPrice = registrationPrice + parseInt(workshopPrice);
        }

        return finalRegistrationPrice;
    }




    $("#registerSubmitButton").click(function (event) {
        event.preventDefault(); // Prevent default button click behavior


        //////////// get final price ////////////
        var onlyWorkshopValue = $('input[name="onlyWorkshop"]').val();
        var workshopSelect = $('select[name="workshop_id"]');
        var workshop_id = workshopSelect.val();
        var selectedWorkshopOption = workshopSelect.find(":selected");
        var workshopPrice = selectedWorkshopOption.attr('data-price');
        if (workshopPrice === undefined) workshopPrice = 0;
        var getFinalPrice = getPrice(onlyWorkshopValue, workshop_id, workshopPrice);
        //////////// get final price ////////////



        if (getFinalPrice == 0) {
            alert("Please Select a Worshop.");
        }
        else {
            // Check form validity before submitting
            if ($("#registerForm")[0].checkValidity()) {
                // Perform any additional actions or AJAX requests if needed
                // console.log("Form is valid. Submitting...");

                // Manually submit the form
                // grecaptcha.ready(function () {
                //     grecaptcha.execute('6LeMfxAsAAAAACcr9ygWDflHEYvip_iJg1DTUfGw', { action: 'submit' }).then(function (token) {
                        // Add your logic to submit to your backend server here.
                        $("#registerForm").submit();
                //     });
                // });
            } else {

                var titleInput = $('select[name="title"]');
                var firstNameInput = $('input[name="first_name"]');
                var lastNameInput = $('input[name="last_name"]');
                var specialityInput = $('input[name="speciality"]');
                var countryInput = $('select[name="country"]');
                var cityInput = $('input[name="city"]');
                var emailInput = $('input[name="email"]');
                var countryCodeInput = $('select[name="countryCode"]');
                var mobileInput = $('input[name="mobile"]');

                if (titleInput.val() == "") titleInput.addClass("missingField");
                else titleInput.removeClass("missingField");

                if (firstNameInput.val() == "") firstNameInput.addClass("missingField");
                else firstNameInput.removeClass("missingField");

                if (lastNameInput.val() == "") lastNameInput.addClass("missingField");
                else lastNameInput.removeClass("missingField");

                if (specialityInput.val() == "") specialityInput.addClass("missingField");
                else specialityInput.removeClass("missingField");

                if (countryInput.val() == "") countryInput.addClass("missingField");
                else countryInput.removeClass("missingField");

                if (cityInput.val() == "") cityInput.addClass("missingField");
                else cityInput.removeClass("missingField");

                if (emailInput.val() == "") emailInput.addClass("missingField");
                else emailInput.removeClass("missingField");

                if (countryCodeInput.val() == "" || mobileInput.val() == "") $(".twoInputsPhone").addClass("missingField");
                else $(".twoInputsPhone").removeClass("missingField");

                alert("Please check the required fields.");
                // Optionally, display an error message or highlight the invalid fields
            }
        }

    });

});