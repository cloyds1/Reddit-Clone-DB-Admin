<?php
session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}


#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');
require('../utils/settings.php');


$user_data = unserialize($_SESSION['user-data']);
		
if(isset($_POST['bio'])){
		
	$user_data->bio = strip_tags($_POST['bio']);
	DatabaseUtil::editEntry($_POST['id'], $user_data, $db);
		
	$_SESSION['user-data'] = serialize($user_data);
		
}
	
require_once("header.php");
require_once('nav_bar.php'); 

$user_data->displayBio();

if($user_data->id == $_GET['id']){
	
	echo '<form style="margin-top: 15%;" action="bio.php?id='.$_GET['id'].'" method="post">
	
		<textarea name="bio" placeholder="Enter text here"  rows="5" cols="50">'.DatabaseUtil::readEntry($user_data->id, 'users', $db)->bio.'</textarea>
		<input type="hidden" name="id" value="'.$user_data->id.'">
		<br>
		<input type="submit" value="Submit">
		<input type="reset" value="Reset">
		
		</form> ';
	
}

require_once('footer.php');


?>