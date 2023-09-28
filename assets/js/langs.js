$(window).ready(function(){
  
  // langs

  $("#ar").click(function(){
    localStorage.setItem("lang", "ar");
    window.location.href = "./index.php";
  });

  $("#en").click(function(){
    localStorage.setItem("lang", "en");
    window.location.href = "./en/";
  });

  // l

  const lang = localStorage.getItem("lang");
  const l = sessionStorage.getItem("l");

  if (lang == "ar" && !l) {
    sessionStorage.setItem("l", ".");
    window.location.href = "./index.php";
  }
  else if (lang == "en" && !l) {
    sessionStorage.setItem("l", ".");
    window.location.href = "./en/";
  }
  else {
    if (navigator.language == "ar" && !l) {
      sessionStorage.setItem("l", ".");
      window.location.href = "./index.php";
    } else {
      if (!l) {
        sessionStorage.setItem("l", ".");
        window.location.href = "./en/";
      }
    }
  }

});