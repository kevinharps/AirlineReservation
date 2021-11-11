<?php
  require('loginCheck.php');
  $page = 'admin';
  $page2 = 'viewAirplanes';
  require('header.php');
  require('navbar.php');
?>

 <a href="airplanes.php">Go Back to All Planes</a>

<?php
  // Get the plane from the query parameter on the page
  require('db.php');
  $planes = getPlaneById($_GET['id']);
 ?>

 <blockquote>
   <h3>Model Number: <?php echo $planes['model_number'] ?></h3>
   <h4>Engine Type: <?php echo $planes['engine_type'] ?></h4>
   <h4>Horsepower: <?php echo $planes['horsepower'] ?></h4>
   <h4>First Class Capactiy: <?php echo $planes['first_class_seat_capacity'] ?></h4>
   <h4>Main Cabin Capacity: <?php echo $planes['main_cabin_capacity'] ?></h4>
 </blockquote>

 <?php require('footer.php') ?>
