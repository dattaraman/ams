<?php
	session_start();
	include('conn.php');
	$log = new Newdash();
	$log->log_activity('LOGOUT');
	$log->logout();