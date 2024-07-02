


 (function ( ) {

       //conectandose al archivo DatosAjax que envia los registros de la base de datos
 let datos = new FormData();
 datos.append("controlador","1");
 datos.append("tipoDato","datos_carga_inicial");

 fetch("ajax/DatosAjax.php",{
   method: 'POST',
   body: datos
 })
 .then((res)=>{
   return res.json();
 })
 .then((json)=>{

    //console.log(json);
    // On chart load, start an interval that adds points to the chart and animate
    // the pulsating marker.
    const onChartLoad = function () {
        const chart = this,
            series = chart.series[0];

        setInterval(function () {

            let datos = new FormData();
            datos.append("controlador","1");
            datos.append("tipoDato","ultimo_dato_live");

            
            fetch("ajax/DatosAjax.php",{
            method: 'POST',
            body: datos
            })
            .then((res)=>{
            return res.json();
            })
            .then((json)=>{
                //console.log(json);

                const x = parseInt(json.fecha,10) * 1000, // current time
                y = parseInt(json.temperatura,10);

                series.addPoint([x, y], true, true);

            });



        }, 1000);
    };


    // Create the initial data

        const data = (function () {

            const d = [];

            for (let i = 0; i < 20; i++) {       
                d.push({
                    x: parseInt(json[i].fecha,10) * 1000,
                    y: parseInt(json[i].temperatura,10)
                });
            }

            return d;

        }());


        // Plugin to add a pulsating marker on add point
        Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
            const point = e.point,
                series = e.target;

            if (!series.pulse) {
                series.pulse = series.chart.renderer.circle()
                    .add(series.markerGroup);
            }

            setTimeout(() => {
                series.pulse
                    .attr({
                        x: series.xAxis.toPixels(point.x, true),
                        y: series.yAxis.toPixels(point.y, true),
                        r: series.options.marker.radius,
                        opacity: 1,
                        fill: series.color
                    })
                    .animate({
                        r: 20,
                        opacity: 0
                    }, {
                        duration: 1000
                    });
            }, 1);
        });


        Highcharts.chart('container', {
            chart: {
                type: 'spline',
                events: {
                    load: onChartLoad
                }
            },
        
            time: {
                useUTC: false
            },
        
            title: {
                text: 'Datos Tiempo Real'
            },
        
            accessibility: {
                announceNewData: {
                    enabled: true,
                    minAnnounceInterval: 15000,
                    announcementFormatter: function (allSeries, newSeries, newPoint) {
                        if (newPoint) {
                            return 'New point added. Value: ' + newPoint.y;
                        }
                        return false;
                    }
                }
            },
        
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxPadding: 0.1
            },
        
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [
                    {
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }
                ]
            },
        
            tooltip: {
                headerFormat: '<b>{series.name}</b><br/>',
                pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
            },
        
            legend: {
                enabled: false
            },
        
            exporting: {
                enabled: false
            },
        
            series: [
                {
                    name: 'Temperatura',
                    lineWidth: 2,
                    color: Highcharts.getOptions().colors[2],
                    data
                }
            ]
        });
        

    });

}) ( );


