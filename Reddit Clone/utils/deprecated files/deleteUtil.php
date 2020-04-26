<?php



function deleteEntry($id=[], $file_name){
	
	
	if(count($id) < 1){
		return True;
	}
	
	$file_data = readJson($file_name);
	
	
	$temp_data = [];
	for($count=0; $count < count($file_data); $count++){
		
		if(!in_array($count, $id)){
			
			array_push($temp_data, $file_data[$count]);
			
		}
	}
	
	writeJson($file_name, $temp_data);
	
	return True;
	
	
}

?>