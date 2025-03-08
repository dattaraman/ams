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
  <title>SIRD | PC & Accessories</title>
  
  <style>
    .error{
      color:red;
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
            <h1 class="m-0">PC & Accessories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">PC & Accessories</li>
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
              
              <h3 class="card-title float-right"><button class="btn btn-app bg-warning "  data-toggle="modal" data-target="#modal_add_printer">
                  <i class="fas fa-print"></i> Add new Printer/Scanner
              </button></h3>

              <h3 class="card-title float-right"><button class="btn btn-app bg-danger"  data-toggle="modal" data-target="#modal_add">
                  <i class="fas fa-desktop"></i> Add PC
              </button></h3>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row" id="showtable"></div>
                  <hr>
                  <div class="row" id="showtable_printer"></div>
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


   <!-- modal add1 -->
   <div class="modal fade" id="modal_add_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Add Printer/Scanner/MFD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="addprinterform" id="addprinterform" method="POST">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOneP" aria-expanded="true" aria-controls="collapseOneP">
                        <label for="printer_purchase">Mode of acquisition <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Mode of acquisition/purchase of device"></span>
                          </a>
                      </h5>
                      <span class="text-sm text-danger">In case  PC/Device purchase information is not availble, select individual/group purchase by indent and type NA in supplier field and select NA in suggestions, and fill the available information of PC/Device</span><br>
                      <div id="sel_printer_mode" class="text-sm text-secondary text-bold"></div>
                    </div>

                    <div id="collapseOneP" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <div class="row">
                        <div class="col-lg-12 col-12">
                        <div class="form-group">
                    
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="printer_purchase" style="width: 100%;" name="printer_purchase">
                            <!-- <option value="Alloted">Alloted by division</option> -->
                            <option value="Centralize">Alloted by division / Centralize purchase</option>
                            <option value="Individual">Individual/Group purchase by indent</option>
                            <option value="Borrowed">Brought from outside division</option>
                          </select><br>
                          <button type="button" id="btn_printer_sel_mode" class=" btn btn-sm btn-primary">Next</button>
                        </div>    
                      </div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="card pcenp">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecentralPrinterPurchase" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                         
                      </h5>
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapsecentralPrinterPurchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="printer_make">Select printer make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="printer_make" style="width: 100%;" name="printer_make">
                          <?php foreach ($row_printermake as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= '['.$printermake['device'].'] '.$printermake['dm'] .'/'.$printermake['device_model'] .' - RV No. '.$printermake['rv_no'].' dt. '.date("d/m/Y", strtotime($printermake['rv_dt'])) ;?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                     
                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="printer_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="printer_barc_asset_id" style="width: 100%;" name="printer_barc_asset_id" placeholder="Asset ID provided by HR/precurement">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="printer_amc_id" style="width: 100%;" name="printer_amc_id" placeholder="PRN or SCN/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="printer_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="printer_use" style="width: 100%;" name="printer_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="printer_location">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of device"></span></label>
                                <input type="text" class="form-control" id="printer_location" style="width: 100%;" name="printer_location" placeholder="Location">
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="device_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="device_working" id="device_working_y" value="1" checked> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="device_working" id="device_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>

                      
                     
                    </div>
                    
                    <div class="modal-footer"><!-- modal footer -->
                <div id="printer_cenperror"></div>
                <button type="submit" class="btn btn-primary" id="psaveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>



                <!-- indi p -->

                <div class="card pindip">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseindiPrinterPurchase" aria-expanded="false" aria-controls="collapseindiPrinterPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                      
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapseindiPrinterPurchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <form name="addindideviceform" id="addindideviceform" method="POST">
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="indi_device" style="width: 100%;" name="indi_device">
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Supplier details" id="indi_device_supplier" name="indi_device_supplier">
                          
                        </div>    
                      </div>

                     

                    </div>
                    <div class="row">
                            <div class="col-lg-12">
                              <ul id="suggesstion-box_printer" style="width: 100%;" name="suggesstion-box_printer" class="list-group"></ul>
                            </div>
                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indi_device_indent_no" name="indi_device_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indi_device_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_indent_dt" name="indi_device_indent_dt" id="indi_device_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#indi_device_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indi_device_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indi_device_indent_by" name="indi_device_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="indi_device_po_no" name="indi_device_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="indi_device_po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_po_dt" name="indi_device_po_dt" id="indi_device_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#indi_device_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="indi_device_rv_no" name="indi_device_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="indi_device_rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_rv_dt" name="indi_device_rv_dt" id="indi_device_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#indi_device_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_cost">Cost (Per Device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="indi_device_cost" name="indi_device_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="In Years"  id="indi_device_warranty" name="indi_device_warranty" min="0" value="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_uptodate">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="indi_device_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_warranty_uptodate" name="indi_device_warranty_uptodate" id="indi_device_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#indi_device_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_device_make">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="indi_device_make" style="width: 100%;" name="indi_device_make">
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_device_model">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="indi_device_model" style="width: 100%;" name="indi_device_model" placeholder="Eg. Laserjet 403 Dn">
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_device_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="indi_device_barc_asset_id" style="width: 100%;" name="indi_device_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="indi_device_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="indi_device_amc_id" style="width: 100%;" name="indi_device_amc_id" placeholder="PC/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="indi_device_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="indi_device_use" style="width: 100%;" name="indi_device_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="indi_device_location">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of device"></span></label>
                                <input type="text" class="form-control" id="indi_device_location" style="width: 100%;" name="indi_device_location" placeholder="Location">
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="indi_device_tone">Device tone </label>
                                <select class="form-control" id="indi_device_tone" style="width: 100%;" name="indi_device_tone">
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="indi_device_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="indi_device_rv_copy" id="indi_device_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>


                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="indi_device_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="indi_device_working" id="indi_device_working_y" value="1" checked> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="indi_device_working" id="indi_device_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                      </div>

                  
                     
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="device_indiperror"></div>
                <button type="submit" class="btn btn-primary" id="dindisaveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>


                <!-- indi p -->
                <!-- AAAAA -->


                <!-- borrowed -->

                <!-- indi p -->

                <div class="card pborrowedp">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseBorPrinterPurchase" aria-expanded="false" aria-controls="collapseBorPrinterPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapseBorPrinterPurchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <form name="addbordeviceform" id="addbordeviceform" method="POST">
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="bor_device">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="bor_device" style="width: 100%;" name="bor_device">
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_make">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="bor_device_make" style="width: 100%;" name="bor_device_make">
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_model">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="bor_device_model" style="width: 100%;" name="bor_device_model" placeholder="Eg. Laserjet 403 Dn">
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="bor_device_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="bor_device_barc_asset_id" style="width: 100%;" name="bor_device_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="bor_device_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="bor_device_amc_id" style="width: 100%;" name="bor_device_amc_id" placeholder="PC/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="bor_device_use" style="width: 100%;" name="bor_device_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_location">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="bor_device_location" style="width: 100%;" name="bor_device_location" placeholder="Location">
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="bor_device_tone">Device tone </label>
                                <select class="form-control" id="bor_device_tone" style="width: 100%;" name="bor_device_tone">
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="bor_device_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="bor_device_working" id="bor_device_working_y" value="1" checked> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="bor_device_working" id="bor_device_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->
                   

                      </div>

                  
                     
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="device_borerror"></div>
                <button type="submit" class="btn btn-primary" id="bowsaveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>


                <!-- indi p -->


                <!-- borrowed -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal add1-->



<!-- modal view printer -->
<div class="modal fade" id="modal_view_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="viewprinterform" id="viewprinterform" method="POST">
                 



                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecentralPrinterPurchasev" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapsecentralPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_printer_make">Select printer make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="v_printer_make" style="width: 100%;" name="v_printer_make" disabled>
                          <?php foreach ($row_printermake as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= '['.$printermake['device'].'] '.$printermake['dm'] .'/'.$printermake['device_model'] .' - RV No. '.$printermake['rv_no'].' dt. '.date("d/m/Y", strtotime($printermake['rv_dt'])) ;?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                     
                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_printer_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="v_printer_barc_asset_id" style="width: 100%;" name="v_printer_barc_asset_id" placeholder="PC/I...." readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_printer_amc_id" style="width: 100%;" name="v_printer_amc_id" placeholder="LJ/..." readonly>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_printer_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="v_printer_use" style="width: 100%;" name="v_printer_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_printer_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_printer_location" style="width: 100%;" name="v_printer_location" placeholder="Location" readonly>
                              </div>
                            </div>


                    </div>


                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_printer_working" id="v_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_printer_working" id="v_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_printer-->



<!-- modal view indi printer -->
<div class="modal fade" id="modal_view_indi_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD [individual purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="indiviewprinterform" id="indiviewprinterform" method="POST">
                 



                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseindiPrinterPurchasev" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapseindiPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_v">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="indi_device_v" style="width: 100%;" name="indi_device_v" disabled>
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_supplier_v">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="indi_device_supplier_v" name="indi_device_supplier_v" disabled>
                          
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_indent_no_v">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indi_device_indent_no_v" name="indi_device_indent_no_v" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indi_device_indent_dt1v" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_indent_dt_v" name="indi_device_indent_dt_v" id="indi_device_indent_dt_v" placeholder="Indent date" disabled/>
                            <div class="input-group-append" data-target="#indi_device_indent_dt_v" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indi_device_indent_by_v">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indi_device_indent_by_v" name="indi_device_indent_by_v" disabled>
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_po_no_v">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="indi_device_po_no_v" name="indi_device_po_no_v" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="indi_device_po_dt1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_po_dt_v" name="indi_device_po_dt_v" id="indi_device_po_dt_v" placeholder="PO Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_po_dt_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_rv_no_v">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="indi_device_rv_no_v" name="indi_device_rv_no_v" disabled>
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="indi_device_rv_dt1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_rv_dt" name="indi_device_rv_dt_v" id="indi_device_rv_dt_v" placeholder="RV Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_rv_dt_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_cost_v">Cost (Per Device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="indi_device_cost_v" name="indi_device_cost_v" min="0" disabled>
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_v">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="indi_device_warranty_v" name="indi_device_warranty_v" min="0" disabled>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_uptodate">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="indi_device_warranty_uptodate1v" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_warranty_uptodate_v" name="indi_device_warranty_uptodate_v" id="indi_device_warranty_uptodate_v" placeholder="Date" disabled/>
                          <div class="input-group-append" data-target="#indi_device_warranty_uptodate_v" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_v_printer_make">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="indi_v_printer_make" style="width: 100%;" name="indi_v_printer_make" disabled>
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_device_model_v">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="indi_device_model_v" style="width: 100%;" name="indi_device_model_v" placeholder="Eg. Laserjet 403 Dn" disabled>
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_printer_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="v_indi_printer_barc_asset_id" style="width: 100%;" name="v_indi_printer_barc_asset_id" placeholder="PRN/I...." disabled>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_indi_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_indi_printer_amc_id" style="width: 100%;" name="v_indi_printer_amc_id" placeholder="PC/..." disabled>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_printer_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="v_indi_printer_use" style="width: 100%;" name="v_indi_printer_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_printer_location_v">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_indi_printer_location_v" style="width: 100%;" name="v_indi_printer_location_v" placeholder="Location" disabled>
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="indi_device_tone_v">Device tone </label>
                                <select class="form-control" id="indi_device_tone_v" style="width: 100%;" name="indi_device_tone_v" disabled>
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_indi_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_printer_working" id="v_indi_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_printer_working" id="v_indi_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_indi_printer-->



      <!-- modal view borrowed printer -->
<div class="modal fade" id="modal_borrowed_view_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View Printer/Scanner/MFD [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                 
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseborPrinterPurchasev" aria-expanded="false" aria-controls="collapseborPrinterPurchasev">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapseborPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="bor_device_v">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="bor_device_v" style="width: 100%;" name="bor_device_v" disabled>
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                        </div>    
                      </div>
                      </div>

                      



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_make_v">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="bor_device_make_v" style="width: 100%;" name="bor_device_make_v" disabled>
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_model_v">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="bor_device_model_v" style="width: 100%;" name="bor_device_model_v" placeholder="Eg. Laserjet 403 Dn" disabled>
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="bor_device_barc_asset_id_v">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="bor_device_barc_asset_id_v" style="width: 100%;" name="bor_device_barc_asset_id_v" placeholder="Dev/I...." disabled>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="bor_device_amc_id_v">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="bor_device_amc_id_v" style="width: 100%;" name="bor_device_amc_id_v" placeholder="PC/..." disabled>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_use_v">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="bor_device_use_v" style="width: 100%;" name="bor_device_use_v" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_location_v">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="bor_device_location_v" style="width: 100%;" name="bor_device_location_v" placeholder="Location" disabled>
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="bor_device_tone_v">Device tone </label>
                                <select class="form-control" id="bor_device_tone_v" style="width: 100%;" name="bor_device_tone_v" disabled>
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_bor_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_bor_printer_working" id="v_bor_printer_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_bor_printer_working" id="v_bor_printer_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view_borrowed_printer-->


  <!-- modal edit borrowed printer -->
  <div class="modal fade" id="modal_borrowed_edit_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit Printer/Scanner/MFD [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="editbordeviceform" id="editbordeviceform" method="POST">
                <!-- AAAAA -->
                <div id="accordion">
                 
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseborPrinterPurchasev" aria-expanded="false" aria-controls="collapseborPrinterPurchasev">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapseborPrinterPurchasev" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="bor_device_e">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="bor_device_e" style="width: 100%;" name="bor_device_e">
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                          <input type="text" name="e_bor_device_autoID" id="e_bor_device_autoID">
                        </div>    
                      </div>
                      </div>

                      



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_make_e">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control " id="bor_device_make_e" style="width: 100%;" name="bor_device_make_e">
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="bor_device_model_e">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="bor_device_model_e" style="width: 100%;" name="bor_device_model_e" placeholder="Eg. Laserjet 403 Dn">
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="bor_device_barc_asset_id_e">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="bor_device_barc_asset_id_e" style="width: 100%;" name="bor_device_barc_asset_id_e" placeholder="DEV/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="bor_device_amc_id_e">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="bor_device_amc_id_e" style="width: 100%;" name="bor_device_amc_id_e" placeholder="PC/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_use_e">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="bor_device_use_e" style="width: 100%;" name="bor_device_use_e">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="bor_device_location_e">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="bor_device_location_e" style="width: 100%;" name="bor_device_location_e" placeholder="Location">
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="bor_device_tone_e">Device tone </label>
                                <select class="form-control" id="bor_device_tone_e" style="width: 100%;" name="bor_device_tone_e">
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="e_bor_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_bor_printer_working" id="e_bor_printer_working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_bor_printer_working" id="e_bor_printer_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                    <div id="device_borerror_e"></div>
                    <button type="submit" class="btn btn-primary" id="bowUpdateBtn">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  



                  
                  
                </div>
                <!-- AAAAA -->
                </form>
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal edit_borrowed_printer-->









<!-- modal edit indi printer -->
<div class="modal fade" id="modal_edit_indi_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit Printer/Scanner/MFD [individual purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="indieditprinterform" id="indieditprinterform" method="POST">
                    <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseindiPrinterPurchasee" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapseindiPrinterPurchasee" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_e">Device <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Select device"></span></label>
                          <select class="form-control" id="indi_device_e" style="width: 100%;" name="indi_device_e" >
                            <option value="Printer">Printer</option>
                            <option value="Scanner">Scanner</option>
                            <option value="MFD">MFD</option>
                          </select>
                          <input type="hidden" class="form-control" id="indi_device_e_autoID" style="width: 100%;" name="indi_device_e_autoID" >
                        </div>    
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_device_supplier_e">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="indi_device_supplier_e" name="indi_device_supplier_e" >
                          
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_indent_no_e">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indi_device_indent_no_e" name="indi_device_indent_no_e" >
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indi_device_indent_dt1e" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_indent_dt_e" name="indi_device_indent_dt_e" id="indi_device_indent_dt_e" placeholder="Indent date"/>
                            <div class="input-group-append" data-target="#indi_device_indent_dt_e" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indi_device_indent_by_e">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indi_device_indent_by_e" name="indi_device_indent_by_e">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_po_no_e">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="indi_device_po_no_e" name="indi_device_po_no_e">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="indi_device_po_dt1e" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_po_dt_e" name="indi_device_po_dt_e" id="indi_device_po_dt_e" placeholder="PO Date"/>
                          <div class="input-group-append" data-target="#indi_device_po_dt_e" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_device_rv_no_e">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="indi_device_rv_no_e" name="indi_device_rv_no_e" >
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="indi_device_rv_dt1e" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_rv_dt_e" name="indi_device_rv_dt_e" id="indi_device_rv_dt_e" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#indi_device_rv_dt_e" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_cost_e">Cost (Per Device)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="indi_device_cost_e" name="indi_device_cost_e" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_e">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="indi_device_warranty_e" name="indi_device_warranty_e" min="0" />
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_device_warranty_uptodate_e">Device Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="indi_device_warranty_uptodate1e" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_device_warranty_uptodate_e" name="indi_device_warranty_uptodate_e" id="indi_device_warranty_uptodate_e" placeholder="Date" />
                          <div class="input-group-append" data-target="#indi_device_warranty_uptodate_e" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>



                        <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_e_printer_make">Device make
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="indi_e_printer_make" style="width: 100%;" name="indi_e_printer_make" >
                          <?php foreach ($row_pm as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= $printermake['device_make'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-6">
                        <div class="form-group">
                          <label for="indi_device_model_e">Device model
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          <input type="text" class="form-control" id="indi_device_model_e" style="width: 100%;" name="indi_device_model_e" placeholder="Eg. Laserjet 403 Dn" >
                        </div>    
                      </div>


                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_printer_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="e_indi_printer_barc_asset_id" style="width: 100%;" name="e_indi_printer_barc_asset_id" placeholder="PRN/I...." >
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_indi_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="e_indi_printer_amc_id" style="width: 100%;" name="e_indi_printer_amc_id" placeholder="PC/..." >
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_printer_use">Device use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="e_indi_printer_use" style="width: 100%;" name="e_indi_printer_use" >
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_printer_location_e">Device location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of device"></span></label>
                                <input type="text" class="form-control" id="e_indi_printer_location_e" style="width: 100%;" name="e_indi_printer_location_e" placeholder="Location" >
                              </div>
                            </div>


                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                                <div class="form-group">
                                <label for="indi_device_tone_e">Device tone </label>
                                <select class="form-control" id="indi_device_tone_e" style="width: 100%;" name="indi_device_tone_e" >
                                  <option value="Colour">Colour</option>
                                  <option value="Black & White">Black & White</option>
                                </select>
                              </div>
                            </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="indi_device_rv_copy_edit">Upload RV Copy</label>
                      <input type="file" class="form-control" name="indi_device_rv_copy_edit" id="indi_device_rv_copy_edit" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="e_indi_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_indi_printer_working" id="e_indi_printer_working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_indi_printer_working" id="e_indi_printer_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->


                    </div>

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                    <div id="device_indiperror_edit"></div>
                    <button type="submit" class="btn btn-primary" id="indiDeviceUpdateBtn">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal edit_indi_printer-->


<!-- modal edit printer -->
<div class="modal fade" id="modal_edit_printer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit Printer/Scanner/MFD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="editprinterform" id="editprinterform" method="POST">
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecentralPrinterPurchasee" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>Device details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Device Details"></span>
                          </a>
                      </h5>
                    </div>
                    <div id="collapsecentralPrinterPurchasee" class="show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_printer_make">Select printer make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="e_printer_make" style="width: 100%;" name="e_printer_make" >
                          <?php foreach ($row_printermake as $printermake){ ?>
                            <option value="<?=$printermake['autoID'];?>"><?= '['.$printermake['device'].'] '.$printermake['dm'] .'/'.$printermake['device_model'] .' - RV No. '.$printermake['rv_no'].' dt. '.date("d/m/Y", strtotime($printermake['rv_dt'])) ;?></option>
                          <?php } ?>
                          </select>
                          <input type="hidden" class="form-control" id="e_p_autoID" style="width: 100%;" name="e_p_autoID" >
                        </div>    
                      </div>

                     
                    </div>
                       

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_printer_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="e_printer_barc_asset_id" style="width: 100%;" name="e_printer_barc_asset_id" placeholder="PRN/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_printer_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="e_printer_amc_id" style="width: 100%;" name="e_printer_amc_id" placeholder="LJ/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_printer_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="e_printer_use" style="width: 100%;" name="e_printer_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_printer_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of device"></span></label>
                                <input type="text" class="form-control" id="e_printer_location" style="width: 100%;" name="e_printer_location" placeholder="Location">
                              </div>
                            </div>
                    </div>


                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="e_printer_working">Device in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_printer_working" id="e_printer_working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_printer_working" id="e_printer_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->




                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="printer_cenperror_e"></div>
                <button type="submit" class="btn btn-primary" id="pupdateBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  



                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal edit_printer-->






  



      <!-- modal add1 -->
  <div class="modal fade" id="modal_add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Add PC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
                <!-- AAAAA -->
                <div id="accordion">
                  <form name="addpcform" id="addpcform" method="POST">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <label for="pc_purchase">Mode of acquisition <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Mode of acquisition/purchase of desktop PC"></span>
                          </a>
                        
                      </h5>
                      <span class="text-sm text-danger">In case  PC/Device purchase information is not availble, select individual/group purchase by indent and type NA in supplier field and select NA in suggestions, and fill the available information of PC/Device</span><br>
                      <div id="sel_mode" class="text-sm text-secondary text-bold"></div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <div class="row">
                        <div class="col-lg-12 col-12">
                        <div class="form-group">
                    
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="pc_purchase" style="width: 100%;" name="pc_purchase">
                            <!-- <option value="Alloted">Alloted by division</option> -->
                            <option value="Centralize">Alloted by division / Centralize purchase</option>
                            <option value="Individual">Individual/Group purchase by indent</option>
                            <option value="Borrowed">Brought from outside division</option>
                          </select><br>
                          <button type="button" id="btn_sel_mode" class=" btn btn-sm btn-primary">Next</button>
                        </div>    
                      </div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="card cenp">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecentralPurchase" aria-expanded="false" aria-controls="collapsecentralPurchase">
                          <label>PC details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="PC Details"></span>
                          </a>
                      </h5>
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapsecentralPurchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                        <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_make">Select PC make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="pc_make" style="width: 100%;" name="pc_make">
                          <?php foreach ($row_pcmake as $pcmake){ ?>
                            <option value="<?=$pcmake['autoID'];?>"><?=$pcos['pc_make'] .'/'.$pcos['pc_model'];?></option>
                          <?php } ?>
                          </select>
                         
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_os">Operating system</label>
                          <select class="form-control " id="pc_os" style="width: 100%;" name="pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="pc_arch" style="width: 100%;" name="pc_arch">
                                
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
                                <label for="pc_ram">RAM (in GB)</label>
                                <input type="number" class="form-control" id="pc_ram" style="width: 100%;" name="pc_ram" min="0" max="32" placeholder="in GB">
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="pc_hdd">Hard-disk capacity (in GB)</label>
                                <input type="number" class="form-control" placeholder="HDD details" required="required" id="pc_hdd" name="pc_hdd" min="0">
                              </div>    
                            </div>


                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="pc_ssd">SSD capacity (in GB)</label>
                                <input type="number" class="form-control" placeholder="SSD details" id="pc_ssd" name="pc_ssd" min="0">
                              </div>    
                            </div>

                            </div>

                            <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="pc_ip" style="width: 100%;" name="pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="pc_setup">PC setup</label>
                          <select class="form-control" id="pc_setup" style="width: 100%;" name="pc_setup">
                          
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
                          <label for="pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="pc_barc_asset_id" style="width: 100%;" name="pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="pc_amc_id" style="width: 100%;" name="pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="pc_use" style="width: 100%;" name="pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="pc_location" style="width: 100%;" name="pc_location" placeholder="Location">
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" checked name="pc_working" id="working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="pc_working" id="working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="error"></div>
                <!-- <button type="button" class="btn btn-primary" id="checkBtn">Check</button> -->
                <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                  </div>
                
                  </form>
                  

                  <form name="indi_addpcform" id="indi_addpcform" method="POST">
                  <div class="card indip">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseindiPurchase" aria-expanded="false" aria-controls="collapseindiPurchase">
                          <label>PC details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Details like PO No., RV No., Warranty etc."></span>
                          </a>
                      </h5>
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapseindiPurchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">

                     


                        <!-- ROW -->
                        <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span><span><img src="images/loader.gif" width="20px" id="loader"></span></label>
                          <input type="text" autocomplete="off" class="form-control" placeholder="Enter few characters...Suggesstions will pop-up if aavailable" required="required" id="indi_pc_supplier" name="indi_pc_supplier">
                          
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                            <div class="col-lg-12">
                              <ul id="suggesstion-box" style="width: 100%;" name="suggesstion-box" class="list-group"></ul>
                            </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="indi_pc_form">Form factor <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Laptop, Desktop.."></span></label>
                          <select class="form-control" id="indi_pc_form" style="width: 100%;" name="indi_pc_form">
                                
                                <option value="desktop">Desktop</option>
                                <option value="laptop">Laptop</option>
                              </select>
                          
                        </div>    
                      </div>

                     

                    </div>

                    <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="indi_indent_no" name="indi_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="indi_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#indi_indent_dt" name="indi_indent_dt" id="indi_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#indi_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="indi_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="indi_indent_by" name="indi_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="indi_po_no" name="indi_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="indi_po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_po_dt" name="indi_po_dt" id="indi_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#indi_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="indi_rv_no">RV/GEMC No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="indi_rv_no" name="indi_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV/GEMC date</label>
                        <div class="input-group date" id="indi_rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_rv_dt" name="indi_rv_dt" id="indi_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#indi_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="indi_pc_cost" name="indi_pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="indi_pc_warranty" name="indi_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="pc_warrabty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="indi_pc_warrabty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#indi_pc_warrabty_uptodate" name="indi_pc_warrabty_uptodate" id="indi_pc_warrabty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#indi_pc_warrabty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="indi_pc_make" name="indi_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="indi_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="indi_pc_model" name="indi_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="indi_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="indi_pc_arch" style="width: 100%;" name="indi_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="indi_pc_ram" name="indi_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="indi_pc_hdd" name="indi_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="indi_pc_os">Operating system</label>
                          <select class="form-control " id="indi_pc_os" style="width: 100%;" name="indi_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="indi_pc_monitor" name="indi_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="indi_pc_ip" style="width: 100%;" name="indi_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="indi_pc_setup">PC setup</label>
                          <select class="form-control" id="indi_pc_setup" style="width: 100%;" name="indi_pc_setup">
                          
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
                          <label for="indi_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="indi_pc_barc_asset_id" style="width: 100%;" name="indi_pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="indi_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="indi_pc_amc_id" style="width: 100%;" name="indi_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="indi_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="indi_pc_use" style="width: 100%;" name="indi_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="indi_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="indi_pc_location" style="width: 100%;" name="indi_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="indi_pc_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="indi_pc_rv_copy" id="indi_pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="indi_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="indi_pc_working" id="indi_pc_working_y" value="1" checked> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="indi_pc_working" id="indi_pc_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->
                        <!-- ROW -->

                        <div class="modal-footer"><!-- modal footer -->
                <div id="indi_error"></div>
                <button type="submit" class="btn btn-primary" id="indi_saveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                      </div>
                    </div>
                  </div>
                  </form>



                  <!-- //borrowed -->
                  <form name="borrow_addpcform" id="borrow_addpcform" method="POST">
                  <div class="card borrowed">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseBorrowed" aria-expanded="false" aria-controls="collapseBorrowed">
                          <label>PC details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Details like RAM, HDD, IP etc."></span>
                          </a>
                      </h5>
                      <div id="sel_makeos" class="text-sm text-secondary text-bold"></div>
                    </div>
                    <div id="collapseBorrowed" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <!-- ROW -->
                      


                   
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="borrow_pc_make" name="borrow_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="borrow_pc_model" name="borrow_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="borrow_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="borrow_pc_arch" style="width: 100%;" name="borrow_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="borrow_pc_ram" name="borrow_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="borrow_pc_hdd" name="borrow_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="borrow_pc_os">Operating system</label>
                          <select class="form-control " id="borrow_pc_os" style="width: 100%;" name="borrow_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="borrow_pc_monitor" name="borrow_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="borrow_pc_ip" style="width: 100%;" name="borrow_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="borrow_pc_setup">PC setup</label>
                          <select class="form-control" id="borrow_pc_setup" style="width: 100%;" name="borrow_pc_setup">
                          
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
                          <label for="borrow_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="borrow_pc_barc_asset_id" style="width: 100%;" name="borrow_pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="borrow_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="borrow_pc_amc_id" style="width: 100%;" name="borrow_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="borrow_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="borrow_pc_use" style="width: 100%;" name="borrow_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="borrow_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="borrow_pc_location" style="width: 100%;" name="borrow_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="borrow_pc_rv_copy">Upload RV Copy (If available)</label>
                      <input type="file" class="form-control" name="borrow_pc_rv_copy" id="borrow_pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="borrow_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="borrow_pc_working" id="borrow_pc_working_y" value="1" checked> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="borrow_pc_working" id="borrow_pc_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->
                 
                        <!-- ROW -->

                        <div class="modal-footer"><!-- modal footer -->
                <div id="borrow_error"></div>
                <button type="submit" class="btn btn-primary" id="borrow_saveBtn">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                      </div>
                    </div>
                  </div>
                  </form>
                  <!-- borrowed -->
                  
                  
                </div>
                <!-- AAAAA -->
                
               
              </div>  <!-- /.card-body -->
              
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal add1-->

       <!-- modal edit -->
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
                          <label for="ecenp_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="ecenp_pc_barc_asset_id" style="width: 100%;" name="ecenp_pc_barc_asset_id" placeholder="PC/I....">
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



<!-- modal view cenp -->
<div class="modal fade" id="modal_view_cenp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Centralize Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
             
                <!-- AAAAA -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_make">Select PC make/model 
                          <!-- <span class="text-primary font-weight-bold fas fa-info-circle" ></span> -->
                          </label>
                          
                          <select class="form-control" id="vcenp_pc_make" style="width: 100%;" name="vcenp_pc_make" disabled>
                          <?php foreach ($row_pcmake as $pcmake){ ?>
                            <option value="<?=$pcmake['autoID'];?>"><?=$pcmake['pc_make'] .'/'.$pcmake['pc_model'];?></option>
                          <?php } ?>
                          </select>

                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_os">Operating system</label>
                          <select class="form-control " id="vcenp_pc_os" style="width: 100%;" name="vcenp_pc_os" disabled>
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>
                    </div>
                        <!-- ROW -->

                        <div class="row">

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="vcenp_pc_arch" style="width: 100%;" name="vcenp_pc_arch" disabled>
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_ppc_ram">RAM (in GB)</label>
                                <input type="number" class="form-control" id="vcenp_ppc_ram" style="width: 100%;" name="vcenp_ppc_ram" min="1" max="32" placeholder="in GB" readonly> 
                              </div>    
                            </div>

                            <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="vcenp_pc_hdd">Hard-disk(Capacity & Make)</label>
                                <input type="text" class="form-control" placeholder="HDD details" required="required" id="vcenp_pc_hdd" name="vcenp_pc_hdd" readonly>
                              </div>    
                            </div>

                            </div>

                            <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="vcenp_pc_ip" style="width: 100%;" name="vcenp_pc_ip" placeholder="IP address" readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="vcenp_pc_setup">PC setup</label>
                          <select class="form-control" id="vcenp_pc_setup" style="width: 100%;" name="vcenp_pc_setup" disabled>
                          
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
                          <label for="vcenp_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="vcenp_pc_barc_asset_id" style="width: 100%;" name="vcenp_pc_barc_asset_id" placeholder="PC/I...." readonly>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="vcenp_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="vcenp_pc_amc_id" style="width: 100%;" name="vcenp_pc_amc_id" placeholder="PC/..." readonly>
                        </div>   
                      </div>

                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="vcenp_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="vcenp_pc_use" style="width: 100%;" name="vcenp_pc_use" disabled>
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="vcenp_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="vcenp_pc_location" style="width: 100%;" name="vcenp_pc_location" placeholder="Location" readonly>
                              </div>
                            </div>


                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_cenp_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_cenp_pc_working" id="v_cenp_pc_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_cenp_pc_working" id="v_cenp_pc_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>

                    
                    <div class="modal-footer"><!-- modal footer -->
               
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
                <!-- AAAAA -->
              </div>  <!-- /.card-body -->
             
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal  view cenp-->




      <!-- modal edit indip -->
  <div class="modal fade" id="modal_edit_indip">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit PC details [Individual Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="editpcform_indip" id="editpcform_indip" method="POST">
                <!-- AAAAA -->
                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_form">Form factor <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Laptop, Desktop.."></span></label>
                          <select class="form-control" id="e_indi_pc_form" style="width: 100%;" name="e_indi_pc_form">
                                
                                <option value="desktop">Desktop</option>
                                <option value="laptop">Laptop</option>
                              </select>
                          
                        </div>    
                      </div>

                     

                    </div>

                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="e_indi_pc_supplier" name="e_indi_pc_supplier">
                          <input type="hidden" name="eindi_hid_autoID" id="eindi_hid_autoID">
                        </div>    
                      </div>

                     

                    </div>
 <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="e_indi_indent_no" name="e_indi_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="e_indi_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_indent_dt" name="e_indi_indent_dt" id="e_indi_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#e_indi_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="e_indi_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="e_indi_indent_by" name="e_indi_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="e_indi_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="e_indi_po_no" name="e_indi_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="e_indi_po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_po_dt" name="e_indi_po_dt" id="e_indi_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#e_indi_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="e_indi_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="e_indi_rv_no" name="e_indi_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="e_indi_rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_rv_dt" name="e_indi_rv_dt" id="e_indi_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#e_indi_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="e_indi_pc_cost" name="e_indi_pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="e_indi_pc_warranty" name="e_indi_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_warranty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="e_indi_pc_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_pc_warranty_uptodate" name="e_indi_pc_warranty_uptodate" id="e_indi_pc_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#e_indi_pc_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="e_indi_pc_make" name="e_indi_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="e_indi_pc_model" name="e_indi_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="e_indi_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="e_indi_pc_arch" style="width: 100%;" name="e_indi_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="e_indi_pc_ram" name="e_indi_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="e_indi_pc_hdd" name="e_indi_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_indi_pc_os">Operating system</label>
                          <select class="form-control " id="e_indi_pc_os" style="width: 100%;" name="e_indi_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="e_indi_pc_monitor" name="e_indi_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="e_indi_pc_ip" style="width: 100%;" name="e_indi_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_indi_pc_setup">PC setup</label>
                          <select class="form-control" id="e_indi_pc_setup" style="width: 100%;" name="e_indi_pc_setup">
                          
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
                          <label for="e_indi_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="e_indi_pc_barc_asset_id" style="width: 100%;" name="e_indi_pc_barc_asset_id" placeholder="Asset ID provided by HR/precurement">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_indi_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="e_indi_pc_amc_id" style="width: 100%;" name="e_indi_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="e_indi_pc_use" style="width: 100%;" name="e_indi_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_indi_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="e_indi_pc_location" style="width: 100%;" name="e_indi_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   

                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="e_indi_pc_rv_copy">Upload RV Copy</label>
                      <input type="file" class="form-control" name="e_indi_pc_rv_copy" id="e_indi_pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>
                        <!-- ROW -->


                        <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="e_indi_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_indi_pc_working" id="e_indi_pc_working_y" value="1" > Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_indi_pc_working" id="e_indi_pc_working_n" value="0" > No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="eindip_error"></div>
                <button type="submit" class="btn btn-primary" id="e_indip_updateBtn">Update</button>
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
      <!-- /.modal edit indip-->



       <!-- modal view indip -->
  <div class="modal fade" id="modal_view_indip">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Individual Purchase]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <form name="viewpcform_indip" id="viewpcform_indip" method="POST">
                <!-- AAAAA -->
                <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_supplier">Supplier details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Name, address of supplier (As given in RV)"></span></label>
                          <input type="text" class="form-control" placeholder="Supplier details" required="required" id="v_indi_pc_supplier" name="v_indi_pc_supplier">
                          
                        </div>    
                      </div>

                     

                    </div>
 <div class="row">

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_indent_no">Indent no. </label>
                          <input type="text" class="form-control" placeholder="Indent no. " id="v_indi_indent_no" name="v_indi_indent_no">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label>Indent date</label>
                          <div class="input-group date" id="v_indi_indent_dt1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#v_indi_indent_dt" name="v_indi_indent_dt" id="v_indi_indent_dt" placeholder="Indent date" />
                            <div class="input-group-append" data-target="#v_indi_indent_dt" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>

                    <div class="col-lg-4 col-12">
                          <div class="form-group">
                            <label for="v_indi_indent_by">Name of Indenting officer</label>
                            <input type="text" class="form-control" placeholder="Indenting officer" id="v_indi_indent_by" name="v_indi_indent_by">
                            <!-- <datalist id="all_emp"></datalist> -->
                          </div>   
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="v_indi_po_no">PO No. </label>
                        <input type="text" class="form-control" placeholder="PO No." id="v_indi_po_no" name="v_indi_po_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>PO date</label>
                        <div class="input-group date" id="v_indi_po_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_po_dt" name="v_indi_po_dt" id="v_indi_po_dt" placeholder="PO Date" />
                          <div class="input-group-append" data-target="#v_indi_po_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="v_indi_rv_no">RV No. </label>
                        <input type="text" class="form-control" placeholder="RV No." id="v_indi_rv_no" name="v_indi_rv_no">
                      </div>    
                    </div>

                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label>RV date</label>
                        <div class="input-group date" id="v_indi_rv_dt1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#e_indi_rv_dt" name="v_indi_rv_dt" id="v_indi_rv_dt" placeholder="RV Date" />
                          <div class="input-group-append" data-target="#v_indi_rv_dt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>    
                    </div>

                    

                    </div>


                    <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_cost">Cost (Per PC)</label>
                          <input type="number" class="form-control" placeholder="Cost"  id="v_indi_pc_cost" name="v_indi_pc_cost" min="0">
                        </div>    
                      </div>
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_warranty">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="In years"></span></label>
                          <input type="number" class="form-control" placeholder="in"  id="v_indi_pc_warranty" name="v_indi_pc_warranty" min="0">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_warranty_uptodate">PC Warranty <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Warranty upto (Date)"></span></label>
                          <div class="input-group date" id="v_indi_pc_warranty_uptodate1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#v_indi_pc_warranty_uptodate" name="v_indi_pc_warranty_uptodate" id="v_indi_pc_warranty_uptodate" placeholder="Date" />
                          <div class="input-group-append" data-target="#e_indi_pc_warranty_uptodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        </div>    
                      </div>

                    </div>
                    
                    <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_make">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="v_indi_pc_make" name="v_indi_pc_make">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="v_indi_pc_model" name="v_indi_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="v_indi_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="v_indi_pc_arch" style="width: 100%;" name="v_indi_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="v_indi_pc_ram" name="v_indi_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="v_indi_pc_hdd" name="v_indi_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_indi_pc_os">Operating system</label>
                          <select class="form-control " id="v_indi_pc_os" style="width: 100%;" name="v_indi_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="v_indi_pc_monitor" name="v_indi_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="v_indi_pc_ip" style="width: 100%;" name="v_indi_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_indi_pc_setup">PC setup</label>
                          <select class="form-control" id="v_indi_pc_setup" style="width: 100%;" name="v_indi_pc_setup">
                          
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
                          <label for="v_indi_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="v_indi_pc_barc_asset_id" style="width: 100%;" name="v_indi_pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_indi_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_indi_pc_amc_id" style="width: 100%;" name="v_indi_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="v_indi_pc_use" style="width: 100%;" name="v_indi_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_indi_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_indi_pc_location" style="width: 100%;" name="v_indi_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_indi_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_pc_working" id="v_indi_pc_working_y" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_indi_pc_working" id="v_indi_pc_working_n" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->
                   

                  

                      </div>
                    </div>
                    <div class="modal-footer"><!-- modal footer -->
                <div id="vindip_error"></div>
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
      <!-- /.modal view indip-->




      <!-- /.modal edit borrowed-->

      
      <div class="modal fade" id="modal_edit_borrowedp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Edit PC details [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="editpcform_borrowp" id="editpcform_borrowp" method="POST">
              <div class="card-body">
              <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_make ">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="e_borrow_pc_make" name="e_borrow_pc_make">
                          <input type="hidden" name="eborro_hid_autoID" id="eborro_hid_autoID">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="e_borrow_pc_model" name="e_borrow_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="e_borrow_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="e_borrow_pc_arch" style="width: 100%;" name="e_borrow_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="e_borrow_pc_ram" name="e_borrow_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="e_borrow_pc_hdd" name="e_borrow_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_borrow_pc_os">Operating system</label>
                          <select class="form-control " id="e_borrow_pc_os" style="width: 100%;" name="e_borrow_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="e_borrow_pc_monitor" name="e_borrow_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="e_borrow_pc_ip" style="width: 100%;" name="e_borrow_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="e_borrow_pc_setup">PC setup</label>
                          <select class="form-control" id="e_borrow_pc_setup" style="width: 100%;" name="e_borrow_pc_setup">
                          
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
                          <label for="e_borrow_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="e_borrow_pc_barc_asset_id" style="width: 100%;" name="e_borrow_pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="e_borrow_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="e_borrow_pc_amc_id" style="width: 100%;" name="e_borrow_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_borrow_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="e_borrow_pc_use" style="width: 100%;" name="e_borrow_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="e_borrow_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="e_borrow_pc_location" style="width: 100%;" name="e_borrow_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                      <label for="e_borrow_pc_rv_copy">Upload RV Copy (If available)</label>
                      <input type="file" class="form-control" name="e_borrow_pc_rv_copy" id="e_borrow_pc_rv_copy" accept="image/*,pdf" />
                      </div>
                    </div>
                    </div>

                     <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="e_borrow_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_borrow_pc_working" id="e_borrow_pc_working_y" value="1"> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="e_borrow_pc_working" id="e_borrow_pc_working_n" value="0"> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->  

              </div>  <!-- /.card-body -->
              <div class="modal-footer"><!-- modal footer -->
                <div id="eborrowp_error"></div>
                <button type="submit" class="btn btn-primary" id="e_borrowp_updateBtn">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
            </form>
              
            </div>
           
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal edit borrowedp-->

      <!-- /.modal edit borrowed-->

      
      <div class="modal fade" id="modal_view_borrowedp">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View PC details [Borrowed]</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <div class="card-body">
              <div class="row">
                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_make ">PC Make <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Datamini, KBS, Zenith"></span></label>
                          <input type="text" class="form-control" placeholder="Make" required="required" id="v_borrow_pc_make" name="v_borrow_pc_make">
                          <input type="hidden" name="eborro_hid_autoID" id="eborro_hid_autoID">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_model">Processor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Right Click on My Computer ->Properties"></span></label>
                          <input type="text" class="form-control" placeholder="Processor details" required="required" id="v_borrow_pc_model" name="v_borrow_pc_model">
                        </div>    
                      </div>

                      <div class="col-lg-4 col-12">
                              <div class="form-group">
                                <label for="v_borrow_pc_arch">Architecture <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="x86 (32 bit) OR x86-64 (64 bit) Right Click on My Computer ->Properties"></span></label>
                                <select class="form-control" id="v_borrow_pc_arch" style="width: 100%;" name="v_borrow_pc_arch">
                                
                                  <option value="32bit">x86 (32bit)</option>
                                  <option value="64bit">x86-64 (64bit)</option>
                                </select>
                              </div>    
                            </div>


                    </div>

                    <div class="row">


                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_ram">RAM (Memory in GB) <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Configuration DDR-2, DDR-3"></span></label>
                          <input type="number" class="form-control" placeholder="RAM in GB" required="required" id="v_borrow_pc_ram" name="v_borrow_pc_ram">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_hdd">Hard-disk(Capacity & Make)</label>
                          <input type="text" class="form-control" placeholder="HDD details" required="required" id="v_borrow_pc_hdd" name="v_borrow_pc_hdd">
                        </div>    
                      </div>


                    </div>

                    <div class="row">
                      

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_borrow_pc_os">Operating system</label>
                          <select class="form-control " id="v_borrow_pc_os" style="width: 100%;" name="v_borrow_pc_os">
                          <?php foreach ($row_os as $pcos){ ?>
                            <option value="<?=$pcos['autoID'];?>"><?=$pcos['os_name'];?></option>
                          <?php } ?>
                          </select>
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_monitor">Display monitor details <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Make, Model, Size in inches"></span></label>
                          <input type="text" class="form-control" placeholder="Display monitor details" required="required" id="v_borrow_pc_monitor" name="v_borrow_pc_monitor">
                        </div>    
                      </div>


                    </div>


                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_ip">IP Address (10 network-INTRA-NET IP)</label>
                          <input type="text" class="form-control" id="v_borrow_pc_ip" style="width: 100%;" name="v_borrow_pc_ip" placeholder="IP address">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="v_borrow_pc_setup">PC setup</label>
                          <select class="form-control" id="v_borrow_pc_setup" style="width: 100%;" name="v_borrow_pc_setup">
                          
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
                          <label for="v_borrow_pc_barc_asset_id">Capital Asset ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by HR/precurement"></span></label>
                          <input type="text" class="form-control" id="v_borrow_pc_barc_asset_id" style="width: 100%;" name="v_borrow_pc_barc_asset_id" placeholder="PC/I....">
                        </div>    
                      </div>

                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                        <label for="v_borrow_pc_amc_id">AMC ID <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Asset ID provided by AMC company"></span></label>
                          <input type="text" class="form-control" id="v_borrow_pc_amc_id" style="width: 100%;" name="v_borrow_pc_amc_id" placeholder="PC/...">
                        </div>   
                      </div>


                    </div>

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_borrow_pc_use">PC use <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="For official work OR for giving service like OPAC etc."></span></label>
                                <select class="form-control" id="v_borrow_pc_use" style="width: 100%;" name="v_borrow_pc_use">
                                  <option value="official use">Official use</option>
                                  <option value="service use">Service use</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="v_borrow_pc_location">PC location <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Location of PC"></span></label>
                                <input type="text" class="form-control" id="v_borrow_pc_location" style="width: 100%;" name="v_borrow_pc_location" placeholder="Location">
                              </div>
                            </div>
                    </div>

                    <div class="row"><!-- row 2 -->
                            <div class="col lg-12">
                            <div class="form-group"> <!--form group -->
                                <label for="v_borrow_pc_working">PC in Working condition? <span class="text-primary font-weight-bold fas fa-info-circle" data-toggle="tooltip" title="Is it in working condition"></span></label>
                                <div class="row"><!-- row 1 -->
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_borrow_pc_working" id="v_borrow_pc_working_v" value="1" disabled> Yes 
                                  </div>
                                  <div class="col-lg-2">
                                    <input type="radio" name="v_borrow_pc_working" id="v_borrow_pc_working_v" value="0" disabled> No
                                  </div>
                                </div>
                                <!-- end of row 1 -->
                              </div><!--form group -->
                            </div>
                    </div><!-- end of row 2 -->

                   
                    

              </div>  <!-- /.card-body -->
              <div class="modal-footer"><!-- modal footer -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> <!-- modal footer -->
              
            </div>
           
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view borrowedp-->


      

<!-- modal delete -->
<div class="modal fade" id="modal_delete">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">Delete PC</h4>
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
      <!-- /.modal delete->


  <!-.content-wrapper -->
 <?php include ('footer.php');?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(function () {
    $("#loader").hide();

   
    $("#indi_pc_supplier").keyup(function() {
     get_supplier_suggesstion($(this).val());
	});

function get_supplier_suggesstion(kw){
  
  var s = '';
      if(kw!=''){
        $.ajax({
      type : 'post',
        url : 'get_pcs.php',
        data : {operation:'search_supplier',kw:kw},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(response) {
				$("#suggesstion-box").show();
				//$("#suggesstion-box").html(data);
				$("#loader").hide();
        data = JSON.parse(response);
        $("#suggesstion-box").html("");
        var list = [];
        for (var i = 0; i < data.length; i++) {
          if ($.inArray(data[i].pc_rv_no+data[i].pc_indent_by, list) >= 0) {
          
        } else{
          list.push(data[i].pc_rv_no+data[i].pc_indent_by);
          s= '<li class="list-group-item list-group-item-action list-group-item-success sel_item" data-id="'+data[i].autoID+'" value="'+data[i].autoID+'">' + data[i].pc_supplier_name + ' [' + data[i].pc_make + ' / '+ data[i].pc_processor_details + '/ Indenting officer : ' +data[i].pc_indent_by + ' / RV No : ' +data[i].pc_rv_no + ' dt. ' + data[i].pc_rv_dt + ' ]' +'</li>';  
            $('#suggesstion-box').append(s);
        }

        }
        $('#suggesstion-box').append('<li class="list-group-item list-group-item-action list-group-item-success sel_item" data-id="0" value="NA">NA[Purchase Details not available]</li>');
			}
		  });
      }else{
        $("#suggesstion-box").html("");
      }
		  
}



function get_sel_data_autofill(id){
 
    $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'get_autofilldata',id:id},
        beforeSend: function(){},
        success : function(response){
          data = JSON.parse(response);
          showtoastwarning("Kindly check pre-filled data");
          $("#indi_pc_supplier").val(data.pc_supplier_name);
          $("#indi_pc_form").val(data.pc_form);
          $("#indi_indent_no").val(data.pc_indent_no);
          $("#indi_indent_dt").val(data.pc_indent_dt);
          $("#indi_indent_by").val(data.pc_indent_by);
          $("#indi_po_no").val(data.pc_po_no);
          $("#indi_po_dt").val(data.pc_po_dt);
          $("#indi_rv_no").val(data.pc_rv_no);
          $("#indi_rv_dt").val(data.pc_rv_dt);
          $("#indi_pc_cost").val(data.pc_cost);
          $("#indi_pc_warranty").val(data.warranty_in_years);
          $("#indi_pc_warrabty_uptodate").val(data.warranty_till);
          $("#indi_pc_make").val(data.pc_make);
          $("#indi_pc_model").val(data.pc_processor_details);
          $("#indi_pc_arch").val(data.pc_bit_type);
          $("#indi_pc_ram").val(data.pc_ram_value);
          $("#indi_pc_hdd").val(data.pc_hdd);
          $("#indi_pc_os").val(data.pc_os);
          $("#indi_pc_monitor").val(data.pc_monitor_details);
         
         
          }
});
  
 
}
    
     // check ip

     $('#pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#pc_ip").removeClass("is-valid");
            $("#pc_ip").addClass("is-invalid");
            $("#saveBtn").hide();
            $("#saveBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#pc_ip").removeClass("is-invalid");
            $("#pc_ip").addClass("is-valid"); 
            $("#saveBtn").show(); 
            $("#saveBtn").html('Save');

            }
          }
});
    });
     // check ip

    $("#viewpcform_indip :input").attr('disabled',true);
    $('[data-toggle="tooltip"]').tooltip();

   
    $('#indi_indent_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });
    $('#indi_device_indent_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#e_indi_indent_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#indi_po_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#indi_device_po_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#e_indi_po_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#indi_rv_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });

    $('#indi_device_rv_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });
    $('#e_indi_rv_dt').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()

    });
    $('#indi_pc_warrabty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()

    });

    $('#indi_device_warranty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()

    });

    $('#e_indi_pc_warranty_uptodate').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()

    });

    $('#indi_device_indent_dt_e').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()

    });

    $('#indi_device_po_dt_e').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()
    });

    $('#indi_device_rv_dt_e').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()
    });
    $('#indi_device_warranty_uptodate_e').datetimepicker({
        format: 'YYYY-MM-DD',
        //maxDate: new Date()
    });

    
  
  

    
  
    
   

   


    function getmakemodel(){
      var s = '';
      //alert(rec_value);
      $('#pc_make').html("");
      $.ajax({  
       url: "get_pcs.php",
       type: "POST",
       data: {operation:'get_pcmakemodel'},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        //alert(data);
        
                for (var i = 0; i < data.length; i++) {
                   s += '<option value="' + data[i].autoID + '" data-toggle="tooltip" title="Title">' + data[i].pc_make + ' / ' + data[i].pc_model +'</option>';  
               } 
                    
                    
     //alert(s);
     
                    $('#pc_make').append(s);
                   
                           
       }

     });
     //alert(s);
    }
    // get make model



    getallpcofusers();
    getallprinterofusers();
    
    function getallpcofusers(){
      
      $.ajax({  
      url: "get_pcs.php",
      type: "POST",
      data: {operation:"alllist"},
      async:false,
      success: function(response){
        //console.log(response);
        //alert(response);
       
          $("#showtable").html(response);
       
      }
    });
    

    }

    function getallprinterofusers(){
      
     
      $.ajax({  
      url: "get_pcs.php",
      type: "POST",
      data: {operation:"alllist_printer"},
     
      success: function(response){
        //console.log(response);
        //alert(response);
       
          $("#showtable_printer").html(response);
       
      }
    });
    
    

    }

  // add pc
    $("#addpcform").validate({
         
            rules: {
              pc_ram:{
                required: true,
                number: true
              },
              pc_ip: "required",
              pc_location : "required"
              
            },
            messages: {
              pc_ram: "Specify RAM (in GB)",
              pc_ip : "Enter IP address"
            },
            submitHandler: function(form) {
              $.ajax({
              type : 'post',
              url : 'get_pcs.php',
              data : $("#addpcform").serialize()+"&operation=add_pc",
                    beforeSend: function(){
                    $("#error").fadeOut();
                    $("#saveBtn").html('Saving data ...');
            },
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error").fadeIn(1000, function(){
            $("#error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#saveBtn").html('Save');
            });
            }
            else {
            
            $("#error").fadeIn(1000, function(){
            $("#modal_add").modal('hide');
            $("#addpcform").trigger("reset");
            $("#error").fadeOut();
            $("#saveBtn").html('Save');
            showtoast("PC added successfully!");
            getallpcofusers();
            

            });

            }

}
});
            }
       
    });
    // add pc


     // add printer cenp
     $("#addprinterform").validate({
         
         rules: {
           printer_barc_asset_id:"required",
          printer_amc_id:"required",
          printer_use:"required",
          printer_location:"required"
           
         },
         messages: {
          printer_barc_asset_id:"Enter BARC Capital Asset ID",
          printer_amc_id:"Enter AMC Asset ID",
          printer_use:"Select use",
          printer_location:"Enter printer location"
         },
         submitHandler: function(form) {
           $.ajax({
     type : 'post',
     url : 'get_pcs.php',
     data : $("#addprinterform").serialize()+"&operation=add_printer",
     beforeSend: function(){
     $("#printer_cenperror").fadeOut();
     $("#psaveBtn").html('Saving data ...');
},
     success : function(response){
       //alert(response);
         if(response != 1){
         $("#printer_cenperror").fadeIn(1000, function(){
         $("#printer_cenperror").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#psaveBtn").html('Save');
         });
         }
         else {
         
         $("#printer_cenperror").fadeIn(1000, function(){
         $("#modal_add_printer").modal('hide');
         $("#addprinterform").trigger("reset");
         $("#printer_cenperror").fadeOut();
         $("#psaveBtn").html('Save');
         showtoast("Printer added successfully!");
         getallprinterofusers();
         

         });

         }

}
});
         }
    
 });
 // add printer cenp



 /* add printer indi p */

 $("#addindideviceform").validate({
         
         rules: {
          indi_device : "required",
          //indi_device_supplier: "required",
          //indi_device_indent_no: "required",
          //indi_device_indent_dt: "required",
          //indi_device_indent_by: "required",
          //indi_device_po_no: "required",
          //indi_device_po_dt: "required",
          //indi_device_rv_no: "required",
          //indi_device_rv_dt: "required",
          //indi_device_cost: "required",
          //indi_device_warranty: "required",
          //indi_device_warranty_uptodate: "required",
          indi_device_make: "required",
          indi_device_model: "required",
          indi_device_barc_asset_id: "required",
          indi_device_amc_id: "required",
          indi_device_use: "required",
          indi_device_location: "required",
           
         },
         messages: {
          indi_device : "Select device",
          //indi_device_supplier: "Enter supplier details",
          //indi_device_indent_no: "Enter Indent No.",
          //indi_device_indent_dt: "Select indent date",
          //indi_device_indent_by: "Enter name of indentor",
          //indi_device_po_no: "Enter PO no.",
          //indi_device_po_dt: "Select PO date",
          //indi_device_rv_no: "Enter RV No.",
          //indi_device_rv_dt: "Select RV Date",
          //indi_device_cost: "Enter Device cost",
          //indi_device_warranty:"Specify warranty in years (Number)",
          //indi_device_warranty_uptodate: "Select warranty upto date",
          indi_device_make: "Enter device make",
          indi_device_model: "Enter device model",
          indi_device_barc_asset_id: "Enter BARC Capital Asset ID",
          indi_device_amc_id: "Enter AMC ID",
          indi_device_use: "Select Usage",
          indi_device_location: "Enter location of device"
         },
         submitHandler: function(form) {
              var file_data = $('#indi_device_rv_copy').prop('files')[0];   
              var op = 'indi_add_device';
              var pp = 'Individual';
              var formData = new FormData($('#addindideviceform')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              formData.append('indi_device_purchase',pp);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#device_indiperror").fadeOut();
        $("#dindisaveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#device_indiperror").fadeIn(1000, function(){
            $("#device_indiperror").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#dindisaveBtn").html('Save');
            });
            }
            else {
            
            $("#device_indiperror").fadeIn(1000, function(){
            $("#modal_add_printer").modal('hide');
            $("#indi_addpcform").trigger("reset");
            $("#device_indiperror").fadeOut();
            $("#dindisaveBtn").html('Save');
            showtoast("Device added successfully!")
            getallprinterofusers();
            

            });

            }

}
});
            }
       
    });
 /* add printer indi p */


 /* add printer borrow p */

 $("#addbordeviceform").validate({
         
         rules: {
          bor_device: "required",
          bor_device_make: "required",
          bor_device_model: "required",
          bor_device_barc_asset_id: "required",
          bor_device_amc_id: "required",
          bor_device_use: "required",
          bor_device_location: "required",
          bor_device_tone: "required"
           
         },
         messages: {
          bor_device: "Select device",
          bor_device_make: "Enter Device Make",
          bor_device_model: "Enter Device Model",
          bor_device_barc_asset_id: "Enter BARC Capital Asset ID",
          bor_device_amc_id: "AMC ID",
          bor_device_use: "Select Use",
          bor_device_location: "Enter location",
          bor_device_tone: "Select tone"
         },
         submitHandler: function(form) {
           $.ajax({
     type : 'post',
     url : 'get_pcs.php',
     data : $("#addbordeviceform").serialize()+"&operation=add_bor_printer",
     beforeSend: function(){
     $("#device_borerror").fadeOut();
     $("#bowsaveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#device_borerror").fadeIn(1000, function(){
            $("#device_borerror").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#bowsaveBtn").html('Save');
            });
            }
            else {
            
            $("#device_borerror").fadeIn(1000, function(){
            $("#modal_add_printer").modal('hide');
            $("#addbordeviceform").trigger("reset");
            $("#device_borerror").fadeOut();
            $("#bowsaveBtn").html('Save');
            showtoast("Device added successfully!")
            getallprinterofusers();
            

            });

            }

}
});
            }
       
    });
 /* add printer borr p */


 /* update printer indi p */

 $("#indieditprinterform").validate({
         
         rules: {
          indi_device_e_autoID : "required",
          indi_device_e: "required",
          //indi_device_supplier_e: "required",
          //indi_device_indent_no_e: "required",
          //indi_device_indent_dt_e: "required",
          //indi_device_indent_by_e: "required",
          //indi_device_po_no_e: "required",
          //indi_device_po_dt_e: "required",
          //indi_device_rv_no_e: "required",
          //indi_device_rv_dt_e: "required",
          //indi_device_cost_e: "required",
          //indi_device_warranty_e: "required",
          //indi_device_warranty_uptodate_e: "required",
          indi_e_printer_make: "required",
          indi_device_model_e: "required",
          e_indi_printer_barc_asset_id: "required",
          e_indi_printer_amc_id: "required",
          e_indi_printer_use: "required",
          e_indi_printer_location_e: "required",
          indi_device_tone_e: "required"
         },
         messages: {
          indi_device_e_autoID : "Select valid record",
          indi_device_e: "Select device",
          //indi_device_supplier_e: "Enter supplier details",
          //indi_device_indent_no_e: "Enter indent no.",
          //indi_device_indent_dt_e: "Indent date",
          //indi_device_indent_by_e: "Indent raised by",
          //indi_device_po_no_e: "Enter PO no.",
          //indi_device_po_dt_e: "Enter PO date",
          //indi_device_rv_no_e: "Enter RV No.",
          //indi_device_rv_dt_e: "RV date",
          //indi_device_cost_e: "Enter device cost",
          //indi_device_warranty_e: "Enter warranty",
          //indi_device_warranty_uptodate_e: "Enter warranty date",
          indi_e_printer_make: "Enter device make",
          indi_device_model_e: "Enter model",
          e_indi_printer_barc_asset_id: "BARC Capital Asset ID",
          e_indi_printer_amc_id: "AMC ID",
          e_indi_printer_use: "Select use",
          e_indi_printer_location_e: "Enter location",
          indi_device_tone_e: "Select tone"
         },
         submitHandler: function(form) {
              var file_data = $('#indi_device_rv_copy_edit').prop('files')[0];   
              var op = 'indi_update_device';
              
              var formData = new FormData($('#indieditprinterform')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#device_indiperror_edit").fadeOut();
        $("#indiDeviceUpdateBtn").html('Updating data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#device_indiperror_edit").fadeIn(1000, function(){
            $("#device_indiperror_edit").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#indiDeviceUpdateBtn").html('Update');
            });
            }
            else {
            
            $("#device_indiperror_edit").fadeIn(1000, function(){
            $("#modal_edit_indi_printer").modal('hide');
            $("#indieditprinterform").trigger("reset");
            $("#device_indiperror_edit").fadeOut();
            $("#indiDeviceUpdateBtn").html('Update');
            showtoast("Device details updated successfully!")
            getallprinterofusers();
            

            });

            }

}
});
            }
       
    });
 /* update printer indi p */


 // edit printer cenp
 $("#editprinterform").validate({
         
         rules: {
          e_p_autoID : "required",
          e_printer_barc_asset_id:"required",
          e_printer_amc_id:"required",
          e_printer_use:"required",
          e_printer_location:"required"
           
         },
         messages: {
          e_p_autoID : "Select valid printer record",
          e_printer_barc_asset_id:"Enter BARC Capital Asset ID",
          e_printer_amc_id:"Enter AMC Asset ID",
          e_printer_use:"Select use",
          e_printer_location:"Enter printer location"
         },
         submitHandler: function(form) {
           $.ajax({
     type : 'post',
     url : 'get_pcs.php',
     data : $("#editprinterform").serialize()+"&operation=edit_printer",
     beforeSend: function(){
     $("#printer_cenperror_e").fadeOut();
     $("#pupdateBtn").html('Saving data ...');
},
     success : function(response){
       //alert(response);
         if(response != 1){
         $("#printer_cenperror_e").fadeIn(1000, function(){
         $("#printer_cenperror_e").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#pupdateBtn").html('Save');
         });
         }
         else {
         
         $("#printer_cenperror_e").fadeIn(1000, function(){
         $("#modal_edit_printer").modal('hide');
         $("#editprinterform").trigger("reset");
         $("#printer_cenperror_e").fadeOut();
         $("#pupdateBtn").html('Save');
         showtoast("Printer details updated successfully!");
         getallprinterofusers();
         

         });

         }

}
});
         }
    
 });
 // edit printer cenp

    // check ip

    $('#ecenp_pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#ecenp_pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#ecenp_pc_ip").removeClass("is-valid");
            $("#ecenp_pc_ip").addClass("is-invalid");
            $("#updateBtn").hide();
            $("#updateBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#ecenp_pc_ip").removeClass("is-invalid");
            $("#ecenp_pc_ip").addClass("is-valid"); 
            $("#updateBtn").show(); 
            $("#updateBtn").html('Save');

            }
          }
});
    });
     // check ip

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
         showtoast("PC Data Updated successfully!")
         getallpcofusers();
         

         });

         }

}
});
         }
    
 });
 // edit cenp pc

 
    // check ip

    $('#e_indi_pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#e_indi_pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#e_indi_pc_ip").removeClass("is-valid");
            $("#e_indi_pc_ip").addClass("is-invalid");
            $("#e_indip_updateBtn").hide();
            $("#e_indip_updateBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#e_indi_pc_ip").removeClass("is-invalid");
            $("#e_indi_pc_ip").addClass("is-valid"); 
            $("#e_indip_updateBtn").show(); 
            $("#e_indip_updateBtn").html('Save');

            }
          }
});
    });
     // check ip



