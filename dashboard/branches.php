<?php
 $action = $_GET["action"];
 if (isset($action)) {
   if ($action != "edit" && $action != "remove") {
     header("location:index.php");
   }
 }
?>
<html lang="ar" dir="rtl" type="text/html">
 <?php
  include_once "../master/connect.php";

  $title = ($action == "edit") ? "قائمة الفروع للتعديل":"قائمة الفروع للإزالة";
  $description = ($action == "edit") ? "قائمة الفروع لإختيارها للتعديل عليها.":"قائمة الفروع لإختيارها لإزالتها.";
 ?>
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
   <meta name = "title" content = "جافا - <?php echo $title; ?>"/>
   <meta name = "description" content = "<?php echo $description; ?>"/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>   
   <meta name = "twitter:title" content = "جافا - <?php echo $title; ?>"/>
   <meta name = "twitter:description" content = "<?php echo $description; ?>"/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - <?php echo $title; ?>"/>
   <meta property = "og:description" content = "<?php echo $description; ?>"/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - <?php echo $title; ?></title>
  <?php include "./includes/html/script.html"; ?>
 </head>
 <body>
  <?php
   include "./includes/html/secret.html";
   include "../includes/html/loading.html";
  ?>
  <!--container-->
   <div class="_container">
    <!--main-->
     <main>
      <!--back-->
       <div class="back wow animate__slideInDown" data-wow-duration="2s">
        <button id="back" type="button"><i class="fas fa-undo-alt fa-flip-horizontal"></i>العودة إلى لوحة التحكم</button>
       </div>
      <!--msg-->
       <?php $msg = ($action == "edit") ? "الرجاء اختيار الفرع لتعديله":"الرجاء اختيار الفرع لإزالته"; ?>
       <p class="msg wow animate__slideInDown" data-wow-duration="2s"><?php echo $msg; ?></p>
      <!--branches-->
       <section class="branches">
        <?php
         $branches = $conn -> query("SELECT * FROM branches ORDER BY id DESC");
         while ($branch = $branches -> fetch()):
         $url = ($action == "edit") ? "./edit_branch.php?id=".$branch["id"]:"./remove_branch.php?id=".$branch["id"];
        ?>
        <div class="wow animate__fadeInUp" data-wow-duration="1s" data-wow-offset="1">
         <a href="<?php echo $url; ?>">
          <img src="<?php echo $branch["thumbnail"]; ?>">
          <strong><?php echo $branch["title"]; ?></strong>
          <span><?php echo $branch["address"]; ?></span>
         </a>
        </div>
        <?php endwhile; ?>
       </section>
     </main>
   </div>
 </body>
</html>