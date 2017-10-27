<?php

class lkdata {
	function lkdata($dbase) {
	$this->dbase=$dbase;
	}

	//get data for city global
	public function city(){
		$sql="
		SELECT 
			properties.pid, 
			properties.address, 
			levels.area, 
			levels.zid lzid, 
			levels.status, 
			levels.occupancy, 
			levels.level, 
			levels.lid, 
			units.uid uid, 
			units.status ustatus, 
			tenants.usage, 
			tenants.subusage, 
			tenants.zid zid, 
			tenants.refine 
		FROM 
			units 
			RIGHT OUTER JOIN 
				levels 
			ON 
				units.lid = levels.lid 
			LEFT OUTER JOIN 
				tenants 
			ON 
				units.tid = tenants.tid, 
			properties 
		WHERE 
			levels.pid = properties.pid";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){			
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			//return $response;			
			return $this->parsedata($response);
		}else{
			return $response->message;
		}		
	}

	//get data for street
	public function street($sid){
		$sql="
		SELECT properties.pid, properties.address, levels.area, levels.zid lzid, levels.status, levels.occupancy, levels.level, levels.lid, units.uid, units.status ustatus, tenants.usage, tenants.subusage, tenants.zid, tenants.refine 
		FROM units 
		RIGHT OUTER JOIN levels 
		ON units.lid = levels.lid 
		LEFT OUTER JOIN tenants 
		ON units.tid = tenants.tid, 
		properties 
		WHERE levels.pid = properties.pid AND properties.sid =:sid";
		$strings= Array(
			Array('token'=>':sid','value'=>$sid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){			
			$response=$response->fetchAll(PDO::FETCH_ASSOC);			
			return $this->parsedata($response);
		}else{
			return $response->message;
		}		
	}
	private function parsedata($response){
		$lid=[];
		$uid=[];
		//$level=[];
		$zid=[];
		$return=(object)array();
		$return->totarea=0;
		$return->vacantarea=0;
		$return->derelictarea=0;
		$return->unitcount=0;
		$return->areas = (object)array();
		$return->areas->total=0;
		$return->areas->status = (object)array();
		$return->areas->zoning = (object)array();
		$return->levels = (object)array();
			
		forEach($response as $loop){
			$l = $loop['level'];
			if(!isset($return->levels->$l)){
				//fwrite($myfile, print_r($loop['level'], TRUE));
				$return->levels->$l= (object)array();
				$return->levels->$l->unitcount = 0;
				$return->levels->$l->areas= (object)array();
				$return->levels->$l->areas->total = 0;
				$return->levels->$l->areas->unitcount = 0;		
				$return->levels->$l->areas->status = (object)array();
				$return->levels->$l->areas->zoning = (object)array();
			}
			
			$return->levels->$l->level=$l;
			
			if(isset($loop['area'])){

				if(!in_array($loop['uid'],$uid)){					
					array_push($uid,$loop['uid']);
				}
				if(!in_array($loop['zid'],$zid) && isset($loop['zid'])){						
					array_push($zid,$loop['zid']);
				}

			
				if(!in_array($loop['lid'],$lid)){
	
					$return->areas->total=$return->areas->total+$loop['area'];
					$return->levels->$l->areas->total=$return->levels->$l->areas->total+$loop['area'];
					
					if(isset($loop['status'])){
						$s = $loop['status'];
						if(!isset($return->areas->status->$s)){
							$return->areas->status->$s = (object)array();
							$return->areas->status->$s->zoning = (object)array();
							$return->areas->status->$s->total = 0;
						}
						if(!isset($return->levels->$l->areas->status->$s)){
							$return->levels->$l->areas->status->$s = (object)array();
							$return->levels->$l->areas->status->$s->zoning = (object)array();
							$return->levels->$l->areas->status->$s->total = 0;
						}				
						$return->areas->status->$s->total=$return->areas->status->$s->total+$loop['area'];
						$return->levels->$l->areas->status->$s->total=$return->levels->$l->areas->status->$s->total+$loop['area'];

					}
					

					
					if(isset($loop['lzid'])){
						$z = $loop['lzid'];
						if(!isset($return->areas->zoning->$z)){
							$return->areas->zoning->$z = (object)array();
						}
						if(!isset($return->areas->zoning->$z->total)){
							$return->areas->zoning->$z->total = 0;
						}				
						if(!isset($return->levels->$l->areas->status->$s->zoning->$z)){
							$return->levels->$l->areas->status->$s->zoning->$z = (object)array();
						}
						if(!isset($return->levels->$l->areas->status->$s->zoning->$z->total)){
							$return->levels->$l->areas->status->$s->zoning->$z->total = 0;
						}
						if(!isset($return->levels->$l->areas->zoning->$z)){
							$return->levels->$l->areas->zoning->$z = (object)array();
						}
						if(!isset($return->levels->$l->areas->zoning->$z->total)){
							$return->levels->$l->areas->zoning->$z->total = 0;
						}
						$return->areas->zoning->$z->zid=$loop['lzid'];
						$return->areas->zoning->$z->total=$return->areas->zoning->$z->total+$loop['area'];
						$return->levels->$l->areas->zoning->$z->zid=$loop['lzid'];					
						$return->levels->$l->areas->zoning->$z->total=$return->levels->$l->areas->zoning->$z->total+$loop['area'];
					}
					
					if(isset($loop['status'])&&isset($loop['lzid'])){
						if(!isset($return->areas->status->$s->zoning->$z)){
							$return->areas->status->$s->zoning->$z = (object)array();
						}
						if(!isset($return->areas->status->$s->zoning->$z->total)){
							$return->areas->status->$s->zoning->$z->total = 0;
						}
						$return->areas->status->$s->zoning->$z->total=$return->areas->status->$s->zoning->$z->total+$loop['area'];
						$return->levels->$l->areas->status->$s->zoning->$z->total=$return->levels->$l->areas->status->$s->zoning->$z->total+$loop['area'];					
					}	
											
					array_push($lid,$loop['lid']);
										
				}
				
			}
				
			if(isset($loop['zid'])){
				$zz = $loop['zid'];
				if(!isset($return->areas->zoning->$zz)){
					$return->areas->zoning->$zz = (object)array();
				}
				if(!isset($return->areas->zoning->$zz->unitcount)){
					$return->areas->zoning->$zz->unitcount = 0;
				}
				if(!isset($return->levels->$l->areas->zoning->$zz)){
					$return->levels->$l->areas->zoning->$zz = (object)array();
				}
				if(!isset($return->levels->$l->areas->zoning->$zz->unitcount)){
					$return->levels->$l->areas->zoning->$zz->unitcount = 0;
				}				
				$return->unitcount++;
				$return->levels->$l->unitcount++;		
				$return->areas->zoning->$zz->unitcount++;			
				$return->levels->$l->areas->zoning->$zz->unitcount++;	
						
			}	
					
		}
		return $return;			
	}
}
?>
