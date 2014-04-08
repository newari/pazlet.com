<?php
//step-1  collection of connections of a user

$user_id=$_SESSION['user_id']; /////we can collect after the login of user. and we set of user sesion as user_id;
/////now we will get the users friend's fbIds json object or array. I will treat here as array.
////db is the class to connect with database and also query and change the data of database.
////user_table structure is: id| first name| last name | fbId | twitterId | fbFriends | twitterFollowers | twitterFollow | Place | Education | Company | title | Industry


class new_connetion extends db extends fbData{
	function new_connection(){
		$this->db($db_info);
	}
	function collect_fb_connection($user_id, $main_user_fb_id, $fb_friends_arr){
		foreach($fb_friends_arr as $fb_id){
			$fb_info=getFbuserDataById($fb_id);  //by this function(faebook API) get users public information from facebook
			$fbFriendsStr=json_encode($fb_info->friend_list);
			$this->insertToDB("user_table", "first_name='$fb_info->fname', last_name='$fb_info->lname', fbId='$fb_id', fbFriends='$fbFriendsStr', place='$fb_info.place'"); //can add more data
		}
	}

	function collect_witter_connection($a, $b, $c){
		////same as fb
	}


}


class search_data extends db{
	public $name;
	function search_data($input_str){
		//////using some algo we can seprate the string in differen_part
		$input_arr=separationFn($input_str);
		$this->fname=$input_arr[0];
		$this->lname=$input_arr[1];
		$this->location=$input_arr[2];
		$this->education=$input_arr[3];
		//etc
	}

	function get_data(){
		$db->select("user_table", "first_name, last_name, fb_id, twitter_id, etc..", "first_name LIKE '$this.fname', last_name LIKE '$this.lname', education LIKE '$this->education'"); ///query to DB return array
		return $db->select_res;
	}
}

class findDegree extends db{
	public $user1=$_SESSION['user_id'];
	function getDegree($user2Id){
		$db->select("user_table", "fbFriends, twitterFollowers, twitterFollowed, LinkedInConnection", "id='$user1id'", "limit=1");
		$fbFriendsArr=json_decode($db->select_res['fbFriends'], true);
		$twitterFollowers=json_decode($db->select_res['twitterFollowers'], true);
		$twitterFollowed=json_decode($db->select_res['twitterFollowed'], true);
		$LinkedInConnection=json_decode($db->select_res['LinkedInConnection'], true);
		if(in_array($user2Id, $fbFriendsArr)){
			$this->degree=1;
			$this->connectionOn='fb';
			$this->connectionType='friends';
		}else if(in_array($user2Id, $twitterFollowers)){
			$this->degree=1;
			$this->connectionOn='twitter';
			$this->connectionType='follower';
		}else if(in_array($user2Id, $twitterFollowed)){
			$this->degree=1;
			$this->connectionOn='twitter';
			$this->connectionType='followedByYou';
		}else if(in_array($user2Id, $LinkedInConnection)){
			$this->degree=1;
			$this->connectionOn='LinkedIn';
			$this->connectionType='connection';
		}else{
			///now for 2nd degree we go to each friend of $user1 and analyze their friends. means we use here BFS system
		}
	}
}

/////now when user signUp form FB we can add his info (FbID, fname, lname etc)to the user_table use this class
/////we can also get from this owener $UserId, $fbId, $fb_friend_arr...
///now when he add fb connection we can call...
$setConnection=new new_connection();
$set_connection->collect_fb_connection($userId, $fb_id, $fb_friend_arr);


////now if he want to search anything  with input of $mySearch

$new_search=new search_data($mySearch);
$search_result=$new_search->get_data();
/////it returns the array of all search results 
$output='';
foreach($search_result as $data){
	$output.='<p>'.$data['name'].'</p><p>Can add more info here.</p><p>Find connection link</p>';
}
 #echo $output;
/////$output shoow all the list of results data

////now when user click on the 'find connection link' which have this particular user's $particular_user_id

$degree=new findDegree();

$degrreRelatedToThisUser=$degree->getDegree($particular_user_id);
 
#echo $degrreRelatedToThisUser;




////I am using here the basic Mysql basic database. But we can also use GraphDB for beter speed. 
?>