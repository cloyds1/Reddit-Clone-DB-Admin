

<?php
session_start();

#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('../utils/dbUtil.php');
require('../utils/settings.php');

#check if $_GET value is a valid index
if(!isset($_GET['id'])){
	die('No id: go back to the <a href="index.php">
Home page</a>');
}

if(!is_numeric($_GET['id']) || $_GET['id']<1){
	die('Invalid: go back to the <a href="index.php">Home page</a>');
	
}

#get user data
$user = isset($_SESSION['user-data'])? unserialize($_SESSION['user-data'])->username : false;
$authority = isset($_SESSION['user-data'])? unserialize($_SESSION['user-data'])->authority : false;

#read the post at index and instantiate as a Post object
$post = DatabaseUtil::readEntry($_GET['id'], 'posts', $db);

#get all replies relating to this post
$replies = DatabaseUtil::getAllPostReplies($_GET['id'], $db);

#get current time using mysql
$date_data = mysqli_fetch_array(mysqli_query($db, "SELECT NOW();"))[0];

#format the time to a readable format
$formatted_date_data = date("M d, Y h:i:sA", strtotime($date_data));

require("header.php");

?>



	
<body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<script>
	

	var user = "<?=$user?>";
	var postID = <?=$post->id;?>;
	var date = "<?=$formatted_date_data?>";
	
	var isSet = false;
	
	$(document).ready(function(){
			
			if(user){
				$("#btn1").css({"display":"block"});
			}
			
			$("#hideForm").submit(function(e){
				
				//prevent redirect with form submission
				e.preventDefault();
				
				//update page with new reply
				var text = '<div class="reply-style">Posted by: ' + user + ' on ' + date + '.<hr><p>' + $("#content").val() + '</p></div>';
				$("#reply-area").append(text);
				
				//send data via POST to reply handler
				jQuery.ajax({
					
					url: "replyHandle.php",
					dataType: "json",
					data:{'content': $("#content").val(), 'postID': postID},
					type: "POST"
				
				});
				
				
			});
			
			
			$("#btn1").click(function(){
					
					//toggle isSet when button is clicked
					isSet = !isSet;
					
					//if set, display Reply button on parent with "Reply"
					if(isSet){
						$("#btn1").text("Cancel");
						$("#hideForm").css({"display" : "block"});
					}
					
					//if not set, display REply button on parent with "Cancel"
					else{
						$("#btn1").text("Reply");
						$("#hideForm").css({"display" : "none"});
					}
					
				}
				
			);
			
			
			
			
		}
	);
	
	
	</script>
	
<?php 

#import necessary resources
require_once('nav_bar.php'); 

$post->echoPostFull(); 
?>

<div id="reply-area">

<?php

	//echo all replies
	foreach($replies as $reply){
		$reply->echoReply($authority);
	}
		
  ?>
  
  
  </div>

<?php
require_once('footer.php');
?>


  
    

 