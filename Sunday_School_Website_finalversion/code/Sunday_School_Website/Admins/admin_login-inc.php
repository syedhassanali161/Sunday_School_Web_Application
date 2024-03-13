<?php
if (isset($_POST["submit"])) {
  require_once "../database.php";

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (strpos($username, " ")) {
    header("Location: admin_login.php?error=SpaceInUsername");
    exit();
  }

  foreach ($_POST as $key => $value) {
    if (strpos("a" . $value, "'") OR strpos("a" . $value, ")") OR strpos("a" . $value, "(") OR strpos('a' . $value, '"') OR strpos("a" . $value, "`") OR strpos("a" . $value, ";") OR strpos("a" . $value, "=")) {
      header("Location: teacher_login.php?error=InvalidEntry"); //user is sent back to the login page with an error
      exit(); //program stops
    }
  }


  $sql = "SELECT * FROM admins WHERE username = '".$username."'"; //the sql query being executed
  $result = mysqli_query($conn, $sql); //executes the query (takes in 2 parameters (the connection to the database, the query being executed) )
  $rowCount = mysqli_num_rows($result); //returns the number of rows in the table

  if ($rowCount > 0) {
    while ($row = mysqli_fetch_assoc($result)) { //the function fetches every row in the summoned table as an associative array, with the columns being the keys and the items being the values for every index
      $sqltwo = "SELECT password FROM admins WHERE username = '".$username."'";
      $resulttwo = mysqli_query($conn, $sqltwo);
      $row = mysqli_fetch_assoc($resulttwo);
      if ($password == $row["password"]) {
        header("Location: admin_home.php");
        exit();
      } else {
        header("Location: admin_login.php?error=wrongPassword");
        exit();
      }
    }
  } else {
    header("Location: admin_login.php?error=usernameNotFound");
  }
}
 ?>
