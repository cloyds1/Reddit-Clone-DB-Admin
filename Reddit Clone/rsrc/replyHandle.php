<?php

session_start();

#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');
require('../utils/settings.php');

#get userID
$userID = unserialize($_SESSION['user-data'])->id;

print_r($_POST);
#get asynchronous data from POST variable
$content = isset($_POST['content']) ? $_POST['content'] : null;
$postID = isset($_POST['postID']) ? $_POST['postID'] : null;

if(postID == null or $content == null){
	die();
}

#create reply object
$reply = new Reply(null, $postID, $userID, $content, null, null); 

#pass reply object to createEntry
DatabaseUtil::createEntry($reply, $db);

die();


?>