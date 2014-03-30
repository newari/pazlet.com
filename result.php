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
	<h3>Balance</h3>
	<hr/>
	<div class="span2">Balance : </div>
	<div class="span8">'.$user['balance'].'</div>
	<div class="span12 marginl0 hrdashed">
		<hr/>
		<div class="row-fluid">
			<div class="span6 alignC">
				<button class="btn btn-warning">Add Balance</button>
				<a href="https://www.instamojo.com/pazlet/100-tacs-membership/" rel="im-checkout" data-style="light" data-text="Buy Tacs Now" data-token="cc60dd9d71f72d07a3d888175a6707be"></a><script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>
			</div>
			<div class="span6 alignR"><button class="btn btn-danger">Transfer Balance to your Bank</button>

			</div>
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