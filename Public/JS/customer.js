function refreshPage() {
  location.reload();
}


function check() {
  $.ajax({
  url: "Public/Script/checkTIN.php",
  data:'customer_TIN='+$("#customer_TIN").val(),
  type: "POST",
  success:function(data){
     $("#nif_status").html(data);
  },
  error:function (){ }
  });
  }

$(document).ready(function () {

  //
  $(document).on("click", ".submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "Public/Script/addcust.php",
      method: "GET",
      data: $("#formulaire").serialize(),
      success: function (data) {
        $("#modal-add").modal("hide");
        setInterval(refreshPage, 1000);
      },
    });
    return false;
  });

});