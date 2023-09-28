<html lang="ar" dir="rtl" type="text/html">
 <?php include_once "./master/connect.php"; ?>
 <head>
  <!--meta-->
   <meta charset = "utf-8"/>
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
   <meta name = "keywords" content = "جافا، مقهى جافا، منيو جافا، جافا منيو"/>
   <meta name = "theme-color" content = "#983621"/>
   <meta name = "color-scheme" content = "dark"/>
   <meta name = "author" content = "Youssef Ibrahim"/>
   <meta name = "owner" content = "Youssef Ibrahim Afsa"/>
   <meta name = "copyright" content = "Java Café"/>
   <meta name = "google" content = "notranslate"/>
   <meta name = "robots" content = "all"/>
   <meta name = "title" content = "جافا - منيو"/>
   <meta name = "description" content = "استمتع بأروع وألذ القهوات الساخنة بجميع الأنواع والأصناف الرائعة التي أنالت إعجاب الكثير من عملائنا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - منيو"/>
   <meta name = "twitter:description" content = "استمتع بأروع وألذ القهوات الساخنة بجميع الأنواع والأصناف الرائعة التي أنالت إعجاب الكثير من عملائنا."/>
   <meta name = "twitter:image" content = "./assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - منيو"/>
   <meta property = "og:description" content = "استمتع بأروع وألذ القهوات الساخنة بجميع الأنواع والأصناف الرائعة التي أنالت إعجاب الكثير من عملائنا."/>
   <meta property = "og:image" content = "./assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - منيو</title>
  <?php include "./includes/html/script.html"; ?>
 </head>
 <body>
  <?php include "./includes/html/loading.html"; ?>
  <!--container-->
   <div class="_container">
    <?php include "./includes/html/header.html"; ?>
    <!--main-->
     <main>
      <?php include "./includes/html/search-box.html"; ?>
      <!--categories-->
       <section class="categories owl-carousel wow animate__bounceInRight" data-wow-duration="2s">
        <?php
         $c = (isset($_GET["category"])) ? $_GET["category"]:"";
         
         $section = $conn -> query("SELECT id FROM categories") -> fetchAll(PDO::FETCH_COLUMN);
         if (isset($section[0])) {
           if (empty($c)) {
             echo '<a href="./index.php"><button type="button" class="selected">الكل</button></a>';
           }
           else {
             echo '<a href="./index.php"><button type="button">الكل</button></a>';
           }
         }

         $categories = $conn -> query("SELECT * FROM categories");
         while ($category = $categories -> fetch()) {
           if ($c == $category["id"]) {
             echo '<div><a href="?category='.$category["id"].'"><button type="button" class="selected">'.$category["title"].'</button></a></div>';
           }
           else {
             echo '<div><a href="?category='.$category["id"].'"><button type="button">'.$category["title"].'</button></a></div>';
           }
         }
        ?>
       </section>
      <!--menu-->
       <section class="menu">
        <?php
         $category = (isset($_GET["category"])) ? "WHERE category = ".$_GET["category"]:"";

         $m = $conn -> query("SELECT * FROM menu $category ORDER BY id DESC");
         while ($menu = $m -> fetch()):
        ?>
        <div class="wow animate__fadeInUp" data-wow-duration="1s" data-wow-offset="1">
         <img src="<?php echo $menu["thumbnail"]; ?>">
         <h2><?php echo $menu["title"]; ?></h2>
         <?php
          if ($menu["discount"] != 0.00) {
            echo "<span><del>".$menu["price"]." ريال</del> ".$menu["discount"]." ريال</span>";
          }
          else {
            echo "<span>".$menu["price"]." ريال</span>";
          }
         ?>
        </div>
        <?php endwhile; ?>
       </section>
     </main>
    <?php include "./includes/html/footer.html"; ?>
   </div>
 </body>
</html>