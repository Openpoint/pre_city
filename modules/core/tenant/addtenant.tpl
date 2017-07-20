<div id='addtenant' ng-controller="addtenant"  ng-if="context.verse=='tenant'">
	<form novalidate ng-submit="addtenant(post)">
		<div class="form-group">
			<input type="text" class="form-control" id="tenant" placeholder="Enter tenant's name" ng-model="post.tenant">
		</div>
		<div class="form-group">
			<label>Website</label>
			<input type="text" class="form-control" id="website"  placeholder="Website URL" ng-model="post.url">
		</div>
		<div class="form-group">
			<label>About</label>
			<textarea class="form-control" id="abouttenant"  placeholder="About" ng-model="post.about"></textarea>
		</div>
		
		
		<div class="form-group">
			<select class="form-control" id="zoning" ng-model="post.zid" ng-options="item.zid as item.value for item in keys.zoning" ng-change="post.usage=null; post.subusage=null; post.refine=null">
				<option value="">Select a category</option>
			</select>
		</div>
		<div class="form-group" ng-if='post.zid != null'>
			<select class="form-control" id="usage" ng-model="post.usage" ng-options="item.usage as item.value for item in keys.zoning | getkeyindex:post.zid" ng-change="post.subusage=null; post.refine=null">
				<option value="">Select a usage</option>
			</select>
		</div>
		<div class="form-group" ng-if='post.usage != null'>
			<select class="form-control" id="subusage" ng-model="post.subusage" ng-options="item.subusage as item.value for item in keys.zoning | getkeyindex:post.zid:post.usage" ng-change="post.refine=null">
				<option value="">Select the usage details</option>
			</select>
		</div>
		<div class="form-group" ng-if='post.subusage != null'>
			<select class="form-control" id="refine" ng-model="post.refine" ng-options="item.refine as item.value for item in keys.zoning | getkeyindex:post.zid:post.usage:post.subusage">
				<option value="">Refine the usage details</option>
			</select>
		</div>		
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
