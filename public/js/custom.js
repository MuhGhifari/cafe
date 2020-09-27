
  function callSuccessAlert(message){
    $("#ajax-alert-success").text(message);
    $("#ajax-alert-success").fadeTo(2000, 500).slideUp(500, function(){
      $("#ajax-alert-success").slideUp(500);
    });
  }

  function callDangerAlert(message){
    $("#ajax-alert-danger").text(message);
    $("#ajax-alert-danger").fadeTo(2000, 500).slideUp(500, function(){
      $("#ajax-alert-danger").slideUp(500);
    });
  }

  $(function(){
    $('[data-toggle="tooltip"]').tooltip({
      trigger : 'hover'
    });
  })