(function ( ) {

    //conectandose al archivo DatosAjax que envia los registros de la base de datos
let datos = new FormData();
datos.append("controlador","2");
datos.append("tipoDato","datos_carga_inicial");

fetch("ajax/DatosAjax.php",{
method: 'POST',
body: datos
})
.then((res)=>{
return res.json();
})
.then((json)=>{

 //console.log(json);
 // On chart load, start an interval that adds points to the chart and animate
 // the pulsating marker.
 const onChartLoad = function () {
     const chart = this,
         series = chart.series[0];

     setInterval(function () {

         let datos = new FormData();
         datos.append("controlador","2");
         datos.append("tipoDato","ultimo_dato_live");

         
         fetch("ajax/DatosAjax.php",{
         method: 'POST',
         body: datos
         })
         .then((res)=>{
         return res.json();
         })
         .then((json)=>{
             //console.log(json);

             const x = parseInt(json.fecha,10) * 1000, // current time
             y = parseInt(json.temperatura,10);

             series.addPoint([x, y], true, true);

         });



     }, 1000);
 };


 // Create the initial data

     const data = (function () {

         const d = [];

         for (let i = 0; i < 20; i++) {       
             d.push({
                 x: parseInt(json[i].fecha,10) * 1000,
                 y: parseInt(json[i].temperatura,10)
             });
         }

         return d;

     }());


     // Plugin to add a pulsating marker on add point
     Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
         const point = e.point,
             series = e.target;

         if (!series.pulse) {
             series.pulse = series.chart.renderer.circle()
                 .add(series.markerGroup);
         }

         setTimeout(() => {
             series.pulse
                 .attr({
                     x: series.xAxis.toPixels(point.x, true),
                     y: series.yAxis.toPixels(point.y, true),
                     r: series.options.marker.radius,
                     opacity: 1,
                     fill: series.color
                 })
                 .animate({
                     r: 20,
                     opacity: 0
                 }, {
                     duration: 1000
                 });
         }, 1);
     });


     Highcharts.chart('container2', {
         chart: {
             type: 'spline',
             events: {
                 load: onChartLoad
             }
         },
     
         time: {
             useUTC: false
         },
     
         title: {
             text: 'Datos Tiempo Real'
         },
     
         accessibility: {
             announceNewData: {
                 enabled: true,
                 minAnnounceInterval: 15000,
                 announcementFormatter: function (allSeries, newSeries, newPoint) {
                     if (newPoint) {
                         return 'New point added. Value: ' + newPoint.y;
                     }
                     return false;
                 }
             }
         },
     
         xAxis: {
             type: 'datetime',
             tickPixelInterval: 150,
             maxPadding: 0.1
         },
     
         yAxis: {
             title: {
                 text: 'Value'
             },
             plotLines: [
                 {
                     value: 0,
                     width: 1,
                     color: '#808080'
                 }
             ]
         },
     
         tooltip: {
             headerFormat: '<b>{series.name}</b><br/>',
             pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
         },
     
         legend: {
             enabled: false
         },
     
         exporting: {
             enabled: false
         },
     
         series: [
             {
                 name: 'Temperatura',
                 lineWidth: 2,
                 color: Highcharts.getOptions().colors[2],
                 data
             }
         ]
     });
     

 });

}) ( );


