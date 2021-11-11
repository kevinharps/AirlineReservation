<?php
  require('loginCheck.php');
  $page2 = 'createFlight';
  // Defaults
  $formType = 'Create';
  $flightNumber = '';
  $month ='';
  $dayMonth = '';
  $dayWeek = '';
  $departureTime = '';
  $arrivalTime = '';
  $airplaneId = '';
  $flightTime = '';
  $gateNumber = '';
  $departAirportId = '';
  $arriveAirportId = '';
  $cost ='';
  $page = 'createFlight';

  // Toggle Update Mode
  if (isset($_GET['id'])) {
    $formType = 'Update';
  }
  if (isset($_POST['flight_number'])) {
    // This is a POST request, and therefore create the dog
      require('db.php');
      if ($formType == 'Create') {
        createFlightFromPost($_POST);
      } else {
        updateFlightById(
              $_GET['id'],
              $_POST['flight_number'],
              $_POST['month'],
              $_POST['day_of_month'],
              $_POST['day_of_week'],
              $_POST['departure_time'],
              $_POST['arrival_time'],
              $_POST['airplane_id'],
              $_POST['flight_time'],
              $_POST['gate_number'],
              $_POST['depart_airport_id'],
              $_POST['arrival_airport_id'],
              $_POST['cost']
        );
      }
      header('Location: flights.php');
    }
    //  If an update, get the dog information
    if ($formType == 'Update') {
      require('db.php');
      $flight = getFlightById($_GET['id']);
      $flightNumber = $flight['flight_number'];
      $departureTime = $flight['departure_time'];
      $arrivalTime = $flight['arrival_time'];
      $month = $flight['month'];
      $dayMonth = $flight['day_of_month'];
      $dayWeek = $flight['day_of_week'];
      $airplaneId = $flight['airplane_id'];
      $flightTime = $flight['flight_time'];
      $gateNumber = $flight['gate_number'];
      $departAirportId = $flight['depart_airport_id'];
      $arriveAirportId = $flight['arrival_airport_id'];
      $cost = $flight['cost'];

    }
    $page = 'admin'; require('header.php');
    require('navbar.php');
?>
<!-- NAMES MATCH $_POST SUPERGLOBAL -->
<table class="forms">
  <form method="post">
    <tbody>
      <tr>
        <td><label for="flightNumber">Flight Number:</label></td>
        <td><input type="text" name="flight_number" value="<?php echo $flightNumber ?>"></td>
      </tr>
      <tr>
        <td><label for="departureTime">Departure Time:</label></td>
        <td><input type="text" name="departure_time" value="<?php echo $departureTime ?>"></td>
      </tr>
      <tr>
        <td><label for="arrivalTime">Arrival Time:</label></td>
        <td><input type="text" name="arrival_time" value="<?php echo $arrivalTime ?>"></td>
      </tr>
      <tr>
        <td><label for="month">Month:</label></td>
        <td><input type="number" name="month" value="<?php echo $month ?>"></td>
      </tr>
      <tr>
        <td><label for="dayMonth">Day: </label></td>
        <td><input type="number" name="day_of_month" value="<?php echo $dayMonth ?>"></td>
      </tr>
      <tr>
        <td><label for="dayWeek">Day of Week: </label></td>
        <td><input type="text" name="day_of_week" value="<?php echo $dayWeek ?>"></td>
      </tr>
      <tr>
        <td><label for="airplaneId">Airplane ID:</label></td>
        <td><input type="text" name="airplane_id" value="<?php echo $airplaneId ?>"></td>
      </tr>
      <tr>
        <td><label for="flightTime">Flight Time:</label></td>
        <td><input type="text" name="flight_time" value="<?php echo $flightTime ?>"></td>
      </tr>
      <tr>
        <td><label for="gateNumber">Gate Number:</label></td>
        <td><input type="text" name="gate_number" value="<?php echo $gateNumber ?>"></td>
      </tr>
      <tr>
        <td><label for="$departAirportId">Departure Airport ID:</label></td>
        <td><input type="text" name="depart_airport_id" value="<?php echo $departAirportId ?>"></td>
      </tr>
      <tr>
        <td><label for="arriveAirportId">Arrive Airport ID:</label></td>
        <td><input type="text" name="arrival_airport_id" value="<?php echo $arriveAirportId ?>"></td>
      </tr>
      <tr>
        <td><label for="cost">Cost:</label></td>
        <td><input type="text" name="cost" value="<?php echo $cost ?>"></td>
      </tr>
      <tr>
        <td colspan="2"><button><?php echo $formType; ?></button></td>
      </tr>
    </tbody>
  </form>
</table>

<?php require('footer.php'); ?>
