<?php
  session_start();
  $page = 'Reserve';
  $page2 = '';
  require('header.php');
  require('navbar.php');

  // $passengers = $_SESSION['passengers'];

  $totCost = $_GET['tc'];
  $id = $_GET['flt'];
  $people = $_GET['peep'];

  require('db.php');
  $buyFlight = joinFlightById($id);

  // Generate Confimration Code
  $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $string = '';
  $max = strlen($characters) - 1;
  $random_string_length = 5;
  for ($i = 0; $i < $random_string_length; $i++) {
    $string .= $characters[mt_rand(0, $max)];
  }

  $remainCapacity = $buyFlight['remaining_seats'];
?>

<table class="all">
  <tbody>
    <th colspan="2"><h3>Your Flight:</h3></th>
    <tr>
      <td>Flight Number: <?php echo $buyFlight['flight_number'] ?></td>
      <td>Date: <?php echo $buyFlight['month'] ?>/<?php echo $buyFlight['day_of_month'] ?></td>
    </tr>
    <tr>
      <td>Departure Time: <?php echo $buyFlight['departure_time'] ?></td>
      <td>Arrival Time: <?php echo $buyFlight['arrival_time'] ?></td>
    </tr>
    <tr>
      <td>Flight Duration: <?php echo $buyFlight['flight_time'] ?></td>
      <td>Gate Number: <?php echo $buyFlight['gate_number'] ?></td>
    </tr>
    <tr>
      <td>Departing from: <?php echo $buyFlight['depart_airport_id'] ?></td>
      <td>Arriving at: <?php echo $buyFlight['arrival_airport_id'] ?></td>
    </tr>

    <tr>
      <th colspan="2"><h4 style="margin-bottom: 0;">Fun Facts about your plane!</h4></th>
    </tr>
    <tr>
      <td>Model Number: <?php echo $buyFlight['model_number'] ?></td>
      <td>Propulsion Type: <?php echo $buyFlight['engine_type'] ?></td>
    </tr>
    <tr>
      <th colspan="2"><h4 style="margin-bottom: 0;">Cost Information...</h4></th>
    </tr>
    <tr>
      <td>Passengers: <?php echo $people ?></td>
      <td>Cost Per Passenger: $<?php echo $buyFlight['cost'] ?></td>
    </tr>
    <tr>
      <td colspan="2"><b>Total Cost:</b> $<?php echo $totCost ?></td>
    </tr>
    <tr>
      <td><h4></h4></td>
    </tr>
  </tbody>
</table>

<script type="text/javascript">
  var email = '';
  var sec = '';
  var forward = '';
  var link = "payed.php?tc=<?php echo $totCost ?>&peep=<?php echo $people ?>&flt=<?php echo $id ?>&conf=<?php echo $string ?>&em=";
  function payed() {
    email = document.getElementById('emailAdd');
    sec = document.getElementById('securityCd');
    forward += link;
    forward += email.value;
    forward += '&secur=';
    forward += sec.value;
    window.location.replace(forward);
  }
</script>

<table class="credit">
  <tbody>
    <tr>
      <td><label>Credit Card Number</label></td>
      <td><input type="number" name="credit"  min="1111111111111111" max="9999999999999999" class="inputMax"></td>
    </tr>
    <tr>
      <td><label>Expiration Month</label></td>
      <td><input type="number" name="xmonth" min="1" max="12"></td>
    </tr>
    <tr>
      <td><label>Expiration Year</label></td>
      <td><input type="number" name="xyear" min="2018"></td>
    </tr>
    <tr>
      <td><label>Security Code</label></td>
      <td><input id="securityCd" type="number" name="secCode" maxlength="3" max="999"></td>
    </tr>
    <tr>
      <td><label for="email">Email</label></td>
      <td><input id="emailAdd" type="email" name="email"></td>
    </tr>
    <tr>
      <td colspan="2"><button onclick="payed();">Purchase Ticket</button></td>
    </tr>
  </tbody>
</table>

<?php if ($remainCapacity < $people) { ?>
  <div id="overbooked">
    <h3>There are not enough seats for that many passengers!</h3>
    <h4><a href="reserve.php">Please select another flight.</a></h4>
  </div>
<?php }?>

<?php require('footer.php'); ?>
