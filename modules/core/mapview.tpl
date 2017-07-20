<div id='right' ng-controller="mapview" class='col-md-9'>
	<div id='map' ng-style='{width:dims.mapwidth+px, height:dims.mapheight+px}'>
		<div id="popup" class='ol-popup'>
			<div id="popup_content">
			</div>
		</div>
	</div>
	<!--
	<openlayers id='map' ol-center="limerick" custom-layers="true" ol-defaults="defaults" width="100%" height="{{dims.height}}">						
		<ol-layer ol-layer-properties="layer" ng-repeat="layer in layers"></ol-layer>						
	</openlayers>					
	<div ng-repeat="x in f.properties">
		<h4><a class='text-capitalize' ng-click='context.bookmark.pid=x.pid;context.chapter="details";functions.getlevels(x.pid);functions.getproperty(x.pid)'>{{x.address}} {{streets[x.sid].name}}</a></h4>
	</div>
	-->

</div>
