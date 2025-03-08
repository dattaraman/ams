<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
    $output = '';
    $usr = $getdata->getalluserpcs($_SESSION['loggedinby']);
    //print_r($usr);
    $output .= "<table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>#</th>
      <th>Make</th>
      <th>Model</th>
      <th>Configuration</th>
      <th>IP Address</th>
      <th>BARC Asset ID</th>
      <th>AMC ID</th>
      <th>Action</th>
    </tr>
    </thead><tbody>";
    $i=1;
    foreach ($usr as $row){
       
       $output .= '<tr>
       <td>'.$i.'</td>
       <td><span class="badge badge-danger">Hello</span>'.$row['pc_make'].'</td>
       <td>'.$row['pc_model'].'</td>
       <td>'.$row['pc_os'].' / '.$row['pc_ram_value'].' GB </td>
       <td>'.$row['pc_ip'].'</td>
       <td>'.$row['pc_barc_asset_id'].'</td>
       <td>'.$row['pc_amc_id'].'</td>
       <td><button class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></button></td>
       </tr>';
       $i++;
    }
    $output .= '<tbody></table>';
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