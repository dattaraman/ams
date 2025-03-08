<?php
include('conn.php');
session_start();
  if(!isset($_SESSION['loggedinby'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $app_name;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <style type="text/css"> body {
	background: url('images/inven.png') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
.error{
  color:red;
  font-size:9px;
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="#"><h4 class="text-white">First time login</b></h4>
    <a href="#"><b class="text-white">Change password</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Enter new password</p>

      <form name="registerUser" id="registerUser" method="post">

       
       <input type="hidden" name="uname" id="uname" value=<?=$_SESSION['loggedinby'] ;?>>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="emp_password" id="emp_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm password" name="emp_re_password" id="emp_re_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-right small text-primary">Password should contain minimum 8 chars</div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block" id="saveBtn">Update password</button>
          
          </div>
        </div>
      </form>

      
      <div id="error"></div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<!-- Modal -->
<div class="modal fade" id="termsModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title">Terms for usage</h5>
							<button class="close" data-dismiss="modal"><span>&times;</span></button>
						</div>
						<div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    Some text about terms.....
                                </div>
                            </div>
							<div class="row mx-auto">
                                <div class="col-lg-10"></div>
								<div class="col-lg-2">
									<button type="button" class="btn btn-default form-control" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
    <!-- Modal -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script>
 $(function () {
  // Register user

  $("#registerUser").validate({
            rules: {
              uname : "required",
              emp_password : {required: true,minlength: 8 },
              emp_re_password: {required: true, equalTo: '#emp_password' }
            },
            messages: {
              uname : "Invalid user",
              emp_password : "Enter valid password",
              emp_re_password : "Password not matching"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_password.php',
        data : $("#registerUser").serialize()+"&operation=update_password",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#saveBtn").html('Updating password ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error").fadeIn(1000, function(){
           
            $("#saveBtn").html('Register');
            showtoasterror("Unable to update password, Please contact system administrator");
            });
            }
            else {
            
         
            $("#error").fadeOut();
            $("#saveBtn").html('Update password');
            showtoast("Password updated successfully!");
            setTimeout(function() {
              window.location.href = "index.php";
            }, 2000);

            }

}
});
            }
       
    });
    // register user

   //show toast
   function showtoast($msg){
    
    
    toastr.success($msg)
  }
  // show toast

  function showtoasterror($msg){
    
    
    toastr.error($msg)
  }

    });
</script>
</body>
</html>
