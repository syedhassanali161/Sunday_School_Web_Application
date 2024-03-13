<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Select A Class - Report Cards</title>
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

      $_SESSION["show"] = true;

    }

    if ($_SESSION["show"] == true) {

            require_once "../database.php";

            $sql = "SELECT class FROM teachers"; //the sql query being executed
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_assoc($result)) { //the function fetches every row in the summoned table as an associative array, with the columns being the keys and the items being the values for every index
              echo "<form action='report_cards_buttons-inc.php' method='post'>";
              echo "<button class='subject' type='submit' name='submit' value='".$row['class']."'>".$row['class']."</button>";
              echo "<br />";
              echo "</form>";
            }

    }

    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if (strpos($url, "error=ClassNotAvailable")) {
      echo "<p>You do not teach this class!</p>";
    }

     ?>
</div>
  </body>
</html>
