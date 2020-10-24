<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "pass";
$dbname = "backtests";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die();
}

//Make sure the subject code was passed
if (isset($_POST['subject']) && ($_POST['subject'] != "")) {
  //Verify that the subject code is valid
  if ((strlen($_POST['subject']) != 4) || !ctype_alpha($_POST['subject'])) {
    die();
  }

  //Find all courses with the selected subject code
  $subject = $_POST['subject'];
  $find = "SELECT c.couseName, c.courseCode FROM course c, subjectCode s WHERE c.prefixId = s.prefixId and s.abbreviation = ?";

  if (!($stmt = $conn->prepare($find))) {
    die();
  }

  if (!$stmt->bind_param("s", $subject)) {
    die();
  }

  if (!$stmt->execute()) {
    die();
  }

  $results = $stmt->get_result();

  //If the subject code has courses entered, generate an options menu
  if ($results->num_rows > 0) {
    $options = '<select name="courseCode" id="courseCode">';
    while($row = $results->fetch_assoc()) {
      $code = htmlspecialchars($row['courseCode'], ENT_QUOTES, 'utf-8'); //Escape HTML
      $name = htmlspecialchars($row['couseName'], ENT_QUOTES, 'utf-8');
      $options .= '<option value="' . $code . '">' . $code . ' - ' . $name . '</option>';
    }
    $options .= '</select><input id="findBacktest" value="Search" type="button" class="searchTest"></input>'; //echo the resulting html
    echo $options;
  } else { //Otherwise, echo an error
    die();
  }
} else {
  die();
}
?>
