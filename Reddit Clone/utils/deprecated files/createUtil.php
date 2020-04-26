<?php



function createEntry($data, $file_name){
	
	//!open & read file
	$file_data = readJson($file_name);
	
	if($file_data == NULL){
		$file_data = [$data];
	}
	
	else{
		array_push($file_data, $data);
	}
	
	//!append entry
	writeJson($file_name, $file_data);
	
	
}

?>