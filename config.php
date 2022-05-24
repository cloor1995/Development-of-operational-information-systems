<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ebis005');
define('DB_PASSWORD', 'Ab9kGN0Vts');
define('DB_NAME', 'ebis005');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Keine Verbindung hergestellt. " . mysqli_connect_error());}

?>
