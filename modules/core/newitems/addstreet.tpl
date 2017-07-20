<div id='addstreet' ng-controller="addstreet"  ng-if="context.verse=='street'">
	<form class='form-inline' novalidate ng-submit="addstreet(post)">
		<div class="form-group">
			<input type="text" class="form-control" id="street" placeholder="Enter street name" ng-model="post.streetname">
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
