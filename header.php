<?php
  // Open the Session
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($page) == false) {
    $page = 'Unknown Page';
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $page ?></title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
