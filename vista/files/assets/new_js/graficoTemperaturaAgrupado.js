
let inputFechaInicio = document.getElementById("txtDesdeReporte");
let inputFechaFinal = document.getElementById("txtHastaReporte");
let inputEstablecimiento = document.getElementById("select_eess_reporte");


inputFechaFinal.addEventListener("change", function(){

    if(inputFechaInicio.value != "" && inputFechaFinal.value != "" ){

        (async() => {

            let datos = new FormData();

            datos.append("grafico","areas");
            datos.append("controlador", inputEstablecimiento.value);
            datos.append("fechaInicio", inputFechaInicio.value);
            datos.append("fechaFin", inputFechaFinal.value);
            datos.append("tipoDeDato", "graficoAreaFechas");

             /*
            const data = await fetch(
                'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/range.json'
            ).then((response) => {
                console.log(response.json());
            });*/


            const data =  await fetch(
                'ajax/DatosAjax.php', {
                    method: 'POST',
                    body: datos
                }

            ).then(
                (response) => {
             
                    return response.json();
                }
            ).then((d)=>{
                let arreglo = [];
                let longitud = d.length;
                for(let i = 0; i < longitud; i++){
                    let arregloValores = [parseInt(d[i].Fecha),parseFloat(d[i].Tmin),parseFloat(d[i].Tmax)];
                    arreglo.push(arregloValores);
                }

                return arreglo;
            });
        
            

            Highcharts.chart('container', {
                chart: {
                    type: 'arearange',
                    zoomType: 'x',
                    scrollablePlotArea: {
                        minWidth: 600,
                        scrollPositionX: 1
                    }
                },
                title: {
                    text: 'Variación de Temperatura por Día'
                },
                xAxis: {
                    type: 'datetime',
                    accessibility: {
                        rangeDescription: 'Range: Jan 1st 2023 to Dec 31 2023.'
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true,
                    valueSuffix: '°C',
                    xDateFormat: '%A, %b %e'
                },
                legend: {
                    enabled: false
                },
                series: [{
                    name: 'Temperatures',
                    data: data,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, '#ff0000'],
                            [1, '#0000ff']
                        ]
                    }
                }]
            });
        })();

    }



});



