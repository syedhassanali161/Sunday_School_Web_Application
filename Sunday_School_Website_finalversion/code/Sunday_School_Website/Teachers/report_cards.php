<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Card - <?php echo $_POST['submit']; ?></title>
    <a href="../home.php">Home</a>
    <a href="attendance_buttons.php">Attendance</a>
    <a href="announcements_buttons.php">Announcements</a>
    <a href="report_cards_buttons.php">Report Card</a>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Report Card</h1>
    <div class="home">
     <?php

     session_start();

     require_once "../database.php";

     //if a submit button was clicked on the last page
     if (isset($_POST["submit"])) {
       /*executing query that selects the row from the table of the class that the teacher teaches, where the data of the
       firstname column matches the firstname selected on the last page through the submit button
       */
       $sql = "SELECT * FROM " .$_SESSION['sessionclass']. " WHERE firstname = '".$_POST['submit']."'"; //the sql query being executed
       $result = mysqli_query($conn, $sql);

       //starting a while loop that turns the $row selected by the query into an associative array
       while ($row = mysqli_fetch_assoc($result)) {
      ?>

      <br />
      <!--This is a form where the placeholders of all of the fields, are the marks of the quizes/the comments
      currently entered for that student. These marks/comments are accessed through echoing the values of
      different keys in the associative array
    -->
      <form action='report_cards-inc.php' method='post'>
      <input type='number' name='quiz1' min="0" placeholder='Quiz 1 Mark: <?php echo $row["quiz1"];?> %' >
      <br />
      <input type='number' name='quiz2' min="0" placeholder='Quiz 2 Mark: <?php echo $row["quiz2"];?>%' >
      <br />
      <input type='number' name='quiz3' min="0" placeholder='Quiz 3 Mark: <?php echo $row["quiz3"];?>%' >
      <br />
      <input type='number' name='quiz4' min="0" placeholder='Quiz 4 Mark: <?php echo $row["quiz4"];?>%' >
      <br />
      <?php
      echo '<textarea class="comments" placeholder="Comments after final quiz: '. htmlspecialchars($row["comments"]).
      '" id="comments" name="comments" rows="4" cols="50" maxlength="99"></textarea>';
       ?>
      <br />
      <!--calculating and echoing the student's average marks-->
      <?php
      //array that holds the mark of the student if it has been entered
      $totalmarks = array();

      //appending to the $totalmarks array if the mark has been entered
      if ($row["quiz1flag"] == "Yes") {
        array_push($totalmarks, $row['quiz1']);
      }
      if ($row["quiz2flag"] == "Yes") {
        array_push($totalmarks, $row['quiz2']);
      }
      if ($row["quiz3flag"] == "Yes") {
        array_push($totalmarks, $row['quiz3']);
      }
      if ($row["quiz4flag"] == "Yes") {
        array_push($totalmarks, $row['quiz4']);
      }

      //finding the sum of the marks in the array in order to determine average
      $sumofmarks = array_sum($totalmarks);
      //finding how many marks have been entered
      $numberofmarks = sizeof($totalmarks);

      //calculating the average if marks have been entered
      $average = 0;
      //an if statement is used in order to prevent a zero divisbility error
      if ($numberofmarks>0) {
        $average = $sumofmarks/$numberofmarks;
      }

       ?>
       <!--Presenting the student's average-->
      <p>Currently, <?php echo $_POST['submit']; ?>'s Average mark is: <?php echo $average;?>%</p>
      <br />
      <button type='submit' name='submit2'>SEND</button>
      </form>


      <?php
      /*creating and executing sql query that selects the firstname from the table of the class that the teacher teaches,
      where the firstname is equal to the one selected on the previous page. This is done in order to create a
      $_SESSION variable so it can be accessed not only on this page, but instead on every page of the website.
      */

      //the sql query being executed
      $sqltwo = "SELECT firstname FROM " .$_SESSION['sessionclass']. " WHERE firstname = '".$_POST['submit']."'";
      $resulttwo = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($resulttwo)) { //making an associative array of the $result
        $_SESSION["sessionfirstname"] = $row["firstname"]; //defining the firstname $_SESSION variable
      }
    }
  }
?>

<?php
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
     $url = "https://";
  } else {
      $url = "http://";
  }

  $url.= $_SERVER['HTTP_HOST'];
  $url.= $_SERVER['REQUEST_URI'];

  //if $url has the words "success=sent" in it, then the user gets a success message
    if (strpos($url, "success=sent")) {
      echo "<p>Marks Have Been Entered</p>";
    }

       ?>
<br />
<a href="report_cards_students.php">BACK TO STUDENTS!</a>
</div>
  </body>
</html>
