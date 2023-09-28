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
   <meta name = "title" content = "جافا - إضافة صنف"/>
   <meta name = "description" content = "إضافة صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:card" content = "summary"/>
   <meta name = "twitter:url" content = "http://localhost/www/khamsat/Java"/>
   <meta name = "twitter:title" content = "جافا - إضافة صنف"/>
   <meta name = "twitter:description" content = "إضافة صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta name = "twitter:image" content = "../assets/images/logo.ico"/>
   <meta name = "twitter:image:alt" content = "شعار مقهى جافا"/>
   <meta name = "twitter:creator" content = "@YoussefDev7"/>
   <meta name = "twitter:creator:id" content = "1427454968232022016"/>
   <meta property = "og:type" content = "website"/>
   <meta property = "og:url" content = "/"/>
   <meta property = "og:title" content = "جافا - إضافة صنف"/>
   <meta property = "og:description" content = "إضافة صنف في منيو الإلكتروني الخاص بمقهى جافا."/>
   <meta property = "og:image" content = "../assets/images/logo.ico"/>
   <meta property = "og:image:alt" content = "شعار مقهى جافا"/>
   <meta property = "fb:admins" content = "100093603992488"/>
  <?php include "./includes/html/link.html"; ?>
  <!--title-->
   <title>جافا - إضافة صنف</title>
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
      <input type="text" name="title" minlength="2" maxlength="60" placeholder="اسم الصنف *" autocomplete="off" required>
      <input type="number" name="price" step="any" min="1" max="999999" placeholder="سعر الصنف *" autocomplete="off" required>
      <input type="file" name="thumbnail" title="صورة الصنف *" accept=".png, .jpeg, .jpg" required>
      <select name="category">
       <option value="0">قسم الصنف</option>
       <?php
        $categories = $conn -> query("SELECT * FROM categories");
        while ($category = $categories -> fetch()) {
          echo '<option value="'.$category["id"].'">'.$category["title"].'</option>';
        }
       ?>
      </select>
      <input type="submit" value="إضافة الصنف">
     </form>
   </div>
 </body>
</html>
<?php
 #inputs
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $title = trim(strip_tags($_POST["title"]));
   $price = $_POST["price"];
   $thumbnail = $_FILES["thumbnail"];
   $category = $_POST["category"];

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
      $stmt = $conn -> prepare("INSERT INTO menu (title, price, thumbnail, category, date) VALUES (?, ?, ?, ?, ?)");
      $stmt -> execute([$title, $price, $thumbnail_path, $category, date("Y-m-d")]);

      sweet_alert_2("success", "تم إضافة الصنف بنجاح!", "");
    }
  }
 }
?>