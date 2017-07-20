


//lkcity.controller("mapview", ['$scope','$http','$timeout','getByPropertyFilter','olData', function($scope,$http,$timeout,getByPropertyFilter,olData) {
lkcity.controller("mapview", ['$scope','$http','$timeout','$filter','getByPropertyFilter', function($scope,$http,$timeout,$filter,getByPropertyFilter) {
		
	
	
//************************* Create Map, Layers and Styles ***************************************


	$scope.m.map = new ol.Map({
		target: 'map',
		
		layers: [
			new ol.layer.Tile({
				//source: new ol.source.Stamen({layer: 'toner-lite'})
				//source: new ol.source.MapQuest({layer: 'osm'})
				//source: new ol.source.OSM()
				/*	
				source: new ol.source.XYZ({
					url: 'http://api.tiles.mapbox.com/v4/michaeljonker.le2m68eo/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWljaGFlbGpvbmtlciIsImEiOiJHaEMtMWI4In0.Ato-3vh5AL49RQr3HKY97g'
				})

				* */	
				source: new ol.source.XYZ({
					url: 'http://api.tiles.mapbox.com/v4/michaeljonker.le2nc7ip/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWljaGFlbGpvbmtlciIsImEiOiJHaEMtMWI4In0.Ato-3vh5AL49RQr3HKY97g'
				})
				
						
				/*
				source: new ol.source.XYZ({
					url: 'http://api.tiles.mapbox.com/v4/michaeljonker.le2o2p5i/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWljaGFlbGpvbmtlciIsImEiOiJHaEMtMWI4In0.Ato-3vh5AL49RQr3HKY97g'
				})
				* */
			})
		],
		view: new ol.View({
			center: ol.proj.transform([-8.626756,52.664097], 'EPSG:4326', 'EPSG:3857'),
			zoom: 16,
			minZoom: 14,
			maxZoom: 21
		}),
		events: {
			layers: [ 'mousemove', 'click' ]
		},
		projection: 'EPSG:4326'
	});
	$scope.m.map.setSize( [$scope.dims.mapwidth, $scope.dims.mapheight]);		
		
	var layers={};
	var sources={};
	var style={};
	var styleCache = {};

	layers.chosen=new ol.layer.Vector({
		id:'chosen',
		name:'chosen',
		title:'chosen',
		source: sources.chosen
	});
	$scope.m.map.addLayer(layers.chosen);
	
	layers.properties=new ol.layer.Vector({
		id:'properties',
		name:'properties',
		title:'properties',
		source: sources.properties
	});
	$scope.m.map.addLayer(layers.properties);
	
	
	layers.units=new ol.layer.Vector({
		id:'units',
		name:'units',
		title:'units',
		source: sources.units
	});
	$scope.m.map.addLayer(layers.units);
	
	function layertop(state){
		var layerlen=$scope.m.map.getLayers().getArray().length;
		if(state!='units'){
			$scope.m.map.getLayers().setAt(layerlen-3, layers.properties)
			$scope.m.map.getLayers().setAt(layerlen-2, layers.chosen)
			$scope.m.map.getLayers().setAt(layerlen-1, layers.units)
		}else{
			$scope.m.map.getLayers().setAt(layerlen-3, layers.properties)
			$scope.m.map.getLayers().setAt(layerlen-2, layers.units)
			$scope.m.map.getLayers().setAt(layerlen-1, layers.chosen)			
		}
		
	}
	layertop('chosen');
	
	$scope.stylezones=function(){
		styleCache.start = {};
		style.start=function(feature, resolution) {
			if(resolution < .4){
				var text=feature.getProperties().address;
			}else{
				var text='';
			}
			var zid=feature.getProperties().zid;
			var sid=feature.getProperties().sid;
			var status=feature.getProperties().status;
			var stroke={};
			stroke.color='#229785'
			stroke.width=1;	
			if(
				$scope.filter.active.status == status && 
				($scope.filter.active.zoning==null||$scope.filter.active.zoning==zid) && 
				($scope.filter.active.street==null||$scope.filter.active.street==sid) &&
				($scope.context.chapter=='map' || $scope.context.chapter=='street')
			){
				var color=$scope.occupy.status[status].color;	
				stroke.color='#101517'
				stroke.width=1;
				
			}else if(
				$scope.filter.active.zoning!=null &&
				($scope.context.chapter=='map' || $scope.context.chapter=='street')
			){
				if(!$scope.filter.active.street){
					if($scope.filter.active.zoning==zid){								
						var color=$filter('getkeyvalue')($scope.keys.zoning,'color',feature.getProperties().zid);
						stroke.color='#101517';	
						stroke.width=1;										
					}else{
						var color='#EEEEEE'
						$scope.focusprops=null;	
					}
				}else{
					if($scope.filter.active.zoning==zid && $scope.filter.active.street==sid){								
						var color=$filter('getkeyvalue')($scope.keys.zoning,'color',feature.getProperties().zid);
						stroke.color='#101517';

					}else if($scope.filter.active.street==sid){
						//var color='rgba(117,255,88,.9)';
						var color='#EEEEEE';
						stroke.color='#101517';
						stroke.width=1.5;
					}else{
						var color='#EEEEEE';						
					}					
				}				
			}else{
				if($scope.context.chapter=='unitstack'){
					
					if($scope.filter.active.street!=null && $scope.filter.active.street==sid && sid!=null){
						var color='rgba(117,255,88,.9)';
					}else if($scope.filter.active.street!=null){
						var color='#EEEEEE';

					}else{
						var color='rgba(117,255,88,.9)';
					}

				}else if($scope.context.chapter=='map'){
					if($scope.filter.active.status==null && $scope.filter.active.street==null){
						var color=$filter('getkeyvalue')($scope.keys.zoning,'color',zid);
						stroke.color='#101517'
					}else{
						if($scope.filter.active.street==zid){
							var color=$filter('getkeyvalue')($scope.keys.zoning,'color',zid);
						}else{
							var color='#EEEEEE';
						}
					}
				}else if($scope.context.chapter=='street'){
					if($scope.filter.active.status==null && $scope.filter.active.street==null){
						var color='#EEEEEE';

					}else if($scope.filter.active.street!=null && $scope.filter.active.street==sid){
						if($scope.filter.active.status==null){
							var color=$filter('getkeyvalue')($scope.keys.zoning,'color',zid);
							stroke.color='#101517'
						}else{
							var color='#EEEEEE';
							stroke.color='#101517';
							stroke.width=2;
						}
					}else{
						var color='#EEEEEE';
					}				
				}else{
					var color='rgba(117,255,88,.9)';
				}		
			}

			if (!styleCache.start[text+zid+sid+status]) {
				styleCache.start[text+zid+sid+status] = [new ol.style.Style({
					fill: new ol.style.Fill({
						//color: 'rgba(166,70,106,.9)'
						color:color
					}),
					stroke: new ol.style.Stroke({
						color: stroke.color,
						width: stroke.width
					}),
					text: new ol.style.Text({
						font: '12px Calibri,sans-serif',
						text: text,
						fill: new ol.style.Fill({
							color: '#101517'
						}),
					})
				})]
			}
			if(resolution < 5){
				return styleCache.start[text+zid+sid+status];
			}
		}
		
		layers.properties.setStyle(style.start);
		
	}
	
	$scope.stylezones();
			

	$scope.styleunits=function(){
		styleCache.units = {};
		style.units=function(feature, resolution) {
			var size = feature.get('features').length;
			var balloon=30;
			if(size < 60){
				var balloon=size/3;
			} 
			if(size < 50){
				var balloon=size/2.5;
			}
			if(size < 40){
				var balloon=size/2;
			}
			if(size < 30){
				var balloon=size/1.5;
			}
			if(size < 20){
				var balloon=size;
			}
			var style = styleCache.units[size];
			if (!style) {
			  style = [new ol.style.Style({
				image: new ol.style.Circle({
				  radius: 10+balloon,
				  stroke: new ol.style.Stroke({
					color: '#fff'
				  }),
				  fill: new ol.style.Fill({
					color: 'rgba(255,145,17,.8)'
				  })
				}),
				text: new ol.style.Text({
					font: 'bold 12px Calibri,sans-serif',
					text: size.toString(),
					fill: new ol.style.Fill({
					color: '#fff'
				  })
				})
			  })];
			  styleCache.units[size] = style;
			}
			return style;
		}
		layers.units.setStyle(style.units);
	}
	$scope.styleunits();

	style.hover= new ol.style.Style({
		fill:new ol.style.Fill({
			color: '#FF3D7D'
		}),
		stroke:new ol.style.Stroke({
			color: 'white',
			width: 3
		})
	})
	style.chosen= new ol.style.Style({
		fill:new ol.style.Fill({
			color: '#101517'
		}),
		/*
		stroke:new ol.style.Stroke({
			color: 'white',
			width: 3
		})
		* */
	})
	layers.chosen.setStyle(style.chosen);
	
	style.selected= new ol.style.Style({
		fill:new ol.style.Fill({
			color: '#FF3D7D'
		}),
		/*
		stroke:new ol.style.Stroke({
			color: 'white',
			width: 3
		})
		* */
	})
	var shapes={
		'type':'FeatureCollection',
		'features':[]
	}
	var points={
		'type':'FeatureCollection',
		'features':[]
	}
	var chosen={
		'type':'FeatureCollection',
		'features':[]
	}	
	
	
//************************* Watchers ***************************************
	$scope.$watch('active.chosen',function(){
		
		if(typeof $scope.active.chosen !='undefined'){
			
			chosen.features=$scope.active.chosen;
			sources.chosen=new ol.source.GeoJSON(
				({
					object:chosen,
					//projection: 'EPSG:3857'
				})
			)
			layers.chosen.setSource(sources.chosen);
		}				
	},true)
	
		
	$scope.$watch('active.shapes',function(){
					
		if(typeof $scope.active.shapes !='undefined'){
			shapes.features=$scope.active.shapes;
			sources.properties=new ol.source.GeoJSON(
				({
					object:shapes,
					projection: 'EPSG:3857'
				})
			)
			layers.properties.setSource(sources.properties);
		}				
	})
	var clusterSource
	$scope.$watch('active.allunits.json', function() {
		if(typeof $scope.active.allunits != 'undefined'){
			points.features=$scope.active.allunits.json;				
			sources.units=new ol.source.GeoJSON(
				({
					object:points,
				})
			)
			clusterSource = new ol.source.Cluster({
			  distance:30,
			  source: sources.units
			});
			layers.units.setSource(clusterSource);
		}
	})
	$scope.$watch('active.property.pid',function(){
		if(layers.properties.getSource()!=null){
			$scope.pegstate.details.chosen=[];
			var feature=layers.properties.getSource().getFeatureById($scope.active.property.pid);
			$scope.active.chosen=$scope.functions.addchosen(feature);
		}
	})
	$scope.$watch('active.level.pid',function(){
		console.log($scope.active.level);
		if(layers.properties.getSource()!=null){
			$scope.pegstate.level.chosen=[];
			var feature=layers.properties.getSource().getFeatureById($scope.active.level.pid);
			$scope.active.chosen=$scope.functions.addchosen(feature);
			$timeout(function(){
				$scope.functions.zoomfocus();
			},1);
		}
	})
	$scope.$watch('active.tenantadd',function(){
		var source=layers.properties.getSource();
		$scope.pegstate[$scope.context.chapter].chosen=[];
		for (x in $scope.active.tenantadd){
			var pid=$scope.active.tenantadd[x].pid;
			$scope.functions.addchosen(source.getFeatureById(pid));
		}
		$scope.active.chosen=$scope.pegstate[$scope.context.chapter].chosen;
		$timeout(function(){
			$scope.functions.zoomfocus();
		},1);
	})
	$scope.$watch('active.unit',function(){
		if(typeof $scope.active.unit!='undefined' && $scope.active.unit.pid){
			var source=layers.properties.getSource();
			$scope.pegstate[$scope.context.chapter].chosen=[];
			var pid=$scope.active.unit.pid;
			$scope.functions.addchosen(source.getFeatureById(pid));
			$scope.active.chosen=$scope.pegstate[$scope.context.chapter].chosen;
			$timeout(function(){
				$scope.functions.zoomfocus();
			},1);
		}
	})	
	$scope.m.unitonzoom=function(){
		if($scope.m.map.getView().getResolution() < 0.5){
			$scope.active.unitstate=true;
			//layertop('chosen');
		}else{
			//layertop('units');
			if($scope.context.chapter=='map'||$scope.context.chapter=='street'){
				$scope.active.unitstate=$scope.active.userunitstate;
			}
		}		
	}
	$scope.m.map.on('moveend',function(e){
		$scope.m.unitonzoom();
		clearTimeout($scope.stacktimeout);
		$scope.stacktimeout=setTimeout(function(){
			if(layers.units.getSource() && $scope.context.chapter=='unitstack'){
				$scope.functions.getstack();				
			}			
			$scope.$apply();			
		},500)
	})
	
	$scope.functions.setunits=function(x){
		//$scope.active.unitstate=x;
	}
	
	function newstate(){
		
		//$scope.pegstate[$scope.context.chapter]={}
		//$scope.pegstate[$scope.context.chapter].active={}

		if($scope.context.chapter=='street'){			
			$scope.pegstate[$scope.context.chapter].active.street=$scope.filter.active.street
		}else{
			$scope.pegstate[$scope.context.chapter].active.street=null;
		}

		//$scope.filter.active=$scope.pegstate[$scope.context.chapter].active;
	}
	$scope.truth=true;
	$scope.$watch('filter.active', function() {
		if($scope.truth && typeof $scope.pegstate[$scope.context.chapter]!='undefined'){			
			$scope.pegstate[$scope.context.chapter].active=$scope.filter.active;
			//$scope.pegstate.details.active.street=null;
			$scope.truth=true;	
		}else{
			$scope.truth=true;			
		}
	},true)		
	$scope.$watch('context.chapter',function(){
		
		$scope.active.chosen=$scope.pegstate[$scope.context.chapter].chosen;
		if(typeof $scope.pegstate[$scope.context.chapter].active.allunits!='undefined'){
			$scope.active.allunits=$scope.pegstate[$scope.context.chapter].active.allunits;
			//console.log($scope.pegstate[$scope.context.chapter].active.allunits);
		}else{
			$scope.functions.setcontext();
		}
		if($scope.context.chapter=='unitstack'){
			$scope.active.unitstate=true;
			$scope.stylezones()
		}
		if($scope.context.chapter=='map'){
			$scope.active.unitstate=$scope.active.userunitstate;
			$scope.m.unitonzoom();			
			$scope.stylezones();
			$scope.functions.setcontext();
		}
		if($scope.context.chapter=='street'){
			$scope.active.unitstate=$scope.active.userunitstate;		
			$scope.stylezones();
		}
		if($scope.context.chapter=='details'){
			$scope.active.unitstate=true;		
			$scope.stylezones();
		}
		if($scope.context.chapter=='level'){
			$scope.active.unitstate=true;			
			$scope.stylezones();
		}
		if($scope.context.chapter=='unit'){	
			$scope.active.unitstate=true;	
			$scope.stylezones();
		}
		if($scope.context.chapter=='tenant'){
			$scope.active.unitstate=true;		
			$scope.stylezones();
		}
		if($scope.context.chapter=='agent'){		
			$scope.stylezones();
		}
		$scope.truth=false;		
		if(typeof $scope.pegstate[$scope.context.chapter]=='undefined'){
			newstate();
		}
		$scope.filter.active=$scope.pegstate[$scope.context.chapter].active;
		for (x in $scope.pegstate){
			if(x!='street' && x!='unitstack'){
				$scope.pegstate[x].active.street=null;
			}
		}						
	})
	

	$scope.$watch('filter.active.zoning', function() {
		$scope.stylezones();				
	})
	
	$scope.$watch('filter.active.level', function() {
		$scope.functions.getprops();
		if($scope.context.chapter=='map'||$scope.context.chapter=='unitstack'){
			$scope.functions.setcontext();
		}		
	})
	
	
	$scope.$watch('filter.active.street',function(){
		if($scope.filter.active.street!=null){
			$scope.functions.zoomstreet();
			if($scope.context.chapter=='street'){
				$scope.active.street=$scope.filter.active.street;
			}
			$scope.stylezones();
			$scope.functions.setcontext();
					
		}else{
			$scope.pegstate.street.active.allunits.json=new Array();
			if($scope.context.chapter=='unitstack'){
				$scope.functions.setcontext();
			}
			$scope.stylezones();
		}
		
	})
	$scope.$watch('filter.active.status',function(){
			$scope.stylezones();
			$scope.functions.setcontext();			
	})
	
	$scope.$watch('active.unitstate',function(){
		if($scope.active.unitstate){
			if($scope.context.chapter!='details'){
				$scope.functions.setcontext('skip');
			}
		}else if(typeof $scope.active.allunits!='undefined'){
			$scope.active.allunits.json=[];
			$scope.active.unitstack=null;
		}
	})
	




	




//************************* Click Interactions ***************************************

	$scope.m.map.on('click', function (e) {

		if($scope.context.chapter!='editunit' && $scope.context.chapter!='addunit'){
			
			var clicked={};	
			$scope.m.map.forEachFeatureAtPixel(e.pixel, function (feature, layer) {
				
				clicked[layer.get('id')]=feature;
			});
			if(clicked.units){
				
				var clickstack=clicked.units.values_.features;
				if(clickstack.length > 1){
					var coordinates=[];
					for (x in clickstack){
						coordinates.push(clickstack[x].getGeometry().getCoordinates());											
					}
					var extent=ol.extent.createOrUpdateFromCoordinates(coordinates);
					$scope.functions.anizoom(extent);
					$scope.context.chapter='unitstack';
					$scope.functions.getstack();

				}else{
					
					var tid=clickstack[0].getProperties().tid;
					var uid=clickstack[0].getId()
					if((typeof $scope.active.tenant=='undefined' ||  tid!=$scope.active.tenant.tid) && tid!=null){
						$scope.context.chapter='tenant';
						$scope.active.chosen.json=[];
						$scope.functions.gettenant(tid);
						$scope.functions.gettenantadd(tid);
						
						return;
					}else if(tid!=null){
						$scope.$apply(function(){
							$scope.context.chapter='tenant';
						})
						return;
					} 
					
					if(typeof $scope.active.unit=='undefined' ||  uid!=$scope.active.unit.uid){
						$scope.functions.getunit(uid);
						$scope.context.chapter='unit';
					}else{
						$scope.context.chapter='unit';
					}
					
				}
			}else if(clicked.properties){
				
				$scope.$apply(function(){
					$scope.context.chapter="details";
					
				});
				if(typeof $scope.context.oldfeature != 'undefined' && $scope.filter.active.color==null){
					$scope.context.oldfeature.setStyle(null);
				}
				$scope.context.oldfeature=clicked.properties;
				$scope.activefeature=clicked.properties;
				if($scope.filter.active.color==null){
					//clicked.properties.setStyle(style.selected);
				}			
				var id=clicked.properties.getId();
				
				
				if(typeof $scope.active.property=='undefined' || $scope.active.property.pid!=id){					
					$scope.functions.getlevels(id);
					$scope.functions.getproperty(id)
				}
			}else{
				$scope.$apply(function(){
					var clickloc=ol.proj.transform(e.coordinate,'EPSG:3857','EPSG:4326');
					$scope.m.streetview=('http://maps.google.com/maps?q=&layer=c&cbll='+clickloc[1]+','+clickloc[0]+'9&cbp=12,0,0,0,0');
				})
				if($scope.context.chapter=='map'){
					$scope.$apply(function(){
						$scope.pegstate.street.active.state=null;
						$scope.pegstate.street.active.zid=null;
						$scope.pegstate.street.active.street=layers.properties.getSource().getClosestFeatureToCoordinate(e.coordinate).getProperties().sid;						
						$scope.context.chapter='street';
						
					})					
				}else if($scope.context.chapter!='unitstack' && $scope.context.chapter!='street'){
					$scope.$apply(function(){
						$scope.pegstate.unitstack.active.street=layers.properties.getSource().getClosestFeatureToCoordinate(e.coordinate).getProperties().sid;
						$scope.context.chapter='unitstack';
						
					})
				}else if($scope.context.chapter=='unitstack' || $scope.context.chapter=='street'){
					$scope.$apply(function(){
						console.log(layers.properties.getSource())
						$scope.filter.active.street=layers.properties.getSource().getClosestFeatureToCoordinate(e.coordinate).getProperties().sid;
					});
				}
			}
		}			
	})


//************************* Hover Interactions ***************************************
	
	var mappopup={};
	mappopup.element=document.getElementById('popup');
	mappopup.content=document.getElementById('popup_content');
	mappopup.overlay=new ol.Overlay({
		element: mappopup.element
	});
	$scope.m.map.addOverlay(mappopup.overlay);
	
	var delay;
	var message = null;
	var stackedfeature=[];
	var thisfeature=null;
	var oldfeature={};
	var thisfid=null;
	var oldfid=null;
	var thislayer=null;
	var bubble=null;
	$('body').mousemove(function(evt){
		$scope.mouseon=$(evt.target).prop('tagName');
	});
	function clear(){
				$("#map").css({"cursor":"zoom-in"});
				mappopup.element.style.display = 'none';
				if(typeof oldfeature.f !='undefined'){
					oldfeature.f.setStyle(oldfeature.s);
				}
				oldfeature={};
				stackedfeature=[];
				thisfeature=null;
				thislayer=null;
				thisfid=null;
				oldfid=null;		
	}
	$scope.m.map.on('pointermove', function(e) {
		clearTimeout($scope.delay);
		var bubblecount=0;
		$scope.delay=setTimeout(function(){	
			var inscope='out';
			$scope.m.map.forEachFeatureAtPixel(e.pixel, function (feature,layer) {
				inscope='in';
				if(typeof(feature.values_.features)!='undefined' && bubblecount==0){
					bubblecount++;
					bubble=feature;
					stackedfeature=feature.values_.features;
					thisfeature=stackedfeature[0];
					thislayer=layer.get('id')
				}else if(stackedfeature[0]==null){				
					thisfeature=feature;
					thislayer=layer.get('id')
				}
				thisfid=thisfeature.getId();
								
			})
			
			if(inscope=='in'){
				$("#map").css({"cursor":"pointer"});
				if(thisfid!=oldfid){
					mappopup.element.style.display = 'none';
					if(typeof oldfeature.f !='undefined'){
						oldfeature.f.setStyle(oldfeature.s);
					}
					if(thislayer=='properties'){	
						oldfeature.s=thisfeature.getStyle();
						oldfeature.f=thisfeature;
						thisfeature.setStyle(style.selected);
					}
					if(thislayer=='units'){
						var geometry = bubble.getGeometry();
						//console.log(bubble);
						//console.log(geometry);
						var coord = geometry.getCoordinates();
						//var coord=e.coordinate;
						var message="";
						for(x in stackedfeature){
							if(stackedfeature[x].getProperties().tenant!=null){
								var text=stackedfeature[x].getProperties().tenant;
							}else{
								var text=$scope.occupy.status[stackedfeature[x].getProperties().status].value;
							}
							if(stackedfeature.length==1){
								message="<div class='map_olist map_osingle'>"+text+"</div>";
							}else if (x < 5){
								message=message+"<div class='map_olist'>"+text+"</div>"
							}
						}
						if(stackedfeature.length > 5){
							message=message+"<div class='map_olist map_more'> And "+(stackedfeature.length-5)+" more</div>"
						}
							
						mappopup.overlay.setPosition(coord);
						mappopup.content.innerHTML = message;
						mappopup.element.style.display = 'block';					
					}
					
					oldfid=thisfid;
					
				}
				stackedfeature=[];
				if($scope.mouseon != 'CANVAS'){
					clear();
				}
			}else{
				
				clear();
			}
		},10);
	})
	
//************************* Process units in active view for data ***************************************
	
	$scope.functions.getstack=function(){
		//$timeout(function(){
				$scope.m.uextent=ol.extent.createEmpty();
				$scope.data.unitstack.subtotal=0;
				var extent=$scope.m.map.getView().calculateExtent($scope.m.map.getSize())
				$scope.active.unitstack=[];
				var features=$scope.active.allunits.json
				$scope.data.unitstack.total=features.length;
				$scope.data.unitstack.metrics=[];
				var metric={}
				if(features.length > 0){
					
					for (x in features){
						var ex=ol.extent.createOrUpdateFromCoordinate(features[x].geometry.coordinates);
						ol.extent.extend($scope.m.uextent,ex);
						var zid=features[x].properties.zid;
						if(zid==null){
							zid=layers.properties.getSource().getFeatureById(features[x].properties.pid).getProperties().zid;
						}
						var usage=features[x].properties.usage;
						var subusage=features[x].properties.subusage;
						var refine=features[x].properties.refine;
						if(ol.extent.containsCoordinate(extent,features[x].geometry.coordinates)){
							$scope.data.unitstack.subtotal++;
							if(typeof metric[zid] == 'undefined'){
								metric[zid]={'zid':zid,'count':0,'usage':{}}
							}
							if(usage!=null){
								if(typeof metric[zid].usage[usage] == 'undefined'){
									metric[zid].usage[usage]={'usage':usage,'count':0,'subusage':{}}
								}
								if(subusage!=null){
									if(typeof metric[zid].usage[usage].subusage[subusage] == 'undefined'){
										metric[zid].usage[usage].subusage[subusage]={'subusage':subusage,'count':0,'refine':{}}
									}
									if(refine!=null){
										if(typeof metric[zid].usage[usage].subusage[subusage].refine[refine] == 'undefined'){
											metric[zid].usage[usage].subusage[subusage].refine[refine]={'refine':refine,'count':0}																				
										}
										metric[zid].usage[usage].subusage[subusage].refine[refine].count++
									}
									metric[zid].usage[usage].subusage[subusage].count++
								}								
								metric[zid].usage[usage].count++							
							}
							metric[zid].count++

							if($scope.data.unitstack.subtotal < 20){
								$scope.active.unitstack.push(features[x].properties)
							}
													 
						}
					}
					for(x in metric){
						$scope.data.unitstack.metrics.push(metric[x]);
					}
				}
			//},1);		
	}	
	
//************************* Animated Map Movements ***************************************

	
	$scope.functions.zoomextent=function(e1,e2){
		
		if(!e1){
			e1=layers.units.getSource().getExtent();
		}
		if(!e2){
			e2=layers.properties.getSource().getExtent();
		}
		var extent=ol.extent.extend(e1,e2);
		$scope.functions.anizoom(extent);

	}
	$scope.functions.anizoom=function(extent){
		var view=$scope.m.map.getView();
		
		var oldcenter=view.getCenter();
		var center=ol.extent.getCenter(extent);
		var thisres=view.getResolution();
		var view2=new ol.View({
			center: [0, 0],
			zoom: 1
		});
					
		view2.fitExtent(extent,$scope.m.map.getSize())
		var newres=view2.getResolution();

		if(newres < .075){
			newres=.075;
		}
					
		var zoom = ol.animation.zoom({
			duration: 1000,
			resolution:thisres
		});
					
		var pan = ol.animation.pan({
			duration: 1000,
			source:oldcenter
		});
		$scope.m.map.beforeRender(zoom,pan);
		view.setResolution(newres);
		view.setCenter(center);		
	}
	
	$scope.functions.zoomstreet=function(){
		//$scope.functions.setcontext();
		$sextent=ol.extent.createEmpty();
		layers.properties.getSource().forEachFeature(function(feature){
			if(feature.getProperties().sid==$scope.filter.active.street){				
				$sextent=ol.extent.extend($sextent,feature.getGeometry().getExtent())
			}
		})
		var center=ol.extent.getCenter($sextent);
		
		if($.isNumeric(center[0])){
			var view=$scope.m.map.getView();
			var resolution=view.getResolution();
			var pan = ol.animation.pan({
				duration: 2000,			
				source:($scope.m.map.getView().getCenter())
			});
			zoom = ol.animation.zoom({
				duration: 1000,
				resolution:resolution 
			});
			$scope.m.map.beforeRender(zoom,pan);				
			view.setResolution(2);
			view.setCenter(center);
			$timeout(function(){
				zoom = ol.animation.zoom({
					duration: 1000,
					resolution: 2
				});
				$scope.m.map.beforeRender(zoom);
				view.setResolution(.8);
			},1000);
		}		
	}
	$scope.functions.zoomfocus=function(){
		function getpropextent(pid){
			var extent=layers.properties.getSource().getFeatureById(pid).getGeometry().getExtent();
			$scope.functions.anizoom(extent);
		}
		function getunitextent(uid){
			var extent=layers.units.getSource().getFeatureById(uid).getGeometry().getExtent();
			$scope.functions.anizoom(extent);
		}
		function getlayerextent(layer){
			var extent=layers[layer].getSource().getExtent();
			$scope.functions.anizoom(extent);
		}	
		if($scope.context.chapter=='details'){
			var pid=$scope.active.property.pid;
			getpropextent(pid);
		}
		if($scope.context.chapter=='level'){
			$scope.filter.active.level=$scope.active.level.level;
			var pid=$scope.active.level.pid;
			getpropextent(pid);
		}
		if($scope.context.chapter=='unit'){
			$scope.filter.active.level=$scope.active.unit.level;
			var geom=ol.proj.transform(JSON.parse($scope.active.unit.geom),"EPSG:4326","EPSG:3857");
			var extent=ol.extent.createOrUpdateFromCoordinate(geom);
			$scope.functions.anizoom(extent);
		}
		if($scope.context.chapter=='unitstack'){
			
			$scope.functions.anizoom($scope.m.uextent);
		}
		if($scope.context.chapter=='tenant'){
			getlayerextent('chosen');
		}
		if(($scope.context.chapter=='map' || $scope.context.chapter=='street')&&layers.properties.getSource()!=null){
			$scope.m.zextent=ol.extent.createEmpty();
			layers.properties.getSource().forEachFeature(function(feature){
				var props=feature.getProperties();
				if($scope.filter.active.status!=null && $scope.filter.active.street!=null && $scope.filter.active.zoning!=null){
					if(props.status==$scope.filter.active.status && props.sid==$scope.filter.active.street && props.zid==$scope.filter.active.zoning){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());					
					}
				}else if($scope.filter.active.status==null && $scope.filter.active.street==null && $scope.filter.active.zoning==null){
					$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
				}else if($scope.filter.active.street==null && $scope.filter.active.zoning==null){
					if(props.status==$scope.filter.active.status){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
					}					
				}else if($scope.filter.active.status==null && $scope.filter.active.zoning==null){
					if(props.sid==$scope.filter.active.street){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
					}						
				}else if($scope.filter.active.status==null && $scope.filter.active.street==null){
					if(props.zid==$scope.filter.active.zoning){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
					}						
				}else if($scope.filter.active.street==null){
					if(props.zid==$scope.filter.active.zoning && props.status==$scope.filter.active.status){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
					}					
				}else if($scope.filter.active.status==null){
					if(props.zid==$scope.filter.active.zoning && props.sid==$scope.filter.active.street){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());							
					}					
				}else if($scope.filter.active.zoning==null){
					if(props.sid==$scope.filter.active.street && props.status==$scope.filter.active.status){
						$scope.m.zextent=ol.extent.extend($scope.m.zextent,feature.getGeometry().getExtent());						
					}					
				}
			});
			$scope.functions.anizoom($scope.m.zextent);
			
		}
	}
//************************* Helpers ***************************************	
	$scope.functions.addchosen=function(feature){
		if(feature!=null){
			var chosen = {};
			chosen.geometry={};
			chosen.geometry.coordinates=feature.getGeometry().getCoordinates();
			chosen.geometry.type=feature.getGeometry().getType();
			chosen.type='Feature';													
			$scope.pegstate[$scope.context.chapter].chosen.push(chosen);
			return $scope.pegstate[$scope.context.chapter].chosen
		}		
	}
	$scope.functions.setcontext=function(con){
		function process(){
			if($scope.active.unitstate){
				//alert('yep');
				$scope.functions.getallunits($scope.filter.active.level);
			}else{
				//alert('nope');
			}			
		}
		var context=$scope.filter.active;
		//var context={};
		if($scope.filter.active.zoning==null||con=='zid'){
			context.refine=null;
			context.subusage=null;
			context.usage=null;
			$scope.filter.active=context;
			if(con!='skip'){
				//$scope.active.unitstate=$scope.active.userunitstate;
			}
			process();
			return;
		}
		if($scope.filter.active.usage==null||con=='usage'){
			context.refine=null;
			context.subusage=null;
			$scope.filter.active=context;
			if($scope.filter.active.usage!=null){
				//$scope.active.unitstate=true;
			}else{
				if(con!='skip'){
					//$scope.active.unitstate=$scope.active.userunitstate;
				}
			}
			process();
			return;
		}
		if($scope.filter.active.subusage==null||con=='subusage'){
			context.refine=null;
			$scope.filter.active=context;
			process();
			return;
		}
		process();

	}
	//$scope.functions.setcontext();
}]);



