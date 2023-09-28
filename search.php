<?php
  include_once "./master/connect.php";
  $query = $_GET["q"];

  $m = $conn -> query("SELECT * FROM menu WHERE title LIKE '%$query%' ORDER BY id DESC");
  while ($menu = $m -> fetch()):
?>
<div class="wow animate__fadeInUp" data-wow-duration="1s" data-wow-offset="1">
 <img src="<?php echo $menu["thumbnail"]; ?>">
 <h2><?php echo $menu["title"]; ?></h2>
 <span><?php echo $menu["price"]; ?> ريال</span>
</div>
<?php endwhile; ?>