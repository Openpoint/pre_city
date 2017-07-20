var blur = $('#blur');
var radius = $('#radius');

var vector = new ol.layer.Heatmap({
  source: new ol.source.KML({
    extractStyles: false,
    projection: 'EPSG:3857',
    url: 'data/kml/2012_Earthquakes_Mag5.kml'
  }),
  blur: parseInt(blur.val(), 10),
  radius: parseInt(radius.val(), 10)
});

vector.getSource().on('addfeature', function(event) {
  // 2012_Earthquakes_Mag5.kml stores the magnitude of each earthquake in a
  // standards-violating <magnitude> tag in each Placemark.  We extract it from
  // the Placemark's name instead.
  var name = event.feature.get('name');
  var magnitude = parseFloat(name.substr(2));
  event.feature.set('weight', magnitude - 5);
});

var raster = new ol.layer.Tile({
  source: new ol.source.Stamen({
    layer: 'toner'
  })
});

var map = new ol.Map({
  layers: [raster, vector],
  target: 'map',
  view: new ol.View({
    center: [0, 0],
    zoom: 2
  })
});


blur.on('input', function() {
  vector.setBlur(parseInt(blur.val(), 10));
});

radius.on('input', function() {
  vector.setRadius(parseInt(radius.val(), 10));
});
