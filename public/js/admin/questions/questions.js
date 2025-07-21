$(document).ready(function() {
  get_url = $("#get-questions").val();
  answer_url = $("#answer-question").val();
  enable_url = $("#enable-question").val();
  session_id = $('#session-id').val();
  questions_id = [];

  // getData();

  function getData(session_id) {
    last_id = $('#last-id').val();
    $.ajax({
      url: get_url,
      type: 'POST',
      data: {_token: $('meta[name="_token"]').attr('content'), session_id: session_id, last_id: last_id},
    })
    .done(function(data) {
      // console.log(data);
      $.each(data['questions_id'], function(index, val) {
        if($.inArray(val, questions_id) === -1)
        {
          questions_id.push(val);
        }
      });
      // console.log(questions_id);
      $('#table-body-' + session_id).prepend(data['data']);
      $.each(questions_id, function(index, val) {
        // if($('.question-' + val).length > 1)
        // {

        // }
        $('.question-' + val).not(':last').remove();
      });
      $("#last-id").val(data['last_id']);
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  }

  var intervalId = window.setInterval(function(){
    // getData();
  }, 5000);

  $(document).on('click', '.answer-question', function(event) {
    // event.preventDefault();
    /* Act on the event */
    id = $(this).attr('id');
    $.ajax({
      url: answer_url,
      type: 'POST',
      data: {_token: $('meta[name="_token"]').attr('content'), id: id},
    })
    .done(function() {
      if($('#' + id).is(":checked")) {
        $('#question-' + id).addClass('bg-danger');
      }
      else
      {
        $('#question-' + id).removeClass('bg-danger');
      }
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });

  $(document).on('click', '.view-question', function(event) {
    // event.preventDefault();
    $('.questions').removeClass('in');
    $('.questions').hide();
    session_id = $(this).data('id');
    //   // console.log(id);
    $('#last-id').val(0);
    $('.table-questions').html('');
    $('.view-question').html('View');
    if(!$(this).hasClass('opened'))
    {
      $(this).html('Hide');
      $("#questions-" + session_id).slideToggle(250);
      // $("#question-" + id).toggleClass("in");
      // $("#question-" + id).addClass("in");
      $('.view-question').removeClass('opened');
      $(this).addClass('opened');
      getData(session_id);
      clearInterval(intervalId);

      intervalId = window.setInterval(function(){
        getData(session_id);
      }, 5000);
    }
    else
    {
      $(this).removeClass('opened');
      clearInterval(intervalId);
      }
  });

  $(document).on('click', '#questionsEnable', function(event) {
    // event.preventDefault();
    /* Act on the event */
    var enabled = false;
    if($(this).is(":checked"))
    {
      enabled = true;
    }

    $.ajax({
      url: enable_url,
      type: 'POST',
      data: {_token: $('meta[name="_token"]').attr('content'), enabled: enabled},
    })
    .done(function() {
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