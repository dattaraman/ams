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
            <h1 class="m-0">Inventory details</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Inventory details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
 <!-- Small boxes (Stat box) -->
 <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Desktop PC's</h3>

                <p><?=$res_pcinventory;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Laptop's</h3>

                <p><?=$res_inventorylaptops;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3>Printer/Scanner/MFD</h3>

              <p><?= $res_inventoryprinter;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div> <!-- container fluid -->


    
<section class="content">
<div class="row">
<div class="col-lg-9">
  <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">[Inventory] Desktop's</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" id="showtableDesktop"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
  <div class="col-lg-3">
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
</div>
</section>

<section class="content">
<div class="row">
<div class="col-lg-9">
  <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">[Inventory] Laptop's</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" id="showtableLaptop"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
  <div class="col-lg-3">
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

</div>
</section>
<section class="content">
<div class="row">
<div class="col-lg-9">
  <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">[Other than inventory] Desktop's</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" id="showtableDesktop_others"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>

  
  <div class="col-lg-3">
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
      getallasset_inventory_desktop();
      getallasset_inventory_laptop();
      getallasset_other_inventory_desktop();

    function getallasset_inventory_desktop(){
     
      $.ajax({  
      url: "get_inventory_details.php",
      type: "POST",
      data: {operation:"get_all_inventory_desktop"},beforeSend: function(){
        $(".toastctrl").fadeOut();
      
      },
      success: function(response){
        //console.log(response);
        $("#showtableDesktop").html(response);
        $("#example1").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          order: [],
          buttons: ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_filter');
      }
    });
    

    }


    function getallasset_other_inventory_desktop(){
     
     $.ajax({  
     url: "get_inventory_details.php",
     type: "POST",
     data: {operation:"get_all_other_inventory_desktop"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
       //console.log(response);
       $("#showtableDesktop_others").html(response);
       $("#exampleO").DataTable({
         responsive: true,
         lengthChange: true,
         autoWidth: false,
         order: [],
         buttons: ["excel", "pdf", "print", "colvis"],
       }).buttons().container().appendTo('#exampleO_filter');
     }
   });
   

   }


    function getallasset_inventory_laptop(){
     
     $.ajax({  
     url: "get_inventory_details.php",
     type: "POST",
     data: {operation:"get_all_inventory_laptop"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
       //console.log(response);
       $("#showtableLaptop").html(response);
       $("#example13").DataTable({
         responsive: true,
         lengthChange: true,
         autoWidth: false,
         order: [],
         buttons: ["excel", "pdf", "print", "colvis"],
       }).buttons().container().appendTo('#example13_filter');
     }
   });
   

   }


    $("body").on("click", ".view_log", function (e) {
      //alert($(this).data('id'));
      //removePersonalPC($(this).data('id'));      
      getdesktop_log($(this).data('id'));
    });


    function getdesktop_log(id){
     
     $.ajax({  
     url: "get_inventory_details.php",
     type: "POST",
     data: {operation:"get_desktop_log",id:id},beforeSend: function(){
       $(".toastctrl").fadeOut();
     },
     success: function(response){
       //alert(response);
       $("#showtableDesktopLog").html(response);
       $("#example12").DataTable({
         responsive: true,
         lengthChange: true,
         autoWidth: false,
         order: [],
         buttons: ["excel", "pdf", "print", "colvis"],
       });   
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

    $("body").on("click", ".update_status", function (e) {
          var id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          $("#autoID_assign").val(data.autoID);
          //alert(data.pc_source);

        }
    });
        });

      

    $("body").on("click", ".edit_details", function (e) {
          edit_get_pc_details($(this).data('id'));
        });


        $("body").on("click", ".update_status_noassign", function (e) {
          //alert("OK");
          var id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          $("#autoID_status").val(data.autoID);
          //alert(data.autoID);

        }
    });
        });

        

    function edit_get_pc_details(id){
      $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data.pc_source);
          if(data.pc_source == "Centralize"){
            $("#modal_edit_cenp").modal("show"); 
            $("#hid_autoID").val(data.autoID); 
            $("#ecenp_pc_make").val(data.pc_make_model)
            $("#ecenp_pc_os").val(data.pc_os);
            $("#ecenp_pc_arch").val(data.pc_bit_type);
            $("#ecenp_ppc_ram").val(data.pc_ram_value);
            $("#ecenp_pc_hdd").val(data.pc_hdd);
            $("#ecenp_pc_ip").val(data.pc_ip);
            $("#ecenp_pc_setup").val(data.pc_setup)
            $("#ecenp_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#ecenp_pc_amc_id").val(data.pc_amc_id);
            $("#ecenp_pc_use").val(data.pc_use);
            $('input[name="ecenp_pc_working"][value="' + data.working + '"]').prop('checked', true);
            $("#ecenp_pc_location").val(data.pc_location);
          
          }
          if(data.pc_source == "Individual"){
            $("#modal_edit_indip").modal("show"); 
            $("#eindi_hid_autoID").val(data.autoID);
            $("#e_indi_pc_form").val(data.pc_form);
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
          }
          if(data.pc_source == "Borrowed"){
            $("#modal_edit_borrowedp").modal("show"); 
            $("#eborro_hid_autoID").val(data.autoID);
            $("#e_borrow_pc_make").val(data.pc_make);
            $("#e_borrow_pc_model").val(data.pc_processor_details);
            $("#e_borrow_pc_arch").val(data.pc_bit_type);
            $("#e_borrow_pc_ram").val(data.pc_ram_value);
            $("#e_borrow_pc_hdd").val(data.pc_hdd);
            $("#e_borrow_pc_os").val(data.pc_os);
            $("#e_borrow_pc_monitor").val(data.pc_monitor_details);
            $("#e_borrow_pc_ip").val(data.pc_ip);
            $("#e_borrow_pc_setup").val(data.pc_setup);
            $("#e_borrow_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#e_borrow_pc_amc_id").val(data.pc_amc_id);
            $("#e_borrow_pc_use").val(data.pc_use);
            $("#e_borrow_pc_location").val(data.pc_location);
          }
          //alert(data.pc_source);
        }
    });
    
    }

 // edit cenp pc
 $("#editpcform_cenp").validate({
         
         rules: {
          ecenp_ppc_ram:{
             required: true,
             number: true
           },
           ecenp_pc_hdd:"required",
           ecenp_pc_ip: "required",
           ecenp_pc_amc_id:"required",
           ecenp_pc_location : "required",
         },
         messages: {
            ecenp_ppc_ram:"Enter RAM in GB",
           ecenp_pc_hdd:"Enter Hard disk details",
           ecenp_pc_ip: "Enter IP",
           ecenp_pc_amc_id:"Enter AMC ID",
           ecenp_pc_location : "Enter location",
         },
         submitHandler: function(form) {

           $.ajax({
     type : 'post',
     url : 'get_pcs.php',
     data : $("#editpcform_cenp").serialize()+"&operation=edit_cenp_pc",
     beforeSend: function(){
     $("#ecenp_error").fadeOut();
     $("#updateBtn").html('Updating data ...');
},
     success : function(response){
       //alert(response);
         if(response != 1){
         $("#ecenp_error").fadeIn(1000, function(){
         $("#ecenp_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#updateBtn").html('Update');
         });
         }
         else {
         
         $("#ecenp_error").fadeIn(1000, function(){
         $("#modal_edit_cenp").modal('hide');
         $("#editpcform_cenp").trigger("reset");
         $("#ecenp_error").fadeOut();
         $("#updateBtn").html('Save');
         showtoast("PC Data Updated successfully!");
         get_graph_desktop();
      get_graph_laptop();
      get_graph_printer();
      get_graph_purchase();
      get_graph_printer_purchase();
      getallasset_inventory_desktop();
      getallasset_inventory_laptop();
         });

         }

}
});
         }
    
 });


 // add noti
