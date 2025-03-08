<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();

    if(isset($_POST['operation']) && $_POST['operation'] == 'add_notification'){
        $res = $getdata->addnotification($_POST['noti_title'],$_POST['noti_description'],$_POST['valid_till'],$_POST['noti_link']);
        if($res){
            echo 1;
       }else{
           echo 0;
       }

    }
       if(isset($_POST['operation']) && $_POST['operation'] == 'edit_notification'){
        $res = $getdata->editnotification($_POST['e_noti_title'],$_POST['e_noti_description'],$_POST['e_valid_till'],$_POST['e_noti_link'],$_POST['e_autoID']);
        if($res){
            echo 1;
       }else{
           echo 0;
       }
       }



       if(isset($_POST['operation']) && $_POST['operation'] == 'delete_record'){
        $res = $getdata->deletenotification($_POST['forid']);
        if($res){
            $getdata->log_activity('NOTIFICATION DELETED : ID-'.$_POST['forid']);
            echo 1;
        }else{
            echo 0;
        }
       }

      
       if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
        $output = '';
        $usr = $getdata->getallnotifications();
        //print_r($usr);
        $output .= "<table id='example1' class='table table-bordered table-striped w-100'>
        <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Valid till</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
        </thead><tbody>";
        $i=1;
        foreach ($usr as $row){
           if($row['noti_active']==1){
                $chk='checked';
           }else{
                $chk='';
           }
           if($row['active_till']>date('Y-m-d')){
                $ac = '';
           }else{
            $ac = 'text-danger';
           }    
           $output .= '<tr>
           <td>'.$i.'</td>
           <td>'.$row['noti_title'].'</td>
           <td>'.$row['noti_description'].'</td>
           <td class="'.$ac.'">'.$row['active_till'].'</td>
           <td>
           <div class="form-group">
           <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
             <input type="checkbox" class="custom-control-input active_notification" ' .$chk. ' id="'.$row['autoID'].'" data-id = "'.$row['autoID'].'">
             <label class="custom-control-label" for="'.$row['autoID'].'"></label>
            </div>
          </div>
           </td>
           <td>
            <button class="btn btn-primary btn-sm view_details mr-2 mt-2" data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_view" title="View details"><span class="fas fa-info-circle"></span></button>            
            <button class="btn btn-warning btn-sm edit_details mr-2 mt-2" data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_edit" title="Edit details"><span class="fas fa-edit"></span></button>            
            <button class="btn btn-danger btn-sm delete_details mr-1 mt-2"  data-id = "'.$row['autoID'].'" data-toggle="modal" data-target="#modal_delete" title="Delete"><span class="fas fa-trash"></span></button>
           </td>
           </tr>';
           $i++;
        }
        $output .= '</tbody></table>';
        echo $output;

       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'single_detail'){
        $res = $getdata->getsinglenotification($_POST['forid']);
        echo json_encode($res);
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'active_inactive_noti'){
        $res = $getdata->activateNotification($_POST['forid'],$_POST['op']);
        if($res){
            $getdata->log_activity('NOTIFICATION activated/de-activated  :'. $_POST['forid'].', SET TO : '.$_POST['op']);
            echo 1;
       }else{
           echo 0;
       }
       }

      

       
    