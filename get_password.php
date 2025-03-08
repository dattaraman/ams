<?php
    
    include('conn.php');
    $getdata = new Newdash();
    if(isset($_POST['operation']) && $_POST['operation'] == 'update_password'){

    $res = $getdata->changePassword($_POST['uname'],$_POST['emp_password']);
    
    if ($res){
        //session_start();
        
        $getdata->log_activity('PASSWORD UPDATED : EMP. NO. - '.$_POST['uname']);
        echo 1;
    }
    else{
        echo 0;
    }
    
    
   }