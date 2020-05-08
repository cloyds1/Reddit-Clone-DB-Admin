<?php 


$currentDirectory = explode('/', $_SERVER['PHP_SELF']);

$inRoot = True;
if($currentDirectory[count($currentDirectory) - 2] != 'Reddit Clone'){
	$inRoot = False;
}

$session_not_set = !isset($_SESSION['user-data']);

	
?>
	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="" href="<?=($inRoot? '' :'../')?>index.php"><h3>Peruser&nbsp;&nbsp;&nbsp;</h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=($inRoot? '' :'../')?>index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posting Tools
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		
          <a class="dropdown-item" href="<?=($inRoot? '' :'../')?>modify/create.php">Create a new post</a>
          <a class="dropdown-item" href="<?=($inRoot? '' :'../')?>modify/delete.php">Delete an old post</a>
		  <a class="dropdown-item" href="<?=($inRoot? '' :'../')?>modify/edit.php">Edit an old post</a>
		  
		  <?php 
		  
			if(isset($_SESSION['user-data'])){
				
				$userdataobj = unserialize($_SESSION['user-data']);
				$path = ($inRoot? '' :'../');
				
				if($userdataobj->authority == 'admin'){
					$path = $path.'privs/admin.php';
					echo "<hr><a class=\"dropdown-item\" href=\"$path\">Special privileges</a>";
				}
				
				else if($userdataobj->authority == 'manager'){
					$path = $path.'privs/postmanage.php';
					echo "<hr><a class=\"dropdown-item\" href=\"$path\">Special privileges</a>";
				}
			}
		  
		  ?>
		  
          
        </div>
		
		
		
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
      </li>
    </ul>
	
	<?php 
			
		if(isset($_SESSION['user-data'])){
			$userdataobj = unserialize($_SESSION['user-data']);
			echo '<a href="'.($inRoot? '' :'../').'rsrc/bio.php?id='.$userdataobj->id.'"><div class="userbubble box"><b>'.$userdataobj->username.'</b></div></a>';
		}
	?>
	
	<?php 
		
		if($session_not_set){
			echo '<a href="'.($inRoot? '' :'../').'login/login.php"><button type="button" class="btn btn-primary butn">Login</button></a>
				  <a href="'.($inRoot? '' :'../').'signin/signup.php"><button type="button" class="btn btn-primary butn">Sign up</button></a>';
		}
	
		else{
			echo '<a href="'.($inRoot? '' :'../').'signin/signout.php"><button type="button" class="btn btn-primary butn">Sign out</button></a>';
		}
		
	?>
	
	
	
	

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>