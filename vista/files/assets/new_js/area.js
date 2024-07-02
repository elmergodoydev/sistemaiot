
var tablaArea = $('#tbl_area').DataTable({
    ajax : {
        url: "ajax/AreaAjax.php",
        dataSrc: ""
    },
    language : {
        url : 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/es_es.json'
    },
    columns: [
        {data : 'PK_ID_CAT_AREA'},
        {data : 'NOMBRE'},
        {data : 'PK_ID_CAT_AREA', className : "dropdown"},
    ],
    columnDefs :[
        {
            searchable: false,
            orderable: false,
            targets: 0,
        },
        {
            targets : 2,
            sortable : false,
            render : function(data, type, row, meta){
                return "<center>"+
                            "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button>"+
                            "<div class='dropdown-menu dropdown-menu-right b-none contact-menu'>"+
                                "<a class='dropdown-item editarArea' idEditarArea='"+row.PK_ID_CAT_AREA+"' data-toggle='modal' data-target='#area-edit-Modal' href='#'><i class='icofont icofont-edit'></i>Editar</a>"+
                                "<a class='dropdown-item eliminarArea' idEliminarArea = '"+row.PK_ID_CAT_AREA+"' href='#'><i class='icofont icofont-ui-delete'></i>Eliminar</a>"+
                                "<a class='dropdown-item verArea' idVerArea = '"+row.PK_ID_CAT_AREA+"' href='#'><i class='icofont icofont-eye-alt'></i>Ver</a>"+
                            "</div>"+
                        "</center>"
                ;
            }   
        }
    ],
    order: [[2, 'asc']],

});

//NUMERACION CORRELATIVA
tablaArea.on('order.dt search.dt', function () {
    let i = 1;

    tablaArea.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        this.data(i++);
    });
}).draw();


//CREAR
$("#formCrearArea").submit(function(e){

    e.preventDefault();

    var Area = $("#txtNombreArea").val();

    if(Area.trim() == ''){
        $("#msjTxtArea").html('El campo no puede estar vacío');
        return;
    }
        var datos = new FormData();
        datos.append('tipo','crear');
        datos.append('Area',Area);
    
        $.ajax({
            url:"ajax/AreaAjax.php",
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
    
        $("#txtNombreArea").val('');
    
        $('#area-Modal').modal('hide');
    
        //table.ajax.url( 'ajax/RolesAjax.php' ).load();
    
        setTimeout(actualizarArea, 500);


});

//ELIMINAR

$('#tbl_area').on('click','a.eliminarArea', function(){

    var id = $(this).attr('idEliminarArea');

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
                url:"ajax/AreaAjax.php",
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

            setTimeout(actualizarArea, 500);
 
        } 
      })
    



});


//EDITAR - VER SELECCION

$('#tbl_area').on('click','a.editarArea', function(){

    var id = $(this).attr('idEditarArea');

        var datos = new FormData();
        datos.append('tipo','mostrar');
        datos.append('id', id);

        $.ajax({
        url:"ajax/AreaAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

         $("#txtNombreAreaEdit").val(respuesta['NOMBRE']);   
         $("#txtIdAreaEdit").val(respuesta['PK_ID_CAT_AREA']); 
        }
        
         });


});

//EDITAR - ACTUALIZAR

$("#btnActualizarArea").on('click', function(){

    var id = $("#txtIdAreaEdit").val();
    var Area = $("#txtNombreAreaEdit").val();
    
    var datos = new FormData();
        datos.append('tipo','editar');
        datos.append('id', id);
        datos.append('nombre', Area);

        $.ajax({
        url:"ajax/AreaAjax.php",
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

    $('#area-edit-Modal').modal('hide');

    setTimeout(actualizarArea, 500);


});


function actualizarArea(){
    tablaArea.ajax.reload();
  }
  
