<?php
if(isset($_POST['username'])&&isset($_POST['password'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);
	$mobile=$username;
	if($username!=""&&$password!=""){
		include_once("../classes/db.class.php");
		$dbh=new db("triaasco_oct");
		$dbh->select("users", "id, first_name, last_name", "username='$username' AND password='$password'", "none", "none");
		if($dbh->sel_count_row==1){
			
			session_start();
			$_SESSION['user_id']=$dbh->select_res['id'];
			header("Location:../table.php");
			exit();
			
		}else{
			$msg="Wrong Mobile or Password or not registered yet or A/C not activated!";
			header("Location:../login.php?msg=Error 3: Wrong Username or Password or not activated/registered yet!&msg_clr=red");
			exit();
		}
	}else{
		header("Location:../login.php?msg=Error 2XX2: Fill USername or Password correctly!&msg_clr=red");
			exit();
	}
}else{
	header("Location:../login.php?msg=Error 1XY2: Try again!&msg_clr=red");
			exit();
}


?>