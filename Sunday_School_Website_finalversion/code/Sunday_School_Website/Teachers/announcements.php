<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Announcements</title>
    <a href="../home.php">Home</a>
    <a href="attendance_buttons.php">Attendance</a>
    <a href="announcements_buttons.php">Announcements</a>
    <a href="report_cards_buttons.php">Report Card</a>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Announcements</h1>
    <div class="home">
    <!--creating a form that will post to this same page, after taking in whatever announcement the teacher types as data-->
    <form action="announcements.php" method="post">
      <textarea name="announcement" rows="8" cols="80" maxlength="499" required></textarea> <br>
      <button type="submit" name="submit">SEND</button> <br>
    </form>
    </div>

    <?php

    //if the send button is clicked
    if (isset($_POST["submit"])) {

      session_start(); //starting session to allow usage of $_SESSION variables

      require_once "../database.php"; //importing the database connection file

      $announcement = $_POST["announcement"]; //creating a variable to store whatever the teacher inputed as the announcement

      //depending on what grade level class the teacher teaches, the announcement will be stored in that database table
      if (strpos($_SESSION["sessionclass"], "12")) { //if the class name has "12" in it, that means that the teacher teaches grades 1 and 2
        //inserting the announcement into the table that stores the announcements for grade 1-2

        //Prepared statements are used for writing the announcements to the database
        $sql = "INSERT INTO announcements12 (announcement) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $announcement);
        mysqli_stmt_execute($stmt);
        header("Location: announcements.php?success=sent"); //sending the teacher to the same page, but with the success message, "success=sent"
      }
      if (strpos($_SESSION["sessionclass"], "34")) {
        $sql = "INSERT INTO announcements34 (announcement) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $announcement);
        mysqli_stmt_execute($stmt);
        header("Location: announcements.php?success=sent");
      }
      if (strpos($_SESSION["sessionclass"], "56")) {
        $sql = "INSERT INTO announcements56 (announcement) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $announcement);
        mysqli_stmt_execute($stmt);
        header("Location: announcements.php?success=sent");
      }
      if (strpos($_SESSION["sessionclass"], "78")) {
        $sql = "INSERT INTO announcements78 (announcement) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $announcement);
        mysqli_stmt_execute($stmt);
        header("Location: announcements.php?success=sent");
      }
      if (strpos($_SESSION["sessionclass"], "910")) {
        $sql = "INSERT INTO announcements910 (announcement) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $announcement);
        mysqli_stmt_execute($stmt);
        header("Location: announcements.php?success=sent");
      }

            }


    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //storing the url of the page in a variable "$url"

    //if $url has the words "success=sent" in it, then the user gets a success message
      if (strpos($url, "success=sent")) {
        echo "<p>Announcement Has Been Sent!</p>";
      }
     ?>
  </body>
</html>
