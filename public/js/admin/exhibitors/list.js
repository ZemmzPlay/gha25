$(document).ready(function() {
  var exhibitorsURL = $("#exhibitors-url").val();
  var exhibitorsViewURL = $("#exhibitors-view-url").val();
  var exhibitorsPrintURL = $("#exhibitors-print-url").val();
  var datatable = $('#exhibitors-list').DataTable( {
    "dom": 'frtlip',
    "searching": true,
    "responsive": true,
    "processing": true,
    "language": {
      processing: '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
    },
    "serverSide": true,
    "ajax": {
      "type": "POST",
      "url": exhibitorsURL,
      "data": function ( d ) {
        d._token = $("meta[name=_token]").attr("content");

        return $.extend( {}, d, {
         // "filter_display": $("#filterDisplay").val(),
         // "filter_coming_soon": $("#filterComingSoon").val(),
         // "filter_city": $("#filterCities").val(),
         // "filter_center": $("#filterCenters").val(),
       });
      }
    },
    // "order": [[ 1, "asc" ]],
    'columnDefs': [
    ],
    "columns": [
    { 
      data: 'name',
      title: 'Name',
    },
    { 
      data: 'email',
      title: 'Email',
    },
    { 
      data: 'company',
      title: 'Company',
    },
    { 
      data: 'id',
      title: 'Action',
      sortable: false,
      render: function ( data, type, row, meta ) {
        return '<a href="' + exhibitorsPrintURL + '/' + data +'" target="_blank"><button class="btn btn-default">Print</button></a>\
        <a href="' + exhibitorsViewURL + '/' + data +'"><button class="btn btn-primary">View</button></a>';
      }
    }
    ]
  });
});