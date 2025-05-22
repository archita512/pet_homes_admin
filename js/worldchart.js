am5.ready(function() {

    var continents = {
      "AF": 0,
      "AN": 1,
      "AS": 2,
      "EU": 3,
      "NA": 4,
      "OC": 5,
      "SA": 6
    }
    
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");
    var colors = am5.ColorSet.new(root, {});
    
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    
    // Create the map chart
    // https://www.amcharts.com/docs/v5/charts/map-chart/
    var chart = root.container.children.push(am5map.MapChart.new(root, {
      panX: "rotateX",
      projection: am5map.geoMercator()
    }));
    
    
    // Create polygon series for the world map
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
    var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
      geoJSON: am5geodata_worldLow,
      exclude: ["AQ"]
    }));
    
    worldSeries.mapPolygons.template.setAll({
      tooltipText: "{name}",
      interactive: true,
      fill: am5.color(0xaaaaaa),
      templateField: "polygonSettings"
    });
    
    worldSeries.mapPolygons.template.states.create("hover", {
      fill: colors.getIndex(9)
    });
    
    worldSeries.mapPolygons.template.events.on("click", (ev) => {
      var dataItem = ev.target.dataItem;
      var data = dataItem.dataContext;
      var zoomAnimation = worldSeries.zoomToDataItem(dataItem);
    
      Promise.all([
        zoomAnimation.waitForStop(),
        am5.net.load("https://cdn.amcharts.com/lib/5/geodata/json/" + data.map + ".json", chart)
      ]).then((results) => {
        var geodata = am5.JSONParser.parse(results[1].response);
        countrySeries.setAll({
          geoJSON: geodata,
          fill: data.polygonSettings.fill
        });
    
        countrySeries.show();
        worldSeries.hide(100);
        backContainer.show();
      });
    });
    
    // Create polygon series for the country map
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
    var countrySeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
      visible: false
    }));
    
    countrySeries.mapPolygons.template.setAll({
      tooltipText: "{name}",
      interactive: true,
      fill: am5.color(0xaaaaaa)
    });
    
    countrySeries.mapPolygons.template.states.create("hover", {
      fill: colors.getIndex(9)
    });
    
    
    // Set up data for countries
    var data = [];
    for(var id in am5geodata_data_countries2) {
      if (am5geodata_data_countries2.hasOwnProperty(id)) {
        var country = am5geodata_data_countries2[id];
        if (country.maps.length) {
          data.push({
            id: id,
            map: country.maps[0],
            polygonSettings: {
              fill: colors.getIndex(continents[country.continent_code]),
            }
          });
        }
      }
    }
    worldSeries.data.setAll(data);
    
    
    // Add button to go back to continents view
    var backContainer = chart.children.push(am5.Container.new(root, {
      x: am5.p100,
      centerX: am5.p100,
      dx: -10,
      paddingTop: 5,
      paddingRight: 10,
      paddingBottom: 5,
      y: 30,
      interactiveChildren: false,
      layout: root.horizontalLayout,
      cursorOverStyle: "pointer",
      background: am5.RoundedRectangle.new(root, {
        fill: am5.color(0xffffff),
        fillOpacity: 0.2
      }),
      visible: false
    }));
    
    root._logo.dispose();
    backContainer.events.on("click", function() {
      chart.goHome();
      worldSeries.show();
      countrySeries.hide();
      backContainer.hide();
    });
    
    }); // end am5.ready()