
    $("#select_eess_reporte").select2({
        //dropdownParent: $('#actividad-digitador-Modal .modal-body'),
        //tags: true,
        width: '100%',
        theme: "bootstrap4",
    
    });


    //botones de reportes

$("#btn-excel-reporte").on('click', function () {

    var fechaInicial = $("#txtDesdeReporte").val();
    var fechaFinal = $("#txtHastaReporte").val();
   
    if(fechaInicial == '' || fechaFinal == ''){

        Swal.fire({
            icon: 'info',
            text: 'Seleccione un rango de fecha Válido',
            showConfirmButton: false,
            timer: 2000
            })

    }else{

        var ipress = $("#select_eess_reporte").val();
        var conjunto = Array(fechaInicial, fechaFinal, ipress);
        var datos = conjunto.toString();
        window.location = "reportes/reporteCadenaFrio.php?datos="+datos;

        

    }

});
