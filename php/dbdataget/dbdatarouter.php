<?php
if(isset($data->getdata)){
	//Data Getters
	if($data->getdata == 'city'){
		$action=$lkdata->city();
		print_r(json_encode($action));
		return;		
	}
	if($data->getdata == 'street'){
		$action=$lkdata->street($data->sid);
		print_r(json_encode($action));
		return;		
	}	
}
?>
