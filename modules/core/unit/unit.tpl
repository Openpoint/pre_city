<div id='unit' ng-if="context.chapter=='unit'">
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h1 class="">{{active.unit.code | unitname}}</h1>
		<div class='dark'>
			<a ng-click="context.chapter='details';functions.getproperty(active.unit.pid);functions.getlevels(active.unit.pid)">{{active.unit.address | address}}</a>
			<a ng-click="context.chapter='street';filter.active.street=active.unit.sid"> {{streets | street:active.unit.sid}}</a> | 
			<a ng-click="
				functions.getunits(active.unit.lid); 
				context.chapter='level';
				active.placeholder.level=active.unit.level;
				active.placeholder.tenant=active.unit.tenant;
				active.placeholder.sid=active.unit.sid;
				active.placeholder.address=active.unit.address;
			">Level {{active.unit.level}}</a>
		</div>		
		

		<button ng-if="view.mode=='god'" class='btn pull-left btn-primary btn-xs glyphicon glyphicon-pencil' ng-click='context.chapter="editunit"'></button>
		<button ng-if="view.mode=='god'" class='btn btn-danger btn-xs pull-left' ng-click='functions.delunit(active.unit.uid)'>X</button>
		<div class='clearfix'></div>		
	</div>	
	<div class='image'>
		<img ng-if='active.unit.image' ng-src='/images/buildings/levels/units/{{active.unit.image}}' />
		
	</div>
	<div class='section text'>
		<p class='lead'>Situated on the North of the South of the Shannon, this unit is ideally located as central hub for community and business activities</p>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur. Donec ut libero sed arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 		
		</p>
	</div>
	<div class='section' ng-if="active.unit.status!=0">
		<h4>Currently {{occupy.status[active.unit.status].value}}</h4>
	</div>
	<div class='section' ng-if="active.unit.status==0">
		<h4>Currently occupied by:</h4>
		<div class='widget'>
			<div class='top'><a ng-click='functions.gettenant(active.unit.tid);functions.gettenantadd(active.unit.tid); context.chapter="tenant"'>{{active.unit.tenant}}</a></div>		
			<div class='middle'>
				<a>{{keys.zoning | getkeyvalue:'value':active.unit.zid}}</a>
				<span ng-if='active.unit.usage!=null'>
					<span> | </span>
					<a>{{keys.zoning | getkeyvalue:'value':active.unit.zid:active.unit.usage}}</a>
				</span>
				<span ng-if='active.unit.subusage!=null'> 
					<span> | </span>
					<a>{{keys.zoning | getkeyvalue:'value':active.unit.zid:active.unit.usage:active.unit.subusage}}</a>
				</span>
				<span ng-if='active.unit.refine!=null'> 
					<span> | </span>
					<a>{{keys.zoning | getkeyvalue:'value':active.unit.zid:active.unit.usage:active.unit.subusage:active.unit.refine}}</a>
				</span>
			</div>
		</div>
	</div>
	<div class='section'>
		<h4>Related property agents:</h4>
	</div>
</div>
