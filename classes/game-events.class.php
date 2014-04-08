<?php
include_once(root_dir."classes/db.class.php");

class game_event extends db{
	public $game_id;
	function game_event(){
		self::getInstance();
		$this->select("t1_games", "id", "none", "id DESC", "1");
		$this->last_game_id=$this->select_res['id'];
		$this->crnt_time=time();
	}
	function start_game(){

		$this->insert("t1_content", "time='$this->crnt_time'");
		if(mysql_insert_id()>0){
			$content_id=mysql_insert_id();
			$this->select("puzzles", "id, puzzle_src, used", "none", "last_used ASC", "5");
			$i=1;
			foreach($this->select_res as $puz){
				switch($i){
					case 1:
						$this->update("t1_content", "a_content='$puz[puzzle_src]'", "id='$content_id'", "1");
					case 2:
						$this->update("t1_content", "b_content='$puz[puzzle_src]'", "id='$content_id'", "1");
					case 3:
						$this->update("t1_content", "c_content='$puz[puzzle_src]'", "id='$content_id'", "1");
					case 4:
						$this->update("t1_content", "d_content='$puz[puzzle_src]'", "id='$content_id'", "1");
					case 5:
						$this->update("t1_content", "e_content='$puz[puzzle_src]'", "id='$content_id'", "1");

				}
				$i++;
				$used=$puz['used']+1;
				$this->update("puzzles", "last_used='$this->crnt_time', used='$used'", "id='$puz[id]'", "1");
			}
			$this->insert("t1_games", "start_time='$this->crnt_time', content_table_id='$content_id'");
			$game_id=mysql_insert_id();
			$this->update("t1_content", "game_id='$game_id'", "id='$content_id'", "1");
		}else{
			return false;
		}
			

	}
	function get_correct_ans($game_id){
		$this->select("t1_content", "a_content, b_content, c_content, d_content, e_content", "game_id='$game_id'", "none", "1");
		$puzzles=$this->select_res;
		if($this->sel_count_row>0){
			$ans=array();
			foreach ($puzzles as $pk => $puz_src) {

				$this->select("puzzles", "ans", "puzzle_src='$puz_src'", "none", "1");
				if($pk=='a_content'){
					$ans['a']=$this->select_res['ans'];
				}else if($pk=='b_content'){
					$ans['b']=$this->select_res['ans'];
				}else if($pk=='c_content'){
					$ans['c']=$this->select_res['ans'];
				}else if($pk=='d_content'){
					$ans['d']=$this->select_res['ans'];
				}else if($pk=='e_content'){
					$ans['e']=$this->select_res['ans'];
				}
				
			}
			return $ans;
		}else{
			return false;
		}
			
	}

	function create_result($game_id=null){
		$this->select("t1_games", "crnt_plrs, crnt_money, a_plrs, b_plrs, c_plrs, d_plrs, e_plrs", "id='$this->last_game_id'", "none", "1");
		$plrs['a']=json_decode($this->select_res['a_plrs'], true);
		$plrs['b']=json_decode($this->select_res['b_plrs'], true);
		$plrs['c']=json_decode($this->select_res['c_plrs'], true);
		$plrs['d']=json_decode($this->select_res['d_plrs'], true);
		$plrs['e']=json_decode($this->select_res['e_plrs'], true);
		$total_money=$this->select_res['crnt_money'];
		$total_points=$total_money;
		$ans=$this->get_correct_ans($this->last_game_id);
		$total_plrs_arr=array('a'=>count($plrs['a']), 'b'=>count($plrs['b']), 'c'=>count($plrs['c']), 'd'=>count($plrs['d']), 'e'=>count($plrs['e']));
		asort($total_plrs_arr);
		$total_plrs=0;
		$ordered_list=array();
		foreach($total_plrs_arr as $key=>$val){
			$total_plrs+=$val;
			$ordered_list[]=$key;
		}
		$winner_points=0;
		$money=0;
		$winner_list=array();
		for($i=0; $i<4; $i++){
			if(is_array($plrs[$ordered_list[$i]])){
				foreach($plrs[$ordered_list[$i]] as $user_key=>$user_data){
					if($ans[$ordered_list[$i]]==$user_data[1]){
						$winner_list[]=$user_data;
						$winner_points+=$user_data[2];
						$money+=$user_data[2];
					}else{
						$money+=$user_data[2];
					}
				}
			}
		}

		if($winner_points>0){
			$total_money=$total_money*0.9;
			$point_cost=intval($total_money/$winner_points);
		}else{
			$point_cost=0;
		}

		foreach ($winner_list as $wk => $user){
			$money_won=$point_cost*$user[2];
			$this->select("users", "balance", "id='$user[0]'", "none", "1");
			$new_bal=$this->select_res['balance']+$money_won;
			$this->update("users", "balance='$new_bal'", "id='$user[0]'", "1");
		}

		if(is_array($plrs['a'])){
			foreach($plrs['a'] as $plr){
				$this->update("users", "game_status=''", "id='$plr[0]'", "1");
			}
		}

		if(is_array($plrs['b'])){
			foreach($plrs['b'] as $plr){
				$this->update("users", "game_status=''", "id='$plr[0]'", "1");
			}
		}

		if(is_array($plrs['c'])){
			foreach($plrs['c'] as $plr){
				$this->update("users", "game_status=''", "id='$plr[0]'", "1");
			}
		}

		if(is_array($plrs['d'])){
			foreach($plrs['d'] as $plr){
				$this->update("users", "game_status=''", "id='$plr[0]'", "1");
			}
		}

		if(is_array($plrs['e'])){
			foreach($plrs['e'] as $plr){
				$this->update("users", "game_status=''", "id='$plr[0]'", "1");
			}
		}
		
	}
}

?>