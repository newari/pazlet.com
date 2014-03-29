<?php
define('root_dir', "./");
include_once("classes/main.class.php");
$main=new main();
$main->show_msg();
$sub_head='<img src="'.root_dir.'images/login-image.png">';

$main_content='<div class="row-fluid">
	<div class="span6 offset3 ind-login-box">
		<h1 class="alignC">Login</h1>
		<hr/>
		<form class="form form-horizontal" action="./scripts/login.php" method="post">
			<div class="control-group">
				<div class="control-label">
					<label>UserName : </label>
				</div>
				<div class="controls">
					<input type="text" name="username" placeholder="Your Username!">
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
					<label>Password : </label>
				</div>
				<div class="controls">
					<input type="password" name="password" placeholder="Your Password!">
				</div>
			</div>
			<div class="control-group">
				
				<div class="controls">
					<input type="submit" class="btn btn-info" value="LogIn">
				</div>
			</div>
		</form>
	</div>
</div>';


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