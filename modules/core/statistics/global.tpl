<div id='mapdet' ng-if="context.chapter=='map'" ng-controller="mapdet">
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<!--<div class='dark' ng-if="filter.active.level!=null">Level {{filter.active.level}}</div>-->
		<h1 ng-if="filter.active.level==null" class="text-uppercase" 
			tooltip-html-unsafe="{{data.city.areas.total}}m<sup>2</sup><br>Over {{data.city.levels | olength}} Levels" 
			tooltip-placement="right"
		><a ng-click="filter.active.zoning=null;filter.active.status=null;filter.active.street=null;filter.active.level=null;functions.setcontext('zid')">Limerick CBD </a></h1>
			
		<h1 ng-if="filter.active.level!=null" class="text-uppercase" 
			tooltip-html-unsafe="{{data.city.areas.total}}m<sup>2</sup><br>Over {{data.city.levels | olength}} Levels" 
			tooltip-placement="right"
		><a ng-click="filter.active.zoning=null;filter.active.status=null;filter.active.street=null;filter.active.level=null;functions.setcontext('zid')">Limerick CBD </a></h1>
		<div class='clearfix'></div>
		<div>
			<div class='dark levels'>
				<a ng-click='filter.active.level=null'>LEVEL </a>
				<span ng-repeat="x in filter.levels">
					<span>|</span>
					<a class='number' ng-click="filter.active.level=x.level" ng-class='{"active":x.level==filter.active.level}'>{{x.level}}</a>
				</span>	
			</div>
		</div>	
		<div class='light'>
			<a ng-click="
				pegstate.unitstack.active.street=null;
				pegstate.unitstack.active.level=null;
				pegstate.unitstack.active.zoning=null;
				pegstate.unitstack.active.usage=null;
				pegstate.unitstack.active.subusage=null;
				pegstate.unitstack.active.refine=null;
				context.chapter='unitstack';
			">Explore City Usage</a>
		</div>		
	</div>
	<div  class='statrow'>
		<div ng-repeat="z in occupy.status" ng-class="{astat: z.key==filter.active.status&&filter.active.zoning==null}">
			<div class='row' ng-if='adata.status[z.key].total > 0'>
				<div class="col-xs-6 stattit">
					<a ng-click="filter.active.zoning=x.zid;filter.active.status=z.key;functions.setcontext('zid')">{{z.value}}</a>
				</div>
				<div class='percent_wrapper small {{z.value}} col-xs-6'>
					<div class='inner' tooltip-html-unsafe="{{adata.status[z.key].total|percent:adata.total}} of the gross city area is predominantly {{z.value}}" tooltip-placement="bottom">
						<div class='percent' ng-style="{'width':'{{adata.status[z.key].total|percent:adata.total}}','background':'{{occupy.status[z.key].color}}'}"></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>					
	<div  class='statrow' ng-repeat="x in adata.zoning | orderBy:'total':true" ng-class="{azone: x.zid==filter.active.zoning}">
		<div class='text-uppercase tit'>
			<strong>
				<a ng-click="
					filter.active.zoning=x.zid;
					filter.active.status=null;
					functions.setcontext('zid')
				">{{keys.zoning | getkeyvalue:'value':x.zid}}</a>
			</strong>
		</div>
		<div tooltip-html-unsafe='<strong>{{x.total | percent:adata.total}}</strong> of the gross area is hardzoned as {{keys.zoning | getkeyvalue:"value":x.zid}}' class='percent_wrapper'>				
			<div class='percent' ng-style="{'width':'{{x.total | percent:adata.total}}','background':'{{keys.zoning | getkeyvalue:'color':x.zid}}'}"></div>
		</div>
		<div ng-repeat="z in occupy.status"  ng-class="{astat: z.key==filter.active.status&&filter.active.zoning==x.zid}">
			<div class='row' ng-if='adata.status[z.key].zoning[x.zid]'>
				<div class="col-xs-6 stattit">
					<a ng-click="filter.active.zoning=x.zid;filter.active.status=z.key;functions.setcontext('zid')">{{z.value}}</a>
				</div>
				<div class='percent_wrapper small {{z.value}} col-xs-6'>
					<div class='inner' tooltip-html-unsafe="{{adata.status[z.key].zoning[x.zid].total|percent:(adata.zoning | zonearea:x.zid)}} of the gross {{keys.zoning | getkeyvalue:'value':x.zid}} area is predominantly {{z.value}}" tooltip-placement="bottom">
						<div class='percent' ng-style="{'width':'{{adata.status[z.key].zoning[x.zid].total|percent:(adata.zoning | zonearea:x.zid)}}','background':'{{occupy.status[z.key].color}}'}"></div>
					</div>
				</div>					
			</div>
		</div>	
	</div>
</div>
