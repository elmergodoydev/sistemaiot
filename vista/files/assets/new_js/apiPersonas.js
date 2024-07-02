
$("#btnBuscarUsuario").on("click", function (e) {
    e.preventDefault();
    
    var documento = $("#txtDocumentoUsuario").val();

    var datos = new FormData();
    datos.append('documento',documento);

            if(documento.length == 8){
                
                $.ajax({
                    url:"ajax/ApiDatosPersona.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta['error'] != 'si'){
                            $("#txtNombreUsuario").val(respuesta['nombres']);
                            $("#txtApellidoUsuario").val(respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                            $("#txtUsuario").val(respuesta['numeroDocumento']);

                        }else{
                            alert('Persona no encontrada');

                            $("#txtDocumentoUsuario").val("");
                            $("#txtNombreUsuario").val("");
                            $("#txtApellidoUsuario").val("");
                        }
                    }
            
                });

            }else{
                alert('Ingrese un número de documento válido');
                $("#txtDocumentoUsuario").val("");
                $("#txtNombreUsuario").val("");
                $("#txtApellidoUsuario").val("");

            }

            /*
            var solicitud = new XMLHttpRequest();
            solicitud.open('GET', 'https://dniruc.apisperu.com/api/v1/dni/'+documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBhYmxvci5zaXN0MDRAaG90bWFpbC5jb20ifQ.oR4MfZnJiGI5LZ0Y3uzK5QGi-pEvhANj17Q0F6ugoLI');

            $("#loader-usuario").removeClass('d-none');
            $("#loader-usuario").addClass('d-block');

            $("#caja-espacio").removeClass('d-none');
            $("#caja-espacio").addClass('d-block');
     

            solicitud.onload = function(){
            var datos = JSON.parse(solicitud.responseText);

            if(datos['nombres'] == null){
                    alert('Persona no encontrada');
                    $("#txtDocumentoUsuario").val("");
                    $("#txtNombreUsuario").val("");
                    $("#txtApellidoUsuario").val("");

                    $("#loader-usuario").removeClass('d-block');
                    $("#loader-usuario").addClass('d-none');
        
                    $("#caja-espacio").removeClass('d-block');
                    $("#caja-espacio").addClass('d-none');

                }else{
                    $("#txtNombreUsuario").val(datos['nombres']);
                    $("#txtApellidoUsuario").val(datos['apellidoPaterno']+" "+datos["apellidoMaterno"]);
                }

            }

            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){
                    
                    $("#loader-usuario").removeClass('d-block');
                    $("#loader-usuario").addClass('d-none');
        
                    $("#caja-espacio").removeClass('d-block');
                    $("#caja-espacio").addClass('d-none');

                }else if(solicitud.status == 404 || solicitud.status == 405){
                    $("#loader-usuario").removeClass('d-block');
                    $("#loader-usuario").addClass('d-none');
        
                    $("#caja-espacio").removeClass('d-block');
                    $("#caja-espacio").addClass('d-none');
                }
            
            }
            solicitud.send();*/

        
});


