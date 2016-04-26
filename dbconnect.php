<?php 

$server = "localhost";
$user = "root";
$pass = "password";
$database = "tech_store";

$conn = mysql_connect($server, $user, $pass) or die("Unable to connect to MySQL");
mysql_select_db($database, $conn);

?>