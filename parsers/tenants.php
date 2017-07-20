<?php
include("php/settings.php");
include("php/dbactions.php");

    $input = json_decode(file_get_contents("city.geojson"),FALSE);
    $tenants=[];
    foreach($input->features as $feature){
		if(isset($feature->properties->tags->amenity) && isset($feature->properties->tags->name) && $feature->properties->tags->amenity!='bus_station' && $feature->properties->tags->amenity!='bicycle_rental' && $feature->properties->tags->amenity!='clock'){
			if(!in_array($feature->properties->tags->name,$tenants)){
				//echo $feature->properties->tags->name.' | '.$feature->id.'<br><br>';
				array_push($tenants,$feature->properties->tags->name);
			}
		}
		if(isset($feature->properties->tags->tourism) && isset($feature->properties->tags->name)){
			if(!in_array($feature->properties->tags->name,$tenants)){
				//echo $feature->properties->tags->name.' | '.$feature->id.'<br><br>';
				array_push($tenants,$feature->properties->tags->name);
			}
		}
		if((isset($feature->properties->tags->amenity) && isset($feature->properties->tags->building) || isset($feature->properties->tags->shop) || isset($feature->properties->tags->pub)) && isset($feature->properties->tags->name)){
			
			if(!in_array($feature->properties->tags->name,$tenants)){
				//echo $feature->properties->tags->name.' | '.$feature->id.'<br><br>';
				array_push($tenants,$feature->properties->tags->name);
			}
		}		
	}
	foreach($tenants as $tenant){
		echo '</pre>';
		print_r($tenant);
		echo '</pre><br><br>';
		$lkbase->addtenant($tenant,null,null);		
	}


?>
