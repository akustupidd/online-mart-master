<?php

  $host = "localhost:3306"; //127.0.0.1
  $user = "root";
  $pass = "";
  $conn = mysqli_connect($host,$user,$pass); // or die("Error Connection");

  if(!$conn){
    die("Error Connection " .mysqli_connect_error());
  }
  mysqli_select_db($conn,"onlinemart") or die("Error selecting database");
  #echo "Connection Completed";
?> 