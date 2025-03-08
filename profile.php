<?php
session_start();
  if(!isset($_SESSION['loggedinby_autoID'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIRD | Profile</title>
  <style>
    .error{
      color:red;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="images/sird_logo.png" alt="AdminLTELogo" height="100" width="100">
  </div>

  <!-- Navbar -->
  <?php include('header_nav.php'); ?>
  <!-- /.navbar -->

 <?php include('sidebar.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 card">
              <div class="card-header bg-primary w-100">Employee details</div>
              <div class="card-body">
              <div class="row">
                  <div class="col-lg-2">
                    <img src="images/emp/<?=$udetails['emp_no'];?>.jpg" alt="" class="img-thumbnail w-75">
                  </div>
                  <div class="col-lg-10">
                     
                    <table class="table table-striped">
                      <tr><td> <i class="fas fa-user text-primary mr-2" aria-hidden="true"></i>  <?=$udetails['emp_title'] ." ". $udetails['emp_name'];?></td></tr>
                      <tr><td> <i class="fas fa-medal text-primary mr-2" aria-hidden="true"></i>  <?=$udetails['emp_desig'];?></td></tr>
                      
                      <tr><td> <i class="fas fa-chalkboard-teacher text-primary mr-2" aria-hidden="true"></i> <?=$udetails['grp_name'];?> <i class="fas fa-chair text-primary mr-2 ml-4" aria-hidden="true"></i>  <?=$udetails['emp_sitting_place'];?> </td></tr>
                      <tr><td> <i class="fas fa-id-badge text-primary mr-2" aria-hidden="true"></i> <?=$udetails['emp_no'];?>  <i class="fas fa-desktop text-primary mr-2 ml-4" aria-hidden="true"></i>  <?=$udetails['emp_cc'];?> </td></tr>
                      <tr><td> <i class="fas fa-phone text-primary mr-2" aria-hidden="true"></i>  <?=$udetails['emp_extn'];?> </td></tr>
                      <tr><td> <i class="fas fa-envelope text-primary mr-2" aria-hidden="true"></i>  <?=$udetails['emp_o_email'];?> </td></tr>
                      
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary btn-sm get_details" id="<?=$udetails['autoID'];?>" data-toggle="modal" data-target="#updateInfoModal" ><i class="fas fa-edit " aria-hidden="true"></i> Update</button>
              </div>
            </div>
          </div>
<!-- Modal -->
<div class="modal fade" id="updateInfoModal" tabindex="-1" aria-labelledby="updateInfoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateInfoModaltitle">Update info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form name="frmInfo" id="frmInfo">
          <div class="row">
          <div class="col-lg-2">
              <div class="form-group">
                <label for="emp_title"> <i class="fas fa-user text-primary mr-2" aria-hidden="true"></i> Salutation</label>
                <select name="emp_title" id="emp_title" class="form-control">
                 <option value="Dr">Dr</option>
                 <option value="Shri">Shri</option>
                 <option value="Smt">Smt</option>
                 <option value="Kum">Kum</option>
                </select>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="form-group">
                <label for="emp_name"> <i class="fas fa-user text-primary mr-2" aria-hidden="true"></i> Name</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" readonly>
              </div>
            </div>
           </div>      
        <!-- row -->
        <div class="row">
        <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_no"> <i class="fas fa-id-badge text-primary mr-2" aria-hidden="true"></i> Emp. No.</label>
                <input type="text" class="form-control" id="emp_no" name="emp_no" readonly>
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_desig"> <i class="fas fa-desktop text-primary mr-2" aria-hidden="true"></i> CC No.</label>
                <input type="text" class="form-control" id="emp_cc" name="emp_cc" readonly>
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_desig"> <i class="fas fa-medal text-primary mr-2" aria-hidden="true"></i> Designation</label>
                <input type="text" class="form-control" id="emp_desig" name="emp_desig" readonly>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_sec"> <i class="fas fa-chalkboard-teacher text-primary mr-2" aria-hidden="true"></i> Section/Unit</label>
                <input type="text" class="form-control" id="emp_sec" name="emp_sec" readonly>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_sp"> <i class="fas fa-chair text-primary mr-2" aria-hidden="true"></i> Sitting place</label>
                <input type="text" class="form-control" id="emp_sp" name="emp_sp" >
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_email"> <i class="fas fa-envelope text-primary mr-2" aria-hidden="true"></i> Official Email</label>
                <input type="email" class="form-control" id="emp_email" name="emp_email">
              </div>
            </div>


           


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_phone"> <i class="fas fa-phone text-primary mr-2" aria-hidden="true"></i> Office Extn : </label>
                <input type="number" class="form-control" id="emp_phone" name="emp_phone">
              </div>
            </div>


           

            

        </div>
        <div class="row">
          <div class="col-lg-12 text-right">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
          </div>
        </div>
    </form>

        <!-- form -->
      </div>
      
    </div>
  </div>
</div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include ('footer.php');?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
  $(function () {
//alert("hello");
  
    $('[data-toggle="tooltip"]').tooltip();

    $(".get_details").click(function(){
     id=$(this).attr('id');
     //alert(id);
     $.ajax({
        type : 'post',
        url : 'get_profile.php',
        data: {operation:'get_details',emp:id},
        success : function(response){
          data = JSON.parse(response);
           //alert(data.emp_name);
           $("#emp_title").val(data.emp_title);
           $("#emp_name").val(data.emp_name);
           
           $("#emp_no").val(data.emp_no);
           $("#emp_desig").val(data.emp_desig);
           $("#emp_cc").val(data.emp_cc);
           $("#emp_sec").val(data.grp_name);
           $("#emp_sp").val(data.emp_sitting_place);
           $("#emp_email").val(data.emp_o_email);
           //$("#emp_oemail").val(data.emp_e_email);
           $("#emp_phone").val(data.emp_extn);
           //$("#emp_mobile").val(data.emp_mob);
           //$("#emp_shift").val(data.emp_shift_autoID);
        }
      });
    });

   

    $("#frmInfo").validate({
        
        rules: {
          emp_title:"required",
           emp_name:"required",
          
          emp_no:"required",
          emp_desig:"required",
          emp_cc:"required",
          emp_sec:"required",
          emp_sp:"required",
          emp_email: {
                required: true,
                email: true               
          },
          //emp_oemail:"required",
          emp_phone:{
            required:true,
            number: true
          }
          //emp_shift:"required",
        },
        messages: {
          emp_title:"Select title",
          emp_name:"Enter Name",
          
          emp_no:"Enter Emp. No.",
          emp_desig:"Emp. designation",
          emp_cc:"Enter CC No.",
          emp_sec:"Enter Section",
          emp_sp:"Enter sitting place",
          emp_email:"Enter Email",
          //emp_oemail:"Enter Email",
          emp_phone:"Enter valid Extn"
          //emp_shift:"Select shift",    
            },
            //errorPlacement: function(){
            //return false;  // suppresses error message text
        //},

            
        
        submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_profile.php',
        data : $("#frmInfo").serialize()+"&operation=updateprofile",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#saveBtn").html('Updating data ...');
},
    success : function(response){
      //alert(response);
        if(response == 0 ){
        $("#error").fadeIn(1000, function(){
        showtoasterror('There is some error!');
        $("#error").fadeOut();
        });
        }
        else {
         // location.reload();
         showtoast('Data updated successfully!');
          setTimeout(function () {
            location.reload();
                 }, 2000);
          
          }
    } 
});
        }
   
});

//show toast
function showtoasterror($msg){
    
    
    toastr.error($msg)
  }
  // show toast
  
  //show toast
function showtoast($msg){
    
    
    toastr.success($msg)
  }



  // show toast

    });
    </script>
</body>
</html>
