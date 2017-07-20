//lkcity.controller("common", function($scope,$http,$q,$timeout,olData) {
lkcity.controller("common", function($scope,$http,$q,$timeout,$filter) {
	$scope.m={};
	$scope.Math = window.Math;
	$scope.video='https://vimeo.com/88449889';
		
	$scope.filter={};
	$scope.filter.active={};
	$scope.filter.temp={}
	//$scope.filter.active.level=null;
	//$scope.filter.active.units=false;
	//$scope.filter.active.userunits=false;
	
	$scope.active={};
	$scope.active.placeholder={};	
	$scope.active.unitstate=false;
	$scope.active.userunitstate=false;
	$scope.active.chosen=new Array();	

	$scope.ui={};
	$scope.ui.topmen={};
	$scope.ui.left={};
	$scope.ui.topmen.state='closed';
	$scope.ui.left.top=0;

	
	$scope.view={}
	$scope.view.mode='normal';
	$scope.view.dev=false;
	
	$scope.select=new Array();
	
	$scope.context={};
	$scope.context.bookmark=new Array();
	$scope.context.chapter='map';
	$scope.context.verse='property';

	$scope.pegstate={}
	$('.pegwrap').each(function(){
		var peg=$(this).attr('class').replace('pegwrap','').trim();
		$scope.pegstate[peg]={};
		$scope.pegstate[peg].active={};
		$scope.pegstate[peg].chosen=new Array();
	})
	$scope.pegstate.details.active.allunits={}
	$scope.pegstate.details.active.allunits.json=new Array();
	$scope.pegstate.street.active.allunits={};
	$scope.pegstate.street.active.allunits.json=new Array();
	$scope.pegstate.level.active.allunits={};
	$scope.pegstate.level.active.allunits.json=new Array();
	$scope.setdims=function(){	
		$scope.dims=new Array();
		$scope.dims.height=$(window).height();
		$scope.dims.width=$(window).width();
		$scope.dims.menheight=$('#top').outerHeight();
		$scope.dims.men2height=$('#topsub').outerHeight();
		
		$scope.dims.pegwidth=$('#pegs').outerWidth();
		$scope.dims.mapheight=$scope.dims.height;
		$scope.dims.panewidth=350;
		$scope.dims.mapwidth=$scope.dims.width-$scope.dims.panewidth;
			
		$scope.ui.topmen.top=$scope.dims.menheight*-1;
		$scope.ui.titletop=$scope.dims.men2height
	}
	$scope.$watch(
		function(){
			return $('.title').height();
		},
		function (newValue, oldValue) {
			if (newValue !== oldValue) {
			$('.binner').css({'paddingTop':$('.title').outerHeight()+$scope.dims.men2height+10})
		}
	});
	$scope.setdims();
	$(window).resize(function(){
		$scope.$apply(function(){
			$scope.setdims();
		})
	})
	

	$scope.occupy=new Array();
	$scope.occupy.status=new Array();
	$scope.occupy.occupancy=new Array();
	$scope.keys=new Array();
	$scope.keys.tzoning={};
	
	$scope.occupy.status=[
		{
			'key':0,
			'value':'occupied',
			//'color':'grey'
			'color':'#FF9111'
		},
		{
			'key':1,
			'value':'vacant',
			//'color':'#4FFF8C'
			'color':'#FF9111'
		},
		{
			'key':2,
			'value':'derelict',
			//'color':'#F4824D'
			'color':'#FF9111'
		},
		{
			'key':3,
			'value':'strategic',
			'color':'#FF9111'
		}
	]
	
	$scope.occupy.occupancy=[
		{'key':0,'value':'Tenant'},
		{'key':1,'value':'Owner Occupied'},
		{'key':2,'value':'To Let'},
		{'key':3,'value':'For Sale'}
	]

	$scope.keys.zoning=clasify();


	
	$scope.functions={};
	
	$scope.data={};
	$scope.data.fetch={};
	$scope.data.unitstack={};
	


	$scope.functions.makestyle=function(type,id,val){
		$scope.style[type][id]=new ol.style.Style({
			fill:new ol.style.Fill({
				color: val
			}),
			stroke:new ol.style.Stroke({
				color: 'black',
				width: 1
			})
						
		})
	}

	$scope.functions.draw=function(type){
		var mapedit={};		
		$scope.type=type;
		if($scope.type == 'addunit' || $scope.type == 'editunit'){
			var dtype = 'Point';
		}else{
			var dtype = 'Polygon';
		}
		mapedit.laysource = new ol.source.Vector();
		mapedit.vectorlay = new ol.layer.Vector({
			source: mapedit.laysource,
			style: new ol.style.Style({
				fill: new ol.style.Fill({
				color: 'red'
				}),
				stroke: new ol.style.Stroke({
					color: '#ffcc33',
					width: 2
				}),
				image: new ol.style.Circle({
					radius: 7,
					fill: new ol.style.Fill({
						color: '#ffcc33'
					})
				})
			})
		});
		mapedit.draw = new ol.interaction.Draw({
			source: mapedit.laysource,
			type: /** @type {ol.geom.GeometryType} */ (dtype),
			layer:mapedit.vectorlay
		});
		mapedit.draw.on('drawend', function(){
			$timeout(function(){
				var geom=mapedit.vectorlay.getSource().getFeatures()[0].getGeometry().getCoordinates();
				geom=ol.proj.transform(geom,'EPSG:3857','EPSG:4326')
				if($scope.type=='addproperty' || $scope.type=='editproperty'){
					geom = new ol.geom.Polygon(geom).transform('EPSG:3857','EPSG:4326').getCoordinates()
				}
				if($scope.type=='editunit'){
					$scope.active.unit.geom=geom;
					data={'uid':$scope.active.unit.uid,'geom':geom};
					$scope.functions.changeitem(data);
				}else if($scope.type=='addunit'){
					if(!$scope.active.unit){
						$scope.active.unit={};
					}
					$scope.active.unit.geom=geom;
				}else if($scope.type=='editproperty'){					
					data={'pid':$scope.active.property.pid,'geom':geom};
					$scope.functions.changeitem(data);
				}else if($scope.type=='addproperty'){
					$scope.filter.temp.geom=geom;
				}

				$scope.m.map.removeLayer(mapedit.vectorlay);
				$scope.m.map.removeInteraction(mapedit.draw)
			},1)
		})
		
		$scope.m.map.addLayer(mapedit.vectorlay);
		$scope.m.map.addInteraction(mapedit.draw);
	}	
	
	$scope.submit=function(data){
		return $q(function(resolve, reject) {
			var request=(JSON.stringify(data));
			$http.post('/php/dbactions.php', request).success(function(data, status, headers, config) {
				resolve(data);
			}).error(function(data, status, headers, config) {
				//reject(data)
				console.log(data);
			});
		})
	}

/*----------------Database getters, setters and changers------------------------------*/
//Data
	$scope.data.fetch.city=function(){
		var city=$scope.submit({'getdata':'city'})
		city.then(function(data){
			$scope.data.city=data;
		})
	}
	$scope.data.fetch.city();
	$scope.data.fetch.street=function(sid){
		var street=$scope.submit({'getdata':'street','sid':sid})
		street.then(function(data){
			$scope.data.street=data;
		})
	}
//Getters
	
	var levels=$scope.submit({'command':'getlevelskey'});
	levels.then(function(data){
		$scope.filter.levels=data;
	})

	var streets=$scope.submit({'command':'getstreets'});
	streets.then(function(data){
		$scope.streets=data;	
	})
/*
	var footfall=$scope.submit({'command':'getffall'});
	footfall.then(function(data){
		//$scope.ffall=data;
	})
	
	* */
	var getagents=$scope.submit({'command':'getagents'});
	getagents.then(function(data){
		//leave as object for easy key referencing purposes
		$scope.agents=data;
		//console.log($scope.agents);
		//put into array for select sorting purposes (orderby filter needs an array, but js cannot do non sequential array keys)
		$scope.agentselect=new Array();
		var x=0;
		for(k in $scope.agents){
			$scope.agentselect[x]=$scope.agents[k];
			x++;
		}
	})

	$scope.functions.getlevel=function(lid){		
		var getlevel=$scope.submit({'command':'getlevel','lid':lid});
		getlevel.then(function(data){
			$scope.active.level=data;
			console.log($scope.active.level)
		})
		$scope.functions.getunits(lid)
	}
	$scope.functions.gettenant=function(tid){
		var gettenant=$scope.submit({'command':'gettenant','tid':tid});
		gettenant.then(function(data){
			$scope.active.tenant=data[0];
			if($scope.context.chapter=='tenant'){
				$scope.pegstate.tenant.active.zoning=$scope.active.tenant.zid;
				$scope.pegstate.tenant.active.usage=$scope.active.tenant.usage;
				$scope.pegstate.tenant.active.subusage=$scope.active.tenant.subusage;
				$scope.pegstate.tenant.active.refine=$scope.active.tenant.refine;
				$scope.filter.active=$scope.pegstate.tenant.active;
				$scope.functions.setcontext();
			}
		})
	}
	$scope.functions.gettenants=function(){
		var gettenants=$scope.submit({'command':'gettenants'});
		gettenants.then(function(data){
			$scope.filter.tenants=data;
			$scope.keys.tenants={}
			for(x in data){
				$scope.keys.tenants[data[x].tid]={'tenant':data[x].tenant}
			}
		})		
	}
	$scope.functions.gettenants();
	$scope.functions.gettenantadd=function(tid){
		var gettenantadd=$scope.submit({'command':'gettenantadd','tid':tid});
		gettenantadd.then(function(data){
			$scope.active.tenantadd=data;
		})
	}
	$scope.geojson = new ol.format.GeoJSON();	
	$scope.functions.getprops=function(){
		var sdata={};
		for(x in $scope.filter.active){
			sdata[x]=$scope.filter.active[x];
		}
		sdata.command='getprops';
		var properties=$scope.submit(sdata);
		properties.then(function(data){			
			$scope.active.shapes=[];
			$scope.active.shapes=data;

			//var featurecollection={};
			//featurecollection.type='FeatureCollection'
			//featurecollection.features=data;
			//$scope.active.shapes=$scope.geojson.readFeaturesFromObject(featurecollection);
		})		
	}
	//$scope.functions.getprops();
	$scope.functions.getlevels=function(pid){
		var getlevels=$scope.submit({'command':'getlevels','pid':pid});
		getlevels.then(function(data){
			$scope.active.levels=data;
			//$scope.active.level=null;
		})
	}
	function togeojson(data){
		$scope.active.allunits=[];
		$scope.active.allunits.json=[];

		for(x in data){					
			if(data[x].geom !='null'){
				$scope.active.allunits.json.push({
					"type":"Feature",
					"id":data[x].uid,
					"properties":{
						"tenant":data[x].tenant,
						"tid":data[x].tid,
						"code":data[x].code,
						"lid":data[x].lid,
						"level":data[x].level,
						"address":data[x].address,
						"sid":data[x].sid,
						"zid":data[x].zid,
						"usage":data[x].usage,
						"subusage":data[x].subusage,
						"refine":data[x].refine,
						"uid":data[x].uid,
						"pid":data[x].pid,
						"status":data[x].status
					},
					"geometry":{
						"type":"Point",
						"coordinates":ol.proj.transform(JSON.parse(data[x].geom), "EPSG:4326","EPSG:3857")
						//"coordinates":JSON.parse(data[x].geom)
					}                
				})
			}					
		}
		return $scope.active.allunits;				
	}
	$scope.functions.getallunits=function(level){
			if($scope.filter.active.status==null || $scope.filter.active.status==0){
				var getallunits=$scope.submit({
					'command':'getallunits',
					'level':level,
					'zid':$scope.filter.active.zoning,
					'usage':$scope.filter.active.usage,
					'subusage':$scope.filter.active.subusage,
					'refine':$scope.filter.active.refine,
					'status':$scope.filter.active.status,
					'sid':$scope.filter.active.street
				});
			}else{
				var getallunits=$scope.submit({
					'command':'getalleunits',
					'level':level,
					'zid':$scope.filter.active.zoning,
					'status':$scope.filter.active.status,
					'sid':$scope.filter.active.street
				});
			}
 
	
		
			getallunits.then(function(data){
				for(x in $scope.pegstate){
					if(x == $scope.context.chapter){
						$scope.pegstate[x].active.allunits=togeojson(data);
					}
				}
				//$scope.pegstate[$scope.context.chapter].active.allunits=$scope.active.allunits;
				$scope.functions.getstack();
				for (x in $scope.keys.zoning){
					var zid =$scope.keys.zoning[x].zid
					if(typeof $scope.keys.tzoning[zid]!='undefined'){
						$scope.keys.tzoning[zid].value=$scope.keys.zoning[x].value;
						var usagearray=$scope.keys.zoning[x].usage;
						for(y in usagearray){
							var usage=usagearray[y].usage;
							if(typeof $scope.keys.tzoning[zid].usage[usage]!='undefined'){
								
								$scope.keys.tzoning[zid].usage[usage].value=usagearray[y].value;
								var subusagearray=usagearray[y].subusage;
								for(z in subusagearray){
									var subusage=subusagearray[z].subusage;
									if(typeof $scope.keys.tzoning[zid].usage[usage].subusage[subusage]!='undefined'){
										$scope.keys.tzoning[zid].usage[usage].subusage[subusage].value=subusagearray[z].value;
										var refinearray=subusagearray[z].refine
										for (a in refinearray){
											var refine=refinearray[a].refine
											if(typeof $scope.keys.tzoning[zid].usage[usage].subusage[subusage].refine[refine]!='undefined'){
												$scope.keys.tzoning[zid].usage[usage].subusage[subusage].refine[refine].value=refinearray[a].value;
											}
										}
									}									
								}								
							}
						}
					}										
				}
			})
	}
	$scope.functions.getunits=function(lid){
		var getunits=$scope.submit({'command':'getunits','lid':lid});
		getunits.then(function(data){
			$scope.active.units=data;
			if($scope.context.chapter=='level'){
				$scope.pegstate.level.active.allunits=togeojson(data);
			}
		})
	}
	$scope.functions.getpunits=function(pid){
		var getpunits=$scope.submit({'command':'getpunits','pid':pid});
		getpunits.then(function(data){
			$scope.active.property.units=data;
			if($scope.context.chapter=='details'){
				$scope.pegstate.details.active.allunits=togeojson(data);
			}
		})
	}
	$scope.functions.getunit=function(uid){
		var getunit=$scope.submit({'command':'getunit','uid':uid});
		getunit.then(function(data){
			$scope.active.unit=data[0];
			$scope.active.unit.uid=uid;

			if($scope.context.chapter=='unit'){
				$scope.pegstate.unit.active.zoning=$scope.active.unit.zid;
				$scope.pegstate.unit.active.usage=$scope.active.unit.usage;
				$scope.filter.active=$scope.pegstate.unit.active;
				
			}
		})

	}
	$scope.functions.getproperty=function(pid){
		var getproperty=$scope.submit({'command':'getproperty','pid':pid});
		
		getproperty.then(function(data){
			$scope.active.property=data;
			$scope.functions.getpunits(pid);
			$scope.active.placeholder.pid=data.pid;
			$scope.active.placeholder.sid=data.sid;
			$scope.active.placeholder.address=data.address;

		})
		
	}
	$scope.functions.getagent=function(aid){
		var getagent=$scope.submit({'command':'getagent','aid':aid});
		getagent.then(function(data){
			$scope.active.agent=data;
		})
		
	}
	$scope.functions.getpropbyagent=function(aid){
		var getpropbyagent=$scope.submit({'command':'getpropbyagent','aid':aid});
		getpropbyagent.then(function(data){
			$scope.active.getpropbyagent=data;
		})
		
	}

//Changers
	$scope.functions.changeitem=function(data){
		var value={};
		value.command='upditem';
		if(data.zid){
			value.table='levels';
			value.column='zid';
			value.key='lid';
			value.keyval=data.lid;
			value.colval=data.zid;
		}else if(data.geom && data.pid){
			value.table='properties';
			value.column='geom';
			value.key='pid';
			value.keyval=data.pid;
			value.colval=data.geom;		
		}else if(data.geom && data.uid){
			value.table='units';
			value.column='geom';
			value.key='uid';
			value.keyval=data.uid;
			value.colval=data.geom;		
		}else{
			alert('not set in changeitem()');
			return
		}
		var changeitem=$scope.submit(value);
		changeitem.then(function(data){
			if($scope.context.chapter=='details'){				
				$scope.functions.getlevels($scope.active.property.pid);
				$scope.functions.getprops();
			}
			if(data.geom && data.pid){
				$scope.functions.getprops();
			}
			if(data.geom && data.uid){
				$scope.functions.getallunits($scope.filter.active.level);
			}
		})
	}
	$scope.functions.delrow=function(data){
		data.command='delrow';
		if(data.table == 'levels'){
			data.key='lid';
		}else{
			alert('not set in delrow()');
			return
		}
		var delrow=$scope.submit(data);
		delrow.then(function(data){
			if(data[0] == 'levels' && $scope.context.chapter=='details'){								
				$scope.functions.getlevels($scope.active.property.pid);
				$scope.functions.getprops();
			}
		})
	}
	$scope.functions.delunit=function(uid){
		var data={};
		data.command='delunit';
		data.uid=uid;

		var delunit=$scope.submit(data);
		delunit.then(function(data){

		})
	}
	$scope.functions.deltenant=function(tid){
		var data={};
		data.command='deltenant';
		data.tid=tid;

		var deltenant=$scope.submit(data);
		deltenant.then(function(data){
			$scope.functions.gettenants();
		})
	}
	$scope.functions.dellevel=function(data){
		$scope.functions.delrow({'table':'levels','keyval':data[data.length-1].lid});
	}
	$scope.functions.delproperty=function(pid){
		data={}
		data.command='delproperty';
		data.pid=pid
		data.lid=[];
		for(x in $scope.active.levels){
			data.lid.push($scope.active.levels[x].lid)
		}
		var delproperty=$scope.submit(data);
		delproperty.then(function(data){
			$scope.functions.getprops();
		})
	}
	$scope.functions.editlevel=function(data){
		data.command='editlevel';
		//console.log($scope.layers.properties.getSource().getFeatureById(data.pid).getGeometry().getArea())
		//console.log($scope.layers.properties.getSource().getFeatureById(data.pid).getGeometry().transform('EPSG:3857','EPSG:4326').getArea())
		var editlevel=$scope.submit(data);
		editlevel.then(function(data){
			$scope.functions.getprops();
			$scope.context.chapter='details';
		})
	}
	$scope.functions.editprop=function(data){
		data.command='editprop';
		var editprop=$scope.submit(data);
		editprop.then(function(data){
			$scope.functions.getprops();
			$scope.functions.getproperty($scope.context.bookmark.pid);
			$scope.context.chapter='details';
		})		
	}


	$scope.editagent=function(data){
		data.command='editagent';
		var editagent=$scope.submit(data);
		editagent.then(function(data){
			$scope.context.chapter='agent';
		})
	}
	$scope.functions.editunit=function(data){
		data.command='editunit';
		console.log(data);
		var editunit=$scope.submit(data);
		editunit.then(function(data){			
			$scope.context.chapter='level';
			//$scope.functions.getunits($scope.active.levels[$scope.active.level].lid);			
		})
	}
	$scope.functions.edittenant=function(data){
		data.command='edittenant';
		for(x in data){
			if(data[x]=='null'){
				data[x]=null;
			}
		}
		var edittenant=$scope.submit(data);
		edittenant.then(function(data){	
			if($scope.context.verse=='tenant' && $scope.context.chapter=='edit'){
				$scope.active.tenant=null;
			}else{
				$scope.context.chapter='level'
			}
			$scope.functions.gettenants();			
		})
	}
//Setters
	$scope.functions.addlevel=function(){
		var addlevel=$scope.submit({'command':'addlevel','pid':$scope.active.property.pid});
		addlevel.then(function(data){
			$scope.functions.getlevels($scope.active.property.pid);			
		})
	}
	$scope.functions.addunit=function(data){
		data.lid=$scope.active.level.lid;
		data.command='addunit';
		var addunit=$scope.submit(data);
		addunit.then(function(data){			
			$scope.context.chapter='level';
			$scope.functions.getunits($scope.active.level.lid);
			$scope.functions.getallunits($scope.filter.active.level);			
		})
	}

//User Interface
	$scope.functions.mentoggle=function(){
		if($scope.ui.topmen.state=='closed'){
			$scope.ui.topmen.state='open';
			$scope.dims.mapheight=$scope.dims.height-$scope.dims.menheight;
			$scope.ui.topmen.top=0;
			$scope.ui.topoffset=$scope.dims.menheight;
			$scope.ui.left.top=$scope.dims.menheight;
			$scope.ui.titletop=$scope.dims.men2height+$scope.dims.menheight;		
		}else{
			$scope.ui.topmen.state='closed';
			$scope.dims.mapheight=$scope.dims.height;
			$scope.ui.topmen.top=$scope.dims.menheight*-1;
			$scope.ui.topoffset=0;
			$scope.ui.left.top=0;
			$scope.ui.titletop=$scope.dims.men2height	
		}
		$scope.m.map.setSize( [$scope.dims.mapwidth, $scope.dims.mapheight]);
	}
	$scope.functions.streetview=function(){
		window.open($scope.m.streetview);
		return false;		
	}

})





