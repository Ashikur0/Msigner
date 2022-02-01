<?php
session_start();
include 'Database.php';

if(isset($_POST["email"]) && isset($_POST["password"]))
{
    $email_from_user =$_POST['email'];
    $password_from_user = $_POST['password'];
    
    
    
    $sql = "SELECT * FROM user_info WHERE (Email='$email_from_user') or(Phone='$email_from_user')";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {

        $row  = $result->fetch_assoc();

        $password_from_database = $row["Password"];
        $status =$row["Status"];
        //echo $status;
      
        
        if (password_verify($password_from_user,$password_from_database))
        {    
           if($status == 1){
            $_SESSION["uid"] = $row["ID"];
            echo "<script>window.location = 'index.php'</script>";
           }

           else{
            echo "<script>alert('Mobile Number is Not Verified')</script>";
           }
        }
         
        else{
            echo "<script>alert('Password Not Matched.')</script>";
            echo "<script>window.location = 'login.php'</script>";
        }
          
      }
   if ($email_from_user != $row["Email"]){
    echo "<script>alert('Email Not Found.Please SignUp')</script>";
    echo "<script>window.location ='register.php'</script>";
   }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MangoCA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="img/ca.png" alt=""></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Enter Email/Phone Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Enter Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
