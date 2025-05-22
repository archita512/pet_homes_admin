am5.ready(function () {
    // Create root element
    var root = am5.Root.new("PieChart");
  
    // Set themes
    root.setThemes([am5themes_Animated.new(root)]);
  
    // Create chart
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        layout: root.verticalLayout,
        innerRadius: am5.percent(50),
      })
    );
  
    // Create series
    var series = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "value",
        categoryField: "category",
        alignLabels: true,
        radius: am5.percent(90),
      })
    );
  
    // Configure labels with connecting lines
    series.labels.template.setAll({
      textType: "regular",
      radius: 30,
      text: "{category}\n{value}",
      fill: am5.color(0x000000),
      fontSize: 12,
      fontWeight: "400",
      lineHeight: 1.2,
      oversizedBehavior: "wrap",
    });
  
    series.ticks.template.setAll({
      forceHidden: false,
      stroke: am5.color(0x000000),
      strokeOpacity: 0.5,
      strokeDasharray: [],
    });
  
    // Set custom colors
    series.set(
      "colors",
      am5.ColorSet.new(root, {
        colors: [
          am5.color(0x5b9a8b), // Dog - teal
          am5.color(0x2a4365), // Cat - navy blue
          am5.color(0x4a5568), // Birds - slate
          am5.color(0xb83280), // Fish - purple
          am5.color(0xecc94b), // Horse - yellow
        ],
      })
    );
  
    // Add value inside the donut
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p50,
        centerX: am5.p50,
        text: "357",
        fontSize: 30,
        fontWeight: "500",
      })
    );
  
    // Set data
    series.data.setAll([
      { value: 93, category: "Dog" },
      { value: 85, category: "Cat" },
      { value: 53, category: "Birds" },
      { value: 43, category: "Fish" },
      { value: 26, category: "Horse" },
    ]);
  
    // Create legend
    var legend = chart.children.push(
      am5.Legend.new(root, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        marginTop: 15,
        marginBottom: 15,
        layout: root.horizontalLayout,
        nameField: "category"
      })
    );
  
    // Configure legend items
    legend.itemContainers.template.setAll({
      paddingLeft: 5,
      paddingRight: 5,
    });
  
    // Critical fix: Disable percentage labels in the legend
    legend.labels.template.setAll({
      fontSize: 12,
      fontWeight: "400",
      text: "{category}"
    });
    
    // Hide the value labels completely
    legend.valueLabels.template.setAll({
      forceHidden: true
    });
    
    // Disable the legend markers from showing percentages
    legend.markerRectangles.template.setAll({
      cornerRadiusTL: 0,
      cornerRadiusTR: 0,
      cornerRadiusBR: 0,
      cornerRadiusBL: 0
    });
  
    // Disable tooltips
    series.slices.template.set("tooltipText", "");
  
    // Remove amCharts logo
    root._logo.dispose();
  
    // Set legend data from series
    legend.data.setAll(series.dataItems);
  
    // Play initial series animation
    series.appear(1000, 100);
  });