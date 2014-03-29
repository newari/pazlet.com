<?php
class sms{
	function sms(){
		$this->sender_id='CQUIZZ';
	}

	function send_sms($mobile, $msg){

	}

	function send_authcode($mobileNumber, $rec_name, $auth_code){
		//Your authentication key
		$authKey = "126AYsUsmQFPCp52ad86ae";


		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = $this->sender_id;

		//Your message to send, Add URL endcoding here.
		$msg='Dear '.$rec_name.', Your Authentication code for Competition Quiz is '.$auth_code.'. Please enter this on website and enjoy your Tests. All the best. Regards, CQ Team';
		$message = urlencode($msg);

		//Define route 
		$route = "4";
		//Prepare you post parameters
		$postData = array(
		    'authkey' => $authKey,
		    'mobiles' => $mobileNumber,
		    'message' => $message,
		    'sender' => $senderId,
		    'route' => $route,
		    'response'=>'json'
		);

		//API URL
		$url="http://panel.msgclub.net/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		    //,CURLOPT_FOLLOWLOCATION => true
		));

		//get response
		$output = curl_exec($ch);

		curl_close($ch);
		$output=json_decode($output, true);

		return $output;

	}
}


?>