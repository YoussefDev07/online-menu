// secret

var _0xe70f=["\x6F\x77\x6E\x65\x72\x52\x6F\x6F\x74"];const password=_0xe70f[0]
let pass = localStorage.getItem("pwd");

$(window).ready(function(){
  if (pass == password) {
    $("#_secret").hide();
  } else {
    $("._container").hide();
  }
});

$("#enter").click(function(){
  if ($("#password").val() == password) {
    localStorage.setItem("pwd", password);
    window.location.reload();
  } else {
    Swal.fire({
      icon: "error",
      title: "خطأ بكلمة المرور...!",
      confirmButtonText: "حسناً",
      confirmButtonColor: "#983621"      
    });
  }
});