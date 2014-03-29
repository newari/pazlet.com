<?php
if(isset($_POST['auth_code'])&&isset($_POST['mobile'])){
	$auth_code=$_POST['auth_code'];
	$mobile=$_POST['mobile'];
	include_once("../classes/db.class.php");
	$dbh=new db();
	$dbh->select("registration", "auth_code", "mobile='$mobile'", "id desc", "1");
	if($dbh->sel_count_row>0){
		$real_code=$dbh->select_res['auth_code'];
		if($real_code==$auth_code){
			$dbh->update("students", "activation='1'", "username='$mobile'", "1");
			header("Location:../login.php?msg=Congratulations! Your a/c activated successfully! Now login and enjoy.&msg_clr=green");

		}else{
			header("Location:../authentication-page.php?msg=Wrong code! Please enter correct code.&msg_clr=red&mobile=".$mobile);

		}
	}else{
			header("Location:../authentication-page.php?msg=This mobile no.is not registered yet! Please register first.&msg_clr=red&mobile=".$mobile);
			exit();
	}
}else{
	header("Location:../authentication-page.php?msg=Fill the field correctly!&msg_clr=red&mobile=".$mobile);
	exit();
}


?>