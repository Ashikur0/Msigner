<?php
include "database.php";
session_start();
$id = $_SESSION['uid'];
$db = mysqli_connect("localhost","root","","mangoca0.1");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
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
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/profile.css">
</head>

<body class="hold-transition UserProfile-page">
    <div class="UserProfile-box">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Logout -->
                <li class="nav-item">
                    <form action="logout.php" method="post"><button type="submit"
                            class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class=" mt-3 pb-3 mb-3 d-flex">
                    <div class="calogo">
                        <a href="#"> <img src="img/ca.png" class="calogo" alt="User Image"></a>
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

        <?php

            $qry ="select * from user_info where ID='$id'"; // select query
            $result = mysqli_query($conn, $qry);

            if ($result->num_rows > 0) {

                $row  = $result->fetch_assoc();

            }

            if(isset($_POST['submit'])) // when click on Update button
            {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            
          
          
	         $sql = "UPDATE user_info set Name='$name', Email='$email' ,Phone='$phone' Where ID='$id' ";
           // $edit = mysqli_query($db,"update user_ set name='$name', email='$email', passowrd='$password', phone='$phone', where id='$id'");
           $result = mysqli_query($conn, $sql);

          
            
            if($result)
        {
            echo "<script>alert('Data Updated')</script>";
                  echo "<script>window.location ='UserProfile.php'</script>";
    }else{
            echo 'Data Not Updated';
        }
            mysqli_close($connect);
        }

    ?>
        <div class="content-wrapper">

            <!--End Profile Form -->

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="150px"
                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                                class="font-weight-bold"><?php echo $row['Name']; ?></span><span
                                class="text-black-50"><?php echo $row['Email']; ?></span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group row">
                                    <div class="col-md-12">

                                        <label class="labels">Name</label>
                                        <input type="text" readonly class="form-control-plaintext"
                                            value="<?php echo $row['Name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="labels">Email</label>
                                        <input type="text" readonly class="form-control-plaintext"
                                            value="<?php echo $row['Email']; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="labels">Mobile Number</label>
                                        <input type="text" readonly class="form-control-plaintext"
                                            value="<?php echo $row['Phone']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button"
                                    type="button">Edit
                                    Profile</button></div>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End Profile Form -->
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js">
    < /> < /
    body > <
        /html>