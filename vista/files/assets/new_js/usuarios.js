
var tabla = $('#tbl_usuario').DataTable({
    ajax : {
        url: "ajax/UsuariosAjax.php",
        dataSrc: ""
    },
    language : {
        url : 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/es_es.json'
    },

    columns : [
        {data : 'id_user'},
        {data : 'nombres'},
        {data : 'documento'},
        {data : 'estado'},
        {data : 'tipo_usuario'},
        {data : 'establecimiento'},
        {data : 'id_user', className : "dropdown"},
    ],

    order: [[6, 'asc']],

    columnDefs : [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        },
        {
            targets : 1,
            sortable : false,
            render : function(data, type, row, meta){
                
                return "<center>"+row.nombres+" "+row.apellidos+"</center>";
                

            }   
        },
        {
            targets : 3,
            sortable : false,
            render : function(data, type, row, meta){
                if(data == 1){
                    return "<center><a href='#' class='btn btn-sm hor-grd btn-grd-success btnActivar btnEnlaceGradient' idUsuario='"+row.id_user+"' estadoUsuario='0'>activo</a></center>";
                }else{
                    return "<center><a href='#' class='btn btn-sm hor-grd btn-grd-danger btnActivar btnEnlaceGradient' idUsuario='"+row.id_user+"' estadoUsuario='1'>inactivo</a></center>"; 
                }

            }   
        },
        {
            targets : 6,
            sortable : false,
            render : function(data, type, row, meta){
                return "<center>"+
                            "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button>"+
                            "<div class='dropdown-menu dropdown-menu-right b-none contact-menu'>"+
                                "<a class='dropdown-item editarUsuario' idEditarUsuario ='"+row.id_user+"' data-toggle='modal' data-target='#usuario-edit-Modal' href='#!'><i class='icofont icofont-edit'></i>Editar</a>"+
                                "<a class='dropdown-item eliminarUsuario' idEliminarUsuario ='"+row.id_user+"' href='#!'><i class='icofont icofont-ui-delete'></i>Eliminar</a>"+
                            "</div>"+
                        "</center>"
                ;
            }   

        },
    ],
    
});

//NUMERACION CORRELATIVA EN LA TABLA USUARIOS

tabla.on('order.dt search.dt', function () {
    let i = 1;

    tabla.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        this.data(i++);
    });
}).draw();

//modificar color bonton activar

$('#tbl_usuario').on('click','.btnActivar', function(e){
    e.preventDefault();

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url:"ajax/UsuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

        }
        
    });

    if(estadoUsuario == 0){

        $(this).removeClass('btn-grd-success');
        $(this).addClass('btn-grd-danger');
        $(this).html('inactivo');
        $(this).attr('estadoUsuario',1);
    }else{
        $(this).addClass('btn-grd-success');
        $(this).removeClass('btn-grd-danger');
        $(this).html('activo');
        $(this).attr('estadoUsuario',0);

    }
    
});

//login

$("#formLogin").submit(function(e){

    e.preventDefault();

    var usuario = $("#txtLoginUsuario").val();
    var password = $("#txtLoginPassword").val();
 
        var datos = new FormData();
        datos.append('tipo', 'login');
        datos.append('usuario', usuario);
        datos.append('password',password);

        $.ajax({
            url:"ajax/UsuariosAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
        
                if(respuesta == 'correcto'){
    
                    window.location = "home";
    
                }else if(respuesta == 'desactivado'){
                    Swal.fire({
                        icon: 'info',
                        text: 'Este usuario se encuentra desactivado, pongase en contacto con la oficina de seguros',
                        showConfirmButton: false,
                        timer: 2500
                        })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        text: 'El usuario y/o contraseña ingresada es incorrecta',
                        showConfirmButton: false,
                        timer: 1700
                        })
                }
    
            }
    
        });
     
});


//CBX SELECT 2 para seleccionar eess

$("#select_eess_usuario").select2({
    dropdownParent: $('#usuario-Modal .modal-body'),
    tags: true,
    width: '100%',
    theme: "bootstrap4",
    
});

$("#select_edit_eess_usuario").select2({
    dropdownParent: $('#usuario-edit-Modal .modal-body'),
    tags: true,
    width: '100%',
    theme: "bootstrap4",
    
});





