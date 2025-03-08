<?php
    
    include('conn.php');
    $getdata = new Newdash();
    session_start();

    if(isset($_POST['operation']) && $_POST['operation'] == 'add_purchase'){

        $res = $getdata->addPrinterPurchaseDetail($_POST['select_product'],$_POST['printer_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['po_no'],$_POST['po_dt'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['printer_make'],$_POST['printer_model'],$_POST['printer_type'],$_POST['printer_cost'],$_POST['printer_warranty'],$_POST['printer_warranty_uptodate']);
        $ret_id = $getdata->getAddedPrinterAddedRecord($_POST['select_product'],$_POST['printer_supplier'],$_POST['indent_no'],$_POST['indent_dt'],$_POST['indent_by'],$_POST['po_no'],$_POST['po_dt'],$_POST['rv_no'],$_POST['rv_dt'],$_POST['rv_qty'],$_POST['printer_make'],$_POST['printer_model'],$_POST['printer_type'],$_POST['printer_cost'],$_POST['printer_warranty'],$_POST['printer_warranty_uptodate']);
        if ($res && $ret_id){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PRINTER PURCHASE DETAILS ADDED : INDENT No.-'.$_POST['indent_no']);
                $filename = 'RV'.'-'.$_POST['printer_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.'printer'.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetailsprinter('printer'.$filename.'.'.$extension,$ret_id);
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


       if(isset($_POST['operation']) && $_POST['operation'] == 'delete_record'){
        $res = $getdata->deleteprinterpurchasedetail($_POST['forid']);
        if($res){
            $getdata->log_activity('PRINTER PURCHASE DETAILS DELETED : ID-'.$_POST['forid']);
            echo 1;
        }else{
            echo 0;
        }
       }

       if(isset($_POST['operation']) && $_POST['operation'] == 'edit_purchase'){

        $res = $getdata->editPrinterPurchaseDetail($_POST['e_select_product'],$_POST['e_printer_supplier'],$_POST['e_indent_no'],$_POST['e_indent_dt'],$_POST['e_indent_by'],$_POST['e_po_no'],$_POST['e_po_dt'],$_POST['e_rv_no'],$_POST['e_rv_dt'],$_POST['e_rv_qty'],$_POST['e_printer_make'],$_POST['e_printer_model'],$_POST['e_printer_type'],$_POST['e_printer_cost'],$_POST['e_printer_warranty'],$_POST['e_printer_warranty_uptodate'],$_POST['e_id_update']);
        $ret_id = $_POST['e_id_update'];
        if ($res){
            // upload
            if (isset($_FILES['file'])){
                // if file
                $getdata->log_activity('PRINTER PURCHASE DETAILS UPDATED : INDENT No.-'.$_POST['e_indent_no']);
                $filename = 'RV'.'-'.$_POST['e_printer_make'].'-'.$ret_id;
                $csvMimes = array('image/jpeg', 'image/gif', 'image/png','application/pdf');
                // Validate whether selected file is a JPG/PDF file
                   
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                        $res1 = move_uploaded_file($_FILES["file"]["tmp_name"], $rvuploadpath.'printer'.$filename . ".".$extension);
                        if($res1){
                            $upentry = $getdata->updfiledetailsprinter('printer'.$filename.'.'.$extension,$ret_id);
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

       if(isset($_POST['operation']) && $_POST['operation'] == 'alllist'){
        $output = '';
        $usr = $getdata->getprinterpurchasedetails();
        //print_r($usr);
        $output .= "<table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>#</th>
          <th>PO Details</th>
          <th>Supplier</th>
          <th>Device</th>
          <th>Make/Model</th>
          <th>Qty.</th>
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
           $output .= '<tr>
           <td>'.$i.'</td>
           <td>'.$linkdownload .' PO No. : '.$row['po_no']. ' dt. '. date("d/m/Y", strtotime($row['po_dt'])).'</td>
           <td>'.$row['details_of_supplier'].'</td>
           <td>'.$row['device'].'</td>
           <td>'.$row['dm'].' - '.$row['device_model']. '</td>
           <td>'.$row['qty_received'].'</td>
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
        $res = $getdata->get_printer_purchase_detail($_POST['forid']);
        echo json_encode($res);
       }

      

       
    