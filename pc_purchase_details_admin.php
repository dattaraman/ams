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
  <title>SIRD | Centralize PC purchase details</title>
  <style>
    .error{
      color:red;
    }
    .abc {
      font-size:18px;
    }
    .abc input{
      margin-top:4px;
      height:50px;
      width:100%;
      border:none;
      outline:none;
      font-size:18px;
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
          <h1 class="m-0">Centralize PC purchase details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Centralize PC purchase details</li>
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
              
              <h3 class="card-title float-right"><button class="btn btn-app bg-danger"  data-toggle="modal" data-target="#modal_add">
                  <i class="far fa-file-alt"></i> Add purchase details
              </button></h3>
              
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row" id="showusers"></div>
                  <hr>
                
              </div><!-- /.card-body -->
              
              
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
                  <form name="addpcpurchase" id="addpcpurchase" method="POST">
                 
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="pc_supplier" name="pc_supplier">
                          <input type="hidden" class="form-control" placeholder="" required="required" id="loggedinbyemp" name="loggedinbyemp" value="<?php  echo $_SESSION['loggedinby'];?>">
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indent_no" name="indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indent_dt" name="indent_dt" id="indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indent_by" name="indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="po_no" name="po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#po_dt" name="po_dt" id="po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label for="rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="rv_no" name="rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#rv_dt" name="rv_dt" id="rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="rv_qty">Received Qty.</label>
                          <input type="number" class="form-control" placeholder="Qty." id="rv_qty" name="rv_qty" min="0">
                          <!-- <datalist id="all_emp"></datalist> -->
                        </div>   
                      </div>

                    </div>


                    
                    
                    <div class="row">

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_form">Form Factor <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Desktop, Laptop"></span></label>
                          <select class="form-control select2" id="pc_form" style="width: 100%;" name="pc_form">
                            <option value="desktop">Desktop</option>
                            <option value="laptop">Laptop</option>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
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


                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="RAM in GB"></span></label>
                          <input type="number" class="form-control" placeholder="RAM details" required="required" id="pc_ram" name="pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_hdd">Hard-disk capacity</label>
                          <input type="number" class="form-control" placeholder="HDD details" required="required" id="pc_hdd" name="pc_hdd" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_ssd">SSD Capacity (if any) in GB</label>
                          <input type="number" class="form-control" placeholder="SSD details" id="pc_ssd" name="pc_ssd" min="0">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="pc_os">Operating system</label>
                          <select class="form-control select2" id="pc_os" style="width: 100%;" name="pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_monitor">Display monitor details</label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="pc_monitor" name="pc_monitor">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="pc_cost" name="pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="pc_warranty" name="pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_warrabty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="pc_warrabty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#pc_warrabty_uptodate" name="pc_warrabty_uptodate" id="pc_warrabty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#pc_warrabty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="pc_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="pc_rv_copy" id="pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>


                  <div id="error_add"></div>
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
          
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <form name="editpcpurchase" id="editpcpurchase" method="POST">
                 
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="e_pc_supplier" name="e_pc_supplier">
                          <input type="hidden" class="form-control" placeholder="" required="required" id="e_loggedinbyemp" name="e_loggedinbyemp" value="<?php  echo $_SESSION['loggedinby'];?>">
                          <input type="hidden" class="form-control" placeholder="" required="required" id="e_recordid" name="e_recordid">
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="e_indent_no" name="e_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#e_indent_dt" name="e_indent_dt" id="e_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#e_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="e_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="e_indent_by" name="e_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="e_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="e_po_no" name="e_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_po_dt" name="e_po_dt" id="e_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#e_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label for="e_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="e_rv_no" name="e_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_rv_dt" name="e_rv_dt" id="e_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#e_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_rv_qty">Received Qty.</label>
                          <input type="number" class="form-control" placeholder="Qty." id="e_rv_qty" name="e_rv_qty" min="0">
                          <!-- <datalist id="all_emp"></datalist> -->
                        </div>   
                      </div>

                    </div>


                    
                    
                    <div class="row">

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_form">Form Factor <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Desktop, Laptop"></span></label>
                          <select class="form-control select2" id="e_pc_form" style="width: 100%;" name="e_pc_form">
                            <option value="desktop">Desktop</option>
                            <option value="laptop">Laptop</option>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="e_pc_make" name="e_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_model">Processor details</label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="e_pc_model" name="e_pc_model">
                        </div>    
                      </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="RAM in GB"></span></label>
                          <input type="number" class="form-control" placeholder="RAM details" required="required" id="e_pc_ram" name="e_pc_ram" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="e_pc_hdd" name="e_pc_hdd">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_ssd">SSD Capacity (if any) in GB</label>
                          <input type="number" class="form-control" placeholder="SSD details" id="e_pc_ssd" name="e_pc_ssd" min="0">
                        </div>    
                      </div>




                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_pc_os">Operating system</label>
                          <select class="form-control select2" id="e_pc_os" style="width: 100%;" name="e_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_pc_monitor">Display monitor details</label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="e_pc_monitor" name="e_pc_monitor">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="e_pc_cost" name="e_pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="e_pc_warranty" name="e_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_pc_warrabty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="e_pc_warrabty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_pc_warrabty_uptodate" name="e_pc_warrabty_uptodate" id="e_pc_warrabty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#e_pc_warrabty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="e_pc_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="e_pc_rv_copy" id="e_pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>


                  <div id="error_edit"></div>
                  <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
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

       <!-- modal delete -->
  <div class="modal fade" id="modal_delete">
  <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Delete record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <h5>Are you sure?</h5>
                  <input type="hidden" name="delid" id="delid">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
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
      <!-- /.modal delete-->

      <!-- /.modal view-->

      <div class="modal fade" id="modal_view">
  <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header bg-primary">
              <h4 class="modal-title">View details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                 
                 
                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="v_pc_supplier" name="v_pc_supplier" readonly>
                         
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="v_indent_no" name="v_indent_no" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control" readonly name="v_indent_dt" id="v_indent_dt" placeholder="Indent date" readonly/>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="v_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="v_indent_by" name="v_indent_by" readonly>
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="v_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="v_po_no" name="v_po_no" readonly>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control" name="v_po_dt" id="v_po_dt" placeholder="PO Date" readonly />
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label for="v_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="v_rv_no" name="v_rv_no" readonly>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-contro" name="v_rv_dt" id="v_rv_dt" placeholder="RV Date" readonly />
                        </div>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_rv_qty">Received Qty.</label>
                          <input type="number" class="form-control" placeholder="Qty." id="v_rv_qty" name="v_rv_qty" min="0" readonly>
                          <!-- <datalist id="all_emp"></datalist> -->
                        </div>   
                      </div>

                    </div>


                    
                    
                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="v_pc_make" name="v_pc_make" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_pc_model">Processor details</label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="v_pc_model" name="v_pc_model" readonly>
                        </div>    
                      </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="RAM in GB"></span></label>
                          <input type="text" class="form-control" placeholder="RAM details" required="required" id="v_pc_ram" name="v_pc_ram" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_pc_hdd">Hard-disk capacity (in GB)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="v_pc_hdd" name="v_pc_hdd" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_pc_ssd">SSD (in GB)</label>
                          <input type="text" class="form-control" placeholder="SSD details" required="required" id="v_pc_ssd" name="v_pc_ssd" readonly>
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_pc_os">Operating system</label>
                          <input type="text" class="form-control" id="v_pc_os" style="width: 100%;" name="v_pc_os" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_pc_monitor">Display monitor details</label>
                          <input type="text" readonly class="form-control" placeholder="Display monitor details" required="required" id="v_pc_monitor" name="v_pc_monitor">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="v_pc_cost" name="v_pc_cost" min="0" readonly>
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" readonly class="form-control" placeholder="in"  id="v_pc_warranty" name="v_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_warrabty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <input type="text" class="form-control" name="v_pc_warrabty_uptodate" id="v_pc_warrabty_uptodate" placeholder="Date" readonly />
                        </div> 
                      </div>

                    </div>

                    


                  <div id="error_add"></div>
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



  
  <!-- /.content-wrapper -->
 <?php include ('footer.php');?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(function () {

    getpurchasedetails();
    function getpurchasedetails(){
     
     $.ajax({  
     url: "get_pc_purchase_details.php",
     type: "POST",
     data: {operation:"alllist"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
        //console.log(response);
        $("#showusers").html(response);
        $("#example1").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: true,
          buttons: ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_filter');
      }
   });
   

   }


    // add pc
    $("#addpcpurchase").validate({
            rules: {
              pc_supplier : "required",
              indent_no : "required",
              indent_dt : "required",
              indent_by : "required",
              rv_no : "required",
              rv_dt : "required",
              rv_qty : "required",
              pc_make : "required",
              pc_form : "required",
              pc_model : "required",
              pc_ram : "required",
              pc_hdd : "required",
              pc_os : "required",
              pc_monitor : "required" ,
              pc_cost : "required"
            },
            messages: {
              pc_supplier : "Enter supplier name",
              indent_no : "Enter indent no.",
              indent_dt : "Enter date",
              indent_by : "Enter employee number",
              rv_no : "Enter RV number",
              rv_dt : "Enter RV date",
              rv_qty : "Enter Qty.",
              pc_make : "Enter PC Make",
              pc_form : "Select form",
              pc_model : "Enter model",
              pc_ram : "Enter RAM",
              pc_hdd : "Enter HDD Information",
              pc_os : "Select OS",
              pc_monitor : "Enter monitor details",
              pc_cost : "Enter cost"
            },
            submitHandler: function(form) {
              var file_data = $('#pc_rv_copy').prop('files')[0];   
              var op = 'add_purchase';
              var formData = new FormData($('#addpcpurchase')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
        cache: false,
        contentType: false,
        processData: false,
        type : 'post',
        url : 'get_pc_purchase_details.php',
        data : formData,
        beforeSend: function(){
        $("#error_add").fadeOut();
        $("#saveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error_add").fadeIn(1000, function(){
            $("#error_add").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#saveBtn").html('Save');
            });
            }
            else {
            
            $("#error_add").fadeIn(1000, function(){
            $("#modal_add").modal('hide');
            $("#addpcpurchase").trigger("reset");
            $("#error_add").fadeOut();
            $("#saveBtn").html('Save');
            showtoast("PC purchase record added successfully!");
            getpurchasedetails();


            });

            }

}
});
            }
       
    });
    // add pc


// add pc
$("#editpcpurchase").validate({
            rules: {
              e_pc_supplier : "required",
              e_indent_no : "required",
              e_indent_dt : "required",
              e_indent_by : "required",
              e_rv_no : "required",
              e_rv_dt : "required",
              e_rv_qty : "required",
              e_pc_form : "required",
              e_pc_make : "required",
              e_pc_model : "required",
              e_pc_ram : "required",
              e_pc_hdd : "required",
              e_pc_os : "required",
              e_pc_monitor : "required" ,
              e_pc_cost : "required",
              e_recordid : "required",
              e_pc_warranty : "required",
              e_pc_warrabty_uptodate : "required"
            },
            messages: {
              e_pc_supplier : "Enter supplier name",
              e_indent_no : "Enter indent no.",
              e_indent_dt : "Enter date",
              e_indent_by : "Enter employee number",
              e_rv_no : "Enter RV number",
              e_rv_dt : "Enter RV date",
              e_pc_form : "Select form",
              e_rv_qty : "Enter Qty.",
              e_pc_make : "Enter PC Make",
              e_pc_model : "Enter model",
              e_pc_ram : "Enter RAM",
              e_pc_hdd : "Enter HDD Information",
              e_pc_os : "Select OS",
              e_pc_monitor : "Enter monitor details",
              e_pc_cost : "Enter cost",
              e_recordid : "INVALID SELECTION",
              e_pc_warranty : "Enter warranty in years",
              e_pc_warrabty_uptodate : "Enter warranty (upto date)"
            },
            submitHandler: function(form) {
              var file_data = $('#e_pc_rv_copy').prop('files')[0];   
              var op = 'edit_purchase';
              var formData = new FormData($('#editpcpurchase')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
        cache: false,
        contentType: false,
        processData: false,
        type : 'post',
        url : 'get_pc_purchase_details.php',
        data : formData,
        beforeSend: function(){
        $("#error_edit").fadeOut();
        $("#updateBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error_edit").fadeIn(1000, function(){
            $("#error_edit").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#updateBtn").html('Save');
            });
            }
            else {
            
            $("#error_edit").fadeIn(1000, function(){
            $("#modal_edit").modal('hide');
            $("#editpcpurchase").trigger("reset");
            $("#error_edit").fadeOut();
            $("#updateBtn").html('Save');
            showtoast("PC purchase record updated successfully!");
            getpurchasedetails();


            });

            }

}
});
            }
       
    });
    // edit pc

    function get_purchasedetails_byid_edit(id){
      $.ajax({  
       url: "get_pc_purchase_details.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        $("#e_pc_supplier").val(data.details_of_supplier);
        $("#e_indent_no").val(data.indent_no);
        $("#e_indent_dt").val(data.indent_dt);
        $("#e_indent_by").val(data.indentor_emp);
        $("#e_po_no").val(data.po_no);
        $("#e_po_dt").val(data.po_dt);
        $("#e_rv_no").val(data.rv_no);
        $("#e_rv_dt").val(data.rv_dt);
        $("#e_rv_qty").val(data.qty_received);
        $("#e_pc_form").val(data.pc_form);
        $("#e_pc_make").val(data.pc_make);
        $("#e_pc_model").val(data.pc_model);
        $("#e_pc_ram").val(data.pc_ram_details);
        $("#e_pc_hdd").val(data.pc_hdd_details);
        $("#e_pc_ssd").val(data.pc_ssd_details);
        $("#e_pc_os").val(data.pc_os_details);
        $("#e_pc_monitor").val(data.pc_monitor_details);
        $("#e_pc_cost").val(data.pc_cost);
        $("#e_pc_warranty").val(data.warranty_in_years);
        $("#e_pc_warrabty_uptodate").val(data.warranty_upto);
        $("#e_recordid").val(data.autoID);
    }
      });
    }

    //getallemp();
