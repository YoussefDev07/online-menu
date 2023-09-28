new WOW().init();
const time = new Date();

// loading

$(document).ready(function(){
  $("#loading").fadeOut(800);
});

$(window).ready(function(){

  // langsbar

  $("#langs").click(function(){
    $(".langsbar").slideToggle();
  });

  // navbar

  $("#bar").click(function(){
    $(".navbar").slideToggle();
  });

  // search-box

  $("#search").keyup(function(){
    $.get("search.php", {q: $("#search").val()}, function(data){
      $(".menu").html(data);
    })
  });

  // categories

  if (!window.location.href.includes("dashboard")) {
    var owl = $(".owl-carousel");

    owl.owlCarousel({
      rtl: true,
      dots: false,
      margin: 10,
      autoWidth: true
    });

    owl.on("mousewheel", ".owl-stage", function (event) {
      if (event.deltaY > 0) {
        owl.trigger("next.owl");
      } else {
        owl.trigger("prev.owl");
      }
      event.preventDefault();
   });
  }

  // back

  $("#back").click(function(){
    window.location.href = "./index.php";
  });

  // copyright

  $(".copyright span").text(time.getFullYear());

});