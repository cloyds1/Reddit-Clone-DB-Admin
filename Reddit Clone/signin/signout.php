<?php 

	session_start();
	
	#destry session
	if(isset($_SESSION['user-data'])){
		
		$_SESSION = [];
		session_destroy;
		
	}
	
	#redirect back to homepage
	header('Location: ../index.php');
	
?>