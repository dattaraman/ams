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
  <title>SIRD | [ADMIN] Dashboard</title>
  <style>
  .error{color:#ff0000;}
  .icn {  
    width:100px;  
    text-align:center;  
    vertical-align:middle;  
}  


.fa {  
    position: relative;  
}  


.mybadge {  
    font-size: .25em;  
    display: block;  
    position: absolute;  
    top: -.75em;  
    right: -.75em;  
    width: 2em;  
    height: 2em;  
    line-height: 2em;  
    border-radius: 50%;  
    text-align: center;  
    color: #fff;  
    background: rgba(0,0,0,0.5);  
}  
#example1 tbody tr:hover td {
    background: LightGray;
}
#example2 tbody tr:hover td {
    background: LightGray;
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
            <h1 class="m-0">[ADMIN] Dashboard</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">[ADMIN] Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">


      
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-desktop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Desktop's <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Total available Pc's (Being used,Inventory) excluding ready to scrap & scrapped"></span> </span> 
                <span class="info-box-number">   <?=$res_totalpcs; ?>
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-laptop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Laptop's <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Total available laptop's (Being used,Inventory) excluding ready to scrap & scrapped"></span> </span>
                <span class="info-box-number">
                <?=$res_totallaptops; ?> 
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Printers, Scanners & MFD <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Total available printer/scanner/MFD's (Being used,Inventory) excluding ready to scrap & scrapped"></span> </span>
                <span class="info-box-number"><?=$res_totaldevices;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"> <?=$res_totalusers; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">
  <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Users & Assets</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" id="showtableAsset"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

</div>


<div class="row">
<div class="col-lg-12">
  <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Groups/Section & Assets</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" id="showtableGroupAsset"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

</div>

</section>
<section class="content">
<div class="row">
  <div class="col-lg-4">
  <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Desktop PCs</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

  <div class="col-lg-4">
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Laptop's</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart_laptop" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
  <div class="col-lg-4">
  <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Printer/Scanners/MFD</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart_printer" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
</div>

<div class="row">
  

  <div class="col-lg-6">
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Desktop/Laptop Purchase</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart_purchase" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

  <div class="col-lg-6">
  <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Printer/Scanner/MFD Purchase</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart_printer_purchase" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

</div>



