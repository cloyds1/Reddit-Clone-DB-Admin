<?php 

session_start();

#check if user is logged in

if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary files
require('../utils/dbUtil.php');

#connect to database
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb');

#get user data
$user_data = unserialize($_SESSION['user-data']);


#check authority of user. If admin, display UI for filtering user types and posts for specific users. If manager, display UI
#for editing own posts, filtering user types, and posts for specific users that are NOT Admin. If User, display only own posts.

/*case($user_data->authority){
	
		case 'admin':
			DisplayFuncs::displayAdmin();
			$data = mysqli_query($db, "SELECT * FROM posts;");
			break;
			
		case 'manager':
			DisplayFuncs::displayManager();
			$data = mysqli_query($db, "SELECT FROM posts WHERE authority <> 'Admin';"
			break;
			
		case 'user':
			$posts = DatabaseUtil::readAllUserPosts($user_data->id, $db);
			break;
		
	}*/

#get posts created by this user
$posts = DatabaseUtil::readAllUserPosts($user_data->id, $db);



require('../rsrc/header.php');

?>


<body>


<?php 

#import necessary file in specific place
require('../rsrc/nav_bar.php'); 

?>

<h3 class="full-post-style">Select a post you wish to edit.</h3>

<?php	
	
	foreach($posts as $post){
		$post->echoPostEdit();
	}
			
?>

</body
</body

<?php
require('../rsrc/footer.php');
?>