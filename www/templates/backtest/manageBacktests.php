<?php
if (session_status != PHP_SESSION_ACTIVE) {
  session_start(); //Start Session
}

//Verify the user is logged in
if ($_SESSION['loggedIn'] == False || !isset($_SESSION['loggedIn'])) {
  header("Location: login.php");
}

?>