</section>

   
  </div>
  <!-- /.content-wrapper -->
  <?php include ('footer.php');?>
  <script>
    $(function () {
    
      get_graph_desktop();
      get_graph_laptop();
      get_graph_printer();
      get_graph_purchase();
      get_graph_printer_purchase();
      getallasset();
      getallgroupasset();

    function getallasset(){
     
      $.ajax({  
      url: "get_admin_dashboard.php",
      type: "POST",
      data: {operation:"get_all_asset"},beforeSend: function(){
        $(".toastctrl").fadeOut();
      
      },
      success: function(response){
        //console.log(response);
        $("#showtableAsset").html(response);
        $("#example1").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          order: [],
        }).container().appendTo('#example1_filter');
          
      }
    });
    

    }

    $("body").on("click", ".get_group_asset_details", function (e) {
      
      $("#grpid").val($(this).data('grpid'));
      $("#getgroupasset").trigger( "submit" );

    });




    function getallgroupasset(){
     
     $.ajax({  
     url: "get_admin_dashboard.php",
     type: "POST",
     data: {operation:"get_all_group_asset"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
       //console.log(response);
       $("#showtableGroupAsset").html(response);
       $("#example2").DataTable({
         responsive: true,
         lengthChange: true,
         autoWidth: false,
         order: [],
       }).container().appendTo('#example1_filter');
         
     }
   });
   

   }

      
  function get_graph_desktop() {
    var lbl = [];
    var dts = [];
       $.ajax({
        type : 'post',
        async:false,
        url : 'get_admin_dashboard.php',
        data : {operation:'get_desktop_data'},
        beforeSend: function(){},
        success : function(response){
          if(response=="[]"){
            //alert("blank");
            //("#donutChart").
          }
        data = JSON.parse(response);
          //alert(data[0].current_status);
          for(var i in data){
            //alert(i);
            

            switch(data[i].current_status) {
            case '1':
            lbl.push('In-use');
              break;
            case '0':
            lbl.push('Inventory');
              break;
            case '2':
            lbl.push('At maintenance/repair');
              break;
              case '3':
            lbl.push('Ready for scrap');
              break;
            case '4':
            lbl.push('Scrapped');
              break;
            default:
            lbl.push('others');
          } 


           
            dts.push(data[i].cnt);
            //alert(dts[i]);
          }
          }
});
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels:lbl,
      datasets: [
        {
          data: dts,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    }
    

    function get_graph_laptop() {
    var lbl = [];
    var dts = [];
       $.ajax({
        type : 'post',
        async:false,
        url : 'get_admin_dashboard.php',
        data : {operation:'get_laptop_data'},
        beforeSend: function(){},
        success : function(response){
          if(response=="[]"){
            //alert("blank");
            //("#donutChart").
          }
        data = JSON.parse(response);
          //alert(data[0].current_status);
          for(var i in data){
            //alert(i);
            

            switch(data[i].current_status) {
            case '1':
            lbl.push('In-use');
              break;
            case '0':
            lbl.push('Inventory');
              break;
            case '2':
            lbl.push('At maintenance/repair');
              break;
              case '3':
            lbl.push('Ready for scrap');
              break;
            case '4':
            lbl.push('Scrapped');
              break;
            default:
            lbl.push('others');
          } 


           
            dts.push(data[i].cnt);
            //alert(dts[i]);
          }
          }
});
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
    var donutChartCanvas = $('#donutChart_laptop').get(0).getContext('2d')
    var donutData        = {
      labels:lbl,
      datasets: [
        {
          data: dts,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    }
    function get_graph_printer() {
    var lbl = [];
    var dts = [];
       $.ajax({
        type : 'post',
        async:false,
        url : 'get_admin_dashboard.php',
        data : {operation:'get_printer_data'},
        beforeSend: function(){},
        success : function(response){
          if(response=="[]"){
            //alert("blank");
            //("#donutChart").
          }
        data = JSON.parse(response);
          //alert(data[0].current_status);
          for(var i in data){
            //alert(i);
            

            switch(data[i].current_status) {
            case '1':
            lbl.push('In-use');
              break;
            case '0':
            lbl.push('Inventory');
              break;
            case '2':
            lbl.push('At maintenance/repair');
              break;
              case '3':
            lbl.push('Ready for scrap');
              break;
            case '4':
            lbl.push('Scrapped');
              break;
            default:
            lbl.push('others');
          } 


           
            dts.push(data[i].cnt);
            //alert(dts[i]);
          }
          }
});
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
    var donutChartCanvas = $('#donutChart_printer').get(0).getContext('2d')
    var donutData        = {
      labels:lbl,
      datasets: [
        {
          data: dts,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    }
    
    function get_graph_purchase() {
      var lbl = [];
    var dts = [];
       $.ajax({
        type : 'post',
        async:false,
        url : 'get_admin_dashboard.php',
        data : {operation:'get_purchase_data'},
        beforeSend: function(){},
        success : function(response){
          if(response=="[]"){
            //alert("blank");
            //("#donutChart").
          }
        data = JSON.parse(response);
          //alert(data[0].current_status);
         
          for(var i in data){
            //alert(i);
            lbl.push(data[i].pc_source);
            dts.push(data[i].cnt);
            //alert(dts[i]);
          }
          }
});
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
    var donutChartCanvas = $('#donutChart_purchase').get(0).getContext('2d')
    var donutData        = {
      labels:lbl,
      datasets: [
        {
          data: dts,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    }


    function get_graph_printer_purchase() {
      var lbl = [];
    var dts = [];
       $.ajax({
        type : 'post',
        async:false,
        url : 'get_admin_dashboard.php',
        data : {operation:'get_printer_purchase_data'},
        beforeSend: function(){},
        success : function(response){
          if(response=="[]"){
            //alert("blank");
            //("#donutChart").
          }
        data = JSON.parse(response);
          //alert(data[0].current_status);
         
          for(var i in data){
            //alert(i);
            lbl.push(data[i].device_source);
            dts.push(data[i].cnt);
            //alert(dts[i]);
          }
          }
});
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
    var donutChartCanvas = $('#donutChart_printer_purchase').get(0).getContext('2d')
    var donutData        = {
      labels:lbl,
      datasets: [
        {
          data: dts,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    }

  
    $('#sel_item').multiselect({
      
      nonSelectedText: 'Select device',
      //enableFiltering: true,
            //enableFullValueFiltering: true,
            //filterBehavior: 'value',
      onChange: function(option, checked, select) {
                  
                
                $("#aa").val('');
                //alert('cleared');
                $('.form-check-input').each(function(index, element) {
                //alert($(this).val() + $(this).prop("checked"));
                if($(this).prop("checked")==true)
                {
                  //alert($(this).val());
                  
                  $("#aa").val($("#aa").val() +",'"+ $(this).val() + "'");
                  
                  
                  if($("#aa").val().substr(0, 1)==","){
                    $("#aa").val($("#aa").val().substring(1));
                    
                }
                
                }
                //getselectedcompany($("#aa").val());
        });
              
            }
            

    });

    $("body").on("click", ".open_action", function (e) {
      //alert($(this).data('id'));
      //removePersonalPC($(this).data('id'));      
      $("#delid").val($(this).data('id'));
    });


   

    

    $('[data-toggle="tooltip"]').tooltip();

    

    
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
