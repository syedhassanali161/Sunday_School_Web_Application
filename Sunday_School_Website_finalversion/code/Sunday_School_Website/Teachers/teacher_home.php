<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Teacher's Home</title>
    <a href="teacher_login.php">Teacher Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <!--A form with buttons leading to different tasks available for teachers.
    Every button leads to a page where the teacher will select the class they teach.
  -->
  <h1>Teacher's Home</h1>
  <div class="home">
    <form action="attendance_buttons.php" method="post">
      <input type="submit" name="submit" value="Attendance">
    </form>
    <form action="report_cards_buttons.php" method="post">
      <input type="submit" name="submit" value="Report Cards">
    </form>
    <form action="announcements_buttons.php" method="post">
      <input type="submit" name="submit" value="Announcements">
    </form>
    </div>
  </body>
</html>