/* edit printer borrow p */

$("#editbordeviceform").validate({
         
         rules: {
          bor_device_e: "required",
          bor_device_make_e: "required",
          bor_device_model_e: "required",
          bor_device_barc_asset_id_e: "required",
          bor_device_amc_id_e: "required",
          bor_device_use_e: "required",
          bor_device_location_e: "required",
          bor_device_tone_e: "required"
           
         },
         messages: {
          bor_device_e: "Select device",
          bor_device_make_e: "Enter Device Make",
          bor_device_model_e: "Enter Device Model",
          bor_device_barc_asset_id_e: "Enter BARC Capital Asset ID",
          bor_device_amc_id_e: "AMC ID",
          bor_device_use_e: "Select Use",
          bor_device_location_e: "Enter location",
          bor_device_tone_e: "Select tone"
         },
         submitHandler: function(form) {
           $.ajax({
     type : 'post',
     url : 'get_pcs.php',
     data : $("#editbordeviceform").serialize()+"&operation=update_bor_printer",
     beforeSend: function(){
     $("#device_borerror_e").fadeOut();
     $("#bowUpdateBtn").html('Updating data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#device_borerror_e").fadeIn(1000, function(){
            $("#device_borerror_e").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#bowUpdateBtn").html('Save');
            });
            }
            else {
            
            $("#device_borerror_e").fadeIn(1000, function(){
            $("#modal_borrowed_edit_printer").modal('hide');
            $("#editbordeviceform").trigger("reset");
            $("#device_borerror_e").fadeOut();
            $("#bowUpdateBtn").html('Save');
            showtoast("Device updated successfully!")
            getallprinterofusers();
            

            });

            }

}
});
            }
       
    });
 /* edit printer borr p */


  // edit indip pc
  $("#editpcform_indip").validate({
         
         rules: {
          eindi_hid_autoID : "required",
          e_indi_pc_supplier : "required",
          e_indi_indent_no : "required",
          e_indi_indent_dt : "required",
          e_indi_indent_by : "required",
          e_indi_po_no : "required",
          e_indi_po_dt : "required",
          e_indi_rv_no : "required",
          e_indi_rv_dt : "required",
          e_indi_pc_cost : "required",
          e_indi_pc_warranty : "required",
          e_indi_pc_warranty_uptodate : "required",
          e_indi_pc_make : "required",
          e_indi_pc_model : "required",
          e_indi_pc_arch : "required",
          e_indi_pc_ram : "required",
          e_indi_pc_hdd : "required",
          e_indi_pc_os : "required",
          e_indi_pc_monitor : "required",
          e_indi_pc_ip : "required",
          e_indi_pc_setup : "required",
          e_indi_pc_amc_id : "required",
          e_indi_pc_use : "required",
          e_indi_pc_location : "required"

         },
         messages: {
          eindi_hid_autoID : "Invalid selection",
          e_indi_pc_supplier : "Enter supplier details",
          e_indi_indent_no : "Enter Indent No.",
          e_indi_indent_dt : "Enter date",
          e_indi_indent_by : "Indent By (Emp. Name)",
          e_indi_po_no : "PO No.",
          e_indi_po_dt : "PO Date",
          e_indi_rv_no : "RV No.",
          e_indi_rv_dt : "RV Date",
          e_indi_pc_cost : "PC Cost",
          e_indi_pc_warranty : "Warranty in years",
          e_indi_pc_warranty_uptodate : "Warranty upto (Date)",
          e_indi_pc_make : "Make of PC",
          e_indi_pc_model : "Processor details",
          e_indi_pc_arch : "PC Architecture (32/64 bit)",
          e_indi_pc_ram : "RAM in GB",
          e_indi_pc_hdd : "Hard-disk info",
          e_indi_pc_os : "PC OS",
          e_indi_pc_monitor : "Monitor details",
          e_indi_pc_ip : "PC IP",
          e_indi_pc_setup : "Select Setup",
          e_indi_pc_amc_id : "AMC ID given by AMC Company",
          e_indi_pc_use : "Select use",
          e_indi_pc_location : "Enter PC Location",
         },
         
//dattaram
            submitHandler: function(form) {
              var file_data = $('#e_indi_pc_rv_copy').prop('files')[0];   
              var op = 'edit_indip_pc';
              var formData = new FormData($('#editpcform_indip')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#eindip_error").fadeOut();
        $("#e_indip_updateBtn").html('Saving data ...');
},

     success : function(response){
        // alert(response);
         if(response != 1){
         $("#eindip_error").fadeIn(1000, function(){
         $("#eindip_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#e_indip_updateBtn").html('Update');
         });
         }
         else {
         
         $("#eindip_error").fadeIn(1000, function(){
         $("#modal_edit_indip").modal('hide');
         $("#editpcform_cenp").trigger("reset");
         $("#eindip_error").fadeOut();
         $("#e_indip_updateBtn").html('Update');
         showtoast("PC Data Updated successfully!")
         getallpcofusers();
         

         });

         }

}
});
         }
    
 });
 // edit cenp pc

 // check ip

