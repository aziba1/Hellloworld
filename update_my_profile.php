<?php 
session_start();
require('page_class.php');
$studPort = new Stud_portal();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>ELog Book - A Multiplatform for managing Siwes traiing program</title>
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    
    <link href="assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
    #studProfile label {
        padding-right: 30px;
    }
</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include 'student_header_sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
              <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                 <!-- ============================================================== -->
                <?php 
        $studDetails = $studPort->conn->query("select * from stud_profile where user_id = '" . $_SESSION['user_id'] . "'") or die($stud_profile->conn->error);
         $rowDetails = $studDetails->fetch_assoc();       
          $brk_name = explode(" ", $rowDetails["fullname"]);
                  ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                           <div class="col-lg-7">
                            
                            <form class="form-horizontal" method="post" action="login.php?action=Update student profile" id="studProfile">
                                <div class="card-body">
                                    <h4 class="card-title" style="padding: 30px 0;">Update Personal Info</h4>

                                    <div class="form-group row">
                                        <label for="regno" class="col-sm-3 text-right control-label col-form-label">Registeration Number </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="regno" readonly  value="<?php echo $rowDetails["reg_no"]; ?>" name="regno" placeholder="Student Registeration Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname"  value="<?php echo $brk_name[0]; ?>" name="fname" placeholder="First Name Here">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lname"  name="lname" value="<?php echo $brk_name[1]; ?>" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select name="gnder" id="gnder" class="form-control" >
                                                <option value="Male" <?php echo $rowDetails["gnder"] == "Male" ? "selected" :  ""; ?> >Male</option>
                                                <option value="Female" <?php echo $rowDetails["gnder"] == "Female" ? "selected" :  ""; ?>> Female </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="dept" class="col-sm-3 text-right control-label col-form-label">Age</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="age"  value="<?php echo $rowDetails["age"]; ?>" name="age" placeholder="Age">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="dept" class="col-sm-3 text-right control-label col-form-label">Department</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="dept" readonly  value="<?php echo $rowDetails["dept"]; ?>" name="dept" placeholder="Department">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lvl" class="col-sm-3 text-right control-label col-form-label">Level</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="lvl" id="lvl" >
                                                <option value="">--Select--</option>
                                                <option value="100"  <?php echo $rowDetails["lvl"] == "100" ? "selected" :  ""; ?>>100</option>
                                                <option value="200"  <?php echo $rowDetails["lvl"] == "200" ? "selected" :  ""; ?>>200</option>
                                                <option value="300" <?php echo $rowDetails["lvl"] == "300" ? "selected" :  ""; ?> >300</option>
                                                <option value="400" <?php echo $rowDetails["lvl"] == "400" ? "selected" :  ""; ?>>400</option>
                                                <option value="500" <?php echo $rowDetails["lvl"] == "500" ? "selected" :  ""; ?>>500</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phn_nmbr" class="col-sm-3 text-right control-label col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phn_nmbr"  value="<?php echo $rowDetails["phn_nmbr"]; ?>" name="phn_nmbr" placeholder="Department">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="soo" class="col-sm-3 text-right control-label col-form-label">State of Origin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"  id="soo" value="<?php echo $rowDetails["soo"]; ?>" name="soo" placeholder="State of Origin ">
                                        </div>
                                    </div>
                                    <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-block">Update Details</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                           </div>
                        </div>
                        
                    

                    </div>
            
                </div>
                <!-- editor -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
     <!-- this page js -->
    <script src="assets/libs/toastr/build/toastr.min.js"></script>
  
    <?php
   if(isset($_GET['msg'])){
    ?>
<script type="text/javascript">
    $(document).ready(function(){
        // Success Type
    toastr.success('Your Profile has been successfully Updated', 'Update Successful');
    })
</script>
    <?php
    } 
    ?>
</body>

</html>