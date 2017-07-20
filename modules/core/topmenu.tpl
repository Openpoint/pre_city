<div id='top' class='col-md-12' ng-controller="menu" ng-style="{'top':ui.topmen.top}">
	<div ng-if="view.dev">{{filter.active}}</div>
	<div class='form-inline'>

		<select class="form-control"
			ng-model="filter.active.level"
			ng-options="item.level as 'level '+ item.level for item in filter.levels">
				<option value=''>All Levels</option>
		</select>
		<select class="form-control text-capitalize"
			ng-model="filter.active.street"
			ng-options="item.sid as item.name for item in streets | orderBy:'name'"
			<!--ng-change="context.chapter='street'"> -->
			<option value=''>All Streets</option>
		</select>
		<select class="form-control text-capitalize"
			ng-model="filter.active.zoning"
			ng-options="item.zid as item.value for item in keys.zoning"
			ng-change="functions.setcontext('zid')">
			<option value=''>All Zonings</option>
		</select>
		<select class="form-control text-capitalize"
			ng-model="filter.active.usage"
			ng-options="item.usage as item.value for item in keys.zoning | getkeyvalue:'usage':filter.active.zoning"
			ng-if="filter.active.zoning!=null"
			ng-change="functions.setcontext('usage')">
			<option value=''>All Uses</option>
		</select>

		<select class="form-control text-capitalize"
			ng-model="filter.active.subusage"
			ng-options="item.subusage as item.value for item in keys.zoning | getkeyvalue:'subusage':filter.active.zoning:filter.active.usage"
			ng-change="functions.setcontext('subusage')"
			ng-if="filter.active.usage!=null">
			<option value=''>All Categories</option>
		</select>
		<select class="form-control text-capitalize"
			ng-model="filter.active.refine"
			ng-options="item.refine as item.value for item in keys.zoning | getkeyvalue:'refine':filter.active.zoning:filter.active.usage:filter.active.subusage"
			ng-change="functions.setcontext('refine')"
			ng-if="filter.active.subusage!=null">
			<option value=''>Refine</option>
		</select>
		<select class="form-control"
			ng-model="filter.active.status"
			ng-options="item.key as item.value for item in occupy.status">
			<option value=''>All Statuses</option>
		</select>
		<!--
		<select class="form-control" ng-model="filter.active.occupancy">
			<option value='' selected="selected">All Occupancies</option>
			<option ng-repeat='x in occupy.occupancy' value='{{x.key}}'>{{x.value}}</option>
		</select>

		<a class='glyphicon glyphicon-repeat' ng-click='filter.active={};filter.active.level=0;filter.active.status=0;context.chapter="map"'> </a>

		<a class="pull-right" id='mode' ng-click="view.mode='god'" ng-if="view.mode!='god'"> g</a>
		<a class="pull-right" id='mode' ng-click="view.mode='normal';view.dev=false" ng-if="view.mode!='normal'"> n</a>
		<div class='pull-right' ng-if="view.mode=='god'" style="margin-right:10px">
			<a id='dev' ng-click="view.dev=true" ng-if="!view.dev">d </a>
			<a id='dev' ng-click="view.dev=false" ng-if="view.dev">d </a>
		</div>
		-->
	</div>
	<div class='clearfix'></div>
	<!--
	<div id='colors' class='form-inline'>
		<form name="myForm" class='pull-left'>
			<button class='btn btn-primary btn-xs' ng-click='filter.active.color=null'>  OFF</button>
			<input class="form-control" type="radio" ng-model="filter.active.color" value="footfall" /> Footfall
			<input class="form-control" type="radio" ng-model="filter.active.color" value="zones" /> Zones
		</form>

		<div id='bcactive' class='pull-right'><a ng-click='context.chapter="agent"'>{{active.agent.agency}}</a> <span ng-if='active.agent && active.property'>|</span> <a ng-click='context.chapter="details"'>{{active.property.address}} {{streets[active.property.sid].name}}</a></div>

		<div class='clearfix'></div>
	</div>
	-->
</div>
