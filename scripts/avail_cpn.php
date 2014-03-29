<?php
if(isset($_POST['cpn_code'])){
	include_once("../classes/db.class.php");
	$dbh=new db();
date_default_timezone_set('Asia/Calcutta');

	$cpn_code=$_POST['cpn_code'];
	$dbh->select("coupons", "discount, exp_date", "name='$cpn_code'", "none", "1");
	if($dbh->sel_count_row>0){
		$exp_date_arr=explode("-", $dbh->select_res['exp_date']);
		$exp_time=mktime(0, 0, 0, $exp_date_arr[0], $exp_date_arr[1], $exp_date_arr[2]);
		$crnt_time=time();
		if($exp_time>$crnt_time){
			$dis_amt=$dbh->select_res['discount'];
			echo $dis_amt;
		}else{
			echo 'error';
		}
			
	}else{
		echo 'error';
	}
}else{
	echo 'error';
}

?>