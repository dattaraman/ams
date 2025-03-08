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
  <title>SIRD | PC & Accessories</title>
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
            <h1 class="m-0">PC & Accessories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">PC & Accessories</li>
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
              
              <h3 class="card-title float-right"><button class="btn btn-app bg-warning "  data-toggle="modal" data-target="#modal_add_printer">
                  <i class="fas fa-print"></i> Add new Printer/Scanner
              </button></h3>
              
                <h3 class="card-title float-right"><button class="btn btn-app bg-danger"  data-toggle="modal" data-target="#modal_add">
                  <i class="fas fa-desktop"></i> Add PC
              </button></h3>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="showtable"></div><!-- /.card-body -->
              
              
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

  <!-- modal add -->
  <div class="modal fade" id="modal_add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Add PC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <form name="addpcform" id="addpcform" method="POST">
                 
                 

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_make">Select PC make 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control select2" id="pc_make" style="width: 100%;" name="pc_make">
                          <?php foreach ($row_pcmake as $pcm){ ?>
                            <option value="<?=$pcm['autoID'];?>"><?=$pcm['pc_make']. "-" .$pcm['pc_model'];?></option>
                          <?php } ?>
                          </select>

                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_os">Operating system</label>
                          <select class="form-control select2" id="pc_os" style="width: 100%;" name="pc_os">
                          
                            <option value="Windows XP">Windows XP</option>
                            <option value="Windows 7">Windows 7</option>
                            <option value="Windows 8.1">Windows 8.1</option>
                            <option value="Windows 10">Windows 10</option>
                          </select>
                        </div>    
                      </div>

                    </div>


                    <div class="row">

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                          <select class="form-control select2" id="pc_arch" style="width: 100%;" name="pc_arch">
                          
                            <option value="32bit">x86 (32bit)</option>
                            <option value="64bit">x86-64 (64bit)</option>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_ram">RAM (in GB)</label>
                          <input type="number" class="form-control" id="pc_ram" style="width: 100%;" name="pc_ram" min="1" max="32" placeholder="in GB">
                        </div>    
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="pc_ip" style="width: 100%;" name="pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_setup">PC setup</label>
                          <select class="form-control select2" id="pc_setup" style="width: 100%;" name="pc_setup">
                          
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
                          <label for="pc_barc_asset_id">BARC Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="pc_barc_asset_id" style="width: 100%;" name="pc_barc_asset_id" placeholder="BARC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="pc_amc_id" style="width: 100%;" name="pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>



                  <div id="error"></div>
                  <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            </div>    
                  </form>  
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal add-->

  
  <!-- /.content-wrapper -->
 <?php include ('footer.php');?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();

    getallpcofusers();
    
    function getallpcofusers(){
     
      $.ajax({  
      url: "get_pcs.php",
      type: "POST",
      data: {operation:"alllist"},
      success: function(response){
        //console.log(response);
        $("#showtable").html(response);
        $("#example1").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          //order: [0,'desc'],
          buttons: ["excel", "pdf", "print"],
        }).buttons().container().appendTo('#example1_filter');
        
      }
    });
    

    }

  // add pc
    $("#addpcform").validate({
            rules: {
              pc_ram:{
                required: true,
                number: true
              },
              pc_ip: "required",
              
            },
            messages: {
              pc_ram: "Specify RAM (in GB)",
              pc_ip : "Enter IP address"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : $("#addpcform").serialize()+"&operation=add_pc",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#saveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error").fadeIn(1000, function(){
            $("#error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#saveBtn").html('Save');
            });
            }
            else {
            
            $("#error").fadeIn(1000, function(){
            $("#modal_add").modal('hide');
            $("#addpcform").trigger("reset");
            $("#error").fadeOut();
            $("#saveBtn").html('Save');
            getallpcofusers()
            

            });

            }

}
});
            }
       
    });
    // add pc
     //show toast
     function showtoast($msg){
    
    
    toastr.success($msg)
  }
  // show toast
  });
</script>
</body>
</html>
