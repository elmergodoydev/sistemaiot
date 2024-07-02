

$('#btnMostrarDatosDia').on('click', function(){

    let fechaInicial = $("#txtDesdeReporteTablero").val();
    let fechaFinal = $("#txtHastaReporteTablero").val();

    if(fechaInicial == '' || fechaFinal == ''){

        Swal.fire({
            icon: 'info',
            text: 'Seleccione un rango de fecha Válido',
            showConfirmButton: false,
            timer: 2000
            })

    }else{
        $(".subtitulo_ruptura_eess").text(`Desde el día  ${fechaInicial}  Hasta  ${fechaFinal}`);

        let datos1 = new FormData();
        datos1.append('tipoDato','rupturaPorDia');
        datos1.append('fechaInicio',fechaInicial);
        datos1.append('fechaFin',fechaFinal);

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
                    row += `<td>${item.fecha}</td>`; // La columna 'Fecha' siempre se muestra normal
                
                    // Aplicar condicional para las siguientes columnas
                    if (item.ricardo_palma == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    if (item.santa_eulalia == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    if (item.buenos_aires == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    if (item.huayaringa_alta == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    if (item.cocachacra == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    if (item.sagrado_corazon == 0) {
                        row += '<td><div class="circle-green"></div></td>';
                    } else {
                        row += `<td><div class="circle-red"></div></td>`;
                    }
                
                    row += '</tr>';
                    $('#tablaDatosBody').append(row);
                });
               
            }
    
        });


        let datos2 = new FormData();
        datos2.append('tipoDato','indicadorRCF');
        datos2.append('fechaInicio',fechaInicial);
        datos2.append('fechaFin',fechaFinal);
        //datos para la tabla del porcentaje de indicador
        $.ajax({
            url:"ajax/DatosAjax.php",
            method: "POST",
            data: datos2,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                // Limpiar el cuerpo de la tabla antes de agregar nuevas filas
                $('#tablaDatosBodyIndicadorRCF').empty();

                // Iterar sobre los datos recibidos y agregar filas a la tabla
                $.each(respuesta, function(index, item) {

                // Construir la fila de la tabla
                let row = '<tr>';
                row += `<td>${item.fecha}</td>`;
                row += `<td>${item.eess_evaluados}</td>`;
                row += `<td>${item.eess}</td>`;
                row += `<td><span class='label label-danger' style='font-weight: 800 !important;'>${item.porcentaje}%</span></td>`;
                row += '</tr>';

            // Agregar la fila construida al cuerpo de la tabla
                 $('#tablaDatosBodyIndicadorRCF').append(row);
                  
                });
               
            }
    
        });


    }

});