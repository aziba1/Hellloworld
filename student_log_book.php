<?php 
session_start();
require('page_class.php');
$studPort = new Stud_portal();
//Output Functions 
include 'outputfunctn.php';
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
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
        <?php include 'admin_header_sidebar.php'; ?>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php 
                 $selStudDept = $studPort->conn->query("select * from assigned_supervisors order by entry_id DESC") or die($stud_profile->conn->error); 
           ?>
           
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Student Details Assigned Supervisor</h4>
                            </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Reg No:</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Level </th>
                                                <th scope="col"> No of Entries on Log Book </th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        if(!$selStudDept->num_rows){
                                         ?>

                                        <tbody class="customtable">
                                            <tr>
                                                <td colspan="6">No Department have been created</td>
                                            </tr>
                                        </tbody>
                                         <?php
                                        }else{
                                         $i = 0; 
                                       $nmbrcnts = $selStudDept->num_rows;  
                                        while($rowStudDept = $selStudDept->fetch_array()){  
                                         $i++;
                                        $selStud = $studPort->conn->query("select * from stud_profile where user_id = '" . $rowStudDept['stud_id'] . "'") or die($stud_profile->conn->error); 
                                        $rowStud = $selStud->fetch_assoc();
                                        
                                        $selSupr = $studPort->conn->query("select * from staff_profile where user_id = '" . $rowStudDept['staff_id'] . "'") or die($stud_profile->conn->error); 
                                        $rowSupr = $selSupr->fetch_assoc();
                                          
                                          $selEntries = $studPort->conn->query("select * from logbook_event where user_id = '" . $rowStudDept['stud_id'] . "'") or die($stud_profile->conn->error);
                                         
                                         $numEntries = $selEntries->num_rows;
                                         ?>
                                           <tbody class="customtable">
                                            <tr>
                                               <th><?php echo $i; ?></th>
                                               <td><?php echo $rowStud["reg_no"]; ?></td>
                                               <td><?php echo $rowStud["fullname"]; ?></td>
                                               <td><?php echo $rowStud["dept"]; ?></td>
                                                <td><?php echo $rowStud["lvl"]; ?> </td>
                                                <td> <?php echo $numEntries; ?></td>
                                                <td><a href="view-students-logbook?id=<?php echo $rowStudDept['stud_id']; ?>"><i class="mdi mdi-book-open-page-variant" style="font-size: 1.6em"></i></a> </td>
                                            </tr>
                                        </tbody>
                                         <?php
                                        }
                                    }
                                        ?>
                                       
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>


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

</body>

</html>