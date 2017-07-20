<?php
$type='university';
$results=[];
$key='AIzaSyDeU5DrXt7dVUejFlSRvWfC4M3oUd3pEh0';
$list=json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=52.661967,-8.625991&rankby=distance&types='.$type.'&key='.$key));
$newlist;
array_push ($results,$list->results);
function output(){
	global $results,$key,$list;
	$count=0;
	forEach($results as $rset){
		forEach($rset as $result){			
			$details=json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid='.$result->place_id.'&key='.$key));			
			$result->details=$details->result;
			echo '<pre>';
			print_r($result);
			echo '</pre>';
			$count++;
		}
	}
	//echo $count;
}
function getmore(){	
	global $results,$key,$list,$newlist;
	if($list!=$newlist){
		$req='https://maps.googleapis.com/maps/api/place/nearbysearch/json?pagetoken='.$list->next_page_token.'&key='.$key;
	}else{
		$req='https://maps.googleapis.com/maps/api/place/nearbysearch/json?pagetoken='.$newlist->next_page_token.'&key='.$key;		
	}
	$newlist=json_decode(file_get_contents($req));
	//print_r($list);
	
	if(isset($newlist->next_page_token)){
		array_push ($results,$list->results);
		$list=$newlist;
		sleep(1);
		getmore();
	}else if($newlist->status=='INVALID_REQUEST'){
		//echo '<br>fault<br>';
		sleep(1);
		getmore();		
	}else{
		array_push ($results,$list->results);
		output();
	}		
}

if(isset($list->next_page_token)){
	sleep(1);
	getmore();
}else{
	output();
}



