<?php
ini_set('max_execution_time','300');
set_time_limit(300);
$base = "localhost/sird_console/";
$rvuploadpath = 'uploads/rvcopy/';
		$app_name = "SIRD Dashboard";
		
		function get_client_ip() {
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else{
				$ipaddress = 'UNKNOWN';}
			return $ipaddress;
		}


		//$uid = "1";
		//$_SESSION['loggedinby']=$uid;
	class Newdash
	{
		public $db;
		
		function __construct()
		{
			$hostname = "localhost";
			$dbname = "sird_dashboard";
			$username = "root";             
			$password = "";
			$this->db = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
		}


		// login function 
	public function validateUser($empno,$password){
		if(empty($password)){
		 return "Please provide Emp. No. and Password";
		}else{
			
			//$pass = sha1($password);
			$chksql = "SELECT * FROM tbl_users WHERE emp_no = :empno AND emp_pass = :pass AND isactive = 1";
			$stmt = $this->db->prepare($chksql);
			$stmt->bindParam(':empno', $empno);  
			//$pass = sha1($password);
			$stmt->bindParam(':pass', $password);
			$stmt->execute();
			
			if($stmt->rowCount() > 0){	
				session_start();
				$_SESSION['loggedinby'] = $empno;
				// getting details
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['loggedinby_type'] = $result['user_type'];
				$_SESSION['loggedinby_autoID'] = $result['autoID'];
				$_SESSION['loggedinby_groupID'] = $result['emp_grp_autoID'];
				// getting details
				return $stmt->rowCount();
			}else{
				return 0;
			}
			//return $stmt->rowCount();
		}
	  } // function end login function

	  public function logout(){
		session_start();
		
		session_destroy();
		header("Location: index.php");
	
	}// logout function


	// get last login
public function getlastlogin($uemp){
	$sql = "SELECT * from tbl_transactions WHERE user_id=$uemp and action='USER LOGGED-IN' and autoID < (SELECT max(autoID) from tbl_transactions) ORDER BY autoID DESC LIMIT 1";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}
// get last login

		public function getnumberofservers(){
			$sql = "SELECT COUNT(*) as cnt FROM `tbl_servers` WHERE server_isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch();
			return $result;
		}
		
		public function getracks(){
			$sql = "SELECT DISTINCT server_rack FROM `tbl_servers` WHERE server_isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getmachines($rack){
			$sql = "SELECT * FROM `tbl_servers` WHERE server_rack = '$rack' AND server_enabled = '1' AND server_isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function addmachine($rack,$servername,$serverip,$serveros){
			$sql = "INSERT INTO tbl_servers (server_rack,server_name,server_ip,server_os) VALUES ('$rack','$servername','$serverip','$serveros')";
			$stmt = $this->db->prepare($sql);
			$result = $stmt->execute();
			return $result;
		}

		public function checkmachine($serverip){
			$sql = "SELECT * from tbl_servers WHERE server_isdeleted = 0 AND server_ip = '$serverip'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}

		public function getserverbyid($id){
			$sql = "SELECT * from tbl_servers WHERE server_isdeleted = 0 AND server_autoID = $id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		public function getallowedMenuGroups($id){
			$sql = "SELECT DISTINCT menu.menu_group FROM `tbl_menu` as menu JOIN `tbl_menu_permission` as menu_perm ON menu.autoID = menu_perm.menuID WHERE menu_perm.userID=$id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getallowedMenus($id,$grp){
			$sql = "SELECT DISTINCT menu.menu_name, menu.menu_url, menu.menu_icon FROM `tbl_menu` as menu JOIN `tbl_menu_permission` as menu_perm ON menu.autoID = menu_perm.menuID WHERE menu_perm.userID=$id AND menu.menu_group = '$grp'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function getloginuserdetails($sessid){
			$sql = "SELECT s.shift_name,u.autoID,u.emp_no,u.emp_title,u.emp_name,u.emp_gender,u.emp_desig,u.emp_cc,u.emp_dob,u.emp_o_email,u.emp_mob,u.emp_e_email,u.emp_sitting_place,u.emp_extn,u.emp_shift_autoID,u.emp_pass,u.emp_grp_autoID,u.isactive, g.grp_name FROM tbl_users as u JOIN tbl_groups as g ON g.autoID = u.emp_grp_autoID JOIN tbl_shift as s ON s.autoID = u.emp_shift_autoID WHERE u.autoID = $sessid";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		public function getallshifts(){
			$sql = "SELECT * FROM tbl_shift";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function log_activity($useraction){
			$client_ip = get_client_ip();
            $sql = "INSERT INTO `tbl_transactions` (`script_name`, `user_id`, `action`,`byip`) VALUES (:scriptname,:userid,:useraction,:ip)";
           $stmt = $this->db->prepare($sql);
		   				  
                          $stmt->bindValue(':scriptname', $_SERVER['PHP_SELF']);
                          $stmt->bindValue(':userid', $_SESSION['loggedinby']);
                          $stmt->bindValue(':useraction', $useraction);
						  $stmt->bindValue(':ip', $client_ip);
						  $result = $stmt->execute();
                          return $sql;
		}


		///////////////////PC details/////////////////////
		public function getalluserpcs($id){
			//$sql = "SELECT o.os_name,o.os_of,,b.pc_make, b.pc_model FROM tbl_pc_details as a JOIN tbl_pc_make as b ON a.pc_make_model = b.autoID JOIN tbl_pc_os as o ON a.pc_os = o.autoID WHERE a.pc_user_emp =$id";
			$sql = "SELECT a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os ,a.pc_make, a.pc_processor_details, a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  WHERE a.pc_user_emp =$id and a.isdeleted = 0 and a.current_status = 1";
			//$sql="SELECT * from tbl_pc_details WHERE isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getallpcmake(){
			$sql = "SELECT * FROM tbl_pc_make WHERE isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getallpcos(){
			$sql = "SELECT * FROM tbl_pc_os WHERE isdeleted = 0";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		// check IP
public function checkip($ip){
		
				
	$sql = "SELECT * FROM tbl_pc_details WHERE pc_ip = :ip AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->bindParam(':ip', $ip);
	$stmt->execute();
	if($stmt->rowCount() > 0){	
	return 0; // IP already taken
	}else{
		return 1; // OK..proceed
	}

} // function end check IP


		public function addPc($pc_location,$pcuse,$pchdd,$pc_purchase,$pcmake,$pcmake_text,$pcmodel_text,$os,$arc,$ram,$ip,$pcsetup,$pcbarcasset,$pcamcid){
			
            $sql = "INSERT INTO `tbl_pc_details` (`pc_location`,`pc_use`,`pc_hdd`,`pc_source`,`pc_make_model`,`pc_make`,`pc_processor_details`, `pc_os`, `pc_bit_type`,`pc_ram_value`, `pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_user_emp`,`updatedbyip`) VALUES (:pc_location,:pc_use,:pc_hdd,:pc_purchase,:pcmakemodal,:pcmake_text,:pcmodel_text,:os,:bittype,:pcram,:pcip,:pcsetup,:pcbarcasset,:pcamcid,:empuserautoID,:ip)";								
			$stmt = $this->db->prepare($sql);
						$client_ip = get_client_ip();
		   				  $stmt->bindValue(':pc_use', $pcuse);
		  			 	  $stmt->bindValue(':pc_hdd', $pchdd);
		   				  $stmt->bindValue(':pc_purchase', $pc_purchase);
                          $stmt->bindValue(':pcmakemodal', $pcmake);
                          $stmt->bindValue(':os', $os);
                          $stmt->bindValue(':bittype', $arc);
						  $stmt->bindValue(':pcram', $ram);
						  $stmt->bindValue(':pcip', $ip);
						  $stmt->bindValue(':pcsetup', $pcsetup);
						  $stmt->bindValue(':pcbarcasset', $pcbarcasset);
						  $stmt->bindValue(':pcamcid', $pcamcid);
						  $stmt->bindValue(':pcmake_text', $pcmake_text);
						  $stmt->bindValue(':pcmodel_text', $pcmodel_text);
						  $stmt->bindValue(':pc_location', $pc_location);
						  $stmt->bindValue(':ip', $client_ip);
						  $stmt->bindValue(':empuserautoID', $_SESSION['loggedinby']);
						  $result = $stmt->execute();	
						 	// get id and add to pc history
							  $u = $_SESSION['loggedinby'];						
							  $sql_h = "SELECT * from tbl_pc_details WHERE `pc_location` = '$pc_location' AND `pc_use` = '$pcuse' AND `pc_hdd` = '$pchdd' AND `pc_source` = '$pc_purchase' AND `pc_make_model` = $pcmake AND `pc_make` = '$pcmake_text' AND `pc_processor_details` = '$pcmodel_text' AND `pc_os` = $os AND `pc_bit_type` = '$arc' AND `pc_ram_value` = $ram AND  `pc_ip` = '$ip' AND `pc_setup` = '$pcsetup' AND `pc_barc_asset_id` = '$pcbarcasset' AND `pc_amc_id` = '$pcamcid' AND `pc_user_emp` = $u AND `updatedbyip` = '$client_ip'"; 
							  $stmt_h= $this->db->prepare($sql_h);
							  $stmt_h->execute();
							  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
							  $pcautoid = $result_h['autoID'];
							  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Centralize Purchase]PC ADDED BY USER)','');
							// get id and add to pc history 
						  return $result;
		}


		
		public function Indi_addPc($indi_pc_location,$indi_pc_use,$indi_pc_arch,$indi_pc_purchase,$indi_pc_supplier,$indi_indent_no,$indi_indent_dt,$indi_indent_by,$indi_po_no,$indi_po_dt,$indi_rv_no,$indi_rv_dt,$indi_pc_make,$indi_pc_model,$indi_pc_ram,$indi_pc_hdd,$indi_pc_os,$indi_pc_monitor,$indi_pc_cost,$indi_pc_warranty,$indi_pc_warrabty_uptodate,$indi_pc_ip,$indi_pc_setup,$indi_pc_barc_asset_id,$indi_pc_amc_id){
			
			$sql = "INSERT INTO `tbl_pc_details` (`pc_location`,`pc_use`,`pc_source`,`pc_supplier_name`,`pc_indent_no`, `pc_indent_dt`,`pc_indent_by`,`pc_po_no`,`pc_po_dt`,`pc_rv_no`,`pc_rv_dt`,`pc_make`,`pc_processor_details`,`pc_ram_value`,`pc_hdd`,`pc_os`, `pc_monitor_details`,`pc_cost`,`warranty_in_years`,`warranty_till`,`pc_user_emp`,`pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_bit_type`) VALUES (:indi_pc_location,:indi_pc_use,:pc_source,:pc_supplier_name,:indi_indent_no,:indi_indent_dt,:indi_indent_by,:indi_po_no,:indi_po_dt,:indi_rv_no,:indi_rv_dt,:indi_pc_make,:indi_pc_model,:indi_pc_ram,:indi_pc_hdd,:indi_pc_os,:indi_pc_monitor,:indi_pc_cost,:indi_pc_warranty,:indi_pc_warrabty_uptodate,:user_emp,:indi_pc_ip,:indi_pc_setup,:indi_pc_barc_asset_id,:indi_pc_amc_id,:indi_pc_arch)";
												
		   $stmt = $this->db->prepare($sql);

		   				  $stmt->bindValue(':indi_pc_location', $indi_pc_location);
		   				  $stmt->bindValue(':indi_pc_use', $indi_pc_use);
		   				  $stmt->bindValue(':pc_source', $indi_pc_purchase);
                          $stmt->bindValue(':pc_supplier_name', $indi_pc_supplier);
                          $stmt->bindValue(':indi_indent_no', $indi_indent_no);
                          $stmt->bindValue(':indi_indent_dt', $indi_indent_dt);
						  $stmt->bindValue(':indi_indent_by', $indi_indent_by);
						  $stmt->bindValue(':indi_po_no', $indi_po_no);
						  $stmt->bindValue(':indi_po_dt', $indi_po_dt);
						  $stmt->bindValue(':indi_rv_no', $indi_rv_no);
						  $stmt->bindValue(':indi_rv_dt', $indi_rv_dt);
						  $stmt->bindValue(':indi_pc_make', $indi_pc_make);
						  $stmt->bindValue(':indi_pc_model', $indi_pc_model);
						  $stmt->bindValue(':indi_pc_ram', $indi_pc_ram);
						  $stmt->bindValue(':indi_pc_hdd', $indi_pc_hdd);
						  $stmt->bindValue(':indi_pc_os', $indi_pc_os);
						  $stmt->bindValue(':indi_pc_monitor', $indi_pc_monitor);
						  $stmt->bindValue(':indi_pc_cost', $indi_pc_cost);
						  $stmt->bindValue(':indi_pc_warranty', $indi_pc_warranty);
						  $stmt->bindValue(':indi_pc_warrabty_uptodate', $indi_pc_warrabty_uptodate);
						  $stmt->bindValue(':user_emp', $_SESSION['loggedinby']);
						  $stmt->bindValue(':indi_pc_ip', $indi_pc_ip);
						  $stmt->bindValue(':indi_pc_setup', $indi_pc_setup);
						  $stmt->bindValue(':indi_pc_barc_asset_id', $indi_pc_barc_asset_id);
						  $stmt->bindValue(':indi_pc_amc_id', $indi_pc_amc_id);
						  $stmt->bindValue(':indi_pc_arch', $indi_pc_arch);
						  $result = $stmt->execute();
						  // get id and add to pc history
						  $u = $_SESSION['loggedinby'];																																																																																																																																																																					
						  $sql_h = "SELECT `autoID` FROM `tbl_pc_details` WHERE `pc_location` = '$indi_pc_location' AND `pc_use` = '$indi_pc_use' AND `pc_source`  = '$indi_pc_purchase' AND `pc_supplier_name` = '$indi_pc_supplier' AND `pc_indent_no` = '$indi_indent_no' AND  `pc_indent_dt` = '$indi_indent_dt' AND `pc_indent_by` = '$indi_indent_by' AND `pc_po_no` = '$indi_po_no' AND `pc_po_dt` = '$indi_po_dt' AND `pc_rv_no` = '$indi_rv_no' AND `pc_rv_dt` ='$indi_rv_dt' AND `pc_make` = '$indi_pc_make' AND `pc_processor_details` = '$indi_pc_model' AND `pc_ram_value` = '$indi_pc_ram' AND `pc_hdd` = '$indi_pc_hdd' AND `pc_os` = $indi_pc_os AND  `pc_monitor_details` = '$indi_pc_monitor' AND `pc_cost` = '$indi_pc_cost' AND `warranty_in_years` = $indi_pc_warranty AND `warranty_till` = '$indi_pc_warrabty_uptodate' AND `pc_user_emp` = '$u' AND `pc_ip` = '$indi_pc_ip' AND `pc_setup` = '$indi_pc_setup' AND `pc_barc_asset_id` = '$indi_pc_barc_asset_id' AND `pc_amc_id` = '$indi_pc_amc_id' AND `pc_bit_type` ='$indi_pc_arch'";
						  $stmt_h= $this->db->prepare($sql_h);
						  $stmt_h->execute();
						  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
						  $pcautoid = $result_h['autoID'];
						  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Individual/Group Purchase]PC ADDED BY USER)','');
						// get id and add to pc history 
						 return $result;
		}




		public function Borrow_addPc($borrow_pc_location,$borrow_pc_purchase,$borrow_pc_make,$borrow_pc_model,$borrow_pc_arch,$borrow_pc_ram,$borrow_pc_hdd,$borrow_pc_os,$borrow_pc_monitor,$borrow_pc_ip,$borrow_pc_setup, $borrow_pc_barc_asset_id,$borrow_pc_amc_id,$borrow_pc_use){
			
			$sql = "INSERT INTO `tbl_pc_details` (`pc_location`,`pc_use`,`pc_source`,`pc_make`,`pc_processor_details`,`pc_ram_value`,`pc_hdd`,`pc_os`, `pc_monitor_details`,`pc_user_emp`,`pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_bit_type`) VALUES (:borrow_pc_location,:borrow_pc_use,:borrow_pc_purchase,:borrow_pc_make,:borrow_pc_model,:borrow_pc_ram,:borrow_pc_hdd,:borrow_pc_os,:borrow_pc_monitor,:user_emp,:borrow_pc_ip,:borrow_pc_setup,:borrow_pc_barc_asset_id,:borrow_pc_amc_id,:borrow_pc_arch)";
						
		   $stmt = $this->db->prepare($sql);

		   				  $stmt->bindValue(':borrow_pc_location', $borrow_pc_location);
		   				  $stmt->bindValue(':borrow_pc_use', $borrow_pc_use);
		   				  $stmt->bindValue(':borrow_pc_purchase', $borrow_pc_purchase);
						  $stmt->bindValue(':borrow_pc_make', $borrow_pc_make);
						  $stmt->bindValue(':borrow_pc_model', $borrow_pc_model);
						  $stmt->bindValue(':borrow_pc_ram', $borrow_pc_ram);
						  $stmt->bindValue(':borrow_pc_hdd', $borrow_pc_hdd);
						  $stmt->bindValue(':borrow_pc_os', $borrow_pc_os);
						  $stmt->bindValue(':borrow_pc_monitor', $borrow_pc_monitor);
						  $stmt->bindValue(':user_emp', $_SESSION['loggedinby']);
						  $stmt->bindValue(':borrow_pc_ip', $borrow_pc_ip);
						  $stmt->bindValue(':borrow_pc_setup', $borrow_pc_setup);
						  $stmt->bindValue(':borrow_pc_barc_asset_id', $borrow_pc_barc_asset_id);
						  $stmt->bindValue(':borrow_pc_amc_id', $borrow_pc_amc_id);
						  $stmt->bindValue(':borrow_pc_arch', $borrow_pc_arch);
						  $result = $stmt->execute();
						  // get id and add to pc history
						  $u = $_SESSION['loggedinby'];																																																																																																																																																																			
						  $sql_h = "SELECT `autoID` FROM `tbl_pc_details` WHERE `pc_location` = '$borrow_pc_location' AND `pc_use` = '$borrow_pc_use' AND `pc_source`  = '$borrow_pc_purchase' AND `pc_make` = '$borrow_pc_make' AND `pc_processor_details` = '$borrow_pc_model' AND `pc_ram_value` = '$borrow_pc_ram' AND `pc_hdd` = '$borrow_pc_hdd' AND `pc_os` = $borrow_pc_os AND  `pc_monitor_details` = '$borrow_pc_monitor' AND `pc_user_emp` = '$u' AND `pc_ip` = '$borrow_pc_ip' AND `pc_setup` = '$borrow_pc_setup' AND `pc_barc_asset_id` = '$borrow_pc_barc_asset_id' AND `pc_bit_type` ='$borrow_pc_arch'";
						  $stmt_h= $this->db->prepare($sql_h);
						  $stmt_h->execute();
						  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
						  $pcautoid = $result_h['autoID'];
						  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Borrowed]PC ADDED BY USER)','');
						// get id and add to pc history 
                          return $result;
		}

		public function add_pctransactionhistory($pcautoid,$o,$f,$t,$r,$q){
			//$q1 = stripslashes($q);
			$sql_i = "INSERT INTO pc_transaction_log (`pc_table_id`, `action`,`pc_from`,`pc_to`,`pc_remark`,`transaction_query`) VALUES (:pcid,:action,:f,:t,:r,:q)";
			$stmt_i = $this->db->prepare($sql_i);
			$stmt_i->bindValue(':pcid', $pcautoid);
			$stmt_i->bindValue(':action', $o);
			$stmt_i->bindValue(':f', $f);
			 $stmt_i->bindValue(':t', $t);
			 $stmt_i->bindValue(':r', $r);
			 $stmt_i->bindValue(':q', $q);
			$result_i = $stmt_i->execute();
			return $result_i;
		}


		////// REGISTER USER ///////
		public function checkAlloweduser($empno){
			$chkusql = "SELECT * FROM tbl_temp_users WHERE emp_no = :empno";
			$stmt = $this->db->prepare($chkusql);
			$stmt->bindParam(':emp_no', $empno);
			$stmt->execute();
			if($stmt->rowCount() > 0){	
				return 1; // Allow to register
			}else{
				return 0; // Dont allow to register
			}
		
	  } // function end check emp


	  public function registerUser($empno,$empname,$empemail,$emppass){ // NOT USED YET
		$pass = sha1($emppass);
		$sql = "INSERT INTO `tbl_users` (`pc_make_model`, `pc_os`, `pc_bit_type`,`pc_ram_value`, `pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_user_emp`) VALUES (:pcmakemodal,:os,:bittype,:pcram,:pcip,:pcsetup,:pcbarcasset,:pcamcid,:empuserautoID)";
	   $stmt = $this->db->prepare($sql);
						 
					  $stmt->bindValue(':pcmakemodal', $pcmake);
					  $stmt->bindValue(':os', $os);
					  $stmt->bindValue(':bittype', $arc);
					  $stmt->bindValue(':pcram', $ram);
					  $stmt->bindValue(':pcip', $ip);
					  $stmt->bindValue(':pcsetup', $pcsetup);
					  $stmt->bindValue(':pcbarcasset', $pcbarcasset);
					  $stmt->bindValue(':pcamcid', $pcamcid);
					  $stmt->bindValue(':empuserautoID', $_SESSION['loggedinby']);
					  $result = $stmt->execute();
					  return $sql;
	}

	///////////////// GROUP APPROVAL /////////////////
	public function getgrouppc(){
		//$sql = "SELECT a.groupadmin_approvedon,a.pc_added_on,u.emp_title, u.emp_name,b.pc_make, b.pc_model,o.os_name,o.os_of,a.pc_make_model,a.autoID,a.pc_os,a.pc_product_id,a.pc_system_model,a.pc_bit_type,a.pc_ram_value,a.pc_nic_number,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,pc_amc_id,a.pc_rv_no,a.pc_rv_dt,a.pc_indented_by,a.pc_source_purchase,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_till from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID JOIN tbl_pc_make as b ON a.pc_make_model = b.autoID JOIN tbl_users as u ON a.pc_user_emp = u.emp_no WHERE sysadmin_approval = 0 ORDER BY pc_added_on ASC";
		$id = $_SESSION['loggedinby_groupID'];
		$sql = "SELECT a.rvfilename,a.rvfileuploaded,o.os_name,o.os_of,u.emp_no, u.emp_title, u.emp_name,u.emp_desig,a.pc_make_model,a.pc_supplier_name,a.pc_indent_no,a.pc_indent_dt,a.pc_indent_by,a.autoID,a.pc_os,a.pc_make,a.pc_processor_details,a.pc_monitor_details,a.pc_bit_type,a.pc_ram_value,a.pc_hdd,a.pc_nic_number,a.pc_setup,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,a.pc_amc_id,a.pc_po_no,a.pc_po_dt,a.pc_rv_no,a.pc_rv_dt,a.pc_cost,a.pc_source,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.pc_added_on, a.isdeleted FROM tbl_pc_details as a JOIN tbl_users as u ON u.emp_no = a.pc_user_emp JOIN tbl_pc_os as o ON o.autoID = a.pc_os AND a.pc_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) AND a.isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}


	///////////////// ADMIN APPROVAL /////////////////
	public function getupapproved(){
		$sql = "SELECT a.rvfilename,a.rvfileuploaded,o.os_name,o.os_of,u.emp_no, u.emp_title, u.emp_name,u.emp_desig,a.pc_make_model,a.pc_supplier_name,a.pc_indent_no,a.pc_indent_dt,a.pc_indent_by,a.autoID,a.pc_os,a.pc_make,a.pc_processor_details,a.pc_monitor_details,a.pc_bit_type,a.pc_ram_value,a.pc_hdd,a.pc_nic_number,a.pc_setup,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,a.pc_amc_id,a.pc_po_no,a.pc_po_dt,a.pc_rv_no,a.pc_rv_dt,a.pc_cost,a.pc_source,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.pc_added_on, a.isdeleted FROM tbl_pc_details as a JOIN tbl_users as u ON u.emp_no = a.pc_user_emp JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.isdeleted = 0 AND a.groupadmin_approval = 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function getallemp(){
		$sql = "SELECT * FROM tbl_users WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function addPcPurchaseDetail($pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$addedby){ 
		$client_ip = get_client_ip();
		$sql = "INSERT INTO `tbl_pc_make` (`details_of_supplier`,`indent_no`,`indent_dt`,`indentor_emp`,`rv_no`,`rv_dt`,`qty_received`,`pc_make`,`pc_model`,`pc_ram_details`,`pc_hdd_details`,`pc_os_details`,`pc_monitor_details`,`pc_cost`,`warranty_in_years`,`warranty_upto`,`po_no`,`po_dt`,`updatedbyip`,`updatedby`) VALUES (:pc_supplier,:indent_no,:indent_dt,:indent_by,:rv_no,:rv_dt,:rv_qty,:pc_make,:pc_model,:pc_ram,:pc_hdd,:pc_os,:pc_monitor,:pc_cost,:warranty_in_years,:warranty_upto,:po_no,:po_dt,:updatedbyip,:updatedby)";
	    $stmt = $this->db->prepare($sql);
						 
						$stmt->bindValue(':pc_supplier', $pc_supplier);
						$stmt->bindValue(':indent_no', $indent_no);
						$stmt->bindValue(':indent_dt', $indent_dt);
						$stmt->bindValue(':indent_by', $indent_by);
						$stmt->bindValue(':rv_no', $rv_no);
						$stmt->bindValue(':rv_dt', $rv_dt);
						$stmt->bindValue(':rv_qty', $rv_qty);
						$stmt->bindValue(':pc_make', $pc_make);
						$stmt->bindValue(':pc_model', $pc_model);
						$stmt->bindValue(':pc_ram', $pc_ram);
						$stmt->bindValue(':pc_hdd', $pc_hdd);
						$stmt->bindValue(':pc_os', $pc_os);
						$stmt->bindValue(':pc_monitor', $pc_monitor);
						$stmt->bindValue(':pc_cost', $pc_cost);
						$stmt->bindValue(':warranty_in_years', $pc_warranty);
						$stmt->bindValue(':warranty_upto', $pc_warrantyuptodate);
						$stmt->bindValue(':po_no', $po_no);
						$stmt->bindValue(':po_dt', $po_dt);
						$stmt->bindValue(':updatedby',$addedby);
						$stmt->bindValue(':updatedbyip', $client_ip);
					   $result = $stmt->execute();
					   return  $result;
	}

	public function editPcPurchaseDetail($pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$loggedinby,$uid){ 
		$client_ip = get_client_ip();
		$sql = "UPDATE `tbl_pc_make` SET `details_of_supplier` = '$pc_supplier',`indent_no` = '$indent_no',`indent_dt`= '$indent_dt',`indentor_emp` = '$indent_by', `rv_no`= '$rv_no',`rv_dt`= '$rv_dt',`qty_received`= $rv_qty,`pc_make`='$pc_make',`pc_model` = '$pc_model',`pc_ram_details` = '$pc_ram',`pc_hdd_details` = '$pc_hdd',`pc_os_details` = $pc_os,`pc_monitor_details` = '$pc_monitor',`pc_cost` = '$pc_cost',`warranty_in_years` = $pc_warranty,`warranty_upto` = '$pc_warrantyuptodate',`po_no` = '$po_no',`po_dt`= '$po_dt',`updatedbyip` = '$client_ip',`updatedby` = '$loggedinby' WHERE autoID = $uid";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function getpcpurchasedetails(){
		$sql = "SELECT * FROM tbl_pc_make WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function deletepurchasedetail($id){
		$sql = "UPDATE tbl_pc_make SET isdeleted = 1 WHERE autoID = $id";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}


	public function getAddedRecord($pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$addedby){ 
		$sql = "SELECT * from tbl_pc_make WHERE `details_of_supplier` = '$pc_supplier' AND `indent_no` ='$indent_no' AND `indent_dt` = '$indent_dt' AND `indentor_emp`='$indent_by' AND `rv_no` ='$rv_no' AND `rv_dt` = '$rv_dt' AND `qty_received` = $rv_qty  AND `pc_make` ='$pc_make' AND `pc_model` ='$pc_model' AND `pc_ram_details` = '$pc_ram' AND `pc_hdd_details` ='$pc_hdd' AND  `pc_os_details` ='$pc_os' AND `pc_monitor_details` ='$pc_monitor' AND `pc_cost` ='$pc_cost' AND `warranty_in_years` = $pc_warranty AND `warranty_upto` = '$pc_warrantyuptodate' AND `po_no` = '$po_no' AND `po_dt`= '$po_dt' ORDER BY autoID DESC LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['autoID'];
		//return $sql;
	}

										
	public function indigetAddedRecord($indi_pc_location,$indi_pc_use,$indi_pc_arch,$indi_pc_purchase,$indi_pc_supplier,$indi_indent_no,$indi_indent_dt,$indi_indent_by,$indi_po_no,$indi_po_dt,$indi_rv_no,$indi_rv_dt,$indi_pc_make,$indi_pc_model,$indi_pc_ram,$indi_pc_hdd,$indi_pc_os,$indi_pc_monitor,$indi_pc_cost,$indi_pc_warranty,$indi_pc_warrabty_uptodate,$indi_pc_ip,$indi_pc_setup,$indi_pc_barc_asset_id,$indi_pc_amc_id){
		$sql = "SELECT * from tbl_pc_details WHERE `pc_location` = '$indi_pc_location' AND `pc_use` = '$indi_pc_use' AND `pc_source`= '$indi_pc_purchase' AND `pc_supplier_name`= '$indi_pc_supplier' AND `pc_indent_no`= '$indi_indent_no' AND `pc_indent_dt`= '$indi_indent_dt' AND `pc_indent_by`= '$indi_indent_by' AND `pc_po_no`= '$indi_po_no' AND `pc_po_dt`= '$indi_po_dt' AND `pc_rv_no`= '$indi_rv_no' AND `pc_rv_dt`= '$indi_rv_dt' AND `pc_make`= '$indi_pc_make' AND `pc_processor_details`= '$indi_pc_model' AND `pc_ram_value`= '$indi_pc_ram' AND `pc_hdd`= '$indi_pc_hdd' AND `pc_os`= '$indi_pc_os' AND `pc_monitor_details`= '$indi_pc_monitor' AND `pc_cost`= '$indi_pc_cost' AND `warranty_till`= '$indi_pc_warrabty_uptodate' AND `pc_ip`= '$indi_pc_ip' AND `pc_setup`= '$indi_pc_setup' AND `pc_barc_asset_id`= '$indi_pc_barc_asset_id' AND `pc_amc_id`= '$indi_pc_amc_id' AND `pc_bit_type`= '$indi_pc_arch' ORDER BY autoID DESC LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['autoID'];
		//return $sql;
	}
	

	public function borrowgetAddedRecord($borrow_pc_location,$borrow_pc_purchase,$borrow_pc_make,$borrow_pc_model,$borrow_pc_arch,$borrow_pc_ram,$borrow_pc_hdd,$borrow_pc_os,$borrow_pc_monitor,$borrow_pc_ip,$borrow_pc_setup, $borrow_pc_barc_asset_id,$borrow_pc_amc_id,$borrow_pc_use){
			
		$sql = "SELECT * FROM `tbl_pc_details` WHERE `pc_location`='$borrow_pc_location' AND `pc_use` = '$borrow_pc_use' AND `pc_source` ='$borrow_pc_purchase' AND `pc_make` = '$borrow_pc_make' AND  `pc_processor_details` = '$borrow_pc_model' AND `pc_ram_value` ='$borrow_pc_ram'  AND `pc_hdd` = '$borrow_pc_hdd' AND `pc_os` = $borrow_pc_os AND `pc_monitor_details` = '$borrow_pc_monitor' AND `pc_ip` = '$borrow_pc_ip' AND `pc_setup` = '$borrow_pc_setup' AND `pc_barc_asset_id` = '$borrow_pc_barc_asset_id' AND `pc_amc_id` = '$borrow_pc_amc_id' AND `pc_bit_type` ='$borrow_pc_arch'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['autoID'];
		//return $sql;
	}

	// RV copy details update for centralize
public function updfiledetails($f,$i){
	$sql = "UPDATE `tbl_pc_make` SET `rvfileuploaded`= 1, `rvfilename` =:rv_filename WHERE autoID =:id";
   $stmt = $this->db->prepare($sql);
	$stmt->bindValue(':rv_filename', $f);
	$stmt->bindValue(':id', $i);  
	$result = $stmt->execute();
	return $result;
}
// RV copy details update


	// RV copy details update for centralize
	public function updfiledetails_indi($f,$i){
		$sql = "UPDATE `tbl_pc_details` SET `rvfileuploaded`= 1, `rvfilename` =:rv_filename WHERE autoID =:id";
	   $stmt = $this->db->prepare($sql);
		$stmt->bindValue(':rv_filename', $f);
		$stmt->bindValue(':id', $i);  
		$result = $stmt->execute();
		return $result;
	}
	// RV copy details update


	public function get_purchase_detail($id){
		$sql = "SELECT * FROM tbl_pc_make WHERE autoID = $id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result; 
	}	


	//Personal PC


	public function deletepersonalpc($id){
		$sql = "UPDATE tbl_pc_details SET isdeleted = 1 WHERE autoID = $id";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function getpcmakemodel(){
		$data = array();
		$sql = "SELECT * FROM tbl_pc_make WHERE isdeleted = 0";
		//echo $sql;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function getautofilldata(){
		$data = array();
		$sql = "SELECT `pc_make` FROM tbl_pc_make WHERE isdeleted = 0";
		//echo $sql;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function getpcmakebyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['pc_make'];
	}

	public function getpcmodelbyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['pc_model'];
	}

	public function getsinglepcdetails($id){
		$sql = "SELECT * from tbl_pc_details WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result; 
	}
	//							hid_autoID,	ecenp_pc_make, ecenp_pc_os,ecenp_pc_arch,ecenp_ppc_ram,ecenp_pc_hdd,ecenp_pc_ip,ecenp_pc_setup,ecenp_pc_barc_asset_id,ecenp_pc_amc_id,ecenp_pc_use,ecenp_pc_location,ecenp_pc_make_text,ecenp_pc_model_text
	public function edit_cenp_Pc($hid_autoID, $ecenp_pc_make, $ecenp_pc_os, $ecenp_pc_arch, $ecenp_pc_ram,$ecenp_pc_hdd, $ecenp_pc_ip,$ecenp_pc_setup,$ecenp_pc_barc_asset_id,$ecenp_pc_amc_id,$ecenp_pc_use,$ecenp_pc_location,$ecenp_pc_make_text,$ecenp_pc_model_text){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `pc_make_model` = $ecenp_pc_make,`pc_os` = $ecenp_pc_os,`pc_make`= '$ecenp_pc_make_text',`pc_processor_details` = '$ecenp_pc_model_text', `pc_bit_type`= '$ecenp_pc_arch',`pc_ram_value`= '$ecenp_pc_ram',`pc_hdd`= '$ecenp_pc_hdd',`pc_setup`='$ecenp_pc_setup',`pc_ip` = '$ecenp_pc_ip',`pc_barc_asset_id` = '$ecenp_pc_barc_asset_id',`pc_amc_id` = '$ecenp_pc_amc_id',`pc_use` = '$ecenp_pc_use',`pc_location` = '$ecenp_pc_location',`updatedbyip` = '$client_ip', `groupadmin_approval` = 0, `sysadmin_approval` = 0 WHERE autoID = $hid_autoID";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($hid_autoID,"UPDATED",0,$loggedinby,"[Centralize Purchase]PC UPDATED BY USER)",$sql);
		// record history
		return  $result;
	}

	//											
	public function edit_indip_Pc($eindi_hid_autoID, $e_indi_pc_supplier, $e_indi_indent_no, $e_indi_indent_dt, $e_indi_indent_by,$e_indi_po_no, $e_indi_po_dt,$e_indi_rv_no,$e_indi_rv_dt,$e_indi_pc_cost,$e_indi_pc_warranty,$e_indi_pc_warrabty_uptodate,$e_indi_pc_make,$e_indi_pc_model,$e_indi_pc_ram,$e_indi_pc_hdd,$e_indi_pc_os,$e_indi_pc_monitor,$e_indi_pc_ip,$e_indi_pc_setup,$e_indi_pc_barc_asset_id,$e_indi_pc_amc_id,$e_indi_pc_use,$e_indi_pc_location,$e_indi_pc_arch){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `pc_supplier_name` = '$e_indi_pc_supplier',`pc_indent_no` = '$e_indi_indent_no',`pc_indent_dt`= '$e_indi_indent_dt',`pc_indent_by` = '$e_indi_indent_by', `pc_rv_no`= '$e_indi_rv_no',`pc_rv_dt`= '$e_indi_rv_dt',`pc_po_no`= '$e_indi_po_no',`pc_po_dt`='$e_indi_po_dt',`pc_cost` = '$e_indi_pc_cost',`warranty_in_years` = $e_indi_pc_warranty,`warranty_till` = '$e_indi_pc_warrabty_uptodate',`pc_make` = '$e_indi_pc_make',`pc_processor_details` = '$e_indi_pc_model', `pc_monitor_details` = '$e_indi_pc_monitor',`pc_ip` = '$e_indi_pc_ip', `pc_bit_type` = '$e_indi_pc_arch', `pc_setup` = '$e_indi_pc_setup', `pc_ram_value` = '$e_indi_pc_ram', `pc_hdd` = '$e_indi_pc_hdd', `pc_os` = '$e_indi_pc_os' ,`pc_barc_asset_id` = '$e_indi_pc_barc_asset_id', `pc_amc_id` = '$e_indi_pc_amc_id',`pc_location` = '$e_indi_pc_location',`groupadmin_approval` = 0, `sysadmin_approval` = 0 WHERE autoID = $eindi_hid_autoID";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($eindi_hid_autoID,"UPDATED",0,$loggedinby,"[Individual/Group Purchase]PC UPDATED BY USER)",$sql);
		// record history
		return  $result;
	}

	public function edit_borrowp_Pc($eborro_hid_autoID, $e_borrow_pc_make,$e_borrow_pc_model,$e_borrow_pc_arch,$e_borrow_pc_ram,$e_borrow_pc_hdd,$e_borrow_pc_os,$e_borrow_pc_monitor,$e_borrow_pc_ip,$e_borrow_pc_setup,$e_borrow_pc_barc_asset_id,$e_borrow_pc_amc_id,$e_borrow_pc_use,$e_borrow_pc_location){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `pc_make` = '$e_borrow_pc_make',`pc_processor_details` = '$e_borrow_pc_model', `pc_monitor_details` = '$e_borrow_pc_monitor',`pc_ip` = '$e_borrow_pc_ip', `pc_bit_type` = '$e_borrow_pc_arch', `pc_setup` = '$e_borrow_pc_setup', `pc_ram_value` = '$e_borrow_pc_ram', `pc_hdd` = '$e_borrow_pc_hdd', `pc_os` = '$e_borrow_pc_os' ,`pc_barc_asset_id` = '$e_borrow_pc_barc_asset_id', `pc_amc_id` = '$e_borrow_pc_amc_id',`pc_location` = '$e_borrow_pc_location',`pc_use` ='$e_borrow_pc_use',`groupadmin_approval` = 0, `sysadmin_approval` = 0 WHERE autoID = $eborro_hid_autoID AND isdeleted = 0";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($eborro_hid_autoID,"UPDATED",0,$loggedinby,"[Borrowed]PC UPDATED BY USER)",$sql);
		// record history
		return  $result;
	}

	public function groupadminapproval($id){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_pc_details SET `groupadmin_approval` = 1, `groupadmin_approvedon` = CURRENT_TIMESTAMP, `groupadmin_approved_by` = '$loggedinby' WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	
	public function adminapprovepc($id){
		$sql = "UPDATE tbl_pc_details SET sysadmin_approval = 1, `sysadmin_approvedon` = CURRENT_TIMESTAMP WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function getallunits(){
		$sql = "SELECT * FROM `tbl_groups` ORDER BY FIELD (autoID,10,1,2,3,4,5,6,7,8,9)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function userbyunit($id){
		$sql = "SELECT a.autoID,a.emp_no,a.emp_title,a.emp_cc,a.emp_name,a.emp_desig,a.emp_dob,a.emp_gender,a.emp_grp_autoID,a.emp_sitting_place,a.emp_extn,a.emp_mob,a.emp_alternate_mob,a.emp_e_email,a.emp_o_email,a.emp_shift_autoID,a.isactive,a.firsttimelogin,a.activatedon,a.isdeleted,a.updatedon,a.updatedbyip,a.emp_pass,a.user_type,b.shift_name FROM `tbl_users` as a JOIN tbl_shift as b ON b.autoID = a.emp_shift_autoID WHERE a.emp_grp_autoID = $id AND a.user_type = 'user' ORDER BY a.emp_no ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getnoofemp_unit($id){
		$sql = "SELECT COUNT(*) as cnt FROM `tbl_users` WHERE `emp_grp_autoID` = $id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
	}


	public function getunit_head($id){
		$sql = "SELECT * FROM `tbl_users` WHERE `emp_grp_autoID` = $id AND `user_type` = 'groupadmin'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getalldetails($id){
		$sql = "SELECT * from tbl_users WHERE emp_no=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result; 
	}

	
	public function getallgroups(){
		$sql = "SELECT * FROM tbl_groups WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function updategroupofemp($id,$grp){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_users SET `emp_grp_autoID` = $grp WHERE emp_no = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function getalldevicedetails($id){
		//$sql = "SELECT o.os_name,o.os_of,,b.pc_make, b.pc_model FROM tbl_pc_details as a JOIN tbl_pc_make as b ON a.pc_make_model = b.autoID JOIN tbl_pc_os as o ON a.pc_os = o.autoID WHERE a.pc_user_emp =$id";
		$sql = "SELECT a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os ,a.pc_make, a.pc_processor_details, a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  WHERE a.pc_user_emp =$id and a.isdeleted = 0 AND a.current_status = 1";
		//$sql="SELECT * from tbl_pc_details WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	

	public function getallrightsdetails($id){
		//$sql = "SELECT a.autoID, a.menu_group, a.menu_name, a.menu_url, a.menu_icon FROM tbl_menu as a JOIN tbl_menu_permission as b ON a.autoID = b.menuID JOIN tbl_users as c ON c.autoID  = b.userID WHERE a.isdeleted = 0 AND c.isdeleted = 0 AND c.emp_no = $id";
		$sql = "(SELECT autoID,menu_group,menu_name,menu_url,menu_icon, IF(1>0,'1','0') as cond  FROM tbl_menu WHERE autoID IN (SELECT p.menuID FROM tbl_menu_permission as p JOIN tbl_users as u ON u.autoID = p.userID WHERE u.emp_no = $id) ORDER BY menu_group) UNION SELECT autoID,menu_group,menu_name,menu_url,menu_icon, IF(0>1,'1','0') as cond  FROM tbl_menu WHERE autoID NOT IN (SELECT p.menuID FROM tbl_menu_permission as p JOIN tbl_users as u ON u.autoID = p.userID WHERE u.emp_no = $id) ORDER BY menu_group DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}


	public function unset_right($id,$foremp){
		$sql = "DELETE FROM tbl_menu_permission WHERE menuID = $id AND userID = (SELECT autoID FROM tbl_users WHERE emp_no = $foremp)";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function set_right($id,$emp){

		// find userid
		$chksql = "SELECT autoID FROM tbl_users WHERE emp_no = $emp AND isdeleted = 0";
		$stmtchk = $this->db->prepare($chksql);
		$resultchk = $stmtchk->fetch(PDO::FETCH_ASSOC);
		$uid = $resultchk['autoID'];
		// find userid
		$loggedinby = $_SESSION['loggedinby'];
		$client_ip = get_client_ip();
		$sql = "INSERT INTO tbl_menu_permission (userID,menuID,updatedby,updatedbyip) VALUES ((SELECT autoID FROM tbl_users WHERE emp_no = $emp AND isdeleted = 0),$id,$loggedinby,'$client_ip')";
	    $stmt = $this->db->prepare($sql);
		$result = $stmt->execute();
		return  $result;
	}
	
	public function getactivationdetails($id){
		$sql = "SELECT * FROM tbl_users WHERE emp_no = $id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}


	public function in_activate_user($foremp){
		$sql = "UPDATE tbl_users SET isactive = 0 WHERE emp_no = $foremp AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function activate_user($foremp){
		$sql = "UPDATE tbl_users SET isactive = 1 WHERE emp_no = $foremp AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function updateemp_profile($emp_title,$emp_name,$emp_dob,$emp_no,$emp_desig,$emp_cc,$emp_sec,$emp_sp,$emp_email,$emp_oemail,$emp_phone,$emp_mobile,$emp_shift){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_users` SET `emp_sitting_place` = '$emp_sp',`emp_extn` = '$emp_phone',`emp_mob`= '$emp_mobile',`emp_e_email` = '$emp_email', `emp_o_email`= '$emp_oemail',`emp_shift_autoID`= '$emp_shift', `updatedbyip` = '$client_ip',`updatedby` = '$loggedinby' WHERE emp_no = $emp_no";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function pc_move_to_inventory($pcid,$foremp,$rem){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `current_status` = 0, `updatedbyip` = '$client_ip' WHERE autoID = $pcid";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		$result_h = $this->add_pctransactionhistory($pcid,"MOVED TO INVENTORY",$foremp,0,"PC MOVED TO INVENTORY",$sql,$rem);
		return  $result;
	}



}

