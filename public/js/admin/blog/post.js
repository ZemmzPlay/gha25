$(document).ready(function() {
  CKEDITOR.replace('text',
  {
    customConfig : 'config.js',
  });

  $(document).on('change', '#thumbnail', function(event) {
    event.preventDefault();
      /* Act on the event */
    input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.thumbnailPreview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  });
});