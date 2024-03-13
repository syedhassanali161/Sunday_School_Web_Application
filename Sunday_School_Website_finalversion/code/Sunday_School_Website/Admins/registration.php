<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <!--A navigation bar through which the administrator can navigate their account-->
    <a href="../home.php">Home</a>
    <a href="registration.php">Registration</a>
    <a href="announcements.php">Announcements</a>
    <a href="admin_login.php">Administrator Login</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Register</h1>
    <div class="home">
    <!--A form that will have imput fields requesting all the required information about a student.
    This includes, name, username, password, father's name, mother's name, father's email, and
    mother's emial.
  -->
    <form action="registration-inc.php" method="post">
      <input type="text" name="firstname" placeholder="Student's Full Name" maxlength="19" required> <br>
      <input type="text" name="username" placeholder="Student's Username" maxlength="19" required> <br>
      <input type="text" name="password" placeholder="Password" maxlength="19" required> <br>
      <input type="text" name="fathername" placeholder="Student's Father's Name" required> <br>
      <input type="text" name="mothername" placeholder="Student's Mother's Name" required> <br>
      <input type="email" name="fatheremail" placeholder="Father's Email Address" required> <br>
      <input type="email" name="motheremail" placeholder="Mother's Email Address" required> <br>
      <p>Grade:</p>
      <label>
        <input type="checkbox" name="1-2">
      </label>1-2
      <br>
      <label>
        <input type="checkbox" name="3-4">
      </label>3-4
      <br>
      <label>
        <input type="checkbox" name="5-6">
      </label>5-6
      <br>
      <label>
        <input type="checkbox" name="7-8">
      </label>7-8
      <br>
      <label>
        <input type="checkbox" name="9-10">
      </label>9-10
      <br>
      <button type="submit" name="submit">REGISTER</button>
    </form>
    </div>

    <?php
    //grabbing the url of the page and storing it in the variable $url
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    //using the strpos() function to check whether there are any errors or successes identified in the url
    //The administrator will get a error/success message based on what is written in the url
    if (strpos($url, "error=PickOneGrade")) {
      echo "<p>Please Pick One Grade!</p>";
    }
    if (strpos($url, "error=SpaceInUsername")) {
      echo "<p>Please do not put spaces in the username!</p>";
    }
    if (strpos($url, "error=InvalidEntry")) {
      echo "<p>Please only use letters, numbers, dots, and underscores in the input fields!</p>";
    }
    if (strpos($url, "success=registered")) {
      echo "<p>Student has been registered!</p>";
    }
    if (strpos($url, "error=UsernameTaken")) {
      echo "<p>This username is already taken!</p>";
    }

     ?>
  </body>
</html>
