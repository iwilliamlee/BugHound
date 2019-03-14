<?php
	//$cookie_name = "user_level";
	//$user_level =  (int)$_COOKIE[$cookie_name];
		
	session_start();
	
	function isLoggedIn(){
		if(!isset($_SESSION['login'])) {
			echo "<SCRIPT type='text/javascript'>
			alert('User is Not Logged In');
			document.location.href='/BugHound/auth/login.php';
			</SCRIPT>";	
		}	
	}
	
	function isValidLevel($min_level){
		$user_level =  (int)$_SESSION["user_level"];
		if($user_level < $min_level) {
			echo "<SCRIPT type='text/javascript'>
				alert('You do not have the access level to make this change');
			</SCRIPT>";	
			return false;
		}
		return true;
	}
?>