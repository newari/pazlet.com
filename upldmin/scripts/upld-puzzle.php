<?php
session_start();
if(isset($_SESSION['upldmin_id'])){
	if(isset($_FILES['puzzle_img'])&&$_FILES['puzzle_img']['size']>0){
		$puzzle=$_FILES['puzzle_img']['tmp_name'];
		$crnt_time=time();
		$nm=mt_rand()+$crnt_time;
		$pz_src=$nm.".jpg";
		echo $nm;
		$ans=$_POST['ans'];
		$sln='<p>'.$_POST['sln_text'].'</p>';
		if(!file_exists("../../puzzles/".$nm.".jpg")){
			move_uploaded_file($puzzle, "../../puzzles/".$nm.".jpg");
			if(isset($_FILES['sln_img'])&&$_FILES['sln_img']['size']>0){
				$sln_img=$_FILES['sln_img']['tmp_name'];
				$snm=mt_rand();
				move_uploaded_file($sln_img, "../../puzzle-slns/".$snm.".jpg");
				$sln.='<p><img src="./puzzles-slns/'.$snm.'.jpg"></p>';
			}

		}
		$upld_admin=$_SESSION['upldmin_id'];
		include_once("../../classes/db.class.php");
		$dbh=new db();
		$dbh->insert("puzzles", "puzzle_src='$pz_src', ans='$ans', solution='$sln', upload_time='$crnt_time', upload_by='$upld_admin'");
		header("Location:../home.php");
	}
}else{
	echo "Session Expired! Login again";
}


?>