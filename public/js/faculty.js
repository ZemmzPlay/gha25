$(document).ready(function() {
  // $('.modal-member-popup').magnificPopup({
  //   type: 'inline',
  //       // fixedContentPos: false,
  //   fixedBgPos: true,
  //   overflowY: 'auto',
  //   closeBtnInside: true,
  //   preloader: false,
  //   midClick: true,
  //   removalDelay: 300,
  //   blackbg: true,
  //   mainClass: 'my-mfp-slide-bottom'
  // });

  $(document).on('click', '.popup-modal-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
  });

  // $(document).on('click', '.modal-member-popup', function(event) {
  //   event.preventDefault();
  //   /* Act on the event */
  //   $('.member-bio-image').attr("src", "");
  //   $('.bio').html("");
  //   $('.member-bio-name').html("");
  //   $('.bio-info').hide();
  //   $('.bio-wait').show();
  //   $.ajax({
  //     url: '',
  //     type: 'POST',
  //     data: {_token: $("meta[name=_token]").attr("content"), id: $(this).data('id')},
  //   })
  //   .done(function(data) {
  //     $('.member-bio-image').attr("src",data["image"]);
  //     $('.bio').html(data["bio"]);
  //     $('.member-bio-name').html(data["name"]);
  //     $('.bio-info').show();
  //     $('.bio-wait').hide();
  //     console.log("success");
  //   })
  //   .fail(function() {
  //     console.log("error");
  //   })
  //   .always(function() {
  //     console.log("complete");
  //   });
    
  // });

  $(document).on('change', '#sort-by', function(event) {
    event.preventDefault();
    /* Act on the event */
    $(".sorting").removeClass('hidden');
    sort = $(this).val();
    url = $("#faculty-member-url").val();
    $.ajax({
      url: url,
      type: 'POST',
      data: {_token: $("meta[name=_token]").attr("content"), sort: sort},
    })
    .done(function(data) {
      $("#faculty-members").html(data);
      $(".sorting").addClass('hidden');
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });
});