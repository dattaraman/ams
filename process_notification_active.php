<?php
if(isset($_POST['operation']) && $_POST['operation'] == 'updateNoti'){
    
    include('conn.php');
    $activeuser =new Newdash();
    //$res = $adduser->addUser($_POST['uname'],$_POST['utype'],$_POST['fname'],$_POST['lname'],$_POST['gender'],$_POST['dob'],$_POST['email'],$_POST['mobile1'],$_POST['mobile2'],$_POST['address']);
    $res = $activeuser->activateNotification($_POST['op_active'],$_POST['fornoti']);
    //echo $res;
    if ($res){

       //$activeuser->log_activity("User - ".$_POST['op_active'] ." ". $_POST['fornoti']);
       echo 1;
    }
    else{
        echo 0;
    }
    
    
}
