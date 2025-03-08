<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();

    if(isset($_POST['operation']) && $_POST['operation'] == 'add_purchase'){

        $res = $getdata->addPcPurchaseDetail($_POST['pc_ssd'],$_POST['pc_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['pc_make'],$_POST['pc_model'],$_POST['pc_ram'],$_POST['pc_hdd'],$_POST['pc_os'],$_POST['pc_monitor'],$_POST['pc_cost'],$_POST['pc_warranty'],$_POST['pc_warrabty_uptodate'],$_POST['po_no'],$_POST['po_dt'],$_POST['loggedinbyemp'],$_POST['pc_form']);
        $ret_id = $getdata->getAddedRecord($_POST['pc_ssd'],$_POST['pc_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['pc_make'],$_POST['pc_model'],$_POST['pc_ram'],$_POST['pc_hdd'],$_POST['pc_os'],$_POST['pc_monitor'],$_POST['pc_cost'],$_POST['pc_warranty'],$_POST['pc_warrabty_uptodate'],$_POST['po_no'],$_POST['po_dt'],$_POST['loggedinbyemp'],$_POST['pc_form']);
        if ($res && $ret_id){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PURCHASE DETAILS ADDED : INDENT No.-'.$_POST['indent_no']);
                $filename = 'RV'.'-'.$_POST['pc_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetails($filename.'.'.$extension,$ret_id);
                        }
                       
                    }else{
                        echo "Invalid file...Please select JPG OR PDF file only";
                    }
                // if file
            }
             
                // upload
            echo 1;
        }
        else{
            echo 0;
        }
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'edit_purchase'){

        $res = $getdata->editPcPurchaseDetail($_POST['e_pc_ssd'],$_POST['e_pc_supplier'],$_POST['e_indent_no'],$_POST['e_indent_dt'],$_POST['e_indent_by'],$_POST['e_rv_no'],$_POST['e_rv_dt'],$_POST['e_rv_qty'],$_POST['e_pc_make'],$_POST['e_pc_model'],$_POST['e_pc_ram'],$_POST['e_pc_hdd'],$_POST['e_pc_os'],$_POST['e_pc_monitor'],$_POST['e_pc_cost'],$_POST['e_pc_warranty'],$_POST['e_pc_warrabty_uptodate'],$_POST['e_po_no'],$_POST['e_po_dt'],$_POST['e_loggedinbyemp'],$_POST['e_recordid'],$_POST['e_pc_form']);
        $ret_id = $_POST['e_recordid'];
        if ($res){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PURCHASE DETAILS EDITED : INDENT No.-'.$_POST['e_indent_no']);
                $filename = 'RV'.'-'.$_POST['e_pc_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetails($filename.'.'.$extension,$ret_id);
                        }
                       
                    }else{
                        echo "Invalid file...Please select JPG OR PDF file only";
                    }
                // if file
            }
             
                // upload
            echo $res;
        }
        else{
            echo $res;
        }
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
        $output = '';
        $usr = $getdata->getallinformation_pc();
        //print_r($usr);
        $output .= "<table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Make/Model</th>
          <th>Configuration</th>
          <th>Asset/AMC Details</th>
          <th>Location</th>
          <th>IP Address</th>
          <th>Approval status</th>
        </tr>
        </thead><tbody>";
        $i=1;
        foreach ($usr as $row){
           if($row['pc_source']=='Centralize'){
                $mk = $getdata->getpcmakebyid($row['pc_make_model']);
                $md = $getdata->getpcmodelbyid($row['pc_make_model']);
                $ram1 = $getdata->getallbymakebyid($row['pc_make_model']);
                
                $form = $ram1['pc_form'];
            }else{
                $mk = $row["pc_make"]; 
                $md = $row["pc_processor_details"];
               
                $form = $row['pc_form'];
            }
            if($row['groupadmin_approval']=='1'){
                $grpadm='<span class="badge badge-primary">Group Admin <br>Approved on '.date("d/m/Y H:i:s", strtotime($row['groupadmin_approvedon'])).'</span>';
            }else{
                $grpadm='<span class="badge badge-danger">Group Admin - Pending</span>';
            }
            if($row['sysadmin_approval']=='1'){
                $sysadm='<span class="badge badge-success">Sys Admin <br>Approved on '.date("d/m/Y H:i:s", strtotime($row['sysadmin_approvedon'])).'</span>';
            }else{
                $sysadm='<span class="badge badge-danger">Sys Admin - Pending</span>';
            }
            if($row['working']==1){
                $working = '';
            }else{
                $working = '<span class="fas fa-exclamation-circle text-danger"></span> <small class="text-danger">Not working</small>';
            }
            
             if($row['pc_form']=='laptop'){$pcform ='briefcase';}else{$pcform ='desktop';}
           $output .= '<tr>
           <td>'.$i.'</td>
           <td>'.$row['emp_title'].' '.$row['emp_name'].' <small class="text-primary"> ('.$row['emp_desig'].' / ' .$row['grp_name'].' )</small></td>
           
           <td><span data-toggle="tooltip" title="'.$form.'" class="fas fa-'.$pcform.'"></span> '.$mk.' - '.$md. ' <br>'.$working.'</td>
           <td><span class="text-uppercase">'.$form.'- </span> '.$row['pc_ram_value'].' GB, [HDD] :  '.$row['pc_hdd'].' GB [SSD] : '.$row['pc_ssd'].' GB</td>
           <td><span class="badge badge-primary">'.$row['pc_barc_asset_id'].'</span> / <span class="badge badge-secondary">'.$row['pc_amc_id'].'</span></td>
           <td>'.$row['pc_location'].'</td>
           <td>'.$row['pc_ip'].'</td>
           <td>'.$grpadm.'<br>'.$sysadm.'</td>
           
           </tr>';
           $i++;
        }
        $output .= '</tbody></table>';
        echo $output;

       }


       if(isset($_POST['operation']) && $_POST['operation'] == 'alllist_device'){
        $output = '';
        $usr = $getdata->getallinformation_device();
        //print_r($usr);
        $output .= "<table id='example1_device' class='table table-bordered table-striped w-100'>
        <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Device</th>
          <th>Make/Model</th>
          <th>Asset/AMC Details</th>
          <th>Location</th>
          <th>Approval status</th>
        </tr>
        </thead><tbody>";
        $i=1;
        foreach ($usr as $row){
           if($row['device_source']=='Centralize'){
                $mk1 = $getdata->getdevicedetailsbymakemodel($row['device_make_model']);
                
                $fullmake = $getdata->getdevicemakebymakemodel($mk1['device_make']);
                $md = $mk1['device_model'];
                $dev = $mk1['device'];
            }else{
                $fullmake = $getdata->getdevicemakebymakemodel($row['device_make']);
                $mk = $row["device_make"]; 
                $md = $row["device_model"];
                $dev = $row['device'];
            }
            if($row['groupadmin_approval']=='1'){
                $grpadm='<span class="badge badge-primary">Group Admin <br>Approved on '.date("d/m/Y H:i:s", strtotime($row['groupadmin_approvedon'])).'</span>';
            }else{
                $grpadm='<span class="badge badge-danger">Group Admin - Pending</span>';
            }
            if($row['sysadmin_approval']=='1'){
                $sysadm='<span class="badge badge-success">Sys Admin <br>Approved on '.date("d/m/Y H:i:s", strtotime($row['sysadmin_approvedon'])).'</span>';
            }else{
                $sysadm='<span class="badge badge-danger">Sys Admin - Pending</span>';
            }
            if($row['working']==1){
                $working = '';
            }else{
                $working = '<span class="fas fa-exclamation-circle text-danger"></span> <small class="text-danger">Not working</small>';
            }
            
            
           $output .= '<tr>
           <td>'.$i.'</td>
           <td>'.$row['emp_title'].' '.$row['emp_name'].' <small class="text-primary"> ('.$row['emp_desig'].' / ' .$row['grp_name'].' )</small></td>
           <td>'.$dev.'</td>
           <td>'.$fullmake.' - '.$md. ' <br>'.$working.'</td>
           
           <td><span class="badge badge-primary">'.$row['device_barc_asset_id'].'</span> / <span class="badge badge-secondary">'.$row['device_amc_id'].'</span></td>
           <td>'.$row['device_location'].'</td>
           <td>'.$grpadm.'<br>'.$sysadm.'</td>
           
           </tr>';
           $i++;
        }
        $output .= '</tbody></table>';
        echo $output;

       }



       if(isset($_POST['operation']) && $_POST['operation'] == 'single_detail'){
        $res = $getdata->get_purchase_detail($_POST['forid']);
        echo json_encode($res);
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'single_detail_asjson'){
        $res = $getdata->getsinglepcdetails_asjson($_POST['id']);
        echo json_encode($res);
       }




       if(isset($_POST['operation']) && $_POST['operation'] == 'delete_record'){
        $res = $getdata->deletepurchasedetail($_POST['forid']);
        if($res){
            $getdata->log_activity('PURCHASE DETAILS DELETED : ID-'.$_POST['forid']);
            echo 1;
        }else{
            echo 0;
        }
       }

       
    