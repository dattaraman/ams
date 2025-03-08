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
            <div class="col-lg-3"><img class="rounded w-100" src="http://bts.barc.gov.in/Auth_Info/Photo/'.$unithead['emp_no'].'.jpg" alt="'.$unithead["emp_title"].' '.$unithead["emp_name"].'"></div>
              <div class="col-lg-9">';
                  $output.= $unithead["emp_title"] . ' '. $unithead["emp_name"].'<br><span class="fas fa-award"></span> <span class="small">'.$unithead["emp_desig"].'</span>';
                  $output.='<br><span class="text-sm"><span class="fas fa-id-card"></span> '.$unithead["emp_no"].'</span></span>';
                  if($unithead["emp_o_email"]!="")
                  $output.='<br><span class="text-sm"><span class="fas fa-envelope"></span> <a class="text-decoration-none text-white" href="mailto:'.$unithead["emp_o_email"].'">'.$unithead["emp_o_email"].'</a></span></span>';
                  if($unithead["emp_extn"]!="")
                  $output.='<br><span class="text-sm"><span class="fas fa-phone-alt"></span> '.$unithead["emp_extn"].'</span></span>';
              $output .='</div>
            </div>
          </div>
                <div class="card-footer p-0">
                  <ul class="nav flex-column">';
          $allusers = $getdata->userbyunit($units['autoID']);
          foreach ($allusers as $user){
            $output .='
                    <li class="nav-item listitem">
                      <div class="row">
                        <div class="col-lg-2"><div class="widget-user-image"><img class="rounded mb-2" src="http://bts.barc.gov.in/Auth_Info/Photo/'.$user['emp_no'].'.jpg" alt="'.$user["emp_title"].' '.$user["emp_name"].'"></div></div>
                        <div class="col-lg-9 pt-1 pl-3">
                          <div class="row">
                            <div class="col-lg-10 text-primary"><a href="http://bts.barc.gov.in/PCSearchEngine/#/PCSearchEngine/DisplayEmpInfo.php?&Keyword=:'.$user['emp_no'].'" target="_blank">'.$user['emp_name'].'</a></div>
                            <div class="col-lg-2"><button class="btn btn-outline-danger btn-sm getdetails" data-id="'.$user['emp_no'].'" data-target="#modalManage" data-toggle="modal"><span class="fas fa-cog"></span></button></div>  
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
                        $output .= '<div class="row"><div class="col-lg-6 text-muted text-sm"><span class="fas fa-envelope"></span> <a class="text-decoration-none" href="mailto:'.$user['emp_o_email'].'" target="_blank">'.$user['emp_o_email'].'</a></div>';}
                        if($user["emp_shift_autoID"]!=""){
                          $output .= '<div class="col-lg-6 text-muted text-sm"><span class="fas fa-clock"></span> '.$user['shift_name'].'</div></div>';}
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
