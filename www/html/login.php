<?php session_start();
if ($_SESSION['loggedIn'] === True) {
  header("Location: home.php");
  die();
}?>
<html>
  <head>
    <title>Log In | Alpha Phi Omega - Epsilon Zeta Chapter</title>
  </head>

  <body>
    <?php include_once("../templates/navbar.php")?>

    <form action="verify_user.php", method="post">
      <label for="user">Username</label>
      <input type="text" id="user" name="user"></input><br>
      <label for="pass">Password</label>
      <input type="text" id="pass" name="pass"></input><br>
      <input type="submit" value="Enter">
    </form>
    <?php if ($_SESSION['loginError'] === True) {
      echo "<p>Incorrect Username or Password</p>";
      $_SESSION['loginError'] = False;
    }?>
  </body>
<html>