$("#btnEditBuscarUsuario").on("click", function (e) {
    e.preventDefault();
    
    var documento = $("#txtEditDocumentoUsuario").val();

    var datos = new FormData();
    datos.append('documento',documento);

    if(documento.length == 8){

        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta['error'] != 'si'){
                    $("#txtEditNombreUsuario").val(respuesta['nombres']);
                    $("#txtEditApellidoUsuario").val(respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                }else{
                    alert('Persona no encontrada');

                    $("#txtEditDocumentoUsuario").val("");
                    $("#txtEditNombreUsuario").val("");
                    $("#txtEditApellidoUsuario").val("");
                }
            }
    
        });

                /*
            var solicitud = new XMLHttpRequest();

           
            solicitud.open('GET', 'https://dniruc.apisperu.com/api/v1/dni/'+documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBhYmxvci5zaXN0MDRAaG90bWFpbC5jb20ifQ.oR4MfZnJiGI5LZ0Y3uzK5QGi-pEvhANj17Q0F6ugoLI');

            $("#loader-edit-usuario").removeClass('d-none');
            $("#loader-edit-usuario").addClass('d-block');

            $("#caja-edit-espacio").removeClass('d-none');
            $("#caja-edit-espacio").addClass('d-block');
     

            solicitud.onload = function(){
            var datos = JSON.parse(solicitud.responseText);

            if(datos['nombres'] == null){
                    alert('Persona no encontrada');
                    $("#txtEditDocumentoUsuario").val("");
                    $("#txtEditNombreUsuario").val("");
                    $("#txtEditApellidoUsuario").val("");

                    $("#loader-edit-usuario").removeClass('d-block');
                    $("#loader-edit-usuario").addClass('d-none');
        
                    $("#caja-edit-espacio").removeClass('d-block');
                    $("#caja-edit-espacio").addClass('d-none');

                }else{
                    $("#txtEditNombreUsuario").val(datos['nombres']);
                    $("#txtEditApellidoUsuario").val(datos['apellidoPaterno']+" "+datos["apellidoMaterno"]);
                }

            }

            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){
                    
                    $("#loader-edit-usuario").removeClass('d-block');
                    $("#loader-edit-usuario").addClass('d-none');
        
                    $("#caja-edit-espacio").removeClass('d-block');
                    $("#caja-edit-espacio").addClass('d-none');

                }else if(solicitud.status == 404 || solicitud.status == 405){
                    $("#loader-edit-usuario").removeClass('d-block');
                    $("#loader-edit-usuario").addClass('d-none');
        
                    $("#caja-edit-espacio").removeClass('d-block');
                    $("#caja-edit-espacio").addClass('d-none');
                }
            
            }
            
            solicitud.send();*/
    }else{
        alert('Ingrese un número de documento válido');
        $("#txtEditDocumentoUsuario").val("");
        $("#txtEditNombreUsuario").val("");
        $("#txtEditApellidoUsuario").val("");

    }

});

$("#btnBuscarPaciente").on("click", function (e) {
    e.preventDefault();
    
    var documento = $("#txtDocumentoPaciente").val();
    var datos = new FormData();
    datos.append('documento',documento);

    if(documento.length == 8){

        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta['error'] != 'si'){
                    $("#txtNombrePaciente").val(respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']+' '+respuesta['nombres']);
                }else{
                    alert('Persona no encontrada');
                    $("#txtDocumentoPaciente").val("");
                    $("#txtNombrePaciente").val("");

                }
            }
    
        });

            /*
            var solicitud = new XMLHttpRequest();

            solicitud.open('GET', 'https://dniruc.apisperu.com/api/v1/dni/'+documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBhYmxvci5zaXN0MDRAaG90bWFpbC5jb20ifQ.oR4MfZnJiGI5LZ0Y3uzK5QGi-pEvhANj17Q0F6ugoLI');

            $(".iconoBuscar").removeClass("d-inline-block");
            $(".iconoBuscar").addClass("d-none");
            $(".loader-buscar").removeClass("d-none");
            $(".loader-buscar").addClass("d-inline-block");

            solicitud.onload = function(){
            var datos = JSON.parse(solicitud.responseText);

            if(datos['nombres'] == null){
                    alert('Persona no encontrada');
                    $("#txtDocumentoPaciente").val("");
                    $("#txtNombrePaciente").val("");

                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");

                }else{
                    $("#txtNombrePaciente").val(datos['apellidoPaterno']+" "+datos["apellidoMaterno"]+" "+datos['nombres']);
                }

            }

            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){

                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");


                }else if(solicitud.status == 404 || solicitud.status == 405){
                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");
                }
            
            }
            
            solicitud.send();*/

    }else{
        alert('Ingrese un número de documento válido');
        $("#txtDocumentoPaciente").val("");
        $("#txtNombrePaciente").val("");

    }
});

