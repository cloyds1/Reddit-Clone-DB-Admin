<?php 
session_start();

if(!isset($_SESSION['user-data'])){
	header('Location: ../login/login.php');
}

require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');
require('../rsrc/header.php');


?>


<body>
<?php require('../rsrc/nav_bar.php'); ?>
<form class="form-class" action="createHandler.php" method="post">
	
	Title:<br><input type="text" name="title" placeholder="Enter text here" size="30"><hr>
	Content:<br><textarea name="content" placeholder="Enter text here"  rows="10" cols="50"></textarea><hr>
	<input type="submit" value="Submit">
	<input type="reset" value="Reset">
</form>
</body

<?php
require('../rsrc/footer.php');
?>
