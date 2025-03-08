<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();
    $allunits = $getdata->getallunits();
    $output="";
    
    if(isset($_POST['operation']) && $_POST['operation']=='get_details'){
      $res = $getdata->getloginuserdetails($_POST['emp']);
      echo json_encode($res);
    }
    

if(isset($_POST['operation']) && $_POST['operation']=='get_all_details'){
  $res = $getdata->getalldetails($_POST['forid']);
    echo json_encode($res);
}

if(isset($_POST['operation']) && $_POST['operation']=='updateprofile'){
  $res = $getdata->updateemp_profile($_POST['emp_title'],$_POST['emp_name'],$_POST['emp_no'],$_POST['emp_desig'],$_POST['emp_cc'],$_POST['emp_sec'],$_POST['emp_sp'],$_POST['emp_email'],$_POST['emp_phone']);
    if($res == 1){
      $getdata->log_activity('User profile updated for : Emp No.-'.$_POST['emp_no']);
      echo 1;
    }else{
      echo 0;
    }
}
//--------------------------------------------------------------------------------
if(isset($_POST['operation']) && $_POST['operation']=='get_all_devices_details'){
  $res = $getdata->getalldevicedetails($_POST['forid']);
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

  $res = $getdata->updategroupofemp($_POST['forid'],$_POST['grp']);
  
  if ($res){

      $getdata->log_activity('[USER MANAGEMENT] Employee Group/sectionn updated for : Emp No.-'.$_POST['forid']);
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
      echo $res;
    }else{
      echo $res;
    }
}
if(isset($_POST['operation']) && $_POST['operation']=='active'){
  $res = $getdata->activate_user($_POST['emp']);
    if($res == 1){
      $getdata->log_activity('[ACTIVATE USER] for : Emp No.: '.$_POST['emp']);
      echo $res;
    }else{
      echo $res;
    }
  }