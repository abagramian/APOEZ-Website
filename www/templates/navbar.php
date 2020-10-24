<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}?>
<link rel="stylesheet" href="css/navbar.css">
<div class="topnav">
  <?php if (basename($_SERVER['PHP_SELF']) != "home.php") {?>
      <div class="dropdown">
        <a href="home.php">
          <button class="drpbtn">Home</button>
        </a>
      </div>
  <?php }?>
  <div class="dropdown">
    <button class="drpbtn">About Us</button>
    <div class="drp-content">
      <a href="#">History</a>
      <a href="#">Distinguished Service Keys</a>
      <a href="#">Alumni Association</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="drpbtn">Services</button>
    <div class="drp-content">
      <a href="laf.php">Lost and Found</a>
      <a href="backtest.php">Back Tests</a>
      <a href="#">3D Printing</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="drpbtn">Word</button>
    <div class="drp-content">
      <a href="#">Link</a>
      <a href="#">Link</a>
      <a href="#">Link</a>
    </div>
  </div>

  <?php if ($_SESSION['loggedIn'] == True) {?>
    <div class="dropdown">
      <a href="logOut.php">
        <button class="drpbtn">Log Out</button>
      </a>
    </div>
  <?php } else {?>
    <div class="dropdown">
      <a href="login.php">
        <button class="drpbtn">Log In</button>
      </a>
    </div>
  <?php }?>
</div>
