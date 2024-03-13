<?php

if (isset($_POST["submit"])) { //if the submit button was clicked on the last page
  require_once "../database.php"; //importing the database connection file

  //declaring variables based on the data inputted into the fields on the registration page by the administrator
  $firstname = $_POST["firstname"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $fathername = $_POST["fathername"];
  $mothername = $_POST["mothername"];
  $fatheremail = $_POST["fatheremail"];
  $motheremail = $_POST["motheremail"];
  $grade = ""; //declare an actual value for grade based on if statements


//using the strpos() function to make sure there are no spaces in the username
  if (strpos($username, " ")) { //if there are spaces in the username
    header("Location: registration.php?error=SpaceInUsername"); //administrator is directed back to the registration page with an error in the url
    exit(); //program is stopped
  }

//making sure none of the information entered has any of the stated characters: ')("`;=
//this is to prevent usage of characters that could be used in an sql injection
foreach ($_POST as $key => $value) {
  if (strpos("a" . $value, "'") OR strpos("a" . $value, ")") OR strpos("a" . $value, "(") OR strpos('a' . $value, '"') OR strpos("a" . $value, "`") OR strpos("a" . $value, ";") OR strpos("a" . $value, "=")) {
    header("Location: registration.php?error=InvalidEntry"); //user is sent back to the login page with an error
    exit(); //program stops
  }
}


  //making sure that there is not more than one grade selected
  $counter = 0;
  foreach ($_POST as $key => $value) {
    if ($key == "1-2" || $key == "3-4" || $key == "5-6" || $key == "7-8" || $key == "9-10") {
      $counter += 1;
    }
    }

  //if more than 1 grade was selected, the user is sent back to the registration page with an error in the url
  if ($counter > 1) {
    header("Location: registration.php?error=PickOneGrade");
    exit(); //program is stopped
  }

  //checking to see if username entered is already in use
  //creating and executing query that selects all the usernames from the students table
  $nameTakenCheck = "SELECT username FROM students";
  $resultNameTakenCheck = mysqli_query($conn, $nameTakenCheck);

  while ($row = mysqli_fetch_assoc($resultNameTakenCheck)) { //creating associative array variables, $row, with all the results of the query
    if ($row['username'] == $username) { //if the entered username matches a username already in the database
      header("Location: registration.php?error=UsernameTaken"); //the administrator is sent back to the registration page with an error in  the url
      exit(); //program is stopped
    }
  }


  //creating a function, register(), that will register every student based on the parameters given
  function register($conn, $username, $firstname, $subject1, $subject2, $subject3, $subject4, $subject5){

    //creating an array of the 5 subjects that the student will be registered for
    $arrayOfSubjects = array($subject1, $subject2, $subject3, $subject4, $subject5);

    //for each of the 5 subjects
    foreach ($arrayOfSubjects as $key => $value) { //the $value variable is the subject name being looped through
      /*
      creating and executing a query that will put the student's name and username into the corresponding
      columns in the table of the subject being registered for
      */
      $sql = "INSERT INTO ".$value." (firstname, username) VALUES ('".$firstname."', '".$username."')";
      $result = mysqli_query($conn, $sql);
    }
    /*
    creating and executing a query that will create a table named after the student's username that will
    have a date column, and five columns corresponding to the subjects that student takes. This table will
    be used to store the student's attendance record.
    */
    $sql2 = "CREATE TABLE $username (
        date varchar(255),
        ".$subject1." varchar(255),
        ".$subject2." varchar(255),
        ".$subject3." varchar(255),
        ".$subject4." varchar(255),
        ".$subject5." varchar(255)
    );";
    $result2 = mysqli_query($conn, $sql2);
  }



  foreach ($_POST as $key => $value) {
    if ($key == "1-2") { //checking to see what grade was check marked on the registration page
      $grade = "1-2"; //declaring a value to the grade variable in order to put it into the database
      //calling the register function with all the subjects that the student in this grade will be taking as the last 5 parameters
      register($conn, $username, $firstname, "akhlaq12", "deeniat12", "history12", "quran12", "urdu1234");
    }
    if ($key == "3-4") {
      $grade = "3-4";
      register($conn, $username, $firstname, "akhlaq34", "deeniat34", "history34", "quran34", "urdu1234");
    }
    if ($key == "5-6") {
      $grade = "5-6";
      register($conn, $username, $firstname, "akhlaq56", "deeniat56", "history56", "quran56", "urdu56");
    }
    if ($key == "7-8") {
      $grade = "7-8";
      register($conn, $username, $firstname, "mafatehaljinan78", "tauzehalmasail78", "history78", "quran78", "urdu78910");
    }
    if ($key == "9-10") {
      $grade = "9-10";
      register($conn, $username, $firstname, "mafatehaljinan910", "nahjulbalagha910", "aqaidandehkam910", "quran910", "urdu78910");
    }
  }

  //creating and executing a query that will enter all of the students information into a central table with the information of all of the students
  $sql = "INSERT INTO students (firstname, username, password, fathername, mothername, fatheremail, motheremail, grade)
   VALUES ('".$firstname."', '".$username."', '".$password."', '".$fathername."', '".$mothername."', '".$fatheremail."', '".$motheremail."', '".$grade."')"; //the sql query being executed
  $result = mysqli_query($conn, $sql);
  header("Location: registration.php?success=registered"); //directing the administrator to the registration page with a success message in the url
  exit(); //stopping the program


  }


 ?>
