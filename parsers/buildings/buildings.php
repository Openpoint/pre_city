<?php
include($_SERVER['DOCUMENT_ROOT']."/php/settings.php");
include($_SERVER['DOCUMENT_ROOT']."/php/dbactions.php");

    $input = json_decode(file_get_contents("industrial.geojson"),FALSE);
 	echo '<pre>';
	//print_r($input);
	echo '</pre><br><br>';
    foreach($input->features as $feature){
			$return->sid=$lkbase->getstreetbygd($feature->properties->thorfare_i)['sid'];
			if(isset($feature->properties->no)){
				$return->address=$feature->properties->no;
			}else{
				$return->address='*?*';				
			}
			$return->geom=$feature->geometry->coordinates;
			$return->gd_pid=$feature->properties->building_i;
			$return->level=0;
			$return->area=$feature->properties->area;
			$return->zid=5;
			if($feature->properties->derelict=='Y'){
				$return->status=2;
			}else if($feature->properties->vacant=='Y'){
				$return->status=1;				
			}else{
				$return->status=0;				
			}
			echo '<pre>';
			print_r($feature);
			echo '</pre><br><br>';
			if(count($return->geom) == 1){								
				$return->pid=$lkbase->addprop($return->sid,$return->address,$return->geom,$return->gd_pid);
				$lkbase->addlevel($return->pid, $return->zid,$return->level,$return->area,$return->status,$return->geom);
			}

				
	}

?>