(function ( ) {

    //conectandose al archivo DatosAjax que envia los registros de la base de datos
let datos = new FormData();
datos.append("controlador","3");
datos.append("tipoDato","datos_carga_inicial");

fetch("ajax/DatosAjax.php",{
method: 'POST',
body: datos
})
.then((res)=>{
return res.json();
})
.then((json)=>{

 //console.log(json);
 // On chart load, start an interval that adds points to the chart and animate
 // the pulsating marker.
 const onChartLoad = function () {
     const chart = this,
         series = chart.series[0];

     setInterval(function () {

         let datos = new FormData();
         datos.append("controlador","3");
         datos.append("tipoDato","ultimo_dato_live");

         
         fetch("ajax/DatosAjax.php",{
         method: 'POST',
         body: datos
         })
         .then((res)=>{
         return res.json();
         })
         .then((json)=>{
             //console.log(json);

             const x = parseInt(json.fecha,10) * 1000, // current time
             y = parseInt(json.temperatura,10);

             series.addPoint([x, y], true, true);

         });



     }, 2000);
 };


 // Create the initial data

     const data = (function () {

         const d = [];

         for (let i = 0; i < 20; i++) {       
             d.push({
                 x: parseInt(json[i].fecha,10) * 1000,
                 y: parseInt(json[i].temperatura,10)
             });
         }

         return d;

     }());


     // Plugin to add a pulsating marker on add point
     Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
         const point = e.point,
             series = e.target;

         if (!series.pulse) {
             series.pulse = series.chart.renderer.circle()
                 .add(series.markerGroup);
         }

         setTimeout(() => {
             series.pulse
                 .attr({
                     x: series.xAxis.toPixels(point.x, true),
                     y: series.yAxis.toPixels(point.y, true),
                     r: series.options.marker.radius,
                     opacity: 1,
                     fill: series.color
                 })
                 .animate({
                     r: 20,
                     opacity: 0
                 }, {
                     duration: 1000
                 });
         }, 1);
     });


     Highcharts.chart('container3', {
         chart: {
             type: 'spline',
             events: {
                 load: onChartLoad
             }
         },
     
         time: {
             useUTC: false
         },
     
         title: {
             text: 'Datos Tiempo Real'
         },
     
         accessibility: {
             announceNewData: {
                 enabled: true,
                 minAnnounceInterval: 15000,
                 announcementFormatter: function (allSeries, newSeries, newPoint) {
                     if (newPoint) {
                         return 'New point added. Value: ' + newPoint.y;
                     }
                     return false;
                 }
             }
         },
     
         xAxis: {
             type: 'datetime',
             tickPixelInterval: 150,
             maxPadding: 0.1
         },
     
         yAxis: {
             title: {
                 text: 'Value'
             },
             plotLines: [
                 {
                     value: 0,
                     width: 1,
                     color: '#808080'
                 }
             ]
         },
     
         tooltip: {
             headerFormat: '<b>{series.name}</b><br/>',
             pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
         },
     
         legend: {
             enabled: false
         },
     
         exporting: {
             enabled: false
         },
     
         series: [
             {
                 name: 'Temperatura',
                 lineWidth: 2,
                 color: Highcharts.getOptions().colors[2],
                 data
             }
         ]
     });
     

 });

}) ( );



(function ( ) {

    //conectandose al archivo DatosAjax que envia los registros de la base de datos
let datos = new FormData();
datos.append("controlador","4");
datos.append("tipoDato","datos_carga_inicial");

fetch("ajax/DatosAjax.php",{
method: 'POST',
body: datos
})
.then((res)=>{
return res.json();
})
.then((json)=>{

 //console.log(json);
 // On chart load, start an interval that adds points to the chart and animate
 // the pulsating marker.
 const onChartLoad = function () {
     const chart = this,
         series = chart.series[0];

     setInterval(function () {

         let datos = new FormData();
         datos.append("controlador","4");
         datos.append("tipoDato","ultimo_dato_live");

         
         fetch("ajax/DatosAjax.php",{
         method: 'POST',
         body: datos
         })
         .then((res)=>{
         return res.json();
         })
         .then((json)=>{
             //console.log(json);

             const x = parseInt(json.fecha,10) * 1000, // current time
             y = parseInt(json.temperatura,10);

             series.addPoint([x, y], true, true);

         });



     }, 1000);
 };


 // Create the initial data

     const data = (function () {

         const d = [];

         for (let i = 0; i < 20; i++) {       
             d.push({
                 x: parseInt(json[i].fecha,10) * 1000,
                 y: parseInt(json[i].temperatura,10)
             });
         }

         return d;

     }());


     // Plugin to add a pulsating marker on add point
     Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
         const point = e.point,
             series = e.target;

         if (!series.pulse) {
             series.pulse = series.chart.renderer.circle()
                 .add(series.markerGroup);
         }

         setTimeout(() => {
             series.pulse
                 .attr({
                     x: series.xAxis.toPixels(point.x, true),
                     y: series.yAxis.toPixels(point.y, true),
                     r: series.options.marker.radius,
                     opacity: 1,
                     fill: series.color
                 })
                 .animate({
                     r: 20,
                     opacity: 0
                 }, {
                     duration: 1000
                 });
         }, 1);
     });


     Highcharts.chart('container4', {
         chart: {
             type: 'spline',
             events: {
                 load: onChartLoad
             }
         },
     
         time: {
             useUTC: false
         },
     
         title: {
             text: 'Datos Tiempo Real'
         },
     
         accessibility: {
             announceNewData: {
                 enabled: true,
                 minAnnounceInterval: 15000,
                 announcementFormatter: function (allSeries, newSeries, newPoint) {
                     if (newPoint) {
                         return 'New point added. Value: ' + newPoint.y;
                     }
                     return false;
                 }
             }
         },
     
         xAxis: {
             type: 'datetime',
             tickPixelInterval: 150,
             maxPadding: 0.1
         },
     
         yAxis: {
             title: {
                 text: 'Value'
             },
             plotLines: [
                 {
                     value: 0,
                     width: 1,
                     color: '#808080'
                 }
             ]
         },
     
         tooltip: {
             headerFormat: '<b>{series.name}</b><br/>',
             pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
         },
     
         legend: {
             enabled: false
         },
     
         exporting: {
             enabled: false
         },
     
         series: [
             {
                 name: 'Temperatura',
                 lineWidth: 2,
                 color: Highcharts.getOptions().colors[2],
                 data
             }
         ]
     });
     

 });

}) ( );


