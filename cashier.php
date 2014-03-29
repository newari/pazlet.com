<?php
define('root_dir', "./");
include_once("classes/main.class.php");
include_once("classes/user.class.php");
$main=new main();
$main->show_msg();
$user_info=new user();
$user=$user_info->get_basic_info();
$sub_links='';

$main_content='<div class="row-fluid">
	<h3>Hello '.$user['name'].', our cashier here to </h3>
	<hr/>
	
	<div class="span12 marginl0 hrdashed">
		<div class="row-fluid">
			<div class="span6 alignC"><a href="http://www.payumoney.com/store/buy/pazlet-cashier" ><button class="btn btn-large btn-warning">Add Balance to your Pazlet A/C</button></a></div>
			<div class="span6 alignR"><button class="btn btn-large btn-danger">Transfer Balance to your Bank</button></div>
		</div>
	</div>
</div>';


$vars=array(
	'page'=>array(
		'root_dir'=>root_dir,
		'msg'=>$main->msg,
		'msg_cls'=>$main->msg_cls,
		'metad'=>"Activate your triaas account. Activate by mobile authentication code. Activate and start to play on triaas",
		'metak'=>"triaas activation, account activation, a/c activation, activate via mobile, authentication code on mobile, last step of triaas registration",
		'sub_links'=>$sub_links,
		'main_content'=>$main_content
		)
	);


$main->display('pages/cmn-page2.ta', $vars, true);


?>