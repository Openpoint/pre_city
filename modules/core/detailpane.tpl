<div id='left' ng-style='{width:dims.panewidth+px,minHeight:dims.mapheight+px,top:ui.left.top+px}'>
	<div id='mapshadow' ng-style="{'left':dims.panewidth-1,'width':dims.mapwidth+1,'top':ui.topoffset}"></div>
	<div id='pegs' class='glyphicon' ng-style="{left:dims.panewidth-1+px,top:ui.left.top+125+px}">
		<div class='pegwrap map'>
			<div 
				class='peg glyphicon-globe' 
				ng-class='{"active":context.chapter=="map"}' 
				ng-click="active.unitstate=active.userunitstate;context.chapter='map'"
				tooltip="City by Area" 
				tooltip-placement="right"
			></div>
		</div>
		<div class='pegwrap unitstack'>
			<div 
				class='peg glyphicon-eye-open' 
				ng-class='{"active":context.chapter=="unitstack"}' 
				ng-click="active.unitstate=true;context.chapter='unitstack'"
				tooltip="Explore Usage" 
				tooltip-placement="right"
			></div>
		</div>
		<div class='pegwrap street'>
			<div 
				class='peg glyphicon-road' 
				ng-class='{"active":context.chapter=="street"}' 
				ng-click="active.unitstate=active.userunitstate;context.chapter='street'"
				tooltip="Street by Area" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap details' ng-show='active.property'>
			<div 
				class='peg glyphicon-align-justify' 
				ng-class='{"active":context.chapter=="details"}' 
				ng-click="context.chapter='details'"
				tooltip="Details of Building" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap level' ng-show='active.units'>
			<div 
				class='peg glyphicon-minus' 
				ng-class='{"active":context.chapter=="level"}' 
				ng-click="context.chapter='level'"
				tooltip="Details of Building Level" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap unit' ng-show='active.unit'>
			<div 
				class='peg glyphicon-briefcase' 
				ng-class='{"active":context.chapter=="unit"}' 
				ng-click="context.chapter='unit'"
				tooltip="Details of Unit" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap tenant' ng-show='active.tenant'>
			<div 
				class='peg glyphicon-user' 
				ng-class='{"active":context.chapter=="tenant"}' 
				ng-click="active.unitstate=true;context.chapter='tenant'"
				tooltip="Details of Occupant" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap agent' ng-show='active.agent'>
			<div 
				class='peg glyphicon-shopping-cart' 
				ng-class='{"active":context.chapter=="agent"}' 
				ng-click="context.chapter='agent'"
				tooltip="Details of Property Agent" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap streetview' ng-show='m.streetview!=null'>
			<div 
				class='peg glyphicon-picture' 
				ng-click="functions.streetview()"
				tooltip="Get a streetview" 
				tooltip-placement="right"				
			></div>
		</div>
		<div class='pegwrap god' ng-show="view.mode=='god'">
			<div class='peg glyphicon-edit' ng-class='{"active":context.chapter=="edit" || context.chapter=="add"}' ng-click="context.chapter='add'"></div>
		</div>
	</div>
	
	<div id='topsub' ng-style="{'top':ui.topoffset,'width':dims.panewidth-1}">
		
		<a id='logo' ng-click='
			filter.active.level=null;
			filter.active.status=null;
			filter.active.zoning=null;
			filter.active.street=null;
			context.chapter="map"

		'><img src='/images/citywhite.png' /></a>
		<div id="extra_controls" ng-style="{'left':dims.panewidth+10,'top':ui.topmen.top+155}">
			<div class='econtrol'>
				<span ng-if="context.chapter!='unitstack'">
					<a class="glyphicon glyphicon-eye-open inactive" ng-if="!active.userunitstate" ng-click="active.unitstate=true; active.userunitstate=true"
						tooltip="Show Units" 
						tooltip-placement="right"					
					></a>
					<a class="glyphicon glyphicon-eye-close" ng-if="active.userunitstate" ng-click="active.unitstate=false; active.userunitstate=false"
						tooltip="Hide Units" 
						tooltip-placement="right"					
					></a>
				</span>
			</div>
			<div class='econtrol'>
				<a ng-if="context.chapter!='agent'" ng-click="functions.zoomfocus()" class="glyphicon glyphicon-screenshot"
						tooltip="Zoom to Selection" 
						tooltip-placement="right"				
				></a>
			</div>
		</div>
		<a id='menubutton' class="glyphicon glyphicon-menu-hamburger" ng-click="functions.mentoggle()"></a>

		
		<div class='clearfix'></div>	
	</div>
	<div class='binner'>
	<div ng-controller="propdetail" ng-if="context.chapter!='edit'">
<?php	include("statistics/global.tpl"); ?>
<?php	include("property/property.tpl"); ?>
<?php	include("property/propedit.tpl"); ?>
<?php	include("level/level.tpl"); ?>
<?php	include("level/leveledit.tpl"); ?>
<?php	include("agent/agent.tpl"); ?>
<?php	include("agent/agentedit.tpl"); ?>
<?php	include("unit/unit.tpl"); ?>
<?php	include("unit/addunit.tpl"); ?>
<?php	include("unit/unitstack.tpl"); ?>
<?php	include("unit/editunit.tpl"); ?>
<?php	include("tenant/tenant.tpl"); ?>
<?php	include("tenant/edittenant.tpl"); ?>
<?php	include("street/street.tpl"); ?>
<?php	include("street/streetedit.tpl"); ?>
	</div>
	<div id='forms' ng-if="context.chapter=='add' || context.chapter=='edit'">
		<div class='verse'>
			<button class='btn' ng-click="context.verse = 'property'" ng-class="{'btn-primary': context.verse == 'property', 'btn-default': context.verse != 'property'}">Property</button>
			<button class='btn' ng-click="context.verse = 'zone'" ng-class="{'btn-primary': context.verse == 'zone', 'btn-default': context.verse != 'zone'}">Zone</button>
			<button class='btn' ng-click="context.verse = 'street'" ng-class="{'btn-primary': context.verse == 'street', 'btn-default': context.verse != 'street'}">Street</button>
			<button class='btn' ng-click="context.verse = 'agent'" ng-class="{'btn-primary': context.verse == 'agent', 'btn-default': context.verse != 'agent'}">Agent</button>
			<button class='btn' ng-click="context.verse = 'tenant'" ng-class="{'btn-primary': context.verse == 'tenant', 'btn-default': context.verse != 'tenant'}">Tenant</button>
		</div>
		<div class='verse'>
			<button class='btn' ng-click="context.chapter = 'add'" ng-class="{'btn-primary': context.chapter == 'add', 'btn-default': context.chapter != 'add'}">Add</button>
			<button class='btn' ng-click="context.chapter = 'edit'" ng-class="{'btn-primary': context.chapter == 'edit','btn-default': context.chapter != 'edit'}">Edit</button>
		</div>
		<div ng-if="context.chapter=='add'">
			<h2>Create a new {{context.verse}}:</h2>
<?php			include("property/addproperty.tpl"); ?>
<?php			include("newitems/addzone.tpl"); ?>
<?php			include("newitems/addstreet.tpl"); ?>
<?php			include("agent/addagent.tpl"); ?>
<?php			include("tenant/addtenant.tpl"); ?>
		</div>
		<div ng-if="context.chapter=='edit'">
			<h2>Edit <span ng-if="!active.tenant">a {{context.verse}}:</span><a ng-if="context.verse=='tenant'" ng-click="context.chapter='tenant'">{{active.tenant.tenant}}</a></h2>
<?php			include("tenant/edittenant.tpl"); ?>
		</div>
	</div>
	</div>
</div>