$('#borrow_pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#borrow_pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#borrow_pc_ip").removeClass("is-valid");
            $("#borrow_pc_ip").addClass("is-invalid");
            $("#borrow_saveBtn").hide();
            $("#borrow_saveBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#borrow_pc_ip").removeClass("is-invalid");
            $("#borrow_pc_ip").addClass("is-valid"); 
            $("#borrow_saveBtn").show(); 
            $("#borrow_saveBtn").html('Save');

            }
          }
});
    });
     // check ip


    // add pc borrowed
    $("#borrow_addpcform").validate({
         
         rules: {
          borrow_pc_make : "required",
          borrow_pc_model : "required",
          borrow_pc_ram : "required",
          borrow_pc_hdd : "required",
          borrow_pc_os : "required",
          borrow_pc_monitor : "required",
          borrow_pc_ip : "required",
          borrow_pc_setup : "required",
          borrow_pc_barc_asset_id : "required",
          borrow_pc_amc_id: "required",
          borrow_pc_use : "required",
          borrow_pc_location : "required"
         },
         messages: {
          borrow_pc_make : "Enter Make",
          borrow_pc_model : "Enter processor details",
          borrow_pc_ram : "Enter RAM in number (GB)",
          borrow_pc_hdd : "Enter Hard-disk details",
          borrow_pc_os : "Select OS",
          borrow_pc_monitor : "Enter monitor details",
          borrow_pc_ip : "Enter IP",
          borrow_pc_setup : "Select setup",
          borrow_pc_barc_asset_id : "Enter BARC Capital Asset ID (Capital No.)",
          borrow_pc_amc_id: "Enter AMC ID",
          borrow_pc_use : "Select use",
          borrow_pc_location : "Enter location"
         },

         submitHandler: function(form) {
              var file_data = $('#borrow_pc_rv_copy').prop('files')[0];   
              var op = 'borrow_add_pc';
              var pp = 'Borrowed';
              var formData = new FormData($('#borrow_addpcform')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              formData.append('borrow_pc_purchase',pp);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#borrow_error").fadeOut();
        $("#borrow_saveBtn").html('Saving data ...');
},
     success : function(response){
       //alert(response);
         if(response != 1){
         $("#borrow_error").fadeIn(1000, function(){
         $("#borrow_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#borrow_saveBtn").html('Save');
         });
         }
         else {
         
         $("#borrow_error").fadeIn(1000, function(){
         $("#modal_add").modal('hide');
         $("#borrow_addpcform").trigger("reset");
         $("#borrow_error").fadeOut();
         $("#borrow_saveBtn").html('Save');
         showtoast("PC added successfully!")
         getallpcofusers();
         

         });

         }

}
});
         }
    
 });
 // add pc borrowed

