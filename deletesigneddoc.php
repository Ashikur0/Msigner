<?php

session_start();

if(!isset($_SESSION["uid"])) {
    echo "<script>window.location = 'login.php'</script>";
}
include 'Database.php';

$id = $_GET['id'];

$sql = "DELETE FROM signed_documents WHERE ID=$id";
$result = mysqli_query($conn, $sql); 
echo "<script>window.location = 'list_signeddoc.php'</script>";

?>