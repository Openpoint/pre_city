<div id='edittenant'  ng-if="context.chapter=='edittenant' || (context.chapter=='edit' && context.verse=='tenant')">
	<div class='title'>
		<h2 ng-if="context.chapter=='edittenant'"><a ng-click="context.chapter='tenant'">{{active.tenant.tenant}}</a></h2>
	</div>
	<form ng-if="context.chapter=='edit'">

		<div class='filterbox'>
			<h3>Filter:</h3>
			<div class="form-group">
				<select class="form-control" id="fzoning" ng-model="filter.temp.zid" ng-options="item.zid as item.value for item in keys.zoning | orderBy:'value'" ng-change="filter.temp.usage=null; filter.temp.subusage=null; filter.temp.refine=null">
					<option value="">Select a category</option>
				</select>
			</div>
			
			<div class="form-group" ng-if='filter.temp.zid != null'>
				<select class="form-control" id="fusage" ng-model="filter.temp.usage" ng-options="item.usage as item.value for item in keys.zoning | getkeyindex:filter.temp.zid | orderBy:'value'" ng-change="filter.temp.subusage=null; filter.temp.refine=null">
					<option value="">Select a usage</option>
				</select>
			</div>
			
			<div class="form-group" ng-if='filter.temp.usage != null'>
				<select class="form-control" id="fsubusage" ng-model="filter.temp.subusage" ng-options="item.subusage as item.value for item in keys.zoning | getkeyindex:filter.temp.zid:filter.temp.usage | orderBy:'value'" ng-change="filter.temp.refine=null">
					<option value="">Select the usage details</option>
				</select>
			</div>
			<div class="form-group" ng-if='filter.temp.subusage != null'>
				<select class="form-control" id="frefine" ng-model="filter.temp.refine" ng-options="item.refine as item.value for item in keys.zoning | getkeyindex:filter.temp.zid:filter.temp.usage:filter.temp.subusage | orderBy:'value'">
					<option value="">Refine the usage details</option>
				</select>
			</div>
		</div>


		<div class="form-group">
			<select class="form-control" ng-model="active.tenant.tid" ng-change="functions.gettenant(active.tenant.tid)" ng-options="item.tid as item.tenant for item in filter.tenants | filterselect:filter.temp.zid:filter.temp.usage:filter.temp.subusage:filter.temp.refine | orderBy:'tenant'">
				<option value=''>Select an occupant</option>
			</select>
		</div>
	</form>
	<form novalidate ng-submit="functions.edittenant(active.tenant)" ng-if="active.tenant">
		<div class="form-group">
			<input type="text" class="form-control" id="tenant" placeholder="Enter tenant's name" ng-model="active.tenant.tenant">
		</div>
		<div class="form-group">
			<label>Website</label>
			<input type="text" class="form-control" id="website"  placeholder="Website URL" ng-model="active.tenant.url">
		</div>
		<div class="form-group">
			<label>About</label>
			<textarea class="form-control" id="abouttenant"  placeholder="About" ng-model="active.tenant.about"></textarea>
		</div>
		<div class="form-group">
			<select class="form-control" id="zoning" ng-model="active.tenant.zid" ng-options="item.zid as item.value for item in keys.zoning | orderBy:'value'" ng-change="active.tenant.usage=null; active.tenant.subusage=null; active.tenant.refine=null">
				<option value="">Select a category</option>
			</select>
		</div>
		<div class="form-group" ng-if='active.tenant.zid != null'>
			<select class="form-control" id="usage" ng-model="active.tenant.usage" ng-options="item.usage as item.value for item in keys.zoning | getkeyindex:active.tenant.zid | orderBy:'value'" ng-change="active.tenant.subusage=null; active.tenant.refine=null">
				<option value="">Select a usage</option>
			</select>
		</div>
		<div class="form-group" ng-if='active.tenant.usage != null'>
			<select class="form-control" id="subusage" ng-model="active.tenant.subusage" ng-options="item.subusage as item.value for item in keys.zoning | getkeyindex:active.tenant.zid:active.tenant.usage | orderBy:'value'" ng-change=" active.tenant.refine=null">
				<option value="">Select the usage details</option>
			</select>
		</div>
		<div class="form-group" ng-if='active.tenant.subusage != null'>
			<select class="form-control" id="refine" ng-model="active.tenant.refine" ng-options="item.refine as item.value for item in keys.zoning | getkeyindex:active.tenant.zid:active.tenant.usage:active.tenant.subusage | orderBy:'value'">
				<option value="">Refine the usage details</option>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
			<button class='btn btn-danger' value="save" ng-click="functions.deltenant(active.tenant.tid)">X</button>
		</div>
	</form>
</div>