(function ( ) {

    //conectandose al archivo DatosAjax que envia los registros de la base de datos
let datos = new FormData();
datos.append("controlador","5");
datos.append("tipoDato","datos_carga_inicial");

fetch("ajax/DatosAjax.php",{
method: 'POST',
body: datos
})
.then((res)=>{
return res.json();
})
.then((json)=>{

 //console.log(json);
 // On chart load, start an interval that adds points to the chart and animate
 // the pulsating marker.
 const onChartLoad = function () {
     const chart = this,
         series = chart.series[0];

     setInterval(function () {

         let datos = new FormData();
         datos.append("controlador","5");
         datos.append("tipoDato","ultimo_dato_live");

         
         fetch("ajax/DatosAjax.php",{
         method: 'POST',
         body: datos
         })
         .then((res)=>{
         return res.json();
         })
         .then((json)=>{
             //console.log(json);

             const x = parseInt(json.fecha,10) * 1000, // current time
             y = parseInt(json.temperatura,10);

             series.addPoint([x, y], true, true);

         });



     }, 1000);
 };


 // Create the initial data

     const data = (function () {

         const d = [];

         for (let i = 0; i < 20; i++) {       
             d.push({
                 x: parseInt(json[i].fecha,10) * 1000,
                 y: parseInt(json[i].temperatura,10)
             });
         }

         return d;

     }());


     // Plugin to add a pulsating marker on add point
     Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
         const point = e.point,
             series = e.target;

         if (!series.pulse) {
             series.pulse = series.chart.renderer.circle()
                 .add(series.markerGroup);
         }

         setTimeout(() => {
             series.pulse
                 .attr({
                     x: series.xAxis.toPixels(point.x, true),
                     y: series.yAxis.toPixels(point.y, true),
                     r: series.options.marker.radius,
                     opacity: 1,
                     fill: series.color
                 })
                 .animate({
                     r: 20,
                     opacity: 0
                 }, {
                     duration: 1000
                 });
         }, 1);
     });


     Highcharts.chart('container5', {
         chart: {
             type: 'spline',
             events: {
                 load: onChartLoad
             }
         },
     
         time: {
             useUTC: false
         },
     
         title: {
             text: 'Datos Tiempo Real'
         },
     
         accessibility: {
             announceNewData: {
                 enabled: true,
                 minAnnounceInterval: 15000,
                 announcementFormatter: function (allSeries, newSeries, newPoint) {
                     if (newPoint) {
                         return 'New point added. Value: ' + newPoint.y;
                     }
                     return false;
                 }
             }
         },
     
         xAxis: {
             type: 'datetime',
             tickPixelInterval: 150,
             maxPadding: 0.1
         },
     
         yAxis: {
             title: {
                 text: 'Value'
             },
             plotLines: [
                 {
                     value: 0,
                     width: 1,
                     color: '#808080'
                 }
             ]
         },
     
         tooltip: {
             headerFormat: '<b>{series.name}</b><br/>',
             pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
         },
     
         legend: {
             enabled: false
         },
     
         exporting: {
             enabled: false
         },
     
         series: [
             {
                 name: 'Temperatura',
                 lineWidth: 2,
                 color: Highcharts.getOptions().colors[2],
                 data
             }
         ]
     });
     

 });

}) ( );


