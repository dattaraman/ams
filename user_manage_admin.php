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
  <title>SIRD | User Management</title>
  
  <style>
    .error{
      color:red;
    }
   
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
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
            
              <!-- <h3 class="card-title float-right"><button class="btn btn-app bg-warning"  data-toggle="modal" data-target="#modal_add">
                  <i class="fas fa-street-view"></i> Add employee
              </button></h3> -->
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h6 class="text-right text-sm text-danger">Employees are sorted as per their employee number</h6>
                <div class="row" id="showtable"></div>
                  <hr>
               
              </div><!-- /.card-body -->              
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
    <!-- /.content -->
  </div>

   <!-- modal rights -->
<div class="modal fade" id="modal_add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Add employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                <form name="frmInfo" id="frmInfo">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="emp_name"> <i class="fas fa-user text-primary mr-2" aria-hidden="true"></i> Name</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" >
              </div>
            </div>
           </div>      
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="emp_dob"> <i class="fas fa-birthday-cake text-primary mr-2" aria-hidden="true"></i> DOB</label>
                <input type="text" class="form-control" id="emp_dob" name="emp_dob" >
              </div>
            </div>
           </div>      
        <!-- row -->
        <div class="row">
        <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_no"> <i class="fas fa-id-badge text-primary mr-2" aria-hidden="true"></i> Emp. No.</label>
                <input type="text" class="form-control" id="emp_no" name="emp_no" >
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_desig"> <i class="fas fa-desktop text-primary mr-2" aria-hidden="true"></i> CC No.</label>
                <input type="text" class="form-control" id="emp_cc" name="emp_cc" >
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label for="emp_desig"> <i class="fas fa-medal text-primary mr-2" aria-hidden="true"></i> Designation</label>
                <input type="text" class="form-control" id="emp_desig" name="emp_desig" >
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_sec"> <i class="fas fa-chalkboard-teacher text-primary mr-2" aria-hidden="true"></i> Section/Unit</label>
                <input type="text" class="form-control" id="emp_sec" name="emp_sec" >
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
                <label for="emp_oemail"> <i class="fab fa-google text-primary mr-2" aria-hidden="true"></i> Other email</label>
                <input type="email" class="form-control" id="emp_oemail" name="emp_oemail">
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_phone"> <i class="fas fa-phone text-primary mr-2" aria-hidden="true"></i> Office Tel : </label>
                <input type="text" class="form-control" id="emp_phone" name="emp_phone">
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label for="emp_mobile"> <i class="fas fa-mobile-alt text-primary mr-2" aria-hidden="true"></i> Mobile</label>
                <input type="text" class="form-control" id="emp_mobile" name="emp_mobile">
              </div>
            </div>


            <div class="col-lg-12">
              <div class="form-group">
                <label for="emp_shift"> <i class="fas fa-clock text-primary mr-2" aria-hidden="true"></i> Work Shift</label>
                <select name="emp_shift" id="emp_shift" class="form-control">
                  <?php  foreach ($getallshift as $s){
                    echo "<option value='".$s['autoID']."'>".$s['shift_name']." [".$s['shift_start']." - ".$s['shift_end']."]</option>";
                  }?>
                </select>
              </div>
            </div>

        </div>
        <div class="row">
          <div class="col-lg-12 text-right">
          <button type="button" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  
                <div class="modal-footer">
              
             
              </div>
                  
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal rights -->

      

  <div class="modal fade" id="modalManage">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">User/Asset Management</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><span class="fas fa-user"></span> Employee details</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Devices</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Access rights</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pwd_activate-tab" data-toggle="tab" href="#pwd_activate" role="tab" aria-controls="pwd_activate" aria-selected="false">Activation & Password</a>
                          </li>
                          
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <hr>
                            <div class="row">
                              <div class="col-lg-2">
                                  <img src="" alt="" class="rounded w-100" id="emp_image">
                              </div>
                              <div class="col-lg-10">
                                  <div class="row">
                                    <div class="col-lg-12 text-primary"><span id="emp_name"></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-10">
                                    <input type="hidden" id="emp_no" name="emp_no">
                                    <select class="form-control select2 float-right" id="emp_group" style="width: 100%;" name="emp_group">
                                      <?php foreach ($row_allgroups as $group){ ?>
                                        <option value="<?=$group['autoID'];?>"><?=$group['grp_name'];?></option>
                                      <?php } ?>
                                    </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-4 text-muted"><span class="fas fa-award"></span> <input type="text" name="c_emp_desig" id="c_emp_desig" size="10"></div>
                                    <div class="col-lg-3 text-muted" id="c_extn"><span class="fas fa-phone-alt"></span> <span id="emp_extn"></span></div>
                                    <div class="col-lg-4 text-muted" id="c_email"><span class="fas fa-envelope">(o)</span> <span id="emp_o_email"></span></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-12 text-muted" id="c_sitting_place"><span class="fas fa-chair"></span> <span id="emp_sitting_place"></span></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6 text-muted" id="c_mobile"><span class="fas fa-mobile"></span> <span id="emp_mob"></span></div>
                                    <div class="col-lg-6 text-muted" id="c_e_email"><span class="fas fa-envelope">(e)</span> <span id="emp_e_email"></span></div>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-lg-12 text-right">
                                <button type="button" class="btn btn-primary" id="emp_updateBtn">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- user devices -->
                            <hr>
                            <input type="hidden" id="temp_uid">
                            <div class="row" id="show_user_devices"></div>
                            <div class="row" id="show_user_devices_printer"></div>
                            <!-- user devices -->
                            <hr>
                            <div class="row">
                              <div class="col-lg-12 text-right">
                             
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- rights -->
                             <hr>
                            <div class="row" id="show_user_rights"></div>
                            <hr>
                            <div class="row">
                              <div class="col-lg-12 text-right">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            <!-- rights -->
                          </div>


                          <div class="tab-pane fade" id="pwd_activate" role="tabpanel" aria-labelledby="pwd_activate-tab">
                            <!-- rights -->
                             <hr>
                            <div class="row" id="activation_password"></div>
                            <div class="row" id="activation_password_1"></div>
                            <hr>
                            <div class="row">
                              <div class="col-lg-12 text-right">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            <!-- rights -->
                          </div>


                         




                        </div>
                <div class="modal-footer">
               
              </div>
                  
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  
 <!-- /.modal-approve -->

