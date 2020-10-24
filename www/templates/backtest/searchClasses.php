<form>
<label for="subjectCode">Subject Code</label>
<select name="subjectCode" id="subjectCode">
<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start(); // Start Session
}

//Attempt to connect to the database
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "pass";
$dbname = "backtests";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  header("Location: errorPage.php");
  die();
}

$find = "SELECT abbreviation FROM subjectCode";

if (!($stmt = $conn->prepare($find))) {
  header("Location: errorPage.php");
  die();
}

if (!$stmt->execute()) {
  header("Location: errorPage.php");
  die();
}

$results = $stmt->get_result();

if ($results->num_rows == 0) {
  header("Location: errorPage.php");
  die();
} else {
  while ($row = $results->fetch_assoc()) {
    echo '<option value="' .  $row['abbreviation'] . '">' . $row['abbreviation'] . "</option>";
  }
}
?>
</select>
<label for="courseId">Course Code</label>
<div id="place"></div>
</form>
<div id="here"></div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#subjectCode").change(function() {
      var subjectCode = $(this).val();
      $.ajax({
        type: "POST",
        url: "getCourseCodes.php",
        data: {subject: subjectCode}
      }).done(function(data) {
        $("#place").html(data);
      });
    });
  });

  $(document).on('click', '#findBacktest', function() {
    var subjectCode = $("#subjectCode").val();
    var courseCode = $("#courseCode").val();
    $.ajax({
      type: "POST",
      url: "getBacktests.php",
      data: {course: courseCode, subject: subjectCode}
    }).done(function(data) {
      $("#here").html(data);
    });
  });
</script>
