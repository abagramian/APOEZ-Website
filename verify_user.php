<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start(); //Start Session
}

//Attemp to connect to MYSQL
$dbhost = "localhost:3306";
$dbuser = "user";
$dbpass = "pass";
$dbname = "login";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  header("Location: errorPage.php");
  die();
}

//Ensure that the form user input a username and password
if ((isset($_POST['user']) && ($_POST['user'] != "")) && ((isset($_POST['pass'])) && ($_POST['pass'] != "")) {
  //Validate User inputs
  if (!ctype_alnum($_POST['user'])) {
    $_SESSION['loginError'] = True;
    header("Location: login.php");
    die();
  }
  
  if (!preg_match("/^[!@#$%^&*()?A-Za-z0-9]+$/", $_POST['pass'])) {
    $_SESSION['loginError'] = True;
    header("Location: login.php");
    die();
  }
  
  $passCheck = $_POST['pass'];
  $userCheck = $_POST['user'];
  
  //Check if the username is stored, and get the assosiated password hash
  $check = "SELECT password FROM users WHERE username=?";
  if (!(stmt = $conn->prepare($check))) {
    header("Location: errorPage.php");
    die();
  }
  
  if (!$stmt->bind_param("s", $userCheck)) {
    header("Location: errorPage.php");
    die();
  }
  
  if (!$stmt->execute()) {
    header("Location: errorPage.php");
    die();
  }
  
  $results = $stmt->get_results();
  
  //Check if the results are empty
  if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $verify = password_verify($passCheck, $row['password']);
    if ($verify) {
      session_regenerate_id();
      $_SESSION['loggedIn'] = True;
    } else {
      $_SESSION['loginError'] = True;
      header("Location: login.php");
      die();
    }
  } else {
    $_SESSION['loginError'] = True;
    header("Location: login.php");
    die();
  }
} else {
  $_SESSION['loginError'] = True;
  header("Location: errorPage.php");
  die();
}?>