$("#BtnEditBuscarPaciente").on("click", function (e) {
    e.preventDefault();
    
    var documento = $("#TxtEditDocumentoPaciente").val();

    var datos = new FormData();
    datos.append('documento',documento);

    if(documento.length == 8){

        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta['error'] != 'si'){
                    $("#TxtEditNombrePaciente").val(respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']+' '+respuesta['nombres']);
                }else{
                    alert('Persona no encontrada');

                    $("#TxtEditDocumentoPaciente").val("");
                    $("#TxtEditNombrePaciente").val("");
                }
            }
    
        });

            /*
            var solicitud = new XMLHttpRequest();

            solicitud.open('GET', 'https://dniruc.apisperu.com/api/v1/dni/'+documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBhYmxvci5zaXN0MDRAaG90bWFpbC5jb20ifQ.oR4MfZnJiGI5LZ0Y3uzK5QGi-pEvhANj17Q0F6ugoLI');

            $(".iconoBuscar").removeClass("d-inline-block");
            $(".iconoBuscar").addClass("d-none");
            $(".loader-buscar").removeClass("d-none");
            $(".loader-buscar").addClass("d-inline-block");

     
            solicitud.onload = function(){
            var datos = JSON.parse(solicitud.responseText);

            if(datos['nombres'] == null){
                    alert('Persona no encontrada');
                    $("#TxtEditDocumentoPaciente").val("");
                    $("#TxtEditNombrePaciente").val("");

                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");

                }else{
                    $("#TxtEditNombrePaciente").val(datos['apellidoPaterno']+" "+datos["apellidoMaterno"]+" "+datos['nombres']);
                }

            }

            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){

                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");



                }else if(solicitud.status == 404 || solicitud.status == 405){
                    $(".iconoBuscar").removeClass("d-none");
                    $(".iconoBuscar").addClass("d-inline-block");

                    $(".loader-buscar").removeClass("d-inline-block");
                    $(".loader-buscar").addClass("d-none");

                }
            
            }
            
            solicitud.send();*/

    }else{
        alert('Ingrese un número de documento válido');
        $("#TxtEditDocumentoPaciente").val("");
        $("#TxtEditNombrePaciente").val("");

    }

});

//btn buscar profesional

$("#BtnBuscarTrabajadorFuaAnulado").on("click", function (e) {
    e.preventDefault();
    
    var documento = $("#TxtDocumentoTrabajadorFuaAnulado").val();

    var datos = new FormData();
    datos.append('documento',documento);

     if(documento.length == 8){

        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta['error'] != 'si'){
                    $("#TxtNombreTrabajadorFuaAnulado").val(respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']+' '+respuesta['nombres']);
                }else{
                    alert('Persona no encontrada');

                    $("#TxtDocumentoTrabajadorFuaAnulado").val("");
                    $("#TxtNombreTrabajadorFuaAnulado").val("");
                }
            }
    
        });


    }else{
        alert('Ingrese un número de documento válido');
        $("#TxtDocumentoTrabajadorFuaAnulado").val("");
        $("#TxtNombreTrabajadorFuaAnulado").val("");

    }

});

var banderaApiDatoAcreditado;
var banderaApiDatoAsegurado;

//btn buscar acreditado
$("#BtnBuscarAcreditadoSepelio").on("click", function (e) {
    e.preventDefault();

    $("#TxtNombreAcreditadoSepelio").val("")
    $("#TxtDireccionAcreditadoSepelio").val("")
    $("#TxtEdadAcreditadoSepelio").val("")

    banderaApiDatoAcreditado = false;
    banderaApiDatoAsegurado = false;
    
    var documento = $("#TxtDocumentoAcreditadoSepelio").val();

    var datos = new FormData();
    datos.append('documento',documento);

     if(documento.length == 8 || documento.length == 9){

        //peticion para obtener persona SEGUN API PERSONA

        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                if(respuesta['error'] != 'si' && respuesta['error'] != 'Nro DNI debe contener 8 digitos'){

                    $("#btnTraerDatosAcreditadoApi").html(`<label class="label label-inverse">Datos API: </label><label class="label label-inverse" style ="cursor : pointer;">${respuesta['nombres']} ${respuesta['apellidoPaterno']} ${respuesta['apellidoMaterno']}</label>`);
                    //$("#TxtNombreAcreditadoSepelio").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                    $("#inputDatoAcreditadoApiTemporal").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);

                   banderaApiDatoAcreditado = true;

                }else{

                    banderaApiDatoAcreditado = false;
                    $("#btnTraerDatosAcreditadoApi").html('<label class="label label-inverse">Datos API: </label><label class="label label-danger">No Encontrados</label>');
                    
                }
            }   
        });


        //api para tener datos del asegurado SIS

        $.ajax({
            url:"ajax/AseguradosAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                if(respuesta){
                    $("#btnTraerDatosAseguradosApi").html(`<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label" style ="cursor : pointer; background-color: #118ab2;">${respuesta['Nombres']} ${respuesta['Apellidos']}</label>`);
                    //$("#TxtNombreAcreditadoSepelio").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                   $("#inputDatoAseguradoApiTemporal").val(respuesta['Nombres']+' '+respuesta['Apellidos']);
                   $("#inputDireccionAseguradoApiTemporal").val(respuesta['Direccion']);
                   $("#inputFechaNacAseguradoApiTemporal").val(respuesta['FechaNac']);
                   

                   banderaApiDatoAsegurado = true;


                }else{
                    $("#btnTraerDatosAseguradosApi").html('<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label label-danger">No Encontrados</label>');
                    $("#btnTraerDatosAseguradosApi").addClass('sin_acceso');
                    banderaApiDatoAsegurado = false;
                }  
                   
            }   
        });

    }else{

        $("#btnTraerDatosAcreditadoApi").html('<label class="label label-inverse">Datos API: </label><label class="label label-danger">No Encontrados</label>');
        $("#btnTraerDatosAseguradosApi").html('<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label label-danger">No Encontrados</label>');

    }

});

