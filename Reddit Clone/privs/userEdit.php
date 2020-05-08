<?php
session_start();


#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');
require('../utils/settings.php');


#check if user is logged in, and authority is admin level	
if(unserialize($_SESSION['user-data'])->authority != 'admin'){
		
	header('Location: ../login/login.php');
		
}

#check if form data has been sent to the server. If so, this means that it's edit data
if(isset($_POST['userID'])){
	
	$username = isset($_POST['username'])? strip_tags($_POST['username']) : null;
	$password = isset($_POST['password'])? strip_tags($_POST['password']) : null;
	$email = isset($_POST['email'])? strip_tags($_POST['email']) : null;
	$authority = isset($_POST['authority'])? strip_tags($_POST['authority']) : null;
	$bio = isset($_POST['bio'])? strip_tags($_POST['bio']) : null;
	
	$user = new User(null, $authority, $username, hash('sha256', mysqli_real_escape_string($db, $password)), $bio, $email);
	
	DatabaseUtil::editEntry($_POST['userID'], $user, $db);
	
	header("Location: usermanage.php");
	
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
$user_data = DatabaseUtil::readEntry($_GET['id'], 'users', $db);

#import necessary resources
require("../rsrc/header.php");
require_once('../rsrc/nav_bar.php');
?>


<form class="form-class" action="userEdit.php" method="post">

	<b>User Name</b><br><input type="text" name="username" placeholder="Enter text here" size="30" value="<?=$user_data->username?>" minlength="4"></input><hr>
	<b>Password</b><br><input type="password" name="password" placeholder="Enter text here" size="30" minlength="8"><hr>
	<b>Email</b><br><input type="email" name="email" placeholder="Enter text here" size="30" value="<?=$user_data->email?>"></input><hr>
	<b>Authority</b><br>
	
				<p>
				<input type="hidden" name="authority" value="<?=$user_data->authority?>">
				<input style="margin-left: 1%;" type="radio" name="authority" value="admin">Admin<br>
				<input style="margin-left: 1%;" type="radio" name="authority" value="manager">Manager<br>
				<input style="margin-left: 1%;" type="radio" name="authority" value="user">User
				</p>
				<hr>
				 
	<b>Bio</b>:<br><textarea name="bio" placeholder="Enter text here" rows="10" cols="50"><?=$user_data->bio?></textarea><hr>
	
	
	<input type="hidden" name="userID" value="<?=$_GET['id']?>">
	<input type="submit" value="Submit">
	<input type="reset" value="Reset">
	
</form>

<?php
require_once('../rsrc/footer.php')
?>