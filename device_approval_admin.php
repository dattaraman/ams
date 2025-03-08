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
  <title>SIRD | [SYS-ADMIN] Device Approval</title>
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
            <h1 class="m-0">[SYS-ADMIN] Device Approval</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">[GROUP] Device Approval</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



 <!-- modal view printer -->
 <div class="modal fade" id="modal_view_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="viewprinterform" id="viewprinterform" method="POST">
                 



                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecentralPrinterPurchasev" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapsecentralPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_printer_make">Select printer make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control select2" id="v_printer_make" style="width: 100%;" name="v_printer_make" disabled>
                          <?php foreach ($row_printermake as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= '['.$printermake['device'].'] '.$printermake['dm'] .'/'.$printermake['device_model'] .' - RV No. '.$printermake['rv_no'].' dt. '.date("d/m/Y", strtotime($printermake['rv_dt'])) ;?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                     
                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_printer_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="v_printer_barc_asset_id" style="width: 100%;" name="v_printer_barc_asset_id" placeholder="BARC/I...." readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_printer_amc_id" style="width: 100%;" name="v_printer_amc_id" placeholder="LJ/..." readonly>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_printer_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="v_printer_use" style="width: 100%;" name="v_printer_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_printer_location">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_printer_location" style="width: 100%;" name="v_printer_location" placeholder="Location" readonly>
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_printer_working" id="v_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_printer_working" id="v_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->
                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_printer-->


    <!-- modal approve -->
<div class="modal fade" id="modal_approve">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">[Sys-Admin] Approve PC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                      
                         <h6>Unique AIMS ID</h6>
                          <input type="hidden" class="form-control" readonly required="required" id="approveid" name="approveid" >
                         
                          <input type="text" class="form-control" placeholder="Unique Asset ID" required="required" id="aimsid" name="aimsid" readonly>
                          
                        </div>    
                      </div>
                      
                    </div>    
                <div class="modal-footer">
              
                <button type="button" class="btn btn-primary" id="approveBtn">Approve & Submit</button>
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
  
 <!-- /.modal-approve -->



 <!-- modal approve -->
 <div class="modal fade" id="modal_approvedevice">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
            <h6>Unique AIMS ID</h6>
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
                          <input type="hidden" class="form-control" readonly required="required" id="approveiddevice" name="approveiddevice" >
                          <input type="text" class="form-control" placeholder="Unique Asset ID" required="required" id="aimsid_device" name="aimsid_device" readonly>
                        </div>    
                      </div>
                      
                    </div>    
                <div class="modal-footer">
              
                <button type="button" class="btn btn-primary" id="approveBtnDevice">Approve & Submit</button>
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
  
 <!-- /.modal-approve -->



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
              </div>
              <!-- /.card-header -->
              <div class="toastctrl"></div>
              <div class="card-body">
              <div class="row">
                  <div class="col-lg-12 text-right"><input type="text" name="filteremp" id="filteremp" class="form-control" placeholder="Filter by Employee name/Section/Group"></div>
              </div>
              <hr>
              <div class='alert alert-primary text-center'>PC's / Laptop</div>
              <div class="row" id="showtable"></div>
              <div class='alert alert-primary text-center'>Printer / Scanner / MFD</div>
              <div class="row" id="showtabledevice"></div>
                  <hr>
              </div>
              
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
    $("#editpcform_indip :input").attr('disabled',true);
    $('[data-toggle="tooltip"]').tooltip();

    getgroupc('');
    getgroupdevice('');
    
    $("body").on("click", ".btn_approve", function (e) {
      $("#modal_approve").modal('show');
      $("#approveid").val($(this).data('id'));
         checkaimsid($(this).data('id'));
        });

        $("body").on("click", ".btn_approve_device", function (e) {
      $("#modal_approvedevice").modal('show');
      $("#approveiddevice").val($(this).data('id'));
      checkaimsid_device($(this).data('id'));
        });

    function checkaimsid(id){
    $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"checkaimsid",id:id},beforeSend: function(){
      },
      success: function(response){
        //alert(response);
        data = JSON.parse(response);
       //alert(data[0].aimsid);
       if(data[0].aimsid =='0'){
          getaimsid();
      }else{
        $("#aimsid").val(data[0].aimsid);
      }
      }
    }); 
  }

  function checkaimsid_device(id){
    $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"checkaimsid_device",id:id},beforeSend: function(){
      },
      success: function(response){
        //alert(response);
        data = JSON.parse(response);
       //alert(data[0].aimsid);
       if(data[0].aimsid =='0'){
          getaimsid_device();
      }else{
        $("#aimsid_device").val(data[0].aimsid);
      }
      }
    }); 
  }

  function getaimsid(){
    $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"getaimsidmax"},beforeSend: function(){
      },
      success: function(response){
        //alert(response);
        if(response ==0){
          showtoasterror("Unable to fetch next ID");
          
        }else{
          $("#aimsid").val('SIRD/AIMS/PC/' + response);
        } 
      }
    }); 
  }

  function getaimsid_device(){
    $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"getaimsidmax_device"},beforeSend: function(){
      },
      success: function(response){
        //alert(response);
        if(response ==0){
          showtoasterror("Unable to fetch next ID");
          
        }else{
          $("#aimsid_device").val('SIRD/AIMS/Dev/' + response);
        } 
      }
    }); 
  }

