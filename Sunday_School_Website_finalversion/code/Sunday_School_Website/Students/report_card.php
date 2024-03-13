<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Cards</title>
    <!--Navuigation bar that will send students to different pages-->
    <a href="../home.php">Home</a>
    <a href="attendance.php">Attendance</a>
    <a href="report_card.php">Report Card</a>
    <a href="announcements.php">Announcements</a>
    <a href="student_login.php">Student Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Report Cards</h1>
    <div class="home">

    <?php
    session_start(); //starting session so that $_SESSION variables can be used and created
    require_once "../database.php"; //importing the database connection file
    echo "<br />";
//creating a function, report(), that will echo a student's marks based on the subject they take
function report($conn, $subject1, $subject2, $subject3, $subject4, $subject5) { //defining function name and parameters
  //creating an array of the subjects that a student takes in order to use it in a for loop
  $arrayOfSubjects = array($subject1, $subject2, $subject3, $subject4, $subject5);

  foreach ($arrayOfSubjects as $key => $value) { //for every subject in $arrayOfSubjects
    /*creating and executing a query that goes into the table of the subject
    that the student is taking and uses the student's username to access their
    information
    */
    $sql = "SELECT * FROM $value WHERE username = '" .$_SESSION['sessionusername']. "'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) { //creating an associative array, $row, with the results of the executed query
      /*Using a simple algorithm to calculate the student's average.
      This same algorithm was used to calculate the average for the teacher's end of the website.
      */
      $totalmarks = array();
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
      $sumofmarks = array_sum($totalmarks);
      $numberofmarks = sizeof($totalmarks);
      $average = 0;
      if ($numberofmarks>0) {
        $average = $sumofmarks/$numberofmarks;
      }
      echo "Subject: " .ucwords($value); //echoing the subject (and capitalizing it's first letter)
      echo "<br />";
      echo "Name: ". $row['firstname']; //echoing the student's name
      echo "<br />";
      echo "Quiz One Mark: ". $row['quiz1'] . "%"; //echoing the marks in quiz1
      echo "<br />";
      echo "Quiz Two Mark: ". $row['quiz2'] . "%"; //echoing the marks in quiz2
      echo "<br />";
      echo "Quiz Three Mark: ". $row['quiz3'] . "%"; //echoing the marks in quiz3
      echo "<br />";
      echo "Quiz Four Mark: ". $row['quiz4'] . "%"; //echoing the marks in quiz4
      echo "<br />";
      echo "<p class='message'>Teacher's Comments: ". $row['comments']." </p>"; //echoing the comments
      //calculating and echoing the final mark
      echo "Final Mark: " .$average. "%";
      echo "<br />";
      echo "<br />";
    }
  }

}

//calling the report() function with different subjects as arguemnts
//this will be based on the grade that the student is in
/*
$_SESSION["sessiongrade"] is a variable that is created when a student logs in.
The program assigns this variable a value based on the information of the student in the
database.
*/
if ($_SESSION["sessiongrade"] == "1-2") {
  report($conn, 'deeniat12', 'history12', 'quran12', 'akhlaq12', 'urdu1234');
}
if ($_SESSION["sessiongrade"] == "3-4") {
  report($conn, 'deeniat34', 'history34', 'quran34', 'akhlaq34', 'urdu1234');
}
if ($_SESSION["sessiongrade"] == "5-6") {
  report($conn, 'deeniat56', 'history56', 'quran56', 'akhlaq56', 'urdu56');
}
if ($_SESSION["sessiongrade"] == "7-8") {
  report($conn, 'tauzehalmasail78', 'mafatehaljinan78', 'quran78', 'history78', 'urdu78910');
}
if ($_SESSION["sessiongrade"] == "9-10") {
  report($conn, 'aqaidandehkam910', 'nahjulbalagha910', 'mafatehaljinan78', 'quran910', 'urdu78910');
}


     ?>
     </div>
  </body>
</html>
