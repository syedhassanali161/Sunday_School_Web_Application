<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Attendance</title>
    <a href="../home.php">Home</a>
    <a href="attendance.php">Attendance</a>
    <a href="report_card.php">Report Card</a>
    <a href="announcements.php">Announcements</a>
    <a href="student_login.php">Student Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Attendance</h1>
    <div class="home">
    <?php
    session_start(); //starting a session so that session variables can be created and used
    require_once "../database.php"; //importing the database connection file

    //creating and executing a query that selects everything in the table that corresponds to the student's username
    $sql = "SELECT * FROM " .$_SESSION['sessionusername'];  //edit your table name here
    $result = mysqli_query($conn, $sql);
    echo "<br />";

    while ($row = mysqli_fetch_assoc($result)) { //creating an associative array called $row for every row that is returned with the query
      echo "DATE: ". $row["date"]; //echoing the date that the attendance was taken (iinformation inputted by the teacher)
      echo "<br />";
        foreach ($row as $key => $value) { //for every item in the associative array, $row
          if ($key != "date") { //if the item is not the date (meaning it is a subject name)
            echo $key . ": " . $value; //echo the subject name, and with it, the attendance of the student in that subject on that date
            echo "<br />";
          }
        }
      echo "<br />";
    }
     ?>
     </div>
  </body>
</html>
