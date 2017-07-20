<div id='tenantdet' ng-if="context.chapter=='tenant'" ng-controller='tenant'>
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h1>{{active.tenant.tenant}}</h1>
		<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs pull-left glyphicon glyphicon-pencil' ng-click='context.chapter="edittenant"'></button>
		<div class='dark'>
			<a ng-click="			
				pegstate.unitstack.active.zoning=active.tenant.zid;
				pegstate.unitstack.active.usage=null;
				pegstate.unitstack.active.subusage=null;
				pegstate.unitstack.active.refine=null;
				context.chapter='unitstack';

				
			">{{keys.zoning | getkeyvalue:'value':active.tenant.zid}}</a>
			<span ng-if="active.tenant.usage!=null"> | 
				<a ng-click="
				
				pegstate.unitstack.active.zoning=active.tenant.zid;
				pegstate.unitstack.active.usage=active.tenant.usage;
				pegstate.unitstack.active.subusage=null;
				pegstate.unitstack.active.refine=null;
				context.chapter='unitstack';

				
			">{{keys.zoning | getkeyvalue:'value':active.tenant.zid:active.tenant.usage}}</a>
			</span>
			<span ng-if="active.tenant.subusage!=null"> | 
				<a ng-click="
				
				pegstate.unitstack.active.zoning=active.tenant.zid;
				pegstate.unitstack.active.usage=active.tenant.usage;
				pegstate.unitstack.active.subusage=active.tenant.subusage;
				pegstate.unitstack.active.refine=null;
				context.chapter='unitstack';

				
			">{{keys.zoning | getkeyvalue:'value':active.tenant.zid:active.tenant.usage:active.tenant.subusage}}</a>
			</span>
			<span ng-if="active.tenant.refine!=null"> | 
				<a ng-click="
				
				pegstate.unitstack.active.zoning=active.tenant.zid;
				pegstate.unitstack.active.usage=active.tenant.usage;
				pegstate.unitstack.active.subusage=active.tenant.subusage;
				pegstate.unitstack.active.refine=active.tenant.refine;
				context.chapter='unitstack';
				
			">{{keys.zoning | getkeyvalue:'value':active.tenant.zid:active.tenant.usage:active.tenant.subusage:active.tenant.refine}}</a>
			</span>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 ologo">
			<img src="/images/occupants/generic-logo.jpg"/>
		</div>
		<div class="col-md-8">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur.</p>
		</div>
		
	</div>
	<div ng-repeat="x in active.tenantadd" class='widget'>
		<div class='top'>
			<h2 class='text-uppercase'><a ng-click="active.unit.uid=null;functions.propfocus(x.pid);functions.getunit(x.uid);context.chapter='unit'">{{x.code | unitname}}</a></h2>	
		</div>
		<div class='middle'>
			<a ng-click="active.property.pid=null;functions.getproperty(x.pid);functions.getlevels(x.pid); context.chapter='details'">{{x.address | address}} {{x.name}}</a>

		</div>
		<div class='bottom'>
			<a ng-click="pegstate.level.active.level=x.level;functions.getlevel(x.lid);context.chapter='level'">Level {{x.level}}</a>
		</div>  
		
	</div>
	<p class='about'>{{active.tenant.about}}</p>
	<div class='details'>
		<div><a href='https://duckduckgo.com' target='_blank'><strong>Website</strong></a></div>
		<address>
			<strong>Land Mail</strong><br>
			795 Folsom Ave, Suite 600<br>
			San Francisco, CA 94107<br>
			<abbr title="Phone">P:</abbr> (123) 456-7890
		</address>

		<address>
			<strong>Email</strong><br>
			<a href="mailto:#">first.last@example.com</a>
		</address>
	</div>

</div>