<!-- modal_move -->
<div class="modal fade" id="modal_move">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Move to inventory</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                <h5>Are you sure?</h5>
                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <input type="hidden" class="form-control" readonly required="required" id="pcid" name="pcid" >
                        </div>  
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-12 col-6">
                      <div class="form-group">
                                        <label for="move_remark">Remarks(if any)</label>
                            <textarea class="form-control" id="move_remark" name="move_remark" ></textarea>
                        </div>                 
                      </div>
                    </div>   
                <div class="modal-footer">
              
                <button type="button" class="btn btn-danger" id="YesBtn">Yes</button>
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
      <!-- / modal_move->


<!-- modal_move -->
<div class="modal fade" id="modal_move_printer">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Move to inventory</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                <h5>Are you sure?</h5>
                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <input type="hidden" class="form-control" readonly required="required" id="deviceid" name="deviceid" >
                        </div>  
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-12 col-6">
                      <div class="form-group">
                                        <label for="move_remark_printer">Remarks(if any)</label>
                            <textarea class="form-control" id="move_remark_printer" name="move_remark_printer" ></textarea>
                        </div>                 
                      </div>
                    </div>   
                <div class="modal-footer">
              
                <button type="button" class="btn btn-danger" id="YesBtn_printer">Yes</button>
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
      <!-- / modal_move_printer->




     


     
  <!-content-wrapper -->
 <?php include ('footer.php');?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(function () {

  
    $('[data-toggle="tooltip"]').tooltip();
     getallusers();

     $("#YesBtn").click(function(){
      pc_move_inventory($("#pcid").val(),$("#move_remark").val());
      //alert($("#pcid").val());
    });

    $("#YesBtn_printer").click(function(){
      device_move_inventory($("#deviceid").val(),$("#move_remark_printer").val());
      //alert($("#deviceid").val());
    });

    function pc_move_inventory(id,rem){
      var emp = $("#temp_uid").val();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'move_pc_inventory',forid:id, foremp:emp, rem:rem},
        beforeSend: function(){
        $("#YesBtn").html('Updating ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            getempdevicedetails($("#temp_uid").val());
            showtoast("PC moved to inventory!");
            $("#modal_move").modal('hide');
            $("#pcid").val('');
            $("#YesBtn").html("Yes");
           

          }else{
            showtoast("Internal server error!");
          } 
        }
    });

    }


    function device_move_inventory(id,rem){
      var emp = $("#temp_uid").val();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'move_device_inventory',forid:id, foremp:emp, rem:rem},
        beforeSend: function(){
        $("#YesBtn").html('Updating ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            getempdevicedetails_printer($("#temp_uid").val());
            showtoast("Device moved to inventory!");
            $("#modal_move_printer").modal('hide');
            $("#deviceid").val('');
            $("#YesBtn_printer").html("Yes");
           

          }else{
            showtoast("Internal server error!");
          } 
        }
    });

    }

    
    $("body").on("click", ".move_invent", function (e) {
      //alert($(this).data('pcid'));      
      $("#pcid").val($(this).data('pcid'));
     
    });

    $("body").on("click", ".move_invent_printer", function (e) {
      //alert($(this).data('pcid'));      
      $("#deviceid").val($(this).data('deviceid'));
     
    });
    
    function getallusers(){
     
      $.ajax({  
      url: "get_user_manage_admin.php",
      type: "POST",
      data: {operation:"alllist"},
      success: function(response){
        //console.log(response);
        $("#showtable").html(response);
        
        
      }
    });
    

    }
    //show toast
     function showtoast($msg){
    toastr.success($msg)
    }
  // show toast

   //show toast
   function showtoasterror($msg){
    toastr.error($msg)
    }
  // show toast


  $("body").on("click", ".getdetails", function (e) {
     id=$(this).data('id');
     
     //alert(uid);
     getempdetails(id);
     getempdevicedetails(id);
     getempdevicedetails_printer(id);
     getemprightsdetails(id);
     getempactivation(id);
    });

    
    $("body").on("click", ".onoffswitch", function (e) {
      
      var id = $(this).attr("id");
      var emp = $(this).data('foremp');
        if($(this).is(":checked")) {
         //alert(id);
        set_permission(id,emp);
        }
        else{ 
          //alert("unchecked");
          //alert(id);
          unset_permission(id,emp);
        }
        
                
    });

    $("body").on("click", ".onoffswitch_active", function (e) {
      
     
      var emp = $(this).data('userid');
      if($(this).is(":checked")) {
         //alert(id);
        activate_user(emp);
        }
        else{ 
          in_activate_user(emp);
        }
         
    });

    function in_activate_user(emp){
      $.ajax({  
     url: "get_user_manage_admin.php",
     type: "POST",
     data: {operation:"inactive",emp:emp},
     success: function(response){
       //alert(response);
       if(response ==1){
        showtoast("Status updated for selected user!");
       }else{
        showtoasterror("Unable to update!")
       }
       
     }
   });
    }

    function activate_user(emp){
      $.ajax({  
     url: "get_user_manage_admin.php",
     type: "POST",
     data: {operation:"active",emp:emp},
     success: function(response){
       //alert(response);
       if(response ==1){
        showtoast("Status updated for selected user!");
       }else{
        showtoasterror("Unable to update!")
       }
       
     }
   });
    }

   

    function unset_permission(id,foremp){
     
     $.ajax({  
     url: "get_user_manage_admin.php",
     type: "POST",
     data: {operation:"unset",id:id,foremp:foremp},
     success: function(response){
       //alert(response);
       if(response ==1){
        showtoast("Menu access updated for selected user!");
       }else{
        showtoasterror("Unable to update!")
       }
       
     }
   });
   

   }

   function set_permission(id,emp){
     
     $.ajax({  
     url: "get_user_manage_admin.php",
     type: "POST",
     data: {operation:"set_menu",id:id,emp:emp},
     success: function(response){
       //alert(response);
       if(response ==1){
        showtoast("Menu access updated for selected user!");
       }else{
        showtoasterror("Unable to update!")
       }
       
     }
   });
   

   }

  
    

    function getempdetails(id){
          $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'get_all_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data);
          $("#emp_no").val(data.emp_no);
          $("#emp_name").html(data.emp_name);
          $("#emp_image").attr("src","images/emp/"+data.emp_no+".jpg");
          $("#c_emp_desig").val(data.emp_desig);
          if(data.emp_extn==""){$("#c_extn").hide();}else{$("#emp_extn").html(data.emp_extn);$("#c_extn").show();}
          if(data.emp_o_email==""){$("#emp_o_email").hide();}else{$("#emp_o_email").html(data.emp_o_email);$("#emp_o_email").show();}
          if(data.emp_e_email==""){$("#emp_e_email").hide();}else{$("#emp_e_email").html(data.emp_e_email);$("#emp_e_email").show();}
          if(data.emp_mob==""){$("#c_mobile").hide();}else{$("#emp_mob").html(data.emp_mob);$("#c_mobile").show();}
          if(data.emp_sitting_place==""){$("#c_sitting_place").hide();}else{$("#emp_sitting_place").html(data.emp_sitting_place);$("#c_sitting_place").show();}
          $("#emp_group").val(data.emp_grp_autoID);
        }
      });
    }

    function getempdevicedetails(id){
      $("#temp_uid").val(id);
      $('#show_user_devices').empty();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'get_all_devices_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //$("#show_user_devices").html(data);
        var s="";
        var osof = "";
        var iconvar = "";
          for (var i = 0; i < data.length; i++) {  
            osof = data[i].os_of;
            osof_lower = osof.toLowerCase();
            if(data[i].pc_form=='laptop'){iconvar = 'laptopicon'}else{iconvar = 'pcicon'}
                   s += ' <div class="col-md-6">'+
                            '<div class="card card-widget widget-user-2">'+
                                '<div class="widget-user-header bg-dark">'+
                                    '<div class="widget-user-image"><img class="" src="images/'+iconvar+'.png" alt="PC"></div>'+
                                        '<h3 class="widget-user-username text-sm w-50" style="max-height:100px;">'+ data[i].pc_make +' / ' + data[i].pc_processor_details +'<span class="float-right"></span></h3>'+
                                '</div>'+
              '<div class="card-footer p-0">'+
                '<ul class="nav flex-column text-primary">'+
                   '<li class="nav-item listitem">'+
                    '<span class="nav-link">'+' <span class="fab fa-'+osof_lower+ ' mr-1"></span>'+
                    data[i].os_name+
                    '<span class="float-right"><span class="fas fa-ruler-vertical mr-1"></span> '+ data[i].pc_ram_value + ' GB'+'</span>'+
                      '</span>'+
                    '</li>'+
                    '<li class="nav-item listitem">'+
                        '<span class="nav-link">'+
                        '<span class="fas fa-wifi mr-1"></span>' + data[i].pc_ip +
                        '<span class="float-right"><span class="fas fa-microchip mr-1"></span> '+ data[i].pc_bit_type +'</span>'+
                        '</span>'+
                    '</li>'+
                    '<li class="nav-item listitem">'+
                        '<span class="nav-link">'+
                        '<span class="fas fa-chair"></span> ' + data[i].pc_location +
                        '<span class="float-right"><span class="fas fa-shopping-cart mr-1"> </span>' + data[i].pc_source +'</span>'+
                        '</span>'+
                    '</li>'+
                    '<li class="nav-item listitem text-center">'+
                        '<span class="nav-link">'+
                        '<button class="btn btn-primary btn-sm move_invent" data-pcid = "'+data[i].autoID+'" data-toggle="modal" data-target="#modal_move"><span class="fas fa-truck-loading"></span>  Move to inventory</button>'+
                        '</span>'+
                    '</li>'+
                '</ul></div>'+
              '</div>'+
            '</div>'+
        '</div>';
               } 
                    $('#show_user_devices').append(s);
        }
      });
    }

    function getempdevicedetails_printer(id){
      $("#temp_uid").val(id);
      $('#show_user_devices_printer').empty();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'get_all_devices_details_printer',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //$("#show_user_devices").html(data);
          var s="";
          for (var i = 0; i < data.length; i++) {  
          
                   s += ' <div class="col-md-6">'+
                            '<div class="card card-widget widget-user-2">'+
                                '<div class="widget-user-header bg-dark">'+
                                    '<div class="widget-user-image"><img class="" src="images/'+data[i].device+'icon'+'.png" alt="Device"></div>'+
                                        '<h3 class="widget-user-username text-sm w-50" style="max-height:100px;">'+ data[i].device_make +' / ' + data[i].device_model +'<span class="float-right"></span></h3>'+
                                '</div>'+
              '<div class="card-footer p-0">'+
                '<ul class="nav flex-column text-primary">'+
                   '<li class="nav-item listitem">'+
                    '<span class="nav-link">'+' <span class="fas fa-file mr-1"></span>'+
                    data[i].device_tone+ '</li>'+
                    '<li class="nav-item listitem">'+
                        '<span class="nav-link">'+
                        '<span class="fas fa-atom mr-1"></span>' + data[i].device_barc_asset_id +
                        
                        '</span>'+
                    '</li>'+
                    '<li class="nav-item listitem">'+
                        '<span class="nav-link">'+
                        '<span class="fas fa-tools"></span> ' + data[i].device_amc_id +
                        '</span>'+
                    '</li>'+
                    '<li class="nav-item listitem text-center">'+
                        '<span class="nav-link">'+
                        '<button class="btn btn-primary btn-sm move_invent_printer" data-deviceid = "'+data[i].autoID+'" data-toggle="modal" data-target="#modal_move_printer"><span class="fas fa-truck-loading"></span>  Move to inventory</button>'+
                        '</span>'+
                    '</li>'+
                '</ul></div>'+
              '</div>'+
            '</div>'+
        '</div>';
               } 
                    $('#show_user_devices_printer').append(s);
        }
      });
    }


    function getemprightsdetails(id){
      $('#show_user_rights').empty();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'get_all_rights_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          
        var s="";
        s += ' <div class="col-md-12">';
          for (var i = 0; i < data.length; i++) {  
            //s += '<h5>'+ data[i].menu_name + '</h5>';
            if(data[i].cond == 0){
              s += '<div class="form-group"><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input type="checkbox" class="onoffswitch custom-control-input" id="'+data[i].autoID+'" data-foremp="'+id+'"> <label class="custom-control-label" for="'+data[i].autoID+'"><span class="'+data[i].menu_icon+'"></span> '+ data[i].menu_name + ' [ '+data[i].menu_group +' ]</label>       </div>    </div>';
            }else{
              s += '<div class="form-group"><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input type="checkbox" class="onoffswitch custom-control-input" id="'+data[i].autoID+'" data-foremp="'+id+'" checked> <label class="custom-control-label" for="'+data[i].autoID+'"><span class="'+data[i].menu_icon+'"></span> '+ data[i].menu_name + ' [ '+data[i].menu_group +' ]</label>       </div>    </div>';
            }
            
              
               } 
               s +='</div>';
                    $('#show_user_rights').append(s);
        }
      });
    }


    function getempactivation(id){
      $('#activation_password').empty();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'get_activation',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data[0].emp_no);
        var s="";
        var p="";
        s += ' <div class="col-md-12 text-center"><table class="table w-100">' ;
        if(data[0].isactive == 1){
              s += '<tr><td class="text-center">User login access status</td><td class="text-left"><div class="form-group"><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input type="checkbox" class="onoffswitch_active custom-control-input" data-userid="'+data[0].emp_no+'" id="'+data[0].emp_no+'" checked> <label class="custom-control-label" for="'+data[0].emp_no+'"></label>       </div>    </div></td></tr>';
            }else{
              s += '<tr><td class="text-center">User login access status</td><td class="text-left"><div class="form-group"><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input type="checkbox" class="onoffswitch_active custom-control-input" data-userid="'+data[0].emp_no+'" id="'+data[0].emp_no+'"> <label class="custom-control-label" for="'+data[0].emp_no+'"> </label> </div>    </div></td></tr>';
            }
            s += '<tr><td>Password</td><td class="text-left"><button class="btn btn-md btn-primary" disabled>Reset & Send through email</button>&nbsp;<button class="btn btn-md btn-primary resetasemp" data-emp ='+data[0].emp_no+' >Reset as Employee Number</button></td></tr>';
              s +='</table></div>';
              $('#activation_password').append(s);
              $('#activation_password_1').append(p);
        }
       // $('#activation_password_1').append(s);
      });
    }

    $("body").on("click", ".resetasemp", function (e) {
      //alert("Hello");
      var emp = $(this).data('emp');
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'reset_pass_as_emp_no',forid:emp},
        success : function(response){
          if(response == 1){
            showtoast("Password set as Employee Number");
            //getallusers();
            $("#modalManage").modal('hide');
          }           
        }
      });
    });

    $("#emp_updateBtn").click(function(){
     var id= $("#emp_no").val();
     var grp= $("#emp_group").val();
      $.ajax({
        type : 'post',
        url : 'get_user_manage_admin.php',
        data: {operation:'update_group',forid:id, grp:grp,desig:$("#c_emp_desig").val()},
        success : function(response){
          if(response == 1){
            showtoast("Group/Section updated!");
            getallusers();
            $("#modalManage").modal('hide');
          }           
        }
      });
    });


  });

</script>
</body>
</html>

