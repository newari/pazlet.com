<?php
define('root_dir', "./");
include_once("classes/main.class.php");
$main=new main();
$main->show_msg();
$sub_head='<img src="'.root_dir.'images/sms-phone.png">';
if(isset($_GET['reg_id'])&&isset($_GET['time'])){
	$reg_id=$_GET['reg_id'];
	$activation_time=$_GET['time'];
	$dbh=new db();
	$reg_id=mysql_real_escape_string($reg_id);
	$activation_time=mysql_real_escape_string($activation_time);
	if($activation_time==1){
		$dbh->select("tmp_users", "mobile", "id='$reg_id'", "none", "none");
		$mobile=$dbh->select_res['mobile'];
	
		$main_content="<div class='row-fluid'><div class='span12'><h1>Activate your account:</h1>
			<p>We have sent an activation code to your registered mobile number ".$mobile.". Please activate your a/c by submitting activation code.</p>
			<form action='scripts/account-activation.php' method='post'>
				<fieldset>
	              <div class='control-group'>
	                <div class='control'>
	                	<input type='hidden' name='reg_id' value='".$reg_id."'>
	                 	<label>Activation Code:</label> <input type='text' placeholder='Activation code' name='activation_code'/>
	                	<input type='submit' value='Activate Now' class='btn btn-success'/>
	              	</div>
				</fieldset>
			</form>
			<p>If you don't recieved activation code within few minutes than first check your mobile no and <a href='account_activation.php?reg_id=".$reg_id."&time=2'> click here </a>to send again. </p>
			</div>
			</div>
		";
	}else if($activation_time>1){
		$dbh->select("tmp_users", "first_name, mobile, activation_code", "id='$reg_id'", "none", "none");
		if($dbh->sel_count_row>0){
			$mobile=$dbh->select_res['mobile'];
			$reg_code=$dbh->select_res['activation_code'];
			$f_name=$dbh->select_res['first_name'];
			include_once("./classes/sms.class.php");
			$sms=new sms();
			// $sms->send_authcode($mobile, $f_name, $reg_code);
		}else{
			echo "Error";
		}
		// 
		// 
		// 
		$main_content="<div class='row-fluid'><div class='span12'><h1>Activate your account:</h1>
			<p>We have sent an activation code to your registered mobile number ".$mobile.". Please activate your a/c by submitting activation code.</p>
			<form action='scripts/account-activation.php' method='post'>
				<fieldset>
	              <div class='control-group'>
	                <div class='control'>
	                	<input type='hidden' name='reg_id' value='".$reg_id."'>
	                 	<label>Activation Code:</label> <input type='text' placeholder='Activation code' name='activation_code'/>
	                	<input type='submit' value='Activate Now' class='btn btn-success'/>
	              	</div>
				</fieldset>
			</form>
			<p>If you don't recieved activation code within few minutes than first check your mobile no and <a href='account_activation.php?reg_id=".$reg_id."&time=2'> click here </a>to send again. </p>
			</div>
			</div>
		";		
	}
}else{
	$sub_head='<img src="'.root_dir.'images/SMS-Icon2.png">';
	$main_content="<div class='row-fluid'><div class='span12 alignC'><h1 class='alignC'>Account activation :</h1><hr/>
			<form action='scripts/account-activation.php' method='post' class='form form-inline'>
				<fieldset>
	              <div class='control-group'>
	                 <label>Mobile:</label> <input type='text' placeholder='Your registered Mobile No.' name='mobile'/> 
	                 <label>Email :</label>  <input type='text' placeholder='Your registered Email address' name='email'/>
	                 <input type='submit' value='Get Activation Code' class='btn'/>
	                
	              </div>
				</fieldset>
			</form>
			</div>
			<div class='span6 marginl0 alignC hrdashed'>
				<hr/>
				<a href='./register.php'><button class='btn btn-primary'>Create New Account</button></a>
			</div>
			<div class='span6 marginl0 alignC hrdashed'>
				<hr/>
				<a href='./login.php'><button class='btn btn-info'>Login</button></a>
			</div>
			</div>
			<br/>
		";
}

$vars=array(
	'page'=>array(
		'root_dir'=>root_dir,
		'msg'=>$main->msg,
		'msg_cls'=>$main->msg_cls,
		'metad'=>"Activate your triaas account. Activate by mobile authentication code. Activate and start to play on triaas",
		'metak'=>"triaas activation, account activation, a/c activation, activate via mobile, authentication code on mobile, last step of triaas registration",
		'sub_head'=>$sub_head,
		'main_content'=>$main_content
		)
	);


$main->display('pages/cmn-page.ta', $vars);


?>