<?php

include($_SERVER['DOCUMENT_ROOT']."/php/settings.php");
include($_SERVER['DOCUMENT_ROOT']."/php/dbactions.php");

    $input = json_decode(file_get_contents("Streets_namesbyid.geojson"),FALSE);
    


    $streets=[];
    $streetsobj=[];
    $count=0;
    foreach($input->features as $feature){
	if(isset($feature->properties->THORFARE_ID) && isset($feature->properties->THORFARE_NAME)){

		if(!in_array($feature->properties->THORFARE_ID,$streets)){
			array_push($streets,$feature->properties->THORFARE_ID);
			$data = (object)array('gd_sid'=>$feature->properties->THORFARE_ID,'name'=>$feature->properties->THORFARE_NAME);
			array_push($streetsobj,$data);
			$count++;
		}

	}		
}
		
		
foreach($streetsobj as $street){
	echo '<pre>';
	print_r($street->name);
	echo '</pre><br>';
	$lkbase->addstreet($street->name,$street->gd_sid);		
}

?>
