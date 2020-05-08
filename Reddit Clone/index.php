<?php

session_start(); 

#import necessary files (note, classes.php isn't required to be imported, because it is already imported in dbUtil.php)
require('utils/dbUtil.php');
require_once('utils/settings.php');


require('rsrc/header.php');

?>

  <body>
  
  <?php
	
	require('rsrc/nav_bar.php');
	?>
	
	<div class="post-area">
	
		<?php 
			
			#echo 10 posts max on home page
			$data = mysqli_query($db, 'SELECT * FROM posts ORDER BY datecreated DESC LIMIT 10;');
			while($row = mysqli_fetch_assoc($data)){
				
				$post = new Post($row['id'], $row['userid'], $row['datecreated'], $row['title'], $row['content'], $db);
				$post->echoPostList();  
				
			}
			
		?>
		
	</div>
    
    <?php 
	
		require('rsrc/footer.php'); 
	
	?>