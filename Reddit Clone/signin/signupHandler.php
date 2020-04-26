<?php 

session_start();

if(isset($_SESSION['user-data'])){
	header('Location: ../index.php');
}

$username = strip_tags($_POST['usrname']);
$email = strip_tags($_POST['email']);
$password = hash('sha256', strip_tags($_POST['password']));

#check if user is trying to access via url rather than hyperlink without using signup 
if(!isset($username) or !isset($email) or !isset($password)){
	header('Location: signup.php');
}

#import necessary file
require_once('../utils/dbUtil.php');

#connect to the database
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb');

#instatiate a user object with retrieved parameters
$user = new User(null, null, $username, $password, null, $email);

#check if call to createEntry fails.   
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


?>