$("#assignpcform").validate({
            rules: {
              autoID_assign : "required",
              sel_emp: "required"
            },
            messages: {
              autoID_assign : "Invalid Selection [PC]",
              sel_emp: "Select employee/user"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_inventory_details.php',
        data : $("#assignpcform").serialize()+"&operation=reassign_pc",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#reassignBtn").html('Updating data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#reassign_error").fadeIn(1000, function(){
            $("#reassign_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#reassignBtn").html('Save');
            });
            }
            else {
            
            $("#reassign_error").fadeIn(1000, function(){
            $("#reassignBtn").prop('disabled', true);
            $("#modal_reassign").modal('hide');
            $("#reassignBtn").prop('disabled', false);
            $("#assignpcform").trigger("reset");
            $("#reassign_error").fadeOut();
            
            $("#reassignBtn").html('Re-assign');
            getallasset_inventory_desktop();
            showtoast('Records updated for selected PC');
            });

            }

}
});
            }
       
    });




    $("#changestatus").validate({
            rules: {
              autoID_status : "required",
              sel_status: "required",
              status_remark: "required"
            },
            messages: {
              autoID_status : "Invalid Selection [PC]",
              sel_status: "Select employee/user",
              status_remark: "Remark required"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_inventory_details.php',
        data : $("#changestatus").serialize()+"&operation=change_status_pc",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#statusBtn").html('Updating data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#status_error").fadeIn(1000, function(){
            $("#status_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#statusBtn").html('Save');
            });
            }
            else {
            
            $("#status_error").fadeIn(1000, function(){
            $("#statusBtn").prop('disabled', true);
            $("#modal_reassign").modal('hide');
            $("#statusBtn").prop('disabled', false);
            $("#assignpcform").trigger("reset");
            $("#status_error").fadeOut();
            
            $("#statusBtn").html('Re-assign');
            getallasset_inventory_desktop();
            showtoast('Records updated for selected PC');
            });

            }

}
});
            }
       
    });



 // edit cenp pc

    //Initialize Select2 Elements
    $('.select2').select2()
    getallemp();

    function getallemp(){
      var s='';
      $('#sel_emp').html("");
      $.ajax({
        type: "POST",
        url: "get_inventory_details.php",
        data : {operation:"get_all_emps"},
        //dataType: "json",
        //cache: false,
        success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        //alert(data);
        
                
                for (var i = 0; i < data.length; i++) {  
                   s += '<option value="' + data[i].emp_no + '">' + data[i].emp_title +' '+ data[i].emp_name +" ("+ data[i].emp_desig +') [ '+ data[i].grp_name +' ]</option>';  
               } 
                    
                    
     //alert(s);
     
                    $('#sel_emp').append(s);
                           
       }
       
   });  
   
    }
    
  });
  
