<?php
include($_SERVER['DOCUMENT_ROOT']."/php/settings.php");
include($_SERVER['DOCUMENT_ROOT']."/php/dbactions.php");


function cmp($a, $b) {
	global $$scrit;
	
	if ($a->properties->${$scrit} == $b->properties->${$scrit}) {
		return 0;
	} else {
		return $a->properties->${$scrit} < $b->properties->${$scrit} ? -1 : 1; // reverse order
	}
}
$input = json_decode(file_get_contents("unitlinks.geojson"),FALSE);
$$scrit='NACE_CODE';

usort($input->features,'cmp');
    
//echo '<pre>';
//print_r($input->features);
//echo '</pre><br><br>';
$innace=[];
function makecode(){
	global $input,$innace;
	echo '<pre>';
	foreach($input->features as $unit){
		$pnace=$unit->properties->NACE_CODE;		
		if(!in_array($pnace,$innace)){	
			$nacecat=$unit->properties->CATEGORY;
			$nace=explode(".", $unit->properties->NACE_CODE);
			$nace[1]=intval($nace[1]);
			$nace[2]=intval($nace[2]);
			array_push($innace,$pnace);
			if(!isset($cat->$nace[0])){
				$cat->$nace[0]=(object)array();
				
			}
			
			if(!isset($cat->$nace[0]->$nace[1])){
				$cat->$nace[0]->$nace[1]=(object)array();
			}
			if(!isset($cat->$nace[0]->$nace[1]->$nace[2])){
				$cat->$nace[0]->$nace[1]->$nace[2]='//'.$pnace.' | '.$nacecat.'<br>';
			}
						
		}									
		
	}
	//print_r($cat);
	foreach($cat as $akey=>$aval){;
		echo "if(\$nace[0]=='".$akey."'){<br>";
			echo "	\$return->zid=null; //**<br>";
			echo "	\$return->usage=null; //**<br>";
			foreach($aval as $bkey=>$bval){
				
				echo "	if(\$nace[1]==".$bkey."){<br>";
				echo "		\$return->subusage=null; //**<br>	";
					foreach($bval as $ckey=>$cval){						
						echo "<br>		".$cval."<br>";
						echo "		if(\$nace[2]==".$ckey."){<br>";
						echo "			\$return->refine=null; //**<br>";
						echo "		}<br>";
					}
				echo "	}<br>";
			}
		echo "}<br>";
	}	
	echo '</pre>';
}
//makecode();
function runcode(){
	$return=(object)array();
	global $input,$innace,$lkbase;
	foreach($input->features as $unit){
		$pnace=$unit->properties->NACE_CODE;			
		$nace=explode(".", $unit->properties->NACE_CODE);
		$nace[1]=intval($nace[1]);
		$nace[2]=intval($nace[2]);
		include('runcode.php');
		echo '<pre>';
		print_r($return);
		//print_r($unit->properties->tid);
		echo '</pre>';
	$lkbase->edittenant($unit->properties->tid,null,null,$return->usage,$return->subusage,$return->zid,$return->refine);

	}
}

runcode();

?>
