<?php 

include 'Database.php';

error_reporting(0);

session_start();

if (isset($_POST['submit'])) {
  $name=$_POST['Name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['confirm_password'];
  //$pass = password_hash($password, PASSWORD_BCRYPT);
	$phone = $_POST['phone'];


	if ($password == $cpassword) {
    $stored_pass = password_hash($password, PASSWORD_DEFAULT);
		$sql = "SELECT * FROM user_info WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {

			$sql = "INSERT INTO user_info ( Name,Email, Phone,Password,OTP,Status )
					VALUES ( '$name','$email', '$phone' , '$stored_pass', '0', '0')";

			$result = mysqli_query($conn, $sql);
      
      $_SESSION["phone"] = $phone;

			if ($result) {
				//echo "<script>alert('Wow! User Registration Completed.')</script>";

        echo "<script>window.location = 'pin_validation.php'</script>";
			} 
      else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} 
    else {
     
      
			echo "<script>alert('Woops! Email Already Exists.Try another Email Address or Login to existing Account')</script>";
		}
		
	} 
  
  else {
		echo "<script>alert('Password Not Matched.')</script>";
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="login.php"><img src="img/ca.png" alt=""></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
        <input type="text" class="form-control" name="Name" placeholder="Full Name" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" name="confirm_password" placeholder="Retype Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
        <input type="text" class="form-control" name="phone" placeholder="Mobile Number" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