(function ( ) {

    //conectandose al archivo DatosAjax que envia los registros de la base de datos
let datos = new FormData();
datos.append("controlador","6");
datos.append("tipoDato","datos_carga_inicial");

fetch("ajax/DatosAjax.php",{
method: 'POST',
body: datos
})
.then((res)=>{
return res.json();
})
.then((json)=>{

 //console.log(json);
 // On chart load, start an interval that adds points to the chart and animate
 // the pulsating marker.
 const onChartLoad = function () {
     const chart = this,
         series = chart.series[0];

     setInterval(function () {

         let datos = new FormData();
         datos.append("controlador","6");
         datos.append("tipoDato","ultimo_dato_live");

         
         fetch("ajax/DatosAjax.php",{
         method: 'POST',
         body: datos
         })
         .then((res)=>{
         return res.json();
         })
         .then((json)=>{
             //console.log(json);

             const x = parseInt(json.fecha,10) * 1000, // current time
             y = parseInt(json.temperatura,10);

             series.addPoint([x, y], true, true);

         });



     }, 1000);
 };


 // Create the initial data

     const data = (function () {

         const d = [];

         for (let i = 0; i < 20; i++) {       
             d.push({
                 x: parseInt(json[i].fecha,10) * 1000,
                 y: parseInt(json[i].temperatura,10)
             });
         }

         return d;

     }());


     // Plugin to add a pulsating marker on add point
     Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
         const point = e.point,
             series = e.target;

         if (!series.pulse) {
             series.pulse = series.chart.renderer.circle()
                 .add(series.markerGroup);
         }

         setTimeout(() => {
             series.pulse
                 .attr({
                     x: series.xAxis.toPixels(point.x, true),
                     y: series.yAxis.toPixels(point.y, true),
                     r: series.options.marker.radius,
                     opacity: 1,
                     fill: series.color
                 })
                 .animate({
                     r: 20,
                     opacity: 0
                 }, {
                     duration: 1000
                 });
         }, 1);
     });


     Highcharts.chart('container6', {
         chart: {
             type: 'spline',
             events: {
                 load: onChartLoad
             }
         },
     
         time: {
             useUTC: false
         },
     
         title: {
             text: 'Datos Tiempo Real'
         },
     
         accessibility: {
             announceNewData: {
                 enabled: true,
                 minAnnounceInterval: 15000,
                 announcementFormatter: function (allSeries, newSeries, newPoint) {
                     if (newPoint) {
                         return 'New point added. Value: ' + newPoint.y;
                     }
                     return false;
                 }
             }
         },
     
         xAxis: {
             type: 'datetime',
             tickPixelInterval: 150,
             maxPadding: 0.1
         },
     
         yAxis: {
             title: {
                 text: 'Value'
             },
             plotLines: [
                 {
                     value: 0,
                     width: 1,
                     color: '#808080'
                 }
             ]
         },
     
         tooltip: {
             headerFormat: '<b>{series.name}</b><br/>',
             pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
         },
     
         legend: {
             enabled: false
         },
     
         exporting: {
             enabled: false
         },
     
         series: [
             {
                 name: 'Temperatura',
                 lineWidth: 2,
                 color: Highcharts.getOptions().colors[2],
                 data
             }
         ]
     });
     

 });

}) ( );
