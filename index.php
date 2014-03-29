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
    )
  );

  $main->display(root_dir."pages/index.ta", $vars);


?>