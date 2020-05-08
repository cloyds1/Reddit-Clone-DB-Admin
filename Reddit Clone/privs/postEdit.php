<?php
session_start();


#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');
require('../utils/settings.php');

$user_data = unserialize($_SESSION['user-data']);

#check if user is logged in, and authority is admin level	
if($user_data->authority != 'admin' and $user_data->authority != 'manager'){
		
	header('Location: ../login/login.php');
		
}

#check if form data has been sent to the server. If so, this means that it's edit data
if(isset($_POST['postID'])){
	
	$title = isset($_POST['title'])? strip_tags($_POST['title']) : null;
	$content = isset($_POST['content'])? strip_tags($_POST['content']) : null;
	
	$post = new Post(null, null, null, $title, $content, $db);
	
	DatabaseUtil::editEntry($_POST['postID'], $post, $db);
	
	header("Location: postmanage.php");
	
}


#check if $_GET value is a valid index
if(!isset($_GET['id'])){
	die('No id: go back to the <a href="index.php">
Home page</a>');
}

if(!is_numeric($_GET['id']) || $_GET['id']<1){
	die('Invalid: go back to the <a href="index.php">Home page</a>');
	
}



#get user data
$post = DatabaseUtil::readEntry($_GET['id'], 'posts', $db);

#import necessary resources
require("../rsrc/header.php");
require_once('../rsrc/nav_bar.php');
?>


<form class="form-class" action="postEdit.php" method="post">

	<b>Title</b><br><input type="text" name="title" placeholder="Enter text here" size="30" value="<?=$post->title?>" minlength="4"></input><hr>			 
	<b>Content</b><br><textarea name="content" placeholder="Enter text here"  rows="10" cols="50"><?=$post->content?></textarea><hr>
	
	
	<input type="hidden" name="postID" value="<?=$_GET['id']?>">
	<input type="submit" value="Submit">
	<input type="reset" value="Reset">
	
</form>

<?php
require_once('../rsrc/footer.php')
?>