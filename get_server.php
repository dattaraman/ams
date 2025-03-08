<?php
include('conn.php');
$getdata = new Newdash();
$allracks = $getdata->getracks();
    function pinger($address){
        if(strtolower(PHP_OS)=='winnt'){
            $command = "ping -n 1 $address";
            exec($command, $output, $status);
        }else{
            $command = "ping -c 1 $address";
            exec($command, $output, $status);
        }
        if($status === 0){
            return true;
        }else{
            return false;
        }
    }


    if(isset($_POST['operation']) && $_POST['operation']=='loadservers'){
    $output = '';
    foreach ($allracks as $racks)
    {
        $output .='
        <div class="col-md-4">
        <div class="card card-widget widget-user-2">
        <div class="widget-user-header bg-dark">
                <div class="widget-user-image">
                  <img class="img-circle" src="images/servericon.png" alt="Server">
                </div>
                
                <h3 class="widget-user-username">'. $racks["server_rack"].'<span class="float-right">
                
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="'.$racks["server_rack"].'" checked>
                      <label class="custom-control-label" for="'.$racks["server_rack"].'"></label>
                    </div>
                  </div>
                </span></h3>
               
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
        ';
        $allmachines = $getdata->getmachines($racks['server_rack']);
        foreach ($allmachines as $machines){
          
            $output .='
                    <li class="nav-item listitem">
                    <div class="row">
                    <div class="col-lg-2 pt-2">
                    <button class="btn btn-app bg-warning btn-sm"><i class="fas fa-laptop"></i>'. $machines["kvmid"].'
                    </button>
                    </div>
                    <div class="col-lg-10 pl-5">
                    
                    <a href="#" class="nav-link serverlink" data-target="#machineModal" data-toggle="modal" data-serverid ="'.$machines['server_autoID'].'">';
                    if($machines["server_os"]=="Windows"){$faicon = "fab fa-windows mr-1";} else if ($machines["server_os"]=="Linux") {$faicon = "fab fa-linux mr-1";} else { $faicon = "fab fa-laptop mr-1";}
                    $output.='<span class="'.$faicon.'"></span>';
                    $output.= $machines["server_name"];
                    $output.='<br><span class="badge badge-secondary">'.$machines["os_version"].'</span>';
                    $output.='<span class="float-right">';
                    //$output.=pinger($machines["server_ip"]);
                    if(pinger($machines["server_ip"])){
                        $output.='<span class="fas fa-cog fa-spin fa-2x text-success"></span></span>';
                    }else {
                        $output.='<span class="fas fa-exclamation-triangle fa-2x text-danger"></span></span>';
                    }
                    
                     $output.=' <br><span class="text-muted small">';
                      $output.=$machines["server_ip"];
                      $output.='</span>
                    </a>
                    </div>
                    </div>
                   
                  </li>';
        }
        $output .= '</ul></div></div></div>';
    }
   echo $output;
  }
  
 


        
    
?>