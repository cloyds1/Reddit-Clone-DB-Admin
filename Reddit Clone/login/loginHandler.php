<?php
	
	session_start();
	
	
	if(isset($_SESSION['user-data'])){
		header('Location: ../index.php');
	}
	
		
	#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
	require_once('../utils/dbUtil.php');
	require_once('../utils/settings.php');
	
	#collect form data
	$username = strip_tags(mysqli_real_escape_string($db, $_POST['usrname']));
	$password = strip_tags(mysqli_real_escape_string($db, $_POST['password']));
	
	
	#check if user exists in database, if not, notify the user that the username does not exist
	if(!DatabaseUtil::isEntry($username, 'users', $db)){
		
		header('Location: login.php?message=fail-noaccnt');
		
	}
	
	else{
	
		#read a user from database
		$user = DatabaseUtil::readEntry($username, 'users', $db);
		
		#check if user password is correct, complete login process if so
		if(hash('sha256', $password) == $user->password){
		
			$_SESSION['user-data'] = serialize($user);
			header('Location: ../index.php');
			
		}
	
		#send back to login if not, notify that the password was wrong
		else {
			header('Location: login.php?message=fail-wrongpass');
		}
	}
		
		
		
		
	
	
	
		
		
	
	
	
	
	

?>