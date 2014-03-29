<?php
define('root_dir', '../');
if(isset($_POST['puzzle_ans'])&&isset($_POST['money'])&&isset($_POST['puzzle_no'])&&isset($_POST['game_id'])){
	$puzzle_no=$_POST['puzzle_no'];
	$ans=$_POST['puzzle_ans'];
	$money=$_POST['money'];
	$game_id=$_POST['game_id'];
	$res=0;
	if($money>=5){
		session_start();
		if(isset($_SESSION['user_id'])){
			$user_id=$_SESSION['user_id'];
			include_once("../classes/user.class.php");
			$data=new user($user_id);
			$user=$data->get_basic_info();
			$user_bal=$user['balance'];
			$game_status=$user['game_status'];
			if($game_status==0){
				if($money<=$user_bal){
					$new_bal=$user_bal-$money;
					$game_status=json_encode(array($game_id, $puzzle_no, $ans, $money));
					$data->select("t1_games", "*", "none", "id DESC", "1");
					if($data->sel_count_row>0){
						$crnt_game_id=$data->select_res['id'];
						if($game_id==$crnt_game_id){
							$option=$puzzle_no."_plrs";
							if($data->select_res[$option]!=""){
								$crnt_plrs=json_decode($data->select_res[$option], true);
								$crnt_plrs[]=array($user_id, $ans, $money);
								$new_plrs=$crnt_plrs;
							}else{
								$new_plrs=array(array($user_id, $ans, $money));
							}
							$new_plrs_str=json_encode($new_plrs);
							$new_total_plrs=$data->select_res['crnt_plrs']+1;
							$new_total_money=$data->select_res['crnt_money']+1;
							$data->update("t1_games", "crnt_plrs='$new_total_plrs', crnt_money='$new_total_money', $option='$new_plrs_str'", "id='$game_id'", "id DESC", "1");
							$data->update("users", "balance='$new_bal', game_status='$game_status'", "id='$user_id'", "none", "1");
							$res="You have Joined the Game Successfully. Now Wait for result!";

						}else{
							$res="You have missed this game, because time is over. Please refresh the page for new game!";
						}
					}else{
						$res="SOME ERROR!";
					}
				}else{
					$res="Your balance is low!";
				}
			}else{
				$res="You already Joined this Game Table!";
			}
		}else{

		}
	}else{
		$res="Invested monesy should be greater than 5 tacs.";
	}
}else{

}

echo $res;


?>