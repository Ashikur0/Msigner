<?php

session_start();

if(!isset($_SESSION["uid"])) {
    echo "<script>window.location = 'login.php'</script>";
}
include 'Database.php';


$uid =$_SESSION["uid"];

$docid=$_GET["docid"];

 $qry ="select * from unsigned_documents where ID = $docid ";

 $result = mysqli_query($conn, $qry);

 if ($result->num_rows > 0) {

    $row  = $result->fetch_assoc();
 }
 
 $_SESSION['doc']= $row['documents'];

 echo "<script>window.location = 'signdoc.php'</script>";

?>
