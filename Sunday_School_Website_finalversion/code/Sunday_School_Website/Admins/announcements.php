<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Announcements</title>
    <a href="../home.php">Home</a>
    <a href="registration.php">Registration</a>
    <a href="announcements.php">Announcements</a>
    <a href="admin_login.php">Administrator Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Announcements</h1>
    <div class="home">
    <form action="announcements.php" method="post">
      <textarea name="announcement" rows="8" cols="80" maxlength="499" required></textarea> <br>
      <button type="submit" name="submit">SEND</button> <br>
    </form>
    </div>

    <?php

    if (isset($_POST["submit"])) { //if the submit button is pressed
      require_once "../database.php"; //importing the database connection file

      $announcement = $_POST["announcement"]; //declaring a variable $announcement and having it store the announcement

      if (strlen($announcement) == 0) {
        header("Location: announcements.php?error=empty");
        exit();
      }

      //creating and executing a query that will insert the announcement into the tables of all the grades that hold announcements
      $sql = "INSERT INTO announcements12 (announcement) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "s", $announcement);
      mysqli_stmt_execute($stmt);
      $sql = "INSERT INTO announcements34 (announcement) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "s", $announcement);
      mysqli_stmt_execute($stmt);
      $sql = "INSERT INTO announcements56 (announcement) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "s", $announcement);
      mysqli_stmt_execute($stmt);
      $sql = "INSERT INTO announcements78 (announcement) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "s", $announcement);
      mysqli_stmt_execute($stmt);
      $sql = "INSERT INTO announcements910 (announcement) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "s", $announcement);
      mysqli_stmt_execute($stmt);
      header("Location: announcements.php?success=sent"); //the administrator is directed to the announcement page with a success message in the url
      exit();
      }

      //grabbing the url and storing it in the variable $url
      $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      if (strpos($url, "success=sent")) { //using the strpos() to see if the url has a success message
        echo "<p>Announcement has been sent!</p>"; //printing the success message for the administrator
      }
      if (strpos($url, "error=empty")) { //using the strpos() to see if the url has a success message
        echo "<p>No announcement entered </p>"; //printing the success message for the administrator
      }
     ?>
  </body>
</html>
