<?php

include 'Database.php';

error_reporting(0);
session_start();

if (isset($_POST['submit'])){

    $otp=$_SESSION["otp"];
    $phone=$_SESSION["phone"];

    $given_otp=$_POST["inputpin"];

  

     if($otp == $given_otp)
     {
        $sql = "SELECT * FROM user_info WHERE Phone ='$phone'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
    
        $row  = $result->fetch_assoc();
    
        $_SESSION["uid"] = $row["ID"];
    
        $sql2 = "UPDATE user_info SET OTP = '$given_otp', Status= '1' WHERE Phone = '$phone'";
        $result2 = mysqli_query($conn, $sql2);
    
        echo "<script>window.location = 'login.php'</script>";
    
        }
     }
    }


else{
        echo "<script>alert('OTP Not Match.Please Try Again')</script>";
        echo "<script>window.location = 'pin_validation.php'</script>";
      }
   




?>
