<?php
include 'Database.php';

error_reporting(0);
session_start();

if(!isset($_SESSION["phone"])) {
    echo "<script>window.location = 'login.php'</script>";
}
//Send OTP
$phone = $_SESSION["phone"];
$otp = mt_rand(1000,9999);
$msg ="Enter your PIN for Mango CA Account activation.Your one time PIN is: ".$otp;
$message = urlencode($msg);
//echo "<script>alert('$phone')</script>";
//echo "<script>alert('$msg')</script>";

$_SESSION["otp"]=$otp;
$_SESSION["phone"]=$phone;

$url = "http://114.130.5.10:9333/ozeki?login=esign&password=esign_2021&action=sendMessages&messageCount=1&messageType0=GSM1MS&recepient0=$phone&messageData0=$msg";
$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_exec($ch);
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);                                   
//end Send OTP
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MangoCA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="dist/css/style.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>

<body>
  
    <div class="wrapper">
                <!-- Body -->
            <div class="card card-info" style="margin-left:100px; margin-right:100px;">
                <div class="card-body">
                    <div class="row">
                        <div class="hints"><i class="fas fa-check-circle"></i> Thank you for entering preliminary
                            enrollment
                            information.</div>
                    </div>
                    <div class="row">
                        <div class="thints">Pin validation</div>
                    </div>
                    <div class="row">
                        <div class="phints">You should receive a PIN number on your mobile that you've used during
                            registration.It is now registered with our Validation database.<br>

                            If you don't get the PIN on your mobile, Please click the below Resend SMS PIN button</div>
                    </div>

                    <div class="row">

                        <div class="col-sm-8">
                            <form class="form_design" action="pin_verify.php" method="post">
                                <div class="form-group row pb-2">
                                    <label for="staticphone" class="col-sm-4 col-form-label">Mobile Number : </label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="staticphone"
                                            value="<?php echo $phone ?>" >
                                    </div>
                                </div>
                                <div class="form-group row pb-2">
                                    <label for="inputpin" class="col-sm-4 col-form-label">Enter SMS Pin</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputpin" name="inputpin" placeholder="SMS Pin">
                                    </div>
                                </div>

                                <div class="form-group row pt-3">
                                    <div class="col-sm-4"></div>

                                    <div class="col-sm-8">
                                        <button class="btn btn-success mx-2" name="submit">Submit</button>
                                        <button class="btn btn-success" onclick="">Resend Pin</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="row pt-5">
                <footer class="main-footer">
                    <strong>Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved | This Website Made
                        <i class="icon-heart" aria-hidden="true"></i> by <a href="https://mangoca.com/"
                            target="_blank">MangoCA.com</a>
                </footer>
            </div>

     
        </div>


        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard.js"></script>

</body>

</html>