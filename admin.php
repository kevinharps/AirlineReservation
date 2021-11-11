<?php
  require('loginCheck.php');
  $page = 'admin';
  $page2 = '';
  require('header.php');
  require('navbar.php');
  require('db.php');

  $userId = $_SESSION['userId'];
  $user = getUserById($userId);
?>

<header>
  <h1>Welcome <?php echo $user['first_name']?> <?php echo $user['last_name'] ?>!</h1>
</header>

<section id="main">
  <p>
    Do your thing!
  </p>
</section>
<?php require('footer.php') ?>
