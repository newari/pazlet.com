<?php
if(isset($_POST['dd_no'])){
	include_once("../classes/session.class.php");
	include_once("../classes/db.class.php");
	$std_id=$crnt_session->std_id;
	$dbh=new db();
	$dd_no=$_POST['dd_no'];
	$amt=$_POST['amt'];
	$dd_date=$_POST['dd_date'];
	$cart_id=$_POST['cart_id'];
	$crnt_time=time();
	$dbh->insert("payments", "cart_id='$cart_id', dr='$std_id', amt='$amt', payment_mode='dd', payment_data='$dd_no', at_time='$crnt_time'");
	if(mysql_insert_id()>0){
		$order_id='2013-'.mysql_insert_id();
		header("Location:../payment-complete.php?status=complete&order_id=".$order_id);
		exit();
	}else{
		header("Location:../payment-complete.php?status=uncomplete&msg=Some error! Try again");
	}
}else{
	header("Location:../payment-complete.php?status=uncomplete&msg=Some error! Try again");
}

?>