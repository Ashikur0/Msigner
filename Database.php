<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "mangoca0.1";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>