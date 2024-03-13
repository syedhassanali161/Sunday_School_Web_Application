<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administrator Log In</title>
    <a href="../home.php">Home</a>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <h1>Administrator Login</h1>
    <div class="login">
    <form action="admin_login-inc.php" method="post">
      <input type="text" name="username" placeholder="USERNAME" required> <br>
      <input type="password" name="password" placeholder="PASSWORD" required> <br>
      <button type="submit" name="submit">LOG IN</button>
    </form>
    </div>

    <?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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
