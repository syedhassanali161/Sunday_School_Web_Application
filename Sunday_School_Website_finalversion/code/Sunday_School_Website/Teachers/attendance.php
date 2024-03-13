<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Attendance</title>
    <a href="../home.php">Home</a>
    <a href="attendance_buttons.php">Attendance</a>
    <a href="announcements_buttons.php">Announcements</a>
    <a href="report_cards_buttons.php">Report Card</a>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Attendance</h1>
    <div class="home">
    <?php
    session_start(); //starting session to enable use of $_SESSION variabels

    require_once "../database.php"; //importing the database connection file

    //creating and executing a query that selects everything from the class that the teacher teaches
    $sql = "SELECT * FROM " . $_SESSION['sessionclass'];
    $result = mysqli_query($conn, $sql);
    $_SESSION["sessionstudents"] = array(); //declaring a $_SESSION variable of an array that will hold the usernames of all the students in the class

    //the teacher will use this form to select the date that the attendance is being marked on, put a checkmark beside the students present, and submit that data
    echo "<form action='attendance-inc.php' method='post'>";
    echo "<label for='date'> Date Today: ";
    echo "<input type='date' id='date' name='date' required>";
    echo "</label>";
    echo "<br />";

    while ($row = mysqli_fetch_assoc($result)) { //for every row in the class table, the values for every column are assigned to the variable $row
        echo "<label>";
        echo "<input class='student' type='checkbox' name='".$row["username"]."'>"; //creating a checkbox with the value of the student's username
        echo "</label>".$row['firstname']; //labeling the checkbox with the student's name
        echo "<br />";
        array_push($_SESSION["sessionstudents"], $row["username"]); //adding the student's username to the $_SESSION["sessionstudents"] array
    }
    echo "<button type='submit' name='submit'>SEND</button>";
    echo "</form>";


//finding and storing the $url of the page in a variable $url
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
       $url = "https://";
    } else {
        $url = "http://";
    }

    $url.= $_SERVER['HTTP_HOST'];
    $url.= $_SERVER['REQUEST_URI'];

    //if $url has the words "success=sent" in it, then the user gets a success message
      if (strpos($url, "success=attendanceMarked")) {
        echo "<p>Attendance has been marked!</p>";
      }
     ?>
     </div>
  </body>
</html>
