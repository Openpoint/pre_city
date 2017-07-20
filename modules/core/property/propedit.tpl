<div id='propedit' ng-if="context.chapter=='propedit'">
	<div class='title'>
		<h2 class='pull-left'><a ng-click="context.chapter='details'">{{active.property.address}} {{streets | street:active.property.sid}}</a></h2>
		<div class='clearfix'></div>
	</div>
	<form ng-submit="functions.editprop(active.property)">
		<div class="form-group">							
			<input type="text" class="form-control" id="address" placeholder="Enter address prefix" ng-model="active.property.address" ng-required='true'>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="active.property.sid" ng-options="item.sid as item.name for item in streets | orderBy : 'name'">
				<option value="">Select a Street</option>
			</select>
		</div>
		<div class="form-group">
			<div>Select Footfall Weight</div>
			<select class="form-control" ng-model="active.property.footfall" ng-options="item.ffid as item.value for item in ffall"></select>
		</div>
		<div class="form-group">
			<div>Select a Property Agent</div>
			<select  multiple="multiple" class="form-control" ng-model="active.property.agents" ng-options="item.aid as item.agency for item in agentselect"></select>
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">								
		</div>							
	</form>
	<button class='btn btn-danger' ng-click='functions.draw("editproperty")'>Draw</button>
</div>
