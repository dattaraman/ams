
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="SIRD Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AIMS <br><span class="text-sm">Asset & Inventory Management System</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/emp/<?=$udetails['emp_no'];?>.jpg" class="img-circle elevation-1" alt="User Image">
        </div>
        <div class="info">
          <span class="d-block text-white"><?=$udetails['emp_name'];?></span>
          <span class="text-xs text-white">( <?=$udetails['emp_desig'];?> )</span><br>
          <span class="text-xs text-white"><?=$udetails['grp_name'];?> </span>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                
              </p>
            </a>
          </li>
          
          <?php
          
          foreach ($menugroups as $mg){
            echo '<li class="nav-header">'.$mg['menu_group'].'</li>';
            $menus = $getdata->getallowedMenus($uid,$mg['menu_group']);
            foreach ($menus as $m){
              echo '<li class="nav-item">
              <a href="'.$m['menu_url'].'" class="nav-link">
                 <i class="nav-icon '.$m['menu_icon'].'"></i>
                 <p>'.
                 $m['menu_name']                   
                 .'</p>
               </a>
             </li>';
            }
          }
          
          ?>
          <li>&nbsp;</li>
          <li>&nbsp;</li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="modal_view_noti">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title"><b id="noti_title"></b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                <div class="card-body" id="noti_desc">
                  
                </div>
                <p id="noti_l">URL or Link : <i id="noti_link"> </i></p>
                <!-- /.card-body --><br><br>
                <div class="row">
                  <div class="col-md-12 text-right">
                    <img id="addedbyimg"><small><i class="text-sm" id="msgby"></i></small><br><i class="text-sm" id="noti_date"></i>
                  </div>
                
              </div>
            </div>
            <div class="modal-footer">
            
             
             
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal add-->
 
  
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
  <script>
  $(function () {
    $("body").on("click", ".view_noti", function (e) {
      //alert($(this).data('id'));
      var id = $(this).data('id');
      var dt = $(this).data('dt');
      
      $.ajax({  
       url: "get_admin_notification.php",
       type: "POST",
       data: {operation:'single_detail',forid:id},
       success: function(response){
        data = JSON.parse(response);
         //console.log(response);
        //alert(response);
        $("#noti_title").html(data.noti_title);
        $("#noti_desc").html(data.noti_description);
        $("#noti_date").html(dt);
        //alert(data.noti_link);
        if(data.noti_link !=""){
          $("#noti_l").show();
          $("#noti_link").html("<a target='_blank' href='http://"+data.noti_link+"'>"+data.noti_link+"</a>");
        }else{
          $("#noti_l").hide();
        }
        getaddedbyinfo(data.addedby);
       }
    });
    });

    function getaddedbyinfo(empno){
     // alert("call");
      $.ajax({  
       url: "get_user_manage_admin.php",
       type: "POST",
       data: {operation:'get_all_details',forid:empno},
       success: function(response){
        data = JSON.parse(response);
         //console.log(response);
        //alert(response);
        $("#msgby").html(data.emp_title+" "+data.emp_name);
        $("#addedbyimg").attr("src","http://bts.barc.gov.in/Auth_Info/Photo/"+empno+".jpg");
        $('#addedbyimg').addClass('img-circle img-size-32 mr-2');
       
       
       }
    });
    }
  });
  </script>