// get ram and hdd
$("#pc_make").change(function(){
  showtoasterror("Please check pre-filled data & update accordingly!");
  var pc1 = $("#pc_make").find('option:selected').val();
    //alert(pc1);
    get_ram_hdd_os(pc1);
});
 // check ip

$('#e_borrow_pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#e_borrow_pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#e_borrow_pc_ip").removeClass("is-valid");
            $("#e_borrow_pc_ip").addClass("is-invalid");
            $("#e_borrowp_updateBtn").hide();
            $("#e_borrowp_updateBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#e_borrow_pc_ip").removeClass("is-invalid");
            $("#e_borrow_pc_ip").addClass("is-valid"); 
            $("#e_borrowp_updateBtn").show(); 
            $("#e_borrowp_updateBtn").html('Save');

            }
          }
});
    });
     // check ip


 // edit pc borrowed
 $("#editpcform_borrowp").validate({
         
         rules: {
             eborro_hid_autoID: "required",
            e_borrow_pc_make : "required",
            e_borrow_pc_model: "required",
            e_borrow_pc_arch: "required",
            e_borrow_pc_ram: "required",
            e_borrow_pc_hdd: "required",
            e_borrow_pc_os: "required",
            e_borrow_pc_monitor: "required",
            e_borrow_pc_ip: "required",
            e_borrow_pc_setup: "required",
            e_borrow_pc_barc_asset_id: "required",
            e_borrow_pc_amc_id: "required",
            e_borrow_pc_use: "required",
            e_borrow_pc_location: "required"
         },
         messages: {
          eborro_hid_autoID: "Invalid Selection for edit",
            e_borrow_pc_make : "Enter make",
            e_borrow_pc_model: "Enter model/processor details",
            e_borrow_pc_arch: "Select 32/64 bit",
            e_borrow_pc_ram: "Enter RAM in GB",
            e_borrow_pc_hdd: "Enter Hard-disk details (Capacity/Make)",
            e_borrow_pc_os: "Select OS",
            e_borrow_pc_monitor: "Enter monitor/display details",
            e_borrow_pc_ip: "Enter IP",
            e_borrow_pc_setup: "Select Setup",
            e_borrow_pc_barc_asset_id: "Enter BARC Capital Asset ID",
            e_borrow_pc_amc_id: "Enter AMC ID",
            e_borrow_pc_use: "Select use",
            e_borrow_pc_location: "Enter PC Location(Room No./Building)"
         },

         submitHandler: function(form) {
              var file_data = $('#e_borrow_pc_rv_copy').prop('files')[0];   
              var op = 'borrow_edit_pc';
              var pp = 'Borrowed';
              var formData = new FormData($('#editpcform_borrowp')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              formData.append('borrow_pc_purchase',pp);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#eborrowp_error").fadeOut();
        $("#e_borrowp_updateBtn").html('Saving data ...');
},
     success : function(response){
       //alert(response);
         if(response != 1){
         $("#eborrowp_error").fadeIn(1000, function(){
         $("#borrow_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
         $("#e_borrowp_updateBtn").html('Update');
         });
         }
         else {
         
         $("#eborrowp_error").fadeIn(1000, function(){
         $("#modal_edit_borrowedp").modal('hide');
         $("#editpcform_borrowp").trigger("reset");
         $("#eborrowp_error").fadeOut();
         $("#e_borrowp_updateBtn").html('Update');
         showtoast("Details updated successfully!")
         getallpcofusers();
         

         });

         }

}
});
         }
    
 });
 // edit pc borrowed

