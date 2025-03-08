<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    $allunits = $getdata->getallunits();
    $output="";
    
    if(isset($_POST['operation']) && $_POST['operation']=='alllist'){
      foreach ($allunits as $units)
      {
          $output .='
          <div class="col-md-4 card card-widget widget-user-2" style="max-height:500px; overflow-y:auto">
          <div class="card card-widget widget-user-2">
          <div class="widget-user-header bg-dark">
            <div class="row">
              <div class="col-lg-1">
                  <span class="fas fa-users"></span>
              </div>
              <div class="col-lg-10 text-center">';
              $noofemployees = $getdata->getnoofemp_unit($units["autoID"]);
              $unithead = $getdata->getunit_head($units["autoID"]);
              $output .='<b class="text-sm">'. $units["grp_name"]. ' ('. $noofemployees .')</b>
              </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-3"><img class="rounded w-100" src="images/emp/'.$unithead['emp_no'].'.jpg" alt="'.$unithead["emp_title"].' '.$unithead["emp_name"].'"></div>
              <div class="col-lg-9"><div class="row"><div class="col-lg-10">';
                  

                  $output.= '<a class="text-white" href="#" target="_blank">'.$unithead["emp_title"] . ' '. $unithead["emp_name"].'</a><br><span class="fas fa-award"></span> <span class="small">'.$unithead["emp_desig"].'</span>';
                  $output.='<br><span class="text-sm"><span class="fas fa-id-card"></span> '.$unithead["emp_no"].'</span></span>';
                  if($unithead["emp_o_email"]!="")
                  $output.='<br><span class="text-sm"><span class="fas fa-envelope"></span> <a class="text-decoration-none text-white" href="mailto:'.$unithead["emp_o_email"].'">'.$unithead["emp_o_email"].'</a></span></span>';
                  if($unithead["emp_extn"]!="")
                  $output.='<br><span class="text-sm"><span class="fas fa-phone-alt"></span> '.$unithead["emp_extn"].'</span></span>';


              $output .='</div>
              <div class="col-lg-2"><button class="btn btn-outline-danger btn-sm getdetails" data-userid= "'.$unithead['autoID'].'" data-id="'.$unithead['emp_no'].'" data-target="#modalManage" data-toggle="modal"><span class="fas fa-cog"></span></button></div>  
              </div></div>
            </div>
          </div>
                <div class="card-footer p-0">
                  <ul class="nav flex-column">';
          $allusers = $getdata->userbyunit($units['autoID']);
          foreach ($allusers as $user){
            $output .='
                    <li class="nav-item listitem">
                      <div class="row">
                        <div class="col-lg-2"><div class="widget-user-image"><img class="rounded mb-2" src="images/emp/'.$user['emp_no'].'.jpg" alt="'.$user["emp_title"].' '.$user["emp_name"].'"></div></div>
                        <div class="col-lg-9 ml-3">
                          <div class="row">
                            <div class="col-lg-10 text-primary"><a href="#" target="_blank">'.$user['emp_title'].' '.$user['emp_name'].'</a></div>
                            <div class="col-lg-2 p-1"><button class="btn btn-outline-danger btn-sm getdetails" data-userid= "'.$user['autoID'].'" data-id="'.$user['emp_no'].'" data-target="#modalManage" data-toggle="modal"><span class="fas fa-cog"></span></button></div>  
                          </div>
                          <div class="row">
                            <div class="col-lg-12 text-muted"><small>'.$user['emp_desig'].'</small></div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 text-muted"><span class="fas fa-id-card"></span> <small>'.$user['emp_no'].'</small></div>';
                            if($user["emp_extn"]!=""){
                            $output .= '<div class="col-lg-6 text-muted"><span class="fas fa-phone-alt"></span> <small>'.$user['emp_extn'].'</small></div>
                          </div><br>';}
                            $output .='</div>
                      </div>';
                      if($user["emp_o_email"]!=""){
                        $output .= '<div class="row text-sm"><div class="col-lg-7 text-muted"><span class="fas fa-envelope"></span> <a class="text-decoration-none" href="mailto:'.$user['emp_o_email'].'" target="_blank">'.$user['emp_o_email'].'</a></div>';}
                        if($user["emp_shift_autoID"]!=""){
                          $output .= '<div class="col-lg-5 text-muted text-sm"><span class="fas fa-clock"></span> '.$user['shift_name'].'</div></div>';}
                        $output .='</li>';
        }
        $output .= '</ul></div></div></div>';
        }
        echo $output;
}

if(isset($_POST['operation']) && $_POST['operation']=='get_all_details'){
  $res = $getdata->getalldetails($_POST['forid']);
    echo json_encode($res);
}

if(isset($_POST['operation']) && $_POST['operation']=='get_all_devices_details'){
  $res = $getdata->getalldevicedetails($_POST['forid']);
    echo json_encode($res);
}

if(isset($_POST['operation']) && $_POST['operation']=='get_all_devices_details_printer'){
  $res = $getdata->getalluserprinters($_POST['forid']);
    echo json_encode($res);
}

if(isset($_POST['operation']) && $_POST['operation']=='get_all_rights_details'){
  $res = $getdata->getallrightsdetails($_POST['forid']);
    echo json_encode($res);
}



if(isset($_POST['operation']) && $_POST['operation']=='get_activation'){
  $res = $getdata->getactivationdetails($_POST['forid']);
    echo json_encode($res);
}


if(isset($_POST['operation']) && $_POST['operation']=='unset'){
  $res = $getdata->unset_right($_POST['id'],$_POST['foremp']);
    if($res == 1){
      $getdata->log_activity('[UN-SET USER RIGHTS] for : Emp No.-'.$_POST['foremp']. ' FOR MENUID : '.$_POST['id']);
      echo 1;
    }else{
      echo 0;
    }
}

if(isset($_POST['operation']) && $_POST['operation']=='set_menu'){
  $res = $getdata->set_right($_POST['id'],$_POST['emp']);
    if($res == 1){
      $getdata->log_activity('[SET USER RIGHTS] for : Emp No.: '.$_POST['emp']. ' FOR MENUID '.$_POST['id']);
      echo $res;
    }else{
      echo $res;
    }
}



if(isset($_POST['operation']) && $_POST['operation'] == 'update_group'){

  $res = $getdata->updategroupofemp($_POST['forid'],$_POST['grp'],$_POST['desig']);
  
  if ($res){

      $getdata->log_activity('[USER MANAGEMENT] Employee Group/sectionn updated for : Emp No.-'.$_POST['forid']);
      echo 1;
  }
  else{
      echo 0;
  }
  
 }


 
if(isset($_POST['operation']) && $_POST['operation'] == 'reset_pass_as_emp_no'){
  
  $res = $getdata->resetpasswordasemp($_POST['forid']);
  
  if ($res){

      $getdata->log_activity('[USER MANAGEMENT] Employee password reset as Emp. No. for : Emp No.-'.$_POST['forid']);
      echo 1;
  }
  else{
      echo 0;
  }
  
 }



 if(isset($_POST['operation']) && $_POST['operation']=='inactive'){
  $res = $getdata->in_activate_user($_POST['emp']);
    if($res == 1){
      $getdata->log_activity('[IN-ACTIVATE USER] for : Emp No.: '.$_POST['emp']);
      echo 1;
    }else{
      echo 0;
    }
}
if(isset($_POST['operation']) && $_POST['operation']=='active'){
  $res = $getdata->activate_user($_POST['emp']);
    if($res == 1){
      $getdata->log_activity('[ACTIVATE USER] for : Emp No.: '.$_POST['emp']);
      echo 1;
    }else{
      echo 0;
    }
  }

  if(isset($_POST['operation']) && $_POST['operation']=='move_pc_inventory'){
    $res = $getdata->pc_move_to_inventory($_POST['forid'],$_POST['foremp'],$_POST['rem']);
      if($res == 1){
        $getdata->log_activity('[PC moved to inventory] : PC autoID.: '.$_POST['forid']. ' from EMP '.$_POST['foremp']);
        echo 1;
      }else{
        echo 0;
      }
  }


  
  if(isset($_POST['operation']) && $_POST['operation']=='move_device_inventory'){
    $res = $getdata->device_move_to_inventory($_POST['forid'],$_POST['foremp'],$_POST['rem']);
      if($res == 1){
        $getdata->log_activity('[DEVICE moved to inventory] : DEVICE autoID.: '.$_POST['forid']. ' from EMP '.$_POST['foremp']);
        echo 1;
      }else{
        echo 0;
      }
  }