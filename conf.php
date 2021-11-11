<?php
  session_start();
  $page='Home';
  require 'header.php';
  require 'navbar.php';

  $confirmation = $_GET['confirm'];

  require 'db.php';

  $flightInfoConfirm = joinFlightsConfirm($confirmation);


  // if(empty($flightInfoConfirm) && $confirmation != $flightInfoConfirm['conf_code']) {
  //   header('Location: signup.php');
  // }

?>

<header>
  <h1>Here is your Flight!</h1>
</header>
<table class="all">
  <tbody>
    <th colspan="2">Your Flight Information</th>
    <tr>
      <td><b>Confirmation Number: <?php echo $flightInfoConfirm['conf_code'] ?></b></td>
      <td>Date: <?php echo $flightInfoConfirm['month'] ?>/<?php echo $flightInfoConfirm['day_of_month'] ?></td>
    </tr>
    <tr>
      <td>Departure Time: <?php echo $flightInfoConfirm['departure_time'] ?></td>
      <td>Arrival Time: <?php echo $flightInfoConfirm['arrival_time'] ?></td>
    </tr>
    <tr>
      <td>Flight Duration: <?php echo $flightInfoConfirm['flight_time'] ?></td>
      <td>Gate Number: <?php echo $flightInfoConfirm['gate_number'] ?></td>
    </tr>
    <tr>
      <td>Departing from: <?php echo $flightInfoConfirm['depart_airport_id'] ?></td>
      <td>Arriving at: <?php echo $flightInfoConfirm['arrival_airport_id'] ?></td>
    </tr>
    <tr>
      <td colspan="2"><h4 style="margin-bottom: 0;">Plane Information: </h4></td>
    </tr>
    <tr>
      <td>Model Number: <?php echo $flightInfoConfirm['model_number'] ?></td>
      <td>Engine Type: <?php echo $flightInfoConfirm['engine_type'] ?></td>
    </tr>
    <tr>
      <td colspan="2"><b>You Paid: $<?php echo $flightInfoConfirm['cost'] * $flightInfoConfirm['passengers']?></b></td>
    </tr>
  </tbody>
</table>

<a id="right" href="index.php"><button class="allButtons">All Set!</button></a>
<a id="right" href="index.php?confirm=<?php echo $confirmation ?>&cancel=true&cap=<?php echo $flightInfoConfirm['passengers'] + $flightInfoConfirm['remaining_seats'] ?>&id=<?php echo $flightInfoConfirm['id'] ?>"><button id="btnDelete" class="allButtons">Cancel My Reservation</button></a>
