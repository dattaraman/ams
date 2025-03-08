<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_inventory_desktop'){
    $output = '';
    $inv = $getdata->getallinventory_desktop();
    //print_r($usr);
    $output .= "<table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>Prev. user</th>
      <th>PC Make</th>
      <th>PC Config.</th>
      <th>OS</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";

    $unitheadmark="";
    foreach ($inv as $row){

      $emp_det = $getdata->get_emp_by_empno($row['pc_user_emp']);

       $output.='<tr><td><img class="img-circle img-size-32 mr-2" src="http://bts.barc.gov.in/Auth_Info/Photo/'.$emp_det['emp_no'].'.jpg" alt="'.$emp_det["emp_title"].' '.$emp_det["emp_name"].'">'.$emp_det["emp_title"].' '.$emp_det['emp_name'].' <small><span class="badge badge-primary">'.$emp_det['emp_desig'].'</span> <span class="badge badge-primary">'.$emp_det['grp_name'].'</span></small></td><td>'.$row['pc_make']. '<small><span class="badge badge-primary">'.$row['pc_source'].'</span></small></td><td>'.$row['pc_model'].'[RAM : '.$row['pc_ram_value'].' GB / HDD : '.$row['pc_hdd'].']</td><td>'.$row['os_name'].'</td><td>'.$row['pc_barc_asset_id'].'</td><td>'.$row['pc_amc_id'].'</td>';
       $output.='<td>
       <button class="btn btn-primary btn-sm view_log mr-2 mt-2" data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_view_log" title="View log"><span class="fas fa-history"></span> Get Log</button>            
        <button class="btn btn-warning btn-sm edit_details mr-2 mt-2" data-id = "'.$row['autoID'].'" title="Edit details"><span class="fas fa-edit"></span> Update configuration</button>            
        <button class="btn btn-danger btn-sm update_status mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_reassign" title="Re-assign to other user"><span class="fas fa-user"></span> Re-assign this pc</button>
        <button class="btn btn-secondary btn-sm update_status_noassign mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_status" title="Update status"><span class="fas fa-star"></span> Update status</button>
       </td>';
       $output.='</tr>';
    }
       
    
    $output .= '</tbody></table>';
    echo $output;
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_other_inventory_desktop'){
    $output = '';
    $inv = $getdata->getallinventory_other_desktop();
    //print_r($usr);
    $output .= "<table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>Prev. user</th>
      <th>PC Make</th>
      <th>PC Config.</th>
      <th>OS</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";

    $unitheadmark="";
    foreach ($inv as $row){

      $emp_det = $getdata->get_emp_by_empno($row['pc_user_emp']);

       $output.='<tr><td><img class="img-circle img-size-32 mr-2" src="http://bts.barc.gov.in/Auth_Info/Photo/'.$emp_det['emp_no'].'.jpg" alt="'.$emp_det["emp_title"].' '.$emp_det["emp_name"].'">'.$emp_det["emp_title"].' '.$emp_det['emp_name'].' <small><span class="badge badge-primary">'.$emp_det['emp_desig'].'</span> <span class="badge badge-primary">'.$emp_det['grp_name'].'</span></small></td><td>'.$row['pc_make']. '<small><span class="badge badge-primary">'.$row['pc_source'].'</span></small></td><td>'.$row['pc_model'].'[RAM : '.$row['pc_ram_value'].' GB / HDD : '.$row['pc_hdd'].']</td><td>'.$row['os_name'].'</td><td>'.$row['pc_barc_asset_id'].'</td><td>'.$row['pc_amc_id'].'</td>';
       $output.='<td>
       <button class="btn btn-primary btn-sm view_log mr-2 mt-2" data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_view_log" title="View log"><span class="fas fa-history"></span> Get Log</button>            
        <button class="btn btn-warning btn-sm edit_details mr-2 mt-2" data-id = "'.$row['autoID'].'" title="Edit details"><span class="fas fa-edit"></span> Update configuration</button>            
        <button class="btn btn-danger btn-sm update_status mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_reassign" title="Re-assign to other user"><span class="fas fa-user"></span> Re-assign this pc</button>
        <button class="btn btn-secondary btn-sm update_status_noassign mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_status" title="Update status"><span class="fas fa-star"></span> Update status</button>
       </td>';
       $output.='</tr>';
    }
       
    
    $output .= '</tbody></table>';
    echo $output;
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_inventory_laptop'){
    $output = '';
    $inv = $getdata->getallinventory_laptop();
    //print_r($usr);
    $output .= "<table id='example13' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>Laptop Make</th>
      <th>Laptop Model</th>
      <th>OS</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";

    $unitheadmark="";
    foreach ($inv as $row){

       $output.='<tr><td>'.$row['pc_make']. '<small><span class="badge badge-primary">'.$row['pc_source'].'</span></small></td><td>'.$row['pc_model'].'</td><td>'.$row['os_name'].'</td><td>'.$row['pc_barc_asset_id'].'</td><td>'.$row['pc_amc_id'].'</td>';
       $output.='<td>
       <button class="btn btn-primary btn-sm view_log mr-2 mt-2" data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_view_log" title="View log"><span class="fas fa-history"></span> Get Log</button>            
        <button class="btn btn-warning btn-sm edit_details mr-2 mt-2" data-id = "'.$row['autoID'].'" title="Edit details"><span class="fas fa-edit"></span> Update configuration</button>            
        <button class="btn btn-danger btn-sm update_status_noassign mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_update_status" title="Update status"><span class="fas fa-clipboard-check"></span> Update status</button>
       </td>';
       $output.='</tr>';
    }
       
    
    $output .= '</tbody></table>';
    echo $output;
   }


   if(isset($_POST['operation']) && $_POST['operation'] == 'get_desktop_log'){
    $output = '';
    $inv = $getdata->getallinventory_desktoplog($_POST['id']);
    //print_r($usr);
    $output .= "<table id='example12' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>Action</th>
      <th>Log</th>
      <th>Previous user</th>
      <th>Current user</th>
      <th>Remarks</th>
      <th>Transacted on</th>
    </tr>
    </thead><tbody>";

    foreach ($inv as $row){
       $output.='<tr><td>'.$row['action'].'</td><td>'.$row['pc_remark'].'</td><td>'.$row['pc_from'].'</td><td>'.$row['pc_to'].'</td><td>'.$row['admin_remark'].'</td><td>'.$row['transactiondatetime'].'</td></tr>';
    }
    $output .= '</tbody></table>';
    echo $output;
   }
     



    if(isset($_POST['operation']) && $_POST['operation'] == 'get_desktop_data'){

        $res = $getdata->get_desktop_graph();
        echo json_encode($res);
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'get_laptop_data'){

        $res = $getdata->get_laptop_graph();
        echo json_encode($res);
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'get_printer_data'){

        $res = $getdata->get_printer_graph();
        echo json_encode($res);
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'get_purchase_data'){

        $res = $getdata->get_purchase_graph();
        echo json_encode($res);
        
       }

      
   if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_emps'){

    $res = $getdata->getallemp_for_reassign();
    echo json_encode($res);
   }

   if(isset($_POST['operation']) && $_POST['operation'] == 'reassign_pc'){

    $res = $getdata->re_assignpc($_POST['autoID_assign'],$_POST['sel_emp']);
    //echo $res;
    if ($res){

        $getdata->log_activity('PC RE-ASSIGNED FROM INVENTORY : PC AutoID : '.$_POST['autoID_assign'].' To : '.$_POST['sel_emp']);
        $getdata->add_pctransactionhistory($_POST['autoID_assign'],'RE-ASSIGNED TO OTHER',0,$_POST['sel_emp'],'',$_POST['rem_re_assign'],'');
        echo 1;
    }
    else{
        echo 0;
    }
  }
    

    if(isset($_POST['operation']) && $_POST['operation'] == 'change_status_pc'){

      $res = $getdata->updatestatuspc($_POST['autoID_status'],$_POST['sel_status'],$_POST['status_remark']);
      //echo $res;
      if ($res){
  
          $getdata->log_activity('PC STATUS UPDATED FROM INVENTORY : PC AutoID : '.$_POST['autoID_status'].' STATUS : '.$_POST['sel_status']);
          $getdata->add_pctransactionhistory($_POST['autoID_status'],'STATUS UPDATED',0,0,'',$_POST['status_remark'],'');
          echo 1;
      }
      else{
          echo 0;
      }
   }