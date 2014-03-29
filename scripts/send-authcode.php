<?php
if(isset($_GET['mobile'])){
	$mobile=$_GET['mobile'];
	include_once("../classes/db.class.php");
	$dbh=new db();
	$dbh->select("registration", "fname, lname, auth_code", "mobile='$mobile'", "none", "1");
	if($dbh->sel_count_row>0){
		if($dbh->select_res['auth_code']==""){
			$auth_code=substr(time(), 6);
			$dbh->update("registration", "auth_code='$auth_code'", "mobile='$mobile'", "none", "1");

		}else{
			$auth_code=$dbh->select_res['auth_code'];
		}
		$name=ucfirst($dbh->select_res['fname']).' '.ucfirst($dbh->select_res['lname']);
		include_once("../classes/sms.class.php");
		$sms=new sms();
		$sms->send_authcode($mobile, $name, $auth_code);
		
		header("Location:../authentication-page.php?msg=Authentication code send again to your mobile no. ".$mobile.". Please activate now! &msg_clr=green&mobile=".$mobile);
		exit();
	}else{
		header("Location:../authentication-page.php?msg=The Mmobile no. ".$mobile." is not registered yet. Please register first.! &msg_clr=red&mobile=".$mobile);
		exit();
	}
}else{
	echo "Some error! Try again later.";
}


?>