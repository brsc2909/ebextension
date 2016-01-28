<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "Vgn-fw21l";
  $db = "users";




  // Create connection
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }




 ?>
