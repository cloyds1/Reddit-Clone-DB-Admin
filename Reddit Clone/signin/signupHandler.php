<?php 

session_start();

if(isset($_SESSION['user-data'])){
	header('Location: ../index.php');
}

#retrieve form data
$username = strip_tags($_POST['usrname']);
$email = strip_tags($_POST['email']);
$password = hash('sha256', strip_tags($_POST['password']));

#check if user is trying to access via url rather than hyperlink without using signup 
if(!isset($username) or !isset($email) or !isset($password)){
	header('Location: signup.php');
}

#import necessary files (place here, because why include a file, then immediately redirect because of an error?
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#instatiate a user object with retrieved parameters
$user = new User(null, null, $username, $password, null, $email);

#check if call to createEntry() fails.   
if(!DatabaseUtil::createEntry($user, $db)){
	
	#If so, check if it is a duplicate error.
	if(mysqli_errno($db) == 1062){
		
		$message = explode(' ', mysqli_error($db));
		$field = str_replace('\'', '', $message[count($message) - 1]);
		
		#If duplicate email, send email-conflict
		if($field == 'email'){
			header('Location: signup.php?message=email-conflict');
		}
		
		#If duplicate user name, send name-conflict
		else if($field == 'username'){
			
			header('Location: signup.php?message=name-conflict');
		
		}	
	}
	
	
}

#if it doesn't fail, go to home page
else{
		header('Location: ../index.php');
	}


?>



