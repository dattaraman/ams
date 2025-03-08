<?php
session_start();
  if(!isset($_SESSION['loggedinby_autoID'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIRD | [Admin] Transaction Logs</title>
  <style>
  .error{color:#ff0000;}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="images/sird_logo.png" alt="AdminLTELogo" height="100" width="100">
  </div>

  <!-- Navbar -->
  <?php include('header_nav.php'); ?>
  <!-- /.navbar -->

 <?php include('sidebar.php');?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">[Admin] Transactions Log</h1>         
            </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">[Admin] Transactions Log</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
            

              </div>
              <!-- /.card-header -->
              <div class="toastctrl"></div>
              <div class="card-body" id="showusers"></div>
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
        <!-- modal edit -->
  <div class="modal fade" id="modal_view">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title">View notification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body">
                 <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_noti_title">Notification title</label>
                          <input type="text" class="form-control" placeholder="Notification for title" required="required" id="v_noti_title" name="v_noti_title" readonly>
                          <input type="hidden" class="form-control" placeholder="" required="required" id="v_autoID" name="v_autoID">
                        </div>    
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-12">
                        <div class="form-group">
                          <label for="v_noti_description">Notification description </label>
                          <textarea class="form-control" placeholder="Description for notification" id="v_noti_description" name="v_noti_description" readonly></textarea>
                        </div>    
                      </div>
                    </div> <!-- row -->

                    <div class="row">
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label>Valid till</label>
                          <div class="input-group date" id="vvalid_till1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#v_valid_till" name="v_valid_till" id="v_valid_till" placeholder="Valid till date" readonly/>
                            <div class="input-group-append" data-target="#e_valid_till" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>    
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="v_noti_link">URL for link (if any) </label>
                        <input type="text" class="form-control" placeholder="Full URL" id="v_noti_link" name="v_noti_link" readonly>
                      </div>    
                    </div>
</div>

                  <div class="modal-footer">
              
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            </div>    
                </div>
                <!-- /.card-body -->
              
            </div>
            
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal view-->





  <?php include ('footer.php');?>
  <script>
  $(function () {

    function get_logs(){
     
     $.ajax({  
     url: "get_admin_log.php",
     type: "POST",
     data: {operation:"alllist"},beforeSend: function(){
       $(".toastctrl").fadeOut();
     
     },
     success: function(response){
        //console.log(response);
        $("#showusers").html(response);
        $("#example1").DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: true,
          order: [0,'desc'],
          buttons: ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_filter');
      }
   });
   

   }
   $("#deleteBtn").click(function(){
        //delete_purchase_data($("#delid").val());
        delete_notification($("#delid").val());
    });
    function delete_notification(id){
      $.ajax({
        type : 'post',
        url : 'get_admin_log.php',
        data: {operation:'delete_record',forid : id},
        beforeSend: function(){
        $("#deleteBtn").html('Deleting record ...');
        },
        success : function(response){
          //alert(response);
          if(response == 1){
            get_logs();
            showtoast("Notification deleted successfully!");
            $("#modal_delete").modal('hide');
            $("#delid").val('');
            $("#deleteBtn").html("Delete");
           

          }else{
            showtoast("Internal server error!");
          } 
        }
    });
    }



// add noti
$("#addnotification").validate({
            rules: {
              noti_title : "required",
              valid_till: "required"
            },
            messages: {
              noti_title : "Enter title",
              valid_till: "Select date"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_admin_log.php',
        data : $("#addnotification").serialize()+"&operation=add_notification",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#saveBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error_add").fadeIn(1000, function(){
            $("#error_add").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#saveBtn").html('Save');
            });
            }
            else {
            
            $("#error_add").fadeIn(1000, function(){
            $("#saveBtn").prop('disabled', true);
            $("#modal_add").modal('hide');
            $("#saveBtn").prop('disabled', false);
            $("#addnotification").trigger("reset");
            $("#error_add").fadeOut();
            
            $("#saveBtn").html('Save');
            get_logs();
            showtoast('Notification initiated successfully!');
            });

            }

}
});
            }
       
    });


