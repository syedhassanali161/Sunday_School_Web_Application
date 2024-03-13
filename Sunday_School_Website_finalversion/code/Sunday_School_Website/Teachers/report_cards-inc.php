<?php
//if a submit button was clicked on the last page
if (isset($_POST["submit2"])) {
  session_start(); //starting a session so that $_SESSION variables can be defined
  require_once "../database.php"; //importing the database connection file

  //defining variables of every input that was given on the last page
  $quiz1 = $_POST["quiz1"];
  $quiz2 = $_POST["quiz2"];
  $quiz3 = $_POST["quiz3"];
  $quiz4 = $_POST["quiz4"];
  $comments = $_POST["comments"];


  //the marks of the students in the database actually only change when the fields are not empty
  if (!empty($_POST["quiz1"]) or $_POST["quiz1"] == 0) {
    /*creating and executing a query that updates the marks of the students in that class's table
    by matching the name selected and the name present in the table
    */

    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz1 = " .$quiz1. " WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
    //A flag is turned on the first time that a mark is entered. (This is done in order to calculate the average mark properly)
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz1flag = 'Yes' WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
  }
  if (!empty($_POST["quiz2"]) or $_POST["quiz2"] == 0) {
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz2 = " .$quiz2. " WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz2flag = 'Yes' WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
  }
  if (!empty($_POST["quiz3"]) or $_POST["quiz3"] == 0) {
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz3 = " .$quiz3. " WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz3flag = 'Yes' WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
  }
  if (!empty($_POST["quiz4"]) or $_POST["quiz4"] == 0) {
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz4 = " .$quiz4. " WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
    //the sql query being executed
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET quiz4flag = 'Yes' WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    $result = mysqli_query($conn, $sql);
  }


  if (!empty($_POST["comments"])) {
    //PREPARED STATEMENTS
    //The template for an sql query is created
    $sql = "UPDATE " .$_SESSION['sessionclass']. " SET comments = ? WHERE firstname = '" .$_SESSION['sessionfirstname']."'";
    //an object is returned through the mysqli_stmt_init() function that can be used in the mysqli_stmt_prepare() function
    $stmt = mysqli_stmt_init($conn);
    //the query that is to be executed is prepared using the mysqli_stmt_prepare() function
    mysqli_stmt_prepare($stmt, $sql);
    //the query template is binded with the data that actually needs to be used in the query
    mysqli_stmt_bind_param($stmt, "s", $comments);
    //query is executed
    mysqli_stmt_execute($stmt);
  }

  header("Location: report_cards.php?success=sent");
  exit();
  }
 ?>
