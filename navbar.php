<div id="navigation">
<nav>
  <ul>
    <?php if(isset($_SESSION['loggedIn'])) { ?>
      <li class="right"><a href="logout.php">Logout</a></li>
      <?php if ($page == 'Home') { ?>
        <!-- Home is highlighted -->
       <li class="active"><a href="index.php">Home</a></li>
      <?php } else {?>
        <!-- Home is not highlighted -->
        <li><a href="index.php">Home</a></li>
      <?php } ?>

       <?php if ($page == 'Reserve') { ?>
         <!-- Reserve Flights is highlighted -->
        <li class="active"><a href="reserve.php">Reserve Flights</a></li>
       <?php } else {?>
         <!-- Reserve Flights is not highlighted -->
         <li><a href="reserve.php">Reserve Flights</a></li>
       <?php } ?>

       <?php if ($page == 'admin') { ?>
         <!-- Admin is highlighted -->
        <li class="active"><a href="admin.php">Admin</a></li>
       <?php } else {?>
         <!-- Admin is not highlighted -->
         <li><a href="admin.php">Admin</a></li>
       <?php } ?>
    <?php } else { ?>
      <!-- <li class="right"><a href="signup.php">Signup</a></li> -->
      <li class="right"><a href="login.php">Login</a></li>
      <?php if ($page == 'Home') { ?>
        <!-- Home is highlighted -->
       <li class="active"><a href="index.php">Home</a></li>
      <?php } else {?>
        <!-- Home is not highlighted -->
        <li><a href="index.php">Home</a></li>
      <?php } ?>

       <?php if ($page == 'Reserve') { ?>
         <!-- Reserve Flights is Dark Red -->
        <li class="active"><a href="reserve.php">Reserve Flights</a></li>
       <?php } else {?>
         <!-- Reserve Flights is not Dark Red -->
         <li><a href="reserve.php">Reserve Flights</a></li>
       <?php } ?>
    <?php } ?>
  </ul>
</nav>

<?php if(isset($_SESSION['loggedIn'])) { ?>
  <nav>
    <ul>
      <?php if ($page2 == 'createFlight') { ?>
        <li class="active" id="rightSub"><a href="flightform.php?action=create"><?php echo $formType; ?> Flight</a></li>
      <?php } else { ?>
        <li id="rightSub"><a href="flightform.php?action=create">Create Flight</a></li>
      <?php } ?>
      <?php if ($page2 == 'viewFlight') { ?>
        <li class="active" id="rightSub"><a href="flights.php">View All Flights</a></li>
      <?php } else {?>
        <li id="rightSub"><a href="flights.php">View All Flights</a></li>
      <?php } ?>
      <?php if ($page2 == 'createPlane') {?>
        <li class="active" id="rightSub"><a href="planeform.php"><?php echo $formType ?> Plane</a></li>
      <?php } else { ?>
        <li id="rightSub"><a href="planeform.php">Create Plane</a></li>
      <?php } ?>
      <?php if ($page2 == 'viewAirplanes') { ?>
        <li class="active" id="rightSub"><a href="airplanes.php">View All Planes</a></li>
      <?php } else { ?>
        <li id="rightSub"><a href="airplanes.php">View All Planes</a></li>
      <?php } ?>
    </ul>
  </nav>
<?php } ?>
</div>
