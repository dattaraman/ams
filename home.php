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
  <title>SIRD | Dashboard</title>
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
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
     
       <!-- slider -->
       

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <!-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/inven.png" data-color="lightblue" alt="First Image">
      <div class="carousel-caption d-md-block">
        <h5><?=$app_name . ' : '.$appname_full;?></h5>
      </div>
    </div>
    <!-- <div class="carousel-item">
      <img class="d-block w-100" src="images/back1.jpg" data-color="firebrick" alt="Second Image">
      <div class="carousel-caption d-md-block">
        <h5>Second Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/back1.jpg" data-color="violet" alt="Third Image">
      <div class="carousel-caption d-md-block">
        <h5>Third Image</h5>
      </div>
    </div> -->
  </div>
  <!-- Controls -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>


       <!-- slider -->
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

<script type="text/javascript">
 $(function () {
   
$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});


 });
</script>
    
</body>
</html>
