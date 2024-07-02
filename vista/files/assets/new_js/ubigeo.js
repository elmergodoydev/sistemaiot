

//select combobox departamento
var departamento_acreditado = new FormData();
departamento_acreditado.append('tipo','departamento');
$.ajax({
    url: "ajax/UbigeoAjax.php",
    method : "POST",
    data: departamento_acreditado,
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
        $.each(response, function(indice, fila){
            $('#select_departamento_acreditado').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
        });

    $("#select_departamento_acreditado").select2({
        width: '100%',
        theme: "bootstrap4",
    
    });

    }
});



//select provincia
$("#select_provincia_acreditado").select2({
    width: '100%',
    theme: "bootstrap4",
});



$("#select_departamento_acreditado").change(function (e) { 
    e.preventDefault();

    $("#select_provincia_acreditado").empty();
    $("#select_distrito_acreditado").empty();
    $('#select_distrito_acreditado').append("<option value = ''>Seleccione</option>");
    

    var id_departamento = $("#select_departamento_acreditado").val();

    var provincia_acreditado = new FormData();
    provincia_acreditado.append('tipo','provincia');
    provincia_acreditado.append('id_departamento', id_departamento);

    $.ajax({
        url: "ajax/UbigeoAjax.php",
        method : "POST",
        data: provincia_acreditado,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#select_provincia_acreditado').append("<option value = ''>Seleccione</option>");

            $.each(response, function(indice, fila){
                $('#select_provincia_acreditado').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
            });


        }
    });
        
    
});


//select distrito

$("#select_distrito_acreditado").select2({
    width: '100%',
    theme: "bootstrap4",
});


$("#select_provincia_acreditado").change(function (e) { 
    e.preventDefault();

    $("#select_distrito_acreditado").empty();
    

    var id_provincia = $("#select_provincia_acreditado").val();

    var distrito_acreditado = new FormData();
    distrito_acreditado.append('tipo','distrito');
    distrito_acreditado.append('id_provincia', id_provincia);

    $.ajax({
        url: "ajax/UbigeoAjax.php",
        method : "POST",
        data: distrito_acreditado,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {

            $('#select_distrito_acreditado').append("<option value = ''>Seleccione</option>");

            $.each(response, function(indice, fila){
                $('#select_distrito_acreditado').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
            });


        }
    });
        
    
});




//datos fallecido
//select combobox departamento
var departamento_fallecido = new FormData();
departamento_fallecido.append('tipo','departamento');
$.ajax({
    url: "ajax/UbigeoAjax.php",
    method : "POST",
    data: departamento_fallecido,
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
        $.each(response, function(indice, fila){
            $('#select_departamento_fallecido').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
        });

    $("#select_departamento_fallecido").select2({
        width: '100%',
        theme: "bootstrap4",
    
    });

    }
});



//select provincia
$("#select_provincia_fallecido").select2({
    width: '100%',
    theme: "bootstrap4",
});



$("#select_departamento_fallecido").change(function (e) { 
    e.preventDefault();

    $("#select_provincia_fallecido").empty();
    $("#select_distrito_fallecido").empty();
    $('#select_distrito_fallecido').append("<option value = ''>Seleccione</option>");
    

    var id_departamento = $("#select_departamento_fallecido").val();

    var provincia_fallecido = new FormData();
    provincia_fallecido.append('tipo','provincia');
    provincia_fallecido.append('id_departamento', id_departamento);

    $.ajax({
        url: "ajax/UbigeoAjax.php",
        method : "POST",
        data: provincia_fallecido,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#select_provincia_fallecido').append("<option value = ''>Seleccione</option>");

            $.each(response, function(indice, fila){
                $('#select_provincia_fallecido').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
            });


        }
    });
        
    
});




//select distrito

$("#select_distrito_fallecido").select2({
    width: '100%',
    theme: "bootstrap4",
});


$("#select_provincia_fallecido").change(function (e) { 
    e.preventDefault();

    $("#select_distrito_fallecido").empty();
    

    var id_provincia = $("#select_provincia_fallecido").val();

    var distrito_fallecido = new FormData();
    distrito_fallecido.append('tipo','distrito');
    distrito_fallecido.append('id_provincia', id_provincia);

    $.ajax({
        url: "ajax/UbigeoAjax.php",
        method : "POST",
        data: distrito_fallecido,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {

            $('#select_distrito_fallecido').append("<option value = ''>Seleccione</option>");

            $.each(response, function(indice, fila){
                $('#select_distrito_fallecido').append("<option value = '"+fila.ID+"'>"+fila.NOMBRE+"</option>");
            });


        }
    });
        
    
});


