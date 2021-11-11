<?php
  require('loginCheck.php');
  $page2 = 'createPlane';
  // Defaults
  $formType = 'Create';
  $modelNumber = '';
  $engineType = '';
  $horsepower = '';
  $firstClassCap = '';
  $mainCap = '';
  $page = 'createFlight';

  // Toggle Update Mode
    if (isset($_GET['id'])) {
      $formType = 'Update';
    }
    if (isset($_POST['model_number'])) {
      // This is a POST request, and therefore create the dog
      require('db.php');
      if ($formType == 'Create') {
        createPlaneFromPost($_POST);
      } else {
        updatePlaneById(
              $_GET['id'],
              $_POST['model_number'],
              $_POST['engine_type'],
              $_POST['horsepower'],
              $_POST['first_class_seat_capacity'],
              $_POST['main_cabin_capacity']
        );
      }

      header('Location: airplanes.php');
    }
    //  If an update, get the plane information
    if ($formType == 'Update') {
      require('db.php');
      $plane = getPlaneById($_GET['id']);
      $modelNumber = $plane['model_number'];
      $engineType = $plane['engine_type'];
      $horsepower = $plane['horsepower'];
      $firstClassCap = $plane['first_class_seat_capacity'];
      $mainCap = $plane['main_cabin_capacity'];
    }
    $page = 'admin'; require('header.php');
    require('navbar.php');
?>
<!-- NAMES MATCH $_POST SUPERGLOBAL -->
<table class="forms">
  <form method="post">
    <tbody>
      <tr>
        <td><label for="modelNumber">Model Number:</label></td>
        <td><input type="text" name="model_number" value="<?php echo $modelNumber ?>"></td>
      </tr>
      <tr>
        <td><label for="engineType">Engine Type:</label></td>
        <td><input type="text" name="engine_type" value="<?php echo $engineType ?>"></td>
      </tr>
      <tr>
        <td><label for="horsepower">Horsepower:</label></td>
        <td><input type="text" name="horsepower" value="<?php echo $horsepower ?>"></td>
      </tr>
      <tr>
        <td><label for="firstClassCap">First Class Capacity:</label></td>
        <td><input type="text" name="first_class_seat_capacity" value="<?php echo $firstClassCap ?>"></td>
      </tr>
      <tr>
        <td><label for="mainCap">Main Cabin Capacity:</label></td>
        <td><input type="text" name="main_cabin_capacity" value="<?php echo $mainCap ?>"></td>
      </tr>
      <tr>
        <td colspan="2"><button><?php echo $formType; ?></button></td>
      </tr>
    </tbody>
  </form>
</table>

<?php require('footer.php'); ?>
