<?php
	include_once(base_dir."classes/db.class.php");

	class coupons extends db{
		function coupons(){
			self::getInstance();
		}

		function make_discount($cpn_code, $total_amt, $tp_id, $std_id){
			date_default_timezone_set('Asia/Calcutta');

			$this->select("coupons", "id, discount, exp_date, used_by", "name='$cpn_code'", "none", "1");
			if($this->sel_count_row>0){
				$discount=$this->select_res['discount'];
				$new_amt=$total_amt-$discount;
				$exp_date_arr=explode("-", $this->select_res['exp_date']);
				$exp_time=mktime(0, 0, 0, $exp_date_arr[2], $exp_date_arr[1], $exp_date_arr[0]);
				$crnt_time=time();
				if($exp_time>$crnt_time){
					$cpn_id=$this->select_res['id'];
					if($this->select_res['used_by']!=""){
						$old_reciver=json_decode($this->select_res['used_by'], true);
						$old_reciver[]=array('std_id'=>$std_id, 'tp_id'=>$tp_id);
						$new_reciver=json_encode($old_reciver);
					}else{
						$new_reciver=json_encode(array(array('std_id'=>$std_id, 'tp_id'=>$tp_id)));
					}
					$this->update("coupons", "used_by='$new_reciver'", "id='$cpn_id'", "1");
					return $new_amt;
				}else{
					return $total_amt;
				}
			}else{
				return $total_amt;
			}
		}
	}



?>