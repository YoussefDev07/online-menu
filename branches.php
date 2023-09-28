<html lang="ar" dir="rtl" type="text/html">
 <?php include_once "./master/connect.php"; ?>
 <head>
  <!--meta-->
   <meta charset = "utf-8"/>
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
   <meta name = "keywords" content = "جافا، مقهى جافا، فروع جافا"/>
   <meta name = "theme-color" content = "#983621"/>
   <meta name = "color-scheme" content = "dark"/>
   <meta name = "author" content = "Youssef Ibrahim"/>
   <meta name = "owner" content = "Youssef Ibrahim Afsa"/>
   <meta name = "copyright" content = "Java Café"/>
   <meta name = "google" content = "notranslate"/>
   <meta name = "robots" content = "all"/>
   <meta name = "title" content = "جافا - الفروع"/>
   <meta name = "description" content = "جميع فروع مقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - الفروع"/>
   <meta name = "twitter:description" content = "جميع فروع مقهى جافا."/>
   <meta name = "twitter:image" content = "./assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - فروع"/>
   <meta property = "og:description" content = "جميع فروع مقهى جافا."/>
   <meta property = "og:image" content = "./assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - فروع</title>
  <?php include "./includes/html/script.html"; ?>
 </head>
 <body>
  <?php include "./includes/html/loading.html"; ?>
  <!--container-->
   <div class="_container">
    <?php include "./includes/html/header.html"; ?>
    <!--main-->
     <main>
      <!--branches-->
       <section class="branches">
        <?php
         $branches = $conn -> query("SELECT * FROM branches ORDER BY id DESC");
         while ($branch = $branches -> fetch()):
        ?>
        <div class="wow animate__fadeInUp" data-wow-duration="1s" data-wow-offset="1">
         <a href="<?php echo $branch["map"]; ?>" target="_blank">
          <img src="<?php echo $branch["thumbnail"]; ?>">
          <strong><?php echo $branch["title"]; ?></strong>
          <span><?php echo $branch["address"]; ?></span>
         </a>
        </div>
        <?php endwhile; ?>
       </section>
     </main>
    <?php include "./includes/html/footer.html"; ?>
   </div>
 </body>
</html>