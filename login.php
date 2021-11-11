<?php
  session_start();
  if (isset($_POST['username'])) {
    require('db.php');
    $user = checkUserLogin($_POST['username'], $_POST['password']);

    if ($user) {
      $_SESSION['loggedIn'] = true;
      $_SESSION['userId'] = $user['id'];
      header('Location: admin.php');
    } else {
      echo "Invalid Credentials!";
    }
  }
  require('header.php');
  require('navbar.php');
?>
<table class="forms">
  <form action="login.php" method="post">
    <tr>
      <td><label for="username">Username: </label></td>
      <td><input type="text" name="username"></td>
    </tr>
    <tr>
      <td><label for="password">Password: </label></td>
      <td><input type="password" name="password"></td>
    </tr>
    <tr>
      <td colspan="2"><button>Login</button></td>
    </tr>
  </form>
</table>

<?php require('footer.php'); ?>
