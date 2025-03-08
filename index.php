<?php include('conn.php');
$uid="";
$pwd="";
if(isset($_GET['q1']) && isset($_GET['q2'])) {
  $uid=$_GET['q1'];
  $pwd=$_GET['q2'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $app_name;?></title>

  <!-- Google Font: Source Sans Pro -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style type="text/css"> body {
	background: url('images/inven.png') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b class="text-white"></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?= $app_name;?> : Asset & Inventory Management System</p>

      <form name="loginForm" id="loginForm" method="post">
        <div class="input-group mb-3">
          <input type="number" class="form-control" name = "empno" id = "empno" placeholder="Employee No." min= "0" value="<?=$uid;?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name = "pass" id = "pass" value="<?=$pwd;?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" id="signinBtn">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-lg-8 text-sm">
            <a href="aims_help.pdf" target="_blank">Click here to download help manual</a>
          </div>
        </div>

      </form>
    
      

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
        <a href="register.php" class="text-center">Register</a>
      </p> -->
      <div id="error"></div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script>
 $(function () {
  // add pc
  $("#loginForm").validate({
            rules: {
              empno:{
                required: true,
                number: true
              },
              pass: "required",
              
            },
            messages: {
              empno: "Enter valid employee number",
              pass : "Enter password"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'process_login.php',
        data : $("#loginForm").serialize()+"&operation=process_login",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#signinBtn").html('Authenticating ...');
},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#error").fadeIn(1000, function(){
            $("#error").html("");
            $("#error").html("<div class='alert alert-danger text-center'>Invalid credentials/Inactive user</div>");
            $("#signinBtn").html('Sign In');
            });
            $("#error").fadeOut(2000,function(){ $("#error").html("");});
            }
            else if(response == 1) {
            
            $("#error").fadeIn(1000, function(){
              $("#error").html("<div class='alert alert-success text-center'>Signing in....</div>");
            $("#loginForm").trigger("reset");
            $("#error").fadeOut();
            $("#signinBtn").html('Sign In');
            //alert("Logged In");
            window.location.href = "home.php";

            });

            }
            else{
              $("#error").fadeIn(1000, function(){
              $("#error").html("<div class='alert alert-success text-center'>Signing in....</div>");
            $("#loginForm").trigger("reset");
            $("#error").fadeOut();
            $("#signinBtn").html('Sign In');
            //alert("Logged In");
            window.location.href = "password.php";

            });
            }

}
});
            }
       
    });
    // add pc
 });
</script>
</body>
</html>
