<?php
include('conn.php');
$getdata = new Newdash();


if(isset($_POST['operation']) && $_POST['operation']=='addserver'){
    $res=$getdata->addmachine($_POST['rackno'],$_POST['kvmid'],$_POST['servername'],$_POST['ipadd'],$_POST['serveros'],$_POST['serverosversion']);
    if($res){
      echo 1;
    }else{
      echo 0;
    }
 }

 if(isset($_POST['operation']) && $_POST['operation']=='checkServer'){
  $res=$getdata->checkmachine($_POST['ipadd']);
  if($res > 0 ){
    echo 1;
  }else{
    echo 0;
  }
}

if(isset($_POST['operation']) && $_POST['operation']=='getbyid'){
  $res=$getdata->getserverbyid($_POST['id']);
  echo json_encode($res);
}