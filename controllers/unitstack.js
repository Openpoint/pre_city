lkcity.controller("unitstack", function($scope,$filter,$timeout) {
	/*
	$scope.$watch('data.unitstack.metrics',function(){
		if($scope.filter.active.zoning!=null){		
			$scope.usage=$filter('getkeyvalue')($scope.data.unitstack.metrics,'usage',$scope.filter.active.zoning)
		}else{
			$scope.usage=null;			
		}			
		if($scope.filter.active.usage!=null){
			$scope.subusage=$scope.usage[$scope.filter.active.usage].subusage
		}else{
			$scope.subusage=null
		}
		if($scope.filter.active.subusage!=null){
			$scope.refine=$scope.subusage[$scope.filter.active.subusage].refine
		}else{
			$scope.refine=null
		}
	},true)
	* */	
});
