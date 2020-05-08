<?php 

session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary file
require('../utils/dbUtil.php');
require_once('../utils/settings.php');

#get user data
$user_data = unserialize($_SESSION['user-data']);

#retrieve data and strip possible malicious tags
$title = strip_tags($_POST['title']);
$content = strip_tags($_POST['content']);

#instantiate a new post object with retrieve data
$post = new Post(null, $user_data->id, null, $title, $content);

#pass the post object to editEntry, which edits the entry
DatabaseUtil::editEntry($_POST['id'], $post, $db);

#take user back to home
header('Location: ../index.php');

?>
