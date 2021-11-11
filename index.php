<?php $page = 'Home';
  $page2 = '';
  require('header.php');
  require('navbar.php');
  require('db.php');
  $confirmation = $_GET['confirm'];
  $remainCapacity = $_GET['cap'];
  $id = $_GET['id'];
  if ($_GET['cancel'] == "true") {
    deleteConfirmation($confirmation);
    updateCapacityByFltId($id, $remainCapacity);
  }

?>

<header>
  <h1>Airline Reservation System</h1>
</header>

<section id="main">
  <h2>Welcome!</h2>
  <p>
    We are here to help you find the best flight for you
    and your family! Use our quick flight selection tool to find
    a flight that works for you! If you have already booked a flight
    and would like to check your flight information or cancel your
    ticket for a refund type, in your <b>confirmation code</b> below.
  </p>
</section>

<script type="text/javascript">
  var confirmation = '';
  var forward = '';
  var link = "conf.php?confirm=";
  function search() {
    confirmation = document.getElementById('cNumber');
    forward += link;
    forward += confirmation.value;

    document.write(confirmation);
    window.location.replace(forward);
  }
</script>

<?php if ($_GET['cancel']=="true") { ?>
  <h3 style="text-align: center;">Flight Canceled Successfully!</h3>
<?php } ?>

<section id="confSearch">
  <input id="cNumber" type="text" name="confirm">
  <button onclick="search();">Go!</button>
</section>

<?php require ('footer.php') ?>
