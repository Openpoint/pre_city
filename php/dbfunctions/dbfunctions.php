<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/php/gisconverter/gisconverter.php');


class lkbase {

    function lkbase($dbase) {
        $this->dbase=$dbase;
    }
    function lkdecoder($decoder) {
        $this->decoder=$decoder;
    }
/*---------------Getters----------------------*/
	//get properties for map
	public function getprops($level){
		if($level==null){
			$level=0;
		}
		$strings= Array(
			Array('token'=>':level','value'=>$level)
		);

		$sql="
			SELECT
			  properties.pid,
			  properties.address,
			  properties.sid,
			  levels.geom,
			  levels.lid,
			  levels.zid,
			  levels.status
			FROM
			  public.properties,
			  public.levels
			WHERE
			  levels.pid = properties.pid AND
			  levels.level = :level AND
			  levels.zid IS NOT NULL
		";
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			$geojson=(object)array(
				'type'=>'FeatureCollection',
				'features'=>array()
			);

			$collect=[];
			foreach($response as $feature){
				$shape=(object)array(
						"type"=>"Feature",
						"id"=>$feature["pid"],
						"properties"=>(object)array(
							"sid"=>$feature["sid"],
							"address"=>$feature["address"],
							"zid"=>$feature["zid"],
							"status"=>$feature["status"]
						),
						"geometry"=>(object)array(
							"type"=>"Polygon",
							"coordinates"=>json_decode($feature["geom"])
						)
				);
				array_push($collect,$shape);
			};
			//$geojson->features=$collect;
			return $collect;

		}else{
			return $response->message;
		}
	}


	//get a list of all streets
	public function getstreets(){
		$sql="SELECT sid,name FROM streets";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			//set the key on the array to match the street ID (sid)
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a list of all unique levels for the key
	public function getlevelskey(){
		$sql="SELECT DISTINCT level FROM levels ORDER BY level";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a sid by geodatabase
	public function getstreetbygd($gd_sid){
		$sql="SELECT DISTINCT sid FROM streets WHERE gd_sid=:gd_sid";
		$strings= Array(
			Array('token'=>':gd_sid','value'=>$gd_sid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			return $response->message;
		}
	}
	//get a list of all agents
	public function getagents(){
		$sql="SELECT aid AS aid,agency AS agency FROM agents";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			//set the key on the array to match the agent ID (aid)
			$foo=array();
			foreach($response as $value){
				$foo2=array();
				$foo2['aid']=$value['aid'];
				$foo2['agency']=$value['agency'];
				$foo[$value['aid']]=$foo2;
			}
			return $foo;
		}else{
			return $response->message;
		}
	}
	//get a list of all tenants
	public function gettenants(){
		$sql="SELECT tid,tenant,zid,usage,subusage,refine FROM tenants";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a single tenant
	public function gettenant($tid){
		$sql="SELECT * FROM tenants WHERE tid=:tid";
		$strings= Array(
			Array('token'=>':tid','value'=>$tid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a single level
	public function getlevel($lid){
		$sql="
			SELECT
				*
			FROM
				levels
			WHERE
				levels.lid=:lid
			";
		$strings= Array(
			Array('token'=>':lid','value'=>$lid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a tenant's adresses
	public function gettenantadd($tid){
		$sql="SELECT levels.level, levels.lid, properties.address, properties.pid, units.code, units.uid, streets.name FROM levels levels, units units, properties properties, streets streets WHERE levels.lid = units.lid AND properties.pid = levels.pid AND streets.sid = properties.sid AND units.tid = :tid";
		$strings= Array(
			Array('token'=>':tid','value'=>$tid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a list of all zones
	public function getzones(){
		$sql="SELECT zid AS zid,zoning AS zoning,color AS color FROM zoning";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			//set the key on the array to match the zone ID (zid)
			$foo=array();
			foreach($response as $value){
				$foo2=array();
				$foo2['zid']=$value['zid'];
				$foo2['zoning']=$value['zoning'];
				$foo2['color']=$value['color'];
				$foo[$value['zid']]=$foo2;
			}
			return $foo;
		}else{
			return $response->message;
		}
	}

	//get footfall weight
	public function getffall(){
		$sql="SELECT * FROM footfall ORDER BY value ASC";
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all info for level
	public function getlevels($pid){
		$sql="SELECT lid,level,area,tenants,status,image,zid FROM levels WHERE pid=:pid ORDER BY level ASC";
		$strings= Array(
			Array('token'=>':pid','value'=>$pid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all units for city level
	public function getallunits($level,$zid,$usage,$subusage,$refine,$status,$sid){
		$strings= Array();
		$subq=''; 
		$subq2=''; 
		$subq3=''; 
		$subq4='';
		if(isset($level)){
			$subq4=" AND levels.level = :level";
			array_push($strings, Array('token'=>':level','value'=>$level));
		}

		if(isset($zid)){
			$subq=" AND tenants.zid=:zid";
			array_push($strings, Array('token'=>':zid','value'=>$zid));
		}
		if(isset($usage)){
			$subq=" AND tenants.zid=:zid AND tenants.usage=:usage";
			array_push($strings, Array('token'=>':usage','value'=>$usage));
		}
		if(isset($subusage)){
			$subq=" AND tenants.zid=:zid AND tenants.usage=:usage AND tenants.subusage=:subusage";
			array_push($strings, Array('token'=>':subusage','value'=>$subusage));
		}
		if(isset($refine)){
			$subq=" AND tenants.zid=:zid AND tenants.usage=:usage AND tenants.subusage=:subusage AND tenants.refine=:refine";
			array_push($strings, Array('token'=>':refine','value'=>$refine));
		}
		if(isset($status)){
			$subq2=" AND units.status=:status";
			array_push($strings, Array('token'=>':status','value'=>$status));
		}
		if(isset($sid)){
			$subq3=" AND properties.sid=:sid";
			array_push($strings, Array('token'=>':sid','value'=>$sid));
		}
		$sql="
		SELECT
			properties.pid,
			properties.sid,
			properties.address,
			levels.lid,
			levels.level,
			units.geom,
			units.uid,
			units.code,
			units.status,
			tenants.tenant,
			tenants.tid,
			tenants.zid,
			tenants.usage,
			tenants.subusage,
			tenants.refine
		FROM
			tenants
		RIGHT OUTER JOIN
			units
		ON
			tenants.tid = units.tid,
			levels,
			properties
		WHERE
			levels.pid = properties.pid AND
			units.lid = levels.lid".$subq4.$subq2.$subq3.$subq;

		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all not occupied units for city level
	public function getalleunits($level,$zid,$status,$sid){
		$strings= Array(
		);
		if(isset($level)){
			$subq4=" AND levels.level = :level";
			array_push($strings, Array('token'=>':level','value'=>$level));
		}

		if(isset($zid)){
			$subq=" AND levels.zid=:zid";
			array_push($strings, Array('token'=>':zid','value'=>$zid));
		}
		if(isset($status)){
			$subq2=" AND units.status=:status";
			array_push($strings, Array('token'=>':status','value'=>$status));
		}
		if(isset($sid)){
			$subq3=" AND properties.sid=:sid";
			array_push($strings, Array('token'=>':sid','value'=>$sid));
		}
		$sql="
		SELECT
			properties.pid,
			properties.sid,
			properties.address,
			levels.lid,
			levels.level,
			levels.zid,
			units.geom,
			units.uid,
			units.code,
			units.status
		FROM
			properties,
			levels,
			units
		WHERE
			levels.pid = properties.pid AND
			units.lid = levels.lid".$subq4.$subq2.$subq3.$subq;

		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all empty units for city level
	public function getallvunits($level,$status){
		if(!isset($status)){
			$status=0;
		}
		$sql="
		SELECT units.geom,units.uid,units.tid,units.status,levels.pid,levels.lid
		FROM  units,levels
		WHERE units.lid=levels.lid
		AND levels.level=:level
		AND units.status=:status
		";

		$strings= Array(
			Array('token'=>':level','value'=>$level),
			Array('token'=>':status','value'=>$status)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all units for property level
	public function getunits($lid){
		$sql="
		SELECT
			units.*,
			tenants.tenant
		FROM
			tenants
		RIGHT OUTER JOIN
			units
		ON
			tenants.tid = units.tid
		WHERE
			units.lid=:lid
		ORDER BY code ASC
		";
		$strings= Array(
			Array('token'=>':lid','value'=>$lid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get all units for whole property
	public function getpunits($pid){
		$sql="
		SELECT
			units.*,
			tenants.tenant,
			levels.level
		FROM
			units,
			tenants,
			levels,
			properties
		WHERE
			units.tid=tenants.tid AND
			units.lid=levels.lid AND
			levels.pid=properties.pid AND
			properties.pid=:pid
		ORDER BY code ASC";
		$strings= Array(
			Array('token'=>':pid','value'=>$pid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a single unit
	public function getunit($uid){
		$sql="
		SELECT
			properties.pid,
			properties.sid,
			properties.address,
			levels.lid,
			levels.level,
			units.geom,
			units.uid,
			units.code,
			tenants.tenant,
			tenants.about,
			tenants.tid,
			tenants.zid,
			tenants.usage,
			tenants.subusage,
			tenants.refine,
			units.status,
			units.image,
			units.agents
		FROM
			tenants
		RIGHT OUTER JOIN
			units
		ON
			tenants.tid = units.tid,
			levels,
			properties
		WHERE
			levels.pid = properties.pid AND
			units.lid = levels.lid AND
			units.uid = :uid
		";
		$strings= Array(
			Array('token'=>':uid','value'=>$uid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a single property
	public function getproperty($pid){
		$sql="SELECT array_to_json(agents) AS agents, pid, address, sid, footfall, image FROM properties WHERE pid=:pid";
		$strings= Array(
			Array('token'=>':pid','value'=>$pid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a single agent
	public function getagent($aid){
		$sql="SELECT * FROM agents WHERE aid=:aid";
		$strings= Array(
			Array('token'=>':aid','value'=>$aid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
	//get a properties by agent
	public function getpropbyagent($aid){
		$sql="SELECT * FROM properties WHERE :aid=ANY (agents)";
		$strings= Array(
			Array('token'=>':aid','value'=>$aid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			return $response->message;
		}
	}
/*---------------Setters----------------------*/
	//Add a new street
	public function addstreet($street,$gd_sid){
		return null;
		$sql="INSERT INTO streets (name,gd_sid) values (:name,:gd_sid) RETURNING sid";
		$strings= Array(
			Array('token'=>':name','value'=>$street),
			Array('token'=>':gd_sid','value'=>$gd_sid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0]['sid'];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Add a new zone
	public function addzone($zoning,$color){
		return null;
		$sql="INSERT INTO zoning (zoning,color) values (:zoning,:color) RETURNING zid";
		$strings= Array(
			Array('token'=>':zoning','value'=>$zoning),
			Array('token'=>':color','value'=>$color)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0]['zid'];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Add a new property
	public function addprop($street,$address,$geom,$gd_pid){
		return null;
		if(isset($geom)){
			$geom=json_encode($geom);
		}

		$sql="INSERT INTO properties (sid,address,geom,gd_pid) values (:sid,:address,:geom,:gd_pid) RETURNING pid";
		$strings= Array(
			Array('token'=>':sid','value'=>$street),
			Array('token'=>':address','value'=>$address),
			Array('token'=>':geom','value'=>$geom),
			Array('token'=>':gd_pid','value'=>$gd_pid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0]['pid'];
		}else{
			http_response_code(412);
			//print_r($response->message);
			return $response->message;
		}
	}
	//Add a new level
	public function addlevel($pid,$zid,$level,$area,$status,$geom){
		return null;
		if(!isset($level)){
			$sql="SELECT lid,geom,area,status FROM levels WHERE pid=:pid";
			$strings= Array(
				Array('token'=>':pid','value'=>$pid),
			);
			$response=$this->dbase->query($sql,$strings);
			if(!isset($response->fail)||!$response->fail){
				global $level;
				$response=$response->fetchAll(PDO::FETCH_ASSOC);

				$level=count($response);
			}else{
				http_response_code(412);
				return $response->message;
			}
		}
		if(isset($geom)){
			$geom=json_encode($geom);
		}else{
			$geom=$response[$level-1]['geom'];
		}
		if(!isset($area)){
			$area=$response[$level-1]['area'];
		}
		if(!isset($status)){
			$status=$response[$level-1]['status'];
		}
		$sql="INSERT INTO levels (level,pid,zid,area,status,geom) values (:level,:pid,:zid,:area,:status,:geom) RETURNING lid";
		$strings= Array(
			Array('token'=>':level','value'=>$level),
			Array('token'=>':pid','value'=>$pid),
			Array('token'=>':zid','value'=>$zid),
			Array('token'=>':area','value'=>$area),
			Array('token'=>':status','value'=>$status),
			Array('token'=>':geom','value'=>$geom)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Add a new agent
	public function addagent($agency,$address1,$address2,$address3,$email,$telephone,$about){
		return null;
		$sql="INSERT INTO agents (agency,address1,address2,address3,email,telephone,about) values (:agency,:address_a,:address_b,:address_c,:email,:telephone,:about) RETURNING *";
		$strings= Array(
			Array('token'=>':agency','value'=>$agency),
			Array('token'=>':address_a','value'=>$address1),
			Array('token'=>':address_b','value'=>$address2),
			Array('token'=>':address_c','value'=>$address3),
			Array('token'=>':email','value'=>$email),
			Array('token'=>':telephone','value'=>$telephone),
			Array('token'=>':about','value'=>$about)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Add a new tenant
	public function addtenant($tenant,$url,$about,$zid,$usage,$subusage,$refine){
		return null;
		$sql="INSERT INTO tenants (tenant,url,about,zid,usage,subusage,refine) values (:tenant,:url,:about,:zid,:usage,:subusage,:refine) RETURNING *";
		$strings= Array(
			Array('token'=>':tenant','value'=>$tenant),
			Array('token'=>':url','value'=>$url),
			Array('token'=>':about','value'=>$about),
			Array('token'=>':zid','value'=>$zid),
			Array('token'=>':usage','value'=>$usage),
			Array('token'=>':subusage','value'=>$subusage),
			Array('token'=>':refine','value'=>$refine)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Add a new unit
	public function addunit($code,$tid,$agents,$geom,$lid,$status){
		return null;
		$agents='{'.implode(",",$agents).'}';
		$geom=json_encode($geom);
		if(!$status){
			if(!$tid){
				$status=1;
			}else{
				$status=0;
			}
		}
		$sql="INSERT INTO units (code,tid,agents,geom,lid,status) values (:code,:tid,:agents,:geom,:lid,:status) RETURNING *";
		$strings= Array(
			Array('token'=>':code','value'=>$code),
			Array('token'=>':tid','value'=>$tid),
			Array('token'=>':agents','value'=>$agents),
			Array('token'=>':geom','value'=>$geom),
			Array('token'=>':lid','value'=>$lid),
			Array('token'=>':status','value'=>$status)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
/*---------------Changers----------------------*/

	//Change a single item
	public function upditem($table, $key, $keyval, $column, $colval){
		return null;
		if($column == 'geom'){
			$colval=json_encode($colval);

		}
		$sql="UPDATE ".$table." SET ".$column."=:colval WHERE ".$key."=:keyval RETURNING ".$column.",".$key;
		$strings= Array(
			Array('token'=>':keyval','value'=>$keyval),
			Array('token'=>':colval','value'=>$colval)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Delete a row
	public function delrow($table, $key, $keyval){
		return null;
		$sql="DELETE FROM ".$table." WHERE ".$key."=:keyval";
		$strings= Array(
			Array('token'=>':keyval','value'=>$keyval)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response->fetchAll(PDO::FETCH_ASSOC);
			$response=Array($table);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Delete a property
	public function delproperty($pid,$table){
		return null;
		$sql="DELETE FROM ".$table." WHERE pid=:pid";
		$strings= Array(
			Array('token'=>':pid','value'=>$pid),
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Delete units from specified building levels
	public function delunits($lid){
		return null;
		$count=1;
		$length=count($lid);
		forEach($lid as $li){
			if($count < $length){
				$lids=$lids.$li." OR lid=";
			}else{
				$lids=$lids.$li;
			}
			$count++;
		}
		$sql="DELETE FROM units WHERE lid=".$lids;
		$strings= Array(
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Delete specific unit
	public function delunit($uid){
		return null;
		$sql="DELETE FROM units WHERE uid=:uid";
		$strings= Array(
			Array('token'=>':uid','value'=>$uid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Delete a tenant
	public function deltenant($tid){
		return null;
		$sql="DELETE FROM tenants WHERE tid=:tid";
		$strings= Array(
			Array('token'=>':tid','value'=>$tid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response->fetchAll(PDO::FETCH_ASSOC);
			return 'ok';
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Edit a unit

	public function editunit($code,$tid,$agents,$geom,$uid,$status){
		return null;
		$agents='{'.implode(",",$agents).'}';
		//$geom=json_encode($geom);
		$sql="UPDATE units SET code=:code,tid=:tid,agents=:agents,geom=:geom,status=:status WHERE uid=:uid";
		$strings= Array(
			Array('token'=>':code','value'=>$code),
			Array('token'=>':tid','value'=>$tid),
			Array('token'=>':agents','value'=>$agents),
			Array('token'=>':geom','value'=>$geom),
			Array('token'=>':uid','value'=>$uid),
			Array('token'=>':status','value'=>$status)

		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Edit a level
	public function editlevel($lid,$zid,$area,$status,$occupancy){
		return null;
		$sql="UPDATE levels SET area=:area,zid=:zid,status=:status,occupancy=:occupancy WHERE lid=:lid";
		$strings= Array(
			Array('token'=>':area','value'=>$area),
			Array('token'=>':zid','value'=>$zid),
			Array('token'=>':lid','value'=>$lid),
			Array('token'=>':status','value'=>$status),
			Array('token'=>':occupancy','value'=>$occupancy)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}

	//Edit a property
	public function editprop($pid,$address,$sid,$footfall,$agents){
		return null;
		$agents='{'.implode(",",$agents).'}';
		$sql="UPDATE properties SET address=:address,sid=:sid,footfall=:footfall,agents=:aid WHERE pid=:pid";
		$strings= Array(
			Array('token'=>':pid','value'=>$pid),
			Array('token'=>':address','value'=>$address),
			Array('token'=>':sid','value'=>$sid),
			Array('token'=>':footfall','value'=>$footfall),
			Array('token'=>':aid','value'=>$agents)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Edit a agent
	public function editagent($aid,$agency,$address1,$address2,$address3,$email,$telephone,$about){
		return null;
		$sql="UPDATE agents SET agency=:agency,address1=:address_a,address2=:address_b,address3=:address_c,email=:email,telephone=:telephone,about=:about WHERE aid=:aid";
		$strings= Array(
			Array('token'=>':agency','value'=>$agency),
			Array('token'=>':address_a','value'=>$address1),
			Array('token'=>':address_b','value'=>$address2),
			Array('token'=>':address_c','value'=>$address3),
			Array('token'=>':email','value'=>$email),
			Array('token'=>':telephone','value'=>$telephone),
			Array('token'=>':about','value'=>$about),
			Array('token'=>':aid','value'=>$aid)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response[0];
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
	//Edit a tenant

	public function edittenant($tid,$url,$about,$usage,$subusage,$zid,$refine,$tenant){
		return null;
		$sql="UPDATE tenants SET url=:url,about=:about,usage=:usage,subusage=:subusage,zid=:zid,refine=:refine,tenant=:tenant WHERE tid=:tid";
		$strings= Array(
			Array('token'=>':tid','value'=>$tid),
			Array('token'=>':url','value'=>$url),
			Array('token'=>':about','value'=>$about),
			Array('token'=>':usage','value'=>$usage),
			Array('token'=>':subusage','value'=>$subusage),
			Array('token'=>':zid','value'=>$zid),
			Array('token'=>':refine','value'=>$refine),
			Array('token'=>':tenant','value'=>$tenant)
		);
		$response=$this->dbase->query($sql,$strings);
		if(!isset($response->fail)||!$response->fail){
			$response=$response->fetchAll(PDO::FETCH_ASSOC);
			return $response;
		}else{
			http_response_code(412);
			return $response->message;
		}
	}
}

?>
