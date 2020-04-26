<?php 
	
	session_start();

	#check if user is logged in (note, we don't have to retrieve data, we only want to know if the data actually exists in session variable)
	if(isset($_SESSION['user-data'])){
		header('Location: ../index.php');
	}
	
	#if not, continue with login
	else {
		
		#import resources
		require_once('../rsrc/header.php');
		require_once('../rsrc/nav_bar.php');
		
		#echo form
		echo '<form class="form-class" action="loginHandler.php" method="post">
	
				<h3>Login</h3><br>
				Note: You must be registered with us to modify existing posts on site!<br><br>
				Username: <input type="text" name="usrname" minlength="4" required><br><hr>
				Password: <input type="password" name="password" minlength="8" required><br><hr>
				<input type="submit" value="Submit">
				<input type="reset" value="Reset">
	
				</form>';
		
		#if past login attempt fails, notify user with appropriate response.
		if(isset($_GET['message'])){
			
			if($_GET['message'] == 'fail-noaccnt'){
				echo '<br><div class="alert alert-danger" style="width: 35%; margin-left: auto; margin-right: auto;" role="alert">No account by that name</div>';
			}
		
			if($_GET['message'] == 'fail-wrongpass'){
				echo '<br><div class="alert alert-danger" style="width: 35%;  margin-left: auto; margin-right: auto;" role="alert">Wrong password</div>';
			}
			
		}
		
	}
	
	
?>
	


<?php

require('../rsrc/footer.php');


 ?>