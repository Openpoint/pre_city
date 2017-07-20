lkcity.controller("tenant", function($scope) {
	

});

lkcity.controller("mapdet", function($scope) {
	function setdata(){
		$scope.adata=$scope.data.city.areas;
		$scope.adata.zoning = $.map($scope.adata.zoning, function(value, index) {
			return [value];
		});		
	}
	$scope.$watch('data.city',function(){
		if(typeof $scope.data.city !='undefined'){
			setdata();
		}
	});
	$scope.$watch('filter.active.level',function(){
		
		if(typeof $scope.data.city !='undefined' && $scope.filter.active.level!=null){
			$scope.adata=$scope.data.city.levels[$scope.filter.active.level].areas;
			$scope.adata.zoning = $.map($scope.adata.zoning, function(value, index) {
				return [value];
			});
		}else if(typeof $scope.data.city !='undefined' && $scope.filter.active.level==null){
			setdata();
		}
	})
});
lkcity.controller("streetdet", function($scope) {
	function setdata(){
		$scope.sdata=$scope.data.street.areas;
		$scope.sdata.zoning = $.map($scope.sdata.zoning, function(value, index) {
			return [value];
		});		
	}
	function setdata2(){
		$scope.sdata=$scope.data.street.levels[$scope.filter.active.level].areas;
		$scope.sdata.zoning = $.map($scope.sdata.zoning, function(value, index) {
			return [value];
		});		
	}
	$scope.$watch('data.street',function(){
		if(typeof $scope.data.street !='undefined' && $scope.filter.active.level==null){
			setdata();
		}else if(typeof $scope.data.street !='undefined'){
			setdata2();
		}
	});
	$scope.$watch('filter.active.level',function(){		
		if(typeof $scope.data.street !='undefined' && $scope.filter.active.level!=null){
			setdata2()
		}else if(typeof $scope.data.street !='undefined' && $scope.filter.active.level==null){
			setdata();
		}
	})
});
lkcity.controller("propdetail", function($scope) {

	$scope.$watch('active.property.pid', function() {
		if(typeof $scope.active.property !='undefined'){
			//$scope.functions.getlevels($scope.active.property.pid);
			if(!$scope.active.property.image){
				$scope.active.property.image=Math.floor(Math.random()*21)+'.jpg'
			}
		}
	})
	$scope.$watch('active.unit.uid', function() {
		if(typeof $scope.active.unit !='undefined'){
			
			if(!$scope.active.unit.image){
				$scope.active.unit.image=Math.floor(Math.random()*11)+'.jpg'
			}
		}
	})

	$scope.showagent=function(aid){
		//console.log($scope.active.agent);
		if(typeof $scope.active.agent !='undefined' && aid == $scope.active.agent.aid){
			$scope.context.chapter='agent';
		}else{
			$scope.functions.getagent(aid);
			$scope.functions.getpropbyagent(aid);
			$scope.context.chapter='agent';
		}
	}
	$scope.propfocus=function(pid){
		console.log('propfocus');
		//$scope.filter.active={};
		//$scope.filter.active.level="0"; 
		if(typeof $scope.context.oldfeature != 'undefined'){
			$scope.context.oldfeature.setStyle(null);
		}
		if(typeof $scope.active.property != 'undefined'){
			$scope.functions.getproperty(pid);
			//$scope.functions.getlevels(pid);
		}else{
			$scope.active.property={};
			$scope.functions.getproperty(pid);
			//$scope.functions.getlevels(pid);
			//$scope.context.chapter='details';
		}
		var feature=$scope.layers.properties.getSource().getFeatureById(pid);
		$scope.context.oldfeature=feature;
		$scope.activefeature=feature;
		feature.setStyle(style.selected);
		var extent=feature.getGeometry().getExtent();
		map.getView().fitExtent(extent, $scope.map.getSize());
		var zoom=map.getView().getZoom();
		map.getView().setZoom(zoom-2);
		var cent=feature.getGeometry().getInteriorPoint().getCoordinates();
		map.getView().setCenter(cent);
	}
	$scope.$watch('filter.active.street',function(){
		if($scope.context.chapter=='street' && $scope.filter.active.street!=null){
			$scope.data.fetch.street($scope.filter.active.street);
		}else if($scope.context.chapter=='street'){
			$scope.data.street=null;
			$scope.active.street=null;
		}
	})
});
