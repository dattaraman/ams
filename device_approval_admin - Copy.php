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
  <title>SIRD | [ADMIN] Device Approval</title>
  <style>
  .error{color:#ff0000;}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
            <h1 class="m-0">[ADMIN] Device Approval</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">[ADMIN] Device Approval</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
              </div>
              <!-- /.card-header -->
              <div class="toastctrl"></div>

             

              <div class="form-group" >
                          <label for="sel_asset">Select asset</label><br>
                          <select class="form-control select1" id="sel_asset" style="width: 100%;" name="sel_asset">
                          
                         
                            <option value="pc">PC</option>
                            <option value="device">Printer/Scanner/MFD</option>
                          
                          </select></div>



<hr>
              <div class="card-body" id="showtable"></div>
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('footer.php');?>
  <script>
  $(function () {

    $("body").on("click", ".open_action", function (e) {
      //alert($(this).data('id'));
      //removePersonalPC($(this).data('id'));      
      $("#delid").val($(this).data('id'));
    });

    $("#deleteBtn").click(function(){
      adminapprovepc($("#delid").val());
    });

    

    $("#sel_asset").change(function() {
      //alert("Hello");
      if($("#sel_asset").val()=='pc'){
        getallpcofusers();
      }else{
      getalldeviceofusers();
      }
        });


    function adminapprovepc(id){
      $.ajax({
        type : 'post',
        url : 'get_device_approval_admin.php',
        data: {operation:'approve_pc',forid : id},
        beforeSend: function(){
        $("#deleteBtn").html('Updating data ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            getallpcofusers();
            showtoast("[Admin] approval marked successfully!");
            $("#modal_action").modal('hide');
            $("#delid").val('');
            $("#deleteBtn").html("Approve");
            getallpcofusers();

          }else{
            showtoast("Internal server error!");
          } 
        }
    });

    }


    $('[data-toggle="tooltip"]').tooltip();

    getallpcofusers();
    
    

    function getalldeviceofusers(){
     
     $.ajax({  
     url: "get_device_approval_admin.php",
     type: "POST",
     data: {operation:"alllistdevice"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
       //console.log(response);
       $("#showtable").html(response);
        $("#example12").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          buttons: ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example12_filter');
        $("#example12_wrapper .col-md-6:eq(0)").append(btns);      
     }
   });
   

   }



  
    function getallpcofusers(){
     
      $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"alllist"},beforeSend: function(){
        $(".toastctrl").fadeOut();
      
      },
      success: function(response){
        //console.log(response);
        $("#showtable").html(response);
        $("#example12").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          buttons: ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example12_filter');
        $("#example12_wrapper .col-md-6:eq(0)").append(btns);    
      }
    });
    

    }

    
    //show toast
    function showtoast($msg){
    
    
      toastr.success($msg)
    }
    // show toast

  


    
    
  });
  
</script>



    <!-- modal delete -->
<div class="modal fade" id="modal_action">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Approve PC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                      
                         <h4>Are you sure?</h4>
                          <input type="hidden" class="form-control" readonly required="required" id="delid" name="delid" >
                        </div>    
                      </div>
                      
                    </div>    
                <div class="modal-footer">
              
                <button type="button" class="btn btn-success" id="deleteBtn">Approve</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                  
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal delete->

      
    




      </body>
</html>
