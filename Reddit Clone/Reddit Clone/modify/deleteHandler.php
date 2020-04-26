<?php 
 
session_start();

#check if user is logged in
if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

#import necessary files, get user data object from session variable
require_once('../utils/dbUtil.php');
$user_data = unserialize($_SESSION['user-data']);

#connect to the database
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb');

#delete all entries selected

if(isset($_POST['id'])){
	
	foreach($_POST['id'] as $i){
	
		DatabaseUtil::deleteEntry($i, 'posts', $db); 
	
	}
}

	
require_once('../rsrc/header.php');
?>


<body>
<?php require_once('../rsrc/nav_bar.php'); ?>

<div class="form-class">
	
	<h1>Posts deleted!</h1>
	
</div>
</body

<?phprequire_once('../rsrc/footer.php');?>



