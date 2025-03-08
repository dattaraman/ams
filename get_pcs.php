<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
    $output = '';
    $usr = $getdata->getalluserpcs($_SESSION['loggedinby']);
    //print_r($usr);
    $working_textpc = '';



    
    foreach ($usr as $row){
        $grp_status = 0;
        if ($row["groupadmin_approval"]==0){
            $grp_status = '<div class="ribbon bg-danger">
            Pending
        </div>';
        }else{
            $grp_status = '<div class="ribbon bg-success">
            Approved
        </div>';
        }
        $output .='
               
        <div class="col-md-4">
        <div class="card card-widget widget-user-2">
        <div class="widget-user-header bg-dark">
                <div class="widget-user-image">';
                if($row['pc_form']=='laptop'){$pcform = 'laptopicon.png';}else{$pcform = 'pcicon.png';}
                $output .='<img class="" src="images/'.$pcform.'" alt="Image">
                </div>
                <div class="ribbon-wrapper ribbon-lg">'.
                $grp_status.'
                </div>';

                if($row['working']==1){
                    $working_textpc = '';
                }else{
                    $working_textpc = '
                    <li class="nav-item listitem">
                    <span class="nav-link text-left"> 
                        <span class="fas fa-exclamation-circle text-danger"> Not in working condition</span>
                    </span>
                </li>
                    ';
                }
                $output.='
                
                <h3 class="widget-user-username text-sm w-50">'. $row["pc_make"].' / '.$row["pc_processor_details"].'<span class="float-right"></span>
                </h3>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column text-primary">'.$working_textpc.'


                    <li class="nav-item listitem">
                    <span class="nav-link">
                    <span class="fab fa-'.strtolower($row['os_of']).' mr-1"></span>'.$row["os_name"].'
                    <span class="fas fa-microchip mr-1 float-right"> '.$row["pc_bit_type"].'</span>
                    </span>
                    </li>
                    <li class="nav-item listitem">
                        <span class="nav-link">
                        <span class="fas fa-wifi mr-1"></span>'.$row["pc_ip"].'
                        <span class="fas fa-ruler-vertical mr-1 float-right"> '.$row["pc_ram_value"].' GB</span>
                        </span>
                    </li>
                    <li class="nav-item listitem">
                        <span class="nav-link text-center"> 
                            <span class="fas fa-cart-plus"> '.$row["pc_source"].'</span>
                        </span>
                    </li>

                    
                    <li class="nav-item listitem text-right">
                        <span class="nav-link">
                            <button class="btn btn-sm btn-primary view_details" data-id="'.$row["autoID"].'"> <span class="fas fa-info-circle"></span> Details</button>
                            <button class="btn btn-sm btn-warning edit_details" data-id="'.$row["autoID"].'" data-target="#" data-toggle="modal"> <span class="fas fa-edit"></span> Edit</button>
                        </span>
                    </li>
                </ul></div>
              </div>
            </div>  
        </div>
        ';   
    }
    echo $output;
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'alllist_printer'){
    $output = '';
    $usr = $getdata->getalluserprinters($_SESSION['loggedinby']);
    //print_r($usr);
    $working_textde = '';



    
    foreach ($usr as $row){
        $grp_status = 0;
        if ($row["groupadmin_approval"]==0){
            $grp_status = '<div class="ribbon bg-danger">
            Pending
        </div>';
        }else{
            $grp_status = '<div class="ribbon bg-success">
            Approved
        </div>';


        if($row['working']==1){
            $working_textde = '';
        }else{
            $working_textde = '<li class="nav-item listitem"><span class="nav-link text-left"><span class="fas fa-exclamation-circle text-danger"> Not in working condition</span> </span></li>';
        }



        }
        $output .='
               
        <div class="col-md-4">
        <div class="card card-widget widget-user-2">
        <div class="widget-user-header bg-dark">
                <div class="widget-user-image">';
                if($row['device']=='Printer'){$pcform = 'printericon.png';}elseif($row['device']=='MFD'){$pcform = 'mfdicon.png';} else {$pcform = 'scannericon.png';}
                $output .='<img class="" src="images/'.$pcform.'" alt="PC" data-toggle="tooltip" title="'.$row['device'].'">
                </div>
                <div class="ribbon-wrapper ribbon-lg">'.
                $grp_status.'
                </div>
                
                <h3 class="widget-user-username text-sm w-50">'. $row["device_make"].' / '.$row["device_model"].'<span class="float-right"></span>
                </h3>
                <h5 class="widget-user-username text-xs w-50">['.$row['device'].']</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column text-primary">'.$working_textde.'
                    <li class="nav-item listitem">
                    <span class="nav-link">
                   
                    <span class="fas fa-file mr-1 mr-1"> '.$row["device_tone"].'</span>
                    </span>
                    </li>
                    <li class="nav-item listitem">
                        <span class="nav-link">
                        <span class="fas fa-atom mr-1"></span>'.$row["device_barc_asset_id"].'
                        </span>
                    </li>
                    <li class="nav-item listitem">
                    <span class="nav-link">
                    <span class="fas fa-tools mr-1"> '.$row["device_amc_id"].'</span>
                    </span>
                </li>
                    <li class="nav-item listitem">
                    <span class="nav-link text-center"> 
                        <span class="fas fa-cart-plus"> '.$row["device_source"].'</span>
                    </span>
                </li>
                    <li class="nav-item listitem text-right">
                        <span class="nav-link">
                            <button class="btn btn-sm btn-primary printer_view_details" data-id="'.$row["autoID"].'"> <span class="fas fa-info-circle"></span> Details</button>
                            <button class="btn btn-sm btn-warning printer_edit_details" data-id="'.$row["autoID"].'" data-target="#" data-toggle="modal"> <span class="fas fa-edit"></span> Edit</button>
                           
                        </span>
                    </li>
                </ul></div>
              </div>
            </div>  
        </div>
        ';   
    }
    echo $output;
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'check_ip'){
      
    
    
    $res = $getdata->checkip($_POST['pc_ip']);
    echo $res;
    
   }
   

   if(isset($_POST['operation']) && $_POST['operation'] == 'add_pc'){

    $res = $getdata->addPc($_POST['pc_working'],$_POST['pc_ssd'],$_POST['pc_location'],$_POST['pc_use'],$_POST['pc_hdd'],$_POST['pc_purchase'],$_POST['pc_make'],$_POST['pc_os'],$_POST['pc_arch'],$_POST['pc_ram'],$_POST['pc_ip'],$_POST['pc_setup'],$_POST['pc_barc_asset_id'],$_POST['pc_amc_id']);
    
    if ($res){

        $getdata->log_activity('ADD PC [Centralize Purchase] : IP-'.$_POST['pc_ip'].', PC Make : '.$_POST['pc_make']);
        echo $res;
    }
    else{
        echo 0;
    }
    
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'add_printer'){

    $res = $getdata->addcenPrinter($_POST['device_working'],$_POST['printer_make'],$_POST['printer_barc_asset_id'],$_POST['printer_amc_id'],$_POST['printer_use'],$_POST['printer_location']);
    
    if ($res){

        $getdata->log_activity('ADD Printer [Centralize Purchase] : Make-'.$_POST['printer_make']);
        echo $res;
    }
    else{
        echo 0;
    }
    
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'edit_printer'){

    $res = $getdata->editcenPrinter($_POST['e_printer_working'],$_POST['e_p_autoID'],$_POST['e_printer_make'],$_POST['e_printer_barc_asset_id'],$_POST['e_printer_amc_id'],$_POST['e_printer_use'],$_POST['e_printer_location']);
    
    if ($res){

        $getdata->log_activity('UPDATE Printer [Centralize Purchase] : Make-'.$_POST['e_printer_make'].', Printer autoID - '.$_POST['e_p_autoID']);
        echo $res;
    }
    else{
        echo 0;
    }
    
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'update_bor_printer'){

    $res = $getdata->editborPrinter($_POST['e_bor_device_autoID'],$_POST['bor_device_e'],$_POST['bor_device_make_e'],$_POST['bor_device_model_e'],$_POST['bor_device_barc_asset_id_e'],$_POST['bor_device_amc_id_e'],$_POST['bor_device_use_e'],$_POST['bor_device_location_e'],$_POST['bor_device_tone_e'],$_POST['e_bor_printer_working']);
    
    if ($res){

        $getdata->log_activity('UPDATE Printer [Borrowed] : Make-'.$_POST['bor_device_make_e'].', Printer autoID - '.$_POST['e_bor_device_autoID']);
        echo $res;
    }
    else{
        echo 0;
    }
    
   }
   
   
   
   
   
   
   

   if(isset($_POST['operation']) && $_POST['operation'] == 'edit_cenp_pc'){

    $res = $getdata->edit_cenp_Pc($_POST['ecenp_pc_working'],$_POST['ecenp_pc_ssd'],$_POST['hid_autoID'],$_POST['ecenp_pc_make'],$_POST['ecenp_pc_os'],$_POST['ecenp_pc_arch'],$_POST['ecenp_ppc_ram'],$_POST['ecenp_pc_hdd'],$_POST['ecenp_pc_ip'],$_POST['ecenp_pc_setup'],$_POST['ecenp_pc_barc_asset_id'],$_POST['ecenp_pc_amc_id'],$_POST['ecenp_pc_use'],$_POST['ecenp_pc_location']);
    //echo $res;
    if ($res){

        $getdata->log_activity('EDIT PC [Centralize Purchase] : ID : '.$_POST['hid_autoID'].' IP-'.$_POST['ecenp_pc_ip'].', PC Make : '.$_POST['ecenp_pc_make']);
        echo 1;
    }
    else{
        echo 0;
    }
    
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'edit_indip_pc'){

   
    $res = $getdata->edit_indip_Pc($_POST['e_indi_pc_working'],$_POST['eindi_hid_autoID'],$_POST['e_indi_pc_supplier'],$_POST['e_indi_indent_no'],$_POST['e_indi_indent_dt'],$_POST['e_indi_indent_by'],$_POST['e_indi_po_no'],$_POST['e_indi_po_dt'],$_POST['e_indi_rv_no'],$_POST['e_indi_rv_dt'],$_POST['e_indi_pc_cost'],$_POST['e_indi_pc_warranty'],$_POST['e_indi_pc_warranty_uptodate'],$_POST['e_indi_pc_make'],$_POST['e_indi_pc_model'],$_POST['e_indi_pc_ram'],$_POST['e_indi_pc_hdd'],$_POST['e_indi_pc_os'],$_POST['e_indi_pc_monitor'],$_POST['e_indi_pc_ip'],$_POST['e_indi_pc_setup'],$_POST['e_indi_pc_barc_asset_id'],$_POST['e_indi_pc_amc_id'],$_POST['e_indi_pc_use'],$_POST['e_indi_pc_location'],$_POST['e_indi_pc_arch'],$_POST['e_indi_pc_form']);
    //echo $res;
                     //indigetAddedRecord(          $indi_pc_location,          $indi_pc_use,           $indi_pc_arch,          $indi_pc_purchase,              $indi_pc_supplier,         $indi_indent_no,          $indi_indent_dt,           $indi_indent_by,          $indi_po_no,         $indi_po_dt,        $indi_rv_no,                 $indi_rv_dt         ,$indi_pc_make,         $indi_pc_model,         $indi_pc_ram,         $indi_pc_hdd,         $indi_pc_os,                      $indi_pc_monitor,       $indi_pc_cost,          $indi_pc_warranty,          $indi_pc_warrabty_uptodate,       $indi_pc_ip,          $indi_pc_setup,         $indi_pc_barc_asset_id,         $indi_pc_amc_id){
    $ret_id = $getdata->indigetAddedRecord($_POST['e_indi_pc_location'],$_POST['e_indi_pc_use'],$_POST['e_indi_pc_arch'],'Individual',$_POST['e_indi_pc_supplier'],$_POST['e_indi_indent_no'],$_POST['e_indi_indent_dt'],$_POST['e_indi_indent_by'],$_POST['e_indi_po_no'],$_POST['e_indi_po_dt'],$_POST['e_indi_rv_no'],$_POST['e_indi_rv_dt'],$_POST['e_indi_pc_make'],$_POST['e_indi_pc_model'],$_POST['e_indi_pc_ram'],$_POST['e_indi_pc_hdd'],$_POST['e_indi_pc_os'],$_POST['e_indi_pc_monitor'],$_POST['e_indi_pc_cost'],$_POST['e_indi_pc_warranty'],$_POST['e_indi_pc_warranty_uptodate'],$_POST['e_indi_pc_ip'],$_POST['e_indi_pc_setup'],$_POST['e_indi_pc_barc_asset_id'],$_POST['e_indi_pc_amc_id'],$_POST['e_indi_pc_form']);
    //echo $ret_id;
     if ($res && $ret_id){
        $getdata->log_activity('EDIT PC [Individual Purchase] : ID : '.$_POST['eindi_hid_autoID'].' IP-'.$_POST['e_indi_pc_ip'].', PC Make : '.$_POST['e_indi_pc_make']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'RV'.'-'.$_POST['e_indi_pc_make'].'-'.$ret_id;
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi($filename.'.'.$extension,$ret_id);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
        
         
            // upload
      
   
    echo 1;
}else{
    echo "System Error!";
}
   }
   
                                        
                                        
                                        
 

   if(isset($_POST['operation']) && $_POST['operation'] == 'indi_add_pc'){
                                                
    //                                 ($indi_pc_use,        $indi_pc_arch,        $indi_pc_purchase,          $indi_pc_supplier,          $indi_indent_no,         $indi_indent_dt,        $indi_indent_by,          $indi_po_no,         $indi_po_dt,         $indi_rv_no,        $indi_rv_dt,          $indi_pc_make,        $indi_pc_model,         $indi_pc_ram,          $indi_pc_hdd,        $indi_pc_os,          $indi_pc_monitor,         $indi_pc_cost,         $indi_pc_warranty,         $indi_pc_warrabty_uptodate,        $indi_pc_ip,          $indi_pc_setup,        $indi_pc_barc_asset_id,        $indi_pc_amc_id){                                                                               
    $res = $getdata->Indi_addPc($_POST['indi_pc_working'],$_POST['indi_pc_location'],$_POST['indi_pc_use'],$_POST['indi_pc_arch'],$_POST['indi_pc_purchase'],$_POST['indi_pc_supplier'],$_POST['indi_indent_no'],$_POST['indi_indent_dt'],$_POST['indi_indent_by'],$_POST['indi_po_no'],$_POST['indi_po_dt'],$_POST['indi_rv_no'],$_POST['indi_rv_dt'],$_POST['indi_pc_make'],$_POST['indi_pc_model'],$_POST['indi_pc_ram'],$_POST['indi_pc_hdd'],$_POST['indi_pc_os'],$_POST['indi_pc_monitor'],$_POST['indi_pc_cost'],$_POST['indi_pc_warranty'],$_POST['indi_pc_warrabty_uptodate'],$_POST['indi_pc_ip'],$_POST['indi_pc_setup'],$_POST['indi_pc_barc_asset_id'],$_POST['indi_pc_amc_id'],$_POST['indi_pc_form']);
    $ret_id = $getdata->indigetAddedRecord($_POST['indi_pc_location'],$_POST['indi_pc_use'],$_POST['indi_pc_arch'],$_POST['indi_pc_purchase'],$_POST['indi_pc_supplier'],$_POST['indi_indent_no'],$_POST['indi_indent_dt'],$_POST['indi_indent_by'],$_POST['indi_po_no'],$_POST['indi_po_dt'],$_POST['indi_rv_no'],$_POST['indi_rv_dt'],$_POST['indi_pc_make'],$_POST['indi_pc_model'],$_POST['indi_pc_ram'],$_POST['indi_pc_hdd'],$_POST['indi_pc_os'],$_POST['indi_pc_monitor'],$_POST['indi_pc_cost'],$_POST['indi_pc_warranty'],$_POST['indi_pc_warrabty_uptodate'],$_POST['indi_pc_ip'],$_POST['indi_pc_setup'],$_POST['indi_pc_barc_asset_id'],$_POST['indi_pc_amc_id'],$_POST['indi_pc_form']);
    
    //echo $ret_id;
     if ($res && $ret_id){
        $getdata->log_activity('ADD PC [Individual/Group Purchase]: IP-'.$_POST['indi_pc_ip'].', PC Make : '.$_POST['indi_pc_make']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'RV'.'-'.$_POST['indi_pc_make'].'-'.$ret_id;
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi($filename.'.'.$extension,$ret_id);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
         
            // upload
            echo 1;
        }else{
            echo 0;
        }
}


/* add indi device */
if(isset($_POST['operation']) && $_POST['operation'] == 'indi_add_device'){
                                                
   
    $res = $getdata->Indi_addDevice($_POST['indi_device_working'],$_POST['indi_device_purchase'],$_POST['indi_device'],$_POST['indi_device_supplier'],$_POST['indi_device_indent_no'],$_POST['indi_device_indent_dt'],$_POST['indi_device_indent_by'],$_POST['indi_device_po_no'],$_POST['indi_device_po_dt'],$_POST['indi_device_rv_no'],$_POST['indi_device_rv_dt'],$_POST['indi_device_cost'],$_POST['indi_device_warranty'],$_POST['indi_device_warranty_uptodate'],$_POST['indi_device_make'],$_POST['indi_device_model'],$_POST['indi_device_barc_asset_id'],$_POST['indi_device_amc_id'],$_POST['indi_device_use'],$_POST['indi_device_location'],$_POST['indi_device_tone']);
    $ret_id = $getdata->indi_device_getAddedRecord($_POST['indi_device_purchase'],$_POST['indi_device'],$_POST['indi_device_supplier'],$_POST['indi_device_indent_no'],$_POST['indi_device_indent_dt'],$_POST['indi_device_indent_by'],$_POST['indi_device_po_no'],$_POST['indi_device_po_dt'],$_POST['indi_device_rv_no'],$_POST['indi_device_rv_dt'],$_POST['indi_device_cost'],$_POST['indi_device_warranty'],$_POST['indi_device_warranty_uptodate'],$_POST['indi_device_make'],$_POST['indi_device_model'],$_POST['indi_device_barc_asset_id'],$_POST['indi_device_amc_id'],$_POST['indi_device_use'],$_POST['indi_device_location'],$_POST['indi_device_tone']);
    //echo $ret_id;
    if ($res && $ret_id){
        $getdata->log_activity('ADD DEVICE [Individual/Group Purchase]: Device-'.$_POST['indi_device'].', Device Make/Model : '.$_POST['indi_device_make'].'/'.$_POST['indi_device_model']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'RV'.'-'.$_POST['indi_device_make'].'-'.$ret_id;
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi_device($filename.'.'.$extension,$ret_id);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
         
            // upload
            echo 1;
        }else{
            echo 0;
        }
}
 	 	

/* add indi device */


/* update indi device */
if(isset($_POST['operation']) && $_POST['operation'] == 'indi_update_device'){
                                                
   
    $res = $getdata->Indi_editDevice($_POST['e_indi_printer_working'],$_POST['indi_device_e_autoID'],$_POST['indi_device_e'],$_POST['indi_device_supplier_e'],$_POST['indi_device_indent_no_e'],$_POST['indi_device_indent_dt_e'],$_POST['indi_device_indent_by_e'],$_POST['indi_device_po_no_e'],$_POST['indi_device_po_dt_e'],$_POST['indi_device_rv_no_e'],$_POST['indi_device_rv_dt_e'],$_POST['indi_device_cost_e'],$_POST['indi_device_warranty_e'],$_POST['indi_device_warranty_uptodate_e'],$_POST['indi_e_printer_make'],$_POST['indi_device_model_e'],$_POST['e_indi_printer_barc_asset_id'],$_POST['e_indi_printer_amc_id'],$_POST['e_indi_printer_use'],$_POST['e_indi_printer_location_e'],$_POST['indi_device_tone_e']);
    $ret_id = $_POST['indi_device_e_autoID'];
    //echo $res;
    if ($res){
        $getdata->log_activity('UPDATE DEVICE [Individual/Group Purchase]: Device ID-'.$_POST['indi_device_e_autoID'].', Device Make/Model : '.$_POST['indi_e_printer_make'].'/'.$_POST['indi_device_model_e']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'IND'.'-'.$_POST['indi_e_printer_make'].'-'.$ret_id;
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi_device($filename.'.'.$extension,$ret_id);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
         
            // upload
            echo 1;
        }else{
            echo 0;
        }
}
 /* update indi device */	 	

   if(isset($_POST['operation']) && $_POST['operation'] == 'borrow_add_pc'){
                                 
        $res = $getdata->Borrow_addPc($_POST['borrow_pc_working'],$_POST['borrow_pc_location'],$_POST['borrow_pc_purchase'],$_POST['borrow_pc_make'],$_POST['borrow_pc_model'],$_POST['borrow_pc_arch'],$_POST['borrow_pc_ram'],$_POST['borrow_pc_hdd'],$_POST['borrow_pc_os'],$_POST['borrow_pc_monitor'],$_POST['borrow_pc_ip'],$_POST['borrow_pc_setup'], $_POST['borrow_pc_barc_asset_id'],$_POST['borrow_pc_amc_id'],$_POST['borrow_pc_use']);
        $ret_id = $getdata->borrowgetAddedRecord($_POST['borrow_pc_location'],$_POST['borrow_pc_purchase'],$_POST['borrow_pc_make'],$_POST['borrow_pc_model'],$_POST['borrow_pc_arch'],$_POST['borrow_pc_ram'],$_POST['borrow_pc_hdd'],$_POST['borrow_pc_os'],$_POST['borrow_pc_monitor'],$_POST['borrow_pc_ip'],$_POST['borrow_pc_setup'],$_POST['borrow_pc_barc_asset_id'],$_POST['borrow_pc_amc_id'],$_POST['borrow_pc_use']);
        //echo $ret_id;
     if ($res && $ret_id){
        $getdata->log_activity('ADD PC [Borrowed]: IP-'.$_POST['borrow_pc_ip'].', PC Make : '.$_POST['borrow_pc_make']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'RV'.'-'.$_POST['borrow_pc_make'].'-'.$ret_id;
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi($filename.'.'.$extension,$ret_id);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
         
            // upload
            echo 1;
        }else{
            echo 0;
        }
}



if(isset($_POST['operation']) && $_POST['operation'] == 'borrow_edit_pc'){

   
    $res = $getdata->edit_borrowp_Pc($_POST['e_borrow_pc_working'],$_POST['eborro_hid_autoID'],$_POST['e_borrow_pc_make'],$_POST['e_borrow_pc_model'],$_POST['e_borrow_pc_arch'],$_POST['e_borrow_pc_ram'],$_POST['e_borrow_pc_hdd'],$_POST['e_borrow_pc_os'],$_POST['e_borrow_pc_monitor'],$_POST['e_borrow_pc_ip'],$_POST['e_borrow_pc_setup'],$_POST['e_borrow_pc_barc_asset_id'],$_POST['e_borrow_pc_amc_id'],$_POST['e_borrow_pc_use'],$_POST['e_borrow_pc_location']);
    //echo $res;
    

    //echo $ret_id;
     if ($res){
        $getdata->log_activity('EDIT PC [Borroed] : ID : '.$_POST['eborro_hid_autoID'].' IP-'.$_POST['e_borrow_pc_ip'].', PC Make : '.$_POST['e_borrow_pc_make']);
        // upload
        if (isset($_FILES['file'])){
            // if file
           
            $filename = 'RV'.'-'.$_POST['e_borrow_pc_make'].'-'.$_POST['eborro_hid_autoID'];
            $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
            // Validate whether selected file is a JPG/PDF file
               
                if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                    if($res1){
                        $upentry = $getdata->updfiledetails_indi($filename.'.'.$extension,$_POST['eborro_hid_autoID']);
                    }
                   
                }else{
                    echo "Invalid file...Please select JPG OR PDF file only";
                }
            // if file
        }
         
        // upload
        echo 1;
    }else{
        echo 0;
    }
}
   




   if(isset($_POST['operation']) && $_POST['operation'] == 'get_make_byid'){
    $res = $getdata->getpcmakebyid($_POST['id']);
    echo $res;
   }



   

    if(isset($_POST['operation']) && $_POST['operation'] == 'get_make_model_form_byid'){
    $res = $getdata->getpcmakemodelformbyid($_POST['id']);
    echo json_encode($res);
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_model_byid'){
    $res = $getdata->getpcmodelbyid($_POST['id']);
    echo $res;
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_form_byid'){
    $res = $getdata->getpcformbyid($_POST['id']);
    echo $res;
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_pcmakemodel'){
    $res = $getdata->getpcmakemodel();
    echo json_encode($res);
   }
   

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_autofilldata'){
    $res = $getdata->getautofilldata($_POST['id']);
    echo json_encode($res);
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'get_autofilldata_printer'){
    $res = $getdata->getautofilldata_printer($_POST['id']);
    echo json_encode($res);
   }
    
   if(isset($_POST['operation']) && $_POST['operation'] == 'delete_pc'){
    $res = $getdata->deletepersonalpc($_POST['forid']);
    if($res){
        $getdata->log_activity('PERSONAL PC DELETED : ID-'.$_POST['forid']);
        echo 1;
    }else{
        echo 0;
    }
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_details'){
    $res = $getdata->getsinglepcdetails($_POST['forid']);
    echo json_encode($res);
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'get_printer_purchase_details'){
    $res = $getdata->getprinterpurchasedetailsbyid($_POST['id']);
    echo json_encode($res);
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_details_printer'){
    $res = $getdata->getsingleprinterdetails($_POST['forid']);
    echo json_encode($res);
   }

   
   if(isset($_POST['operation']) && $_POST['operation'] == 'add_bor_printer'){

    $res = $getdata->addBorPrinter($_POST['bor_device_working'],$_POST['bor_device'],$_POST['bor_device_make'],$_POST['bor_device_model'],$_POST['bor_device_barc_asset_id'],$_POST['bor_device_amc_id'],$_POST['bor_device_use'],$_POST['bor_device_location'],$_POST['bor_device_tone']);
    
    if ($res){

        $getdata->log_activity('ADD Printer [ Borrowed ] : Make-'.$_POST['bor_device_make'].'-'.$_POST['bor_device_model']);
        echo $res;
    }
    else{
        echo 0;
    }
    
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'search_supplier'){
    $res = $getdata->getsuppliersuggesstion($_POST['kw']);
    echo json_encode($res);
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'search_supplier_printer'){
    $res = $getdata->getsuppliersuggesstion_printer($_POST['kw']);
    echo json_encode($res);
   }



