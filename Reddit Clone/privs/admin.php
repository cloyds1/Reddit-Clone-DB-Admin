<?php
	
session_start();

require_once('../utils/dbUtil.php');
require_once('../utils/settings.php');

#check if logged in	
if(unserialize($_SESSION['user-data'])->authority != 'admin'){
		
	header('Location: ../login/login.php');
		
}
	
require('../rsrc/header.php');


?>

<body>

<?php 

#import necessary file in specific place
require('../rsrc/nav_bar.php'); 

?>

<div class="choice-container">
<a href="usermanage.php"><div  class="choice">
<h2>Manage users</h2>
</div></a>

<a href="postmanage.php"><div class="choice">
<h2>Manage Posts</h2>
</div></a>
</div>

</body
</body

<?php
require('../rsrc/footer.php');
?>