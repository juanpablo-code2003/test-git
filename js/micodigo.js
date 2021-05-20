$(document).ready(iniciar);

function iniciar() {
    $('#btnAgregar').on('click', agregarEmpleado);
    $('.eliminar').off().on('click', eliminarEmpleado);
    $('.editar').off('click').on('click', editarEmpleado);
}

function agregarEmpleado() {
    var cedula = $('#cedula').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var correo = $('#correo').val();
    var telefono = $('#telefono').val();
    var contrato = $('#contrato').val();
    var salario = $('#salario').val();
    var estado = 'activo';

    var datos = {
        "cedula": cedula, 
        "nombre": nombre, 
        "apellido": apellido, 
        "correo": correo, 
        "telefono": telefono, 
        "contrato": contrato, 
        "salario": salario
    };

    jQuery.ajax({
		type:"POST",
		data: datos, //los datos que quiero enviar 
		url:"php/registrar_empleado.php",
		success:function(response){ 
            var resp = JSON.parse(response)
            if(resp.estado == 'ok') {
                var fila = `<tr>
                                <td class="td-cedula">`+cedula+`</td>
                                <td class="td-nombre">`+nombre+`</td>
                                <td class="td-apellido">`+apellido+`</td>
                                <td class="td-correo">`+correo+`</td>
                                <td class="td-telefono">`+telefono+`</td>
                                <td class="td-contrato">`+contrato+`</td>
                                <td class="td-salario">`+salario+`</td>
                                <td class="td-estado">`+estado+`</td>
                                <td><button class="btn btn-primary editar" data-toggle="modal" data-target="#actualizarEmpleado">Editar</button></td>
                                <td><button class="btn btn-danger eliminar">Eliminar</button></td>
                            </tr>`;

                $('#listaEmpleados').prepend(fila);

                $('.eliminar').off().on('click', eliminarEmpleado);
                $('.editar').off('click').on('click', editarEmpleado);
            } else {
                Swal.fire({
                    title: 'Error',
                    text: resp.mensaje,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                });
            }
		}
	});

    $('#cedula').val('');
    $('#nombre').val('');
    $('#apellido').val('');
    $('#correo').val('');
    $('#telefono').val('');
    $('#contrato').val('');
    $('#salario').val('');
}

function eliminarEmpleado() {
    Swal.fire({
        title: '¿Estás Seguro?',
        text: 'Al eliminar el empleado no se podrá recuperar.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if(result.isConfirmed) {
            var cedula = $(this).parents('tr').find('.td-cedula').text();
            $(this).parents('tr').attr('id', 'porEliminar');
            var datos = {"cedula": cedula};

            $.ajax({
                type: "POST",
                url: "php/eliminar_empleado.php",
                data: datos,
                success: function (response) {
                    var resultado = JSON.parse(response);
                    if(resultado.estado == 'ok') {
                        Swal.fire({title: resultado.mensaje, icon: 'success'});
                        $('#porEliminar').remove();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: resultado.mensaje,
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                        });
                    }
                }
            });
        }
    });
}

function editarEmpleado() {
    var cedula = $(this).parents('tr').find('.td-cedula').text();
    var nombre = $(this).parents('tr').find('.td-nombre').text();
    var apellido = $(this).parents('tr').find('.td-apellido').text();
    var correo = $(this).parents('tr').find('.td-correo').text();
    var telefono = $(this).parents('tr').find('.td-telefono').text();
    var contrato = $(this).parents('tr').find('.td-contrato').text();
    var salario = $(this).parents('tr').find('.td-salario').text();
    var estado = $(this).parents('tr').find('.td-estado').text();

    $(this).parents('tr').attr('id', 'porEditar');
    $('#Actnombre').val(nombre);
    $('#Actapellido').val(apellido);
    $('#Actcorreo').val(correo);
    $('#Acttelefono').val(telefono);
    $('#Actcontrato option[value='+contrato+']').attr('selected', true);
    $('#Actsalario').val(salario);
    $('#Actestado option[value='+estado+']').attr('selected', true);

    $('#btnEditar').off('click').on('click', function () {
        actualizarEmpleado(cedula);
    });
}

function actualizarEmpleado(cedula) {
    var nuevo_nombre = $('#Actnombre').val();
    var nuevo_apellido = $('#Actapellido').val();
    var nuevo_correo = $('#Actcorreo').val();
    var nuevo_telefono = $('#Acttelefono').val();
    var nuevo_contrato = $('#Actcontrato').val();
    var nuevo_salario = $('#Actsalario').val();
    var nuevo_estado = $('#Actestado').val();

    var datos_nuevos = {
        "cedula": cedula,
        "nombre": nuevo_nombre,
        "apellido": nuevo_apellido,
        "correo": nuevo_correo,
        "telefono": nuevo_telefono,
        "contrato": nuevo_contrato,
        "salario": nuevo_salario,
        "estado": nuevo_estado
    };

    $.ajax({
        type: "POST",
        url: "php/editar_empleado.php",
        data: datos_nuevos,
        success: function(response) {
            var resultado = JSON.parse(response);
            if(resultado.estado == "ok") {
                $('#porEditar').find('.td-cedula').text(cedula);
                $('#porEditar').find('.td-nombre').text(nuevo_nombre);
                $('#porEditar').find('.td-apellido').text(nuevo_apellido);
                $('#porEditar').find('.td-correo').text(nuevo_correo);
                $('#porEditar').find('.td-telefono').text(nuevo_telefono);
                $('#porEditar').find('.td-contrato').text(nuevo_contrato);
                $('#porEditar').find('.td-salario').text(nuevo_salario);
                $('#porEditar').find('.td-estado').text(nuevo_estado);

                $('#porEditar').attr('id', '');
                Swal.fire({title: resultado.mensaje, icon: 'success', confirmButtonText: 'Aceptar'});
            } else {
                Swal.fire({
                    title: resultado.mensaje,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                });
            }
        }
    });
    
}