//seleccionar el rol usuario
$.ajax({
    url: "ajax/RolesAjax.php",
    method : "POST",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
        $.each(response, function(indice, fila){
            $('#selectRolUsuario').append("<option value = '"+fila.descripcion+"'>"+fila.descripcion+"</option>");
            $('#selectEditRolUsuario').append("<option value = '"+fila.descripcion+"'>"+fila.descripcion+"</option>");
        });

        $("#selectEditRolUsuario").select2({
            dropdownParent: $('#usuario-edit-Modal .modal-body'),
            tags: true,
            width: '100%',
            theme: "bootstrap4",
            
        });
    
    }
});


//ver usuario a editar
$('#tbl_usuario').on('click','a.editarUsuario', function(){

    var id = $(this).attr('idEditarUsuario');
    var datos = new FormData();
    datos.append('tipo','mostrar');
    datos.append('id',id);

    $.ajax({
        url:"ajax/UsuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#select_edit_eess_usuario").val(respuesta['establecimiento']).trigger('change.select2');
            $("#txtEditNombreUsuario").val(respuesta['nombres']);
            $("#txtEditApellidoUsuario").val(respuesta['apellidos']);
            $("#txtEditUsuario").val(respuesta['documento']);
            $("#txtEditPasswordUsuario").val(respuesta['password']);
            $("#txtIdUsuario").val(respuesta['id_user']);
            $("#selectEditRolUsuario").val(respuesta['tipo_usuario']).trigger('change.select2');

        }

    });
 

});


//CREAR
$("#formUsuario").submit(function(e){

    e.preventDefault();

    var establecimiento = $("#select_eess_usuario").val();
    var nombre = $("#txtNombreUsuario").val();
    var apellido = $("#txtApellidoUsuario").val();
    var usuario = $("#txtUsuario").val();
    var password = $("#txtPasswordUsuario").val();
    var rol = $("#selectRolUsuario").val();
    var estado = 1;

        var datos = new FormData();
        datos.append('tipo','crear');
        datos.append('establecimiento',establecimiento);
        datos.append('nombre',nombre);
        datos.append('apellido',apellido);
        datos.append('usuario',usuario);
        datos.append('password',password);
        datos.append('rol',rol);
        datos.append('estado',estado);


        $.ajax({
            url:"ajax/UsuariosAjax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                console.log(respuesta);

                if(respuesta == 'ok'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                        })
    
                }else if(respuesta == 'duplicado'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Este usuario ya se encuentra registrado',
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
     
        //$('#usuario-Modal').modal('hide');

        //limpiar campos
        $("#txtDocumentoUsuario").val('');
        $("#select_eess_usuario").val('').trigger('change.select2');
        $("#txtNombreUsuario").val('');
        $("#txtApellidoUsuario").val('');
        $("#txtUsuario").val('');
        $("#txtPasswordUsuario").val('');
        $("#selectRolUsuario option[value='']").attr("selected",true);

    
        //table.ajax.url( 'ajax/RolesAjax.php' ).load();
    
        setTimeout(actualizarTablaUsuario, 500);
    
});

//EDITAR
$("#formEditUsuario").submit(function(e){

    e.preventDefault();
    var password = $("#txtEditPasswordUsuario").val();
    var establecimiento = $("#select_edit_eess_usuario").val();
    var nombre = $("#txtEditNombreUsuario").val();
    var apellido = $("#txtEditApellidoUsuario").val();
    var usuario = $("#txtEditUsuario").val();
    var rol = $("#selectEditRolUsuario").val();
    var id = $('#txtIdUsuario').val();

        var datos = new FormData();
        datos.append('tipo','editar');
        datos.append('establecimiento',establecimiento);
        datos.append('nombre',nombre);
        datos.append('apellido',apellido);
        datos.append('usuario',usuario);
        datos.append('password',password);
        datos.append('rol',rol);
        datos.append('id',id);

        $.ajax({
            url:"ajax/UsuariosAjax.php",
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
                        title: 'No se pudo editar el registro',
                        showConfirmButton: false,
                        timer: 1500
                        })
                }
    
            }
    
        });
     
        $('#usuario-edit-Modal').modal('hide');

        //table.ajax.url( 'ajax/RolesAjax.php' ).load();
    
        setTimeout(actualizarTablaUsuario, 500);
    
});

//ELIMINAR

$('#tbl_usuario').on('click','a.eliminarUsuario', function(){

    var id = $(this).attr('idEliminarUsuario');

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

              $.ajax({
                url:"ajax/UsuariosAjax.php",
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

            setTimeout(actualizarTablaUsuario, 500);
 
        } 
      })
    

});



function actualizarTablaUsuario(){
    tabla.ajax.reload();
  }
  



