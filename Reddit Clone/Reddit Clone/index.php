<?php

session_start(); 

#import necessary file (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('utils/dbUtil.php');

#create database connection
$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb'); 

require('rsrc/header.php');

?>

  <body>
  
  <?php
	
	require('rsrc/nav_bar.php');
	?>
	
	<div class="post-area">
	
		<?php 
			
			#echo 10 posts max on home page
			$data = mysqli_query($db, 'SELECT * FROM posts LIMIT 10;');
			while($row = mysqli_fetch_assoc($data)){
				
				$post = new Post($row['id'], $row['userid'], $row['datecreated'], $row['title'], $row['content'], $db);
				$post->echoPostList();  
				
			}
			
		?>
		
	</div>
    
    <?php 
	
		require('rsrc/footer.php'); 
	
	?>