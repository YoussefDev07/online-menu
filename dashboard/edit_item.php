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
   <meta name = "title" content = "جافا - تعديل صنف"/>
   <meta name = "description" content = "تعديل صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - تعديل صنف"/>
   <meta name = "twitter:description" content = "تعديل صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - تعديل صنف"/>
   <meta property = "og:description" content = "تعديل صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - تعديل صنف</title>
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
     <?php $input = $conn -> query("SELECT * FROM menu WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_ASSOC); ?>
     <form class="inputs" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET["id"]; ?>" method="post" enctype="multipart/form-data">
      <input type="text" name="title" minlength="2" maxlength="60" placeholder="اسم الصنف *" autocomplete="off" value="<?php echo $input[0]["title"]; ?>" required>
      <input type="number" name="price" step="any" min="1" max="999999" placeholder="سعر الصنف *" autocomplete="off" value="<?php echo $input[0]["price"]; ?>" required>
      <input type="number" name="discount" step="any" min="1" max="999999" placeholder="سعر التخفيض" autocomplete="off" value="<?php echo ($input[0]["discount"] == 0) ? "":$input[0]["discount"]; ?>">
      <input type="file" name="thumbnail" title="صورة الصنف *" accept=".png, .jpeg, .jpg">
      <select name="category">
       <option disabled>قسم الصنف</option>
       <option value="0">بدون قسم</option>
       <?php
        $cc = $conn -> query("SELECT category FROM menu WHERE id = ".$_GET["id"]) -> fetchAll(PDO::FETCH_COLUMN);

        $categories = $conn -> query("SELECT * FROM categories");
        while ($category = $categories -> fetch()) {
          if ($category["id"] == $cc[0]) {
            echo '<option value="'.$category["id"].'" selected>'.$category["title"].'</option>';
          }
          else {
            echo '<option value="'.$category["id"].'">'.$category["title"].'</option>';
          }
        }
       ?>
      </select>
      <input type="submit" value="تعديل الصنف">
     </form>
   </div>
 </body>
</html>
<?php
 #inputs
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $title = trim(strip_tags($_POST["title"]));
   $price = $_POST["price"];
   $discount = (isset($_POST["discount"])) ? $_POST["discount"]:"";
   $thumbnail = $_FILES["thumbnail"];
   $category = $_POST["category"];

   if ($thumbnail["error"] == 4) {
     $conn -> exec("UPDATE menu SET title = '$title', price = '$price', discount = '$discount', category = '$category' WHERE id = ".$_GET["id"]);

     sweet_alert_2("success", "تم تعديل الصنف بنجاح!", "location.href");
   }
   else {
     $ex = array("png", "jpeg", "jpg");

     $thumbnail_info = pathinfo($thumbnail["name"]);
     $thumbnail_ex = $thumbnail_info["extension"];

     $thumbnail_dir = dirname(__DIR__)."/"."i/".$thumbnail["name"];
     $thumbnail_path = "http://localhost/www/khamsat/Java/i/".$thumbnail["name"];

     if (!in_array($thumbnail_ex, $ex)) {
       sweet_alert_2("warning", "مسموح فقط برفع صور PNG, JPEG, JPG", "");
     }
     elseif ($thumbnail["size"] > 2097152) {
       sweet_alert_2("warning", "حجم الصورة أكبر من 2 ميجا بايت!", "");
     }
     else {
       if (move_uploaded_file($thumbnail["tmp_name"], $thumbnail_dir)) {
         unlink("../i/".basename($input[0]["thumbnail"]));

         $conn -> exec("UPDATE menu SET title = '$title', price = '$price', discount = '$discount', thumbnail = '$thumbnail_path', category = '$category' WHERE id = ".$_GET["id"]);

         sweet_alert_2("success", "تم تعديل الصنف بنجاح!", "location.href");
       }
     }
   }
 }
?>