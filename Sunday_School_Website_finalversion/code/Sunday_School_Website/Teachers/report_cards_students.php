<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Choose A Student - Report Cards</title>
    <a href="../home.php">Home</a>
    <a href="attendance_buttons.php">Attendance</a>
    <a href="announcements_buttons.php">Announcements</a>
    <a href="report_cards_buttons.php">Report Card</a>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Choose A Student</h1>
    <div class="home">
    <?php
    session_start(); //starting a session to enable the usage of $_SESSION variables

    //importing the database connection file
    require_once "../database.php";


    //creating and running query that selects everything from the table of the class that the teacher teaches
    $sql = "SELECT * FROM ".$_SESSION['sessionclass'].""; //the sql query being executed
    $result = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_assoc($result)) { //creating a variable $row that has an associative array for every row in the class's table
      $_SESSION["sessionfirstname"] = $row["firstname"]; //creating a $_SESSION variable with the name of the student in $row
      //creating a form that will have 1 button
      //this button will have the value and be labeled as the firstname of the student's name in $row
      echo "<form action='report_cards.php' method='post'>";
      echo "<button type='submit' name='submit' value='".$_SESSION['sessionfirstname']."'>".$_SESSION['sessionfirstname']."</button>";
      echo "<br />";
      echo "</form>";
  }
     ?>
     </div>
  </body>
</html>
