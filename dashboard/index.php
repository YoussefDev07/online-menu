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
   <meta name = "title" content = "جافا - لوحة التحكم"/>
   <meta name = "description" content = "لوحة التحكم الخاصة بمنيو مقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - لوحة التحكم"/>
   <meta name = "twitter:description" content = "لوحة التحكم الخاصة بمنيو مقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - لوحة التحكم"/>
   <meta property = "og:description" content = "لوحة التحكم الخاصة بمنيو مقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - لوحة التحكم</title>
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
      <!--analytics-->
       <?php
        $categories = $conn -> query("SELECT COUNT(id) FROM categories") -> fetchAll(PDO::FETCH_COLUMN);
        $items = $conn -> query("SELECT COUNT(id) FROM menu") -> fetchAll(PDO::FETCH_COLUMN);
        $branches = $conn -> query("SELECT COUNT(id) FROM branches") -> fetchAll(PDO::FETCH_COLUMN);
       ?>
       <section class="analytics">
        <div>
         <span>عدد الأصناف</span>
         <a><?php echo $items[0]; ?></a>
        </div>
        <div>
         <span>عدد الأقسام</span>
         <a><?php echo $categories[0]; ?></a>
        </div>
        <div>
         <span>عدد الفروع</span>
         <a><?php echo $branches[0]; ?></a>
        </div>
       </section>
      <!--control-buttons-->
       <section class="control-buttons">
        <a href="./add_item.php"><button type="button"><i class="fas fa-plus"></i>إضافة صنف</button></a>
        <a href="./items.php?action=edit"><button type="button"><i class="fas fa-pen"></i>تعديل صنف</button></a>
        <a href="./items.php?action=remove"><button type="button"><i class="fas fa-times"></i>إزالة صنف</button></a>
        <a href="./add_category.php"><button type="button"><i class="fas fa-plus"></i>إضافة قسم</button></a>
        <a href="./categories.php?action=edit"><button type="button"><i class="fas fa-pen"></i>تعديل قسم</button></a>
        <a href="./categories.php?action=remove"><button type="button"><i class="fas fa-times"></i>إزالة قسم</button></a>
        <a href="./add_branch.php"><button type="button"><i class="fas fa-plus"></i>إضافة فرع</button></a>
        <a href="./branches.php?action=edit"><button type="button"><i class="fas fa-pen"></i>تعديل فرع</button></a>
        <a href="./branches.php?action=remove"><button type="button"><i class="fas fa-times"></i>إزالة فرع</button></a>
       </section>
     </main>
   </div>
 </body>
</html>