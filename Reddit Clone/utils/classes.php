<?php
	

	
	class User {
		
		public $username;
		public $password;
		public $bio;
		public $email;
		
		//public $followers;
		//public $likes;
		
		public function __construct($id=null, $authority=null, $username=null, $password=null, $bio=null, $email=null){
			
			$this->id = $id;
			$this->authority = $authority;
			
			$this->username = $username;
			$this->password = $password;
			
			$this->bio = $bio;
			$this->email = $email;
			//$this->followers = $followers;
			//$this->likes = $likes;
			
		}
		
		public function displayBio(){
			
			echo '
			
			<div class="full-post-style" style="text-align: center">
			
			<h1>'.$this->username.'</h1><br><div class="bio">'.$this->bio.'
			
			<form action="bio.php" method="post">
				
				<textarea name="bio">'.$this->bio.'</textarea>
				<br>
				<input type="submit" value="submit">
				<input type="reset" value="Reset">
				
			</form>
			
			</div>
			
			';
			
		}
	
	}
	
	class Post{
		
		public $id;
		public $userID;
		public $date_created;
		public $title;
		public $content;
		public $username;
		
		public function __construct($id=null, $userID=null, $date_created=null, $title=null, $content=null, $db=null){
			
			$this->db = $db;
			$this->id = $id;
			$this->userID = $userID;
			$this->date_created = $date_created;
			$this->title = $title;
			$this->content = $content;  
		
		}	
		

		public function echoPostFull(){
			
			echo '<div class="full-post-style"><p class="post-header-style">Posted by '.
			mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].' on: '
			.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br><p>'.$this->content.'</p></div>'; 
		
		}
		
		public function echoPostList(){
			
			echo '<a href="rsrc/detail.php?id='.$this->id.'"><div class="post-style box"><p class="post-header-style">Posted by '.
			mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].' on: '
			.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br><p>'.$this->content.'</p></div></a>'; 
		
		}
		
		public function echoPostDelete(){
			
			echo '<div class="full-post-style"><p class="post-header-style">Posted by '
					.mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on: ' .$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br> 
					Delete? <input type="checkbox" name="id[]" value="'.$this->id.'"></div>';
		}
		
		public function echoPostEdit(){
			
			echo '<a href="editForm.php?id='.$this->id.'"><div class="full-post-style box">
					<p class="post-header-style">Posted by '.
					mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on: '.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br>
					</div></a>';
		}
		
	}
	
	class Reply extends Post {
		
		public function __construct(){
			
		}
	}
		
	

	
	
		

?>