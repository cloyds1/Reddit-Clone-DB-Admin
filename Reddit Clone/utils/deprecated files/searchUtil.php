<?php



function findUser($username, $password){
	
	$users = readJson('../dataFiles/users.json');
	$password = hash('sha256', $password);
	
	$message = 0;
	foreach($users as $user){
		if(in_array($username, $user) and in_array($password, $user)){
			return 1;
		}
		
		if(in_array($username, $user)){
			$message = 2;
		}
	}
	
	return $message;
	
}


		
		


?>