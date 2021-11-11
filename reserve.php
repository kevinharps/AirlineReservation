<?php
$page = 'Reserve';
$page2 = '';
require('header.php');
require('navbar.php');
require 'db.php';


if (isset($_POST['people'])) {
  $flightSearch = showFlightsUserSearch($_POST);
}


$peeps = $_POST['people'];
?>


<header>
  <h1>Reserve Your Flight Here!</h1>
</header>
<table class="forms">
  <form method="post">
    <tbody>
      <tr>
        <td><label for="monthy">Month:</label></td>
        <td><input type="number" name="monthy" min="1" max="12"></td>
      </tr>
      <tr>
        <td><label for="days">Day:</label></td>
        <td><input type="number" name="days" min="1" max="31"></td>
      </tr>
      <tr>
        <td><label for="people">Passengers:</label></td>
        <td><input type="number" name="people" min="1" id="people"></td>
      </tr>
      <tr>
        <td><label for="depart">Departure Airport:</label></td>
        <td>
          <select name="depart">
            <option for="departInput">BUF</option>
            <option for="departInput">ORD</option>
            <option for="departInput">LGA</option>
            <option for="departInput">JFK</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="arrive">Arrival Airport:</label></td>
        <td>
          <select name="arrive">
            <option for="arriveInput">BUF</option>
            <option for="arriveInput">ORD</option>
            <option for="arriveInput">LGA</option>
            <option for="arriveInput">JFK</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><button>Find Flights</button></td>
      </tr>
      <tr>
        <td colspan="2"><input id="reset" type="reset"></td>
      </tr>
    </tbody>
  </form>
</table>
<?php if(isset($_POST['people']) && empty($flightSearch)) { ?>
          <h2 style="text-align: center;">No Flights for that Criteria</h2>
 <?php } else { ?>

    <table class="all" id="gridView">
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
          <?php foreach ($flightSearch as $flight) { ?>
          <tr>
            <td><?php echo $flight['month'] ?>/<?php echo $flight['day_of_month'] ?></td>
            <td><?php echo $flight['flight_number'] ?></td>
            <td><?php echo $flight['depart_airport_id'] ?></td>
            <td><?php echo $flight['arrival_airport_id'] ?></td>
            <td><?php echo $flight['departure_time'] ?></td>
            <td><?php echo $flight['arrival_time'] ?></td>
            <td><?php echo $flight['flight_time'] ?></td>
            <td><?php echo $flight['gate_number'] ?></td>
            <td id="flightButtons" colspan="2"><a href="pay.php?tc=<?php echo $flight['cost'] * $_POST['people'] ?>&peep=<?php echo $peeps ?>&flt=<?php echo $flight['id'] ?>"><button class="allButtons">Select this Flight</button></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  <?php } ?>
  <?php } ?>
