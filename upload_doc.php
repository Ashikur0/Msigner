<?php

session_start();
if(!isset($_SESSION["uid"])) {
    echo "<script>window.location = 'login.php'</script>";
}
include 'Database.php';
error_reporting(0);

$uid = $_SESSION["uid"];

$profile_qry ="select * from user_info where ID='$uid'"; // select query
            $result = mysqli_query($conn, $profile_qry);

            if ($result->num_rows > 0) {

                $row  = $result->fetch_assoc();

            }

if (isset($_POST['submit'])){

    if(isset($_FILES['pdf']['name'])){
        $pdf =$_FILES['pdf']['name'];
        $tmp=$_FILES['pdf']['tmp_name'];
        $path="files/documents/".$pdf;
        $ext=explode(".",$pdf);
        $cn=count($ext);
     
        if ($ext[$cn-1]=='pdf'){
     
        move_uploaded_file($tmp,$path);
        }
     
        else{
         echo "<script>alert('Document Upload Failed')</script>";
        } 
    }

     $sql = "INSERT INTO unsigned_documents ( UID,documents) 
      VALUES ( '$uid', '$pdf')";
  
     $result = mysqli_query($conn, $sql);

     
     $_SESSION['doc'] = $pdf;

     echo "<script>alert('Document Uploaded Successfully')</script>";
     echo "<script>window.location = 'list_unsigndoc.php'</script>";
}


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


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Home -->
                <a href="UserProfile.php" class="nav-link">
                    <i class="nav-icon fas fa-user">
                        <?php echo $row["Name"]?>
                    </i>
                </a>

                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <form action="logout.php" method="post"><button type="submit"
                            class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class=" mt-3 pb-3 mb-3 d-flex">
                    <div class="calogo">
                        <a href="index.php"> <img src="img/ca.png" class="calogo" alt="User Image"></a>
                    </div>

                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-5">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-home "></i>
                                <p class="text">Home</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="list_unsigndoc.php" class="nav-link">
                                <i class="nav-icon far fa-file-pdf"></i>
                                <p class="text">Pending Documents</p>
                            </a>
                        </li>

                        
                        <li class="nav-item">
                            <a href="list_signeddoc.php" class="nav-link">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p class="text">Signed Documents</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="browse_certificate.php" class="nav-link">
                                <i class="nav-icon fas fa-upload "></i>
                                <p class="text">Browse Certificate</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="upload_doc.php" class="nav-link">
                                <i class="nav-icon fas fa-file-upload"></i>
                                <p class="text">Upload Documents</p>
                            </a>
                        </li>



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Body -->
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-3"></div>


                    <div class="col-md-6 mt-6">

                        <h2
                            style="color: rgb(146, 202, 228); margin-bottom: 20px; margin-top: 50px;  text-align: center;">
                            Upload your Documents </h2>

                        <form action="#" method="post" enctype="multipart/form-data">

                            <div class="form-group files">

                                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">

                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" name="submit">
                                    Upload </button>
                            </div>

                        </form>
                    </div>

                    <div class="col-md-3"></div>
                </div>


            </div>
            <!--modal-->
            <div class="row pt-5">
                <footer class="main-footer">
                    <strong>Copyright &copy;
                        <script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | This Website Made
                        <i class="icon-heart" aria-hidden="true"></i> by <a href="https://mangoca.com/"
                            target="_blank">MangoCA.com</a>
                </footer>
            </div>

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