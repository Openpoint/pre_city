lkcity.controller("addstreet", function($scope,$http) {

	$scope.addstreet=function(data){
		data.command='addstreet';
		var addstreet=$scope.submit(data);
		addstreet.then(function(data){
			console.log($scope.streets);			
			$scope.streets[data*1]={'sid':data*1,'name':$scope.post.streetname};
			$scope.streetsselect.push({'sid':data*1,'name':$scope.post.streetname});
			$scope.post=null;
		})
	}
});
lkcity.controller("addzone", function($scope,$http) {

	$scope.addzone=function(data){
		data.command='addzone';
		var addzone=$scope.submit(data);
		addzone.then(function(data){			
			$scope.post=null;
		})
	}
});
lkcity.controller("addagent", function($scope,$http) {

	$scope.addagent=function(data){
		data.command='addagent';
		var addagent=$scope.submit(data);
		addagent.then(function(data){
			console.log($scope.aname);
			$scope.post=null;
		})
	}
});
lkcity.controller("addprop", function($scope,$http) {
	$scope.post={};
	$scope.$watch('filter.temp.geom',function(){
		if(typeof $scope.filter.temp.geom!='undefined'){
			$scope.post.geom=$scope.filter.temp.geom;
		}
	})
	$scope.addprop=function(data){
		data.command='addprop';
		console.log(data);
		
		var addprop=$scope.submit(data);
		addprop.then(function(data){	
			//$scope.context.chapter='propedit'
			//$scope.functions.getproperty(data);
			//$scope.functions.getlevels(data);
			//$scope.functions.getprops();
			
			//$scope.context.chapter='details';
			$scope.post=null;
			console.log(data);
			$scope.functions.getprops();
			
		})
	}
});

lkcity.controller("addtenant", function($scope,$http) {
	$scope.addtenant=function(data){
		data.command='addtenant';
		var addtenant=$scope.submit(data);
		addtenant.then(function(data){
			$scope.post=null;
			$scope.functions.gettenants();
		})
	}
});