///AGREGAR DATOS ACREDITADO AL INPUT

$('#btnTraerDatosAcreditadoApi').on('click', function(){

    if(banderaApiDatoAcreditado){
        let nombres = $("#inputDatoAcreditadoApiTemporal").val();

        //ocultando modal
        $('#modalDatosAcreditado').modal('hide');
    
        //colocando datos en el input texto
        $("#TxtNombreAcreditadoSepelio").val(nombres)
    }

});


/* FUNCION CALCULO EDAD */
const obtenerEdad = (ArrayfechaNacimiento,arrayFechaEvaluar)=>{

    //datos fecha nacimiento
    let anioNac = parseInt(ArrayfechaNacimiento[2]); 
    let mesNac = parseInt(ArrayfechaNacimiento[1]);
    let diaNac = parseInt(ArrayfechaNacimiento[0]);

    //datos fecha presentacion


    let anioPres = parseInt(arrayFechaEvaluar[0]); 
    let mesPres = parseInt(arrayFechaEvaluar[1]);
    let diaPres = parseInt(arrayFechaEvaluar[2]);

    let edad = anioPres - anioNac;

    if(mesPres < mesNac){
        edad --;
    }else if(mesPres == mesNac){
        if(diaPres<diaNac){
            edad--;
        }
    }

    return edad;

}


/* AGREGAR A INPUT DATOS DEL ACREDITADO DEL SIS */

$('#btnTraerDatosAseguradosApi').on('click', function(){

    if(banderaApiDatoAsegurado){

        let nombres = $("#inputDatoAseguradoApiTemporal").val();
        let direccion = $("#inputDireccionAseguradoApiTemporal").val();
        let fechaNac = $("#inputFechaNacAseguradoApiTemporal").val();

        //ocultando modal
        $('#modalDatosAcreditado').modal('hide');
    
        //colocando datos en el input texto
        $("#TxtNombreAcreditadoSepelio").val(nombres)
        $("#TxtDireccionAcreditadoSepelio").val(direccion)

        let arregloFechaNac =fechaNac.split('/');

        let fechaPresentacion = $('#TxtFechaPresentacionSepelio').val()
        let ArrayFechaEvaluar = fechaPresentacion.split('-');
        
        let edad = obtenerEdad(arregloFechaNac,ArrayFechaEvaluar)

        $("#TxtEdadAcreditadoSepelio").val(edad)
        
    }

});

/*=========================================fallecido=========================================*/

var banderaApiDatoFallecido;
var banderaApiDatoAseguradoFallecido;

