<?php 

session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#create database connection, collect user data 
$user_data = unserialize($_SESSION['user-data']);

#instatniate a post object
$post = new Post(null, $user_data->id, null, strip_tags($_POST['title']), strip_tags($_POST['content']));


#pass post object to createEntry() for insertion into database
DatabaseUtil::createEntry($post, $db);

#take user back to home page
header('Location: ../index.php');

?>



