<?php
  require('loginCheck.php');
  $page = 'admin';
  $page2 = 'viewAirplanes';
  require 'header.php';
  require 'navbar.php';
  require 'db.php';
  $airplanes = getAllPlanesFromDB();
?>
<br>
<?php foreach ($airplanes as $airplane) { ?>
  <table class="all">
    <th colspan="2">Model Number: <?php echo $airplane['model_number'] ?></th>
    <tr>
      <td>Engine Type: <?php echo $airplane['engine_type'] ?></td>
      <td>Horsepower: <?php echo $airplane['horsepower'] ?></td>
    </tr>
    <tr>
      <td>First Class Capacity: <?php echo $airplane['first_class_seat_capacity'] ?></td>
      <td>Main Cabin Capacity: <?php echo $airplane['main_cabin_capacity'] ?></td>
    </tr>
    <tr>
      <td>
        <?php if(!isset($_SESSION['loggedIn'])) { ?>
          <a href="airplane.php?id=<?php echo $airplane['id'] ?>"><button class="allButtons">View Details</button></a>
        <?php } ?>
        <?php if(isset($_SESSION['loggedIn'])) { ?>
          <a href="planeform.php?id=<?php echo $airplane['id'] ?>"><button class="allButtons">Update Plane</button></a>
        <?php } ?>
      </td>
      <td><a href="deletePlane.php?id=<?php echo $airplane['id'] ?>"><button class="allButtons">Delete Plane</button></a></td>
    </tr>
  </table>
<?php } ?>
