<?php
define('root_dir', "./");
include_once(root_dir."classes/main.class.php");
include_once(root_dir."classes/game.class.php");
$main=new main();
$game=new game();
$main->show_msg();
$game->get_content();

$vars=array(
    "page"=>array(
      "root_dir"=>root_dir,
      "msg"=>$main->msg,
      "msg_cls"=>$main->msg_cls,
      "title"=>"Pazlet: the Game of Mind"
    ),
    "table"=>array(
    	'puzzle1'=>$game->a_puzzle,
    	'puzzle2'=>$game->b_puzzle,
    	'puzzle3'=>$game->c_puzzle,
    	'puzzle4'=>$game->d_puzzle,
      'puzzle5'=>$game->e_puzzle,
    	'game_id'=>$game->game_id,
    	)
  );

  $main->display(root_dir."pages/table.ta", $vars, true);


?>