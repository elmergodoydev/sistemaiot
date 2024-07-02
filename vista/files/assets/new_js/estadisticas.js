

$(document).ready(function () {

  var ipress = "%";

  if (document.getElementById("cajaChartAtenciones")){

    //graficos
    graficoAtenciones(ipress);
    graficoDigitacion(ipress);

   }

});


function graficoAtenciones(ipress){

  var datos = new FormData();
  datos.append('ipress',ipress);
  datos.append('tipo','atenciones');

  $.ajax({
    url:"ajax/EstadisticaAjax.php",
    method: "POST",
    data : datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(response){

      $("#cajaChartAtenciones").html('');
      $("#cajaChartAtenciones").html('<div id="chartdiv01_h" style="height:200px"></div>');


        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv01_h");
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root),
        ]);
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(
          am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none",
            layout: root.verticalLayout
          })
        );
        


        var chart_data = [];

        for(var i = 0; i < response.length; i++)
        {
        chart_data.push({ 
        "Mes" : response[i].Fecha,
        "2020"  : parseInt(response[i].A_2020),
        "2021"  : parseInt(response[i].A_2021),
        "2022"  : parseInt(response[i].A_2022),
        });
        }
    
        
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {});
        
        var xAxis = chart.xAxes.push(
          am5xy.CategoryAxis.new(root, {
            categoryField: "Mes",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
          })
        );
        
        xRenderer.grid.template.setAll({
          location: 1
        })

        xAxis.data.setAll(chart_data);
        var yAxis = chart.yAxes.push(
          am5xy.ValueAxis.new(root, {
            min: 0,
            extraMax: 0.1,
            renderer: am5xy.AxisRendererY.new(root, {
              strokeOpacity: 0.1
            })
          })
        );
        
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        

        //series atenciones 2020
        
        var series1 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2020",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2020",
            categoryXField: "Mes",
            stroke: am5.color("#9F48DF")
          })
        );
        
        //cambiar color tooltip
        let tooltip1 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip1.get("background").setAll({
          fill: am5.color("#9F48DF"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip1.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series1.set("tooltip", tooltip1);

        series1.strokes.template.setAll({
          strokeWidth: 3,
          templateField: "strokeSettings",
          strokeDasharray: [3,3]
        });
        
        series1.data.setAll(chart_data);
        
        series1.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {
              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#9F48DF")
             
            })
          });
        });

        //colocar valor encima de la serie

        /*
        series1.bullets.push(function () {
          return am5.Bullet.new(root, {
            locationY: 0.5,
            sprite: am5.Label.new(root, {
              text: "{valueY}",
              fill: am5.color("#000"),
              centerY: am5.p100,
              centerX: am5.p50,
              populateText: true,
              background: am5.Rectangle.new(root, {
                fill: am5.color("#000"),
                fillOpacity: 0.3,
                radius: 4,
              })
              
            })
          });
        });*/


        //series atenciones 2021
      
        var series2 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2021",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2021",
            categoryXField: "Mes",
            tooltip: am5.Tooltip.new(root, {
              labelText: "{name}:   {valueY}"
            }),
            stroke: am5.color("#1776AE"),
          })
        );
        

        series2.appear();

        //cambiar color tooltip
        let tooltip2 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip2.get("background").setAll({
          fill: am5.color("#1776AE"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip2.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series2.set("tooltip", tooltip2);


        series2.strokes.template.setAll({
          strokeWidth: 2,
          strokeDasharray: [3,3]
        });
        
        series2.data.setAll(chart_data);
        
        series2.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {

              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#1776AE")
            })
          });
        });


        //series atenciones 2022
      
         var series3 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2022",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2022",
            categoryXField: "Mes",
            tooltip: am5.Tooltip.new(root, {
              labelText: "{name}:   {valueY}"
            }),
            stroke: am5.color("#fe7f2d"),
          })
        );
        

        series3.appear();

        //cambiar color tooltip
        let tooltip3 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip3.get("background").setAll({
          fill: am5.color("#fe7f2d"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip3.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series3.set("tooltip", tooltip3);


        series3.strokes.template.setAll({
          strokeWidth: 2,
          strokeDasharray: [3,3]
        });
        
        series3.data.setAll(chart_data);
        
        series3.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {
              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#fe7f2d")
            })
          });
        });

        
        
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);
        cursor.lineX.set("visible", true);
        
        // Add legend
        // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
        var legend = chart.children.push(
          am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50
          })
        );
        
        legend.data.setAll(chart.series.values);
        
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(100,100);
        series1.appear(100,100);
        series2.appear(100,100);
        series3.appear(100,100);
        
        
        // end am5.ready()

    }
  });

}


