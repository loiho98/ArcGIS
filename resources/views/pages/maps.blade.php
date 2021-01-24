<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>
        Tra Vinh Province
    </title>
    <link rel="stylesheet" href="https://js.arcgis.com/4.16/esri/themes/dark/main.css" />
    <script src="https://js.arcgis.com/4.16/"></script>
    <style>
        html,
        body,
        #viewDiv {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }

        #info {
            padding: 10px;
            border-radius: 5px;
            width: auto;
            cursor: grab;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 18%;
        }

        .sublayers {
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .sublayers-item {
            flex-grow: 4;
            background-color: #E6E6E6;
            color: black;
            margin: 1px;
            width: 50%;
            padding: 10px;
            overflow: auto;
            text-align: center;
            cursor: -webkit-grabbing;
            font-size: 0.9em;
        }

        .visible-layer {
            color: #ffffff;
            background-color: darkmagenta;
        }

    </style>
    <script>
        require([
            "esri/Map"
            , "esri/layers/MapImageLayer"
            , "esri/layers/FeatureLayer"
            , "esri/widgets/Editor"
            , "esri/views/MapView"
            , "esri/popup/content/AttachmentsContent"
            , "esri/popup/content/TextContent"
            , "esri/widgets/Search"
            , "esri/widgets/Legend"
        , ], function(
            Map
            , MapImageLayer
            , FeatureLayer
            , Editor
            , MapView
            , AttachmentsContent
            , TextContent
            , Search
            , Legend
        ) {
            let editor, features;
            const renderer = {
                type: "unique-value"
                , field: "Loai"
                , uniqueValueInfos: [{
                    value: "1"
                    , symbol: {
                        type: "picture-marker"
                        , url: "https://cdn0.iconfinder.com/data/icons/education-vol-01-3/48/school-college-university-graduation-pin-location-marker-512.png"
                        , width: "25px"
                        , height: "25px"
                    }
                }, {
                    value: "2"
                    , symbol: {
                        type: "picture-marker"
                        , url: "https://upload.wikimedia.org/wikipedia/commons/1/18/Hospital_pointer.png"
                        , width: "25px"
                        , height: "25px"
                    }
                }]

            };
            var layer = new MapImageLayer({
                url: "https://localhost:6443/arcgis/rest/services/TraVinh/MapServer"
                , sublayers: [{
                        id: 2
                        , visible: true
                    }
                    , {
                        id: 1
                        , visible: true
                    }
                ]
            });
            const map = new Map({
                basemap: "streets"
                , layers: [layer]
            });
            const editThisAction = {
                title: "Editor"
                , id: "edit-this"
                , className: "esri-icon-edit"
            };
            const openEdit = {
                title: "Edit Page"
                , id: "edit-page"
                , className: "esri-icon-table"
            };

            const template = {
                title: "{name}."
                , actions: [editThisAction, openEdit]
            };
            let featureLayer = new FeatureLayer({
                url: "https://localhost:6443/arcgis/rest/services/TraVinh/FeatureServer/0"
                , outFields: ["*"]
                , visible: true
                , popupTemplate: template
                , renderer: renderer
            });
            map.add(featureLayer, 2);
            layer.when(function() {
                layer.sublayers.map(function(sublayer) {
                    var id = sublayer.id;
                    var visible = sublayer.visible;
                    var node = document.querySelector(
                        ".sublayers-item[data-id='" + id + "']"
                    );
                    if (visible) {
                        node.classList.add("visible-layer");
                    }
                });
            });
            featureLayer.when(function() {
                var fvis = featureLayer.visible;
                var node = document.querySelector(
                    ".sublayers-item[data-id='" + 0 + "']"
                );
                if (fvis) {
                    node.classList.add("visible-layer");
                };
            })
            const view = new MapView({
                container: "viewDiv"
                , map: map
                , zoom: 12
                , center: [106.271430, 9.792982]
            });

            view.when(function() {
                editor = new Editor({
                    view: view
                    , container: document.createElement("div")
                    , allowedWorkflows: ["update"]
                    , layerInfos: [{
                        layer: featureLayer
                        , fieldConfig: [{
                                name: "name"
                                , label: "Tên"
                            }
                            , {
                                name: "loai"
                                , label: "Loại địa điểm"
                            }

                        ]
                    }]
                });
                var edit = document.getElementById("info");
                var count = 0;

                function editThis() {
                    if (++count % 2 == 1) {
                        if (!editor.viewModel.activeWorkFlow) {
                            edit.innerHTML = "Stop Edit";
                            view.popup.close();
                            editor.viewModel.startUpdateWorkflowAtFeatureSelection();
                            view.ui.add(editor, {
                                position: "top-right"
                                , index: 1
                            });
                        }
                    } else {
                        edit.innerHTML = "Start Edit";
                        view.ui.remove(editor);
                        editor.viewModel.cancelWorkflow();
                    }
                };

                function editPage() {
                    console.log(view.popup.selectedFeature.attributes);
                    var url = "edit/" + view.popup.selectedFeature.attributes.objectid + "/" + view.popup.selectedFeature.attributes.name + "/" + view.popup.selectedFeature.attributes.loai;
                    window.open(url);
                };
                view.popup.on("trigger-action", function(event) {
                    if (event.action.id === "edit-this") {
                        editThis();
                    }
                    if (event.action.id === "edit-page") {
                        editPage();
                    }
                });
                edit.addEventListener("click", function(event) {
                    if (event.button == 0) {
                        editThis();
                    }

                });
                // featureLayer.on("apply-edits", function() {
                //     view.popup.open({features:view.popup.sele});
                // });
            })
            var countAdd = 0;
            var addFeature = new Editor({
                view: view
                , container: document.createElement("div")
                , allowedWorkflows: ["create"]
                , layerInfos: [{
                    layer: featureLayer
                    , fieldConfig: [{
                            name: "name"
                            , label: "Tên"
                        }
                        , {
                            name: "loai"
                            , label: "Loại địa điểm"
                        }

                    ]
                }]
            });
            view.on("click", function(event) {
                if (event.button == 2 && !addFeature.viewModel.activeWorkFlow) {
                    if (++countAdd % 2 == 1) {
                        alert("Nhấp phải lần nữa để thoát!");
                        addFeature.viewModel.startCreateWorkflowAtFeatureTypeSelection();
                        view.ui.add(addFeature, "top-right");
                        console.log(countAdd);
                    } else {
                        view.ui.remove(addFeature);
                        addFeature.viewModel.cancelWorkflow();
                    }

                }
            });
            const searchWidget = new Search({
                view: view
                , sources: []
            });
            const sources = [{
                    layer: new FeatureLayer({
                        url: "https://localhost:6443/arcgis/rest/services/TraVinh/FeatureServer/0"
                        , outFields: ["*"]
                    })
                    , searchFields: ["name"]
                    , displayField: "name"
                    , exactMatch: false
                    , outFields: ["*"]
                    , name: "Địa Điểm"
                    , placeholder: "Ví dụ: BV ĐK"
                    , maxResults: 6
                    , maxSuggestions: 6
                    , suggestionsEnabled: true
                    , minSuggestCharacters: 0
                }
                , {
                    layer: new FeatureLayer({
                        url: "https://localhost:6443/arcgis/rest/services/TraVinh/FeatureServer/1"
                        , outFields: ["*"]
                    })
                    , searchFields: ["name_3"]
                    , displayField: "name_3"
                    , exactMatch: false
                    , outFields: ["*"]
                    , name: "Xã"
                    , placeholder: "Ví dụ: Long Toàn"
                    , maxResults: 6
                    , maxSuggestions: 6
                    , suggestionsEnabled: true
                    , minSuggestCharacters: 0
                }
                , {
                    layer: new FeatureLayer({
                        url: "https://localhost:6443/arcgis/rest/services/TraVinh/FeatureServer/2"
                        , outFields: ["*"]
                    })
                    , searchFields: ["name_2"]
                    , displayField: "name_2"
                    , exactMatch: false
                    , outFields: ["*"]
                    , name: "Huyện"
                    , placeholder: "Ví dụ: Duyên Hải"
                    , maxResults: 6
                    , maxSuggestions: 6
                    , suggestionsEnabled: true
                    , minSuggestCharacters: 0
                }
            ];
            searchWidget.sources = sources;
            view.ui.add(searchWidget, {
                position: "top-right"
                , index: 1
            });
            var sublayersElement = document.querySelector(".sublayers");
            sublayersElement.addEventListener("click", function(event) {
                var id = event.target.getAttribute("data-id");
                if (id == 0) {
                    featureLayer.visible = !featureLayer.visible;
                    var node = document.querySelector(
                        ".sublayers-item[data-id='" + 0 + "']"
                    );
                    node.classList.toggle("visible-layer");
                } else
                if (id) {
                    var sublayer = layer.findSublayerById(parseInt(id));
                    var node = document.querySelector(
                        ".sublayers-item[data-id='" + id + "']"
                    );
                    sublayer.visible = !sublayer.visible;
                    node.classList.toggle("visible-layer");
                }
            });
            view.ui.add("info", {
                position: "top-right"
                , index: 1
            });

            var legend = new Legend({
            view: view,
            layerInfos: [
              {
                layer: featureLayer,
                title: "Chú thích:"
              }
            ]
          });

          // Add widget to the bottom right corner of the view
          view.ui.add(legend, "bottom-right");


        });

    </script>
</head>
<body>
    <div id="viewDiv"></div>
    <div id="info" class="esri-widget">
        Start Edit
    </div>
    <div class="footer">
        <div class="sublayers esri-widget">
            <div class="sublayers-item" data-id="2">Huyện</div>
            <div class="sublayers-item" data-id="1">Xã</div>
            <div class="sublayers-item" data-id="0">Địa điểm</div>
        </div>
    </div>
</body>
</html>
