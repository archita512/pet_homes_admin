am5.ready(function () {
  // Create root element
  var root = am5.Root.new("SmoothedLineChart");

  // Set themes
  root.setThemes([am5themes_Animated.new(root)]);

  // Create chart
  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      panX: true,
      panY: true,
      wheelX: "panX",
      wheelY: "zoomX",
      pinchZoomX: true,
      paddingLeft: 0,
      layout: root.verticalLayout,
    })
  );

  // Add cursor
  var cursor = chart.set(
    "cursor",
    am5xy.XYCursor.new(root, {
      behavior: "none",
    })
  );
  cursor.lineY.set("visible", false);

  // Create data
  var data = [
    { month: "January", value: 68 },
    { month: "February", value: 18 },
    { month: "March", value: 32 },
    { month: "April", value: 20 },
    { month: "May", value: 41 },
    { month: "June", value: 10 },
    { month: "July", value: 57 },
    { month: "August", value: 15 },
    { month: "September", value: 57 },
    { month: "October", value: 52 },
    { month: "November", value: 92 },
    { month: "December", value: 42 },
  ];

  // Create axes
  var xAxis = chart.xAxes.push(
    am5xy.CategoryAxis.new(root, {
      categoryField: "month",
      renderer: am5xy.AxisRendererX.new(root, {
        minGridDistance: 30,
        cellStartLocation: 0.1,
        cellEndLocation: 0.9,
      }),
      tooltip: am5.Tooltip.new(root, {}),
    })
  );

  xAxis.data.setAll(data);

  var yAxis = chart.yAxes.push(
    am5xy.ValueAxis.new(root, {
      min: 0,
      max: 100,
      strictMinMax: true,
      renderer: am5xy.AxisRendererY.new(root, {}),
    })
  );

  // Add grid
  xAxis.get("renderer").grid.template.setAll({
    stroke: am5.color(0xdddddd),
    strokeWidth: 1,
    strokeDasharray: [2, 2],
  });

  yAxis.get("renderer").grid.template.setAll({
    stroke: am5.color(0xdddddd),
    strokeWidth: 1,
    strokeDasharray: [2, 2],
  });

  // Add series
  var series = chart.series.push(
    am5xy.SmoothedXLineSeries.new(root, {
      name: "Adoption Rate",
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      categoryXField: "month",
      tooltip: am5.Tooltip.new(root, {
        labelText: "{valueY}",
      }),
    })
  );

  // Set custom colors
  series.set("stroke", am5.color(0x976239));

  var gradient = am5.LinearGradient.new(root, {
    stops: [
      { color: am5.color(0x976239), offset: 0 },
      { color: am5.color(0x976239), offset: 0, opacity: 0.7 },
      { color: am5.color(0xffffff), offset: 1, opacity: 0 },
    ],
    rotation: 90,
  });

  // Configure fill gradient
  series.strokes.template.setAll({
    stroke: am5.color(0x976239),
    strokeWidth: 2,
  });
  series.fills.template.setAll({
    visible: true,
    fillGradient: gradient,
    fillOpacity: 1,
  });
  // Add bullets
  series.bullets.push(function () {
    var container = am5.Container.new(root, {});
    
    // Create outer shadow/halo circle
    var shadowCircle = container.children.push(
      am5.Circle.new(root, {
        radius: 8,
        fill: am5.color(0xE6D7C3),
        fillOpacity: 1
      })
    );
    
    // Create inner circle (the actual dot)
    var mainCircle = container.children.push(
      am5.Circle.new(root, {
        radius: 4,
        fill: am5.color(0x976239),
        stroke: am5.color(0x976239),
        strokeWidth: 1
      })
    );
    
    return am5.Bullet.new(root, {
      locationY: 0,
      sprite: container
    });
  });

  // Remove amCharts logo
  root._logo.dispose();

  // Set data
  series.data.setAll(data);

  // Make chart responsive
  chart.set("responsive", {
    enabled: true,
    rules: [
      {
        relevant: function (width, height) {
          return width < 500;
        },
        apply: function (target) {
          xAxis.get("renderer").labels.template.setAll({
            rotation: -45,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15,
          });
        },
      },
    ],
  });

  // Make stuff animate on load
  series.appear(1000);
  chart.appear(1000, 100);
});