// check ip

$('#indi_pc_ip').blur(function() { 
        //alert('Content has been changed');
        var pc_ip = $('#indi_pc_ip').val();
       $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'check_ip',pc_ip:pc_ip},
        beforeSend: function(){},
        success : function(response){
          //alert(response);
            if(response == 0){
            $("#indi_pc_ip").removeClass("is-valid");
            $("#indi_pc_ip").addClass("is-invalid");
            $("#indi_saveBtn").hide();
            $("#indi_saveBtn").html('Save');
            showtoasterror("Invalid IP/PC with this IP already exist");
            }
            else {
            $("#indi_pc_ip").removeClass("is-invalid");
            $("#indi_pc_ip").addClass("is-valid"); 
            $("#indi_saveBtn").show(); 
            $("#indi_saveBtn").html('Save');

            }
          }
});
    });
     // check ip

    // add pc
    $("#indi_addpcform").validate({
            rules: {
             
              //indi_pc_supplier : "required",
              //indi_indent_no : "required",
              //indi_indent_dt : "required",
              //indi_indent_by : "required",
              //indi_po_no  : "required",
              //indi_po_dt : "required",
              //indi_rv_no : "required",
              //indi_rv_dt  : "required",
              indi_pc_make : "required",
              indi_pc_model : "required",
              indi_pc_ram : "required",
              indi_pc_hdd : "required",
              indi_pc_os : "required",
              indi_pc_monitor : "required",
              //indi_pc_cost : "required",
              indi_pc_ip : "required",
              //indi_pc_warranty : {
                //required : true,
                //number : true
              //},
              //indi_pc_warrabty_uptodate : "required",
            },
            messages: {
              //indi_pc_supplier : "Enter supplier derails",
              //indi_indent_no  : "Enter indent number",
              //indi_indent_dt  : "Enter date",
              //indi_indent_by : "Indent by (Emp. Name)",
              //indi_po_no  : "PO Number",
              //indi_po_dt : "Enter date",
              //indi_rv_no : "RV No.",
              //indi_rv_dt : "Enter date",
              indi_pc_make : "Enter PC Make",
              indi_pc_model : "Enter model",
              indi_pc_ram : "Enter RAM details",
              indi_pc_hdd : "Enter HDD details",
              indi_pc_os : "Seelct OS",
              indi_pc_monitor : "Enter monitor details",
              //indi_pc_cost : "Enter Cost",
              //indi_pc_warranty : "Enter warranty in years",
              //indi_pc_warrabty_uptodate : "required",
              indi_pc_ip : "Enter IP address"

            },
            submitHandler: function(form) {
              var file_data = $('#indi_pc_rv_copy').prop('files')[0];   
              var op = 'indi_add_pc';
              var pp = 'Individual';
              var formData = new FormData($('#indi_addpcform')[0]);
              formData.append('file', file_data);
              formData.append('operation',op);
              formData.append('indi_pc_purchase',pp);
              $.ajax({
              cache: false,
              contentType: false,
              processData: false,
              type : 'post',
              url : 'get_pcs.php',
              data : formData,
        beforeSend: function(){
        $("#indi_error").fadeOut();
        $("#indi_saveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#indi_error").fadeIn(1000, function(){
            $("#indi_error").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#indi_saveBtn").html('Save');
            });
            }
            else {
            
            $("#error").fadeIn(1000, function(){
            $("#modal_add").modal('hide');
            $("#indi_addpcform").trigger("reset");
            $("#indi_error").fadeOut();
            $("#indi_saveBtn").html('Save');
            showtoast("PC added successfully!")
            getallpcofusers();
            

            });

            }

}
});
            }
       
    });
    // add indipurchase pc
     //show toast
     function showtoast($msg){
    
    
    toastr.success($msg)
  }

  function showtoastwarning($msg){
    
    
    toastr.error($msg)
  }
  // show toast

  function showtoasterror($msg){
    
    
    toastr.error($msg)
  }

  $(".cenp").hide();
  $(".indip").hide();
  $(".borrowed").hide();
  $(".pcenp").hide();
  $(".pindip").hide();
  $(".pborrowedp").hide();
  $("#btn_sel_mode").click(function(){
    //alert("next");
    $("#sel_mode").text($("#pc_purchase").val());
    $("#sel_mode").addClass("fas fa-check");
    if($("#pc_purchase").val() == 'Centralize'){
     centralPurchaseFunction();
    }else if($("#pc_purchase").val() == 'Individual'){
      individualPurchaseFunction();
    }else if($("#pc_purchase").val() == 'Borrowed'){
      borrowedFunction();
    }
  });

  function centralPurchaseFunction(){
    $(".cenp").show();
    $(".indip").hide();
    $(".borrowed").hide();
    $("#collapsecentralPurchase").collapse("show");
    $("#collapseindiPurchase").collapse("hide");
    $("#collapseBorrowed").collapse("hide");
    getmakemodel();
  }

  function individualPurchaseFunction(){
    $(".cenp").hide();
    $(".borrowed").hide();
    $("#collapsecentralPurchase").collapse("hide");
    $(".indip").show();
    $("#collapseindiPurchase").collapse("show");
    $("#collapseBorrowed").collapse("hide");
  }

  function borrowedFunction(){
    $(".cenp").hide();
    $("#collapsecentralPurchase").collapse("hide");
    $(".indip").hide();
    $("#collapseindiPurchase").collapse("hide");
    $("#collapseBorrowed").collapse("show");
    $(".borrowed").show();
  }


  function printercentralPurchaseFunction(){
    $(".pcenp").show();
    $(".pindip").hide();
    $(".pborrowed").hide();
    $("#collapsecentralPrinterPurchase").collapse("show");
    $("#collapseindiPrinterPurchase").collapse("hide");
    $("#collapseBorrowedPrinterPurchase").collapse("hide");
    getmakemodel();
  }

  function printerindividualPurchaseFunction(){
    $(".pcenp").hide();
    //$(".pborrowedp").hide();
    $("#collapsecentralPurchase").collapse("hide");
    $(".pindip").show();
    $(".pborrowedp").hide();
    $("#collapseindiPrinterPurchase").collapse("show");
    
  }

  function printerBorrowedFunction(){
    $(".pcenp").hide();
    $(".pindip").hide();
    $(".pborrowedp").show();
    $("#collapsecentralPurchase").collapse("hide");
    $("#collapseindiPrinterPurchase").collapse("hide");
    $("#collapseBorPrinterPurchase").collapse("show");
  }

  $("#checkBtn").click(function(){
      //alert("ok");
      alert($("input[name='pc_working']:checked").val());
  });


  $("#btn_printer_sel_mode").click(function(){
    //alert("next");
    $("#sel_printer_mode").text($("#printer_purchase").val());
    $("#sel_printer_mode").addClass("fas fa-check");
    if($("#printer_purchase").val() == 'Centralize'){
     printercentralPurchaseFunction();
    }else if($("#printer_purchase").val() == 'Individual'){
      printerindividualPurchaseFunction();
    }else if($("#printer_purchase").val() == 'Borrowed'){
      printerBorrowedFunction();
    }
  });




  $("#btn_makeos").click(function(){
    //alert("next");
    $("#sel_makeos").text($("#pc_make option:selected").text() + " / OS : " + $("#pc_os option:selected").text());
    $("#sel_makeos").addClass("fas fa-check");
    
  });

  $("body").on("click", ".delete_pc", function (e) {
      //alert($(this).data('id'));
      //removePersonalPC($(this).data('id'));      
      $("#delid").val($(this).data('id'));
    });


    $("#deleteBtn").click(function(){
      removePersonalPC($("#delid").val());
    });

    function removePersonalPC(id){
      $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'delete_pc',forid : id},
        beforeSend: function(){
        $("#deleteBtn").html('Saving data ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            getallpcofusers();
            showtoast("PC removed successfully!");
            $("#modal_delete").modal('hide');
            $("#delid").val('');
            $("#deleteBtn").html("Delete");
           

          }else{
            showtoast("Internal server error!");
          } 
        }
    });

    }
   

    var pc1 = $("#pc_make").find('option:selected').val();
    //alert(pc1);
    get_ram_hdd_os(pc1);

    function get_ram_hdd_os(pc){
      $.ajax({
        type : 'post',
        url : 'get_pc_purchase_details.php',
        data: {operation:'single_detail_asjson',id:pc},
        success : function(response){
          // /alert(response);
          data = JSON.parse(response);
          $("#pc_hdd").val(data[0].pc_hdd_details);
          $("#pc_os").val(data[0].pc_os_details);
          $("#pc_ram").val(data[0].pc_ram_details);
          $("#pc_ssd").val(data[0].pc_ssd_details);
          
        }
      })
    }


    
        $("body").on("click", ".view_details", function (e) {
          id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data.pc_source);
          if(data.pc_source == "Centralize"){
            $("#modal_view_cenp").modal("show");
            //alert(data.pc_make_model);
            $("#vcenp_pc_make").val(data.pc_make_model)
            $("#vcenp_pc_os").val(data.pc_os);
            $("#vcenp_pc_arch").val(data.pc_bit_type);
            $("#vcenp_ppc_ram").val(data.pc_ram_value);
            $("#vcenp_pc_hdd").val(data.pc_hdd);
            $("#vcenp_pc_ip").val(data.pc_ip);
            $("#vcenp_pc_setup").val(data.pc_setup)
            $("#vcenp_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#vcenp_pc_amc_id").val(data.pc_amc_id);
            $("#vcenp_pc_use").val(data.pc_use);
            $("#vcenp_pc_location").val(data.pc_location);
            //alert(data.working);
            $('input[name="v_cenp_pc_working"][value="' + data.working + '"]').prop('checked', true);
            $("#vcenp_pc_make_text").val(data.pc_make);
            $("#vcenp_pc_model_text").val(data.pc_processor_details);
          }
          if(data.pc_source == "Individual"){
          $("#modal_view_indip").modal("show");
          $("#v_indi_pc_supplier").val(data.pc_supplier_name);
            $("#v_indi_indent_no").val(data.pc_indent_no);
            $("#v_indi_indent_dt").val(data.pc_indent_dt);
            $("#v_indi_indent_by").val(data.pc_indent_by);
            $("#v_indi_po_no").val(data.pc_po_no);
            $("#v_indi_po_dt").val(data.pc_po_dt);
            $("#v_indi_rv_no").val(data.pc_rv_no);
            $("#v_indi_rv_dt").val(data.pc_rv_dt);
            $("#v_indi_pc_cost").val(data.pc_cost);
            $("#v_indi_pc_warranty").val(data.warranty_in_years);
            $("#v_indi_pc_warranty_uptodate").val(data.warranty_till);
            $("#v_indi_pc_make").val(data.pc_make);
            $("#v_indi_pc_model").val(data.pc_processor_details);
            $("#v_indi_pc_arch").val(data.pc_bit_type);
            $("#v_indi_pc_ram").val(data.pc_ram_value);
            $("#v_indi_pc_hdd").val(data.pc_hdd);
            $("#v_indi_pc_os").val(data.pc_os);
            $("#v_indi_pc_monitor").val(data.pc_monitor_details);
            $("#v_indi_pc_ip").val(data.pc_ip);
            $("#v_indi_pc_setup").val(data.pc_setup);
            $("#v_indi_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#v_indi_pc_amc_id").val(data.pc_amc_id);
            $("#v_indi_pc_use").val(data.pc_use);
            $("#v_indi_pc_location").val(data.pc_location);
            $('input[name="v_indi_pc_working"][value="' + data.working + '"]').prop('checked', true);

          }
          if(data.pc_source == "Borrowed"){
            $("#modal_view_borrowedp").modal("show"); 
            $("#v_borrow_pc_make").val(data.pc_make);
            $("#v_borrow_pc_model").val(data.pc_processor_details);
            $("#v_borrow_pc_arch").val(data.pc_bit_type);
            $("#v_borrow_pc_ram").val(data.pc_ram_value);
            $("#v_borrow_pc_hdd").val(data.pc_hdd);
            $("#v_borrow_pc_os").val(data.pc_os);
            $("#v_borrow_pc_monitor").val(data.pc_monitor_details);
            $("#v_borrow_pc_ip").val(data.pc_ip);
            $("#v_borrow_pc_setup").val(data.pc_setup);
            $("#v_borrow_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#v_borrow_pc_amc_id").val(data.pc_amc_id);
            $("#v_borrow_pc_use").val(data.pc_use);
            $("#v_borrow_pc_location").val(data.pc_location);
            $('input[name="v_borrow_pc_working"][value="' + data.working + '"]').prop('checked', true);
          }
          
        }
          });

        });


        $("body").on("click", ".printer_view_details", function (e) {
          id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details_printer',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //$("#modal_view_printer").modal("show");
          //alert(data.pc_source);
          if(data.device_source == "Centralize"){
            $("#modal_view_printer").modal("show");
           //alert("Hello");
           $("#v_printer_make").val(data.device_make_model);
           $("#v_printer_barc_asset_id").val(data.device_barc_asset_id);
           $("#v_printer_amc_id").val(data.device_amc_id);
           $("#v_printer_use").val(data.device_use);
           $("#v_printer_location").val(data.device_location);
           $('input[name="v_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
          if(data.device_source == "Individual"){
            $("#modal_view_indi_printer").modal("show");
           //alert("Hello");
           $("#indi_device_v").val(data.device);
            $("#indi_device_supplier_v").val(data.device_supplier_details);
            $("#indi_device_indent_no_v").val(data.device_indent_no);
            $("#indi_device_indent_dt_v").val(data.device_indent_dt);
            $("#indi_device_indent_by_v").val(data.device_indent_by);
            $("#indi_device_po_no_v").val(data.device_po_no);
            $("#indi_device_po_dt_v").val(data.device_po_dt);
            $("#indi_device_rv_no_v").val(data.device_rv_no);
            $("#indi_device_rv_dt_v").val(data.device_rv_dt);
            $("#indi_device_cost_v").val(data.device_cost);
            $("#indi_device_warranty_v").val(data.warranty_in_years);
            $("#indi_device_warranty_uptodate_v").val(data.warranty_till);
            $("#indi_v_printer_make").val(data.device_make);
            $("#indi_device_model_v").val(data.device_model);
            $("#v_indi_printer_barc_asset_id").val(data.device_barc_asset_id);
            $("#v_indi_printer_amc_id").val(data.device_amc_id);
            $("#v_indi_printer_use").val(data.device_use);
            $("#v_indi_printer_location_v").val(data.device_location);
            $("#indi_device_tone_v").val(data.device_tone);
            $('input[name="v_indi_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }


          if(data.device_source == "Borrowed"){
            $("#modal_borrowed_view_printer").modal("show");
           $("#bor_device_v").val(data.device)
           $("#bor_device_make_v").val(data.device_make)
           $("#bor_device_model_v").val(data.device_model)
           $("#bor_device_barc_asset_id_v").val(data.device_barc_asset_id); 
           $("#bor_device_amc_id_v").val(data.device_amc_id);
           $("#bor_device_use_v").val(data.device_use);
           $("#bor_device_location_v").val(data.device_location);
           $("#bor_device_tone_v").val(data.device_tone);
           $('input[name="v_bor_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
         
         
          
        }
          });

        });


        $("body").on("click", ".printer_edit_details", function (e) {
          id = $(this).data('id');
          $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data: {operation:'get_details_printer',forid:id},
        success : function(response){
          //alert(response);
          data = JSON.parse(response);
          //alert(data.pc_source);
          if(data.device_source == "Centralize"){
          $("#modal_edit_printer").modal("show");
           //alert("Hello");
           $("#e_p_autoID").val(data.autoID);
           $("#e_printer_make").val(data.device_make_model);
           $("#e_printer_barc_asset_id").val(data.device_barc_asset_id);
           $("#e_printer_amc_id").val(data.device_amc_id);
           $("#e_printer_use").val(data.device_use);
           $("#e_printer_location").val(data.device_location);
           //alert(data.working);
           $('input[name="e_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }

          if(data.device_source == "Individual"){
          $("#modal_edit_indi_printer").modal("show");
           //alert("Hello");
           $("#indi_device_e_autoID").val(data.autoID);
          $("#indi_device_e").val(data.device);
          $("#indi_device_supplier_e").val(data.device_supplier_details);
          $("#indi_device_indent_no_e").val(data.device_indent_no);
          $("#indi_device_indent_dt_e").val(data.device_indent_dt);
          $("#indi_device_indent_by_e").val(data.device_indent_by);
           $("#indi_device_po_no_e").val(data.device_po_no);
          $("#indi_device_po_dt_e").val(data.device_po_dt);
          $("#indi_device_rv_no_e").val(data.device_rv_no);
          $("#indi_device_rv_dt_e").val(data.device_rv_dt);
          $("#indi_device_cost_e").val(data.device_cost);
          $("#indi_device_warranty_e").val(data.warranty_in_years);
          $("#indi_device_warranty_uptodate_e").val(data.warranty_till);
          $("#indi_e_printer_make").val(data.device_make);
          $("#indi_device_model_e").val(data.device_model);
          $("#e_indi_printer_barc_asset_id").val(data.device_barc_asset_id);
          $("#e_indi_printer_amc_id").val(data.device_amc_id);
          $("#e_indi_printer_use").val(data.device_use);
          $("#e_indi_printer_location_e").val(data.device_location);
          $("#indi_device_tone_e").val(data.device_tone);
          $('input[name="e_indi_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
          if(data.device_source == "Borrowed"){
           $("#modal_borrowed_edit_printer").modal("show");
           $("#e_bor_device_autoID").val(data.autoID);
           $("#bor_device_e").val(data.device);
           $("#bor_device_make_e").val(data.device_make);
           $("#bor_device_model_e").val(data.device_model);
           $("#bor_device_barc_asset_id_e").val(data.device_barc_asset_id); ;
           $("#bor_device_amc_id_e").val(data.device_amc_id);
           $("#bor_device_use_e").val(data.device_use);
           $("#bor_device_location_e").val(data.device_location);
           $("#bor_device_tone_e").val(data.device_tone);
           $('input[name="e_bor_printer_working"][value="' + data.working + '"]').prop('checked', true);
          }
         
          
        }
          });

        });


        $("body").on("click", ".edit_details", function (e) {
          edit_get_pc_details($(this).data('id'));
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
            $("#ecenp_pc_make").val(data.pc_make_model);
           // alert(data.pc_make_model);
            $("#ecenp_pc_os").val(data.pc_os);
            $("#ecenp_pc_arch").val(data.pc_bit_type);
            $("#ecenp_ppc_ram").val(data.pc_ram_value);
            $("#ecenp_pc_hdd").val(data.pc_hdd);
            $("#ecenp_pc_ssd").val(data.pc_ssd);
            $("#ecenp_pc_ip").val(data.pc_ip);
            $("#ecenp_pc_setup").val(data.pc_setup)
            $("#ecenp_pc_barc_asset_id").val(data.pc_barc_asset_id);
            $("#ecenp_pc_amc_id").val(data.pc_amc_id);
            $("#ecenp_pc_use").val(data.pc_use);
            $('input[name="ecenp_pc_working"][value="' + data.working + '"]').prop('checked', true);
            $("#ecenp_pc_location").val(data.pc_location);
            $("#ecenp_pc_make_text").val(data.pc_make);
            $("#ecenp_pc_model_text").val(data.pc_processor_details);
            $("#ecenp_pc_form_text").val(data.pc_form);
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
            $('input[name="e_indi_pc_working"][value="' + data.working + '"]').prop('checked', true);
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
            $('input[name="e_borrow_pc_working"][value="' + data.working + '"]').prop('checked', true);
          }
          //alert(data.pc_source);
        }
    });
    
    }

    $("#indi_device_supplier").keyup(function() {
     get_supplier_suggesstion_printer($(this).val());
	});

function get_supplier_suggesstion_printer(kw){
  
  var s = '';
      if(kw!=''){
        $.ajax({
      type : 'post',
        url : 'get_pcs.php',
        data : {operation:'search_supplier_printer',kw:kw},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(response) {
				$("#suggesstion-box_printer").show();
				//$("#suggesstion-box").html(data);
				$("#loader").hide();
        data = JSON.parse(response);
        $("#suggesstion-box_printer").html("");
        var list = [];
        for (var i = 0; i < data.length; i++) {
          if ($.inArray(data[i].device_rv_no+data[i].device_indent_by, list) >= 0) {
          
        } else{
          list.push(data[i].device_rv_no+data[i].device_indent_by);
          s= '<li class="list-group-item list-group-item-action list-group-item-success sel_item_printer" data-id="'+data[i].autoID+'" value="'+data[i].autoID+'">' + data[i].device_supplier_details + ' [ ' + data[i].device_make + ' / '+ data[i].device_model + '/ Indenting officer : ' +data[i].device_indent_by + ' / RV No : ' +data[i].device_rv_no + ' dt. ' + data[i].device_rv_dt + ' ]' +'</li>';  
            $('#suggesstion-box_printer').append(s);

        }
        }
        $('#suggesstion-box_printer').append('<li class="list-group-item list-group-item-action list-group-item-success sel_item_printer" data-id="0" value="NA">NA[Purchase Details not available]</li>');
			}
		  });
      }else{
        $("#suggesstion-box_printer").html("");
      }
		  
}

$("body").on("click", ".sel_item", function (e) {
      //alert($(this).data('id'));  
      var i = $(this).data('id');
      if(i==0){
        fillna();
      }else{
        get_sel_data_autofill(i); 
      }
      $("#suggesstion-box").hide();
    });

    
$("body").on("click", ".sel_item_printer", function (e) {
      //alert($(this).data('id'));
      //removePersonalPC($(this).data('id'));   

      //alert($(this).data('id'));  
      var i = $(this).data('id');
      if(i==0){
        fillna_printer();
      }else{
        get_sel_data_autofill_printer(i);
      }
      $("#suggesstion-box_printer").hide(); 
    });




function fillna(){
   showtoastwarning("Kindly check pre-filled data");
  // alert("loading");
   $("#indi_pc_supplier").val("NA");
   $("#indi_indent_no").val("NA");
   $("#indi_indent_by").val("NA");
   $("#indi_po_no").val("NA");
   $("#indi_rv_no").val("NA");
   $("#indi_rv_dt").val();
   $("#indi_pc_cost").val("0");
   $("#indi_pc_warranty").val("0");
   $("#indi_pc_model").val("");
}

function fillna_printer(){
   showtoastwarning("Kindly check pre-filled data");
  // alert("loading");
            $("#indi_device_supplier").val("NA");
            $("#indi_device_indent_no").val("NA");
            $("#indi_device_indent_dt").val("");
            $("#indi_device_indent_by").val("NA");
            $("#indi_device_po_no").val("NA");
            $("#indi_device_po_dt").val("");
            $("#indi_device_rv_no").val("NA");
            $("#indi_device_rv_dt").val("");
            $("#indi_device_cost").val("0");
            $("#indi_device_warranty_uptodate").val("");
            $("#indi_device_make").val("");
            $("#indi_device_model").val("");
}



function get_sel_data_autofill_printer(id){
  $.ajax({
        type : 'post',
        url : 'get_pcs.php',
        data : {operation:'get_autofilldata_printer',id:id},
        beforeSend: function(){},
        success : function(response){
          data = JSON.parse(response);
          showtoastwarning("Kindly check pre-filled data");
            $("#indi_pc_form").val(data.pc_form);
            $("#indi_device").val(data.device)
            $("#indi_device_supplier").val(data.device_supplier_details);
            $("#indi_device_indent_no").val(data.device_indent_no);
            $("#indi_device_indent_dt").val(data.device_indent_dt);
            $("#indi_device_indent_by").val(data.device_indent_by);
            $("#indi_device_po_no").val(data.device_po_no);
            $("#indi_device_po_dt").val(data.device_po_dt);
            $("#indi_device_rv_no").val(data.device_rv_no);
            $("#indi_device_rv_dt").val(data.device_rv_dt);
            $("#indi_device_cost").val(data.device_cost);
            $("#indi_device_warranty_uptodate").val(data.warranty_till);
            $("#indi_device_make").val(data.device_make);
            $("#indi_device_model").val(data.device_model);
          }
});
}
    

    
  

  });
</script>
</body>
</html>
