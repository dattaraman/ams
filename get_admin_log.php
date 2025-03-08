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
        $usr = $getdata->getalllogs();
        //print_r($usr);
        $output .= "<table id='example1' class='table table-bordered table-striped w-100'>
        <thead>
        <tr>
        <th class='d-none'>autoID</th>
          <th>Activity</th>
        </tr>
        </thead><tbody>";
        $i=1;
        foreach ($usr as $row){
          $e_name = $getdata->getuserdetailsfromempno($row['user_id']);
          if($row['user_id']==0){
            $src='images/emp/0.jpg';
          }else{
            $src="http://bts.barc.gov.in/Auth_Info/Photo/".$row['user_id'].".jpg";
          }
           $output .= '<tr>
           <td class="d-none">'.$row['autoID'].'</td>
           <td><div class="direct-chat-msg">
           <div class="direct-chat-infos clearfix">
             <span class="direct-chat-name float-left">'.$e_name.'</span>
             <span class="direct-chat-timestamp float-right">'.date('d-m-Y H:m:s',strtotime($row['ondatetime'])).'</span>
           </div>
           <!-- /.direct-chat-infos -->
           <img class="direct-chat-img" src="'.$src.'" alt="'.$row['user_id'].'">
           <!-- /.direct-chat-img -->
           <div class="direct-chat-text">
           '.$row['action'].'
           </div>
          
         </div>
        
           
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

      

       
    