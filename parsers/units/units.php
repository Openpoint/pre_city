<?php
include($_SERVER['DOCUMENT_ROOT']."/php/settings.php");
include($_SERVER['DOCUMENT_ROOT']."/php/dbactions.php");

    $input = json_decode(file_get_contents("unitlinks.geojson"),FALSE);
 	echo '<pre>';
	//print_r($input);
	echo '</pre><br><br>';
    foreach($input->features as $unit){
			//$return->sid=$lkbase->getstreetbygd($feature->properties->thorfare_i)['sid'];
			if(isset($unit->properties->name)){
				$return->name=$unit->properties->name;
			}else{
				$return->name='*?*';				
			}
			$return->geom=$unit->geometry->coordinates;
			$return->lid=$unit->properties->lid;
			$return->level=0;
			$return->area=$unit->properties->area;
			$return->tid=$unit->properties->tid;
			if($unit->properties->derelict=='Y'){
				$return->status=2;
			}else if($unit->properties->vacant=='Y'){
				$return->status=1;				
			}else{
				$return->status=0;				
			}
			echo '<pre>';
			print_r($unit);
			echo '</pre><br><br>';
								
			$lkbase->addunit($return->name,$return->tid,null,$return->geom,$return->lid,$return->status);



				
	}

?>