//alert("Hello");
function getallemp(c){
      var s = '';
      var rec_value =c;
      //alert(rec_value);
      
      $.ajax({  
       url: "get_pc_purchase_details.php",
       type: "POST",
       data: {operation:'get_all_emp'},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        //alert(data);
        
                
                for (var i = 0; i < data.length; i++) {  
                   s += '<option value="' + data[i].emp_no + '">' + data[i].emp_name +'</option>';  
               } 
                    
                    
     //alert(s);
     
                    $('#all_emp').append(s);
                   
                           
       }

     });
     //alert(s);
    }


    function delete_purchase_data(id){
      $.ajax({
        type : 'post',
        url : 'get_pc_purchase_details.php',
        data: {operation:'delete_record',forid : id},
        beforeSend: function(){
        $("#deleteBtn").html('Saving data ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            getpurchasedetails();
            showtoast("PC purchase record deleted successfully!");
            $("#modal_delete").modal('hide');
            $("#delid").val('');
            $("#deleteBtn").html("Delete");
           

          }else{
            showtoast("Internal server error!");
          } 
        }
    });
    }

    function get_purchasedetails_byid_view(id){
      $.ajax({  
       url: "get_pc_purchase_details.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        $("#v_pc_supplier").val(data.details_of_supplier);
        $("#v_indent_no").val(data.indent_no)
        $("#v_indent_dt").val(data.indent_dt)
        $("#v_indent_by").val(data.indentor_emp)
        $("#v_po_no").val(data.po_no)
        $("#v_po_dt").val(data.po_dt)
        $("#v_rv_no").val(data.rv_no)
        $("#v_rv_dt").val(data.rv_dt)
        $("#v_rv_qty").val(data.qty_received)
        $("#v_pc_make").val(data.pc_make)
        $("#v_pc_model").val(data.pc_model)
        $("#v_pc_ram").val(data.pc_ram_details)
        $("#v_pc_hdd").val(data.pc_hdd_details)
        $("#v_pc_ssd").val(data.pc_ssd_details)
        $("#v_pc_os").val(data.pc_os_details)
        $("#v_pc_monitor").val(data.pc_monitor_details)
        $("#v_pc_cost").val(data.pc_cost)
        $("#v_pc_warranty").val(data.warranty_in_years)
        $("#v_pc_warrabty_uptodate").val(data.warranty_upto)
       
    }
      });
    }

    //getallemp();
