<?php
session_start();
class session{
	public $present=false;
	public function session($session_of){
		if(isset($_SESSION[$session_of])){
			$this->present=true;
			$this->$session_of=$_SESSION[$session_of];
		}else{
			$this->present=false;
		}
	}
}

$crnt_session=new session("std_id");
if(!$crnt_session->present){
	$login_page="index.php";
	echo "Session ID not set";
	if(file_exists($login_page)){
		header("Location:".$login_page."?Session Expired! Please Login!");
	}else if(file_exists("../".$login_page)){
		header("Location:../".$login_page."?Session Expired! Please Login!");
	}else{
		echo "Session expired. Please login again by going to Login Page!";
		exit();
	}
		
	exit();
}
?>