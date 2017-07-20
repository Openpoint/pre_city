<div id='leveldet' ng-if="context.chapter=='level'" ng-controller='leveldet'>
	<div ng-if="view.dev">{{active.units}}</div>
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h1>
			<a ng-click="
				active.property.pid=null;
				context.chapter='details';
				functions.getproperty(active.placeholder.pid);
				functions.getlevels(active.placeholder.pid)
			">{{active.placeholder.address | address}} {{streets | street:active.placeholder.sid}}</a>
		</h1>
		<div class='dark'>Level {{filter.active.level}}</div>		
		<button ng-if="view.mode=='god'" class='btn pull-left btn-primary btn-xs glyphicon glyphicon-pencil' ng-click='context.chapter="lvledit"'></button>		

	</div>
	<div class='image' ng-if='active.levels[active.level].image'><img ng-src='/images/buildings/levels/{{active.levels[active.level].image}}' /></div>
	<div class='widget' ng-repeat="x in active.units">
		<div class='top'>
			<a ng-click='functions.gettenant(x.tid); functions.gettenantadd(x.tid); context.chapter="tenant"' ng-if="x.tenant">{{x.tenant}}</a>
			<span class='text-uppercase' ng-if="x.tenant==null">{{occupy.status | status:x.status}}</span>
		</div>
		<div class='middle'>
			<a ng-click="active.unit.uid=null;context.chapter='unit'; functions.getunit(x.uid)">{{x.code | unitname }}</a>
		</div>
		
		<button ng-if="view.mode=='god'" class='btn pull-right btn-primary btn-xs glyphicon glyphicon-pencil' ng-click='functions.getunit(x.uid);context.chapter="editunit"'></button>
	</div>

	<div>
		<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs' ng-click="context.chapter='addunit';active.unit=null">Add a unit</button>
	</div>
	
	
</div>
