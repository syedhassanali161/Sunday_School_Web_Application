<?php
if (isset($_POST["submit"])) {
  require_once "../database.php"; //importing the database connection file

  session_start(); //starting session to enable usage of $_SESSION variables
  //storing the entered username and password in corressponding variables
  $username = $_POST["username"];
  $password = $_POST["password"];


  //making sure that the username does not have a space
  if (strpos($username, " ")) {
    header("Location: teacher_login.php?error=SpaceInUsername"); //user is sent back to the login page with an error
    exit(); //program stops
  }

//making sure neither the username or password entered have any of the stated characters: ')("`;=
//this is to prevent usage of characters that could be used in an sql injection
foreach ($_POST as $key => $value) {
  //an "a" is being concatenated to every string so that the index of the character is not 0.
  //If the index of the character is 0, the strpos() function returns false
  if (strpos("a" . $value, "'") OR strpos("a" . $value, ")") OR strpos("a" . $value, "(") OR
  strpos('a' . $value, '"') OR strpos("a" . $value, "`") OR strpos("a" . $value, ";") OR strpos("a" . $value, "=")) {
    header("Location: teacher_login.php?error=InvalidEntry"); //user is sent back to the login page with an error
    exit(); //program stops
  }
}

  /*creating and executing sql query that will grab the row form the teachers table that holds the entered username*/
  $sql = "SELECT * FROM teachers WHERE username = '".$username."'";
  $result = mysqli_query($conn, $sql);
  $rowCount = mysqli_num_rows($result); //the variable $rowCount holds the number of rows returned in the $result

  if ($rowCount > 0) { //if the username is found
    //creating a $row variable that will store every record from $result in the format of an associative array
    while ($row = mysqli_fetch_assoc($result)) {
      if ($password == $row["password"]) { //if the password entered matches the password present in the database
        //the username of the teacher is stored in the $_SESSION variable for later use in other files
        $_SESSION["sessionusername"] = $row["username"];
        header("Location: teacher_home.php"); //the teacher is successfully sent to the teacher_home.php page
        exit(); //the program stops
      } else { //if the password is wrong
        header("Location: teacher_login.php?error=wrongPassword"); //user is sent back to the login page with an error
        exit(); //the program stops
      }
    }
  } else { //if the username is not found
    header("Location: teacher_login.php?error=usernameNotFound"); //user is sent back to the login page with an error
  }
}
 ?>
