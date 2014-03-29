<?php
include_once("./classes/main.class.php");
$main=new main();
$main->show_msg();
session_start();
if(isset($_SESSION['upldmin_id'])){
	header("Location:./home.php");
	exit();
}else{
	$vars=array(
		"page"=>array(
			"metad"=>"Upload Puzzles.",
			'title'=>"Login to Upload Puzzle Portal.",
			'msg'=>$main->msg,
			'msg_cls'=>$main->msg_cls,
			)
		);

	$main->display("./pages/upldmin-login.ta", $vars, true);
}

?>