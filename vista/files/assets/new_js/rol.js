
let submodulos = [];


var table = $('#tbl_rol').DataTable({
    ajax : {
        url: "ajax/RolesAjax.php",
        dataSrc: ""
    },
    language : {
        url : 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/es_es.json'
    },
    columns: [
        {data : 'id_roles'},
        {data : 'descripcion'},
        {data : 'id_roles', className : "dropdown"},
    ],
    columnDefs :[
        {
            targets : 0,
            width: "50px",
            sortable : false,
            render : function(data, type, row, meta){
                return "<center>"+row.id_roles+"</center>"
                ;
            }   
        },
        {
            targets : 1,
            width: "400px",
            sortable : false,
            render : function(data, type, row, meta){
                return "<center>"+row.descripcion+"</center>"
                ;
            }   
        },

        {
            targets : 2,
            width: "100px",
            sortable : false,
            render : function(data, type, row, meta){
                return "<center>"+
                            "<button class='btn btn-inverse btn-round mx-5 btn_ver_rol_modulo' rol_nombre = '"+row.descripcion+"' data-toggle='modal' data-target='#asignar_modulo_rol_modal'>Asignar Módulos</button>"+
                            "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button>"+
                            "<div class='dropdown-menu dropdown-menu-right b-none contact-menu'>"+
                                "<a class='dropdown-item editar' idEditar='"+row.id_roles+"' data-toggle='modal' data-target='#rol-edit-Modal' href='#'><i class='icofont icofont-edit'></i>Editar</a>"+
                                "<a class='dropdown-item eliminar' idEliminar = '"+row.id_roles+"' rol = '"+row.descripcion+"' href='#'><i class='icofont icofont-ui-delete'></i>Eliminar</a>"+
                               
                            "</div>"+
                        "</center>"
                ;
            }   
        }
    ],
    order: [[2, 'asc']],

});

//NUMERACION CORRELATIVA
table.on('order.dt search.dt', function () {
    let i = 1;

    table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        this.data(i++);
    });
}).draw();

//CREAR
$("#formCrearRol").submit(function(e){

    e.preventDefault();

    var rol = $("#txtNombreRol").val();

    if(rol.trim() == ''){
        $("#msjTxtRol").html('El campo no puede estar vacío');
        return;
    }

        var datos = new FormData();
        datos.append('tipo','crear');
        datos.append('rol',rol);
    
        $.ajax({
            url:"ajax/RolesAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
        
                if(respuesta == 'ok'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                        })
    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo guardar el registro',
                        showConfirmButton: false,
                        timer: 1500
                        })
                }
    
            }
    
        });
    
        $("#txtNombreRol").val('');
    
        $('#rol-Modal').modal('hide');
    
        //table.ajax.url( 'ajax/RolesAjax.php' ).load();
    
        setTimeout(actualizar, 500);

        //borrar mensajes
        $("#msjTxt").html('');

    
    
});


//ELIMINAR

$('#tbl_rol').on('click','a.eliminar', function(){

    var id = $(this).attr('idEliminar');
    var rol = $(this).attr('rol');

    Swal.fire({
        title: 'Deseas eliminar el registro?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              var datos = new FormData();
              datos.append('tipo','eliminar');
              datos.append('id', id);
              datos.append('rol', rol);

              $.ajax({
                url:"ajax/RolesAjax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
            
                    if(respuesta == 'ok'){

                        Toast.fire({
                            icon: 'success',
                            title: 'Registro Eliminado'
                          })
                    }else{

                        Toast.fire({
                            icon: 'danger',
                            title: 'No se Eliminó el registro'
                          })
                    }
        
        
                }
                
                
            });


            setTimeout(actualizar, 500);
 
        } 
      })
    



});


//EDITAR - VER SELECCION

