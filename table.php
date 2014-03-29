<?php
define('root_dir', "./");
include_once(root_dir."classes/main.class.php");
$main=new main();
$main->show_msg();

$vars=array(
    "page"=>array(
      "root_dir"=>root_dir,
      "msg"=>$main->msg,
      "msg_cls"=>$main->msg_cls,
      "title"=>"FourOpts"
    ),
    "table"=>array(
    	'puzzle1'=>'puz1.jpg',
    	'puzzle2'=>'puz1.jpg',
    	'puzzle3'=>'puz1.jpg',
    	'puzzle4'=>'puz1.jpg',
    	'puzzle5'=>'puz1.jpg',
    	)
  );

  $main->display(root_dir."pages/table.ta", $vars, true);


?>