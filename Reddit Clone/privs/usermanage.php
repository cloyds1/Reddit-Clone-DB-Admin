<?php
session_start();

#import necessary files
require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#check if user is logged in, and authority is admin level	
if(unserialize($_SESSION['user-data'])->authority != 'admin'){
		
	header('Location: ../login/login.php');
		
}

#check if id variable is set, if so, delete entry
if(isset($_GET['id']) and is_numeric($_GET['id'])){
	
	DatabaseUtil::deleteEntry($_GET['id'], 'users', $db);
	
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
<form action="usermanage.php" method="post">
<input type"text" name="search">
</form>
<p>Enter a letter or more to search for a user</p>
</div>

<div class="alpha-sorted-user-list">
<?php
	
	foreach($users as $user){
		$user->echoSearch();
	}
	
?>
</div>


</body
</body

<?php
require('../rsrc/footer.php');
?>