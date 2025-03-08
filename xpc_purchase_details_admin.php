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
  <title>SIRD | PC purchase details</title>
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
            <h1 class="m-0">PC purchase details</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">PC purchase details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
                <h3 class="card-title float-right"><button class="btn btn-app bg-danger"  data-toggle="modal" data-target="#modal_add">
                  <i class="far fa-file-alt"></i> Add purchase details
              </button></h3>

             
              </div>
              <input type="hidden" id="aa">
              <!-- /.card-header -->
              <div class="toastctrl"></div>
              <div class="card-body" id="showusers"></div>
              
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

//// START ////

$('#indent_dt').datetimepicker({
        format: 'YYYY-MM-DD'
    });




  
    
  });
  
</script>



     <!-- modal add -->
     <div class="modal fade" id="modal_add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Add purchase details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <form name="addpurchase" id="addpurchase" method="POST">
                 
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" title="Name, address of supplier"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="pc_supplier" name="pc_supplier">
                        </div>    
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Supplier details" id="indent_no" name="indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label>Date of indent</label>
                          <div class="input-group date" id="indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indent_dt" name="indent_dt"/>
                            <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_make">PC Make</label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="pc_make" name="pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_model">Processor details</label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="pc_model" name="pc_model">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="pro_contact1">Contact</label>
                          <input type="text" class="form-control" placeholder="Contact no." required="required" id="pro_contact1" name="pro_contact1">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="pro_contact2">Alternate contact</label>
                          <input type="text" class="form-control" placeholder="Alternate contact no." id="pro_contact2" name="pro_contact2">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="pro_email">Email</label>
                          <input type="text" class="form-control" required="required" placeholder="Email" id="pro_email" name="pro_email">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="pro_address">Address</label>
                          <textarea class="form-control" placeholder="Address" id="pro_address" name="pro_address"> </textarea>
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

     
     <!-- modal edit -->
     <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Update PRO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <form name="editproForm" id="editproForm" method="POST">
                    
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_pro_name">Name</label>
                          <input type="hidden" class="form-control" id="hid_autoID" name="hid_autoID">
                          <input type="text" class="form-control" placeholder="Name" required="required" id="e_pro_name" name="e_pro_name">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="e_pro_contact1">Contact</label>
                          <input type="text" class="form-control" placeholder="Contact no." required="required" id="e_pro_contact1" name="e_pro_contact1">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="e_pro_contact2">Alternate contact</label>
                          <input type="text" class="form-control" placeholder="Alternate contact no." id="e_pro_contact2" name="e_pro_contact2">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_pro_email">Email</label>
                          <input type="text" class="form-control" required="required" placeholder="Email" id="e_pro_email" name="e_pro_email">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_pro_address">Address</label>
                          <textarea class="form-control" placeholder="Address" id="e_pro_address" name="e_pro_address"> </textarea>
                        </div>    
                      </div>
                    </div>


                  <div id="e_error"></div>
                  <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="updateBtn">Save</button>
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
      <!-- /.modal edit-->

      <!-- modal view -->
     <div class="modal fade" id="modal_view">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PRO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  
                    
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_pro_name">Name</label>
                          
                          <input type="text" class="form-control" placeholder="Name" id="v_pro_name" name="v_pro_name">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="v_pro_contact1">Contact</label>
                          <input type="text" class="form-control" placeholder="Contact no." id="v_pro_contact1" name="v_pro_contact1">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="v_pro_contact2">Alternate contact</label>
                          <input type="text" class="form-control" placeholder="Alternate contact no." id="v_pro_contact2" name="v_pro_contact2">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_pro_email">Email</label>
                          <input type="text" class="form-control" required="required" placeholder="Email" id="v_pro_email" name="v_pro_email">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_pro_address">Address</label>
                          <textarea class="form-control" placeholder="Address" id="v_pro_address" name="v_pro_address"> </textarea>
                        </div>    
                      </div>
                    </div>


                  
                  <div class="modal-footer">
              
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
      <!-- /.modal view-->


    
    <!-- modal import -->
     <div class="modal fade" id="modal_import">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Import CSV file</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                <div class="col-md-12" id="importFrm">
                <form method="post" enctype="multipart/form-data" name="Formimportcsv" id="Formimportcsv">
                  <!-- display combobox to select hosp to import -->
                  <div class="form-group w-50 m-2" >
                          <label for="sel_hospcode_import">Select hospital to import into</label><br>
                          <select class="form-control select1" id="sel_hospcode_import" style="width: 100%;" name="sel_hospcode_import" >
                    <?php if($_SESSION['user_type']=='superadmin'){?>
                      <?php foreach ($res_hosp as $hosp){ ?>
                            <option value="<?=$hosp['hosp_code'];?>"><?=$hosp['hosp_name'];?></option>
                          <?php }  ?>
                        <?php } else {?>
                          <option value="<?=$res_sidebar['hospcode'];?>"><?=$res_sidebar['hosp_name'];?></option>
                        <?php }?>
                      </select>
                        </div><br>
                    <!-- display combobox to select hosp to import -->
                    <input type="file" name="fileup" id="fileup" accept=".csv" />
                    <button type="button" class="btn btn-primary" name="importSubmit" id="importSubmit">Import</button>
                  </form>
                </div>
                <div id="import_error"></div>
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal import-->


      </body>
</html>
