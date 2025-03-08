<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
    $output = '';
    $usr = $getdata->getgrouppc();
    //print_r($usr);
    foreach ($usr as $row){
        $grp_status = 0;
        if ($row["groupadmin_approval"]==0){
            $grp_status = '<div class="ribbon bg-danger">
            Pending
        </div>';
        $btn_status = '';
        }else{
            $grp_status = '<div class="ribbon bg-success">
            Approved
        </div>';
        $btn_status = 'disabled';
        }
        
        if($row['working']==1){
            $working_text = '';
        }else{
            $working_text = '
            <li class="nav-item listitem">
            <span class="nav-link text-left"> 
                <span class="fas fa-exclamation-circle text-danger"> Not in working condition</span>
            </span>
        </li>
            ';
        }
        $output .='
               
        <div class="col-md-4">
        <div class="card card-widget widget-user-2">
        <div class="widget-user-header bg-dark">
                <div class="widget-user-image">
                  <img class="rounded" src="images/emp/'.$row['emp_no'].'.jpg" alt="'.$row["emp_title"].' '.$row["emp_name"].'">
                </div>
                <div class="ribbon-wrapper ribbon-lg">'.
                $grp_status
                .'</div>
                <h3 class="widget-user-username text-sm w-50">[ '.$row["emp_no"].' ] '. $row["emp_title"].' '.$row["emp_name"].'<span class="float-right"></span>
                    <br>'.$row["emp_desig"].'
                </h3>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column text-primary">'.$working_text.'

                <li class="nav-item listitem">
                        <span class="nav-link text-center">
                        <span class="fas fa-laptop"></span> <span class="text-uppercase">'.$row["pc_form"].'</span>
                       
                        </span>
                    </li>


                <li class="nav-item listitem">
                <span class="nav-link">
                <span class="fas fa-desktop"></span> '.$row["pc_make"].'
                <span class="fas fa-dice-five mr-1 float-right"> '.$row["pc_processor_details"].'</span>
                </span>
            </li>

           

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
                        <span class="fas fa-shopping-cart"></span> '.$row["pc_source"].'
                       
                        </span>
                    </li>

                    <li class="nav-item listitem text-right">
                        <span class="nav-link">';
                            if($row["rvfileuploaded"] == 1){
                                $output .='<a href = "uploads/rvcopy/'.$row['rvfilename'].'" target="_blank"><button class="btn btn-sm btn-warning"> <span class="fas fa-file-download"></span> Download RV</button></a>';    
                            }
                            $output.=' <button class="btn btn-sm btn-primary  view_details" data-id="'.$row["autoID"].'"> <span class="fas fa-info-circle"></span> Details</button>
                            <button class="btn btn-sm btn-success btn_approve" '.$btn_status .' data-id = '.$row["autoID"].'> <span class="fas fa-check"></span> Approve</button>
                           
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



   if(isset($_POST['operation']) && $_POST['operation'] == 'alllistdevice'){
    $mk ='';
    $md ='';
    $output = '';
    $usr = $getdata->getgroupdevice();
    //print_r($usr);
    foreach ($usr as $row){
        $grp_status = 0;
        if ($row["groupadmin_approval"]==0){
            $grp_status = '<div class="ribbon bg-danger">
            Pending
        </div>';
        $btn_status = '';
        }else{
            $grp_status = '<div class="ribbon bg-success">
            Approved
        </div>';
        $btn_status = 'disabled';
        }
        if($row['device_source']=='Centralize'){
            $purchase_det = $getdata->get_devicepurchase_makemodel($row['device_make_model']);
            $mk = $purchase_det['mk'];
            $md = $purchase_det['device_model'];
            $dv = $purchase_det['device'];
        }else{
            $mk = $row["device_make"];
            $md = $row["device_model"];
            $dv = $row['device'];
        }

        if($row['working']==1){
            $working_text = '';
        }else{
            $working_text = '
            <li class="nav-item listitem">
            <span class="nav-link text-left"> 
                <span class="fas fa-exclamation-circle text-danger"> Not in working condition</span>
            </span>
        </li>
            ';
        }


        $output .='
               
        <div class="col-md-4">
        <div class="card card-widget widget-user-2">
        <div class="widget-user-header bg-dark">


        <div class="widget-user-image">
                  <img class="rounded" src="images/emp/'.$row['emp_no'].'.jpg" alt="'.$row["emp_title"].' '.$row["emp_name"].'">
                </div>


                
                <div class="ribbon-wrapper ribbon-lg">'.
                $grp_status.'
                </div>


                <h3 class="widget-user-username text-sm w-50">[ '.$row["emp_no"].' ] '. $row["emp_title"].' '.$row["emp_name"].'<span class="float-right"></span>
                    <br>'.$row["emp_desig"].'
                </h3>
                
               
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column text-primary">'.$working_text.'


                <li class="nav-item listitem">
                <span class="nav-link text-center">
                <span class="fas fa-print"></span> <span class="text-uppercase">'.$dv.'</span>
               
                </span>
            </li>



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
                        <span class="nav-link">';
                            if($row["rvfileuploaded"] == 1){
                                $output .='<a href = "uploads/rvcopy/'.$row['rvfilename'].'" target="_blank"><button class="btn btn-sm btn-warning"> <span class="fas fa-file-download"></span> Download RV</button></a>';    
                            }
                            $output.=' <button class="btn btn-sm btn-primary view_details_device" data-id="'.$row["autoID"].'"> <span class="fas fa-info-circle"></span> Details</button>
                            <button class="btn btn-sm btn-success btn_approve_device" '.$btn_status .' data-id = '.$row["autoID"].'> <span class="fas fa-check"></span> Approve</button>
                           
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


   

   if(isset($_POST['operation']) && $_POST['operation'] == 'add_pc'){

    $res = $getdata->addPc($_POST['pc_make'],$_POST['pc_os'],$_POST['pc_arch'],$_POST['pc_ram'],$_POST['pc_ip'],$_POST['pc_setup'],$_POST['pc_barc_asset_id'],$_POST['pc_amc_id']);
    
    if ($res){

        $getdata->log_activity('ADD PC : IP-'.$_POST['pc_ip']);
        echo 1;
    }
    else{
        echo 0;
    }
    
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'group_mark_approve'){

    $res = $getdata->groupadminapproval($_POST['id']);
    
    if ($res){

        $getdata->log_activity('[GROUP-ADMIN] PC Approved : ID-'.$_POST['id']);
        echo 1;
    }
    else{
        echo 0;
    }
    
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'group_mark_approvedevice'){

    $res = $getdata->groupadminapprovaldevice($_POST['id']);
    
    if ($res){

        $getdata->log_activity('[GROUP-ADMIN] PRINTER/SCANNER Approved : ID-'.$_POST['id']);
        echo 1;
    }
    else{
        echo 0;
    }
    
   }

   

   if(isset($_POST['operation']) && $_POST['operation'] == 'single_company'){

    $res = $getdata->get_sel_company($_POST['uid']);
    echo json_encode($res);
    
    
    
   }
   if(isset($_POST['operation']) && $_POST['operation'] == 'edit_company'){

    $res = $getdata->editCompany($_POST['e_company_name'],$_POST['e_company_address'],$_POST['e_company_contact_person'],$_POST['e_company_contact1'],$_POST['e_company_contact2'],$_POST['e_company_email'],$_POST['hid_autoID']);
    
    if ($res){

        $getdata->log_activity("Edit Company" ."-" .$_POST['e_company_name']);
        echo 1;
    }
    else{
        echo 0;
    }
    
    
   }