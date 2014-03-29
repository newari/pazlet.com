<?php
include_once(root_dir."classes/db.class.php");

class user extends db{
	function user($user_id=null){
		if(!isset($user_id)){
			if(!isset($_SESSION)){
				session_start();
			}
			$user_id=$_SESSION['user_id'];
		}
		$this->user_id=$user_id;
		self::getInstance();
	}

	function get_basic_info($user_id=null){
		if(!isset($user_id)){
			$user_id=$this->user_id;
		}
		$this->select("users", "first_name, last_name, balance, game_status", "id='$user_id'", "none", "1");
		if($this->sel_count_row>0){
			$this->select_res['name']=ucfirst($this->select_res['first_name'])." ".ucfirst($this->select_res['last_name']);
			return $this->select_res;
		}else{
			return false;
		}

	}


}



?>