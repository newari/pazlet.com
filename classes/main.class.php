<?php
include_once("./classes/db.class.php");
class main extends db{
	public function show_msg(){
			if(isset($_GET['msg'])){
				$msg=$_GET['msg'];
				if(isset($_GET['msg_clr'])){
					$msg_clr=$_GET['msg_clr'];
					$msg_cls="color:".$msg_clr;

				}else{
					$msg_cls="";
				}
			}else{
				$msg="";
				$msg_cls="display:none";
			}
			$this->msg=$msg;
			$this->msg_cls=$msg_cls;
	}


	public function display($file, $vars, $setHeader_footer=null){
		if($setHeader_footer==true){
			self::getInstance();
			
			if(!isset($_SESSION)){
				session_start();
			}
			if(isset($_SESSION['user_id'])){
				$this->user_id=$_SESSION['user_id'];
				$this->select("users", "first_name, last_name", "id='$this->user_id'", "none", "1");
				$user_name=ucfirst($this->select_res['first_name'])." ".ucfirst($this->select_res['last_name']);
				$header='<div class="header">
					<div class="container">
						<div class="row-fluid">
							<div class="span9">
								<ul class="header-links">
									<li><span class="round-frame"><i class="icon icon-white icon-home"> </i></span><a href="./table.php">Home</a></li>
									<li><span class="round-frame"><i class="icon icon-white icon-leaf"> </i></span><a href="./my-balance.php">Balance</a></li>
									<li><span class="round-frame"><i class="icon icon-white icon-briefcase icon-large"> </i></span><a href="./cashier.php">Cashier</a></li>
									<li><span class="round-frame"><i class="icon icon-white icon-ok"> </i></span><a href="./rules.php">Rules</a></li>
									<li><span class="round-frame"><i class="icon icon-white icon-list-alt"> </i></span><a href="./help.php">Help</a></li>
								</ul>
							</div>
							<div class="span3 alignR username">
								<a><i class="icon icon-user "></i> '.$user_name.' </a>
							</div>
						</div>
					</div>
				</div>';
				$footer="";
			}else{
				$header='<div class="header login-nf">
					<div class="container hide login-box">
						<form class="form form-inline" action="./scripts/login.php" method="post"><span>UserName: </span><input type="text" name="username" required>  <span>Password:</span> <input type="text" name="password" required> <input type="submit" class="btn btn-info sharp" value="LogIn"></form> OR <a href="./register.php"><button class="btn btn-primary sharp">Register</button></a>
					</div>
					<div class="container login-opt">
						<h6 class="alignC login-nf">Please <a><button onclick="showLoginBox()" class="btn btn-info sharp">Login</button></a> First to Play this Game! &nbsp; &nbsp;if You are new on this site than <a href="./register.php"><button class="btn btn-primary sharp">Create New Account</button></a> .</h6>
					</div>
				</div>';
				$footer='<div class="row-fluid">
                        <div class="span2">Features</div>
                        <div class="span2">Rules</div>
                        <div class="span2">Benefits</div>
                        <div class="span2">Help</div>
                        <div class="span2">About</div>
                        <div class="span2">Contact</div>
                    </div>';
			}
		}else{
			$header="";
			$footer='<div class="footer"><div class="container main-container">
					<div class="row-fluid">
						<div class="span5">
							<div class="brand-name">
								<img src="images/Puzzle-red.png" >
			                    <h1><a href="#">Pazlet</a></h1>
			                    <span>The Game of Mind</span>
			                </div>
						</div>
                        <div class="span7">
                        	<ul class="footer-links">
                        		<li>Features </li>
                        		<li>Tips</li>
                        		<li>Rules</li>
                        		<li>Help</li>
                        		<li>About Us</li>
                        		<li>Contact Us</li>
                        		<li>Blog</li>
                        	</ul>
                        	<ul class="footer-links">
                        		<li>Refund & Cancellations</li>
                        		<li>Privacy Policy</li>
                        		<li>Terms & Conditions </li>
                        		
                        	</ul>
                        </div>
                        <div class="span12 marginl0">
                        	<p>COPYRIGHT NOTICE © 2014 pazlet.com, All rights reserved.</p>
                        </div>
                    </div></div></div>';
		}
		foreach($vars as $var_key=>$var_value){
			if(is_array($var_value)){
				foreach($var_value as $key=>$value){
					$var='{$'.$var_key.'.'.$key.'}';
					$html_var[$var]=$value;
				}
			}else{
				$var='{$'.$var_key.'}';
				$html_var[$var]=$var_value;
			}

		}
		$file_data=file_get_contents($file);
		$html_var=array();
		$vars['page']['header']=$header;
		$vars['page']['footer']=$footer;
		foreach($vars as $var_key=>$var_value){
			if(is_array($var_value)){
				foreach($var_value as $key=>$value){
					$var='{$'.$var_key.'.'.$key.'}';
					$html_var[$var]=$value;
				}
			}else{
				$var='{$'.$var_key.'}';
				$html_var[$var]=$var_value;
			}

		}
		unset($vars);
		$file_data=strtr($file_data, $html_var);
		if($file_data!=false){
			echo $file_data;
		}else{
			exit("Error: There is problem with user data.");
		}
	}

	public function header($type=null){
		if($type!=null){

		}else{
			$header='';
		}
	}

	

}

?>