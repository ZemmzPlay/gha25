$(document).ready(function() {
  var e = $("#abstract-list").dataTable({
    pageLength: 20,
    colReorder: !0,
    buttons: ["copy", "excel", "pdf", "print"],
    aLengthMenu: [
      [10, 20, 50, -1],
      [10, 20, 50, "All"]
      ],
    order: [
      [0, "asc"]
      ],
    // dom: '<"top"<"pull-left"f>>rt<"bottom"p><"clear">',
    dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    searching: true,
    columnDefs: [{
      orderable: !1,
      targets: [0, 2]
    }]
  });

  $(document).on('click', '.view-abstract', function(event) {
    event.preventDefault();
    /* Act on the event */
    id = $(this).data('id');

    $.ajax({
      url: '',
      type: 'POST',
      data: {_token: $("meta[name=_token]").attr("content"), id: id},
    })
    .done(function(data) {
      $('.modal-body').html(data);
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