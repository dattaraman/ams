<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
    $output = '';
    $usr = $getdata->getupapproved();
    //print_r($usr);
    $output .= "<table id='example12' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>#</th>
      <th>User</th>
      <th>Section/Group</th>
      <th>Make</th>
      <th>Model</th>
      <th>Configuration</th>
      <th>IP Address</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>PC added on</th>
      <th>[Group-admin] approved on</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";
    $i=1;
    foreach ($usr as $row){
       
       $output .= '<tr>
       <td>'.$i.'</td>';
        if($row['sysadmin_approval']==0){
            $output.='<td class="text-danger">[ '.$row['pc_user_emp'].' ] '.$row['emp_title']. ' '. $row['emp_name'].'</td>';
        }else{
            $output.='<td class="text-success">[ '.$row['pc_user_emp'].' ] '.$row['emp_title']. ' '. $row['emp_name'].'</td>';
        }

        if ($row['pc_source']=='Centralize'){
            
            $mk = $getdata->getpcmakebyid($row['pc_make_model']);
            $md = $getdata->getpcmodelbyid($row['pc_make_model']);
        }else{
            $mk = $row['pc_make'];
            $md = $row['pc_processor_details'];
        }
       
       $output.='<td>'.$row['grp_name'].'</td><td>'.$mk.'</td>
       <td>'.$md.'</td>
       <td>'.$row['os_name'].' / '.$row['pc_ram_value'].' GB [HDD : '.$row['pc_hdd'].', SSD : '.$row['pc_ssd'].']</td>
       <td>'.$row['pc_ip'].'</td>
       <td>'.$row['pc_barc_asset_id'].'</td>
       <td>'.$row['pc_amc_id'].'</td>
       <td>'.date("d/m/Y H:i:s", strtotime($row['pc_added_on'])).'</td>
       <td>'.date("d/m/Y H:i:s", strtotime($row['groupadmin_approvedon'])).'</td>';
       if($row['sysadmin_approval']==0){
        $output.='<td><button class="btn btn-primary btn-sm open_action" data-toggle="modal" data-id="'.$row["autoID"].'" data-target="#modal_action" title="Action"><span class="fas fa-check"></span></button></td>';
    }else{
        $output.='<td> Approved on '.date("d/m/Y H:i:s", strtotime($row['sysadmin_approvedon'])).'</td>';
    }
       
    $output.=' </tr>';
       $i++;
    }
    $output .= '<tbody></table>';
    echo $output;
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'alllistdevice'){
    $output = '';
    $usr = $getdata->getupapproveddevice();
    //print_r($usr);
    $output .= "<table id='example12' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>#</th>
      <th>User</th>
      <th>Device</th>
      <th>Make/Model</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>Device added on</th>
      <th>[Group-admin] approved on</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";
    $i=1;
    foreach ($usr as $row){
       
       $output .= '<tr>
       <td>'.$i.'</td>';
        if($row['sysadmin_approval']==0){
            $output.='<td class="text-danger">[ '.$row['device_user_emp'].' ] '.$row['emp_title']. ' '. $row['emp_name'].'</td>';
        }else{
            $output.='<td class="text-success">[ '.$row['device_user_emp'].' ] '.$row['emp_title']. ' '. $row['emp_name'].'</td>';
        }
      
        if ($row['device_source']=='Centralize'){
            $md = $getdata->getdevicemodelbyid($row['device_make_model']);
            $mk = $getdata->getdevicemakebymakemodel($row['device_make_model']);
        }else{
            $md = $row['device_model'];
        }
       
           
       
       $output.='
       <td>'.$row['device'].'</td>
       <td>'.$row['device_make'].'/'.$md.'</td>
       <td>'.$row['device_barc_asset_id'].'</td>
       <td>'.$row['device_amc_id'].'</td>
       <td>'.date("d/m/Y H:i:s", strtotime($row['device_added_on'])).'</td>
       <td>'.date("d/m/Y H:i:s", strtotime($row['groupadmin_approvedon'])).'</td>';
       if($row['sysadmin_approval']==0){
        $output.='<td><button class="btn btn-primary btn-sm open_action" data-toggle="modal" data-id="'.$row["autoID"].'" data-target="#modal_action" title="Action"><span class="fas fa-check"></span></button></td>';
    }else{
        $output.='<td> Approved on '.date("d/m/Y H:i:s", strtotime($row['sysadmin_approvedon'])).'</td>';
    }
       
    $output.=' </tr>';
       $i++;
    }
    $output .= '<tbody></table>';
    echo $output;
   }




   

   if(isset($_POST['operation']) && $_POST['operation'] == 'approve_pc'){
    $res = $getdata->adminapprovepc($_POST['forid']);
    if($res){
        $getdata->log_activity('[SYSTEM-ADMIN] PC Approved : ID-'.$_POST['forid']);
        echo 1;
    }else{
        echo 0;
    }
   }