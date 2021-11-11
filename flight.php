<?php
  session_start();
  // NOT USED ANYMORE
  $page = 'Reserve';
  $page2 = 'viewFlight';
  require('header.php');
  require('navbar.php');
  header('Location: index.php')
  // $_SESSION['passengers'] = $passengers;
?>
<button class="allButtons"><a href="flights.php" style="text-decoration: none; color: white;">Go Back to All Flights</a></button>


<?php
  // Get the flight from the query parameter on the page
  require('db.php');
  $flights = getFlightById($_GET['id']);

 ?>
<table class="all">
  <tbody>
    <th>Flight Number: <?php echo $flights['flight_number'] ?></th>
    <th>Date: <?php echo $flights['month'] ?>/<?php echo $flights['day_of_month'] ?></th>
    <tr>
      <td>Departure Time: <?php echo $flights['departure_time'] ?></td>
      <td>Arrival Time: <?php echo $flights['arrival_time'] ?></td>
    </tr>
    <tr>
      <td>Flight Duration: <?php echo $flights['flight_time'] ?></td>
      <td>Gate Number: <?php echo $flights['gate_number'] ?></td>
    </tr>
    <tr>
      <td>Departing from: <?php echo $flights['depart_airport_id'] ?></td>
      <td>Arriving at: <?php echo $flights['arrival_airport_id'] ?></td>
    </tr>
    <tr>
      <td>

      </td>
      <td>Cost: $<?php echo $flights['cost'] ?></td>
    </tr>
  </tbody>
</table>

<table>

</table>



<script>
  function warnUser() {
    if (alert('Are you sure you want to cancel? This action cannot be undone.')) {

      window.location.replace("index.php");
    }
  }
</script>

<button onclick="<?php deleteConfirmation($confirmation); ?>" class="allButtons">Cancel My Reservation</button>






<form method="post">


  <a href="pay.php?flt=<?php echo $flights['id'] ?>&peep=<?php echo $_POST['pass'] ?>">Select this Flight</a>
</form>

 <?php require('footer.php') ?>
