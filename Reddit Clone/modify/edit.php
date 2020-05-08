<?php 

session_start();

#check if user is logged in

if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary files
require('../utils/dbUtil.php');
require_once('../utils/settings.php');

#get user data
$user_data = unserialize($_SESSION['user-data']);

#get the posts created by current user
$posts = DatabaseUtil::readAllUserPosts($user_data->id, $db);

#Maybe implement: check authority of user. If admin, display UI for filtering user types and posts for specific users. If manager, display UI
#for editing own posts, filtering user types, and posts for specific users that are NOT Admin. If User, display only own posts.
/*switch($user_data->authority){
	
	case "admin":
		#send to admin page
		header('Location: ../privs/admin.php');
		break;
		
	case "manager":
		#send to manager page
		header('Location: ../privs/manager.php');
		break;
		
	case "user":
		#do nothing if type is user
		break;
		
}*/

require('../rsrc/header.php');

?>

<body>

<?php require('../rsrc/nav_bar.php'); ?>

<h3 class="full-post-style">Select a post you wish to edit.</h3>

<?php	

	#echo all posts for users of type 'user'
	foreach($posts as $post){
		$post->echoPostEdit();
	}
		
?>

</body
</body

<?php
require('../rsrc/footer.php');
?>