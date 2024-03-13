<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Announcements</title>
    <a href="../home.php">Home</a>
    <a href="attendance.php">Attendance</a>
    <a href="report_card.php">Report Card</a>
    <a href="announcements.php">Announcements</a>
    <a href="student_login.php">Student Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Announcements</h1>
    <div class="home">
    <?php

    session_start(); //starting a session so that $_SESSION variables can be created and used
    echo "<br />";

    function announce($table){
      require_once "../database.php"; //importing the database connection file

      /*creating and executing query that will select everything from the table specified
      and will order it in a descending order
      */
      $sql = "SELECT * FROM $table ORDER BY id DESC";
      $result = mysqli_query($conn, $sql);

      //creating an associative array as a variable $row, for everything that is in result
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<p class='message'>".$row['announcement']."</p>";
        echo "<br />";
        echo "<hr class='announcement' >";
      }
    }

    //calling the announce() function with different tables as arguemnts
    //this will be based on the grade that the student is in
    /*$_SESSION["sessiongrade"] is a variable that is created when a student logs in.
    The program assigns this variable a value based on the information of the student in the
    database.
    */
    if ($_SESSION["sessiongrade"] == '1-2') {
      announce('announcements12');
    }
    if ($_SESSION["sessiongrade"] == '3-4') {
      announce('announcements34');
    }
    if ($_SESSION["sessiongrade"] == '5-6') {
      announce('announcements56');
    }
    if ($_SESSION["sessiongrade"] == '7-8') {
      announce('announcements78');
    }
    if ($_SESSION["sessiongrade"] == '9-10') {
      announce('announcements910');
    }


     ?>
     </div>
  </body>
</html>
