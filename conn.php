<?php
ini_set('max_execution_time','300');
set_time_limit(300);
$base = "localhost/aims/";
$rvuploadpath = 'uploads/rvcopy/';
		$app_name = "AIMS";
		$appname_full = "Asset & Inventory Management System";
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
			$dbname = "aims_vtn";
			$username = "root";             
			$password = "";
			$this->db = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
		}


		// register function 
	public function changePassword($empno,$password){
		if(empty($password)){
		 return "Please provide Emp. No. and Password";
		}else{
			$client_ip = get_client_ip();
			$pass = sha1($password);
			$chksql = "UPDATE `tbl_users` SET `emp_pass` = '$pass', `firsttimelogin` = 1, `registeredusingIP` = '$client_ip'  WHERE emp_no = $empno";
			$stmt = $this->db->prepare($chksql);
			$stmt->execute();
			return 1;
		}
	  } 



		// login function 
	public function validateUser($empno,$password){
		$pass="";
		$chksql = "";
		if(empty($password)){
		 return "Please provide Emp. No. and Password";
		}else{
			if(strlen($password)>39){
				// may be first time user
				$pass = $password;
			}
			else{
				$pass = sha1($password);
			}
			$chksql = "SELECT * FROM tbl_users WHERE emp_no = :empno AND emp_pass = :pass AND isactive = 1";
			$stmt = $this->db->prepare($chksql);
			$stmt->bindParam(':empno', $empno);  
			$stmt->bindParam(':pass', $pass);
			$stmt->execute();
			
			if($stmt->rowCount() > 0){
				session_start();
				if(!isset($_SESSION['loggedinby'])){
					$_SESSION['loggedinby'] = $empno;
				}
				// getting details
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['loggedinby_type'] = $result['user_type'];
				$_SESSION['loggedinby_autoID'] = $result['autoID'];
				$_SESSION['loggedinby_groupID'] = $result['emp_grp_autoID'];
				$ftl = $result['firsttimelogin'];
				// getting details
				if ($ftl > 0){ // not first time login
					return $stmt->rowCount();
				}else{ // first time login
					return 2;
				}
				
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

		public function addmachine($rack,$kvmid,$servername,$serverip,$serveros,$osversion){
			$sql = "INSERT INTO tbl_servers (server_rack,kvmid,server_name,server_ip,server_os,os_version) VALUES ('$rack',$kvmid,'$servername','$serverip','$serveros','$osversion')";
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
			$sql = "SELECT u.autoID,u.emp_no,u.emp_title,u.emp_name,u.emp_gender,u.emp_desig,u.emp_cc,u.emp_dob,u.emp_o_email,u.emp_mob,u.emp_e_email,u.emp_sitting_place,u.emp_extn,u.emp_pass,u.emp_grp_autoID,u.isactive, g.grp_name FROM tbl_users as u JOIN tbl_groups as g ON g.autoID = u.emp_grp_autoID WHERE u.autoID = $sessid";
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
			/* if(!isset($_SESSION['loggedinby'])){
				session_start();
			}else{
				
			} */
			if(isset($_SESSION['loggedinby'])){
				
				$uid = $_SESSION['loggedinby'];
			}else{
				$uid = 0;
			}
			$client_ip = get_client_ip();
            $sql = "INSERT INTO `tbl_transactions` (`script_name`, `user_id`, `action`,`byip`) VALUES (:scriptname,:userid,:useraction,:ip)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':scriptname', $_SERVER['PHP_SELF']);
            $stmt->bindValue(':userid', $uid);
            $stmt->bindValue(':useraction', $useraction);
			$stmt->bindValue(':ip', $client_ip);
			$result = $stmt->execute();
            return $sql;
		}


		public function log_printing_binding($id,$action,$actionby){
			/* if(!isset($_SESSION['loggedinby'])){
				session_start();
			}else{
				
			} */
			if(isset($_SESSION['loggedinby'])){
				
				$uid = $_SESSION['loggedinby'];
			}else{
				$uid = 0;
			}
			$client_ip = get_client_ip();

		
            $sql = "INSERT INTO `tbl_printing_log` (`prnt_job_autoID`, `prnt_action`,`action_by`,`ip`) VALUES (:id,:prnt_action,:actionby,:ip)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
			$stmt->bindValue(':prnt_action', $action);
			$stmt->bindValue(':actionby', $actionby);
			$stmt->bindValue(':ip', $client_ip);
			$result = $stmt->execute();
            return $result;
		}

		public function log_activity_non_session($useraction,$emp){
			$client_ip = get_client_ip();
            $sql = "INSERT INTO `tbl_transactions` (`script_name`, `user_id`, `action`,`byip`) VALUES (:scriptname,:emp,:useraction,:ip)";
           $stmt = $this->db->prepare($sql);
		   				  
                          $stmt->bindValue(':scriptname', $_SERVER['PHP_SELF']);
						  $stmt->bindValue(':useraction', $useraction);
						  $stmt->bindValue(':emp', $emp);
						  $stmt->bindValue(':ip', $client_ip);
						  $result = $stmt->execute();
                          return $sql;
		}



		///////////////////PC details/////////////////////
		public function getalluserpcs($id){
			$sql = "SELECT working,a.pc_form,a.pc_make, a.pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID LEFT JOIN tbl_pc_make as pur ON pur.autoID <> a.pc_make_model WHERE a.pc_user_emp = $id and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source <> 'Centralize' UNION SELECT working,pur.pc_form,pur.pc_make, pur.pc_model as pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_user_emp =$id and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source = 'Centralize' ";		
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

		// check IP modified on 17-10-23
public function checkip($ip){
		
	if (strpos($ip, "n") !== false OR strpos($ip, "N") !== false) { 
		return 1; // OK..proceed
	}else{
		$sql = "SELECT * FROM tbl_pc_details WHERE pc_ip = :ip AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':ip', $ip);
		$stmt->execute();
		if($stmt->rowCount() > 0){	
		return 0; // IP already taken
		}else{
			return 1; // OK..proceed
		}
	
	}

	
} // function end check IP


		public function addPc($pcworking,$pcssd,$pc_location,$pcuse,$pchdd,$pc_purchase,$pcmake,$os,$arc,$ram,$ip,$pcsetup,$pcbarcasset,$pcamcid){
			
            $sql = "INSERT INTO `tbl_pc_details` (`working`,`pc_ssd`,`pc_location`,`pc_use`,`pc_hdd`,`pc_source`,`pc_make_model`, `pc_os`, `pc_bit_type`,`pc_ram_value`, `pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_user_emp`,`updatedbyip`) VALUES (:working,:pc_ssd,:pc_location,:pc_use,:pc_hdd,:pc_purchase,:pcmakemodal,:os,:bittype,:pcram,:pcip,:pcsetup,:pcbarcasset,:pcamcid,:empuserautoID,:ip)";								
			$stmt = $this->db->prepare($sql);
						$client_ip = get_client_ip();
						$stmt->bindValue(':working', $pcworking);
						  $stmt->bindValue(':pc_ssd', $pcssd);
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
						  $stmt->bindValue(':pc_location', $pc_location);
						  $stmt->bindValue(':ip', $client_ip);
						  $stmt->bindValue(':empuserautoID', $_SESSION['loggedinby']);
						  $result = $stmt->execute();	
						 	// get id and add to pc history
							  $u = $_SESSION['loggedinby'];						
							  $sql_h = "SELECT * from tbl_pc_details WHERE `pc_location` = '$pc_location' AND `pc_use` = '$pcuse' AND `pc_hdd` = '$pchdd' AND `pc_source` = '$pc_purchase' AND `pc_make_model` = $pcmake AND `pc_os` = $os AND `pc_bit_type` = '$arc' AND `pc_ram_value` = $ram AND  `pc_ip` = '$ip' AND `pc_setup` = '$pcsetup' AND `pc_barc_asset_id` = '$pcbarcasset' AND `pc_amc_id` = '$pcamcid' AND `pc_user_emp` = $u AND `updatedbyip` = '$client_ip'"; 
							  $stmt_h= $this->db->prepare($sql_h);
							  $stmt_h->execute();
							  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
							  $pcautoid = $result_h['autoID'];
							  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Centralize Purchase]PC ADDED BY USER)','','');
							// get id and add to pc history 
						  return $result;
		}


		
		public function Indi_addPc($pc_working,$indi_pc_location,$indi_pc_use,$indi_pc_arch,$indi_pc_purchase,$indi_pc_supplier,$indi_indent_no,$indi_indent_dt,$indi_indent_by,$indi_po_no,$indi_po_dt,$indi_rv_no,$indi_rv_dt,$indi_pc_make,$indi_pc_model,$indi_pc_ram,$indi_pc_hdd,$indi_pc_os,$indi_pc_monitor,$indi_pc_cost,$indi_pc_warranty,$indi_pc_warrabty_uptodate,$indi_pc_ip,$indi_pc_setup,$indi_pc_barc_asset_id,$indi_pc_amc_id,$pcform){
			
			$sql = "INSERT INTO `tbl_pc_details` (`working`,`pc_location`,`pc_use`,`pc_source`,`pc_supplier_name`,`pc_indent_no`, `pc_indent_dt`,`pc_indent_by`,`pc_po_no`,`pc_po_dt`,`pc_rv_no`,`pc_rv_dt`,`pc_make`,`pc_processor_details`,`pc_ram_value`,`pc_hdd`,`pc_os`, `pc_monitor_details`,`pc_cost`,`warranty_in_years`,`warranty_till`,`pc_user_emp`,`pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_bit_type`,`pc_form`) VALUES (:working,:indi_pc_location,:indi_pc_use,:pc_source,:pc_supplier_name,:indi_indent_no,:indi_indent_dt,:indi_indent_by,:indi_po_no,:indi_po_dt,:indi_rv_no,:indi_rv_dt,:indi_pc_make,:indi_pc_model,:indi_pc_ram,:indi_pc_hdd,:indi_pc_os,:indi_pc_monitor,:indi_pc_cost,:indi_pc_warranty,:indi_pc_warrabty_uptodate,:user_emp,:indi_pc_ip,:indi_pc_setup,:indi_pc_barc_asset_id,:indi_pc_amc_id,:indi_pc_arch,:pcform)";
												
		   $stmt = $this->db->prepare($sql);
		   				  $stmt->bindValue(':working', $pc_working);
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
						  $stmt->bindValue(':pcform', $pcform);
						  $result = $stmt->execute();
						  // get id and add to pc history
						  $u = $_SESSION['loggedinby'];																																																																																																																																																																					
						  $sql_h = "SELECT `autoID` FROM `tbl_pc_details` WHERE `pc_location` = '$indi_pc_location' AND `pc_use` = '$indi_pc_use' AND `pc_source`  = '$indi_pc_purchase' AND `pc_supplier_name` = '$indi_pc_supplier' AND `pc_indent_no` = '$indi_indent_no' AND  `pc_indent_dt` = '$indi_indent_dt' AND `pc_indent_by` = '$indi_indent_by' AND `pc_po_no` = '$indi_po_no' AND `pc_po_dt` = '$indi_po_dt' AND `pc_rv_no` = '$indi_rv_no' AND `pc_rv_dt` ='$indi_rv_dt' AND `pc_make` = '$indi_pc_make' AND `pc_processor_details` = '$indi_pc_model' AND `pc_ram_value` = '$indi_pc_ram' AND `pc_hdd` = '$indi_pc_hdd' AND `pc_os` = $indi_pc_os AND  `pc_monitor_details` = '$indi_pc_monitor' AND `pc_cost` = '$indi_pc_cost' AND `warranty_in_years` = $indi_pc_warranty AND `warranty_till` = '$indi_pc_warrabty_uptodate' AND `pc_user_emp` = '$u' AND `pc_ip` = '$indi_pc_ip' AND `pc_setup` = '$indi_pc_setup' AND `pc_barc_asset_id` = '$indi_pc_barc_asset_id' AND `pc_amc_id` = '$indi_pc_amc_id' AND `pc_bit_type` ='$indi_pc_arch'";
						  $stmt_h= $this->db->prepare($sql_h);
						  $stmt_h->execute();
						  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
						  $pcautoid = $result_h['autoID'];
						  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Individual/Group Purchase]PC ADDED BY USER)','','');
						  
						// get id and add to pc history 
						 return $result;
		}





		public function Borrow_addPc($pcworking,$borrow_pc_location,$borrow_pc_purchase,$borrow_pc_make,$borrow_pc_model,$borrow_pc_arch,$borrow_pc_ram,$borrow_pc_hdd,$borrow_pc_os,$borrow_pc_monitor,$borrow_pc_ip,$borrow_pc_setup, $borrow_pc_barc_asset_id,$borrow_pc_amc_id,$borrow_pc_use){
			
			$sql = "INSERT INTO `tbl_pc_details` (`working`,`pc_location`,`pc_use`,`pc_source`,`pc_make`,`pc_processor_details`,`pc_ram_value`,`pc_hdd`,`pc_os`, `pc_monitor_details`,`pc_user_emp`,`pc_ip`,`pc_setup`,`pc_barc_asset_id`,`pc_amc_id`,`pc_bit_type`) VALUES (:working,:borrow_pc_location,:borrow_pc_use,:borrow_pc_purchase,:borrow_pc_make,:borrow_pc_model,:borrow_pc_ram,:borrow_pc_hdd,:borrow_pc_os,:borrow_pc_monitor,:user_emp,:borrow_pc_ip,:borrow_pc_setup,:borrow_pc_barc_asset_id,:borrow_pc_amc_id,:borrow_pc_arch)";
						
		   $stmt = $this->db->prepare($sql);
		   				  $stmt->bindValue(':working', $pcworking);
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
						  $result_h = $this->add_pctransactionhistory($pcautoid,'ADDED',0,$u,'[Borrowed]PC ADDED BY USER)','','');
						// get id and add to pc history 
                          return $result;
		}

		public function add_pctransactionhistory($pcautoid,$o,$f,$t,$r,$q,$admin_rem){
			//$q1 = stripslashes($q);
			$sql_i = "INSERT INTO pc_transaction_log (`pc_table_id`, `action`,`pc_from`,`pc_to`,`pc_remark`,`transaction_query`,`admin_remark`) VALUES (:pcid,:action,:f,:t,:r,:q,:admin_remark)";
			$stmt_i = $this->db->prepare($sql_i);
			$stmt_i->bindValue(':pcid', $pcautoid);
			$stmt_i->bindValue(':action', $o);
			$stmt_i->bindValue(':f', $f);
			 $stmt_i->bindValue(':t', $t);
			 $stmt_i->bindValue(':r', $r);
			 $stmt_i->bindValue(':q', $q);
			 $stmt_i->bindValue(':admin_remark', $admin_rem);
			$result_i = $stmt_i->execute();
			return $result_i;
		}

		public function add_devicetransactionhistory($pcautoid,$o,$f,$t,$r,$q,$admin_rem){
			//$q1 = stripslashes($q);
			$sql_i = "INSERT INTO device_transaction_log (`device_table_id`, `action`,`device_from`,`device_to`,`device_remark`,`transaction_query`,`admin_remark`) VALUES (:pcid,:action,:f,:t,:r,:q,:admin_remark)";
			$stmt_i = $this->db->prepare($sql_i);
			$stmt_i->bindValue(':pcid', $pcautoid);
			$stmt_i->bindValue(':action', $o);
			$stmt_i->bindValue(':f', $f);
			 $stmt_i->bindValue(':t', $t);
			 $stmt_i->bindValue(':r', $r);
			 $stmt_i->bindValue(':q', $q);
			 $stmt_i->bindValue(':admin_remark', $admin_rem);
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


	  public function registerUsernotused($empno,$empname,$empemail,$emppass){ // NOT USED YET
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
	public function getgrouppc($ser){
		if($ser!=''){
			$q_part = " AND e.emp_name LIKE '%$ser'";
		}else{
			$q_part = "";
		}
		$id = $_SESSION['loggedinby_groupID'];
		$sql = "SELECT a.working,pur.rvfileuploaded,pur.rvfilename,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.pc_form,a.pc_make, a.pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID LEFT JOIN tbl_pc_make as pur ON pur.autoID <> a.pc_make_model JOIN tbl_users as e ON a.pc_user_emp = e.emp_no WHERE a.pc_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source <> 'Centralize'".$q_part. " UNION SELECT a.working,pur.rvfilename,pur.rvfileuploaded,e.emp_name,e.emp_title, e.emp_no,e.emp_desig, pur.pc_form,pur.pc_make, pur.pc_model as pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID JOIN tbl_users as e ON a.pc_user_emp = e.emp_no WHERE a.pc_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source = 'Centralize'".$q_part;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getgroupdevice($ser){
		if($ser!=''){
			$q_part = " AND e.emp_name LIKE '%$ser'";
		}else{
			$q_part = "";
		}
		$id = $_SESSION['loggedinby_groupID'];
		$sql = "SELECT a.rvfilename,a.working,a.device_make_model,a.rvfileuploaded,d.device_make,a.device_tone,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.device,a.device_model,a.device_use,a.device_indent_no, a.device_indent_dt, a.device_indent_by, a.autoID, a.device_user_emp, a.device_user_group, a.device_barc_asset_id, a.device_amc_id, a.device_po_no, a.device_po_dt, a.device_rv_no, a.device_rv_dt, a.device_cost, a.device_source, a.device_location, a.device_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.device_added_on, a.isdeleted from tbl_printer_details as a JOIN tbl_users as e ON a.device_user_emp = e.emp_no JOIN tbl_printer_make as d ON d.autoID = a.device_make WHERE a.device_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.device_source <> 'Centralize'".$q_part." UNION SELECT a.rvfilename,a.working,a.device_make_model,a.rvfileuploaded,d.device_make,a.device_tone,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.device,a.device_model,a.device_use,a.device_indent_no, a.device_indent_dt, a.device_indent_by, a.autoID, a.device_user_emp, a.device_user_group, a.device_barc_asset_id, a.device_amc_id, a.device_po_no, a.device_po_dt, a.device_rv_no, a.device_rv_dt, a.device_cost, a.device_source, a.device_location, a.device_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.device_added_on, a.isdeleted from tbl_printer_details as a JOIN tbl_users as e ON a.device_user_emp = e.emp_no JOIN tbl_printer_purchase as d ON d.autoID = a.device_make_model WHERE a.device_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.device_source = 'Centralize'".$q_part;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}



	///////////////// ADMIN APPROVAL /////////////////
	public function xgetupapproved(){ // not using
		$sql = "SELECT g.grp_name,a.rvfilename,a.rvfileuploaded,o.os_name,o.os_of,u.emp_no, u.emp_title, u.emp_name,u.emp_desig,a.pc_make_model,a.pc_supplier_name,a.pc_indent_no,a.pc_indent_dt,a.pc_indent_by,a.autoID,a.pc_os,a.pc_make,a.pc_processor_details,a.pc_monitor_details,a.pc_bit_type,a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_nic_number,a.pc_setup,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,a.pc_amc_id,a.pc_po_no,a.pc_po_dt,a.pc_rv_no,a.pc_rv_dt,a.pc_cost,a.pc_source,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.pc_added_on, a.isdeleted FROM tbl_pc_details as a JOIN tbl_users as u ON u.emp_no = a.pc_user_emp JOIN tbl_groups as g ON g.autoID = u.emp_grp_autoID JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.isdeleted = 0 AND a.groupadmin_approval = 1 and a.current_status = 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getupapproved($ser){ 
		if($ser!=''){
			$q_part = " AND u.emp_name LIKE '%$ser%' OR g.grp_name LIKE '%$ser%' ";
		}else{
			$q_part = "";
		}
		$sql = "SELECT a.aimsid,a.pc_make_model,u.emp_desig,u.emp_extn,a.pc_form,a.working,g.grp_name,a.rvfilename,a.rvfileuploaded,o.os_name,o.os_of,u.emp_no, u.emp_title, u.emp_name,u.emp_desig,a.pc_make_model,a.pc_supplier_name,a.pc_indent_no,a.pc_indent_dt,a.pc_indent_by,a.autoID,a.pc_os,a.pc_make,a.pc_processor_details,a.pc_monitor_details,a.pc_bit_type,a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_nic_number,a.pc_setup,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,a.pc_amc_id,a.pc_po_no,a.pc_po_dt,a.pc_rv_no,a.pc_rv_dt,a.pc_cost,a.pc_source,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.pc_added_on, a.isdeleted FROM tbl_pc_details as a JOIN tbl_users as u ON u.emp_no = a.pc_user_emp JOIN tbl_groups as g ON g.autoID = u.emp_grp_autoID JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.isdeleted = 0 AND a.groupadmin_approval = 1 and a.current_status = 1 ".$q_part;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}




	public function getupapproveddevice($ser){ 
		if($ser!=''){
			$q_part = " AND e.emp_name LIKE '%$ser%' OR g.grp_name LIKE '%$ser%' ";
		}else{
			$q_part = "";
		}
		$sql = "SELECT a.aimsid,g.grp_name,e.emp_desig,e.emp_no,e.emp_title,e.emp_name, a.device_supplier_details,a.device,
		a.device_make_model,a.device_indent_no,a.device_indent_dt,a.device_indent_by,a.autoID,
		a.device_make,a.device_model,a.device_tone,a.device_user_emp,
		a.device_user_group,a.device_barc_asset_id,a.device_amc_id,a.device_po_no,
		a.device_po_dt,a.device_rv_no,a.device_rv_dt,a.rvfileuploaded,a.rvfilename,
		a.device_cost,a.device_source,a.device_location,a.device_use,a.under_amc,
		a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.groupadmin_approved_by,
		a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.device_added_on,a.isdeleted,a.updatedbyip,a.updatedon,a.current_status,a.working FROM tbl_printer_details as a JOIN tbl_users as e ON e.emp_no = a.device_user_emp JOIN tbl_groups as g ON g.autoID = e.emp_grp_autoID WHERE a.isdeleted = 0 AND a.groupadmin_approval = 1 and a.current_status = 1".$q_part;
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
	// get all emp
function getallemp_for_reassign(){
	
	$data = array();
	$sql = "SELECT e.emp_no,e.emp_title,e.emp_name,e.emp_desig,e.emp_grp_autoID,g.grp_name FROM tbl_users as e JOIN tbl_groups as g ON g.autoID = e.emp_grp_autoID WHERE e.isdeleted = 0 ORDER BY e.emp_no";
	
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}
// get emp

	public function addPcPurchaseDetail($pc_ssd_details,$pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$addedby,$pcform){ 
		$client_ip = get_client_ip();
		$sql = "INSERT INTO `tbl_pc_make` (`pc_ssd_details`,`details_of_supplier`,`indent_no`,`indent_dt`,`indentor_emp`,`rv_no`,`rv_dt`,`qty_received`,`pc_make`,`pc_model`,`pc_ram_details`,`pc_hdd_details`,`pc_os_details`,`pc_monitor_details`,`pc_cost`,`warranty_in_years`,`warranty_upto`,`po_no`,`po_dt`,`updatedbyip`,`updatedby`,`pc_form`) VALUES (:pc_ssd_details,:pc_supplier,:indent_no,:indent_dt,:indent_by,:rv_no,:rv_dt,:rv_qty,:pc_make,:pc_model,:pc_ram,:pc_hdd,:pc_os,:pc_monitor,:pc_cost,:warranty_in_years,:warranty_upto,:po_no,:po_dt,:updatedbyip,:updatedby,:pcform)";
		$stmt = $this->db->prepare($sql);
		
						$stmt->bindValue(':pc_ssd_details', $pc_ssd_details);
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
						$stmt->bindValue(':pcform', $pcform);
					   $result = $stmt->execute();
					   return  $result;
	}

	public function editPcPurchaseDetail($ssd,$pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$loggedinby,$uid,$pcform){ 
		$client_ip = get_client_ip();
		$sql = "UPDATE `tbl_pc_make` SET `pc_ssd_details`='$ssd',`details_of_supplier` = '$pc_supplier',`indent_no` = '$indent_no',`indent_dt`= '$indent_dt',`indentor_emp` = '$indent_by', `rv_no`= '$rv_no',`rv_dt`= '$rv_dt',`qty_received`= $rv_qty,`pc_make`='$pc_make',`pc_model` = '$pc_model',`pc_ram_details` = '$pc_ram',`pc_hdd_details` = '$pc_hdd',`pc_os_details` = $pc_os,`pc_monitor_details` = '$pc_monitor',`pc_cost` = '$pc_cost',`warranty_in_years` = $pc_warranty,`warranty_upto` = '$pc_warrantyuptodate',`po_no` = '$po_no',`po_dt`= '$po_dt',`updatedbyip` = '$client_ip',`updatedby` = '$loggedinby', `pc_form` = '$pcform' WHERE autoID = $uid";
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


	public function getAddedRecord($ssd,$pc_supplier, $indent_no, $indent_dt, $indent_by, $rv_no,$rv_dt, $rv_qty,$pc_make,$pc_model,$pc_ram,$pc_hdd,$pc_os,$pc_monitor,$pc_cost,$pc_warranty,$pc_warrantyuptodate,$po_no,$po_dt,$addedby,$pcform){ 
		$sql = "SELECT * from tbl_pc_make WHERE `pc_ssd_details` = $ssd,`details_of_supplier` = '$pc_supplier' AND `indent_no` ='$indent_no' AND `indent_dt` = '$indent_dt' AND `indentor_emp`='$indent_by' AND `rv_no` ='$rv_no' AND `rv_dt` = '$rv_dt' AND `qty_received` = $rv_qty  AND `pc_make` ='$pc_make' AND `pc_model` ='$pc_model' AND `pc_ram_details` = '$pc_ram' AND `pc_hdd_details` ='$pc_hdd' AND  `pc_os_details` ='$pc_os' AND `pc_monitor_details` ='$pc_monitor' AND `pc_cost` ='$pc_cost' AND `warranty_in_years` = $pc_warranty AND `warranty_upto` = '$pc_warrantyuptodate' AND `po_no` = '$po_no' AND `po_dt`= '$po_dt' AND pc_form = '$pcform' ORDER BY autoID DESC LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['autoID'];
		//return $sql;
	}

										
	public function indigetAddedRecord($indi_pc_location,$indi_pc_use,$indi_pc_arch,$indi_pc_purchase,$indi_pc_supplier,$indi_indent_no,$indi_indent_dt,$indi_indent_by,$indi_po_no,$indi_po_dt,$indi_rv_no,$indi_rv_dt,$indi_pc_make,$indi_pc_model,$indi_pc_ram,$indi_pc_hdd,$indi_pc_os,$indi_pc_monitor,$indi_pc_cost,$indi_pc_warranty,$indi_pc_warrabty_uptodate,$indi_pc_ip,$indi_pc_setup,$indi_pc_barc_asset_id,$indi_pc_amc_id,$pcform){
		$sql = "SELECT * from tbl_pc_details WHERE `pc_location` = '$indi_pc_location' AND `pc_use` = '$indi_pc_use' AND `pc_source`= '$indi_pc_purchase' AND `pc_supplier_name`= '$indi_pc_supplier' AND `pc_indent_no`= '$indi_indent_no' AND `pc_indent_dt`= '$indi_indent_dt' AND `pc_indent_by`= '$indi_indent_by' AND `pc_po_no`= '$indi_po_no' AND `pc_po_dt`= '$indi_po_dt' AND `pc_rv_no`= '$indi_rv_no' AND `pc_rv_dt`= '$indi_rv_dt' AND `pc_make`= '$indi_pc_make' AND `pc_processor_details`= '$indi_pc_model' AND `pc_ram_value`= '$indi_pc_ram' AND `pc_hdd`= '$indi_pc_hdd' AND `pc_os`= '$indi_pc_os' AND `pc_monitor_details`= '$indi_pc_monitor' AND `pc_cost`= '$indi_pc_cost' AND `warranty_till`= '$indi_pc_warrabty_uptodate' AND `pc_ip`= '$indi_pc_ip' AND `pc_setup`= '$indi_pc_setup' AND `pc_barc_asset_id`= '$indi_pc_barc_asset_id' AND `pc_amc_id`= '$indi_pc_amc_id' AND `pc_bit_type`= '$indi_pc_arch' AND `pc_form` = '$pcform' ORDER BY autoID DESC LIMIT 1";
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

	// RV copy details update for centralize
	public function updfiledetails_indi_device($f,$i){
		$sql = "UPDATE `tbl_printer_details` SET `rvfileuploaded`= 1, `rvfilename` =:rv_filename WHERE autoID =:id";
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

	public function getprintermakemodelbyid($id){
		$sql = "SELECT b.device_make as dmk,a.device,a.device_make,a.autoID,a.device_model,a.device_tone,a.indent_no,a.indent_dt,a.indentor_emp,a.rv_no,a.rv_dt,a.rvfileuploaded,a.rvfilename,a.po_no,a.po_dt,a.device_cost,a.details_of_supplier,a.qty_received,a.warranty_in_years,a.warranty_upto,a.updatedby,a.updatedbyip,a.printer_remarks,a.updatedon,a.isdeleted from tbl_printer_purchase as a JOIN tbl_printer_make as b ON a.device_make = b.autoID WHERE a.autoID=$id AND a.isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}


	public function getprintermakemodel(){
		$data = array();
		$sql = "SELECT a.device,a.device_make,a.autoID,a.device_model,a.device_tone,a.rv_dt,b.device_make as mk FROM tbl_printer_purchase as a JOIN tbl_printer_make as b ON a.device_make = b.autoID WHERE a.isdeleted = 0 AND a.isdeleted = 0";
		//echo $sql;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function getautofilldata($id){
		$data = array();
		$sql = "SELECT * from tbl_pc_details WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function getautofilldata_printer($id){
		$data = array();
		$sql = "SELECT * from tbl_printer_details WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}




	public function getpcmakebyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['pc_make'];
	}

	public function getallbymakebyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	
	
	public function getdevicemodelbyid($id){
		$sql = "SELECT * from tbl_printer_purchase WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['device_model'];
	}

	public function getdevicemakebymakemodel($id){
		$sql = "SELECT device_make from tbl_printer_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['device_make'];
	}


	public function getdevicedetailsbymakemodel($id){
		$sql = "SELECT * from tbl_printer_purchase WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	


	public function getpcmakemodelformbyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function getpcmodelbyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['pc_model'];
	}

	public function getpcformbyid($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['pc_form'];
	}

	public function getsinglepcdetails($id){
		$sql = "SELECT * from tbl_pc_details WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result; 
	}

	public function getsinglepcdetails_asjson($id){
		$sql = "SELECT * from tbl_pc_make WHERE autoID=$id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}


	//							hid_autoID,	ecenp_pc_make, ecenp_pc_os,ecenp_pc_arch,ecenp_ppc_ram,ecenp_pc_hdd,ecenp_pc_ip,ecenp_pc_setup,ecenp_pc_barc_asset_id,ecenp_pc_amc_id,ecenp_pc_use,ecenp_pc_location,ecenp_pc_make_text,ecenp_pc_model_text
	public function edit_cenp_Pc($pcworking,$ssd,$hid_autoID, $ecenp_pc_make, $ecenp_pc_os, $ecenp_pc_arch, $ecenp_pc_ram,$ecenp_pc_hdd, $ecenp_pc_ip,$ecenp_pc_setup,$ecenp_pc_barc_asset_id,$ecenp_pc_amc_id,$ecenp_pc_use,$ecenp_pc_location){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `working` = $pcworking ,`pc_ssd` = '$ssd', `pc_make_model` = $ecenp_pc_make,`pc_os` = $ecenp_pc_os, `pc_bit_type`= '$ecenp_pc_arch',`pc_ram_value`= '$ecenp_pc_ram',`pc_hdd`= '$ecenp_pc_hdd',`pc_setup`='$ecenp_pc_setup',`pc_ip` = '$ecenp_pc_ip',`pc_barc_asset_id` = '$ecenp_pc_barc_asset_id',`pc_amc_id` = '$ecenp_pc_amc_id',`pc_use` = '$ecenp_pc_use',`pc_location` = '$ecenp_pc_location',`updatedbyip` = '$client_ip', `groupadmin_approval` = 0, `sysadmin_approval` = 0 WHERE autoID = $hid_autoID";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($hid_autoID,"UPDATED",0,$loggedinby,"[Centralize Purchase]PC UPDATED BY USER)",$sql,'');
		// record history
		return  $result;
	}

	//											
	public function edit_indip_Pc($pcworking,$eindi_hid_autoID, $e_indi_pc_supplier, $e_indi_indent_no, $e_indi_indent_dt, $e_indi_indent_by,$e_indi_po_no, $e_indi_po_dt,$e_indi_rv_no,$e_indi_rv_dt,$e_indi_pc_cost,$e_indi_pc_warranty,$e_indi_pc_warrabty_uptodate,$e_indi_pc_make,$e_indi_pc_model,$e_indi_pc_ram,$e_indi_pc_hdd,$e_indi_pc_os,$e_indi_pc_monitor,$e_indi_pc_ip,$e_indi_pc_setup,$e_indi_pc_barc_asset_id,$e_indi_pc_amc_id,$e_indi_pc_use,$e_indi_pc_location,$e_indi_pc_arch,$pc_form){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET `working`=$pcworking, `pc_supplier_name` = '$e_indi_pc_supplier',`pc_indent_no` = '$e_indi_indent_no',`pc_indent_dt`= '$e_indi_indent_dt',`pc_indent_by` = '$e_indi_indent_by', `pc_rv_no`= '$e_indi_rv_no',`pc_rv_dt`= '$e_indi_rv_dt',`pc_po_no`= '$e_indi_po_no',`pc_po_dt`='$e_indi_po_dt',`pc_cost` = '$e_indi_pc_cost',`warranty_in_years` = $e_indi_pc_warranty,`warranty_till` = '$e_indi_pc_warrabty_uptodate',`pc_make` = '$e_indi_pc_make',`pc_processor_details` = '$e_indi_pc_model', `pc_monitor_details` = '$e_indi_pc_monitor',`pc_ip` = '$e_indi_pc_ip', `pc_bit_type` = '$e_indi_pc_arch', `pc_setup` = '$e_indi_pc_setup', `pc_ram_value` = '$e_indi_pc_ram', `pc_hdd` = '$e_indi_pc_hdd', `pc_os` = '$e_indi_pc_os' ,`pc_barc_asset_id` = '$e_indi_pc_barc_asset_id', `pc_amc_id` = '$e_indi_pc_amc_id',`pc_location` = '$e_indi_pc_location',`groupadmin_approval` = 0, `sysadmin_approval` = 0, pc_form = '$pc_form' WHERE autoID = $eindi_hid_autoID";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($eindi_hid_autoID,"UPDATED",0,$loggedinby,"[Individual/Group Purchase]PC UPDATED BY USER",$sql,'');
		// record history
		return  $result;
	}

	public function edit_borrowp_Pc($pcworking,$eborro_hid_autoID, $e_borrow_pc_make,$e_borrow_pc_model,$e_borrow_pc_arch,$e_borrow_pc_ram,$e_borrow_pc_hdd,$e_borrow_pc_os,$e_borrow_pc_monitor,$e_borrow_pc_ip,$e_borrow_pc_setup,$e_borrow_pc_barc_asset_id,$e_borrow_pc_amc_id,$e_borrow_pc_use,$e_borrow_pc_location){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_pc_details` SET  `working` = $pcworking, `pc_make` = '$e_borrow_pc_make',`pc_processor_details` = '$e_borrow_pc_model', `pc_monitor_details` = '$e_borrow_pc_monitor',`pc_ip` = '$e_borrow_pc_ip', `pc_bit_type` = '$e_borrow_pc_arch', `pc_setup` = '$e_borrow_pc_setup', `pc_ram_value` = '$e_borrow_pc_ram', `pc_hdd` = '$e_borrow_pc_hdd', `pc_os` = '$e_borrow_pc_os' ,`pc_barc_asset_id` = '$e_borrow_pc_barc_asset_id', `pc_amc_id` = '$e_borrow_pc_amc_id',`pc_location` = '$e_borrow_pc_location',`pc_use` ='$e_borrow_pc_use',`groupadmin_approval` = 0, `sysadmin_approval` = 0 WHERE autoID = $eborro_hid_autoID AND isdeleted = 0";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		// record history
		$result_h = $this->add_pctransactionhistory($eborro_hid_autoID,"UPDATED",0,$loggedinby,"[Borrowed]PC UPDATED BY USER",$sql,'');
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

	public function adminapproval($id,$aimsid){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_pc_details SET `sysadmin_approval` = 1, `sysadmin_approvedon` = CURRENT_TIMESTAMP, `sysadmin_approved_by` = '$loggedinby', `aimsid` = '$aimsid' WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	
	public function groupadminapprovaldevice($id){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_printer_details SET `groupadmin_approval` = 1, `groupadmin_approvedon` = CURRENT_TIMESTAMP, `groupadmin_approved_by` = '$loggedinby' WHERE autoID = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function adminapprovaldevice($id,$aimsid){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_printer_details SET `sysadmin_approval` = 1, `sysadmin_approvedon` = CURRENT_TIMESTAMP, `sysadmin_approved_by` = '$loggedinby', `aimsid` = '$aimsid' WHERE autoID = $id AND isdeleted = 0";
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
		$sql = "SELECT a.autoID,a.emp_no,a.emp_title,a.emp_cc,a.emp_name,a.emp_desig,a.emp_dob,a.emp_gender,a.emp_grp_autoID,a.emp_sitting_place,a.emp_extn,a.emp_mob,a.emp_alternate_mob,a.emp_e_email,a.emp_o_email,a.emp_shift_autoID,a.isactive,a.firsttimelogin,a.activatedon,a.isdeleted,a.updatedon,a.updatedbyip,a.emp_pass,a.user_type,b.shift_name FROM `tbl_users` as a JOIN tbl_shift as b ON b.autoID = a.emp_shift_autoID WHERE a.emp_grp_autoID = $id AND a.user_type = 'user' AND working_status=1 ORDER BY a.emp_no ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getnoofemp_unit($id){
		$sql = "SELECT COUNT(*) as cnt FROM `tbl_users` WHERE `emp_grp_autoID` = $id AND working_status=1";
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

	public function getallempdetails(){
		$sql = "SELECT a.autoID,a.emp_no,a.emp_title,a.emp_name,a.emp_desig,a.emp_grp_autoID,b.grp_name,b.grp_head from tbl_users as a JOIN tbl_groups as b ON a.emp_grp_autoID = b.autoID WHERE a.isdeleted = 0 ORDER BY FIELD(emp_grp_autoID,'10','1','2','3','4','5','6','7','8','9'), a.emp_no ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result; 
	}

	public function getallgroupheaddetails(){
		$sql = "SELECT a.autoID,a.emp_no,a.emp_title,a.emp_name,a.emp_desig,a.emp_grp_autoID,b.grp_name,b.grp_head from tbl_users as a JOIN tbl_groups as b ON a.emp_grp_autoID = b.autoID WHERE a.isdeleted = 0 AND user_type='groupadmin' ORDER BY FIELD(emp_grp_autoID,'10','1','2','3','4','5','6','7','8','9'), a.emp_no ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result; 
	}


	
	
	public function getallgroups(){
		$sql = "SELECT * FROM tbl_groups WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function updategroupofemp($id,$grp,$desig){
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE tbl_users SET `emp_grp_autoID` = $grp, emp_desig = '$desig' WHERE emp_no = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}


	public function resetpasswordasemp($id){
		$pass = sha1($id);
		$sql = "UPDATE tbl_users SET `emp_pass` = '$pass' WHERE emp_no = $id AND isdeleted = 0";
		$stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		return  $result;
	}

	public function getalldevicedetails($id){
		
		//OK$sql = "SELECT a.pc_form,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os ,a.pc_make, a.pc_processor_details, a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  WHERE a.pc_user_emp =$id and a.isdeleted = 0 AND a.current_status = 1";
		$sql = "SELECT a.working,a.pc_form,a.pc_make, a.pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID LEFT JOIN tbl_pc_make as pur ON pur.autoID <> a.pc_make_model WHERE a.pc_user_emp = $id and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source <> 'Centralize' UNION SELECT a.working,pur.pc_form,pur.pc_make, pur.pc_model as pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_user_emp =$id and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source = 'Centralize' ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	


	public function getinusedevicecount($id){
		//$sql = "SELECT o.os_name,o.os_of,,b.pc_make, b.pc_model FROM tbl_pc_details as a JOIN tbl_pc_make as b ON a.pc_make_model = b.autoID JOIN tbl_pc_os as o ON a.pc_os = o.autoID WHERE a.pc_user_emp =$id";
		//prev$sql = "SELECT pc_form,count(*) as cnt FROM tbl_pc_details WHERE isdeleted = 0 AND current_status = 1 AND pc_user_emp = $id GROUP BY pc_form";
		//$sql= "SELECT pc_form,count(*) as cnt FROM tbl_pc_details WHERE pc_user_emp = 28120 AND pc_source <> 'Centralize'";
		//$sql="SELECT * from tbl_pc_details WHERE isdeleted = 0";
		$sql = "SELECT x.pc_form,SUM(cnt) as cnt FROM (SELECT pur.pc_form,count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_user_emp = $id AND a.pc_source = 'Centralize' AND current_status = 1 GROUP BY pur.pc_form UNION ALL SELECT pc_form,count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_user_emp = $id AND current_status = 1 GROUP BY pc_form ) as x GROUP BY x.pc_form";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getinusedevicecount_printer($id){
		$sql = "SELECT x.device,SUM(cnt) as cnt FROM (SELECT pur.device,count(*) as cnt FROM tbl_printer_details as a JOIN tbl_printer_purchase as pur ON a.device_make_model = pur.autoID WHERE a.device_user_emp = $id AND a.device_source = 'Centralize' AND current_status = 1 GROUP BY pur.device UNION ALL SELECT device,count(*) as cnt FROM tbl_printer_details WHERE device_source <> 'Centralize' AND device_user_emp = $id AND current_status = 1 GROUP BY device )as x GROUP BY x.device ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getinusedevicecount_printer_group($id){
		$sql = "SELECT x.device,SUM(cnt) as cnt FROM (SELECT pur.device,count(*) as cnt FROM tbl_printer_details as a JOIN tbl_printer_purchase as pur ON a.device_make_model = pur.autoID WHERE a.device_user_emp IN (SELECT emp_no FROM `tbl_users` WHERE emp_grp_autoID = $id ) AND a.device_source = 'Centralize' AND current_status = 1 GROUP BY pur.device UNION ALL SELECT device,count(*) as cnt FROM tbl_printer_details WHERE device_source <> 'Centralize' AND device_user_emp IN (SELECT emp_no FROM `tbl_users` WHERE emp_grp_autoID = $id ) AND current_status = 1 GROUP BY device )as x GROUP BY x.device ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}


	public function getinusepccount_group($id){
		$sql = "SELECT x.pc_form,SUM(cnt) as cnt FROM (SELECT pur.pc_form,count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_user_emp IN (SELECT emp_no FROM `tbl_users` WHERE emp_grp_autoID = $id ) AND a.pc_source = 'Centralize' AND current_status = 1 GROUP BY pur.pc_form UNION ALL SELECT pc_form,count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_user_emp IN (SELECT emp_no FROM `tbl_users` WHERE emp_grp_autoID = $id )  AND current_status = 1 GROUP BY pc_form ) as x GROUP BY x.pc_form";
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

	public function updateemp_profile($emp_title,$emp_name,$emp_no,$emp_desig,$emp_cc,$emp_sec,$emp_sp,$emp_o_email,$emp_phone){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_users` SET `emp_sitting_place` = '$emp_sp',`emp_extn` = '$emp_phone',`emp_o_email`= '$emp_o_email', `updatedbyip` = '$client_ip',`updatedby` = '$loggedinby' WHERE emp_no = $emp_no";
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
		$result_h = $this->add_pctransactionhistory($pcid,"MOVED_TO_INVENTORY",$foremp,0,"PC MOVED TO INVENTORY",$sql,$rem);
		return  $result;
	}

	public function device_move_to_inventory($deviceid,$foremp,$rem){ 
		$client_ip = get_client_ip();
		$loggedinby = $_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_printer_details` SET `current_status` = 0, `updatedbyip` = '$client_ip' WHERE autoID = $deviceid";
	    $stmt = $this->db->prepare($sql);	
		$result = $stmt->execute();
		$result_h = $this->add_devicetransactionhistory($deviceid,"DEVICE_MOVED_TO_INVENTORY",$foremp,0,"DEVICE MOVED TO INVENTORY",$sql,$rem);
		return  $result;
	}

	public function getallprintermake(){
		$sql = "SELECT * FROM tbl_printer_make WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getprinterpurchasedetails(){
		$sql = "SELECT a.device,a.autoID,a.device_make,b.device_make as dm, a.device_model,a.device_tone,a.indent_no,a.indent_dt,a.indentor_emp,a.rv_no,a.rv_dt,a.rvfileuploaded,a.rvfilename,a.po_no,a.po_dt,a.device_cost,a.details_of_supplier,a.qty_received,a.warranty_in_years,a.warranty_upto,a.updatedby,a.updatedbyip,a.printer_remarks,a.updatedon,a.isdeleted FROM tbl_printer_purchase as a JOIN tbl_printer_make as b ON a.device_make = b.autoID WHERE a.isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getprinterpurchasedetailsbyid($id){
		$sql = "SELECT a.device,a.autoID,a.device_make,b.device_make as dm, a.device_model,a.device_tone,a.indent_no,a.indent_dt,a.indentor_emp,a.rv_no,a.rv_dt,a.rvfileuploaded,a.rvfilename,a.po_no,a.po_dt,a.device_cost,a.details_of_supplier,a.qty_received,a.warranty_in_years,a.warranty_upto,a.updatedby,a.updatedbyip,a.printer_remarks,a.updatedon,a.isdeleted FROM tbl_printer_purchase as a JOIN tbl_printer_make as b ON a.device_make = b.autoID WHERE a.isdeleted = 0 AND a.autoID = $id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function addPrinterPurchaseDetail($select_product,$printer_supplier,$indent_no,$indent_dt,$indent_by,$po_no,$po_dt,$rv_no,$rv_dt,$rv_qty,$printer_make,$printer_model,$printer_type,$printer_cost,$printer_warranty,$printer_warranty_uptodate){ 
		$client_ip = get_client_ip();
		$updatedby=$_SESSION['loggedinby'];
		$sql = "INSERT INTO `tbl_printer_purchase` (device,device_make,device_model,device_tone,indent_no,indent_dt,indentor_emp,rv_no,rv_dt,po_no,po_dt,device_cost,details_of_supplier,qty_received,warranty_in_years,warranty_upto,updatedby,updatedbyip) VALUES (:device,:device_make,:device_model,:device_tone,:indent_no,:indent_dt,:indentor_emp,:rv_no,:rv_dt,:po_no,:po_dt,:device_cost,:details_of_supplier,:qty_received,:warranty_in_years,:warranty_upto,:updatedby,:updatedbyip)";
		$stmt = $this->db->prepare($sql);		
		$stmt->bindValue(':device', $select_product);
		$stmt->bindValue(':device_make', $printer_make);
		$stmt->bindValue(':device_model', $printer_model);
		$stmt->bindValue(':device_tone', $printer_type);
		$stmt->bindValue(':indent_no', $indent_no);
		$stmt->bindValue(':indent_dt', $indent_dt);
		$stmt->bindValue(':indentor_emp', $indent_by);
		$stmt->bindValue(':rv_no', $rv_no);
		$stmt->bindValue(':rv_dt', $rv_dt);
		$stmt->bindValue(':po_no', $po_no);
		$stmt->bindValue(':po_dt', $po_dt);
		$stmt->bindValue(':device_cost', $printer_cost);
		$stmt->bindValue(':details_of_supplier', $printer_supplier);
		$stmt->bindValue(':qty_received', $rv_qty);
		$stmt->bindValue(':warranty_in_years', $printer_warranty);
		$stmt->bindValue(':warranty_upto', $printer_warranty_uptodate);
		$stmt->bindValue(':updatedby',$updatedby);
		$stmt->bindValue(':updatedbyip', $client_ip);
		$result = $stmt->execute();
		return  $result;
	}


	public function editPrinterPurchaseDetail($select_product,$printer_supplier,$indent_no,$indent_dt,$indent_by,$po_no,$po_dt,$rv_no,$rv_dt,$rv_qty,$printer_make,$printer_model,$printer_type,$printer_cost,$printer_warranty,$printer_warranty_uptodate,$id){ 
		$client_ip = get_client_ip();
		$updatedby=$_SESSION['loggedinby'];
		$sql = "UPDATE `tbl_printer_purchase` SET device = '$select_product',device_make = '$printer_make',device_model = '$printer_model',device_tone = '$printer_type',indent_no = '$indent_no',indent_dt = '$indent_dt',indentor_emp = '$indent_by',rv_no = '$rv_no',rv_dt = '$rv_dt',po_no = '$po_no',po_dt = '$po_dt',device_cost = '$printer_cost',details_of_supplier = '$printer_supplier',qty_received = $rv_qty,warranty_in_years = $printer_warranty,warranty_upto = '$printer_warranty_uptodate',updatedby = $updatedby,updatedbyip = '$client_ip' WHERE autoID = $id";
		$stmt = $this->db->prepare($sql);		
		$result = $stmt->execute();
		return  $result;
	}


	public function getAddedPrinterAddedRecord($select_product,$printer_supplier,$indent_no,$indent_dt,$indent_by,$po_no,$po_dt,$rv_no,$rv_dt,$rv_qty,$printer_make,$printer_model,$printer_type,$printer_cost,$printer_warranty,$printer_warranty_uptodate)	{
		$sql = "SELECT * from tbl_printer_purchase WHERE `device` = '$select_product' AND `indent_no` ='$indent_no' AND `indent_dt` = '$indent_dt' AND `indentor_emp`='$indent_by' AND `rv_no` ='$rv_no' AND `rv_dt` = '$rv_dt' AND `qty_received` = $rv_qty  AND `device_make` ='$printer_make' AND `device_model` ='$printer_model' AND `device_tone` = '$printer_type' AND `device_cost` ='$printer_cost' AND `warranty_in_years` = $printer_warranty AND `warranty_upto` = '$printer_warranty_uptodate' AND `po_no` = '$po_no' AND `po_dt`= '$po_dt' ORDER BY autoID DESC LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['autoID'];
		//return $sql;
	}

		// RV copy details update for  printer
public function updfiledetailsprinter($f,$i){
	$sql = "UPDATE `tbl_printer_purchase` SET `rvfileuploaded`= 1, `rvfilename` =:rv_filename WHERE autoID =:id";
   $stmt = $this->db->prepare($sql);
	$stmt->bindValue(':rv_filename', $f);
	$stmt->bindValue(':id', $i);  
	$result = $stmt->execute();
	return $result;
}

public function deleteprinterpurchasedetail($id){
	$sql = "UPDATE tbl_printer_purchase SET isdeleted = 1 WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}


public function get_printer_purchase_detail($id){
	$sql = "SELECT * FROM tbl_printer_purchase WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result; 
}	


public function addPrinter($printer_purchase,$printer_make,$printer_make_text,$printer_model_text,$printer_barc_asset_id,$printer_amc_id,$printer_use,$printer_location,$printer_indent_no_text,$printer_indent_dt_text,$printer_indentor_emp_text,$printer_rv_no_text,$printer_rv_dt_text,$printer_po_no_text,$printer_po_dt_text,$printer_details_of_supplier_text,$printer_device_tone_text,$printer_device_cost_text,$warranty_years,$warranty_till){
	$loggedinby = $_SESSION['loggedinby'];
	$client_ip = get_client_ip();											
	$sql = "INSERT INTO `tbl_printer_details` (`device_source`,`device_make_model`,`device_make`,`device_model`,`device_barc_asset_id`,	`device_amc_id` ,`device_use`, `device_location`, `device_indent_no`, `device_indent_dt`, `device_indent_by`,`device_tone`,`device_user_emp`,`device_rv_no`,`device_rv_dt`,`device_po_no`,`device_po_dt`,`device_supplier_name`,`device_cost`,`updatedbyip`,`warranty_in_years`,`warranty_till`) VALUES ('$printer_purchase',$printer_make,'$printer_make_text','$printer_model_text','$printer_barc_asset_id','$printer_amc_id','$printer_use','$printer_location','$printer_indent_no_text','$printer_indent_dt_text','$printer_indentor_emp_text','$printer_device_tone_text',$loggedinby,'$printer_rv_no_text','$printer_rv_dt_text','$printer_po_no_text','$printer_po_dt_text','$printer_details_of_supplier_text','$printer_device_cost_text','$client_ip',$warranty_years,'$warranty_till')";										  
	$stmt = $this->db->prepare($sql);
	$result = $stmt->execute();	
	return $result;
}

public function gettotalpcs(){
	//$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND pc_form = 'desktop' AND current_status NOT IN ('3','4')";
	$sql = "SELECT SUM(cnt) as cnt FROM (SELECT count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID AND pur.pc_form = 'desktop' WHERE a.pc_source = 'Centralize' AND a.current_status NOT IN ('3','4')UNION ALL SELECT count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'desktop' AND current_status NOT IN ('3','4')) as x ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function getotherpcs(){
	$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND pc_form = 'desktop' AND current_status > 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function getinusepcs(){
	$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND current_status = 1 AND pc_form = 'desktop'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}


public function getiinventorypcs(){
	//$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND current_status = 0 AND pc_form = 'desktop'";
		$sql = "SELECT SUM(cnt) as cnt FROM (SELECT count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID AND pur.pc_form = 'desktop' WHERE a.pc_source = 'Centralize' AND a.current_status = 0 UNION ALL SELECT count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'desktop' AND current_status = 0) as x ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}


public function gettotallaptops(){
	//$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND pc_form = 'laptop'";
	$sql = "SELECT SUM(cnt) as cnt FROM (SELECT count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID AND pur.pc_form = 'laptop' WHERE a.pc_source = 'Centralize' AND a.current_status NOT IN ('3','4')UNION ALL SELECT count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'laptop' AND current_status NOT IN ('3','4')) as x ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}


public function gettotaldevices(){
	//$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND pc_form = 'laptop'";
	$sql = "SELECT SUM(cnt) as cnt FROM (SELECT count(*) as cnt FROM tbl_printer_details as a JOIN tbl_printer_purchase as pur ON a.device_make_model = pur.autoID  WHERE a.device_source = 'Centralize' AND a.current_status NOT IN ('3','4')UNION ALL SELECT count(*) as cnt FROM tbl_printer_details WHERE device_source <> 'Centralize' AND current_status NOT IN ('3','4')) as x ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function getinuselaptops(){
	$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND current_status = 1 AND pc_form = 'laptop'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}


public function getinventorylaptops(){
	$sql = "SELECT SUM(cnt) as cnt FROM (SELECT count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID AND pur.pc_form = 'laptop' WHERE a.pc_source = 'Centralize' AND a.current_status = 0 UNION ALL SELECT count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'laptop' AND current_status = 0) as x ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function getinventoryprinter(){
	$sql = "SELECT count(*) as cnt from tbl_printer_details WHERE isdeleted = 0 AND current_status = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function getotherlaptops(){
	$sql = "SELECT count(*) as cnt from tbl_pc_details WHERE isdeleted = 0 AND pc_form = 'laptop' AND current_status > 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}



public function gettotalusers(){
	$sql = "SELECT count(*) as cnt from tbl_users WHERE isdeleted = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['cnt'];
		//return $sql;
}

public function get_desktop_graph(){
	//$sql = "SELECT current_status,count(*) as cnt FROM `tbl_pc_details` WHERE isdeleted = 0 AND pc_form = 'desktop' group by current_status";
	//$sql = "SELECT x.current_status,SUM(cnt) as cnt FROM (SELECT a.current_status,count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_source = 'Centralize' GROUP BY a.current_status UNION ALL SELECT current_status,count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' ) as x GROUP BY x.current_status";
	$sql = "SELECT x.current_status,SUM(cnt) as cnt FROM (SELECT a.current_status,count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_source = 'Centralize' AND pur.pc_form = 'desktop' GROUP BY a.current_status UNION ALL SELECT current_status,count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'desktop' ) as x GROUP BY x.current_status HAVING x.current_status >=0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function get_laptop_graph(){
	$sql = "SELECT x.current_status,SUM(cnt) as cnt FROM (SELECT a.current_status,count(*) as cnt FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID WHERE a.pc_source = 'Centralize' AND pur.pc_form = 'laptop' GROUP BY a.current_status UNION ALL SELECT current_status,count(*) as cnt FROM tbl_pc_details WHERE pc_source <> 'Centralize' AND pc_form = 'laptop' ) as x GROUP BY x.current_status HAVING x.current_status >= 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function get_printer_graph(){
	$sql = "SELECT current_status,count(*) as cnt FROM `tbl_printer_details` WHERE isdeleted = 0 group by current_status";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function get_purchase_graph(){
	$sql = "SELECT pc_source,count(*) as cnt FROM `tbl_pc_details` WHERE isdeleted = 0 group by pc_source";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function get_printer_purchase_graph(){
	$sql = "SELECT device_source,count(*) as cnt FROM `tbl_printer_details` WHERE isdeleted = 0 group by device_source";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function addcenPrinter($working,$printer_make,$printer_barc_asset_id,$printer_amc_id,$printer_use,$printer_location){
	$loggedinby = $_SESSION['loggedinby'];
	$client_ip = get_client_ip();											
	$sql = "INSERT INTO `tbl_printer_details` (`working`,`device_make_model`,`device_user_emp`,`device_barc_asset_id`,`device_amc_id` ,`device_use`, `device_location`,`updatedbyip`) VALUES ($working,$printer_make,$loggedinby,'$printer_barc_asset_id','$printer_amc_id','$printer_use','$printer_location','$client_ip')";										  
	$stmt = $this->db->prepare($sql);
	$result = $stmt->execute();	

	// get id and add to printer history
	$u = $_SESSION['loggedinby'];																																																																																																																																																																					
	$sql_h = "SELECT * from tbl_printer_details WHERE `device_make_model` = $printer_make AND `device_user_emp` = '$loggedinby' AND `device_barc_asset_id` = '$printer_barc_asset_id' AND `device_amc_id` = '$printer_amc_id' AND `device_location` = '$printer_location'";
   $stmt_h= $this->db->prepare($sql_h);
   $stmt_h->execute();
   $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
   $pcautoid = $result_h['autoID'];
   $result_h = $this->add_devicetransactionhistory($pcautoid,'ADDED',0,$loggedinby,'[Centralize Purchase]DEVICE ADDED BY USER)','','');
 // get id and add to pc history 


	return $result;
}


public function addBorPrinter($working,$bor_device,$bor_device_make,$bor_device_model,$bor_device_barc_asset_id,$bor_device_amc_id,$bor_device_use,$bor_device_location,$bor_device_tone){
	$loggedinby = $_SESSION['loggedinby'];																																															
	$client_ip = get_client_ip();
	$sql = "INSERT INTO `tbl_printer_details` (`working`,`device`,`device_make`,`device_model`,`device_barc_asset_id`,`device_amc_id` ,`device_use`, `device_location`,`device_tone`,`updatedbyip`,`device_user_emp`,`device_source`) VALUES ($working,'$bor_device','$bor_device_make','$bor_device_model','$bor_device_barc_asset_id','$bor_device_amc_id','$bor_device_use','$bor_device_location','$bor_device_tone','$client_ip',$loggedinby,'Borrowed')";										  
	$stmt = $this->db->prepare($sql);
	$result = $stmt->execute();	

	// get id and add to printer history
	$u = $_SESSION['loggedinby'];																																																																																																																																																																					
	$sql_h = "SELECT * from tbl_printer_details WHERE `device_make` = $bor_device_make AND `device_model` = '$bor_device_model' AND `device_barc_asset_id` = '$bor_device_barc_asset_id' AND `device_user_emp` = '$loggedinby' AND `device_amc_id` = '$bor_device_amc_id' AND `device_location` = '$bor_device_location' AND `updatedbyip` = '$client_ip'";
   $stmt_h= $this->db->prepare($sql_h);
   $stmt_h->execute();
   $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
   $pcautoid = $result_h['autoID'];
   $result_h = $this->add_devicetransactionhistory($pcautoid,'ADDED',0,$loggedinby,'[Borrowed]DEVICE ADDED BY USER)','','');
 // get id and add to pc history 


	return $result;
}



public function editcenPrinter($working,$id,$printer_make,$printer_barc_asset_id,$printer_amc_id,$printer_use,$printer_location){
	$loggedinby = $_SESSION['loggedinby'];
	$client_ip = get_client_ip();											
	$sql = "UPDATE `tbl_printer_details` SET `working` = $working , `device_make_model` = $printer_make, `device_barc_asset_id` = '$printer_barc_asset_id',`device_amc_id` = '$printer_amc_id' ,`device_use` = '$printer_use', `device_location` = '$printer_location',`updatedbyip` = '$client_ip' WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);
	$result = $stmt->execute();	
	$result_h = $this->add_devicetransactionhistory($id,'UPDATED',0,$loggedinby,'[Centralize Purchase]DEVICE UPDATED BY USER)',$sql,'');
	return $result;
	
}

public function getalluserprinters($id){
	//$sql = "SELECT a.autoID,d.device,m.device_make,d.device_model,d.device_tone,a.device_barc_asset_id, a.device_amc_id, a.device_source,a.groupadmin_approval, a.sysadmin_approval FROM tbl_printer_details as a JOIN tbl_printer_purchase as d ON d.autoID = a.device_make_model JOIN tbl_printer_make as m ON m.autoID = d.device_make WHERE a.isdeleted = 0 AND a.current_status = 1 AND a.device_user_emp = $id";
	$sql = "SELECT a.working,a.autoID,d.device,m.device_make,d.device_model,d.device_tone,a.device_barc_asset_id, a.device_amc_id, a.device_source,a.groupadmin_approval, a.sysadmin_approval FROM tbl_printer_details as a JOIN tbl_printer_purchase as d ON d.autoID = a.device_make_model JOIN tbl_printer_make as m ON m.autoID = d.device_make WHERE a.isdeleted = 0 AND a.current_status = 1 AND a.device_user_emp = $id AND a.device_source = 'Centralize' UNION ALL SELECT a.working,a.autoID,a.device,m.device_make,a.device_model,a.device_tone,a.device_barc_asset_id, a.device_amc_id, a.device_source,a.groupadmin_approval, a.sysadmin_approval FROM tbl_printer_details as a JOIN tbl_printer_make as m ON m.autoID = a.device_make WHERE a.isdeleted = 0 AND a.current_status = 1 AND a.device_user_emp = $id AND a.device_source <> 'Centralize'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getsingleprinterdetails($id){
	$sql = "SELECT * from tbl_printer_details WHERE autoID=$id AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result; 
}

public function Indi_addDevice($indidev_working,$indi_device_purchase,$indi_device,$indi_device_supplier,$indi_device_indent_no,$indi_device_indent_dt,$indi_device_indent_by,$indi_device_po_no,$indi_device_po_dt,$indi_device_rv_no,$indi_device_rv_dt,$indi_device_cost,$indi_device_warranty,$indi_device_warranty_uptodate,$indi_device_make,$indi_device_model,$indi_device_barc_asset_id,$indi_device_amc_id,$indi_device_use,$indi_device_location,$indi_device_tone){
	$client_ip = get_client_ip();
	$loggedinby = $_SESSION['loggedinby'];
	$sql = "INSERT INTO `tbl_printer_details` (`working`,`device_source`,`device`,`device_supplier_details`,`device_indent_no`,`device_indent_dt`,`device_indent_by`,`device_po_no`,`device_po_dt`,`device_rv_no`,`device_rv_dt`,`device_cost`,`warranty_in_years`,`warranty_till`,`device_make`,`device_model`,`device_barc_asset_id`,`device_amc_id`,`device_use`,`device_location`,`device_tone`,`device_user_emp`,`updatedbyip`) VALUES ($indidev_working,'$indi_device_purchase','$indi_device','$indi_device_supplier','$indi_device_indent_no','$indi_device_indent_dt','$indi_device_indent_by','$indi_device_po_no','$indi_device_po_dt','$indi_device_rv_no','$indi_device_rv_dt','$indi_device_cost',$indi_device_warranty,'$indi_device_warranty_uptodate','$indi_device_make','$indi_device_model','$indi_device_barc_asset_id','$indi_device_amc_id','$indi_device_use','$indi_device_location','$indi_device_tone',$loggedinby,'$client_ip')";
										
   				$stmt = $this->db->prepare($sql);
				  $result = $stmt->execute();
				  // get id and add to printer history
				   $u = $_SESSION['loggedinby'];																																																																																																																																																																					
				   $sql_h = "SELECT * from tbl_printer_details WHERE `device_source` = '$indi_device_purchase' AND `device` = '$indi_device' AND `device_supplier_details` = '$indi_device_supplier' AND `device_indent_no` = '$indi_device_indent_no' AND `device_indent_dt` = '$indi_device_indent_dt' AND `device_indent_by` = '$indi_device_indent_by' AND `device_po_no` = '$indi_device_po_no' AND `device_po_dt` = '$indi_device_po_dt' AND `device_rv_no` = '$indi_device_rv_no' AND `device_rv_dt` = '$indi_device_rv_dt' AND `device_cost` = '$indi_device_cost' AND `warranty_in_years` = $indi_device_warranty AND `warranty_till` = '$indi_device_warranty_uptodate' AND `device_make` = '$indi_device_make' AND `device_model` = '$indi_device_model' AND  `device_barc_asset_id` = '$indi_device_barc_asset_id' AND `device_amc_id` = '$indi_device_amc_id' AND `device_use` ='$indi_device_use' AND `device_location` = '$indi_device_location' AND `device_tone` = '$indi_device_tone' AND `updatedbyip` = '$client_ip'";
				  $stmt_h= $this->db->prepare($sql_h);
				  $stmt_h->execute();
				  $result_h= $stmt_h->fetch(PDO::FETCH_ASSOC);
				  $pcautoid = $result_h['autoID'];
				  $result_h = $this->add_devicetransactionhistory($pcautoid,'ADDED',0,$loggedinby,'[Individual/Group Purchase]DEVICE ADDED BY USER)','','');
				// get id and add to pc history 
				 return $result;
}

public function indi_device_getAddedRecord($indi_device_purchase,$indi_device,$indi_device_supplier,$indi_device_indent_no,$indi_device_indent_dt,$indi_device_indent_by,$indi_device_po_no,$indi_device_po_dt,$indi_device_rv_no,$indi_device_rv_dt,$indi_device_cost,$indi_device_warranty,$indi_device_warranty_uptodate,$indi_device_make,$indi_device_model,$indi_device_barc_asset_id,$indi_device_amc_id,$indi_device_use,$indi_device_location,$indi_device_tone){
	$client_ip = get_client_ip();
	$sql = "SELECT * from tbl_printer_details WHERE `device_source` = '$indi_device_purchase' AND `device` = '$indi_device' AND `device_supplier_details` = '$indi_device_supplier' AND `device_indent_no` = '$indi_device_indent_no' AND `device_indent_dt` = '$indi_device_indent_dt' AND `device_indent_by` = '$indi_device_indent_by' AND `device_po_no` = '$indi_device_po_no' AND `device_po_dt` = '$indi_device_po_dt' AND `device_rv_no` = '$indi_device_rv_no' AND `device_rv_dt` = '$indi_device_rv_dt' AND `device_cost` = '$indi_device_cost' AND `warranty_in_years` = $indi_device_warranty AND `warranty_till` = '$indi_device_warranty_uptodate' AND `device_make` = '$indi_device_make' AND `device_model` = '$indi_device_model' AND  `device_barc_asset_id` = '$indi_device_barc_asset_id' AND `device_amc_id` = '$indi_device_amc_id' AND `device_use` ='$indi_device_use' AND `device_location` = '$indi_device_location' AND `device_tone` = '$indi_device_tone' AND `updatedbyip` = '$client_ip'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['autoID'];
	//return $sql;
	
}


public function Indi_editDevice($working_device,$indi_device_e_autoID,$indi_device_e,$indi_device_supplier_e,$indi_device_indent_no_e,$indi_device_indent_dt_e,$indi_device_indent_by_e,$indi_device_po_no_e,$indi_device_po_dt_e,$indi_device_rv_no_e,$indi_device_rv_dt_e,$indi_device_cost_e,$indi_device_warranty_e,$indi_device_warranty_uptodate_e,$indi_e_printer_make,$indi_device_model_e,$e_indi_printer_barc_asset_id,$e_indi_printer_amc_id,$e_indi_printer_use,$e_indi_printer_location_e,$indi_device_tone_e){
	$client_ip = get_client_ip();
	$loggedinby = $_SESSION['loggedinby'];
	$sql = "UPDATE `tbl_printer_details` SET `working` =$working_device, `device` = '$indi_device_e',`device_supplier_details` = '$indi_device_supplier_e',`device_indent_no` = '$indi_device_indent_no_e',`device_indent_dt` = '$indi_device_indent_dt_e',`device_indent_by` = '$indi_device_indent_by_e',`device_po_no`='$indi_device_po_no_e',`device_po_dt` = '$indi_device_po_dt_e',`device_rv_no` = '$indi_device_rv_no_e',`device_rv_dt` = '$indi_device_rv_dt_e',`device_cost` = '$indi_device_cost_e',`warranty_in_years` = '$indi_device_warranty_e',`warranty_till` = '$indi_device_warranty_uptodate_e',`device_make` = '$indi_e_printer_make',`device_model` = '$indi_device_model_e',`device_barc_asset_id` = '$e_indi_printer_barc_asset_id',`device_amc_id` ='$e_indi_printer_amc_id' ,`device_use` = '$e_indi_printer_use',`device_location` = '$e_indi_printer_location_e',`device_tone` = '$indi_device_tone_e',`updatedbyip` = '$client_ip' WHERE autoID = $indi_device_e_autoID";									
   	$stmt = $this->db->prepare($sql);
	 $result = $stmt->execute();
	  $result_h = $this->add_devicetransactionhistory($indi_device_e_autoID,'UPDATED',0,$loggedinby,'[Individual/Group Purchase]DEVICE UPDATED BY USER)',$sql,'');
	 return $result;
}

public function editborPrinter($e_bor_device_autoID,$bor_device_e,$bor_device_make_e,$bor_device_model_e,$bor_device_barc_asset_id_e,$bor_device_amc_id_e,$bor_device_use_e,$bor_device_location_e,$bor_device_tone_e,$e_bor_printer_working){
	$client_ip = get_client_ip();
	$loggedinby = $_SESSION['loggedinby'];
	$sql = "UPDATE `tbl_printer_details` SET `device` = '$bor_device_e',`device_make` = '$bor_device_make_e',`device_model`='$bor_device_model_e',`device_barc_asset_id` = '$bor_device_barc_asset_id_e',`device_amc_id` = '$bor_device_amc_id_e',`device_use` = '$bor_device_use_e',`device_location` = '$bor_device_location_e',`device_tone` = '$bor_device_tone_e',`working` = $e_bor_printer_working WHERE `autoID` = $e_bor_device_autoID";									
   	$stmt = $this->db->prepare($sql);
	 $result = $stmt->execute();
	  $result_h = $this->add_devicetransactionhistory($e_bor_device_autoID,'UPDATED',0,$loggedinby,'[BORROWED]DEVICE UPDATED BY USER)',$sql,'');
	 return $result;
}

public function getallinventory_desktop(){
	$sql = "SELECT a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_source,a.autoID,pur.pc_make,pur.pc_model,o.os_name,pur.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON pur.autoID = a.pc_make_model JOIN tbl_pc_os as o ON o.autoID = pur.pc_os_details WHERE a.pc_source = 'Centralize' AND a.current_status = 0 AND pur.pc_form = 'desktop' UNION ALL SELECT a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_source,a.autoID,a.pc_make,a.pc_processor_details,o.os_name,a.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.pc_source <> 'Centralize' AND a.current_status = 0 AND a.pc_form = 'desktop' ";		
	
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}



public function getallinventory_other_desktop(){
	$sql = "SELECT a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_source,a.autoID,pur.pc_make,pur.pc_model,o.os_name,pur.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON pur.autoID = a.pc_make_model JOIN tbl_pc_os as o ON o.autoID = pur.pc_os_details WHERE a.pc_source = 'Centralize' AND a.current_status NOT IN (0,1) AND pur.pc_form = 'desktop' UNION ALL SELECT a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_source,a.autoID,a.pc_make,a.pc_processor_details,o.os_name,a.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.pc_source <> 'Centralize' AND a.current_status NOT IN (0,1) AND a.pc_form = 'desktop' ";		
	
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}


public function getallinventory_laptop(){
	$sql = "SELECT a.pc_source,a.autoID,pur.pc_make,pur.pc_model,o.os_name,pur.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_make as pur ON pur.autoID = a.pc_make_model JOIN tbl_pc_os as o ON o.autoID = pur.pc_os_details WHERE a.pc_source = 'Centralize' AND a.current_status = 0 AND pur.pc_form = 'laptop' UNION ALL SELECT a.pc_source,a.autoID,a.pc_make,a.pc_processor_details,o.os_name,a.pc_form,a.pc_user_emp,a.current_status,a.pc_barc_asset_id,a.pc_amc_id FROM tbl_pc_details as a JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.pc_source <> 'Centralize' AND a.current_status = 0 AND a.pc_form = 'laptop' ";		
	
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getallinventory_desktoplog($id){
	$sql = "SELECT * FROM pc_transaction_log WHERE pc_table_id = $id ORDER BY transactiondatetime DESC";		
	
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}


public function getsuppliersuggesstion($kw){
	$data = array();
	$sql = "SELECT * FROM tbl_pc_details WHERE `pc_supplier_name` LIKE '%$kw%' AND pc_make_model IS NULL AND pc_supplier_name <> 'na'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
}


public function getsuppliersuggesstion_printer($kw){
	$data = array();
	$sql = "SELECT a.device_supplier_details,a.rvfileuploaded,d.device_make,a.device_tone,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.device,a.device_model,a.device_use,a.device_indent_no, a.device_indent_dt, a.device_indent_by, a.autoID, a.device_user_emp, a.device_user_group, a.device_barc_asset_id, a.device_amc_id, a.device_po_no, a.device_po_dt, a.device_rv_no, a.device_rv_dt, a.device_cost, a.device_source, a.device_location, a.device_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.device_added_on, a.isdeleted from tbl_printer_details as a JOIN tbl_users as e ON a.device_user_emp = e.emp_no JOIN tbl_printer_make as d ON d.autoID = a.device_make WHERE a.isdeleted = 0 and a.current_status = 1 AND a.device_source <> 'Centralize' AND `device_supplier_details` LIKE '%$kw%' AND device_make_model IS NULL AND a.device_supplier_details <> 'na'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
}

public function getallnotifications(){
	$sql = "SELECT * FROM tbl_notification WHERE isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function get_noti_in_header(){
	$data = array();
	$sql = "SELECT * FROM tbl_notification WHERE isdeleted = 0 AND noti_active = 1 AND CURDATE()<active_till ORDER BY autoID DESC";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}

public function get_noti_count(){
			$chksql = "SELECT * FROM tbl_notification WHERE isdeleted = 0 AND noti_active = 1 AND active_till>CURDATE()";
			$stmt = $this->db->prepare($chksql);
			$stmt->bindParam(':empno', $empno);  
			$stmt->bindParam(':pass', $pass);
			$stmt->execute();
			return $stmt->rowCount();
}

public function getsinglenotification($id){
	$sql = "SELECT * FROM tbl_notification WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result; 
}



public function addnotification($noti_title,$noti_description,$valid_till,$noti_link){
	$client_ip = get_client_ip();
	$loggedinby = $_SESSION['loggedinby'];
	$sql_i = "INSERT INTO tbl_notification (`noti_title`, `noti_description`,`active_till`,`noti_link`,`addedby`,`addedbyip`) VALUES (:noti_title,:noti_description,:valid_till,:noti_link,:addedby,:addedbyip)";
	$stmt_i = $this->db->prepare($sql_i);
	$stmt_i->bindValue(':noti_title', $noti_title);
	$stmt_i->bindValue(':noti_description', $noti_description);
	$stmt_i->bindValue(':valid_till', $valid_till);
	$stmt_i->bindValue(':noti_link', $noti_link);
	$stmt_i->bindValue(':addedby', $loggedinby);
	$stmt_i->bindValue(':addedbyip', $client_ip);
	$result_i = $stmt_i->execute();
	return $result_i;
}

public function deletenotification($id){
	$sql = "UPDATE tbl_notification SET isdeleted = 1 WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}

public function activateNotification($id,$op){
	$sql = "UPDATE tbl_notification SET noti_active = $op WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);
	 $result = $stmt->execute();
	 return $result;
}

public function editnotification($tit,$desc,$valid_till,$lnk,$id){
	$sql = "UPDATE tbl_notification SET noti_title = '$tit', noti_description = '$desc', active_till = '$valid_till', noti_link = '$lnk' WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);
	 $result = $stmt->execute();
	 return $result;
}

public function get_devicepurchase_makemodel($mkmdl){
	$sql = "SELECT pur.device,mk.device_make as mk,pur.device_make,pur.device_model,pd.device_source FROM tbl_printer_purchase as pur JOIN tbl_printer_details as pd ON pd.device_make_model = pur.autoID JOIN tbl_printer_make as mk ON mk.autoID = pur.device_make WHERE pd.device_make_model = $mkmdl";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result; 
}

public function getgroupnamebyid($id){
	$sql = "SELECT * from tbl_groups WHERE autoID=$id AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['grp_name'];
}

public function getgrouppc_bygroup($id){
	$sql = "(SELECT a.working,pur.rvfileuploaded,pur.rvfilename,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.pc_form,a.pc_make, a.pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID LEFT JOIN tbl_pc_make as pur ON pur.autoID <> a.pc_make_model JOIN tbl_users as e ON a.pc_user_emp = e.emp_no WHERE a.pc_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source <> 'Centralize' ORDER BY a.pc_user_emp ) UNION (SELECT a.working,pur.rvfilename,pur.rvfileuploaded,e.emp_name,e.emp_title, e.emp_no,e.emp_desig, pur.pc_form,pur.pc_make, pur.pc_model as pc_processor_details,a.pc_use,o.os_name,o.os_of,a.pc_indent_no, a.pc_indent_dt, a.pc_indent_by, a.autoID, a.pc_os , a.pc_monitor_details, a.pc_bit_type, a.pc_ram_value, a.pc_hdd, a.pc_nic_number, a.pc_setup, a.pc_ip, a.pc_user_emp, a.pc_user_group, a.pc_barc_asset_id, a.pc_amc_id, a.pc_po_no, a.pc_po_dt, a.pc_rv_no, a.pc_rv_dt, a.pc_cost, a.pc_source, a.network_port_no, a.pc_location, a.pc_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.pc_added_on, a.isdeleted from tbl_pc_details as a JOIN tbl_pc_os as o ON a.pc_os = o.autoID  JOIN tbl_pc_make as pur ON a.pc_make_model = pur.autoID JOIN tbl_users as e ON a.pc_user_emp = e.emp_no WHERE a.pc_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.pc_source = 'Centralize' ORDER BY a.pc_user_emp )";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getgroupdevice_bygroup($id){
		
	
	$sql = "SELECT a.rvfilename,a.working,a.device_make_model,a.rvfileuploaded,d.device_make,a.device_tone,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.device,a.device_model,a.device_use,a.device_indent_no, a.device_indent_dt, a.device_indent_by, a.autoID, a.device_user_emp, a.device_user_group, a.device_barc_asset_id, a.device_amc_id, a.device_po_no, a.device_po_dt, a.device_rv_no, a.device_rv_dt, a.device_cost, a.device_source, a.device_location, a.device_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.device_added_on, a.isdeleted from tbl_printer_details as a JOIN tbl_users as e ON a.device_user_emp = e.emp_no JOIN tbl_printer_make as d ON d.autoID = a.device_make WHERE a.device_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.device_source <> 'Centralize' UNION SELECT a.rvfilename,a.working,a.device_make_model,a.rvfileuploaded,d.device_make,a.device_tone,e.emp_name,e.emp_title, e.emp_no,e.emp_desig,a.device,a.device_model,a.device_use,a.device_indent_no, a.device_indent_dt, a.device_indent_by, a.autoID, a.device_user_emp, a.device_user_group, a.device_barc_asset_id, a.device_amc_id, a.device_po_no, a.device_po_dt, a.device_rv_no, a.device_rv_dt, a.device_cost, a.device_source, a.device_location, a.device_use, a.under_amc,a.warranty_in_years, a.warranty_till, a.groupadmin_approval, a.sysadmin_approval, a.groupadmin_approvedon, a.sysadmin_approvedon, a.device_added_on, a.isdeleted from tbl_printer_details as a JOIN tbl_users as e ON a.device_user_emp = e.emp_no JOIN tbl_printer_purchase as d ON d.autoID = a.device_make_model WHERE a.device_user_emp IN (SELECT emp_no from tbl_users WHERE emp_grp_autoID = $id) and a.isdeleted = 0 and a.current_status = 1 AND a.device_source = 'Centralize'  ";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}


public function getgrouppc_bygroupemps($id){
		
	
	$sql = "SELECT * FROM tbl_users WHERE emp_grp_autoID = $id";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}
public function getnoofpcemp($id){
	$sql = "SELECT COUNT(*) as cnt FROM `tbl_pc_details` WHERE `pc_user_emp` = $id AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['cnt'];
}

public function getnoofprinteremp($id){
	$sql = "SELECT COUNT(*) as cnt FROM `tbl_printer_details` WHERE `device_user_emp` = $id AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['cnt'];
}

public function getalllogs(){
	$sql = "SELECT * FROM `tbl_transactions` ORDER BY `tbl_transactions`.`autoID` ASC ";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getuserdetailsfromempno($uid){
	$sql = "SELECT * FROM tbl_users WHERE emp_no = $uid";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['emp_title'].' '.$result['emp_name'];
}

public function get_emp_by_empno($empno){ // inv management
	$sql = "SELECT e.emp_no,e.emp_title,e.emp_name,e.emp_desig,e.emp_grp_autoID,g.grp_name FROM tbl_users as e JOIN tbl_groups as g ON g.autoID = e.emp_grp_autoID WHERE e.isdeleted = 0 AND e.emp_no=$empno";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

public function re_assignpc($pcid,$emp){
	$sql = "UPDATE tbl_pc_details SET `pc_user_emp` = $emp, `current_status`=1, `groupadmin_approval`=0, groupadmin_approved_by=NULL,groupadmin_approvedon='' WHERE autoID = $pcid";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}



public function updatestatuspc($pcid,$status){
	$sql = "UPDATE tbl_pc_details SET `pc_user_emp` = 0, `current_status`=$status WHERE autoID = $pcid";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}

//  GET ALL INFORMATION PC

public function getallinformation_pc(){
	$sql = "SELECT a.groupadmin_approval,a.current_status,a.pc_make_model,u.emp_desig,u.emp_extn,a.pc_form, a.working,g.grp_name,a.rvfilename,a.rvfileuploaded,o.os_name,o.os_of,u.emp_no, u.emp_title, u.emp_name,u.emp_desig,a.pc_make_model,a.pc_supplier_name,a.pc_indent_no,a.pc_indent_dt,a.pc_indent_by,a.autoID,a.pc_os,a.pc_make,a.pc_processor_details,a.pc_monitor_details,a.pc_bit_type,a.pc_ram_value,a.pc_hdd,a.pc_ssd,a.pc_nic_number,a.pc_setup,a.pc_ip,a.pc_user_emp,a.pc_user_group,a.pc_barc_asset_id,a.pc_amc_id,a.pc_po_no,a.pc_po_dt,a.pc_rv_no,a.pc_rv_dt,a.pc_cost,a.pc_source,a.network_port_no,a.pc_location,a.pc_use,a.under_amc,a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.pc_added_on, a.isdeleted FROM tbl_pc_details as a JOIN tbl_users as u ON u.emp_no = a.pc_user_emp JOIN tbl_groups as g ON g.autoID = u.emp_grp_autoID JOIN tbl_pc_os as o ON o.autoID = a.pc_os WHERE a.isdeleted = 0 AND a.current_status = 1";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getallinformation_device(){ 
	
	
	$sql = "SELECT g.grp_name,e.emp_desig,e.emp_no,e.emp_title,e.emp_name, a.device_supplier_details,a.device,
	a.device_make_model,a.device_indent_no,a.device_indent_dt,a.device_indent_by,a.autoID,
	a.device_make,a.device_model,a.device_tone,a.device_user_emp,
	a.device_user_group,a.device_barc_asset_id,a.device_amc_id,a.device_po_no,
	a.device_po_dt,a.device_rv_no,a.device_rv_dt,a.rvfileuploaded,a.rvfilename,
	a.device_cost,a.device_source,a.device_location,a.device_use,a.under_amc,
	a.warranty_in_years,a.warranty_till,a.groupadmin_approval,a.groupadmin_approved_by,
	a.sysadmin_approval,a.groupadmin_approvedon,a.sysadmin_approvedon,a.device_added_on,a.isdeleted,a.updatedbyip,a.updatedon,a.current_status,a.working FROM tbl_printer_details as a JOIN tbl_users as e ON e.emp_no = a.device_user_emp JOIN tbl_groups as g ON g.autoID = e.emp_grp_autoID WHERE a.isdeleted = 0 AND a.current_status = 1";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function checkaimsid($id){
		$sql = "SELECT * from tbl_pc_details WHERE autoID =$id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}
	

	public function checkaimsid_device($id){
		$sql = "SELECT * from tbl_printer_details WHERE autoID =$id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}


public function getmaxaimsid(){	
		$sql = "SELECT COUNT(*)+1 as aimsid from tbl_pc_details WHERE aimsid <> '0'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['aimsid'];	
}


public function getmaxaimsid_device(){
	$sql = "SELECT COUNT(*)+1 as aimsid from tbl_printer_details WHERE aimsid <> '0'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['aimsid'];
}

public function addjob_print($req_emp_name,$prnt_desig,$prnt_div,$prnt_sec,$prnt_phone,$prnt_email,$prnt_work,$prnt_noorg,$prnt_nopgs,$prnt_doctype,$instr){ 
	$client_ip = get_client_ip();
	$updatedby=$_SESSION['loggedinby'];
	$sql = "INSERT INTO `prnt_job` (`prnt_req_name`,`prnt_req_desig`,`prnt_req_div`,`prnt_req_sec`,`prnt_req_phone`,`prnt_req_email`,`prnt_name_of_work`,`prnt_no_org`,`prnt_no_pages`,`prnt_doc_type`,`initiated_by`,`initiated_by_ip`,`job_instr`) 
							VALUES (:req_emp_name,:prnt_desig,:prnt_div,:prnt_sec,:prnt_phone,:prnt_email,:prnt_work,:prnt_no_org,:prnt_no_pages,:prnt_doc_type,:initiated_by,:initiated_by_ip,:job_instr)";
	$stmt = $this->db->prepare($sql);																																			
	$stmt->bindValue(':req_emp_name', $req_emp_name);
	$stmt->bindValue(':prnt_desig', $prnt_desig);
	$stmt->bindValue(':prnt_div', $prnt_div);
	$stmt->bindValue(':prnt_sec', $prnt_sec);
	$stmt->bindValue(':prnt_phone', $prnt_phone);
	$stmt->bindValue(':prnt_email', $prnt_email);
	$stmt->bindValue(':prnt_work', $prnt_work);
	$stmt->bindValue(':prnt_no_org', $prnt_noorg);
	$stmt->bindValue(':prnt_no_pages', $prnt_nopgs);
	$stmt->bindValue(':prnt_doc_type', $prnt_doctype);
	$stmt->bindValue(':initiated_by', $updatedby);
	$stmt->bindValue(':initiated_by_ip',$client_ip);
	$stmt->bindValue(':job_instr',$instr);
	$result = $stmt->execute();
	return  $result;
}

public function get_print_job_ack($req_emp_name,$prnt_desig,$prnt_div,$prnt_sec,$prnt_phone,$prnt_email,$prnt_work){
	$client_ip = get_client_ip();
	$updatedby=$_SESSION['loggedinby'];
	$sql = "SELECT MAX(autoID) as maxauto from prnt_job WHERE `prnt_req_name` = '$req_emp_name' AND `prnt_req_desig` = '$prnt_desig' AND `prnt_req_div` = '$prnt_div' AND `prnt_req_sec` = '$prnt_sec' AND `prnt_req_phone` = '$prnt_phone' AND `prnt_req_email` = '$prnt_email' AND `prnt_name_of_work` = '$prnt_work' AND `initiated_by` = '$updatedby' AND `initiated_by_ip` = '$client_ip'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['maxauto'];
	//return $sql;
}



public function enter_jobs_services($res,$s,$j,$jn,$s1,$s2,$assign){ 
	$client_ip = get_client_ip();
	$updatedby=$_SESSION['loggedinby'];
	$sql = "INSERT INTO `prnt_job_detail` (`prnt_autoID`,`prnt_job_type`,`prnt_job`,`prnt_jobnum`,`prnt_spec1`,`prnt_spec2`,`assignedto`,`assignedby`) 
							VALUES (:res,:prnt_job_type,:prnt_job,:prnt_jobnum,:prnt_spec1,:prnt_spec2,:assignedto,:assignedby)";
	$stmt = $this->db->prepare($sql);																																			
	$stmt->bindValue(':res', $res);
	$stmt->bindValue(':prnt_job_type', $s);
	$stmt->bindValue(':prnt_job', $j);
	$stmt->bindValue(':prnt_jobnum', $jn);
	$stmt->bindValue(':prnt_spec1', $s1);
	$stmt->bindValue(':prnt_spec2', $s2);
	$stmt->bindValue(':assignedto', $assign);
	$stmt->bindValue(':assignedby', $updatedby);
	$result = $stmt->execute();
	return  $result;
}

public function get_emp_by_empno_IN($kw){
	$data = array();
	$sql = "SELECT * FROM barc WHERE `empname` LIKE '%$kw%'";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
}

public function getalljobs(){
	$sql = "SELECT u.emp_title,u.emp_name,a.autoID,a.prnt_req_name,a.prnt_req_desig,a.prnt_req_div,a.prnt_req_sec,a.prnt_req_phone,a.prnt_req_email,a.prnt_name_of_work,a.prnt_no_org,a.prnt_no_pages,a.prnt_doc_type,a.initiated_on,a.updatedon,a.initiated_by,a.initiated_by_ip,a.isdeleted,a.job_instr,a.job_status FROM prnt_job as a JOIN tbl_users as u on u.emp_no = a.initiated_by WHERE a.isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

public function getalljobs_user($listing){
	$user=$_SESSION['loggedinby'];
	if($listing=='all'){
		$sql = "SELECT DISTINCT j.prnt_status,u.emp_title,u.emp_name,a.autoID,a.prnt_req_name,a.prnt_req_desig,a.prnt_req_div,a.prnt_req_sec,a.prnt_req_phone,a.prnt_req_email,a.prnt_name_of_work,a.prnt_no_org,a.prnt_no_pages,a.prnt_doc_type,a.initiated_on,a.updatedon,a.initiated_by,a.initiated_by_ip,a.isdeleted,a.job_instr,a.job_status FROM prnt_job as a JOIN prnt_job_detail as j ON j.prnt_autoID = a.autoID JOIN tbl_users as u ON u.emp_no = a.initiated_by WHERE j.assignedto = $user AND a.isdeleted = 0 ORDER BY autoID DESC";
	}else{
		$sql = "SELECT DISTINCT j.prnt_status,u.emp_title,u.emp_name,a.autoID,a.prnt_req_name,a.prnt_req_desig,a.prnt_req_div,a.prnt_req_sec,a.prnt_req_phone,a.prnt_req_email,a.prnt_name_of_work,a.prnt_no_org,a.prnt_no_pages,a.prnt_doc_type,a.initiated_on,a.updatedon,a.initiated_by,a.initiated_by_ip,a.isdeleted,a.job_instr,a.job_status FROM prnt_job as a JOIN prnt_job_detail as j ON j.prnt_autoID = a.autoID JOIN tbl_users as u ON u.emp_no = a.initiated_by WHERE j.assignedto = $user AND a.isdeleted = 0 AND a.job_status =0 ORDER BY autoID DESC";
	}
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}



public function get_assignto_print($autoID){
	$data = array();
	$sql = "SELECT DISTINCT d.doneby,u.emp_name,u.emp_no,d.prnt_status FROM tbl_users as u JOIN prnt_job_detail as d ON d.assignedto = u.emp_no WHERE prnt_autoID = $autoID";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}

public function get_job_services($autoID){
	$data = array();
	$sql = "SELECT DISTINCT prnt_job,prnt_job_type,prnt_jobnum,prnt_spec1,prnt_spec2 FROM prnt_job_detail WHERE prnt_autoID = $autoID";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}


public function process_job_print($ato,$status,$id){
	$client_ip = get_client_ip();
	$uid = $_SESSION['loggedinby'];
	$sql = "UPDATE prnt_job_detail SET `doneby` = $ato, `prnt_status`=$status,doneon = now(), updatedbyip ='$client_ip', updatedby = $uid WHERE prnt_autoID = $id AND assignedto = $ato";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}



public function clear_prev_job_assignment($id){
	$clear_sql = "UPDATE prnt_job_detail SET `doneby` = null, `prnt_status`=0,doneon = null WHERE prnt_autoID = $id";
	$clear_stmt = $this->db->prepare($clear_sql);	
	$clear_result = $clear_stmt->execute();
	return $clear_result;
}


public function get_job_log($autoID){
	$data = array();
	$sql = "SELECT u.emp_name,u.emp_title,l.action_by,l.prnt_action,l.prnt_action_on FROM tbl_users as u JOIN tbl_printing_log as l ON l.action_by = u.emp_no WHERE prnt_job_autoID = $autoID ORDER BY l.autoID";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}

public function process_job_status($s,$id){
	$sql = "UPDATE prnt_job SET `job_status`=$s WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return $result;
}


public function deleteprintingjob($id){
	$sql = "UPDATE prnt_job SET isdeleted = 1 WHERE autoID = $id";
	$stmt = $this->db->prepare($sql);	
	$result = $stmt->execute();
	return  $result;
}


public function get_print_job_data_edit($id){
	$sql = "SELECT * from prnt_job WHERE autoID=$id AND isdeleted = 0";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result; 
}

public function get_print_job_services($id){
	$sql = "SELECT * from prnt_job_detail WHERE prnt_autoID=$id";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row){
		$data[] = $row;
	}
	return $data;
}

public function get_prnt_job_count(){
	$user=$_SESSION['loggedinby'];
	$chksql = "SELECT * FROM `prnt_job_detail` WHERE prnt_status = 0 AND assignedto = $user";
	$stmt = $this->db->prepare($chksql);
	$stmt->execute();
	return $stmt->rowCount();
}

public function get_tasks_in_header(){

	$user=$_SESSION['loggedinby'];
	$sql = "SELECT DISTINCT u.emp_title,u.emp_name,a.autoID,a.prnt_req_name,a.prnt_req_desig,a.prnt_req_div,a.prnt_req_sec,a.prnt_req_phone,a.prnt_req_email,a.prnt_name_of_work,a.prnt_no_org,a.prnt_no_pages,a.prnt_doc_type,a.initiated_on,a.updatedon,a.initiated_by,a.initiated_by_ip,a.isdeleted,a.job_instr,a.job_status FROM prnt_job as a JOIN prnt_job_detail as j ON j.prnt_autoID = a.autoID JOIN tbl_users as u ON u.emp_no = a.initiated_by WHERE j.assignedto = $user AND a.isdeleted = 0 AND j.prnt_status <3";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}


}

