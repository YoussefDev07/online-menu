# main

home = document.getElementById "home"
refresh = document.getElementById "refresh"

home?.onclick = ->
  window.location.replace "http://localhost/www/khamsat/Java"

refresh?.onclick = ->
  window.location.reload()