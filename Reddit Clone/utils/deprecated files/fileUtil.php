<?php




function readJson($file_name){
	
	if(file_exists($file_name)){
		$array = json_decode(file_get_contents($file_name), true);
		
		if(is_array($array)){
			return $array;
		}
		else {
			return [];
		}
		
	}
	
	else{
		return array();
	}
}

function writeJson($file_name, $data=[]){
	
	//!encode all data
	$new_data = json_encode($data);
	
	
	
	//!write to file
	$handle = fopen($file_name, 'w');
	fwrite($handle, $new_data);
	
	
	
	//!close file
	fclose($handle);
	
	
}

?>

