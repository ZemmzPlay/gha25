$(document).ready(function() {
  var e = $("#category-list").dataTable({
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
      targets: [3]
    }]
  });


  $('body').on('click', '.delete', function() {
    currentRow = $(this).closest('tr');
    aPos = e.fnGetPosition(currentRow.get(0));
    bootbox.dialog({
      message: "<span style='font-size: larger;'>Are you sure you want to delete this category?</span>",
      title: "Deleting a category",
      buttons: {
        success: {
          label: "YES",
          className: "btn-success",
          callback: function() {
            id  = currentRow.attr('data-id');
            $.ajaxSetup({
              headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
              }
            });
            $.ajax({
              type: "POST",
              url: "/admin/ajax/delete",
              cache: false,
              data: {
                id: id,
                model: "CommitteeCategory"
              },
              success: function(response) {
                bootbox.alert("Committee category has been deleted!");
              }
            });
            e.fnDeleteRow(aPos);
          }
        },
        danger: {
          label: "CANCEL!",
          className: "btn-default",
          callback: function() {
          }
        }
      }
    });
  });
});