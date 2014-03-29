<?php
include_once("../classes/session.class.php");
if(isset($_POST['course'])){
	$std_id=$crnt_session->std_id;
	include_once("../classes/db.class.php");
	$dbh=new db();
	$mobile=$_POST['mobile'];
	$course=$_POST['course'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$exam_year=$_POST['exam_year'];
	$coaching_name=$_POST['coaching_name'];
	if(isset($_FILES['pic']['tmp_name'])&&$_FILES['pic']['size']>0){
		$pic_name=time().".jpg";
		if(!is_dir('../students/'.$std_id)){
			mkdir('../students/'.$std_id);
			mkdir('../students/'.$std_id.'/images');

		}else if(!is_dir('../students/'.$std_id.'/images')){
			mkdir('../students/'.$std_id.'/images');
			
		}
		move_uploaded_file($_FILES['pic']['tmp_name'], "../students/".$std_id."/images/".$pic_name);
		$dbh->update("students", "img_src='$pic_name'", "id='$std_id'", "1");
	}

	$dbh->update("students", "first_name='$fname', last_name='$lname'", "id='$std_id'", "1");
	$dbh->update("registration", "mobile='$mobile', course='$course', coaching_name='$coaching_name', exam_year='$exam_year'", "id='$std_id'", "1");
	
	header("Location:../student-profile.php?msg=Update successfully!&msg_clr=green");
	exit();
}else{
	header("Location:../edit-std-profile.php?msg=Some error");
	exit();
}



?>