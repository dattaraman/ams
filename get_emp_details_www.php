<?php
include('conn_www.php');
    $getdata = new Newdash();
    session_start();

    if(isset($_POST['operation']) && $_POST['operation'] == 'search_emp'){
        $res = $getdata->getempsuggesstion($_POST['kw']);
        echo json_encode($res);
       }