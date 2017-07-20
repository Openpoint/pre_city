<div id='agentedit' ng-if="context.chapter=='agentedit'">
	<h2><a ng-click="context.chapter='agent'">{{active.agent.agency}}</a></h2>						
	<form novalidate ng-submit="editagent(active.agent)">
		<div class="form-group">
			<input type="text" class="form-control" id="eagency" placeholder="Enter agents name" ng-model="active.agent.agency">
		</div>
		<div class="form-group">
			<label>Address</label>
			<input type="text" class="form-control" id="eaddress1" ng-model="active.agent.address1">
			<input type="text" class="form-control" id="eaddress2" ng-model="active.agent.address2">
			<input type="text" class="form-control" id="eaddress3" ng-model="active.agent.address3">
		</div>
		<div class="form-group">
			<label>Contact</label>
			<input type="text" class="form-control" id="etelephone"  placeholder="Telephone" ng-model="active.agent.telephone">
			<input type="text" class="form-control" id="eemail" placeholder="Email" ng-model="active.agent.email">
		</div>
		<div class="form-group">
			<label>About</label>
			<textarea class="form-control" id="eaboutagent"  placeholder="About" ng-model="active.agent.about"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class='btn btn-danger' value="save">
		</div>
	</form>
</div>
