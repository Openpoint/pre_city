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
		if(!$response->fail){			
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
		if(!$response->fail){			
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

		forEach($response as $loop){
			$return->levels->$loop['level']->level=$loop['level'];
			if(isset($loop['area'])){

				if(!in_array($loop['uid'],$uid)){					
					array_push($uid,$loop['uid']);
				}
				if(!in_array($loop['zid'],$zid) && isset($loop['zid'])){						
					array_push($zid,$loop['zid']);
				}

			
				if(!in_array($loop['lid'],$lid)){
	
					$return->areas->total=$return->areas->total+$loop['area'];
					$return->levels->$loop['level']->areas->total=$return->levels->$loop['level']->areas->total+$loop['area'];
					if(isset($loop['status'])){					
						$return->areas->status->$loop['status']->total=$return->areas->status->$loop['status']->total+$loop['area'];
						$return->levels->$loop['level']->areas->status->$loop['status']->total=$return->levels->$loop['level']->areas->status->$loop['status']->total+$loop['area'];

					}
					if(isset($loop['status'])&&isset($loop['lzid'])){
						$return->areas->status->$loop['status']->zoning->$loop['lzid']->total=$return->areas->status->$loop['status']->zoning->$loop['lzid']->total+$loop['area'];
						$return->levels->$loop['level']->areas->status->$loop['status']->zoning->$loop['lzid']->total=$return->levels->$loop['level']->areas->status->$loop['status']->zoning->$loop['lzid']->total+$loop['area'];					
					}
					if(isset($loop['lzid'])){
						$return->areas->zoning->$loop['lzid']->zid=$loop['lzid'];
						$return->levels->$loop['level']->areas->zoning->$loop['lzid']->zid=$loop['lzid'];
						$return->areas->zoning->$loop['lzid']->total=$return->areas->zoning->$loop['lzid']->total+$loop['area'];
						$return->levels->$loop['level']->areas->zoning->$loop['lzid']->total=$return->levels->$loop['level']->areas->zoning->$loop['lzid']->total+$loop['area'];
					}							
					array_push($lid,$loop['lid']);
										
				}

			}

			if(isset($loop['zid'])){
				$return->unitcount++;
				$return->levels->$loop['level']->unitcount++;
				$return->areas->zoning->$loop['zid']->unitcount++;
				$return->levels->$loop['level']->areas->zoning->$loop['zid']->unitcount++;			
			}				
		}
			
		$foo=[];
		forEach($return->zonings as $zone){
			array_push($foo,$zone);
		}
		$return->zonings=$foo;

		return $return;			
	}
}
?>
