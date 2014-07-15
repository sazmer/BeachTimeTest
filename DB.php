<?php
define("HOST", "mysql10.citynetwork.se"); // The host you want to connect to.
define("USER", "120268-bu54962"); // The database username.
define("PASSWORD", "VolleyBoll01!"); // The database password. 
define("DATABASE", "120268-testenv"); // The database name.
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
?>