function graficoDigitacion(ipress){

  var datos2 = new FormData();

  datos2.append('ipress', ipress);
  datos2.append('tipo','digitacion');

  $.ajax({
    url:"ajax/EstadisticaAjax.php",
    method: "POST",
    data : datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(response){

      $("#cajaChartDigitacion").html('');
      $("#cajaChartDigitacion").html('<div id="chartdiv02_h" style="height:200px"></div>');
    
  

      //am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv02_h");
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root),
        ]);
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(
          am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none",
            layout: root.verticalLayout
          })
        );
        
        

        var chart_data = [];

        for(var i = 0; i < response.length; i++)
        {
        chart_data.push({ 
        "Mes" : response[i].Fecha,
        "2020"  : parseInt(response[i].A_2020),
        "2021"  : parseInt(response[i].A_2021),
        "2022"  : parseInt(response[i].A_2022),
        });
        }
    
        
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {});
        
        var xAxis = chart.xAxes.push(
          am5xy.CategoryAxis.new(root, {
            categoryField: "Mes",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
          })
        );
        
        xRenderer.grid.template.setAll({
          location: 1
        })

        xAxis.data.setAll(chart_data);
        var yAxis = chart.yAxes.push(
          am5xy.ValueAxis.new(root, {
            min: 0,
            extraMax: 0.1,
            renderer: am5xy.AxisRendererY.new(root, {
              strokeOpacity: 0.1
            })
          })
        );
        
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        

        //series atenciones 2020
        
        var series1 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2020",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2020",
            categoryXField: "Mes",
            stroke: am5.color("#27187e")
          })
        );
        
        //cambiar color tooltip
        let tooltip1 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip1.get("background").setAll({
          fill: am5.color("#27187e"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip1.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series1.set("tooltip", tooltip1);

        series1.strokes.template.setAll({
          strokeWidth: 3,
          templateField: "strokeSettings",
          strokeDasharray: [3,3]
        });
        
        series1.data.setAll(chart_data);
        
        series1.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {
              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#27187e")
             
            })
          });
        });

        //colocar valor encima de la serie

        /*
        series1.bullets.push(function () {
          return am5.Bullet.new(root, {
            locationY: 0.5,
            sprite: am5.Label.new(root, {
              text: "{valueY}",
              fill: am5.color("#000"),
              centerY: am5.p100,
              centerX: am5.p50,
              populateText: true,
              background: am5.Rectangle.new(root, {
                fill: am5.color("#000"),
                fillOpacity: 0.3,
                radius: 4,
              })
              
            })
          });
        });*/


        //series atenciones 2021
      
        var series2 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2021",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2021",
            categoryXField: "Mes",
            tooltip: am5.Tooltip.new(root, {
              labelText: "{name}:   {valueY}"
            }),
            stroke: am5.color("#758bfd"),
          })
        );
        

        series2.appear();

        //cambiar color tooltip
        let tooltip2 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip2.get("background").setAll({
          fill: am5.color("#758bfd"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip2.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series2.set("tooltip", tooltip2);


        series2.strokes.template.setAll({
          strokeWidth: 2,
          strokeDasharray: [3,3]
        });
        
        series2.data.setAll(chart_data);
        
        series2.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {

              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#758bfd")
            })
          });
        });


        //series atenciones 2022
      
         var series3 = chart.series.push(
          am5xy.LineSeries.new(root, {
            name: "Año 2022",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "2022",
            categoryXField: "Mes",
            tooltip: am5.Tooltip.new(root, {
              labelText: "{name}:   {valueY}"
            }),
            stroke: am5.color("#0fa3b1"),
          })
        );
        

        series3.appear();

        //cambiar color tooltip
        let tooltip3 = am5.Tooltip.new(root, {
          autoTextColor: false,
          getFillFromSprite: false,
          labelText: "{name}:   {valueY}",
        });

        tooltip3.get("background").setAll({
          fill: am5.color("#0fa3b1"),
          fillOpacity: 0.8,
          stroke: am5.color("#ffffff"),
          strokeOpacity: 0.8
        });

        tooltip3.label.setAll({
          fill: am5.color("#ffffff")
        });
        
        series3.set("tooltip", tooltip3);


        series3.strokes.template.setAll({
          strokeWidth: 2,
          strokeDasharray: [3,3]
        });
        
        series3.data.setAll(chart_data);
        
        series3.bullets.push(function() {
          return am5.Bullet.new(root, {
            sprite: am5.Circle.new(root, {
              strokeWidth: 1,
              fill: series1.get("fill"),
              radius: 4,
              fill: am5.color("#0fa3b1")
            })
          });
        });



        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);
        cursor.lineX.set("visible", true);
        
        // Add legend
        // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
        var legend = chart.children.push(
          am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50
          })
        );
        
        legend.data.setAll(chart.series.values);
        
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(100,100);
        series1.appear(100,100);
        series2.appear(100,100);
        series3.appear(100,100);
        //}); end am5.ready()

    }
  });


}


//select combobox eess fua anulado (traer todos)
var datos_eess_panel_inicio = new FormData();
datos_eess_panel_inicio.append('tipo','solo_eess');
$.ajax({
    url: "ajax/EstablecimientoAjax.php",
    method : "POST",
    data: datos_eess_panel_inicio,
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
        $.each(response, function(indice, fila){
            $('#select_eess_historico').append("<option value = '"+fila.RENAES+"' ipress='"+fila.EESS+"'>"+fila.EESS+"</option>");
        });

    $("#select_eess_historico").select2({
        //dropdownParent: $('#actividad-digitador-Modal .modal-body'),
        tags: true,
        width: '100%',
        theme: "bootstrap4",
    
    });

    }
});


$("#select_eess_historico").change(function (e) { 
  e.preventDefault();

  var ipress = $("#select_eess_historico").val();
  
  if(ipress == '%'){
    $(".ipress_inicio").html("DIRIS LIMA NORTE");
  }else{
    var seleccion= $('#select_eess_historico>option:selected').attr('ipress');

    $(".ipress_inicio").html(seleccion);
  }
  


  graficoAtenciones(ipress);
  graficoDigitacion(ipress);
  //cambiar fuas anulados
  

});


//=================codigo para seccion de indicadores

