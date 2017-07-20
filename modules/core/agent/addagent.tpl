<div id='addagent' ng-controller="addagent"  ng-if="context.verse=='agent'">
	<form novalidate ng-submit="addagent(post)">
		<div class="form-group">
			<input type="text" class="form-control" id="agency" placeholder="Enter agents name" ng-model="post.agency">
		</div>
		<div class="form-group">
			<label>Address</label>
			<input type="text" class="form-control" id="address1" ng-model="post.address1">
			<input type="text" class="form-control" id="address2" ng-model="post.address2">
			<input type="text" class="form-control" id="address3" ng-model="post.address3">
		</div>
		<div class="form-group">
			<label>Contact</label>
			<input type="text" class="form-control" id="telephone"  placeholder="Telephone" ng-model="post.telephone">
			<input type="text" class="form-control" id="email" placeholder="Email" ng-model="post.email">
		</div>
		<div class="form-group">
			<label>About</label>
			<textarea class="form-control" id="aboutagent"  placeholder="About" ng-model="post.about"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
