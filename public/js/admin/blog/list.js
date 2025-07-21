$(document).ready(function() {
  var blogPostURL = $("#blog-posts-url").val();
  var blogPostViewURL = $("#blog-post-view-url").val();
  var datatable = $('#blog-posts-list').DataTable( {
    "dom": 'rtlp',
    "searching": true,
    "responsive": true,
    "processing": true,
    "language": {
      processing: '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
    },
    "serverSide": true,
    "ajax": {
      "type": "POST",
      "url": blogPostURL,
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
      data: 'title',
      title: 'Title',
    },
    { 
      data: 'author',
      title: 'Author',
    },
    { 
      data: 'text',
      title: 'Text',
    },
    { 
      data: 'id',
      title: 'Action',
      sortable: false,
      render: function ( data, type, row, meta ) {
        return '<a href="' + blogPostViewURL + '/' + data +'"><button class="btn btn-primary">View</button></a>\
        <button class="btn btn-danger deletePost" data-id="' + data + '">Delete</button>';
      }
    }
    ]
  });

  /*$(document).on('click', '.deletePost', function(event) {
    event.preventDefault();
    var blogPostDeleteURL = $("#blog-post-delete-url").val();
    $.ajax({
      url: blogPostDeleteURL,
      type: 'POST',
      data: {_token: $("meta[name=_token]").attr("content"), id: $(this).data('id')},
    })
    .done(function(data) {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });*/

  $(document).on('click', '.deletePost', function() {
    var id = $(this).data("id");
    var blogPostDeleteURL = $("#blog-post-delete-url").val();
    bootbox.dialog({
      message: "<span style='font-size: larger;'>Are you sure you want to delete this post?</span>",
      title: "Deleting a Post",
      buttons: {
        success: {
          label: "YES",
          className: "btn-success",
          callback: function() {
            $.ajax({
              type: "delete",
              url: blogPostDeleteURL,
              cache: false,
              data: {
                _token: $("meta[name=_token]").attr("content"),
                id: id
              },
              success: function(response) {
                bootbox.alert("Post has been deleted!");
                datatable.ajax.reload();
              }
            });
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