<div id='propdet' ng-if="context.chapter=='details'">
	<div ng-if="view.dev">{{active.property.pid}}</div>
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h1>
			<span>{{active.property.address | address}} </span>
		</h1>
		<div class='dark'>
			<a ng-click="pegstate.street.active.street=active.property.sid;context.chapter='street'">{{streets | street:active.property.sid}}</a>
		</div>
		<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs pull-left glyphicon glyphicon-pencil' ng-click='context.chapter="propedit"'></button>
		<button ng-if="view.mode=='god'" class='btn btn-danger btn-xs pull-left' ng-click='functions.delproperty(active.property.pid)'>X</button>
		<div class='clearfix'></div>
	</div>
	<!--<div>{{data.totarea}}m<sup>2</sup> over {{active.levels.length}} Levels</div>-->
	<div class='image'>
		<img  ng-if='active.property.image' ng-src='/images/buildings/{{active.property.image}}' />
	</div>
	<div ng-repeat="x in active.levels | orderBy:'level'">
		<div class='widget'>
			<div class='top'>
				<h2><a ng-click="pegstate.level.active.level=x.level;functions.getlevel(x.lid);context.chapter='level'">Level {{x.level}}</a></h2>
			</div>
			<!--<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs pull-right glyphicon glyphicon-pencil' ng-click='context.chapter="lvledit";active.level=active.levels[x.level].level'></button>-->
			<div class='middle'>
				<span ng-if="x.zid">{{keys.zoning | getkeyvalue:'value':x.zid}} : </span><span ng-if="x.status != null">{{occupy.status[x.status].value}} : </span><span ng-if="x.occupancy != null">{{occupy.occupancy[x.occupancy].value}} : </span><span ng-if="active.levels[x.level].area">{{active.levels[x.level].area}}m<sup>2</sup></span>
			</div>
			<div class='bottom'>
				<a 
					class="text-capitalize"
					ng-repeat="y in active.property.units" 
					ng-click="context.chapter='tenant'; functions.gettenant(y.tid);functions.gettenantadd(y.tid)"
				>{{y |thislevel:x.level:' \| ' | lowercase}}</a>
			</div>
		</div>
		<select class="form-control" ng-model="zid[x.level]" ng-hide="x.zid" ng-change="functions.changeitem({'lid':x.lid,'zid':zid[x.level]})" ng-options="item.zid as item.value for item in keys.zoning | orderBy:'value'">
			<option value="" default selected>Select a zoning (level {{x.level}})</option>
		</select>
	</div>
	<!--
	<div class='level' ng-repeat="x in active.property.units">
		<a ng-click="active.unit.uid=null;context.chapter='unit'; functions.getunit(x.uid)" class='text-capitalize'>{{x.code | unitname | lowercase}}</a>
		<span> | </span> 
		<a ng-click='functions.gettenant(x.tid); functions.gettenantadd(x.tid); context.chapter="tenant"'>{{x.tenant}}</a>
		<button ng-if="view.mode=='god'" class='btn pull-right btn-primary btn-xs glyphicon glyphicon-pencil' ng-click='functions.getunit(x.uid);context.chapter="editunit"'></button>
		<div class='clearfix'></div>
	</div>
	-->
	<div>
		<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs' ng-click="functions.addlevel()">Add level</button>
		<button ng-if="active.levels.length > 1 && view.mode=='god'" class='btn btn-danger btn-xs' ng-click="functions.dellevel(active.levels)">Delete level</button>
	</div>
	<div id='agents'>
		<h3 ng-if='active.property.agents.length > 0'>Agents</h3>
		<div ng-repeat='x in active.property.agents'>
			<a ng-click='showagent(agents[x].aid)'>{{agents[x].agency}}</a>
		</div>
	</div>
</div>
