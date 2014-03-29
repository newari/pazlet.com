<?php
if(isset($_POST['name'])){
	include_once("../classes/db.class.php");
	$dbh=new db();
	$name=$_POST['name'];
	$name_arr=explode(" ", $name);
	$fname=$name_arr[0];
	if(isset($name_arr[1])){
		$lname=$name_arr[1];
	}
	$lname="";
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$reg_time=time();
	$password=$_POST['password'];
	$re_password=$_POST['re_password'];
	$code=substr($reg_time, 6);

	$dbh->insert("registration", "fname='$fname', lname='$lname', mobile='$mobile', email='$email', reg_time='$reg_time', auth_code='$code'");
	if(mysql_insert_id()>0){
		if($password==$re_password&&$password!=""){
			$dbh->select("students", "id", "username='$mobile'", "none", "none");
			if($dbh->sel_count_row>0){
				header("Location:../new-registration.php?msg=Error! This email address already registered. Please Login or tey witn anothr email address.!");
				exit();
			}else{
				$dbh->insert("students", "first_name='$fname', last_name='$lname', coaching_id='1', username='$mobile', password='$password', reg_time='$reg_time'");
				if(mysql_insert_id()>0){
					include_once("../classes/sms.class.php");
					$sms=new sms();
					$sms->send_authcode($mobile, $name, $code);
					header("Location:../authentication-page.php?msg=Registration successful! Now Activate your A/C.&msg_clr=green&mobile=".$mobile);
					exit();
				}else{
					header("Location:../fast-reg.php?msg=Error! Try later or contact to us!");
					exit();
				}
			}
		}else{
			header("Location:../fast-reg.php?msg=Error! Try later or contact to us!");
			exit();
		}
			
	}

}else{
	header("Location:../fast-reg.php?msg=Some error");
	exit();
}



?>