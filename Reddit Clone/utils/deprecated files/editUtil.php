<?php



function editEntry($id, $data, $file_name){
	
	$file_data = readJson($file_name);

	if(isset($file_data[$id])){
		
		 $file_data[$id] = $data;
	
	}
	
	else{
		echo 'index doesn\'t exist';
		return false;
		
	}
	
	writeJson($file_name, $file_data);
	
}

?>