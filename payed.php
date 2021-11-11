<?php
  session_start();
  $totCost = $_GET['tc'];
  $id = $_GET['flt'];
  $people = $_GET['peep'];
  $email = $_GET['em'];
  $confirmation = $_GET['conf'];
  $securityC = $_GET['secur'];
  $page = 'Reserve';
  require('header.php');
  require('navbar.php');

  require('db.php');
  $buyFlight = getFlightById($id);

  // Send Email to Purchaser
  $subject = "Flight confirmed for Flight " .  $buyFlight['flight_number'];
  $subject .= " On ";
  $subject .= $buyFlight['month'] . "/" . $buyFlight['day_of_month'] . "/2018";

  $message = "<h1>We have Received Your Payment!</h1>";
  $message .= "<br>";
  $message .= "<b>Confirmation Number: </b>" . $confirmation . "<br>";
  $message .= "<b>Your Flight is Departing From: </b>";
  $message .= $buyFlight['depart_airport_id'];
  $message .= "<br><b>At: </b>" . $buyFlight['departure_time'];
  $message .= "<br><br>";
  $message .= "<b>Your Flight is Arriving At: </b>" . $buyFlight['arrival_airport_id'];
  $message .= "<br><b>At: </b>" . $buyFlight['arrival_time'];
  $message .= "<br><br>";
  $message .= "<b>At Gate Number: </b>" . $buyFlight['gate_number'];
  $message .= "<br><br>";
  $message .= "<b>Total Charge to Credit Card: </b>$" .  $totCost;
  $message .= "<br>";
  $message .= "For " . $people . " passengers.";

  $header = "From:airlinereservation@airlines.com \r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html\r\n";

  $retval = mail ($email,$subject,$message,$header);


  storeConfInfo($confirmation, $buyFlight['flight_number'], $securityC, $people);

  // Adjust Remaining Seats
  $airplaneId = $buyFlight['airplane_id'];
  $remainCapacity = $buyFlight['remaining_seats'] - $people;
  updateCapacityByFltId($id, $remainCapacity);

?>

<header>
  <h1>Payment Recieved!</h1>
</header>

<section id="main">
  <h3>Confirmation Email Sent to: <?php echo $email ?></h3>
  <h4>See you on <?php echo $buyFlight['month'] . "/" . $buyFlight['day_of_month'] . "/2018" ?>!!</h4>
  <button class="book"><a href="reserve.php">Book Another Flight!</a></button>
  <button class="book"><a href="index.php">Go Home</a></button>
</section>

<table class="all">
  <tr>
    <th colspan="2">Confirmation Number: <?php echo $confirmation; ?></th>
  </tr>

  <th>Flight Number: <?php echo $buyFlight['flight_number'] ?></th>
  <th>Date: <?php echo $buyFlight['month'] ?>/<?php echo $buyFlight['day_of_month'] ?></th>
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
    <td>Passengers: <?php echo $people ?></td>
    <td>Cost Per Passenger: $<?php echo $buyFlight['cost'] ?></td>
  </tr>
  <tr>
    <td colspan="2"><b>Total Cost: </b>$<?php echo $buyFlight['cost'] * $people?></td>
  </tr>

</table>
