<?php
  $page = 'admin';
  $page2 = 'viewFlight';
  require('header.php');
  require('navbar.php');
  require('db.php');
  $flights = getAllFlightsFromDB();
?>
<br />
<!-- <?php foreach ($flights as $flight) { ?>

  <table class="all">
    <tbody>
      <th>Flight Number: <?php echo $flight['flight_number'] ?></th>
      <th>Date: <?php echo $flight['month'] ?>/<?php echo $flight['day_of_month'] ?></th>
      <tr>
        <td>Departure Time: <?php echo $flight['departure_time'] ?></td>
        <td>Arrival Time: <?php echo $flight['arrival_time'] ?></td>
      </tr>
      <tr>
        <td>Flight Duration: <?php echo $flight['flight_time'] ?></td>
        <td>Gate Number: <?php echo $flight['gate_number'] ?></td>
      </tr>
      <tr>
        <td>Departing from: <?php echo $flight['depart_airport_id'] ?></td>
        <td>Arriving at: <?php echo $flight['arrival_airport_id'] ?></td>
      </tr>
      <tr>
        <td>
          <?php if(!isset($_SESSION['loggedIn'])) { ?>
            <a href="flight.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">View Details</button></a>
          <?php } ?>
          <?php if(isset($_SESSION['loggedIn'])) { ?>
            <a href="flightform.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">Update Flight</button></a>
          <?php } ?>
        </td>
        <td><a href="deleteFlight.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">Delete Flight</button></a></td>
      </tr>
    </tbody>
  </table>

<?php } ?> -->



  <table class="all" margin= 0px; padding= 0px; id="gridView">
    <tbody>
        <tr>
          <th>Date</th>
          <th>Flight Number</th>
          <th>From</th>
          <th>To</th>
          <th>Depart Time</th>
          <th>Arrive Time</th>
          <th>Duration</th>
          <th>Gate</th>
        </tr>
        <?php foreach ($flights as $flight) { ?>
        <tr>
          <td><?php echo $flight['month'] ?>/<?php echo $flight['day_of_month'] ?></td>
          <td><?php echo $flight['flight_number'] ?></td>
          <td><?php echo $flight['depart_airport_id'] ?></td>
          <td><?php echo $flight['arrival_airport_id'] ?></td>
          <td><?php echo $flight['departure_time'] ?></td>
          <td><?php echo $flight['arrival_time'] ?></td>
          <td><?php echo $flight['flight_time'] ?></td>
          <td><?php echo $flight['gate_number'] ?></td>
          <td id="flightButtons">
            <?php if(!isset($_SESSION['loggedIn'])) { ?>
              <a href="flight.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">View Details</button></a>
            <?php } ?>
            <?php if(isset($_SESSION['loggedIn'])) { ?>
              <a href="flightform.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">Update Flight</button></a>
            <?php } ?>
          </td>
          <td id="flightButtons"><a href="deleteFlight.php?id=<?php echo $flight['id'] ?>"><button class="allButtons">Delete Flight</button></a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
