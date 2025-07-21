$(document).ready(function() {
    var e = $("#vendor-list").dataTable({
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
        dom: '<"top"<"pull-left"f>>rt<"bottom"p><"clear">',
        columnDefs: [{
            orderable: !1,
            targets: [2]
        }]
    });


    $('body').on('click', '.delete', function() {
        currentRow = $(this).closest('tr');
        aPos = e.fnGetPosition(currentRow.get(0));
        bootbox.dialog({
            message: "<span style='font-size: larger;'>Are you sure you want to delete this vendor?</span><br/>Deleting a vendor will not affect any of the courses included. If you want to delete all courses under this vendor, please delete each course individually.",
            title: "Deleting a vendor",
            buttons: {
                success: {
                    label: "YES",
                    className: "btn-success",
                    callback: function() {
                        id  = currentRow.attr('data-id');
                        logo= currentRow.find('.logo').val();
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
                                model: "Vendor"
                            },
                            success: function(response) {
                                bootbox.alert("Vendor has been deleted!");
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