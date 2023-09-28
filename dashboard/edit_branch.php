<?php if (empty($_GET["id"])) { header("location:index.php"); } ?>
<html lang="ar" dir="rtl" type="text/html">
 <?php include_once "../master/connect.php"; ?>
 <head>
  <!--meta-->
   <meta charset = "utf-8"/>
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
   <meta name = "theme-color" content = "#983621"/>
   <meta name = "color-scheme" content = "dark"/>
   <meta name = "author" content = "Youssef Ibrahim"/>
   <meta name = "owner" content = "Youssef Ibrahim Afsa"/>
   <meta name = "copyright" content = "Java Café"/>
   <meta name = "google" content = "notranslate"/>
   <meta name = "robots" content = "none"/>
   <meta name = "title" content = "جافا - تعديل فرع"/>
   <meta name = "description" content = "تعديل فرع من فروع جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - تعديل فرع"/>
   <meta name = "twitter:description" content = "تعديل فرع من فروع جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - تعديل فرع"/>
   <meta property = "og:description" content = "تعديل فرع من فروع جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - تعديل فرع</title>
  <?php include "./includes/html/script.html"; ?>
 </head>
 <body>
  <?php
   include "./includes/html/secret.html";
   include "../includes/html/loading.html";
  ?>
  <!--container-->
   <div class="_container">
    <!--back-->
     <div class="back">
      <button id="back" type="button"><i class="fas fa-undo-alt fa-flip-horizontal"></i>العودة إلى لوحة التحكم</button>
     </div>
    <!--inputs-->
     <?php $input = $conn -> query("SELECT * FROM branches WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_ASSOC); ?>
     <form class="inputs" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET["id"]; ?>" method="post" enctype="multipart/form-data">
      <input type="text" name="title" minlength="2" maxlength="50" placeholder="اسم الفرع *" autocomplete="off" value="<?php echo $input[0]["title"] ?>" required>
      <input type="text" name="address" minlength="10" maxlength="250" placeholder="عنوان الفرع *" autocomplete="off" value="<?php echo $input[0]["address"] ?>" required>
      <input type="url" name="map" placeholder="رابط موقع الفرع على خرائط جوجل *" autocomplete="off" value="<?php echo $input[0]["map"] ?>" required>
      <input type="file" name="thumbnail" title="صورة الفرع *" accept=".png, .jpeg, .jpg">
      <input type="submit" value="تعديل الفرع">
     </form>
   </div>
 </body>
</html>
<?php
 #inputs
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $title = trim(strip_tags($_POST["title"]));
   $address = trim(strip_tags($_POST["address"]));
   $map = trim(strip_tags($_POST["map"]));
   $thumbnail = $_FILES["thumbnail"];

   if ($thumbnail["error"] == 4) {
     if (isset($unique_address[0]) || isset($unique_map[0])) {
      sweet_alert_2("warning", "هذا الفرع موجود بالفعل", "");
     }
     else {
       $conn -> exec("UPDATE branches SET title = '$title', address = '$address', map = '$map' WHERE id = ".$_GET["id"]);

       sweet_alert_2("success", "تم تعديل الفرع بنجاح!", "location.href");
     }
   }
   else {
     $ex = array("png", "jpeg", "jpg");

     $thumbnail_info = pathinfo($thumbnail["name"]);
     $thumbnail_ex = $thumbnail_info["extension"];

     $thumbnail_dir = dirname(__DIR__)."/"."i/".$thumbnail["name"];
     $thumbnail_path = "http://localhost/www/khamsat/Java/i/".$thumbnail["name"];

     if (isset($unique_address[0]) || isset($unique_map[0])) {
       sweet_alert_2("warning", "هذا الفرع موجود بالفعل", "");
     }
     elseif (!in_array($thumbnail_ex, $ex)) {
       sweet_alert_2("warning", "مسموح فقط برفع صور PNG, JPEG, JPG", "");
     }
     elseif ($thumbnail["size"] > 2097152) {
       sweet_alert_2("warning", "حجم الصورة أكبر من 2 ميجا بايت!", "");
     }
     else {
       if (move_uploaded_file($thumbnail["tmp_name"], $thumbnail_dir)) {
         unlink("../i/".basename($input[0]["thumbnail"]));

         $conn -> exec("UPDATE branches SET title = '$title', thumbnail = 'thumbnail_path', address = '$address', map = '$map' WHERE id = ".$_GET["id"]);

         sweet_alert_2("success", "تم تعديل الفرع بنجاح!", "location.href");
       }
     }
   }
 }
?>