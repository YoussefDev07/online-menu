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
   <meta name = "title" content = "جافا - تعديل قسم"/>
   <meta name = "description" content = "تعديل قسم في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - تعديل قسم"/>
   <meta name = "twitter:description" content = "تعديل قسم في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - تعديل قسم"/>
   <meta property = "og:description" content = "تعديل قسم في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - تعديل قسم</title>
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
     <form class="inputs" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET["id"]; ?>" method="post">
      <?php $input_title = $conn -> query("SELECT title FROM categories WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN); ?>
      <input type="text" name="title" minlength="3" maxlength="40" placeholder="اسم القسم *" autocomplete="off" value="<?php echo $input_title[0]; ?>" required>
      <input type="submit" name="edit" value="تعديل القسم">
     </form>
   </div>
 </body>
</html>
<?php
 #inputs
 if (isset($_POST["edit"])) {
   $title = trim(strip_tags($_POST["title"]));

   $conn -> exec("UPDATE categories SET title = '$title' WHERE id = ".$_GET["id"]);

   sweet_alert_2("success", "تم تعديل القسم بنجاح!", "location.href");
 }
?>