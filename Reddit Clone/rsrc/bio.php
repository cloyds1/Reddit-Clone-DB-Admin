<?php
session_start();

if(!isset($_SESSION['username'])){
	header('Location: ../login/login.php');
}

require('../utils/fileUtil.php');
require('../utils/editUtil.php');
require('../utils/classes.php');


$users = [];
$index = null;
$count = 0;

foreach(readJson('../dataFiles/users.json') as $user){
	
	$user_obj = new User($user['username'], $user['password'], $user['bio']);
	
	if($user_obj->username == $_SESSION['username']){
		$index = $count; 
	}
	
	array_push($users, $user_obj);
	
}

if(isset($_POST['bio'])){
	$users[$index]->bio = $_POST['bio'];
	editEntry($index, $users[$index]->getData(), '../dataFiles/users.json');
}

/*$id = $_GET['id'];

if(!isset($_GET['id'])){
	die('No id: go back to the <a href="index.php">
Home page</a>');
}

if(is_numeric($_GET['id']) || $_GET['id']<0 || $_GET['id']>=count($posts)){
	
	die('Invalid: go back to the <a href="index.php">Home page</a>');
	
}*/

require("header.php");

?>


<?php 

require_once('nav_bar.php'); 
$users[$index]->displayBio();
require_once('footer.php');
?>