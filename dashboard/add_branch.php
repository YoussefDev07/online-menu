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
   <meta name = "title" content = "جافا - إضافة فرع"/>
   <meta name = "description" content = "إضافة فرع لمقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - إضافة فرع"/>
   <meta name = "twitter:description" content = "إضافة فرع لمقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - إضافة فرع"/>
   <meta property = "og:description" content = "إضافة فرع لمقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - إضافة فرع</title>
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
     <form class="inputs" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
      <input type="text" name="title" minlength="2" maxlength="50" placeholder="اسم الفرع *" autocomplete="off" required>
      <input type="text" name="address" minlength="10" maxlength="250" placeholder="عنوان الفرع *" autocomplete="off" required>
      <input type="url" name="map" placeholder="رابط موقع الفرع على خرائط جوجل *" autocomplete="off" required>
      <input type="file" name="thumbnail" title="صورة الفرع *" accept=".png, .jpeg, .jpg" required>
      <input type="submit" value="إضافة الفرع">
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

   $ex = array("png", "jpeg", "jpg");
   
   $thumbnail_info = pathinfo($thumbnail["name"]);
   $thumbnail_ex = $thumbnail_info["extension"];

   $thumbnail_dir = dirname(__DIR__)."/"."i/".$thumbnail["name"];
   $thumbnail_path = "http://localhost/www/khamsat/Java/i/".$thumbnail["name"];

   $unique_address = $conn -> query("SELECT address FROM branches WHERE address = '$address'") -> fetchAll(PDO::FETCH_COLUMN);
   $unique_ = $conn -> query("SELECT map FROM branches WHERE map = '$map'") -> fetchAll(PDO::FETCH_COLUMN);

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
       $stmt = $conn -> prepare("INSERT INTO branches (title, address, map, thumbnail) VALUES (?, ?, ?, ?)");
       $stmt -> execute([$title, $address, $map, $thumbnail_path]);

       sweet_alert_2("success", "تم إضافة الفرع بنجاح!", "");
     }
   }
 }
?>