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
			
			
			</div>
			
			';
			
		}
		
		public function echoSearch(){
			
			echo "<div class=\"search\" style=\"text-align: left;\"><p>User ID: ".$this->id."<br>User Name: ".$this->username."<br>Email: ".$this->email."
			<br>Authority level: ".$this->authority."</p>
			
			<a href=\"usermanage.php?id=".$this->id."\"><button type=\"button\" class=\"btn btn-secondary btn-sm\">Delete</button></a>
			<a href=\"userEdit.php?id=".$this->id."\"><button type=\"button\" class=\"btn btn-secondary btn-sm\">Edit</button>
			
			</a> </div>";
		}
		
		public function echoUserEdit(){
			
			echo '<a href="userEdit.php?id='.$this->id.'"><div class="full-post-style box">
					<p class="post-header-style">Posted by '.
					mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on: '.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br>
					</div></a>';
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
			$this->date_created = date('M d, Y h:i:sA', strtotime($date_created));
			$this->title = $title;
			$this->content = $content;  
		
		}	
		

		public function echoPostFull(){
			
			echo '<div class="full-post-style"><p class="post-header-style">Posted by '.
			mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].' on: '
			.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br><p>'.$this->content.'</p>
			<button id="btn1" type="button" class="btn btn-secondary btn-sm" style="display: none;">Reply</button></div>
			
			<form id="hideForm" class="hide-form" action="replyHandle.php" method="post">
			
			<textarea id="content" name="content" placeholder="Enter text here"  rows="5" cols="75"></textarea><hr>
			
			<input type="submit" value="Submit">
			<input type="reset" value="Reset">
			</form>'; 
		
		}
		
		public function echoPostList(){
			
			echo '<a href="rsrc/detail.php?id='.$this->id.'"><div class="post-style box"><p class="post-header-style">Posted by: '.
			mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].' on '
			.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br><p>'.$this->content.'</p></div></a>'; 
		
		}
		
		public function echoPostDelete(){
			
			echo '<div class="full-post-style"><p class="post-header-style">Posted by '
					.mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on ' .$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br> 
					Delete? <input type="checkbox" name="id[]" value="'.$this->id.'"></div>';
		}
		
		public function echoPostEdit(){
			
			echo '<a href="editForm.php?id='.$this->id.'"><div class="full-post-style box">
					<p class="post-header-style">Posted by '.
					mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on '.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br>
					</div></a>';
		}
		
		public function echoPostSearch(){
			
			echo '<div class="search" style="text-align: left;">
					<p class="post-header-style">Posted by '.
					mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].
					' on: '.$this->date_created.'</p><hr><h2>'.$this->title.'</h2><br>
					<a href="postmanage.php?deleteid='.$this->id.'"><button type="button" class="btn btn-secondary btn-sm">Delete</button></a>
					<a href="../privs/postEdit.php?id='.$this->id.'"><button type="button" class="btn btn-secondary btn-sm">Edit</button></a></div></div>';
					
		}
		
	}
	
	class Reply{
		
		
		public $db;
		public $id;
		public $parentID;
		public $userID;
		public $date_created;
		public $content;
			
		public function __construct($id, $parentID, $userID, $content, $date_created, $db){
			
			
			$this->db = $db;
			$this->id = $id;
			$this->parentID = $parentID;
			$this->userID = $userID;
			$this->content = $content;
			$this->date_created = date('M d,Y h:i:sA', strtotime($date_created));
			
		}
		
		public function echoReply($authority){
			
			echo '<div class="reply-style"> '.mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM users WHERE id=$this->userID;"))['username'].' replied on '.
			$this->date_created.'.<hr><p>'.$this->content.'</p></div>';
			
			
		}
	}
		
	

	
	
		

?>