//btn buscar fallecido
$("#BtnBuscarFallecidoSepelio").on("click", function (e) {
    e.preventDefault();

    $("#TxtNombreFallecidoSepelio").val("")
    $("#TxtEdadFallecidoSepelio").val("")
    $("#TxtAfiliacionFallecido").val("")

    banderaApiDatoFallecido = false;
    banderaApiDatoAseguradoFallecido = false;
    
    var documento = $("#TxtDocumentoFallecidoSepelio").val();

    var datos = new FormData();
    datos.append('documento',documento);

     if(documento.length == 8 || documento.length == 9){


        $.ajax({
            url:"ajax/ApiDatosPersona.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta['error'] != 'si' && respuesta['error'] != 'Nro DNI debe contener 8 digitos'){
                    
                    $("#btnTraerDatosFallecidoApi").html(`<label class="label label-inverse">Datos API: </label><label class="label label-inverse" style ="cursor : pointer;">${respuesta['nombres']} ${respuesta['apellidoPaterno']} ${respuesta['apellidoMaterno']}</label>`);
                    //$("#TxtNombreAcreditadoSepelio").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                    $("#inputDatoFallecidoApiTemporal").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);

                    banderaApiDatoFallecido = true;

                }else{

                    banderaApiDatoFallecido = false;
                    $("#btnTraerDatosFallecidoApi").html('<label class="label label-inverse">Datos API: </label><label class="label label-danger">No Encontrados</label>');

                }
            }
        });


        //api para tener datos del asegurado SIS

        $.ajax({
            url:"ajax/AseguradosAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                if(respuesta){

                    $("#btnTraerDatosAseguradoFallecidoApi").html(`<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label" style ="cursor : pointer; background-color: #118ab2;">${respuesta['Nombres']} ${respuesta['Apellidos']}</label>`);
                    //$("#TxtNombreAcreditadoSepelio").val(respuesta['nombres']+' '+respuesta['apellidoPaterno'] +' '+ respuesta['apellidoMaterno']);
                    $("#inputDatoAseguradoFallecidoApiTemporal").val(respuesta['Nombres']+' '+respuesta['Apellidos']);
                    $("#inputDireccionAseguradoFallecidoApiTemporal").val(respuesta['Direccion']);
                    $("#inputFechaNacAseguradoFallecidoApiTemporal").val(respuesta['FechaNac']);
                    $("#inputTipoContratoAseguradoFallecidoApiTemporal").val(respuesta['TipoContrato']); 
                    $("#inputNroContratoAseguradoFallecidoApiTemporal").val(respuesta['NroContrato']); 
                
                    banderaApiDatoAseguradoFallecido = true;


                }else{
                    $("#btnTraerDatosAseguradoFallecidoApi").html('<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label label-danger">No Encontrados</label>');
                    $("#btnTraerDatosAseguradoFallecidoApi").addClass('sin_acceso');
                    banderaApiDatoAseguradoFallecido = false;
                }  
                    
            }   
        });
        
    }else{
        $("#btnTraerDatosFallecidoApi").html('<label class="label label-inverse">Datos API: </label><label class="label label-danger">No Encontrados</label>');
        $("#btnTraerDatosAseguradoFallecidoApi").html('<label class="label" style="background-color: #118ab2;">Datos SIS: </label><label class="label label-danger">No Encontrados</label>');

    }
});

///AGREGAR DATOS FALLECIDO AL INPUT DE API PERSONA

$('#btnTraerDatosFallecidoApi').on('click', function(){

    if(banderaApiDatoFallecido){
        let nombres = $("#inputDatoFallecidoApiTemporal").val();

        //ocultando modal
        $('#modalDatosFallecido').modal('hide');
    
        //colocando datos en el input texto
        $("#TxtNombreFallecidoSepelio").val(nombres)
    }

});

/* AGREGAR A INPUT DATOS DEL FALLECIDO  CON API SIS */

$('#btnTraerDatosAseguradoFallecidoApi').on('click', function(){

    if(banderaApiDatoAseguradoFallecido){

        let nombres = $("#inputDatoAseguradoFallecidoApiTemporal").val();
        let direccion = $("#inputDireccionAseguradoFallecidoApiTemporal").val();
        let fechaNac = $("#inputFechaNacAseguradoFallecidoApiTemporal").val();
        let Tipocontrato = $("#inputTipoContratoAseguradoFallecidoApiTemporal").val();
        let Nrocontrato = $("#inputNroContratoAseguradoFallecidoApiTemporal").val();

        //ocultando modal
        $('#modalDatosFallecido').modal('hide');
    
        //colocando datos en el input texto
        $("#TxtNombreFallecidoSepelio").val(nombres)
        $("#TxtAfiliacionFallecido").val(Tipocontrato+' - '+Nrocontrato)

        //seleccionando cbx regimen

        if(Tipocontrato == 'R' || Tipocontrato == '8' || Tipocontrato == '9'){
            $("#select_tipo_seguro_fallecido").val('semicontributivo')
        }



        let arregloFechaNac =fechaNac.split('/');

        let fechaFallecimiento = $('#TxtFechaFallecidoSepelio').val()
        let ArrayFechaEvaluar = fechaFallecimiento.split('-');
        
        let edad = obtenerEdad(arregloFechaNac,ArrayFechaEvaluar)

        $("#TxtEdadFallecidoSepelio").val(edad)
    }

});










