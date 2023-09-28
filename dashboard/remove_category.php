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
   <meta name = "title" content = "جافا - إزالة قسم"/>
   <meta name = "description" content = "إزالة قسم من منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - إزالة قسم"/>
   <meta name = "twitter:description" content = "إزالة قسم من منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - إزالة قسم"/>
   <meta property = "og:description" content = "إزالة قسم من منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - إزالة قسم</title>
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
      <?php $title = $conn -> query("SELECT title FROM categories WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN); ?>
      <span>هل أنت متأكد من إزالة قسم "<?php echo $title[0]; ?>"؟</span>
      <div>
       <input type="checkbox" name="all" form="confirm">
       <label>حذف كل الأصناف لهذا القسم</label>
      </div>
      <form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET["id"]; ?>" method="post" id="confirm">
       <input type="submit" name="remove" value="نعم">
       <a href="./categories.php?action=remove">إلغاء</a>
      </form>
     </div>
   </div>
 </body>
</html>
<?php
 #confirm
 if (isset($_POST["remove"])) {
   function remove_category_from_database() {
     $GLOBALS["conn"] -> exec("DELETE FROM categories WHERE id = ".$_GET["id"]);

     $alert = (isset($_POST["all"])) ? "تم إزالة القسم وأصنافها بنجاح!":"تم إزالة القسم بنجاح!";
     sweet_alert_2("success", $alert, "'./categories.php?action=remove'");
   }

   if (isset($_POST["all"])) {
     $thumbnails = $conn -> query("SELECT thumbnail FROM menu WHERE category = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN);

     foreach ($thumbnails as $thumbnail) {
       unlink("../i/".basename($thumbnail));
     }

     $conn -> exec("DELETE FROM menu WHERE category = ".$_GET["id"]);
     remove_category_from_database();
   }
   else {
     remove_category_from_database();
   }
 }
?>