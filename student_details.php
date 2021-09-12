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
    <title>New Student Profile - E-Log Book</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/quill/dist/quill.snow.css">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link type="text/css" href="main_style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
    #studProfile input, #studProfile select{
height: 50px;
}

#studProfile input::placeholder {
    color: rgba(0, 0, 0, 0.3) !important;
}
#styled-head{
    background: #0c1db3 !important;
    color: rgba(255, 255, 255, 0.8);
}

.edit-tab{
    padding: 20px 0px;
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
                                                Student Details Has been entered Successfully. Click on either of the buttons to continue
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-secondary" href="manage-student">View Details</a>
                                                <a class="btn btn-primary" href="new-student">Enter new Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
                        <h4 class="page-title">Form Basic</h4>
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
                 <!-- ============================================================== -->
                <?php 
        $studDetails = $studPort->conn->query("select * from stud_profile where user_id = '" . $_GET['id'] . "'") or die($stud_profile->conn->error);
         $rowDetails = $studDetails->fetch_assoc();       
          $brk_name = explode(" ", $rowDetails["fullname"]);
                  ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                           <div class="col-lg-7">
                            
                            <form class="form-horizontal" method="post" action="login.php?action=Create student profile" id="studProfile">
                                <div class="card-body">
                                    <h4 class="card-title" style="padding: 30px 0;">Student Personal Info</h4>
                                    <div class="edit-tab">
                                     <!--   
                                <a href="edit-student-details?id=<?php echo $rowDetails["user_id"]; ?>" class="btn btn-primary">Edit <?php echo $rowDetails["fullname"]; ?> Details</a>
                            -->
                            </div>
                                    <div class="form-group row">
                                        <label for="regno" class="col-sm-3 text-right control-label col-form-label">Registeration Number </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="regno" readonly value="<?php echo $rowDetails["reg_no"]; ?>" name="regno" placeholder="Student Registeration Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" readonly value="<?php echo $brk_name[0]; ?>" name="fname" placeholder="First Name Here">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lname" readonly name="lname" value="<?php echo $brk_name[1]; ?>" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select name="gnder" id="gnder" class="form-control" disabled>
                                                <option value="Male" <?php echo $rowDetails["gnder"] == "Male" ? "selected" :  ""; ?> >Male</option>
                                                <option value="Female" <?php echo $rowDetails["gnder"] == "Female" ? "selected" :  ""; ?>> Female </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="dept" class="col-sm-3 text-right control-label col-form-label">Department</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="dept" readonly value="<?php echo $rowDetails["dept"]; ?>" name="dept" placeholder="Department">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lvl" class="col-sm-3 text-right control-label col-form-label">Level</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="lvl" id="lvl" disabled>
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
                                            <input type="text" class="form-control" id="phn_nmbr" readonly value="<?php echo $rowDetails["phn_nmbr"]; ?>" name="phn_nmbr" placeholder="Department">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="soo" class="col-sm-3 text-right control-label col-form-label">State of Origin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly id="soo" value="<?php echo $rowDetails["soo"]; ?>" name="soo" placeholder="State of Origin ">
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
    <script src="js/site.js"></script>
    
    <script type="text/javascript">
       /**
       $(document).ready(function(){
         $('#alertmodal').modal({
                backdrop:"static"
            });
       })
       **/
    </script>
    
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
    <!-- This Page JS -->
    <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="dist/js/pages/mask/mask.init.js"></script>
    <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>

<script>
    $(document).ready(function(){
        //fname lname dept lvl passwrd
      //Set password..
setPassword()
getLastName()
    })

    function setPassword(){
        $('#fname').bind("keypress", function(){
      
      var fname_txt = $(this).val()     
        var slicepaswrd = fname_txt.substring(0, 3).toLowerCase()
        
        $("#passwrd").attr('type', 'text')

          $("#passwrd").val(slicepaswrd)



        })
    
   $('#fname').bind("blur", function(){
              //set Password conetn visibility to Hidden after 4 secs
          setTimeout(function(){
         $("#passwrd").attr('type', 'password')
          }, 4000)
   })

    }

  function getLastName(){
  
   $('#lname').bind("blur", function(){
    var lname_txt = $(this).val()  
      var prev_passwrd =   $("#passwrd").val() 
        var slicepaswrd = lname_txt.substring(0, 3).toLowerCase()
        
        $("#passwrd").attr('type', 'text')

          $("#passwrd").val(prev_passwrd + slicepaswrd )


              //set Password conetn visibility to Hidden after 4 secs
          setTimeout(function(){
         $("#passwrd").attr('type', 'password')
          }, 3000)
   })      
  }  
</script>

</body>

</html>