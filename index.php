<!DOCTYPE html>
<html ng-app='lkcity' lang="en">

	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
		<title>CITY | internet GIS for the masses</title>
		<meta name="description" content="Platform to present geographic data in consumable fashion">
		<meta name="author" content="Openpoint">

		<!-- Optional theme
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
		-->
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/js/openlayers/css/ol.css">
		<link rel="stylesheet" href="/css/mappopup.css">
		<link rel="stylesheet" href="/css/gibson/stylesheet.css">

		<script src="/js/jquery-1.11.2.min.js"></script>

		<script src="/bootstrap/js/bootstrap.js"></script>
		<script src="/js/openlayers/build/ol-debug.js"></script>

		<!--<script src="/js/angular.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.js"></script>
		<script src="/js/angular-sanitize.min.js"></script>
		<script src="/js/uibootstrap/ui-bootstrap-custom-tpls-0.12.1.min.js"></script>
		<script src="/js/angular-video/js/anguvideo.js"></script>
		<!--
		<script src="/js/angular-openlayers-directive.js"></script>
		-->


	</head>
	<body>
		<div id='outer'  ng-controller='common'>
<?php		include('./modules/core/topmenu.tpl'); ?>

<?php 		include('./modules/core/mapview.tpl'); ?>
<?php		include('./modules/core/detailpane.tpl'); ?>
			<div class='clearfix'></div>
		</div>
		<script src="/apps/lkcity.js"></script>
		<script src="/filters/filter.js"></script>
		<script src="/controllers/classification.js"></script>
		<script src="/controllers/common.js"></script>
		<script src="/controllers/map.js"></script>
		<script src="/controllers/menu.js"></script>
		<script src="/controllers/details.js"></script>
		<script src="/controllers/unitstack.js"></script>
		<script src="/controllers/leveldet.js"></script>
		<script src="/controllers/edit.js"></script>
	</body>
</html>
