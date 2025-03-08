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
  <title>SIRD | Server status</title>
  <style>
    .error{color:red;}
    .listitem:hover {background-color:#ccc; color:#fff;}
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
            <h1 class="m-0">Server status</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Server status</li>
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
        <div class="col-lg-12">


        <h3 class="card-title float-right"><button class="btn btn-app bg-primary"  data-toggle="modal" data-target="#addserverModal" id="addbtn">
                  <i class="fas fa-plus"></i> Add Machine
              </button></h3>



        
      </div>
        <!-- Main row -->
        <div class="row w-100" id="uprow"></div>
          <div class="row w-100" id="rackdata">
         
          </div>
          <div class="row" id="error"></div>
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
<script type="text/javascript"></script>
<script>
  $(document).ready(function(){
  
    get_server_info(); 
    
    function get_server_info(){
      $("#rackdata").append("<div class='col-lg-12'><p class='text-center'><img src='images/data-center.gif'></p></div>");
      $("#rackdata").append("<div class='col-lg-12'><p class='text-center h3'>Fetching realtime data...</p></div>");
      //$("#rackdata").append("Fetching data.....");
    setInterval(function(){
     
     $.ajax({
       
       url : 'get_server.php',
       type : 'POST',
       data : {operation:'loadservers'},
       beforeSend: function() {
         //alert('Hello');
       },
       success : function(response){
         //alert(response);
         $("#rackdata").fadeIn("slow");
         $("#rackdata").html(response); 
         }
     });
   },5000);
   }
        
   $("body").on('click','.serverlink',function(){
    //alert($(this).data('serverid'));
    var id = $(this).data('serverid');
    getserverbyid(id);
   });
   
   $("#frmAddServer").validate({
    rules: {
      rackno:"required",
      servername:"required",
      ipadd:"required",
      serveros:"required",
      kvmid : "required",
      serverosversion : "required"
    },
    messages: {
      rackno:"Select rack number/location",
      servername:"Name of server",
      ipadd:"Enter IP address",
      serveros:"Select OS",
      kvmid : "Select KVM ID",
      serverosversion : "Enter OS version"
    },
    submitHandler:function(form){
      $.ajax({
        type:"POST",
        url: "add_server.php",
        async: false,
        data: $("#frmAddServer").serialize()+"&operation=addserver",
        beforeSend: function(){

        },
        success: function(response){
          alert(response);
          if (response == 1){
            $("#addserverModal").modal('hide');
            $("#frmAddServer").trigger("reset");
            showtoast("Machine added successfully");
            
          }else{
            alert("Unable to add server!");
          }
        }
      });
    }
   });
   
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

    $("#ipadd").keyup(function(){
      checkip($("#ipadd").val());
    });

    function getserverbyid(id){
      $.ajax({
        type:"POST",
        url: "get_server.php",
        data: {operation:'getbyid',id:id},
        beforeSend: function(){},
        success: function(response){
          data = JSON.parse(response);
          //alert(data[0].server_name);
          $("#m_servername").text(data[0].server_name);
        }
      });
    }

    function checkip(ip){
      $.ajax({
        type:"POST",
        url: "add_server.php",
        data: {operation:'checkServer',ipadd:ip},
        beforeSend: function(){

        },
        success: function(response){
          //alert(response);
          if (response == 1){
            $("#ipadd").removeClass("is-valid");
            $("#ipadd").addClass("is-invalid");
            $("#ipadd").val("");
            
          }else{
            $("#ipadd").removeClass("is-invalid");
            $("#ipadd").addClass("is-valid");
          }
          
        }
      });
    }

    });
    
</script>

    

   
    
    <!-- Modal -->
    <div class="modal fade" id="addserverModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title">Add server</h5>
							<button class="close" data-dismiss="modal"><span>&times;</span></button>
						</div>
						<div class="modal-body">
							<form method="POST" id="frmAddServer" name="frmAddServer">
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label for="rackno">Rack No.</label>
											<select class="form-control" id="rackno" name="rackno">
                        <option value="RACK - I">RACK - I</option>
                        <option value="RACK - II">RACK - II</option>
                        <option value="RACK - III">RACK - III</option>
                        <option value="RACK - IV">RACK - IV</option>
                        <option value="REMOTE">REMOTE</option>
                      </select>
										</div>
									</div>

                  <div class="col-lg-2">
										<div class="form-group">
											<label for="kvmid">KVM ID</label>
											<select class="form-control" id="kvmid" name="kvmid">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="0">0</option>

                      </select>
										</div>
									</div>


									<div class="col-lg-7">
										<div class="form-group">
											<label for="servername">Name of server</label>
											<input type="text" name="servername" id="servername" class="form-control" required placeholder="Citrix..">
										</div>
									</div>
								</div>
                <div class="row">


                <div class="col-lg-6">
										<div class="form-group">
											<label for="serveros">Operating system</label>
											<select class="form-control" id="serveros" name="serveros">
                        <option value="Windows">Windows</option>
                        <option value="Linux">Linux/Unix</option>
                        <option value="Others">Others</option>
                      </select>
										</div>
									</div>

                  <div class="col-lg-6">
										<div class="form-group">
											<label for="serverosversion">Operating version</label>
											<input type="text" name="serverosversion" id="serverosversion" class="form-control" required placeholder="Eg: WIndows Server 2012 R2">
										</div>
									</div>
                  </div>
                  <div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="ipadd">IP Address</label>
											<input type="text" name="ipadd" id="ipadd" class="form-control" required placeholder="Eg: 10.25.12.10">
										</div>
									</div>
                  
								</div>
								<div class="row mx-auto">
									<div class="col-lg-6 mx-auto">
										<button type="submit" id="SaveBtn" name="SaveBtn" class="btn btn-danger form-control">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
    <!-- Modal -->



    <!-- Modal -->
    <div class="modal fade" id="machineModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title" id="m_servername"></h5>
							<button class="close" data-dismiss="modal"><span>&times;</span></button>
						</div>
						<div class="modal-body">
							<form method="POST" id="frmAddServer" name="frmAddServer">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="rackno">Rack No.</label>
											<select class="form-control">
                        <option value="RACK - I">RACK - I</option>
                        <option value="RACK - II">RACK - II</option>
                        <option value="RACK - III">RACK - III</option>
                        <option value="RACK - IV">RACK - IV</option>
                        <option value="Other[REMOTE]">REMOTE</option>
                      </select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="servername">Name of server</label>
											<input type="text" name="servername" id="servername" class="form-control" required placeholder="Citrix..">
										</div>
									</div>
								</div>
                <div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="ipadd">IP Address</label>
											<input type="text" name="ipadd" id="ipadd" class="form-control" required placeholder="Eg: 10.25.12.10">
										</div>
									</div>
                  <div class="col-lg-6">
										<div class="form-group">
											<label for="rackno">Operating system</label>
											<select class="form-control">
                        <option value="Windows">Windows</option>
                        <option value="Linux">Linux/Unix</option>
                        <option value="Others">Others</option>
                      </select>
										</div>
									</div>
								</div>
								<div class="row mx-auto">
									<div class="col-lg-6 mx-auto">
										<button type="submit" id="SaveBtn" name="SaveBtn" class="btn btn-danger form-control">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
    <!-- Modal -->


   
</body>
</html>