//alert("Hello");
function getallemp(c){
      var s = '';
      var rec_value =c;
      //alert(rec_value);
      
      $.ajax({  
       url: "get_pc_purchase_details.php",
       type: "POST",
       data: {operation:'get_all_emp'},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        //alert(data);
        
                
                for (var i = 0; i < data.length; i++) {  
                   s += '<option value="' + data[i].emp_no + '">' + data[i].emp_name +'</option>';  
               } 
                    
                    
     //alert(s);
     
                    $('#all_emp').append(s);
                   
                           
       }

     });
     //alert(s);
    }

    $("#deleteBtn").click(function(){
        delete_purchase_data($("#delid").val());
    });

    $("body").on("click", ".delete_details", function (e) {
      //alert($(this).data('id'));
      $("#delid").val($(this).data('id'));
    });

    $("body").on("click", ".edit_details", function (e) {
      //alert($(this).data('id'));
      get_purchasedetails_byid_edit($(this).data('id'));
    });

    $("body").on("click", ".view_details", function (e) {
      //alert($(this).data('id'));
      get_purchasedetails_byid_view($(this).data('id'));
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#indent_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#e_indent_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#rv_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });
    $('#e_rv_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#po_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });
    $('#e_po_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#pc_warrabty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        

    });
    $('#e_pc_warrabty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        

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
