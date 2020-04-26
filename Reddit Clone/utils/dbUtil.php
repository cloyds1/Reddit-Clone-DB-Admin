<?php
	
	require_once('classes.php');
	
	class DatabaseUtil{
		
		
		static function createEntry($data, $db){
			
			
			
			if(get_class($data) == 'User'){
				
				$authority =  mysqli_real_escape_string($db, $data->authority);
				$user  =  mysqli_real_escape_string($db, $data->username);
				$pass  =  mysqli_real_escape_string($db, $data->password);
				$bio =  mysqli_real_escape_string($db, $data->bio);
				$email =  mysqli_real_escape_string($db, $data->email);
				
				$query = "INSERT INTO users (username, password, bio, email) VALUES('".$user."','".$pass."','".$bio."','".$email."');";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
				
			}
			
			
			else if(get_class($data) == 'Post'){
				
				$userID = mysqli_real_escape_string($db, $data->userID);
				$title =  mysqli_real_escape_string($db, $data->title);
				$content =  mysqli_real_escape_string($db, $data->content);
				$date_created = date('M d, Y');
				
				$query = "INSERT INTO posts (userid, datecreated, title, content) VALUES($userID, '$date_created', '$title', '$content')";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
				
			}
			
			else{
				
				die("ERROR: Incorrect type value for createEntry().");
				
			}
			
				
		}
		
		
		
		static function deleteEntry($key, $table, $db){
			
			
			if(is_numeric($key)){
				$query = "DELETE FROM $table WHERE id = $key;";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
				
			}
			
			else{
				
				die("Error: key is not numeric");
			
			}
			
		}
		
		
		static function editEntry($key, $data, $db){
			
			
			if(get_class($data) == 'User'){
				
				
				$authority = mysqli_real_escape_string($db, $data->authority);
				$user  = mysqli_real_escape_string($db, $data->username);
				$pass  = mysqli_real_escape_string($db, $data->password);
				$bio = mysqli_real_escape_string($db, $data->bio);
				$email = mysqli_real_escape_string($db, $data->email);
				
				$query = "UPDATE users SET authority = '$authority', username = '$user', password = '$pass', bio = '$bio', email = '$email' WHERE id = $key;";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
				
			}
			
			
			
			else if(get_class($data) == 'Post'){
				
				$title =  mysqli_real_escape_string($db, $data->title);
				$content =  mysqli_real_escape_string($db, $data->content);
				
				$query = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $key;";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
			}
	
		}
		
		static function readEntry($key, $table, $db){
			
			if(is_numeric($key)){
				
				$query = "SELECT * FROM $table WHERE id = $key;";
				$data = mysqli_query($db, $query);
				
				if(!$data){
					die(mysqli_error($db));
				}
				
				$data = mysqli_fetch_assoc($data);
				
				if($table == 'users'){
					$user = new User($data['id'], $data['authority'], $data['username'], $data['password'], $data['bio'], $data['email']);
					return $user;
				}
				
				if($table == 'posts'){
					$post = new Post($data['id'], $data['userid'], $data['datecreated'], $data['title'], $data['content'], $db);
					return $post;
				}
				
				#add replies case here
			}
			
			else if(is_string($key)){
				
				
				if($table == 'users'){
					
					$query = "SELECT * FROM users WHERE username = '$key';";
					$data = mysqli_fetch_assoc(mysqli_query($db, $query));
					
					$user = new User($data['id'], $data['authority'], $data['username'], $data['password'], $data['bio'], $data['email']);
					return $user;
					
				}
				
					
				else{
					
					die("Error: only users can be referenced by string type in DatabaseUtil::readEntry()");
					
				}
				
			}
				
			else{
				die("Error: key should be numeric or string in type in DatabaseUtil::readEntry()");
			}
	
			
		}
		
		static function isEntry($key, $table, $db){
			

			if($table == 'users'){
				
				if(is_numeric($key)){
					
					$query = "SELECT * FROM users WHERE id = $key;";
				}
				
				else if(is_string($key)){
					
					$query = "SELECT * FROM users WHERE username = '$key';";
					return mysqli_num_rows(mysqli_query($db, $query));
					echo 'user string';
					
				}
			
			}
			
			if($table == 'posts'){
				
				if(is_string($key)){
					die("ERROR: posts cannot be referenced by string.");
				}
				
				$query = "SELECT * FROM posts WHERE id = $key;";
				return mysqli_num_rows(mysqli_query($db, $query));
			
			}
			
		}
		
		function readAllUserPosts($key, $db){
			
			$query = "SELECT * FROM posts WHERE userid = $key;";
			$data = mysqli_query($db, $query);
			
			$posts = [];
			
			while ($post = mysqli_fetch_assoc($data)){
				
				$posts[] = new Post($post['id'], 
									$post['userid'],
									$post['datecreated'],
									$post['title'],
									$post['content'],
									$db);
				
			}		
					
			return $posts;
			
		}
			
	}
	
?>