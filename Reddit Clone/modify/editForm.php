<?php 

session_start();

if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}


if(!is_numeric($_GET['id']) || $_GET['id']<0){
	
	header('Location: edit.php');
	
}

#import necessary files
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#get user data
$user_data = unserialize($_SESSION['user-data']);

#get post at id
$post = DatabaseUtil::readEntry($_GET['id'], 'posts', $db);

if(($post->userID != $user_data->id)){
	header('Location: edit.php');
}

require('../rsrc/header.php');

?>


<body>
<?php require('../rsrc/nav_bar.php'); ?>
<form class="form-class" action="editHandler.php" method="post">
	Author User-Name: <?=$user_data->username?><hr>
	Title:<br><input type="text" name="title" placeholder="Enter text here" size="30" value="<?=$post->title?>"></input><hr>
	Content:<br><textarea name="content" placeholder="Enter text here"  rows="10" cols="50"><?=$post->content?></textarea><hr>
	<input type="hidden" name="id" value="<?=$_GET['id']?>">
	<input type="submit" value="Submit">
	<input type="reset" value="Reset">
	
</form>
</body

<?php
require('../rsrc/footer.php');
?>