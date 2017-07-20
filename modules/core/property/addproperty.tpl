<div id='addprop' ng-controller="addprop" ng-if="context.verse=='property'">
	<form ng-submit="addprop(post)">
		<div class="form-group">							
			<input type="text" class="form-control" id="address" placeholder="Enter address prefix" ng-model="post.address" ng-required='true'>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="post.street" ng-options="item.sid as item.name for item in streets | orderBy:'name'">
				<option value="">Select a street</option>
			</select>
		</div>
		<div class="form-group">
			<select class="form-control" ng-model="post.zid" ng-options="item.zid as item.value for item in keys.zoning | orderBy:'value'">
				<option value="">Select a zoning (level 0)</option>
			</select>
		</div>
		{{post.geom}}
		<div class="form-group">
			<button class='btn btn-danger' ng-click='functions.draw("addproperty")'>Draw</button>
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
