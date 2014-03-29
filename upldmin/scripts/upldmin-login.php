<?php
session_start();
if(isset($_SESSION['upldmin_id'])){
	header("Location:../home.php");
	exit();
}else{
	if(isset($_GET['username'])&&isset($_GET['password'])){
		$username=$_GET['username'];
		$password=$_GET['password'];

		if($username!=""&&$password!=""){
			include_once("../../classes/db.class.php");
			$dbh=new db();
			$dbh->select("uploaders", "id", "username='$username' AND password='$password'", "none", "none");
			if($dbh->sel_count_row>0){
				$_SESSION['upldmin_id']=$dbh->select_res['id'];
				header("Location:../home.php");
				exit();
			}else{
				$msg="Error!! Login again!";
				header("Location:../index.php?msg=".$msg."&msg_clr=red");
			}

		}else{
			$msg="Please fill all fields correctly!";
			header("Location:../index.php?msg=".$msg."&msg_clr=red");
		}
	}else{
		$msg="Error, Login again!";
		header("Location:../index.php?msg=".$msg."&msg_clr=red");
	}
}
?>