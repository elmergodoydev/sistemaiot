$(document).ready(function() {
    // Función para cargar el gráfico inicial
    cargarGrafico();

    // Evento click del botón para obtener datos
    $('#btnMostrarDatosDia').on('click', function() {
        let fechaInicio = $("#txtDesdeReporteTablero").val();
        let fechaFin = $("#txtHastaReporteTablero").val();

        if (fechaInicio == '' || fechaFin == '') {
            Swal.fire({
                icon: 'info',
                text: 'Seleccione un rango de fecha válido',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            obtenerDatosGrafico(fechaInicio, fechaFin);
        }
    });

    // Función para obtener datos mediante AJAX
    function obtenerDatosGrafico(fechaInicio, fechaFin) {
        $.ajax({
            url: "ajax/DatosAjax.php",
            method: "POST",
            data: {
                tipoDato: 'rupturaPorDiaEess',
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            dataType: "json",
            success: function(respuesta) {
                actualizarGrafico(respuesta);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener datos:", error);
            }
        });
    }

    // Función para actualizar el gráfico con los datos obtenidos
    function actualizarGrafico(data) {
        let categorias = [];
        let cantidades = [];

        // Iterar sobre los datos recibidos y separar en categorías y cantidades
        $.each(data, function(index, item) {
            categorias.push(item.nombre_ipress);
            cantidades.push(item.cantidad);
        });

        // Configurar y dibujar el gráfico de Highcharts
        Highcharts.chart('container_grafico_barra', {
            chart: {
                type: 'column',
                backgroundColor: '#f2f2f2' // Color de fondo del gráfico
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: categorias,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            tooltip: {
               valueSuffix: ''
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Dias de RCF',
                data: cantidades,
                color: '#ff0000' // Color de las barras (rojo)
            }]
        });
    }

    // Función para cargar el gráfico inicial al cargar la página
    function cargarGrafico() {
        // Aquí puedes inicializar el gráfico con datos iniciales si lo deseas
        // Por ejemplo:
        // obtenerDatosGrafico('2024-01-01', '2024-01-31');
    }
});

