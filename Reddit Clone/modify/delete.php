<?php 
session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary file
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#get user data	
$user_data = unserialize($_SESSION['user-data']);


#Maybe Implement: Add role usage here: Admins can delete all posts, Super Users can delete theirs and other user's posts, users can only delete theirs.
#For Admins, they get a UI for filtering posts by Admins, Super Users, and Users. 

/*switch($user_data->authority){
	
	case "admin":
		header('Location: ../privs/admin.php');
		break;
		
	case "manager":
		header('Location: ../privs/manager.php');
		break;
		
	case "user":
		break;
		
}*/

#return all posts created by user 
$posts = DatabaseUtil::readAllUserPosts($user_data->id, $db);

require('../rsrc/header.php');

?>


<body>

<?php require('../rsrc/nav_bar.php');?>

<h3 class="full-post-style">Select a post you wish to delete.</h3>

<?php	
	


#begin selection form		
echo '<form action="deleteHandler.php" method="post">';

#echo all posts in deletion format			
foreach($posts as $post){
	$post->echoPostDelete();
}

#end selection form
echo '<input class="full-post-style box" style="margin-left:25%;" type="Submit" value="Submit">
	  <input class="full-post-style box" style="margin-left:25%;" type="Reset" value="Reset">
	  </form>';
	
?>

</body

<?php require('../rsrc/footer.php');?>