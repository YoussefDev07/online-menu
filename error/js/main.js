// main
var home, refresh;

home = document.getElementById("home");

refresh = document.getElementById("refresh");

if (home != null) {
  home.onclick = function() {
    return window.location.replace("http://localhost/www/khamsat/Java");
  };
}

if (refresh != null) {
  refresh.onclick = function() {
    return window.location.reload();
  };
}
