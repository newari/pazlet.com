<?php
if(isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['mobile'])&&isset($_POST['password'])&&isset($_POST['conf_password'])&&isset($_POST['email'])){
	$f_name=$_POST['f_name'];
	$l_name=$_POST['l_name'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$conf_password=$_POST['conf_password'];
	if($f_name!=""&&$l_name!=""&&$mobile!=""&&$password!=""&&$conf_password!=""&&$email!=""){
		include_once("../classes/db.class.php");
		$dbh=new db("triaasco_triaas");
		$f_name=mysql_real_escape_string($f_name);
		$l_name=mysql_real_escape_string($l_name);
		$mobile=mysql_real_escape_string($mobile);
		$password=mysql_real_escape_string($password);
		$conf_password=mysql_real_escape_string($conf_password);
		$email=mysql_real_escape_string($email);
		if($password==$conf_password){
			$dbh->select("tmp_users", "id, aprv_status", "mobile='$mobile'", "none", "none");
			if($dbh->sel_count_row>0){
				if($dbh->select_res['aprv_status']==1){
					header("Location:../register.php?msg=This Mobile No. already registered!&msg_clr=red");
					exit();
				}else{
					$reg_id=$dbh->select_res['id'];
					header("Location:../account_activation.php?msg=This Mobile already registered. Please activate that a/c.&msg_clr=red&reg_id=$reg_id&time=2");
					exit();	
				}
				
			}else{
				$dbh->select("users", "id", "mobile='$mobile'", "none", "none");
				if($dbh->sel_count_row>0){
					header("Location:../register.php?msg=This mobile already Registered!&msg_clr=red");
					exit();
				}else{
					$reg_code = substr(number_format(time() * rand(),0,'',''),0,7);

					$dbh->insert("tmp_users", "first_name='$f_name', last_name='$l_name', mobile='$mobile', email='$email', password='$password', reg_time=now(), activation_code='$reg_code', aprv_status='0'");
					$reg_id=mysql_insert_id();
					if(isset($reg_id)){
						if($reg_id>0){
							include_once("../classes/sms.class.php");
							$sms=new sms();
							// $sms->send_authcode($mobile, $f_name, $reg_code);

							header("Location:../account_activation.php?reg_id=$reg_id&time=1");
							exit();
						}else{
							header("Location:../register.php?msg=Some Error in Registration, Please Try again later!!&msg_clr=red");
							exit();
						}
					}else{
						header("Location:../register.php?msg=Some Error in Registration, Please Try again later!&msg_clr=red");
						exit();
					}
				}

			}
		}else{
			header("Location:../register.php?msg=Password and Confirm password must be same!&msg_clr=red");
			exit();
		}
	}else{
		header("Location:../register.php?msg=Please fill all the fields correctly!&msg_clr=red");
		exit();
	}
}else{
	header("Location:../register.php?msg=Please fill all the fields correctly!&msg_clr=red");
	exit();
}

?>