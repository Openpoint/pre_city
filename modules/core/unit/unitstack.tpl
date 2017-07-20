<div id='unitstack' ng-if="context.chapter=='unitstack'" ng-controller='unitstack'>
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h1>IN VIEW:</h1>
		<div>
			<div class='dark levels'>			
				<div class="text-allcaps" ng-if="filter.active.street!=null">{{streets | street:filter.active.street}}
					<a class="xremove glyphicon glyphicon-remove" ng-click="filter.active.street=null"></a>
				</div>
				<div>{{data.unitstack.subtotal}} of {{data.unitstack.total}} units</div>
			</div>	
		</div>
		<div class='light' ng-if="filter.active.street==null">
			<a ng-click="
				active.unitstate=false;
				pegstate.map.active.street=null;
				pegstate.map.active.level=null;
				pegstate.map.active.zoning=null;
				pegstate.map.active.usage=null;
				pegstate.map.active.subusage=null;
				pegstate.map.active.refine=null;
				context.chapter='map';
			">Explore City Zoning</a>
		</div>	
		<div class='light' ng-if="filter.active.street!=null">
			<span>Explore </span>
			<a ng-click="
				pegstate.street.active.street=filter.active.street;
				pegstate.street.active.level=null;
				pegstate.street.active.zoning=null;
				pegstate.street.active.usage=null;
				pegstate.street.active.subusage=null;
				pegstate.street.active.refine=null;
				context.chapter='street';
			">Street</a>
			<span> | </span>
			<a ng-click="
				active.unitstate=false;
				pegstate.map.active.street=null;
				pegstate.map.active.level=null;
				pegstate.map.active.zoning=null;
				pegstate.map.active.usage=null;
				pegstate.map.active.subusage=null;
				pegstate.map.active.refine=null;
				context.chapter='map';
			">City</a>
			<span> Zoning</span>
		</div>
	</div>
	<anguvideo ng-if="filter.active.street!=null" ng-model="video" width="100%" height="177"></anguvideo>
	<div  class='selector'>
		<select class="form-control text-capitalize" 
			ng-model="filter.active.street" 
			ng-options="item.sid as item.name for item in streets | orderBy:'name'"
		>
			<option value=''>Focus on a Street</option>
		</select>
	</div>
	<div class='statrow' ng-if="data.unitstack.metrics.length == 0">
		<div class='text-uppercase'>
			<strong>
				<span 
					ng-if='filter.active.zoning==null' 
				>There are no units to display for your selection</span>
				<a 
					ng-if='filter.active.zoning!=null' 
					ng-click="
						filter.active.zoning=null;
						functions.setcontext('zid')
					"
				>ALL | </a>
				<a 
					ng-if='filter.active.zoning!=null'  
					ng-click="
						filter.active.zoning=filter.active.zoning;
						functions.setcontext('zid');
					"
				>{{keys.zoning | getkeyvalue:'value':filter.active.zoning}}</a>
				<a 
					ng-if='filter.active.zoning!=null'  
					ng-click="
						filter.active.usage=null;
						functions.setcontext('zid');
					"
				>{{keys.zoning | getkeyvalue:'value':filter.active.zoning}}</a>
				<a 
					ng-if='filter.active.usage!=null'  
					ng-click="
						filter.active.subusage=null;
						functions.setcontext('usage');
					"
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage}}</a>
				<a 
					ng-if='filter.active.subusage!=null'  
					ng-click="
						filter.active.refine=null;
						functions.setcontext('subusage');
					"
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage:filter.active.subusage}}</a>
				<a 
					ng-if='filter.active.refine!=null'
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage:filter.active.subusage:filter.active.refine}}</a>
			</strong>
			
		</div>
		<p>No Results are visible in the view</p>
	</div>
	<div class='statrow' ng-repeat='x in data.unitstack.metrics | orderBy:"count":true'>
		<div class='text-uppercase'>
			<strong>
				<a 
					ng-if='filter.active.zoning!=null' 
					ng-click="
						filter.active.zoning=null;
						functions.setcontext('zid')
					"
				>ALL | </a>
				<a 
					ng-if='filter.active.zoning==null'  
					ng-click="
						filter.active.zoning=x.zid;
						functions.setcontext('zid');
					"
				>{{keys.zoning | getkeyvalue:'value':x.zid}}</a>
				<a 
					ng-if='filter.active.zoning!=null'  
					ng-click="
						filter.active.usage=null;
						functions.setcontext('zid');
					"
				>{{keys.zoning | getkeyvalue:'value':filter.active.zoning}}</a>
				<a 
					ng-if='filter.active.usage!=null'  
					ng-click="
						filter.active.subusage=null;
						functions.setcontext('usage');
					"
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage}}</a>
				<a 
					ng-if='filter.active.subusage!=null'  
					ng-click="
						filter.active.refine=null;
						functions.setcontext('subusage');
					"
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage:filter.active.subusage}}</a>
				<a 
					ng-if='filter.active.refine!=null'
				> | {{keys.zoning | getkeyvalue:'value':filter.active.zoning:filter.active.usage:filter.active.subusage:filter.active.refine}}</a>
			</strong>
		</div>	
		<div class='percent_wrapper'>								
			<div class='percent' 
				ng-style="{'width':'{{x.count | percent:data.city.unitcount}}','background':'#FF9111'}"
				ng-if="filter.active.zoning==null">
			</div>
			<div class='percent' 
				ng-style="{'width':'{{data.unitstack.subtotal | percent:data.city.unitcount}}','background':'#FF9111'}"
				ng-if="filter.active.zoning!=null">
			</div>
		</div>
		<div ng-repeat='y in x.usage'>
			<div class='row' ng-if="filter.active.usage==null">
				<div class="col-xs-6 stattit">
					<a ng-click="
						filter.active.zoning=x.zid;
						filter.active.usage=y.usage;
						functions.setcontext('usage')
					">{{keys.zoning | getkeyvalue:'value':x.zid:y.usage}}</a>
				</div>
				<div class='percent_wrapper small col-xs-6'>
					<div class='inner'>
						<div class='percent' ng-style="{'width':'{{y.count | percent:x.count}}'}"></div>
					</div>						
				</div>

			</div>
			<div  ng-if="filter.active.usage!=null" ng-repeat='z in y.subusage'>
				<div class='row' ng-if="filter.active.subusage==null">
					<div class="col-xs-6 stattit">
						<a ng-click="
							filter.active.usage=y.usage;
							filter.active.subusage=z.subusage;
							functions.setcontext('subusage')
						">{{keys.zoning | getkeyvalue:'value':x.zid:y.usage:z.subusage}}</a>
					</div>
					<div class='percent_wrapper small col-xs-6'>
						<div class='inner'>
							<div class='percent' ng-style="{'width':'{{z.count | percent:y.count}}'}"></div>
						</div>						
					</div>

				</div>
				<div  ng-if="filter.active.subusage!=null" ng-repeat='a in z.refine'>
					<div class='row' ng-if="filter.active.refine==null">
						<div class="col-xs-6 stattit">
							<a ng-click="
								filter.active.subusage=z.subusage;
								filter.active.refine=a.refine;
								functions.setcontext()"
							>{{keys.zoning | getkeyvalue:'value':x.zid:y.usage:z.subusage:a.refine}}</a>
						</div>
						<div class='percent_wrapper small col-xs-6'>
							<div class='inner'>
								<div class='percent' ng-style="{'width':'{{a.count | percent:z.count}}'}"></div>
							</div>						
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div ng-repeat="x in active.unitstack | orderBy:'tenant'"> 	
		<div class='widget'>
			<div class='top'>
				<a ng-click="context.chapter='tenant'; functions.gettenant(x.tid);functions.gettenantadd(x.tid)" class="text-uppercase"><strong>{{x.tenant}}</strong></a>								
			</div>
			<div class='middle'>
				<a class="text-capitalize" ng-click="active.unit.uid=null;context.chapter='unit'; functions.getunit(x.uid)">{{x.code | unitname | lowercase}}</a>
				<span> | </span>
				<a ng-click="
					functions.getunits(x.lid);
					context.chapter='level';
					active.placeholder.level=x.level;
					active.placeholder.sid=x.sid;
					active.placeholder.address=x.address;
					active.placeholder.pid=x.pid
				">Level {{x.level}}</a><br>
				<a ng-click="active.property.pid=null;functions.getproperty(x.pid);functions.getlevels(x.pid);context.chapter='details'">{{x.address | address}}</a><span> , </span>
				<a class="text-capitalize" ng-click="filter.active.street=x.sid">{{streets|street:x.sid|lowercase}}</a>
			</div>
			<div class='bottom text-uppercase'>
				<a ng-click="filter.active.zoning=x.zid;functions.setcontext('zid')">{{keys.zoning | getkeyvalue:'value':x.zid}}</a>
				<span ng-if='x.usage!=null'>
					<span> | </span>
					<a ng-click="filter.active.zoning=x.zid;filter.active.usage=x.usage;functions.setcontext('usage')">{{keys.zoning | getkeyvalue:'value':x.zid:x.usage}}</a>
				</span>
				<span ng-if='x.subusage!=null'> 
					<span> | </span>
					<a ng-click="filter.active.zoning=x.zid;filter.active.usage=x.usage;filter.active.subusage=x.subusage;functions.setcontext('subusage')">{{keys.zoning | getkeyvalue:'value':x.zid:x.usage:x.subusage}}</a>
				</span>
				<span ng-if='x.refine!=null'> 
					<span> | </span>
					<a ng-click="filter.active.zoning=x.zid;filter.active.usage=x.usage;filter.active.subusage=x.subusage;filter.active.refine=x.refine;functions.setcontext()">{{keys.zoning | getkeyvalue:'value':x.zid:x.usage:x.subusage:x.refine}}</a>
				</span>
			</div>
		</div>
	</div>
</div>
