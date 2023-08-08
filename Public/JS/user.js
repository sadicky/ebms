function refreshPage() {
    location.reload();
  }
  
  $(document).ready(function () {

  //
  $(document).on("click", ".submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "Public/Script/adduser.php",
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

