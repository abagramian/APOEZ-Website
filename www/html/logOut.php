<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}

if ($_SESSION['loggedIn']) {
  session_regenerate_id();
  $_SESSION['loggedIn'] = False;
  header('Location: home.php');
  die();
} else {
  header('Location: login.php');
  die();
}
?>
