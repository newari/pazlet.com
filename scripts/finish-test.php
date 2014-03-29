<?php
session_start();
if(isset($_POST['ans_arr'])){
	$ans_arr=$_POST['ans_arr'];
	$std_id=$_SESSION['std_id'];
	$test_id=$_SESSION['test_id'];
	include_once("../classes/finish_test.class.php");
	$test=new finish_test($test_id, $std_id, $ans_arr);
	$result_arr=$test->get_result();
	$test->upload_data_to_db();
	$result=json_encode($result_arr);
	echo $result;
}else{
	echo "Error! Please check your Internet connection.";
	exit();
}

?>