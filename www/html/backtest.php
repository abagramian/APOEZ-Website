<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<!DOCTYPE html>
<html>
  <header>
    <title>Backtests | Alpha Phi Omega - Epsilon Zeta Chapter</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </header>

  <body>
    <?php require_once("../templates/navbar.php")?>
    <?php if (!$_SESSION['loggedIn']) {
      require_once("../templates/backtest/searchClasses.php");
    } else if ($_SESSION['loggedIn']) {
      require_once("../templates/backtest/manageBacktests.php");
    }?>
  </body>
</html>

