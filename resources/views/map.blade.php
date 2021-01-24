<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>ArcGIS JavaScript API: TraVinh</title>
<style type="text/css">
@import "https://js.arcgis.com/3.15/dijit/themes/tundra/tundra.css";
@import "https://js.arcgis.com/3.15/esri/css/esri.css";
@import "/arcgis/rest/static/jsapi.css";
</style>
<script type="text/javascript" src="https://js.arcgis.com/3.15/init.js"></script>
<script type="text/javascript">
require([
"esri/layers/ArcGISDynamicMapServiceLayer",
"esri/layers/ArcGISTiledMapServiceLayer",
"esri/map",
"dojo/parser",
"dojo/domReady!",
"dijit/layout/BorderContainer",
"dijit/layout/ContentPane"
], function(ArcGISDynamicMapServiceLayer, ArcGISTiledMapServiceLayer, Map, parser){
      parser.parse();
      var map = new Map("map");
      var layer;
              layer = new ArcGISDynamicMapServiceLayer("https://localhost:6443/arcgis/rest/services/TraVinh/MapServer");
            map.addLayer(layer);
    });
</script> </head> <body class="tundra"> <div data-dojo-type="dijit/layout/BorderContainer" design="headline" gutters="true"
style="width: 100%; height: 100%; margin: 0;">
<div data-dojo-type="dijit/layout/ContentPane" region="top" id="navtable">
<div style="float:left;" id="breadcrumbs">ArcGIS JavaScript API: TraVinh</div>
<div style="float:right;" id="help">
Built using the <a href="https://help.arcgis.com/en/webapi/javascript/arcgis/">ArcGIS JavaScript API</a>
</div>
</div> <div id="map" data-dojo-type="dijit/layout/ContentPane" region="center">
</div> </div> </body>
</html>
