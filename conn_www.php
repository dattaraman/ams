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
			//$hostname = "10.25.1.200";
			//$dbname = "barcweb";
			//$username = "irms";             
			//$password = "irms@2018";

			$hostname = "localhost";
			$dbname = "barcweb";
			$username = "root";             
			$password = "";
			$this->db = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
		}


		public function getempsuggesstion($kw){
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
}