function admin_mark_approve(id,aimsid){
  //alert(id);
  $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"admin_mark_approve",id:id,aimsid:aimsid},beforeSend: function(){
        
      },
      success: function(response){
        //alert(response);
        if(response !=1){
          showtoasterror("Unable to approve");
          $("#modal_approve").modal('hide');
        }else{
          getgroupc($("#filteremp").val());
          showtoast("Approval marked successfully!"); 
          $("#modal_approve").modal('hide');
        }
       
        
      }
    });
}


function admin_mark_approvedevice(id,aimsid){
  //alert(id);
  $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"admin_mark_approvedevice",id:id,aimsid:aimsid},beforeSend: function(){
        
      },
      success: function(response){
        //alert(response);
        if(response !=1){
          showtoasterror("Unable to approve");
          $("#modal_approvedevice").modal('hide');
        }else{
          getgroupdevice($("#filteremp").val());
          showtoast("Approval marked successfully!"); 
          $("#modal_approvedevice").modal('hide');
        }
       
        
      }
    });
}

$("#approveBtn").click(function(){
  admin_mark_approve($("#approveid").val(),$("#aimsid").val());
});


$("#approveBtnDevice").click(function(){
  admin_mark_approvedevice($("#approveiddevice").val(),$("#aimsid_device").val());
});
  
    function getgroupc(ser){
     
      $.ajax({  
      url: "get_device_approval_admin.php",
      type: "POST",
      data: {operation:"alllist",ser:ser},beforeSend: function(){
        $(".toastctrl").fadeOut();
      
      },
      success: function(response){
        //console.log(response);
        $("#showtable").html(response);
      }
    });
    

    }

    $('#filteremp').keyup(function() { 
      getgroupc($('#filteremp').val());
      getgroupdevice($('#filteremp').val());
      //alert($('#filteremp').val());
    });


    



    function getgroupdevice(ser){
     
     $.ajax({  
     url: "get_device_approval_admin.php",
     type: "POST",
     data: {operation:"alllistdevice",ser:ser},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
       //console.log(response);
       $("#showtabledevice").html(response);
          
     }
   });
   

   }

    
    //show toast
    function showtoast($msg){
    
    
      toastr.success($msg)
    }
    // show toast

    function showtoasterror($msg){
    
    
    toastr.error($msg)
  }

  

  $("body").on("click", ".view_details", function (e) {
          id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data.pc_source);
          if(data.pc_source == "Centralize"){
            $("#modal_view_cenp").modal("show");
            $("#vcenp_pc_make").val(data.pc_make_model)
            $("#vcenp_pc_os").val(data.pc_os);
            $("#vcenp_pc_arch").val(data.pc_bit_type);
            $("#vcenp_ppc_ram").val(data.pc_ram_value);
            $("#vcenp_pc_hdd").val(data.pc_hdd);
            $("#vcenp_pc_ip").val(data.pc_ip);
            $("#vcenp_pc_setup").val(data.pc_setup)
            $("#vcenp_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#vcenp_pc_amc_id").val(data.pc_amc_id);
            $("#vcenp_pc_use").val(data.pc_use);
            $("#vcenp_pc_location").val(data.pc_location);
            $("#vcenp_pc_make_text").val(data.pc_make);
            $("#vcenp_pc_model_text").val(data.pc_processor_details);
            $('input[name="v_cenp_pc_working"][value="' + data.working + '"]').prop('checked', true);
          }
          if(data.pc_source == "Individual"){
            $("#modal_view_indip").modal("show");
            $("#e_indi_pc_supplier").val(data.pc_supplier_name);
            $("#e_indi_indent_no").val(data.pc_indent_no);
            $("#e_indi_indent_dt").val(data.pc_indent_dt);
            $("#e_indi_indent_by").val(data.pc_indent_by);
            $("#e_indi_po_no").val(data.pc_po_no);
            $("#e_indi_po_dt").val(data.pc_po_dt);
            $("#e_indi_rv_no").val(data.pc_rv_no);
            $("#e_indi_rv_dt").val(data.pc_rv_dt);
            $("#e_indi_pc_cost").val(data.pc_cost);
            $("#e_indi_pc_warranty").val(data.warranty_in_years);
            $("#e_indi_pc_warranty_uptodate").val(data.warranty_till);
            $("#e_indi_pc_make").val(data.pc_make);
            $("#e_indi_pc_model").val(data.pc_processor_details);
            $("#e_indi_pc_arch").val(data.pc_bit_type);
            $("#e_indi_pc_ram").val(data.pc_ram_value);
            $("#e_indi_pc_hdd").val(data.pc_hdd);
            $("#e_indi_pc_os").val(data.pc_os);
            $("#e_indi_pc_monitor").val(data.pc_monitor_details);
            $("#e_indi_pc_ip").val(data.pc_ip);
            $("#e_indi_pc_setup").val(data.pc_setup);
            $("#e_indi_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#e_indi_pc_amc_id").val(data.pc_amc_id);
            $("#e_indi_pc_use").val(data.pc_use);
            $("#e_indi_pc_location").val(data.pc_location);
            $('input[name="v_indi_pc_working"][value="' + data.working + '"]').prop('checked', true);
          }
          if(data.pc_source == "Borrowed"){
            $("#modal_view_borrowedp").modal("show"); 
            $("#v_borrow_pc_make").val(data.pc_make);
            $("#v_borrow_pc_model").val(data.pc_processor_details);
            $("#v_borrow_pc_arch").val(data.pc_bit_type);
            $("#v_borrow_pc_ram").val(data.pc_ram_value);
            $("#v_borrow_pc_hdd").val(data.pc_hdd);
            $("#v_borrow_pc_os").val(data.pc_os);
            $("#v_borrow_pc_monitor").val(data.pc_monitor_details);
            $("#v_borrow_pc_ip").val(data.pc_ip);
            $("#v_borrow_pc_setup").val(data.pc_setup);
            $("#v_borrow_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#v_borrow_pc_amc_id").val(data.pc_amc_id);
            $("#v_borrow_pc_use").val(data.pc_use);
            $("#v_borrow_pc_location").val(data.pc_location);
            $('input[name="v_borrow_pc_working"][value="' + data.working + '"]').prop('checked', true);
          }
        }
          });

        });


        $("body").on("click", ".view_details_device", function (e) {
          id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details_printer',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data.pc_source);
          if(data.device_source == "Centralize"){
            $("#modal_view_printer").modal("show");
           //alert("Hello");
           $("#v_printer_make").val(data.device_make_model);
           $("#v_printer_barc_asset_id").val(data.device_barc_asset_id);
           $("#v_printer_amc_id").val(data.device_amc_id);
           $("#v_printer_use").val(data.device_use);
           $("#v_printer_location").val(data.device_location);
           $('input[name="v_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
          if(data.device_source == "Individual"){
            $("#modal_view_indi_printer").modal("show");
           //alert("Hello");
           $("#indi_device_v").val(data.device);
            $("#indi_device_supplier_v").val(data.device_supplier_details);
            $("#indi_device_indent_no_v").val(data.device_indent_no);
            $("#indi_device_indent_dt_v").val(data.device_indent_dt);
            $("#indi_device_indent_by_v").val(data.device_indent_by);
            $("#indi_device_po_no_v").val(data.device_po_no);
            $("#indi_device_po_dt_v").val(data.device_po_dt);
            $("#indi_device_rv_no_v").val(data.device_rv_no);
            $("#indi_device_rv_dt_v").val(data.device_rv_dt);
            $("#indi_device_cost_v").val(data.device_cost);
            $("#indi_device_warranty_v").val(data.warranty_in_years);
            $("#indi_device_warranty_uptodate_v").val(data.warranty_till);
            $("#indi_v_printer_make").val(data.device_make);
            $("#indi_device_model_v").val(data.device_model);
            $("#v_indi_printer_barc_asset_id").val(data.device_barc_asset_id);
            $("#v_indi_printer_amc_id").val(data.device_amc_id);
            $("#v_indi_printer_use").val(data.device_use);
            $("#v_indi_printer_location_v").val(data.device_location);
            $("#indi_device_tone_v").val(data.device_tone);
            $('input[name="v_indi_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }


          if(data.device_source == "Borrowed"){
            $("#modal_borrowed_view_printer").modal("show");
           $("#bor_device_v").val(data.device)
           $("#bor_device_make_v").val(data.device_make)
           $("#bor_device_model_v").val(data.device_model)
           $("#bor_device_barc_asset_id_v").val(data.device_barc_asset_id); 
           $("#bor_device_amc_id_v").val(data.device_amc_id);
           $("#bor_device_use_v").val(data.device_use);
           $("#bor_device_location_v").val(data.device_location);
           $("#bor_device_tone_v").val(data.device_tone);
           $('input[name="v_bor_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
         
         
          
        }
          });

        });
  });
  
</script>


<!-- modal view indi printer -->
<div class="modal fade" id="modal_view_indi_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD [individual purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="indiviewprinterform" id="indiviewprinterform" method="POST">
                 



                  <div class="card">
                   
                    <div id="collapseindiPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_v">Device </label>
                          <select class="form-control select2" id="indi_device_v" style="width: 100%;" name="indi_device_v" disabled>
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_supplier_v">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="indi_device_supplier_v" name="indi_device_supplier_v" disabled>
                          
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_indent_no_v">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indi_device_indent_no_v" name="indi_device_indent_no_v" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indi_device_indent_dt1v" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_indent_dt" name="indi_device_indent_dt_v" id="indi_device_indent_dt_v" placeholder="Indent date" disabled/>
                            <div class="input-group-append" data-target="#indi_device_indent_dt_v" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indi_device_indent_by_v">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indi_device_indent_by_v" name="indi_device_indent_by_v" disabled>
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_po_no_v">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="indi_device_po_no_v" name="indi_device_po_no_v" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="indi_device_po_dt1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_po_dt_v" name="indi_device_po_dt_v" id="indi_device_po_dt_v" placeholder="PO Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_po_dt_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_rv_no_v">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="indi_device_rv_no_v" name="indi_device_rv_no_v" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="indi_device_rv_dt1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_rv_dt" name="indi_device_rv_dt_v" id="indi_device_rv_dt_v" placeholder="RV Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_rv_dt_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_cost_v">Cost (Per Device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="indi_device_cost_v" name="indi_device_cost_v" min="0" disabled>
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_v">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="indi_device_warranty_v" name="indi_device_warranty_v" min="0" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_uptodate">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="indi_device_warranty_uptodate1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_warranty_uptodate_v" name="indi_device_warranty_uptodate_v" id="indi_device_warranty_uptodate_v" placeholder="Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_warranty_uptodate_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_v_printer_make">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control select2" id="indi_v_printer_make" style="width: 100%;" name="indi_v_printer_make" disabled>
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_device_model_v">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="indi_device_model_v" style="width: 100%;" name="indi_device_model_v" placeholder="Eg. Laserjet 403 Dn" disabled>
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_printer_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="v_indi_printer_barc_asset_id" style="width: 100%;" name="v_indi_printer_barc_asset_id" placeholder="BARC/I...." disabled>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_indi_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_indi_printer_amc_id" style="width: 100%;" name="v_indi_printer_amc_id" placeholder="PRN/SCN/..." disabled>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_printer_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="v_indi_printer_use" style="width: 100%;" name="v_indi_printer_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_printer_location_v">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_indi_printer_location_v" style="width: 100%;" name="v_indi_printer_location_v" placeholder="Location" disabled>
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="indi_device_tone_v">Device tone </label>
                                <select class="form-control select2" id="indi_device_tone_v" style="width: 100%;" name="indi_device_tone_v" disabled>
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_indi_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_printer_working" id="v_indi_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_printer_working" id="v_indi_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_indi_printer-->



 <!-- modal view borrowed printer -->
 <div class="modal fade" id="modal_borrowed_view_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                 
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseborPrinterPurchasev" aria-expanded="false" aria-controls="collapseborPrinterPurchasev">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapseborPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="bor_device_v">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control select2" id="bor_device_v" style="width: 100%;" name="bor_device_v" disabled>
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                      



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_make_v">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control select2" id="bor_device_make_v" style="width: 100%;" name="bor_device_make_v" disabled>
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_model_v">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="bor_device_model_v" style="width: 100%;" name="bor_device_model_v" placeholder="Eg. Laserjet 403 Dn" disabled>
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="bor_device_barc_asset_id_v">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="bor_device_barc_asset_id_v" style="width: 100%;" name="bor_device_barc_asset_id_v" placeholder="BARC/I...." disabled>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="bor_device_amc_id_v">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="bor_device_amc_id_v" style="width: 100%;" name="bor_device_amc_id_v" placeholder="PRN/SCN/..." disabled>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_use_v">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="bor_device_use_v" style="width: 100%;" name="bor_device_use_v" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_location_v">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of device"></span></label>
                                <input type="text" class="form-control" id="bor_device_location_v" style="width: 100%;" name="bor_device_location_v" placeholder="Location" disabled>
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="bor_device_tone_v">Device tone </label>
                                <select class="form-control select2" id="bor_device_tone_v" style="width: 100%;" name="bor_device_tone_v" disabled>
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_bor_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_bor_printer_working" id="v_bor_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_bor_printer_working" id="v_bor_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_borrowed_printer-->



<!-- modal view cenp -->
<div class="modal fade" id="modal_view_cenp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Centralize Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
             
                <!-- AAAAA -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_make">Select PC make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control select2" id="vcenp_pc_make" style="width: 100%;" name="vcenp_pc_make" disabled>
                          <?php foreach ($row_pcmake as $pcmake){ ?>
                            <option value="<?=$pcmake['autoID'];?>"><?=$pcmake['pc_make'] .'/'.$pcmake['pc_model'];?></option>
                          <?php } ?>
                          </select>

                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_os">Operating system</label>
                          <select class="form-control select2" id="vcenp_pc_os" style="width: 100%;" name="vcenp_pc_os" disabled>
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>
                    </div>
                        <!-- ROW -->

                        <div class="row">

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control select2" id="vcenp_pc_arch" style="width: 100%;" name="vcenp_pc_arch" disabled>
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_ppc_ram">RAM (in GB)</label>
                                <input type="number" class="form-control" id="vcenp_ppc_ram" style="width: 100%;" name="vcenp_ppc_ram" min="1" max="32" placeholder="in GB" readonly> 
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_pc_hdd">Hard-disk(Capacity & Make)</label>
                                <input type="text" class="form-control" placeholder="HDD details" required="required" id="vcenp_pc_hdd" name="vcenp_pc_hdd" readonly>
                              </div>    
                            </div>

                            </div>

                            <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="vcenp_pc_ip" style="width: 100%;" name="vcenp_pc_ip" placeholder="IP address" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_setup">PC setup</label>
                          <select class="form-control select2" id="vcenp_pc_setup" style="width: 100%;" name="vcenp_pc_setup" disabled>
                          
                            <option value="internet+intranet">INTRANET + INTRANET (VM)</option>
                            <option value="intranet">Only intranet</option>
                            <option value="internet">Only internet</option>
                          </select>
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="vcenp_pc_barc_asset_id" style="width: 100%;" name="vcenp_pc_barc_asset_id" placeholder="BARC/I...." readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="vcenp_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="vcenp_pc_amc_id" style="width: 100%;" name="vcenp_pc_amc_id" placeholder="PC/..." readonly>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="vcenp_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="vcenp_pc_use" style="width: 100%;" name="vcenp_pc_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="vcenp_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="vcenp_pc_location" style="width: 100%;" name="vcenp_pc_location" placeholder="Location" readonly>
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_cenp_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_cenp_pc_working" id="v_cenp_pc_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_cenp_pc_working" id="v_cenp_pc_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
               
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                <!-- AAAAA -->
              </div>  <!-- /.card-body -->
             
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal  view cenp-->

     


     

     <!-- modal view indip -->
  <div class="modal fade" id="modal_view_indip">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Individual Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="editpcform_indip" id="editpcform_indip" method="POST">
                <!-- AAAAA -->
                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="e_indi_pc_supplier" name="e_indi_pc_supplier">
                          
                        </div>    
                      </div>

                     

                    </div>
 <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="e_indi_indent_no" name="e_indi_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="e_indi_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_indent_dt" name="e_indi_indent_dt" id="e_indi_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#e_indi_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="e_indi_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="e_indi_indent_by" name="e_indi_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="e_indi_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="e_indi_po_no" name="e_indi_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="e_indi_po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_po_dt" name="e_indi_po_dt" id="e_indi_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#e_indi_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="e_indi_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="e_indi_rv_no" name="e_indi_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="e_indi_rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_rv_dt" name="e_indi_rv_dt" id="e_indi_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#e_indi_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="e_indi_pc_cost" name="e_indi_pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="e_indi_pc_warranty" name="e_indi_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_warranty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="e_indi_pc_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_pc_warranty_uptodate" name="e_indi_pc_warranty_uptodate" id="e_indi_pc_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#e_indi_pc_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="e_indi_pc_make" name="e_indi_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="e_indi_pc_model" name="e_indi_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="e_indi_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control select2" id="e_indi_pc_arch" style="width: 100%;" name="e_indi_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="e_indi_pc_ram" name="e_indi_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="e_indi_pc_hdd" name="e_indi_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_indi_pc_os">Operating system</label>
                          <select class="form-control select2" id="e_indi_pc_os" style="width: 100%;" name="e_indi_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="e_indi_pc_monitor" name="e_indi_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="e_indi_pc_ip" style="width: 100%;" name="e_indi_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_setup">PC setup</label>
                          <select class="form-control select2" id="e_indi_pc_setup" style="width: 100%;" name="e_indi_pc_setup">
                          
                            <option value="internet+intranet">INTRANET + INTRANET (VM)</option>
                            <option value="intranet">Only intranet</option>
                            <option value="internet">Only internet</option>
                          </select>
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="e_indi_pc_barc_asset_id" style="width: 100%;" name="e_indi_pc_barc_asset_id" placeholder="BARC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_indi_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="e_indi_pc_amc_id" style="width: 100%;" name="e_indi_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="e_indi_pc_use" style="width: 100%;" name="e_indi_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="e_indi_pc_location" style="width: 100%;" name="e_indi_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_indi_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_pc_working" id="v_indi_pc_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_pc_working" id="v_indi_pc_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                    
                        <!-- ROW -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                <!-- AAAAA -->
              </div>  <!-- /.card-body -->
              </form>
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view indip-->


      <div class="modal fade" id="modal_view_borrowedp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_make ">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="v_borrow_pc_make" name="v_borrow_pc_make">
                          <input type="hidden" name="eborro_hid_autoID" id="eborro_hid_autoID">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="v_borrow_pc_model" name="v_borrow_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="v_borrow_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control select2" id="v_borrow_pc_arch" style="width: 100%;" name="v_borrow_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="v_borrow_pc_ram" name="v_borrow_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="v_borrow_pc_hdd" name="v_borrow_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_borrow_pc_os">Operating system</label>
                          <select class="form-control select2" id="v_borrow_pc_os" style="width: 100%;" name="v_borrow_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="v_borrow_pc_monitor" name="v_borrow_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="v_borrow_pc_ip" style="width: 100%;" name="v_borrow_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_setup">PC setup</label>
                          <select class="form-control select2" id="v_borrow_pc_setup" style="width: 100%;" name="v_borrow_pc_setup">
                          
                            <option value="internet+intranet">INTRANET + INTRANET (VM)</option>
                            <option value="intranet">Only intranet</option>
                            <option value="internet">Only internet</option>
                          </select>
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="v_borrow_pc_barc_asset_id" style="width: 100%;" name="v_borrow_pc_barc_asset_id" placeholder="BARC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_borrow_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_borrow_pc_amc_id" style="width: 100%;" name="v_borrow_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_borrow_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control select2" id="v_borrow_pc_use" style="width: 100%;" name="v_borrow_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_borrow_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_borrow_pc_location" style="width: 100%;" name="v_borrow_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   
                    

              </div>  <!-- /.card-body -->
              <div class="modal-footer"><!-- modal footer -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
              
            </div>
           
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view borrowedp-->



      </body>
</html>
