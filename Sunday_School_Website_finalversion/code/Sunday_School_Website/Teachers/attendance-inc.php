<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start(); //starting session to enable use of $_SESSION variables
    require_once "../database.php"; //importing the database connection file

    $arrayofall = array(); //declaring an empty array that will hold all the students that were present


    foreach ($_POST as $key => $value) { //going through the $_POST variable (which is an associative array)
      array_push($arrayofall, $key); //adding every $key to $arrayofall (it will now have the usernames of every student that was checkmarked)
    }


    foreach ($_SESSION["sessionstudents"] as $key => $value) {
      if (!in_array($value, $arrayofall)) { //the student is in the class but was not present

        // checking to see if attendance has already been marked that day, perhaps during another class
        $sqlone = "SELECT * FROM $value WHERE date = '".$_POST["date"]."'";
        $resultone = mysqli_query($conn, $sqlone);
        $rowCount = mysqli_num_rows($resultone);

        if ($rowCount > 0) { //if there are more than 0 rows returned in $resultone, that means attendance has been taken that day already
          //there is no need to create a new row in the table, with a new date
          //updating the table that is correspondant to the stuent's name in the database
          $sql = "UPDATE $value SET ".$_SESSION['sessionclass']." = 'Absent' WHERE date = '".$_POST["date"]."'"; //setting their attendance for that class, on that date, as absent
          $result = mysqli_query($conn, $sql);
        } else { //the date is not present in the table, that means attendnace has not been taken that day already
          //creating a new row in that table with the date that was selected and setting their attendance for that class, on that date, as absent
          $sql = "INSERT INTO $value (date,".$_SESSION['sessionclass'].") VALUES ('".$_POST["date"]."', 'Absent')";
          $result = mysqli_query($conn, $sql);
        }

      } else { //the student is in the class and was present
        //the exact same checks are made as in the situation that the student was not here
        //the student is marked present instead of absent
        $sqlone = "SELECT * FROM $value WHERE date = '".$_POST["date"]."'";
        $resultone = mysqli_query($conn, $sqlone);
        $rowCount = mysqli_num_rows($resultone);

        if ($rowCount > 0) {
          $sql = "UPDATE $value SET ".$_SESSION['sessionclass']." = 'Present' WHERE date = '".$_POST["date"]."'";
          $result = mysqli_query($conn, $sql);
        } else {
          $sql = "INSERT INTO $value (date,".$_SESSION['sessionclass'].") VALUES ('".$_POST["date"]."', 'Present')";
          $result = mysqli_query($conn, $sql);
        }
      }
    }

    header("Location: attendance.php?success=attendanceMarked"); //Teacher is directed to the attendance page with a succes message in the url
    exit();//program is stopped
     ?>
  </body>
</html>
