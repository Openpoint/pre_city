<div id='lvledit' ng-if="context.chapter=='streetedit'">
	<h2><a ng-click="context.chapter='details'">{{active.property.address}} {{streets|street:active.property.sid}}</a> | <a ng-click="context.chapter='level'">Level {{active.level}}</a></h2>
	<h3>Edit the level</h3>
	<form ng-submit="functions.editlevel(active.levels[active.level]);calculate()">
		<div class="form-group">
			<!--
			<select class="form-control" ng-model="active.levels[active.level].zid">
				<option ng-repeat="x in zoningselect | orderBy : 'zoning' : reverse" value='{{ x.zid }}'>{{x.zoning}}</option>
			</select>
			-->
			<select class="form-control" ng-model="active.levels[active.level].zid" ng-options="item.zid as item.value for item in keys.zoning | orderBy:'value'"></select>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="active.levels[active.level].status" ng-options="item.key as item.value for item in occupy.status">
				<option value="">Select the occupancy status</option>
			</select>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="active.levels[active.level].occupancy" ng-options="item.key as item.value for item in occupy.occupancy" ng-if="active.levels[active.level].status!=null">
				<option value="">Select the occupancy type</option>
			</select>
		</div>
		<div class="form-group">
			Area: <input class="form-control" type='text' ng-model='active.levels[active.level].area'>
		</div>

		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