$('#tbl_rol').on('click','a.editar', function(){

    var id = $(this).attr('idEditar');

        var datos = new FormData();
        datos.append('tipo','mostrar');
        datos.append('id', id);

        $.ajax({
        url:"ajax/RolesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

         $("#txtNombreRolEdit").val(respuesta['descripcion']);   
         $("#txtIdRolEdit").val(respuesta['id_roles']); 
         $("#txtNombreRolAnterior").val(respuesta['descripcion']); 
         
        }
        
         });


});

//EDITAR - ACTUALIZAR


$("#btnActualizarRol").on('click', function(){

    var id = $("#txtIdRolEdit").val();
    var rol = $("#txtNombreRolEdit").val();
    var nombre_rol_anterior = $("#txtNombreRolAnterior").val();
    
    var datos = new FormData();
        datos.append('tipo','editar');
        datos.append('id', id);
        datos.append('descripcion', rol);
        datos.append('nombre_rol_anterior', nombre_rol_anterior);

        $.ajax({
        url:"ajax/RolesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            if(respuesta == 'ok'){
                Swal.fire({
                    icon: 'success',
                    title: 'Registro actualizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                    })

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo actualizar el registro',
                    showConfirmButton: false,
                    timer: 1500
                    })
            }

        }
        
         });

    $('#rol-edit-Modal').modal('hide');

    setTimeout(actualizar, 500);


});

function actualizar(){
    table.ajax.reload();
  }
  

//VER MODULOS SEGUN ROL

$('#tbl_rol').on('click','.btn_ver_rol_modulo', function(){

    var nombre_rol = $(this).attr('rol_nombre');

    //guardar valor del rol en un input
    $("#nombreRolActualizarModulos").val(nombre_rol);

        var datos = new FormData();
        datos.append('tipo','mostrar_rol_modulo');
        datos.append('rol', nombre_rol);

        $.ajax({
        url:"ajax/RolesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

        var caja_rol_modulo = $(".caja_rol_modulo").html('');
        var marca;
        //vaciar array
        submodulos = [];

        for(var i = 0; i < respuesta.length; i++){

            //para usar posteriormente
            submodulos.push(respuesta[i]['opcion']);


            if(i > 0){

                if(respuesta[i]['modulo'] != respuesta[i-1]['modulo']){

                caja_rol_modulo.append('<p class="bg-light text-dark p-2 mt-3 font-weight-bold">'+'Módulo: '+respuesta[i]['modulo']+'</p>');  

                }

            }else{
                caja_rol_modulo.append('<p class="bg-light text-dark p-2 font-weight-bold">'+'Módulo: '+respuesta[i]['modulo']+'</p>');
            }

            if(respuesta[i]['estado'] == '1'){
                marca = 'checked';
            }else{
                marca = '';
            }

            caja_rol_modulo.append('<div class="checkbox-fade fade-in-primary"><label><input type="checkbox" value="" id="'+respuesta[i]['opcion']+'" '+marca+'><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span><span>'+respuesta[i]['opcion']+'</span></label></div>');

        }

        /*

        $.each(respuesta, function(indice, fila){
            
            caja_rol_modulo.append('<p>'+fila.OPCION+' '+fila['MODULO']+'</p>');


        });*/


        }
        
         });


});


//GUARDAR 

$("#formAsignarModulos").submit(function(e){
    e.preventDefault();

    var rol_seleccionado = $("#nombreRolActualizarModulos").val();
    var valorSeleccionado;

    for(var i=0; i < submodulos.length; i++){

        let opcion = document.getElementById(submodulos[i]);

        if(opcion.checked){
            valorSeleccionado = 1;
        }else{
            valorSeleccionado = 0;
        }

        var datos = new FormData();
        datos.append('tipo','actualizar_estado_modulo_rol');
        datos.append('estado', valorSeleccionado);
        datos.append('opcion', submodulos[i]);
        datos.append('rol', rol_seleccionado);

        $.ajax({
            url:"ajax/RolesAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

            }
            
            });

    }

    //termina el bucle
    $('#asignar_modulo_rol_modal').modal('hide');
    
});

