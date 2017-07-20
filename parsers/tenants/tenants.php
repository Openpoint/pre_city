<?php
include($_SERVER['DOCUMENT_ROOT']."/php/settings.php");
include($_SERVER['DOCUMENT_ROOT']."/php/dbactions.php");

    $input = json_decode(file_get_contents("distincttenants.geojson"),FALSE);
 	echo '<pre>';
	//print_r($input);
	echo '</pre><br><br>';
    foreach($input->features as $unit){

			echo '<pre>';
			print_r($unit->properties->ORGANISATION);
			echo '</pre><br><br>';
								
			$lkbase->addtenant($unit->properties->ORGANISATION);



				
	}

?>
