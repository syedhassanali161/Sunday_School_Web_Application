<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if (isset($_POST["submit"])) {

      //starting session so that $_SESSION variables can be created and used
      session_start();

      //importing the database connection file
      require_once "../database.php";

      //creating and executing query that selects the row from the "teachers" table where the "class" is equal to the one selected by the teacher
      $sql = "SELECT * FROM teachers WHERE class = '".$_POST["submit"]."'";
      $result = mysqli_query($conn, $sql);


      //declaring every row from $result as $row, an associative array with the column names as key, and the data entries as values
      while ($row = mysqli_fetch_assoc($result)) {

        //declaring the variable $username by accessing the key "username" in $row
        $username = $row["username"];
        //declaring the session variable $_SESSION["sessionclass"] by accessing the key "class" in $row
        $_SESSION["sessionclass"] = $row["class"];

        //if the username that the teacher logged in with is the same as the username found in $row
        if ($_SESSION["sessionusername"] == $username) {
          //the teacher is sent to the next page
          header("Location: attendance.php");
          exit(); //this script is stopped
        } else { //if the username that the teacher logged in with is not the same as the username found in $row
          //the teacher is sent back to the previous page (attendance-buttons.php) with the error "ClassNotAvailable"
          header("Location: attendance_buttons.php?error=ClassNotAvailable");
          exit(); //the script is stopped
        }
      }

    }


     ?>
  </body>
</html>
