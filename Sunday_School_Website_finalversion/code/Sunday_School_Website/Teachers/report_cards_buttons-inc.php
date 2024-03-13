<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if (isset($_POST["submit"])) {
      session_start();

      require_once "../database.php";

      $sql = "SELECT * FROM teachers WHERE class = '".$_POST["submit"]."'";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $username = $row["username"];
        $_SESSION["sessionclass"] = $row["class"];
        if ($_SESSION["sessionusername"] == $username) {
          header("Location: report_cards_students.php");
          exit();
        } else {
          header("Location: report_cards_buttons.php?error=ClassNotAvailable");
          exit();
        }
      }

    }

     ?>
  </body>
</html>
