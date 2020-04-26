

<?php
session_start();

#create database connection
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb');


#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');




#check if $_GET value is a valid index
if(!isset($_GET['id'])){
	die('No id: go back to the <a href="index.php">
Home page</a>');
}

if(!is_numeric($_GET['id']) || $_GET['id']<1){
	die('Invalid: go back to the <a href="index.php">Home page</a>');
	
}


#read the post at index and instantiate as a Post object
$post = DatabaseUtil::readEntry($_GET['id'], 'posts', $db);


require("header.php");

?>


<body>
	
<?php 

#import necessary resources, and echo the post in full format, including images, text, etc
require_once('nav_bar.php'); 

$post->echoPostFull(); 

require_once('footer.php');
?>


  
    

 