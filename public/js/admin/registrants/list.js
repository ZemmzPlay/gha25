$(document).ready(function() {
    var e = $("#registration-list").dataTable({
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

        columnDefs: [{
            orderable: !1,
            targets: [0]
        }]
    });
    
});