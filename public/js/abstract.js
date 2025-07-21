$(document).ready(function() {
  var input = document.querySelector("#phone");
  const output = document.querySelector("#output");
  var iti = window.intlTelInput(input, {
  initialCountry: "auto",
  nationalMode: true,
  separateDialCode: true,
  showFlags: false,
  customContainer: "w-full",
  dropdownContainer: document.body,
  excludeCountries: ["il"],
  autoInsertDialCode: true,
  geoIpLookup: callback => {
    fetch("https://ipapi.co/json")
      .then(res => res.json())
      .then(data => callback(data.country_code))
      .catch(() => callback("us"));
  },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
  });

  const handleChange = () => {
    let text;
    if (input.value) {
      if(iti.isValidNumber())
      {
        text = "Valid number!";
        textClass = "text-success";
      }
      else
      {
        text = "Invalid number - please try again";
        textClass = "text-danger";
      }
    } else {
      text = "";
    }
    const textNode = document.createTextNode(text);
    output.innerHTML = "";
    output.className = "";
    output.classList.add(textClass);
    output.appendChild(textNode);
  };

  // listen to "keyup", but also "change" to update when the user selects a country
  input.addEventListener('change', handleChange);
  input.addEventListener('keyup', handleChange);

  $(document).on('countrychange', "#phone", function(event) {
    // event.preventDefault();
    /* Act on the event */
    var countryCode = iti.getSelectedCountryData();
    $("#phoneCode").val(countryCode["dialCode"]);
    // console.log(countryCode);
  });
  $(document).on('change', '#abstractFile', function(event) {
    event.preventDefault();
    /* Act on the event */
    var filename = $(this).val().split('\\').pop();
    $('.file-name').html(filename);
  });

  $("#abstractForm").validate({
    ignore: [],
    errorElement: "span"
  });
});