<?php
  date_default_timezone_set("Asia/Riyadh");
  $conn = new PDO("mysql:host=localhost;dbname=khamsat_java", "root", "");

  function script($script) {
    print("<script>");
    echo $script;
    print("</script>");
  }

  function sweet_alert_2($icon, $title, $location) {
    print("<script>");
    if (empty($location)) {
      echo "Swal.fire({icon:'$icon',title:'$title',confirmButtonText:'حسناً',confirmButtonColor:'#983621'})";
    }
    else {
      echo "Swal.fire({icon:'$icon',title:'$title',confirmButtonText:'حسناً',confirmButtonColor:'#983621'}).then((result)=>{if(result.isConfirmed){location.replace($location)}})";
    }
    print("</script>");
  }
?>