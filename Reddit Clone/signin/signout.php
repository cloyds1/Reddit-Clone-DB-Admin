<?php 

	session_start();
	
	if(isset($_SESSION['user-data'])){
		
		$_SESSION = [];
		session_destroy;
		
	}
	header('Location: ../index.php');
	
?>