const gaugeOptions = {
    chart: {
      type: 'solidgauge'
    },
    title: null,
    pane: {
      center: ['50%', '85%'],
      size: '140%',
      startAngle: -90,
      endAngle: 90,
      background: {
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
      }
    },
    exporting: {
      enabled: false
    },
    tooltip: {
      enabled: false
    },
    // the value axis
    yAxis: {
      stops: [
        [0.0,'#3EB9E6'],
      ],
      lineWidth: 0,
      tickWidth: 0,
      minorTickInterval: null,
      tickAmount: 2,
      title: {
        y: -70
      },
      labels: {
        y: 16
      }
    },
    plotOptions: {
      solidgauge: {
        dataLabels: {
          y: 5,
          borderWidth: 0,
          useHTML: true
        }
      }
    }
};
  
  // The speed gauge
  const chartTemperatura = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));

  const chartTemperatura2 = Highcharts.chart('container-speed2', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));

  const chartTemperatura3 = Highcharts.chart('container-speed3', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));

  const chartTemperatura4 = Highcharts.chart('container-speed4', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));

  const chartTemperatura5 = Highcharts.chart('container-speed5', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));

  const chartTemperatura6 = Highcharts.chart('container-speed6', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 40,
      title: {
        text: 'INDICADOR DE TEMPERATURA'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura',
      data: [0],
      dataLabels: {
        format: '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">(°C) Grados Celsius</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: '(°C) Grados Celsius'
      }
    }]
  
  }));


  
  

setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","1");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura) {
      pointTemperatura = chartTemperatura.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);
  

setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","2");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura2) {
      pointTemperatura = chartTemperatura2.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);
  
setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","3");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura3) {
      pointTemperatura = chartTemperatura3.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);
  
setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","4");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

   // console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura4) {
      pointTemperatura = chartTemperatura4.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);
  
setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","5");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura5) {
      pointTemperatura = chartTemperatura5.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);
  
setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","6");
  data.append("grafico","gauge");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //console.log(json);
    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperatura);
    //console.log("Temperatura : "+temperature);

    if (chartTemperatura6) {
      pointTemperatura = chartTemperatura6.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    /*
    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad) {
      pointHumedad = chartHumedad.series[0].points[0];
      pointHumedad.update(humedad);
    }
*/


  });

}, 1000);

  

/*
setInterval(() => {
  //conectandose al archivo DatosAjax que envia los registros de la base de datos
  let data = new FormData();
  data.append("controlador","2");

  fetch("ajax/DatosAjax.php",{
    method: 'POST',
    body: data
  })
  .then((res)=>{
    return res.json();
  })
  .then((json)=>{

    //codigo para actualizar los datos de temnperatura
    let pointTemperatura;
    let pointHumedad;
    let temperature;
    let humedad;

    temperature = parseFloat(json.temperature);
    console.log("Temperatura : "+temperature);

    if (chartTemperatura2) {
      pointTemperatura = chartTemperatura2.series[0].points[0];
      pointTemperatura.update(temperature);
    }

    //codigo para actualizar los datos de humedad
    humedad = parseFloat(json.humidity);
    console.log("Humedad : "+humedad);

    if (chartHumedad2) {
      pointHumedad = chartHumedad2.series[0].points[0];
      pointHumedad.update(humedad);
    }

  });

}, 1000);*/
  

  // Bring life to the dials
  /*
  setInterval(function() {
    // Temperatura
   
    let point,
      newVal,
      inc;

    if (chartSpeed) {
      point = chartSpeed.series[0].points[0];
      point.update(temperature);
    }
  
    // RPM
    if (chartRpm) {
      point = chartRpm.series[0].points[0];
      inc = Math.random() * 100;
      point.update(inc);
    }
  }, 2000);*/