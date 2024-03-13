<?php

//creating variables that will be used in the connection to database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "sunday_school";

//function used to connect to database  is stored in variable
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

//The program will not give an unreadable error to user in case of database connection failing
if (!$conn) {
  //The die() function stops the program
  die("database connection has failed!");
}


 ?>
