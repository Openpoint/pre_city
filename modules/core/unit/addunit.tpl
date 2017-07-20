<div id='addunit' ng-if="context.chapter=='addunit'">
	<div class='title'>
		<h2><a ng-click="context.chapter='details'">{{active.property.address}} {{streets | street:active.property.sid}}</a> | <a ng-click="context.chapter='level'">Level {{active.levels[active.level].level}}</a></h2>		
	</div>
	<h3>Add a Unit</h3>
	<form ng-submit="functions.addunit(active.unit)">
		<div class="form-group">							
			<input type="text" class="form-control" id="code" placeholder="Enter a name or number for the unit" ng-model="active.unit.code" ng-required='true'>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="active.unit.status" ng-options="item.key as item.value for item in occupy.status" ng-change="active.unit.tid=null">
				<option value="">Select the occupancy status</option>
			</select>
		</div>
		<div class="form-group">
			<div ng-if="active.unit.status==0">Select A Tenant</div>
			<select class="form-control" ng-model="active.unit.tid" ng-options="item.tid as item.tenant for item in filter.tenants | orderBy:'tenant'" ng-if="active.unit.status==0">
				<option class='bold' value="">Vacant</option>
			</select>
		</div>
		<div class="form-group">
			<div>Select a Property Agent</div>
			<select  multiple="multiple" class="form-control" ng-model="active.unit.agents" ng-options="item.aid as item.agency for item in agentselect"></select>
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">								
		</div>
		<div class="form-group">							
			<input type="text" class="form-control" id="geom" placeholder="Enter the point location" ng-model="active.unit.geom" ng-required='true'>
		</div>							
	</form>
	<button class='btn btn-danger' ng-click='functions.draw("addunit")'>Draw</button>
	{{active.unit.geom}}	
</div>
