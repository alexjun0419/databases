<?php
//configuration
$servername = "localhost";
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PWD", "");
define("DB_NAME", "aem");
//database connection
$mysqli = new mysqli($servername, DB_USER, DB_PWD, DB_NAME);
if($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
?>