</script>

<!-- modal update status -->
<div class="modal fade" id="modal_status">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Update status</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="changestatus" id="changestatus" method="POST">
              <input type="hidden" class="form-control" id="autoID_status" style="width: 100%;" name="autoID_status" >
                



                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="sel_status">Select status <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select employee"></span></label>
                          <select class="form-control" id="sel_status" style="width: 100%;" name="sel_status">
                              <option value="2">Under Maintenance/Repair</option>
                              <option value="3">Ready for scrap</option>
                              <option value="4">Scrapped</option>
                              <option value="5">Other</option>


                          </select>
                        </div>    
                      </div>
                </div>

                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="status_remark">Remark </label>
                          <textarea class="form-control" id="status_remark" style="width: 100%;" name="status_remark"></textarea>
                        </div>    
                      </div>
                </div>




                <div class="modal-footer"><!-- modal footer -->
                <div id="status_error"></div>
                <button type="submit" class="btn btn-danger" id="statusBtn">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                
              </form>
              
            </div>
            
          
          </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal update status-->









<!-- modal edit cenp -->
<div class="modal fade" id="modal_edit_cenp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit PC details [Centralize Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="editpcform_cenp" id="editpcform_cenp" method="POST">
                <!-- AAAAA -->
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="ecenp_pc_make">Select PC make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="ecenp_pc_make" style="width: 100%;" name="ecenp_pc_make">
                          <?php foreach ($row_pcmake as $pcmake){ ?>
                            <option value="<?=$pcmake['autoID'];?>"><?=$pcmake['pc_make'] .'/'.$pcmake['pc_model'];?></option>
                          <?php } ?>
                          </select>
                          <input type="hidden" name="ecenp_pc_make_text" id="ecenp_pc_make_text">
                          <input type="hidden" name="ecenp_pc_model_text" id="ecenp_pc_model_text">
                          <input type="hidden" name="ecenp_pc_form_text" id="ecenp_pc_form_text">
                          <input type="hidden" name="hid_autoID" id="hid_autoID">

                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="ecenp_pc_os">Operating system</label>
                          <select class="form-control " id="ecenp_pc_os" style="width: 100%;" name="ecenp_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="ecenp_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="ecenp_pc_arch" style="width: 100%;" name="ecenp_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>
                        <!-- ROW -->

                        <div class="row">

                        

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="ecenp_ppc_ram">RAM (in GB)</label>
                                <input type="number" class="form-control" id="ecenp_ppc_ram" style="width: 100%;" name="ecenp_ppc_ram" min="1" max="32" placeholder="in GB">
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="ecenp_pc_hdd">Hard-disk(Capacity & Make)</label>
                                <input type="text" class="form-control" placeholder="HDD details" required="required" id="ecenp_pc_hdd" name="ecenp_pc_hdd">
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="ecenp_pc_ssd">SSD (in GB)</label>
                                <input type="number" class="form-control" id="ecenp_pc_ssd" style="width: 100%;" name="ecenp_pc_ssd" min="0" placeholder="SSD in GB">
                              </div>    
                            </div>

                            </div>

                            <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="ecenp_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="ecenp_pc_ip" style="width: 100%;" name="ecenp_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="ecenp_pc_setup">PC setup</label>
                          <select class="form-control" id="ecenp_pc_setup" style="width: 100%;" name="ecenp_pc_setup">
                          
                            <option value="internet+intranet">INTRANET + INTERNET (VM)</option>
                            <option value="intranet">Only intranet</option>
                            <option value="internet">Only internet</option>
                            <option value="not_connected">Not connected to network</option>
                          </select>
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="ecenp_pc_barc_asset_id">BARC Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by stores starts with BARC/I..."></span></label>
                          <input type="text" class="form-control" id="ecenp_pc_barc_asset_id" style="width: 100%;" name="ecenp_pc_barc_asset_id" placeholder="BARC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="ecenp_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="ecenp_pc_amc_id" style="width: 100%;" name="ecenp_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="ecenp_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="ecenp_pc_use" style="width: 100%;" name="ecenp_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="ecenp_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="ecenp_pc_location" style="width: 100%;" name="ecenp_pc_location" placeholder="Location">
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="ecenp_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="ecenp_pc_working" id="ecenp_pc_working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="ecenp_pc_working" id="ecenp_pc_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="ecenp_error"></div>
                <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
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
      <!-- /.modal edit-->

      <!-- modal view log -->
<div class="modal fade" id="modal_view_log">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Log</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <div class="card-body" id="showtableDesktopLog"></div>
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal edit-->





<!-- modal reassign -->
<div class="modal fade" id="modal_reassign">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Re-assign selected PC to other user</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="assignpcform" id="assignpcform" method="POST">
              <input type="hidden" class="form-control" id="autoID_assign" style="width: 100%;" name="autoID_assign" >
                



                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="sel_emp">Select employee <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select employee"></span></label>
                          <select class="form-control select2" id="sel_emp" style="width: 100%;" name="sel_emp"></select>
                        </div>    
                      </div>
                </div>

                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="rem_re_assign">Admin Remark </label>
                          <textarea class="form-control" id="rem_re_assign" style="width: 100%;" name="rem_re_assign"></textarea>
                        </div>    
                      </div>
                </div>




                <div class="modal-footer"><!-- modal footer -->
                <div id="reassign_error"></div>
                <button type="submit" class="btn btn-danger" id="reassignBtn">Re-assign</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                
              </form>
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal reassign-->







    
      
</body>
</html>
