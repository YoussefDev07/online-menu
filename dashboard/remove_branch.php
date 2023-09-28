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
   <meta name = "title" content = "جافا - إزالة فرع"/>
   <meta name = "description" content = "إزالة فرع من فروع جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - إزالة فرع"/>
   <meta name = "twitter:description" content = "إزالة فرع من فروع جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - إزالة فرع"/>
   <meta property = "og:description" content = "إزالة فرع من فروع جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - إزالة فرع</title>
  <?php include "./includes/html/script.html"; ?>
 </head>
 <body>
  <?php
   include "./includes/html/secret.html";
   include "../includes/html/loading.html";
  ?>
  <!--container-->
   <div class="_container">
    <!--confirm-->
     <div class="confirm">
      <?php $title = $conn -> query("SELECT title FROM branches WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN); ?>
      <span>هل أنت متأكد من إزالة فرع "<?php echo $title[0]; ?>"؟</span>
      <form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET["id"]; ?>" method="post">
       <input type="submit" name="remove" value="نعم">
       <a href="./branches.php?action=remove">إلغاء</a>
      </form>
     </div>
   </div>
 </body>
</html>
<?php
 #confirm
 if (isset($_POST["remove"])) {
   $old_thumbnail = $conn -> query("SELECT thumbnail FROM branches WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN);

   unlink("../i/".basename($old_thumbnail[0]));
   $conn -> exec("DELETE FROM branches WHERE id = ".$_GET["id"]);

   sweet_alert_2("success", "تم إزالة الفرع بنجاح!", "'./branches.php?action=remove'");
 }
?>