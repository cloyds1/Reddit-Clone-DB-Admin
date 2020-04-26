<?php
	
session_start();
require_once('../utils/dbUtil.php');
	
if(unserialize($_SESSION['usser-data'])->authority != 'admin'){
		
	header('Location: ../login/login.php');
		
}
	
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