<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Al-Murtuza Sunday School</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Welcome To Al-Murtaza School</h1>
    <hr>
    <div class="home">
      <h3>Log in as a:</h3>
      <!--The user is sent to the student login page-->
      <form action="Students/student_login.php">
        <input type="submit" value="Student">
      </form>
      <!--The user is sent to the teacher login page-->
      <form action="Teachers/teacher_login.php">
        <input type="submit" value="Teacher">
      </form>
      <!--The user is sent to the administrator login page-->
      <form action="Admins/admin_login.php">
        <input type="submit" value="Administrator">
      </form>
    </div>
  </body>
</html>