// add noti
$("#editnotification").validate({
            rules: {
              e_noti_title : "required",
              e_noti_description: "required",
              e_valid_till :"required",
              e_autoID : "required"
            },
            messages: {
              e_noti_title : "Enter title",
              e_noti_description: "Enter description",
              e_valid_till :"Select valid till date",
              e_autoID : "Invalid selection"
            },
            submitHandler: function(form) {
              $.ajax({
        type : 'post',
        url : 'get_admin_log.php',
        data : $("#editnotification").serialize()+"&operation=edit_notification",
        beforeSend: function(){
        $("#error").fadeOut();
        $("#updateBtn").html('Saving data ...');
},
        success : function(response){
          //alert(response);
            if(response != 1){
            $("#error_add").fadeIn(1000, function(){
            $("#error_add").html("<div class='alert alert-danger text-center'>"+response+ " !</div>");
            $("#updateBtn").html('Save');
            });
            }
            else {
            
            $("#error_edit").fadeIn(1000, function(){
            $("#updateBtn").prop('disabled', true);
            $("#modal_edit").modal('hide');
            $("#updateBtn").prop('disabled', false);
            $("#editnotification").trigger("reset");
            $("#error_edit").fadeOut();
            
            $("#updateBtn").html('Update');
            get_logs();
            showtoast('Notification updated successfully!');
            

            });

            }

}
});
            }
       
    });
// edit noti

    $("body").on("click", ".delete_details", function (e) {
      //alert($(this).data('id'));
      $("#delid").val($(this).data('id'));
    });

    $("body").on("click", ".active_notification", function (e) {
      
      var aa= $(this).data('id');
      if($(this).is(":checked")) {
        update_activate(aa,'1');
      }else{
        //alert($(this).data('id'));
        update_activate(aa,'0');
      }

    });

    function update_activate(id,op){
      $.ajax({  
       url: "get_admin_log.php",
       type: "POST",
       data: {operation:'active_inactive_noti',forid:id,op:op},
       success : function(response){
          //alert(response);
          if(response == 1){
            showtoast("Status updated successfully!");
          }
       }
      });
    }

    

    $("body").on("click", ".edit_details", function (e) {
      //alert($(this).data('id'));
      get_notifications_byid_edit($(this).data('id'));
    });
    // edit noti

    function get_notifications_byid_edit(id){
      $.ajax({  
       url: "get_admin_log.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        $("#e_noti_title").val(data.noti_title);
        $("#e_noti_description ").val(data.noti_description);
        $("#e_valid_till ").val(data.active_till);
        $("#e_noti_link ").val(data.noti_link);
        $("#e_autoID ").val(data.autoID);
    }
      });
    }

    $("body").on("click", ".view_details", function (e) {
      //alert($(this).data('id'));
      get_notifications_byid_view($(this).data('id'));
    });

    function get_notifications_byid_view(id){
      $.ajax({  
       url: "get_admin_log.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
         //console.log(response);
        //alert(response);
        data = JSON.parse(response);
        $("#v_noti_title").val(data.noti_title);
        $("#v_noti_description ").val(data.noti_description);
        $("#v_valid_till ").val(data.active_till);
        $("#v_noti_link ").val(data.noti_link);
        $("#v_autoID ").val(data.autoID);
    }
      });
    }

    $('[data-toggle="tooltip"]').tooltip();

    $('#valid_till').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date()
    });

    $('#e_valid_till').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date()
    });

    $('[data-toggle="tooltip"]').tooltip();

    get_logs();
    
    



  
    

    
    //show toast
    function showtoast($msg){
    
    
      toastr.success($msg)
    }
    // show toast

  


    
    
  });
  
</script>



   
     

      
    




      </body>
</html>
