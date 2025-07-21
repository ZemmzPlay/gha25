$(document).ready(function() {

    $('#title').select2({
        placeholder: "Select a Title"
    });
    $('#country').select2();
    $('#countryCode').select2();
    $('#receive_updates').select2();
    $('#onlyWorkshop').select2();
    $('#virtualAccess').select2();
    $('#paidByAdmin').select2();
    $('#sendEmail').select2();


    $('#workshop_id').select2({
        placeholder: "Select Workshop",
        allowClear: true
    });

});