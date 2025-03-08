<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_asset'){
    $output = '';
    $usr = $getdata->getallempdetails();
    //print_r($usr);
    $output .= "<table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th width='61%'>Employee details</th>
      <th>Assets</th>
    </tr>
    </thead><tbody>";
    $i=1;
    $unitheadmark="";
    foreach ($usr as $row){

       if($row['grp_head']==$row['autoID']){
        $unitheadmark=" <small><span class='badge badge-danger'>Group approver</span></small>";
       }else{
        $unitheadmark=""; 
       }
       
       
       $output.='<tr><td><img class="img-circle img-size-32 mr-2" src="images/emp/'.$row['emp_no'].'.jpg" alt="'.$row["emp_title"].' '.$row["emp_name"].'">'.$row["emp_title"].' '.$row['emp_name'].' <small><span class="badge badge-primary">'.$row['emp_desig'].'</span> <span class="badge badge-primary">'.$row['grp_name'].'</span></small>'.$unitheadmark.'</td><td>';
       $empasset = $getdata->getinusedevicecount($row['emp_no']);
       $empasset_printer = $getdata->getinusedevicecount_printer($row['emp_no']);
       if(!$empasset){
        $output.='<button class="btn btn-secondary btn-sm" data-toggle="tooltip" title="No PC/Laptop found">No PC/Laptop found
       </button> ';
       }else{
        $btncolor = "";
        foreach ($empasset as $userasset){
         
           if($userasset['pc_form']=='desktop'){$btncolor='info';}else{$btncolor='warning';}
           $output.='<button class="btn btn-'.$btncolor.' btn-sm" data-toggle="tooltip" title="'.strtoupper($userasset['pc_form']).'">'.strtoupper($userasset['pc_form']).'
         <i class="fas fa-'.$userasset['pc_form'].'"></i> '.$userasset['cnt'].'
       </button> ';
         
         
        }  

        foreach ($empasset_printer as $userasset_p){
         
          if($userasset_p['device']=='Printer'){$btncolor='info';}else{$btncolor='warning';}
          $output.='<button class="btn btn-'.$btncolor.' btn-sm" data-toggle="tooltip" title="'.strtoupper($userasset_p['device']).'">'.strtoupper($userasset_p['device']).'
        <i class="fas fa-print"></i> '.$userasset_p['cnt'].'
      </button> ';
        
        
       }  

       

       }  
        
       $output.='</td></tr>';
       $i++;
    }
       
    
    $output .= '</tbody></table>';
    echo $output;
   }
     


   if(isset($_POST['operation']) && $_POST['operation'] == 'get_all_group_asset'){
    $output = '';
    $usr = $getdata->getallgroupheaddetails();
    //print_r($usr);
    $output .= "<form name='getgroupasset' id='getgroupasset' method='POST' action='device_list_group.php' class='d-none'><input type='text' name='grpid' id='grpid'><input type='submit' name='btn_submit_get' id='btn_submit_get' value='Sub'></form><table id='example2' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th width='61%'>Section/Group</th>
      <th>Assets</th>
    </tr>
    </thead><tbody>";
    $i=1;
    $unitheadmark="";
    foreach ($usr as $row){

       if($row['grp_head']==$row['autoID']){
        $unitheadmark=" <small><span class='badge badge-danger'>Group approver</span></small>";
       }else{
        $unitheadmark=""; 
       }
       
       $totalempingroup = $getdata->getnoofemp_unit($row['emp_grp_autoID']);
       $output.='<tr data-grpid="'.$row['emp_grp_autoID'].'" class="get_group_asset_details"><td class="align-middle"><button class="btn btn-primary btn-sm"><span class="fas fa-users"></span> '.$totalempingroup.'</button> &nbsp;<span>'.$row['grp_name'].'</span>&nbsp;<small><span class="badge badge-primary">'.$row['emp_title'].' '.$row['emp_name'].'</span></small></td><td>';
       $empasset = $getdata->getinusepccount_group($row['emp_grp_autoID']);
       $empasset_printer = $getdata->getinusedevicecount_printer_group($row['emp_grp_autoID']);
      
       if(!$empasset){
        $output.='<button class="btn btn-secondary btn-sm" data-toggle="tooltip" title="No PC/Laptop found">No PC/Laptop found
       </button> ';
       }else{
        $btncolor = "";
        foreach ($empasset as $userasset){
         
           if($userasset['pc_form']=='desktop'){$btncolor='info';}else{$btncolor='warning';}
           $output.='<button type="button" class="btn btn-'.$btncolor.' btn-sm m-1" data-toggle="tooltip" title="'.strtoupper($userasset['pc_form']).'">'.strtoupper($userasset['pc_form']).'
         <i class="fas fa-'.$userasset['pc_form'].'"></i> '.$userasset['cnt'].'
       </button> ';
         
         
        }  

        foreach ($empasset_printer as $userasset_p){
         
          if($userasset_p['device']=='Printer'){$btncolor='info';}else{$btncolor='warning';}
          $output.='<button class="btn btn-'.$btncolor.' btn-sm m-1" data-toggle="tooltip" title="'.strtoupper($userasset_p['device']).'">'.strtoupper($userasset_p['device']).'
        <i class="fas fa-print"></i> '.$userasset_p['cnt'].'
      </button> ';
        
        
       }  

       

       }  
        
       $output.='</td></tr>';
       $i++;
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

       if(isset($_POST['operation']) && $_POST['operation'] == 'get_printer_purchase_data'){

        $res = $getdata->get_printer_purchase_graph();
        echo json_encode($res);
        
       }