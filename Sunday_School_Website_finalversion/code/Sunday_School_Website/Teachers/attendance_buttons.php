<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Select A Class - Attendance</title>
    <!--Navigation bar at the top of the screen-->
    <a href="../home.php">Home</a>
    <a href="attendance_buttons.php">Attendance</a>
    <a href="announcements_buttons.php">Announcements</a>
    <a href="report_cards_buttons.php">Report Card</a>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Select A Class</h1>
    <div class="home">
    <?php
    session_start();
    if (isset($_POST["submit"])) {
      //creating a boolean session variable to store the fact that the submit button on the last page was hit
      $_SESSION["show"] = true;
    }

    if ($_SESSION["show"] == true) {
      //importing the database connection file
      require_once "../database.php";

      //selecting the column "class" from the "teachers" table
      $sql = "SELECT class FROM teachers";
      $result = mysqli_query($conn, $sql); //grabing the result of the sql query


      //declaring every row from $result as $row, an associative array with the column names as key, and the data entries as values
      while ($row = mysqli_fetch_assoc($result)) {
        //creating a form for every $row that will have a button that will post data to the backend file (attendance_buttons-inc.php)
        echo "<form action='attendance_buttons-inc.php' method='post'>";
        //the button in the form will have the value and be labeled as the value of the "class" key in $row
        echo "<button class='subject' type='submit' name='submit' value='".$row['class']."'>".$row['class']."</button>";
        echo "<br />";
        echo "</form>";
      }

    }

    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //grabbing the URL for the website

    //if the the url has the given error, an error message is echoed out for the user to see
    if (strpos($url, "error=ClassNotAvailable")) {
      echo "<p>You do not teach this class!</p>";
    }
     ?>
</div>
  </body>
</html>
