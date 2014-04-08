<?php
include_once(root_dir."classes/db.class.php");

class game extends db{
	public $game_id;
	function game(){
		self::getInstance();
		$this->select("t1_games", "id", "none", "id DESC", "1");
		$this->game_id=$this->select_res['id'];
	}

	function get_content($game_id=null){
		if(!isset($game_id)){
			$game_id=$this->game_id;
		}
		$this->select('t1_content', 'a_content, b_content, c_content, d_content, e_content', "game_id='$game_id'", "none", "1");
		if($this->sel_count_row>0){
			$this->a_puzzle=$this->select_res['a_content'];
			$this->b_puzzle=$this->select_res['b_content'];
			$this->c_puzzle=$this->select_res['c_content'];
			$this->d_puzzle=$this->select_res['d_content'];
			$this->e_puzzle=$this->select_res['e_content'];
		}else{
			return false;
		}

	}
}

?>