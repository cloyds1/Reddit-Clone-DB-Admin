<?php 

session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary file (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require_once('../utils/dbUtil.php');

#create database connection, collect user data
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb'); 
$user_data = unserialize($_SESSION['user-data']);


#import necessary files


#instatniate a post object
$post = new Post(null, $user_data->id, date('M d, Y'), strip_tags($_POST['title']), strip_tags($_POST['content']));


#pass post object to createEntry() for insertion into database
DatabaseUtil::createEntry($post, $db);

#take user back to home page
header('Location: ../index.php');

?>



