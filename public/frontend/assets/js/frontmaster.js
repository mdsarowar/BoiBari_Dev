// let baseUrl = window.location;
// let baseUrl = $('.baseURl').val();

function val() {
   
    d = document.getElementById("currency").value;
    $.ajax({
      method: 'GET',
      url: baseUrl + '/change-currency/' + d,
      success: function (data) {
        window.location.reload();
      }
    });
  }
  
  $('.changed_language').on('change', function () {
    var lang = $(this).val();
   
    $.ajax({
      url: baseUrl + '/changelang',
      type: 'GET',
      data: {
        lang: lang
      },
      success: function (data) {
        location.reload();
      }
    });
  });

