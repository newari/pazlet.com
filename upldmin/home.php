<?php
include_once("./classes/main.class.php");
$main=new main();
$main->show_msg();
session_start();
	$vars=array(
		"page"=>array(
			"metad"=>"Upload Puzzles.",
			'title'=>"Login to Upload Puzzle Portal.",
			'msg'=>$main->msg,
			'msg_cls'=>$main->msg_cls,
			)
		);

	$main->display("./pages/home.ta", $vars, true);


?>