

$('#btnMostrarDatosTableroDet').on('click', function(){

    let fecha = $("#txtFechaTableroDet").val();
    let ipress = $("#select_eess_reporte").val();

    if(fecha == ''){

        Swal.fire({
            icon: 'info',
            text: 'Seleccione una fecha válida',
            showConfirmButton: false,
            timer: 2000
            })

    }else{

        $(".subtitulo_rangos_hora").text(`Fecha de Evaluación:  ${fecha}`);

        let datos1 = new FormData();
        datos1.append('tipoDato','indicadorHora');
        datos1.append('fecha',fecha);
        datos1.append('controlador',ipress);

        //datos para la tabla de semaforizacion
        $.ajax({
            url:"ajax/DatosAjax.php",
            method: "POST",
            data: datos1,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                // Limpiar el cuerpo de la tabla antes de agregar nuevas filas
                $('#tablaDatosBody').empty();

                // Iterar sobre los datos recibidos y agregar filas a la tabla
                $.each(respuesta, function(index, item) {
                    let row = '<tr>';
                    row += `<td>${item.tiempo_inicio}</td>`;
                    row += `<td>${item.tiempo_fin}</td>`; 
                    
                    // Evaluación para temp_minima
                    if (item.temp_minima === null) {
                        row += `<td>---</td>`; 
                    } else {
                        let tempMinimaClass = '';
                        if (item.temp_minima < 2 || item.temp_minima > 8) {
                            tempMinimaClass = 'label-danger';
                        } else {
                            tempMinimaClass = 'label-success';
                        }
                        row += `<td><span class="label ${tempMinimaClass}">${item.temp_minima}</span></td>`; 
                    }
                
                    // Evaluación para temp_maxima
                    if (item.temp_maxima === null) {
                        row += `<td>---</td>`; 
                    } else {
                        let tempMaximaClass = '';
                        if (item.temp_maxima < 2 || item.temp_maxima > 8) {
                            tempMaximaClass = 'label-danger';
                        } else {
                            tempMaximaClass = 'label-success';
                        }
                        row += `<td><span class="label ${tempMaximaClass}">${item.temp_maxima}</span></td>`; 
                    }
                
                    // Evaluación para la columna de texto
                    let evaluacionText = '';
                    let evaluacionClass = '';
                
                    if (item.temp_minima === null || item.temp_maxima === null) {
                        evaluacionText = 'Sin Evaluación';
                        evaluacionClass = 'label-inverse';
                    } else if ((item.temp_minima < 2 || item.temp_minima > 8) || (item.temp_maxima < 2 || item.temp_maxima > 8)) {
                        evaluacionText = 'Ruptura de cadena de frío';
                        evaluacionClass = 'label-danger';
                    } else {
                        evaluacionText = 'Sin ruptura de cadena de Frío';
                        evaluacionClass = 'label-success';
                    }
                
                    row += `<td><span class="label ${evaluacionClass}">${evaluacionText}</span></td>`; 
                
                    row += '</tr>';
                    
                    $('#tablaDatosBody').append(row);
                });


            }
    
        });



        

    }

});