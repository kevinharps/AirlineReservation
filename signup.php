<?php
  if (isset($_POST['username'])) {
    // Save the user
    require('db.php');
    saveUser($_POST['username'], $_POST['password'], $_POST['first'], $_POST['last']);

    // Redirect if it is successful
    header('Location: login.php');
  }
  require('header.php');
  require('navbar.php');
?>
<table class="forms">
  <form method="post">
    <tbody>
      <tr>
        <td><label for="username">Username:</label></td>
        <td><input type="text" name="username"></td>
      </tr>
      <tr>
        <td><label for="password">Password:</label></td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td><label for="first">First:</label></td>
        <td><input type="text" name="first"></td>
      </tr>
      <tr>
        <td><label for="last">Last:</label></td>
        <td><input type="text" name="last"></td>
      </tr>
      <tr>
        <td colspan="2"><button>Sign Up</button></td>
      </tr>
    </tbody>
  </form>
</table>

<?php require('footer.php'); ?>
