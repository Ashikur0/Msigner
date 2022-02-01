<?php

session_start();
if(!isset($_SESSION["uid"])) {
    echo "<script>window.location = 'login.php'</script>";
}
include 'Database.php';
error_reporting(0);

$uid = $_SESSION["uid"];

$sql = "DELETE  from certificate_info where UID = '$uid'";

$sql2 = "DELETE from vault where UID = '$uid'";
$result = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql2);


echo "<script>alert('Certificate Deleted Successfully.')</script>";
echo "<script>window.location = 'index.php'</script>";


?>