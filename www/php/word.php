<?php session_start();
if ($_POST['word'] == "this") {
  $_SESSION['text'] = "one";
}?>
<?php $_SESSION['loggedIn'] = True?>
<meta http-equiv="refresh" content="0.1, home.php">
