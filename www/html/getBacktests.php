<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "pass";
$dbname = "backtests";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die();
}

//make sure data was passed
if ((isset($_POST['subject']) && ($_POST['subject'] != "")) && (isset($_POST['course']) && ($_POST['course'] != ""))) {
  //Verify that the subject code is valid
  if ((strlen($_POST['subject']) != 4) || !ctype_alpha($_POST['subject'])) {
    die();
  }
  //Verify that the course code is valid
  if (!preg_match("/^[0-9]+$/", $_POST['course']) || (strlen($_POST['course']) != 4)) {
    echo "<p>Invalid Inputs</p>";
    die();
  }

  $subject = $_POST['subject'];
  $course = $_POST['course'];
  $find = "SELECT b.examNum, s.season, s.testYear ";
  $find .= "FROM backtest b, semester s, course c, subjectCode k ";
  $find .= "WHERE b.semesterId = s.semesterId AND b.courseId = c.courseId AND c.prefixId = k.prefixId ";
  $find .= "AND abbreviation = ? AND courseCode = ?";

  if (!($stmt = $conn->prepare($find))) {
    echo "<p>Failed Prepare</p>";
    die();
  }

  if (!$stmt->bind_param("ss", $subject, $course)) {
    die();
  }

  if (!$stmt->execute()) {
    die();
  }

  $results = $stmt->get_result();

  //Check if the results are empty
  if ($results->num_rows > 0) {
    $tests = "";
    while($row = $results->fetch_assoc()) {
      $number = htmlspecialchars($row['examNum'], ENT_QUOTES, 'utf-8'); //Escape HTML
      $season = htmlspecialchars($row['season'], ENT_QUOTES, 'utf-8');
      $year = htmlspecialchars($row['testYear'], ENT_QUOTES, 'utf-8');
      $tests .= "<p>Exam" . $number . " " . $season . $year . "</p>";
    }
    echo $tests;
  } else {
    die();
  }
} else {
  die();
}
?>
