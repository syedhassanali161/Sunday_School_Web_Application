<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Teacher Log In</title>
    <a href="../home.php">Home</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <!--Form that a teacher will input their username and password into and click submit.
    The form will send data to the "teacher_login-inc.php" page through the post method
  -->
  <h1>Teacher Login</h1>
  <div class="login">
    <form action="teacher_login-inc.php" method="post">
      <input type="text" name="username" placeholder="USERNAME" required> <br>
      <input type="password" name="password" placeholder="PASSWORD" required> <br>
      <button type="submit" name="submit">LOG IN</button>
    </form>
    </div>

    <?php
    //grabbing the url and storing it in a variable by the name of $url
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    //based on whatever message is in the url, the user will get a message on the page
    //using the strpos() to check if the second string parameter is in the first string parameter
    if (strpos($url, "error=wrongPassword")) {
      echo "<p>Incorrect Password!</p>";
    }
    if (strpos($url, "error=usernameNotFound")) {
      echo "<p>Username Not Found!</p>";
    }
    if (strpos($url, "error=SpaceInUsername")) {
      echo "<p>Please do not put spaces in the username!</p>";
    }
    if (strpos($url, "error=InvalidEntry")) {
      echo "<p>Please only use letters, numbers, dots, and underscores</p>";
    }

     ?>
  </body>
</html>
