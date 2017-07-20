<div id='agentdet' ng-if="context.chapter=='agent'">
	<div class='title' ng-style="{'top':ui.titletop,'width':dims.panewidth-35}">
		<h2 class='pull-left'>{{active.agent.agency}}</h2>
		<button ng-if="view.mode=='god'" class='btn btn-primary btn-xs pull-left glyphicon glyphicon-pencil' ng-click='context.chapter="agentedit"'></button>
		<div class='clearfix'></div>
	</div>
	<p class='about'>{{active.agent.about}}</p>
	<ul class='details'>
		<li>{{active.agent.address1}}</li>
		<li>{{active.agent.address2}}</li>
		<li>{{active.agent.address3}}</li>
	</ul>
	<ul class='details'>
		<li>{{active.agent.telephone}}</li>
		<li>{{active.agent.email}}</li>
	</ul>
	<h3>Property Portfolio</h3>
	<div ng-repeat='x in active.getpropbyagent'><a ng-click='propfocus(x.pid)'>{{x.address}} {{streets | street:x.sid}}</a></div>
</div>
