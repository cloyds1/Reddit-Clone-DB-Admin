<?php

session_start();

#import necessary files
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

$user_data = unserialize($_SESSION['user-data']);

#check if user is logged in, and authority is admin level or manager level	
if(($user_data->authority != 'admin') and ($user_data->authority != 'manager')){
		
	header('Location: ../login/login.php');
		
}



#check if id variable is set, if so, delete entry
if(isset($_GET['deleteid']) and is_numeric($_GET['deleteid'])){
	
	DatabaseUtil::deleteEntry($_GET['deleteid'], 'posts', $db);
	
}

#if search value is set, return all users similar to search value in alphabetical order
if(isset($_POST['search'])){
	
	$users = DatabaseUtil::getAllUsersAlpha($_POST['search'], $db);
	
}


#if no value is present, return all users in alphabetical order
else{
	$users = DatabaseUtil::getAllUsersAlpha('', $db);
}
	
	
	
	
require('../rsrc/header.php');

?>

<body>

<?php 

#import necessary file in specific place
require('../rsrc/nav_bar.php'); 

?>
<div class="search">
<p>Enter a username to search for posts by author</p>
<form action="postmanage.php" method="post">
<input type"text" name="search">
</form>
</div>

<div class="alpha-sorted-user-list">
<?php
	
foreach($users as $user){
		$posts = DatabaseUtil::readAllUserPosts($user->id, $db);
		foreach($posts as $post){
			$post->echoPostSearch();
		}
	}
	
?>

</div>

</body
</body

<?php
require('../rsrc/footer.php');
?>