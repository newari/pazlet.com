<?php
define('root_dir', '../');
if(isset($_POST['activation_code'])&&isset($_POST['reg_id'])){
	include_once(root_dir."classes/db.class.php");
	$dbh=new db();
	$activation_code=mysql_real_escape_string($_POST['activation_code']);
	$reg_id=mysql_real_escape_string($_POST['reg_id']);
	$dbh->select("tmp_users", "first_name, last_name, mobile, email, password, activation_code", "id='$reg_id'", "id DESC", "1");
	if($dbh->sel_count_row>0){
		if($activation_code==$dbh->select_res['activation_code']){
			$fname=$dbh->select_res['first_name'];
			$lname=$dbh->select_res['last_name'];
			$mobile=$dbh->select_res['mobile'];
			$email=$dbh->select_res['email'];
			$password=$dbh->select_res['password'];
			$dbh->select("users", "id", "mobile='$mobile'", "none", "none");
			if($dbh->sel_count_row>0){
				header("Location:../login.php?msg=You are already registered! Please Login!&msg_clr=red");
				exit();
			}else{
				$dbh->insert("users", "first_name='$fname', last_name='$lname', username='$mobile', mobile='$mobile', email='$email', password='$password'");
				$user_id=mysql_insert_id();
				
				session_start();
				$_SESSION['user_id']=$user_id;
				if(isset($_SESSION['referrer'])&&isset($_SESSION['to_fbid'])){
					$referrer_id=$_SESSION['referrer'];
					$dbh->select("users", "tacs_bal", "id='$referrer_id'", "1", "none");
					$old_bal=$dbh->select_res['tacs_bal'];
					$referrer_new_bal=$old_bal+20;
					$dbh->update("users", "tacs_bal='$referrer_new_bal'", "id='$referrer_id'", "1");
					$dbh->update("fb_invitation", "reg_status='1'", "from_ta='$referrer_id' AND to_fb='$to_fb'", "1");
					unset($_SESSION['referrer']);
					unset($_SESSION['to_fbid']);
				}
				header("Location:../welcome.php");
				exit();
							
					
			

			
			}
		}else{
			header("Location:../account_activation.php?reg_id=$reg_id&time=2&error=Incorrect activation code.");
		}
	}else{
		header("Location:../notification.php?notice=6");
		exit();
	}

}else if(isset($_POST['mobile'])&&isset($_POST['email'])){
	include_once(root_dir."classes/db.class.php");
	$dbh=new db();
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$dbh->select("users", "id", "mobile='$mobile' AND email='$email'", "none", "none");
	if($dbh->sel_count_row<1){
		$dbh->select("tmp_users", "id, first_name, activation_code", "mobile='$mobile' AND email='$email'", "none", "none");
		if($dbh->sel_count_row>0){
			$reg_id=$dbh->select_res['id'];
			$fname=$dbh->select_res['first_name'];
			$code=$dbh->select_res['activation_code'];
			include_once(root_dir."classes/sms.class.php");
			$sms=new sms();
			$res=$sms->send_authcode($mobile, $fname, $code);
			// print_r($res);
			if($res['type']=='success'){
				header("Location:".root_dir."account_activation.php?reg_id=".$reg_id."&&time=2&msg=SMS with activation code has been sent to your mobile (".$mobile."). Please enter this code to activate your a/c.!&msg_clr=green");
				exit();
			}else{
				header("Location:".root_dir."account_activation.php?msg=It may Take some time to deliver SMS to your number or something wrong with your no. Try later!&msg_clr=red");
				exit();
			}
		}else{
			header("Location:".root_dir."account_activation.php?msg=This Mobile No. and Email do not registered yet, Please register first to play Game!&msg_clr=red");
			exit();
		}
	}else{
		header("Location:".root_dir."account_activation.php?msg=Your a/c already registered. Please login to Play Game.&msg_clr=green");
		exit();
	}
}else{
	echo "There is error with your connection. Please try after some time.";
}

?>