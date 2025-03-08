<?php
include('conn.php');
$getdata = new Newdash();

if(isset($_SESSION['loggedinby_autoID'])){
  $uid = $_SESSION['loggedinby_autoID'];
  $totalservers = $getdata->getnumberofservers();
  $udetails = $getdata->getloginuserdetails($_SESSION['loggedinby_autoID']);
  $menugroups = $getdata->getallowedMenuGroups($_SESSION['loggedinby_autoID']);
  $getallshift = $getdata->getallshifts();
  $row_pcmake = $getdata->getallpcmake();
  $row_printermake = $getdata->getprinterpurchasedetails();
  $row_allgroups = $getdata->getallgroups();
  $row_os = $getdata->getallpcos();
  $row_pm = $getdata->getallprintermake();
  $res_header = $getdata->getlastlogin($_SESSION['loggedinby']);
  $res_totalpcs = $getdata->gettotalpcs();
  $res_totaldevices = $getdata->gettotaldevices();
  $res_totalusers = $getdata->gettotalusers();
  $res_pcinuse = $getdata->getinusepcs();
  $res_pcinventory = $getdata->getiinventorypcs();
  $res_totallaptops =  $getdata->gettotallaptops();
  $res_inuselaptops = $getdata->getinuselaptops();
  $res_inventorylaptops = $getdata->getinventorylaptops();
  $res_inventoryprinter = $getdata->getinventoryprinter();
  $res_otherpcs = $getdata->getotherpcs();
  $res_otherlaptops = $getdata->getotherlaptops();
  $res_allemployees = $getdata->getallempdetails();
  $res_noti=$getdata->get_noti_in_header();
  $res_noti_count=$getdata->get_noti_count();
  $res_prnt_job_count = $getdata->get_prnt_job_count();
  $res_tasks=$getdata->get_tasks_in_header();
}

?>
 <!-- Font Awesome -->
 <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- JQuery UI -->
  <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">

  <!-- multiple -->
  <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">

  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  
	
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- BS Stepper -->
  <!-- <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css"> -->
  <link rel="stylesheet" href="plugins/stepper/bs-stepper.min.css">


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link">Home</a>
      </li> -->
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media">
              <img src="dist/img/avatar5.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Person 1 -->
                  <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                <!-- </h3>
                <p class="text-sm">Message 1</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a> -->
          <!-- <div class="dropdown-divider"></div> -->
          
         <!--  <div class="dropdown-divider"></div> -->
          <!-- <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->

       <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-diagnoses"></i>
          <span class="badge badge-warning navbar-badge"><?=$res_prnt_job_count;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          
          <div class="dropdown-divider"></div>
          <?php
          if($res_prnt_job_count < 1 ){
            echo '<a href="#" class="dropdown-item view_noti">
            <i class="far fa-bell mr-2 text-danger"></i>No tasks</a>
          <div class="dropdown-divider"></div>';
          }else{
            foreach ($res_tasks as $n){
              echo '<a href="#" class="dropdown-item " data-id="'.$n['autoID'].'" data-dt="'.date('d/m/Y H:i:s',strtotime($n['initiated_on'])).'" data-toggle="modal" data-target="#modal_view_tasks">
              <i class="far fa-bell mr-2 text-danger"></i>'.$n['prnt_name_of_work'].'
              <span class="float-right text-muted text-sm">'.date('d/m/Y H:i:s',strtotime($n['initiated_on'])).'</span>
            </a>
            <div class="dropdown-divider"></div>';
          }
          }
          ?>
          </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?=$res_noti_count;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          
          <div class="dropdown-divider"></div>
          <?php
          if($res_noti_count < 1 ){
            echo '<a href="#" class="dropdown-item view_noti">
            <i class="far fa-bell mr-2 text-danger"></i>No Notifications</a>
          <div class="dropdown-divider"></div>';
          }else{
            foreach ($res_noti as $n){
              echo '<a href="#" class="dropdown-item view_noti" data-id="'.$n['autoID'].'" data-dt="'.date('d/m/Y H:i:s',strtotime($n['updatedon'])).'" data-toggle="modal" data-target="#modal_view_noti">
              <i class="far fa-bell mr-2 text-danger"></i>'.$n['noti_title'].'
              <span class="float-right text-muted text-sm">'.date('d/m/Y H:i:s',strtotime($n['updatedon'])).'</span>
            </a>
            <div class="dropdown-divider"></div>';
          }
          }
          ?>
          <!--<a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> Notification 1
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Notification 2
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Notification 3
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> -->
      </li>
     
      <!--logout dropdown-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-power-off"></i>
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Last Login : <?=date('d/m/Y H:i:s',strtotime($res_header['ondatetime']));?></span>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
            <i class="fas fa-power-off mr-2 text-danger"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
          <a href="password.php" class="dropdown-item">
            <i class="fas fa-key mr-2 text-danger"></i> Change password
          </a>
          
          
          
          
        </div>
      </li>
      
      
    </ul>
  </nav>

  