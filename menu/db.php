<?php

// fH46h*g3
$mysqli = new mysqli("localhost", "kadir", "", "simitcaferest");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");


?>