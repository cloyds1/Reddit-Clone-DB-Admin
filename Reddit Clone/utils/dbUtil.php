<?php
	
	require_once('classes.php');
	
	class DatabaseUtil{
		
		#create a database entry, takes a data object (of type User, Post, or Reply), and adds it to it's respective table.
		static function createEntry($data, $db){
			
			
			#if type is User, insert into user table
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
			
			#if type is Post, insert into post table
			else if(get_class($data) == 'Post'){
				
				$userID = mysqli_real_escape_string($db, $data->userID);
				$title =  mysqli_real_escape_string($db, $data->title);
				$content =  mysqli_real_escape_string($db, $data->content);
				
				$query = "INSERT INTO posts (userid, title, content) VALUES($userID, '$title', '$content');";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
				
			}
			
			#if type is Reply, insert into the reply table
			else if(get_class($data) == 'Reply'){
				
				$parentID = mysqli_real_escape_string($db, $data->parentID);
				$userID = mysqli_real_escape_string($db, $data->userID);
				$content = mysqli_real_escape_string($db, $data->content);
				$date_created = mysqli_real_escape_string($db, $data->date_created);
				
				$query = "INSERT INTO reply (parentpostid, userid, content) VALUES($parentID, $userID, '$content');";
				
				if(!mysqli_query($db, $query)){
					echo mysqli_error($db);
					return false;
				}
				
				return true;
				
			} 
			
			
			
			else{
				
				die("ERROR: Incorrect type value for createEntry().");
				
			}
			
				
		}
		
		
		#delete an entry from a database, takes a key (number id), a table name (string), and a database link object.
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
		
		#edit an entry from a database, takes a key (number id), a table name (string), and a database link object.
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
			
			
			
			else if(get_class($data) == 'Reply'){
				
				$content =  mysqli_real_escape_string($db, $data->content);
				
				$query = "UPDATE reply SET content = '$content' WHERE id = $key;";
				
				if(!mysqli_query($db, $query)){
					return false;
				}
				
				return true;
			}
			
			else{
				die("Unsupported data type for method editEntry() in dbUtil.php");
			}
	
		}
		
		
		
		#read an entry from a database, takes a key (which can be a string, or a number id), a table name (string), and a database link object.
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
				
				else if($table == 'posts'){
					$post = new Post($data['id'], $data['userid'], $data['datecreated'], $data['title'], $data['content'], $db);
					return $post;
				}
				
				else if($table == 'reply'){
					
					$reply = new Reply($data['id'], $data['parentid'], $data['userid'], $data['content'], $data['datecreated'], $db);
					return $post;
				}

				else{
					
					die("Table not found in readEntry in dbUtil.php");
					
				}
					
			}
			
			else if(is_string($key)){
				
				$key = mysqli_real_escape_string($db, $key);
				
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
		
		
		
		#checks if a entry exists in a table
		static function isEntry($key, $table, $db){
			

			if($table == 'users'){
				
				if(is_numeric($key)){
					
					$query = "SELECT * FROM users WHERE id = $key;";
					
				}
				
				else if(is_string($key)){
					
					$query = "SELECT * FROM users WHERE username = '$key';";
					
				}
				
				else{
					
					return false;
					
				}
				
				return mysqli_num_rows(mysqli_query($db, $query)) > 0 ? true : false;
			
			}
			
			if($table == 'posts'){
				
				if(is_string($key)){
					die("ERROR: posts cannot be referenced by string.");
				}
				
				$query = "SELECT * FROM posts WHERE id = $key;";
				return mysqli_num_rows(mysqli_query($db, $query));
			
			}
			
		}
		
		#read all posts from a given user id
		static function readAllUserPosts($key, $db){
			
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
		
		#returns an array of users in alphabetical order
		static function getAllUsersAlpha($searchVal, $db){
			
			$searchVal = mysqli_real_escape_string($db, strip_tags($searchVal));
			$query = "SELECT * FROM users WHERE username LIKE '$searchVal%' LIMIT 50;";
			
			$data = mysqli_query($db, $query);
			
			$users = [];
			
			while($row = mysqli_fetch_assoc($data)){
				
				$users[] = new User($row['id'], $row['authority'], $row['username'], $row['password'], $row['bio'], $row['email']);
				
			}
			
			return $users;
		
		}
		
		static function getAllPostReplies($postID, $db){
			
			$query = "SELECT * FROM reply WHERE parentpostid = $postID ORDER BY datecreated DESC;";
			$data = mysqli_query($db, $query);
			
			$replies = [];
			
			while ($reply = mysqli_fetch_assoc($data)){
				
				$replies[] = new Reply($reply['id'], 
									   $reply['parentpostid'],
									   $reply['userid'],
									   $reply['content'],
									   $reply['datecreated'],
									   $db);
				
			}		
					
			return $replies;
			
		}
		
			
	}
	
?>