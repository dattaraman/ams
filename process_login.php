<?php
    
    include('conn.php');
    $getdata = new Newdash();
    if(isset($_POST['operation']) && $_POST['operation'] == 'process_login'){

    $res = $getdata->validateUser($_POST['empno'],$_POST['pass']);
    
    if ($res == 1){
        //session_start();
        $getdata->log_activity("USER LOGGED-IN");
        echo 1;
    }
    elseif($res == 2){
        $getdata->log_activity("USER FIRST TIME LOGGED-IN (NOT YET CHANGED PASSWORD)");
        echo 2;
    }
    else{
        $getdata->log_activity("INVALID LOGIN",$_POST['empno']);
        echo 0;
    }
    
    
   }


  
