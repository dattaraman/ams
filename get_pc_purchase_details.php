<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();

    if(isset($_POST['operation']) && $_POST['operation'] == 'add_purchase'){

        $res = $getdata->addPcPurchaseDetail($_POST['pc_ssd'],$_POST['pc_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['pc_make'],$_POST['pc_model'],$_POST['pc_ram'],$_POST['pc_hdd'],$_POST['pc_os'],$_POST['pc_monitor'],$_POST['pc_cost'],$_POST['pc_warranty'],$_POST['pc_warrabty_uptodate'],$_POST['po_no'],$_POST['po_dt'],$_POST['loggedinbyemp'],$_POST['pc_form']);
        $ret_id = $getdata->getAddedRecord($_POST['pc_ssd'],$_POST['pc_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['pc_make'],$_POST['pc_model'],$_POST['pc_ram'],$_POST['pc_hdd'],$_POST['pc_os'],$_POST['pc_monitor'],$_POST['pc_cost'],$_POST['pc_warranty'],$_POST['pc_warrabty_uptodate'],$_POST['po_no'],$_POST['po_dt'],$_POST['loggedinbyemp'],$_POST['pc_form']);
        if ($res && $ret_id){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PURCHASE DETAILS ADDED : INDENT No.-'.$_POST['indent_no']);
                $filename = 'RV'.'-'.$_POST['pc_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetails($filename.'.'.$extension,$ret_id);
                        }
                       
                    }else{
                        echo "Invalid file...Please select JPG OR PDF file only";
                    }
                // if file
            }
             
                // upload
            echo 1;
        }
        else{
            echo 0;
        }
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'edit_purchase'){

        $res = $getdata->editPcPurchaseDetail($_POST['e_pc_ssd'],$_POST['e_pc_supplier'],$_POST['e_indent_no'],$_POST['e_indent_dt'],$_POST['e_indent_by'],$_POST['e_rv_no'],$_POST['e_rv_dt'],$_POST['e_rv_qty'],$_POST['e_pc_make'],$_POST['e_pc_model'],$_POST['e_pc_ram'],$_POST['e_pc_hdd'],$_POST['e_pc_os'],$_POST['e_pc_monitor'],$_POST['e_pc_cost'],$_POST['e_pc_warranty'],$_POST['e_pc_warrabty_uptodate'],$_POST['e_po_no'],$_POST['e_po_dt'],$_POST['e_loggedinbyemp'],$_POST['e_recordid'],$_POST['e_pc_form']);
        $ret_id = $_POST['e_recordid'];
        if ($res){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PURCHASE DETAILS EDITED : INDENT No.-'.$_POST['e_indent_no']);
                $filename = 'RV'.'-'.$_POST['e_pc_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetails($filename.'.'.$extension,$ret_id);
                        }
                       
                    }else{
                        echo "Invalid file...Please select JPG OR PDF file only";
                    }
                // if file
            }
             
                // upload
            echo $res;
        }
        else{
            echo $res;
        }
        
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
        $output = '';
        $usr = $getdata->getpcpurchasedetails();
        //print_r($usr);
        $output .= "<table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>#</th>
          <th>PO Details</th>
          <th>Supplier</th>
          <th>Form/Make/Model</th>
          <th>Configuration</th>
          <th>Updated on</th>
          <th>Action</th>
        </tr>
        </thead><tbody>";
        $i=1;
        foreach ($usr as $row){
            if($row['rvfileuploaded'] == 1){
                $linkdownload= '<a href="'.$rvuploadpath.$row['rvfilename'].'" target="_blank"><span class="fas fa-file-pdf"></span> </a> ';
             }
                 else{
                     $linkdownload= '';
             }
             if($row['pc_form']=='laptop'){$pcform ='briefcase';}else{$pcform ='desktop';}
           $output .= '<tr>
           <td>'.$i.'</td>
           <td>'.$linkdownload .' PO No. : '.$row['po_no']. ' dt. '. date("d/m/Y", strtotime($row['po_dt'])).'</td>
           <td>'.$row['details_of_supplier'].'</td>
           <td><span data-toggle="tooltip" title="'.$row['pc_form'].'" class="fas fa-'.$pcform.'"></span> '.$row['pc_make'].' - '.$row['pc_model']. '</td>
           <td><span class="text-uppercase">'.$row['pc_form'].' - </span> '.$row['pc_ram_details'].' GB / '.$row['pc_hdd_details'].' GB</td>
           <td>'.date("d/m/Y H:i:s", strtotime($row['updatedon'])).'</td>
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
        $res = $getdata->get_purchase_detail($_POST['forid']);
        echo json_encode($res);
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'single_detail_asjson'){
        $res = $getdata->getsinglepcdetails_asjson($_POST['id']);
        echo json_encode($res);
       }




       if(isset($_POST['operation']) && $_POST['operation'] == 'delete_record'){
        $res = $getdata->deletepurchasedetail($_POST['forid']);
        if($res){
            $getdata->log_activity('PURCHASE DETAILS DELETED : ID-'.$_POST['forid']);
            echo 1;
        }else{
            echo 0;
        }
       }

       
    