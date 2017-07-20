<div id='addzone' ng-controller="addzone"  ng-if="context.verse=='zone'">
	<form class='form-inline' novalidate ng-submit="addzone(post)">
		<div class="form-group">
			<input type="text" class="form-control" id="zone" placeholder="Enter zone" ng-model="post.zoning">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="color" placeholder="Enter color" ng-model="post.color">
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
