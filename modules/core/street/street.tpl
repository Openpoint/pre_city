<div id='streetdet' ng-if="context.chapter=='street'" ng-controller="streetdet">
	<div ng-if="view.dev">{{filter.active.street}}</div>

	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<!--<div class='dark' ng-if="filter.active.level!=null">Level {{filter.active.level}}</div>-->
		<h1 ng-if="filter.active.level==null" class="text-uppercase" 
			tooltip-html-unsafe="{{sdata.total}}m<sup>2</sup><br>Over {{data.street.levels | olength}} Levels" 
			tooltip-placement="bottom"
		><a ng-click="filter.active.status=null;filter.active.zoning=null;functions.setcontext('zid')">{{streets | street:active.street}}</a></h1>
			
		<h1 ng-if="filter.active.level!=null" class="text-uppercase" 
			tooltip-html-unsafe="{{sdata.total}}m<sup>2</sup><br>Over {{data.street.levels | olength}} Levels" 
			tooltip-placement="right"
		><a ng-click="filter.active.level=null;filter.active.status=null;filter.active.zoning=null;functions.setcontext('zid')">{{streets | street:active.street}}</a></h1>
		
		
		<button ng-if="view.mode=='god'" class='btn pull-left btn-primary btn-xs glyphicon glyphicon-pencil' ng-click='context.chapter="streetedit"'></button>	
			
		<div class='clearfix'></div>
		<div class='dark levels' ng-if="filter.active.street!=null">	
			<a ng-click='filter.active.level=null'>LEVEL </a>
			<span ng-repeat="x in data.street.levels">
				<span>|</span>
				<a class='number' ng-click="filter.active.level=x.level" ng-class='{"active":x.level==filter.active.level}'>{{x.level}}</a>
			</span>	
		</div>
		<div class='light'>
			<a ng-click="
				pegstate.unitstack.active.street=filter.active.street;
				pegstate.unitstack.active.level=null;
				pegstate.unitstack.active.zoning=null;
				pegstate.unitstack.active.usage=null;
				pegstate.unitstack.active.subusage=null;
				pegstate.unitstack.active.refine=null;
				context.chapter='unitstack';
			">Explore Street Usage</a>
		</div>
	</div>
	
	<div  class='selector'>
		<select class="form-control text-capitalize" 
			ng-model="filter.active.street" 
			ng-options="item.sid as item.name for item in streets | orderBy:'name'">
			<option value=''>Select a Street</option>
		</select>
	</div>
	
	<!--<div class='image' ng-if='active.levels[active.level].image'><img src='/images/buildings/levels/{{active.levels[active.level].image}}' /></div>-->
	<div  class='statrow' ng-if="active.street!=null">
		<div ng-repeat="z in occupy.status" ng-class="{astat: z.key==filter.active.status&&filter.active.zoning==null}">
			<div class='row' ng-if='sdata.status[z.key].total > 0'>
				<div class="col-xs-6 stattit">
					<a ng-click="filter.active.zoning=x.zid;filter.active.status=z.key">{{z.value}}</a>
				</div>
				<div class='percent_wrapper small {{z.value}} col-xs-6'>
					<div class='inner'>
						<div class='percent' ng-style="{'width':'{{sdata.status[z.key].total | percent:sdata.total}}','background':'{{occupy.status[z.key].color}}'}"></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div  class='statrow' ng-repeat="x in sdata.zoning | orderBy:'total':true" ng-if="x.total && active.street!=null" ng-class="{azone: x.zid==filter.active.zoning}">
		<div class='text-uppercase tit'>
			<a ng-click="filter.active.status=null;filter.active.zoning=x.zid;functions.setcontext('zid')"><strong>{{keys.zoning | getkeyvalue:'value':x.zid}}</strong></a>
		</div>
		<div class='percent_wrapper' tooltip-html-unsafe='<strong>{{x.total | percent:sdata.total}}</strong> of the gross area is hardzoned as {{keys.zoning | getkeyvalue:"value":x.zid}}'>
			<div class='percent' ng-style="{'width':'{{x.total | percent:sdata.total}}','background':'{{keys.zoning | getkeyvalue:'color':x.zid}}'}"></div>
		</div>
		<div ng-repeat="z in occupy.status"  ng-class="{astat: z.key==filter.active.status&&filter.active.zoning==x.zid}">
			<div class='row' ng-if='sdata.status[z.key].zoning[x.zid]'>
				<div class="col-xs-6 stattit">
					<a ng-click="filter.active.zoning=x.zid;filter.active.status=z.key">{{z.value}}</a>
				</div>
				<div class='percent_wrapper small {{z.value}} col-xs-6'>
					<div class='inner'>
						<div class='percent' ng-style="{'width':'{{sdata.status[z.key].zoning[x.zid].total | percent:(sdata.zoning | zonearea:x.zid)}}','background':'{{occupy.status[z.key].color}}'}"></div>
					</div>
				</div>					
			</div>
		</div>
	</div>	
</div>
