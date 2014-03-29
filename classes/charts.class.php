<?php
if(file_exists("./classes/db.class.php")){
	include_once("./classes/db.class.php");
}else if("../classes/db.class.php"){
	include_once("../classes/db.class.php");
}

class charts extends db{
	function charts($std_test_data_arr){
		self::getInstance();
		$this->test_data=$std_test_data_arr;
		if(!isset($_SESSION)){
			session_start();
		}
		$this->std_id=$_SESSION['std_id'];
	}

	function responsechart_data(){
		$t_c=$this->test_data['total_correct'];
		$t_ic=$this->test_data['total_incorrect'];
		$t_ua=$this->test_data['total_unattempted'];
		$data_arr=array(array('Answers', "Total"), array("Correct", $t_c), array("Incorrect", $t_ic), array("Unattempted", $t_ua));
		return json_encode($data_arr);
	}

	function subwise_responsechart_data(){
		$subwise_ans_arr=$this->test_data['subwise_marks'];
		$data_arr=array();
		$data_arr[]=array('Subject', "Score");
		foreach($subwise_ans_arr as $sub_name=>$sub_score){
			$data_arr[]=array($sub_name, $sub_score);
		}
		return json_encode($data_arr);
	}

	function topper_comparisionchart_data($no=null){
		if(!isset($no)){
			$no=5;
		}

		$test_id=$this->test_data['id'];
		$std_id=$this->std_id;
		$this->select("tests", "attempted_by", "id='$test_id'", "none", "1");
		if($this->sel_count_row>0&&$this->select_res['attempted_by']!=''){
			$std_array=json_decode($this->select_res['attempted_by'], true);
			if(sizeof($std_array)>1){
				function multidd_sort($arr, $index) {
				    $b = array();
				    $c = array();
				    foreach ($arr as $key => $value) {
				        $b[$key] = $value[$index];
				    }

				    asort($b);

				    foreach ($b as $key => $value) {
				        $c[] = $arr[$key];
				    }

				    return $c;
				}
				$std_array=multidd_sort($std_array, '1');
			}
			$toppers_arr=array_reverse($std_array);
			$name_arr=array();
			$score_arr=array();
			$name_arr[]="Name";
			$score_arr[]="Score";
			if($no>sizeof($toppers_arr)){
				$no=sizeof($toppers_arr);
			}
			for($t=0; $t<$no; $t++){
				$topper_id=$toppers_arr[$t][0];
				$this->select("students", "first_name", "id='$topper_id'", "none", "1");
				$name_arr[]=$this->select_res['first_name'];
				$score_arr[]=$toppers_arr[$t][1];
			}
			$name_arr[]='You';
			$score_arr[]=$this->test_data['total_score'];
			return json_encode(array($name_arr, $score_arr));

		}else{
			return false;
		}
	}

	function timetaken_chart_data(){
		$ans_arr=$this->test_data['ans_data'];
		$q_no=1;
		$time_arr=array(array('Question NO.', "Time Taken"));
		foreach($ans_arr as $ans){
			$time_arr[]=array($q_no, intval($ans['time_taken']));
			$q_no++;

		}
		return json_encode($time_arr);
	
	}

	function dlevel_chart_data($dinfo=null){
		if(!isset($d_info)){
			$dinfo=array();
			$dinfo['very_easy']=0;
			$dinfo['easy']=0;
			$dinfo['medium']=0;
			$dinfo['hard']=0;
			$dinfo['very_hard']=0;
			$dinfo['std_ve']=0;
			$dinfo['std_e']=0;
			$dinfo['std_m']=0;
			$dinfo['std_h']=0;
			$dinfo['std_vh']=0;
			foreach($this->test_data['ans_data'] as $q_no=>$q){
				$q_id=$q['q_id'];
				$q_analysis_table=$q['q_type']."_analysis";
				$std_response=$q['response'];
				$this->select("$q_analysis_table", "corrected_by, incorrected_by, unattempted_by", "id='$q_id'", "none", "1");
				if($this->sel_count_row>0){
					if($this->select_res['corrected_by']!=""){
						$corrected_by=json_decode($this->select_res['corrected_by'], true);
						$crb=sizeof($corrected_by);
					}else{
						$crb=0;
					}
					if($this->select_res['incorrected_by']!=""){
						$incorrected_by=json_decode($this->select_res['incorrected_by'], true);
						$icrb=sizeof($incorrected_by);
					}else{
						$icrb=0;
					}
					if($this->select_res['unattempted_by']!=""){
						$unattempted_by=json_decode($this->select_res['unattempted_by'], true);
						$uab=sizeof($unattempted_by);
					}else{
						$uab=0;
					}
					$total_s=$crb+$icrb+$uab;
					$dlevel=($crb/$total_s)*100;
					
					if($dlevel>90){
						$dinfo['very_easy']++;
						if($std_response=="Correct"){
							$dinfo['std_ve']++;
						}
					}else if($dlevel>70&&$dlevel<91){
						$dinfo['easy']++;
						if($std_response=="Correct"){
							$dinfo['std_e']++;
						}
					}else if($dlevel>50&&$dlevel<71){
						$dinfo['medium']++;
						if($std_response=="Correct"){
							$dinfo['std_m']++;
						}
					}else if($dlevel>30&&$dlevel<51){
						$dinfo['hard']++;
						if($std_response=="Correct"){
							$dinfo['std_h']++;
						}
					}else{
						$dinfo['very_hard']++;
						if($std_response=="Correct"){
							$dinfo['std_vh']++;
						}
					}
					
				}else{
					return fale;
				}
			}
		}

		$chart_arr1=array("Difficulty Level", "You Solved", "Total in Test");
		$chart_arr2=array("Very Hard", $dinfo['std_vh'], $dinfo['very_hard']);
		$chart_arr3=array("Hard", $dinfo['std_h'], $dinfo['hard']);
		$chart_arr4=array("Medium", $dinfo['std_m'], $dinfo['medium']);
		$chart_arr5=array("Easy", $dinfo['std_e'], $dinfo['easy']);
		$chart_arr6=array("Very Easy", $dinfo['std_ve'], $dinfo['very_easy']);
		

		return json_encode(array($chart_arr1, $chart_arr2, $chart_arr3, $chart_arr4, $chart_arr5, $chart_arr6));

	}

	function std_testcomaprisionchart_data($t_no){
		$this->select("students", "participated_tests", "id='$this->std_id'", "none", "1");
		if($this->sel_count_row>0&&$this->select_res['participated_tests']!=""){
			$p_tests_arr=json_decode($this->select_res['participated_tests'], true);
			$total_p_tests=sizeof($p_tests_arr);
			if($t_no>$total_p_tests){
				$t_no=$total_p_tests;
			}
			$p_tests_arr=array_reverse($p_tests_arr);
			$chart_arr=array(array("Test Name", "Your Percentage Marks"));
			for($t=0; $t<$t_no; $t++){
				$test_id=$p_tests_arr[$t][0];
				$this->select("tests", "test_name, max_score", "id='$test_id'", "none", "1");

				$per=intval(($p_tests_arr[$t][1]/$this->select_res['max_score'])*100);
				$chart_arr[]=array($this->select_res['test_name'], $per);
			}

			return json_encode($chart_arr);
		}else{
			return false;
		}
	}


}

?>