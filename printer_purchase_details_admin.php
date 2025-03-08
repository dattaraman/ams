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
  <title>SIRD | Centralize Printer/Scanner purchase details</title>
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
          <h1 class="m-0">Centralize Printer/Scanner purchase details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Centralize Printer/Scanner purchase details</li>
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
                  <i class="fas fa-print"></i> Add Printer/Scanner purchase details
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
                  <form name="addprinterpurchase" id="addprinterpurchase" method="POST">
                 

                  <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="select_product">Select Product </label>
                          <select class="form-control select2" id="select_product" style="width: 100%;" name="select_product">
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">Multi Function Device</option>
                          </select>
                        </div>    
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="printer_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="printer_supplier" name="printer_supplier">
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
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="printer_make">Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="HP, Canon etc."></span></label>
                          <select class="form-control select2" id="printer_make" style="width: 100%;" name="printer_make">
                          <?php foreach ($row_pm as $mk){ ?>
                            <option value="<?=$mk['autoID'];?>"><?=$mk['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="printer_model">Model</label>
                          <input type="text" class="form-control" placeholder="Model" required="required" id="printer_model" name="printer_model">
                        </div>    
                      </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="printer_type">Colour/BW</label>
                          <select class="form-control select2" id="printer_type" style="width: 100%;" name="printer_type">
                            <option value="Colour">Colour</option>
                            <option value="Black & White">Black & White</option>
                          </select>
                        </div>    
                      </div>

                     

                    </div>

                    

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="printer_cost">Cost (Per device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="printer_cost" name="printer_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="printer_warranty">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="printer_warranty" name="printer_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="printer_warranty_uptodate">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="printer_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#printer_warranty_uptodate" name="printer_warranty_uptodate" id="printer_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#printer_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="printer_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="printer_rv_copy" id="printer_rv_copy" accept="image/*,pdf" />
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
              <h4 class="modal-title">Edit purchase details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                  <form name="updateprinterpurchase" id="updateprinterpurchase" method="POST">
                 

                  <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_select_product">Select Product </label>
                          <select class="form-control select2" id="e_select_product" style="width: 100%;" name="e_select_product">
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">Multi Function Device</option>
                          </select>
                        </div>    
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_printer_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="e_printer_supplier" name="e_printer_supplier">
                          <input type="hidden" class="form-control" placeholder="" required="required" id="e_loggedinbyemp" name="e_loggedinbyemp" value="<?php  echo $_SESSION['loggedinby'];?>">
                          <input type="hidden" id="e_id_update" name="e_id_update">
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
                          <div class="input-group date" id="e_indent_dt1" data-target-input="nearest">
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
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_printer_make">Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="HP, Canon etc."></span></label>
                          <select class="form-control select2" id="e_printer_make" style="width: 100%;" name="e_printer_make">
                          <?php foreach ($row_pm as $mk){ ?>
                            <option value="<?=$mk['autoID'];?>"><?=$mk['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_printer_model">Model</label>
                          <input type="text" class="form-control" placeholder="Model" required="required" id="e_printer_model" name="e_printer_model">
                        </div>    
                      </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_printer_type">Colour/BW</label>
                          <select class="form-control select2" id="e_printer_type" style="width: 100%;" name="e_printer_type">
                            <option value="Colour">Colour</option>
                            <option value="Black & White">Black & White</option>
                          </select>
                        </div>    
                      </div>

                     

                    </div>

                    

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_printer_cost">Cost (Per device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="e_printer_cost" name="e_printer_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_printer_warranty">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="e_printer_warranty" name="e_printer_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_printer_warranty_uptodate">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="e_printer_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_printer_warranty_uptodate" name="e_printer_warranty_uptodate" id="e_printer_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#printer_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="e_printer_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="e_printer_rv_copy" id="e_printer_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>


                  <div id="error_edit"></div>
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
                          <label for="v_select_product">Select Product </label>
                          <select class="form-control select2" id="v_select_product" style="width: 100%;" name="v_select_product" disabled>
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">Multi Function Device</option>
                          </select>
                        </div>    
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_printer_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="v_printer_supplier" name="v_printer_supplier" disabled>
                          
                        </div>    
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="v_indent_no" name="v_indent_no" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="v_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#v_indent_dt" name="v_indent_dt" id="v_indent_dt" placeholder="Indent date" disabled/>
                            <div class="input-group-append" data-target="#v_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="v_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="v_indent_by" name="v_indent_by" disabled>
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="v_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="v_po_no" name="v_po_no" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#v_po_dt" name="v_po_dt" id="v_po_dt" placeholder="PO Date" disabled/>
                          <div class="input-group-append" data-target="#v_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label for="v_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="v_rv_no" name="v_rv_no" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="vrv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#v_rv_dt" name="v_rv_dt" id="v_rv_dt" placeholder="RV Date" disabled/>
                          <div class="input-group-append" data-target="#v_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_rv_qty">Received Qty.</label>
                          <input type="number" class="form-control" placeholder="Qty." id="v_rv_qty" name="v_rv_qty" min="0" disabled>
                          <!-- <datalist id="all_emp"></datalist> -->
                        </div>   
                      </div>

                    </div>


                    
                    
                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_printer_make">Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="HP, Canon etc."></span></label>
                          <select class="form-control select2" id="v_printer_make" style="width: 100%;" name="v_printer_make" disabled>
                          <?php foreach ($row_pm as $mk){ ?>
                            <option value="<?=$mk['autoID'];?>"><?=$mk['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_printer_model">Model</label>
                          <input type="text" class="form-control" placeholder="Model" required="required" id="v_printer_model" name="v_printer_model" disabled>
                        </div>    
                      </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_printer_type">Colour/BW</label>
                          <select class="form-control select2" id="v_printer_type" style="width: 100%;" name="v_printer_type" disabled>
                            <option value="Colour">Colour</option>
                            <option value="Black & White">Black & White</option>
                          </select>
                        </div>    
                      </div>

                     

                    </div>

                    

                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_printer_cost">Cost (Per device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="v_printer_cost" name="v_printer_cost" min="0" disabled>
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_printer_warranty">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="v_printer_warranty" name="v_printer_warranty" min="0" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_printer_warranty_uptodate1">Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="e_printer_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#v_printer_warranty_uptodate" name="v_printer_warranty_uptodate" id="v_printer_warranty_uptodate" placeholder="Date" disabled/>
                          <div class="input-group-append" data-target="#v_printer_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
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

    get_printer_purchase_details();
    function get_printer_purchase_details(){
     
     $.ajax({  
     url: "get_printer_purchase_details.php",
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
    $("#addprinterpurchase").validate({
            rules: {
              select_product: "required",
              printer_supplier : "required",
              indent_no : "required",
              indent_dt : "required",
              indent_by : "required",
              po_no: "required",
              po_dt: "required",
              rv_no : "required",
              rv_dt : "required",
              rv_qty : "required",
              printer_make: "required",
              printer_model: "required",
              printer_type: "required",
              printer_warranty: "required",
              printer_warranty_uptodate: "required",
              printer_cost: "required"
            },
            messages: {
              select_product: "Select product",
              printer_supplier : "Enter supplier name",
              indent_no : "Enter indent number",
              indent_dt : "Enter indent date",
              indent_by : "Enter name of indentor",
              po_no: "Enter PO number",
              po_dt: "Enter PO date",
              rv_no : "Enter RV number",
              rv_dt : "Enter RV date",
              rv_qty : "Enter Qty.",
              printer_make: "Enter printer make",
              printer_model: "Enter printer model",
              printer_type: "Select type",
              printer_warranty: "Enter warranty in years",
              printer_warranty_uptodate: "Enter warranty upto date",
              printer_cost: "Enter cost"
            },
            submitHandler: function(form) {
              var file_data = $('#printer_rv_copy').prop('files')[0];   
              var op = 'add_purchase';
              var formData = new FormData($('#addprinterpurchase')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
        cache: false,
        contentType: false,
        processData: false,
        type : 'post',
        url : 'get_printer_purchase_details.php',
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
            $("#addprinterpurchase").trigger("reset");
            $("#error_add").fadeOut();
            $("#saveBtn").html('Save');
            showtoast("Printer purchase record added successfully!");
            get_printer_purchase_details();


            });

            }

}
});
            }
       
    });
    // add pc


// add pc
$("#updateprinterpurchase").validate({
            rules: {
              e_select_product : "required",
              e_printer_supplier : "required",
              e_indent_no : "required",
              e_indent_dt : "required",
              e_indent_by: "required",
              e_po_no: "required",
              e_po_dt: "required",
              e_rv_no: "required",
              e_rv_no: "required",
              e_rv_dt: "required",
              e_rv_qty: "required",
              e_printer_make: "required",
              e_printer_model: "required",
              e_printer_type: "required",
              e_printer_cost: "required",
              e_printer_warranty: "required",
              e_printer_warranty_uptodate: "required"
            },
            messages: {
              e_select_product : "Select product",
              e_printer_supplier : "Enter name of supplier",
              e_indent_no : "Enter indent number",
              e_indent_dt : "Select indent date",
              e_indent_by: "Enter name of indentor",
              e_po_no: "Emter PO number",
              e_po_dt: "Select PO date",
              e_rv_no: "Enter RV Number",
              e_rv_dt: "Select RV date",
              e_rv_qty: "Enter received qty.",
              e_printer_make: "Select device make",
              e_printer_model: "Enter device model",
              e_printer_type: "Select device type",
              e_printer_cost: "Enter device cost",
              e_printer_warranty: "Enter warranty in years",
              e_printer_warranty_uptodate: "Select warranty date"
            },
            submitHandler: function(form) {
              var file_data = $('#e_printer_rv_copy').prop('files')[0];   
              var op = 'edit_purchase';
              var formData = new FormData($('#updateprinterpurchase')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
        cache: false,
        contentType: false,
        processData: false,
        type : 'post',
        url : 'get_printer_purchase_details.php',
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
            $("#updateprinterpurchase").trigger("reset");
            $("#error_edit").fadeOut();
            $("#updateBtn").html('Save');
            showtoast("Record updated successfully!");
            get_printer_purchase_details();


            });

            }

}
});
            }
       
    });
    // edit pc

    function get_purchasedetails_byid_edit(id){
      $.ajax({  
       url: "get_printer_purchase_details.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        $("#e_select_product").val(data.device);
        $("#e_printer_supplier ").val(data.details_of_supplier);
        $("#e_indent_no ").val(data.indent_no);
        $("#e_indent_dt ").val(data.indent_dt);
        $("#e_indent_by").val(data.indentor_emp);
        $("#e_po_no").val(data.po_no);
        $("#e_po_dt").val(data.po_dt);
        $("#e_rv_no").val(data.rv_no);
        $("#e_rv_dt").val(data.rv_dt);
        $("#e_rv_qty").val(data.qty_received);
        $("#e_printer_make").val(data.device_make);
        $("#e_printer_model").val(data.device_model);
        $("#e_printer_type").val(data.device_tone);
        $("#e_printer_cost").val(data.device_cost);
        $("#e_printer_warranty").val(data.warranty_in_years);
        $("#e_printer_warranty_uptodate").val(data.warranty_upto);
        $("#e_id_update").val(data.autoID);
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
        url : 'get_printer_purchase_details.php',
        data: {operation:'delete_record',forid : id},
        beforeSend: function(){
        $("#deleteBtn").html('Deleting record ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            get_printer_purchase_details();
            showtoast("Purchase record deleted successfully!");
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
       url: "get_printer_purchase_details.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);

        $("#v_select_product").val(data.device);
        $("#v_printer_supplier ").val(data.details_of_supplier);
        $("#v_indent_no ").val(data.indent_no);
        $("#v_indent_dt ").val(data.indent_dt);
        $("#v_indent_by").val(data.indentor_emp);
        $("#v_po_no").val(data.po_no);
        $("#v_po_dt").val(data.po_dt);
        $("#v_rv_no").val(data.rv_no);
        $("#v_rv_dt").val(data.rv_dt);
        $("#v_rv_qty").val(data.qty_received);
        $("#v_printer_make").val(data.device_make);
        $("#v_printer_model").val(data.device_model);
        $("#v_printer_type").val(data.device_tone);
        $("#v_printer_cost").val(data.device_cost);
        $("#v_printer_warranty").val(data.warranty_in_years);
        $("#v_printer_warranty_uptodate").val(data.warranty_upto);
        $("#e_id_update").val(data.autoID);
       
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

    $('#printer_warranty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        

    });
    $('#e_printer_warrabty_uptodate').datetimepicker({
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
