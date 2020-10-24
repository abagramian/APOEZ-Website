<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home | Alpha Phi Omega - Epsilon Zeta Chapter</title>
    <link rel="stylesheet" href="css/home.css">
  </head>

  <body>
    <div class="header">
      <h1>Alpha Phi Omega</h1>
      <p> Epsilon Zeta Chapter</p>
    </div>

    <?php require_once("../templates/navbar.php")?>

    <div>
      <p>Follow Up Text</p>
    </div>
  </body>
</html>
