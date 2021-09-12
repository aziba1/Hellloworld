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
    <title>Assign Supervisor - Elog Book</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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

<!-- Alert Modal for page -->
             <div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" id="styled-head">
                                                <h5 class="modal-title" id="exampleModalLabel">E-logbook</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="modal_txt">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                 <a class="btn btn-secondary" href="?id=<?php echo $_GET['id']; ?>&fd=assign">Continue</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
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
                        <h4 class="page-title">Tables</h4>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php 
                 $selStudDept = $studPort->conn->query("select * from assigned_supervisors where dept = '" . $_GET['id'] . "' order by entry_id DESC") or die($stud_profile->conn->error); 
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
                                                <th scope="col">Level </th>
                                                <th scope="col">Siwes Supervisor </th>
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

                                         ?>
                                           <tbody class="customtable">
                                            <tr>
                                               <th><?php echo $i; ?></th>
                                               <td><?php echo $rowStud["reg_no"]; ?></td>
                                               <td><?php echo $rowStud["fullname"]; ?></td>
                                                <td><?php echo $rowStud["lvl"]; ?> </td>
                                                <td><?php echo $rowSupr["fullname"]; ?></td>
                                                <td></td>
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
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
     <script type="text/javascript">
         $(document).ready(function(){
            $('select#supervsr').bind("change", function(){
               var supervsr_id = $(this).val()
               var index_no = $(this).attr('rel')
               var studID = $("#studID_" + index_no).val();
                //alert(supervsr_id + " " + studID + " " + index_no);
               assignsupervisor(studID, supervsr_id);
                return false; 
            })
         })

         function assignsupervisor(studID, staffID){
            $.ajax({
    type: "POST",
    url: "login.php?action=Assign supervisor",
    data: "studID="+studID + "&staffID="+staffID,
    statusCode: {
    404: function(responseObject, textStatus, jqXHR) {
    alert('Error 404, please no page was found')
    },
    503: function(responseObject, textStatus, errorThrown) {
    alert(textStatus)
    }
    },
    beforeSend: function(){
       $('#btnReg').html('Please wait.....');
     },
    success: function(data) {
    if(data != 0){
    alert(data)
    $('#modal_txt').html("Student has been successfully assigned a supervisor. ")
        $('#alertmodal').modal({
                backdrop:"static"
            });
      //window.location="home?msg=successfull. ";
    }else{
   $('#errorMsg_reg').show();
   $('#errorMsg_reg').removeClass()
   $('#errorMsg_reg').addClass("alert alert-danger")
   $('#errorMsg_reg').html('Could not create your profile');  
    $('#btnReg').html('Create Accouunt');
         }
       },
   complete: function(){
     
      },
    error: function(error) {
    alert('Error submiting the form Error is given as:'+ error);
    }
    });   
         }
     </script>

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
       

    </script>

</body>

</html>