var Empleados = function () {
	'use strict';

    this.cargarLista = function() {
        cargarEmpleadosLista();
    };

    this.cargarEventoBtnFiltroEmpleado = function() {
        cargarEmpleadosListaFiltrada();
    } 


    /* Métodos privados */

    function cargarEmpleadosListaFiltrada() {
        $('#btn-lista-filtrada').on('click', function(e){
            e.preventDefault();
            var formData = $('#formularioListaFiltrada').serialize();
            $.ajax({
                beforeSend: function() {
                    $('#modalCargando').modal('show');
                },
                url: 'source/ABM/empleados/cargarEmpleadosListaFiltrada.php',
                method: 'post',
                data: formData,
                dataType: 'html',
                success: function(data) {
                    $('#lista-empleados').html(data);
                }
            }).done(function() {    
                
                cargarEventos();
                ponerFocoEnEmpleadoEditar();
                $('#modalCargando').modal('hide');
            });
        });        
    }

	function cargarEmpleadosLista() { 
		$.ajax({
            beforeSend: function() {
                $('#modalCargando').modal('show');
            },
		    url: 'source/ABM/empleados/cargarEmpleadosLista.php',
		    method: 'post',
		    dataType: 'html',
		    success: function(data) {
		        $('#lista-empleados').html(data);
		    }
		}).done(function() {	
			
			cargarEventos();
			ponerFocoEnEmpleadoEditar();
            $('#modalCargando').modal('hide');
		});
	}

    function cargarEventos() {
        btnEmpleadoNuevoLista();
        cargarEmpleadosListaFiltrada();
        btnDatosEmpleado();
        btnExportarPDF();
        btnEmpleadoEditarLista();
        btnEmpleadoEliminarLista();
    };

    function ponerFocoEnEmpleadoEditar() {
		// Se pone el foco en el primer campo del formulario de editar Empleado
		$('.btn-editar-lista').on('click', function(){
			$('#nombre').focus();
		});
    }

    function btnEmpleadoNuevo() {
        $('#btn-nuevo-empleado').on('click', function(e) {
            e.preventDefault();
            var formData = $('#formNuevoEmpleado').serialize();
            $.ajax({
                url: 'source/ABM/empleados/nuevo.php',
                method: 'POST',
                data: formData,
                success: function(data){
                    swal({
                        title: 'Usuario agregado con éxito',
                        type: 'success'
                    });
                },
                error: function() {
                    swal({
                        title: 'Ocurrió un error al agregar usuario',
                        type: 'error'
                    });
                }
            }).done(function(){
            	$('#modalNuevoEmpleado').modal('hide');
                cargarEmpleadosLista();
            });
        });
    }

    function btnEmpleadoEditarLista() {
        // Se carga evento boton editar de lista
        $('.btn-editar-lista').on('click', function() {

            var idUsuario = 'id=' + $(this).data('id');

            $.ajax({
                url: 'source/ABM/empleados/cargarEmpleadoEditarEnFormulario.php',
                method: 'post',
                data: idUsuario,
                dataType: 'html',
                success: function(data){
                    $('#modalEditarEmpleado .modal-body').html(data);
                }
            }).done(function(){
                btnEmpleadoEditar();
                
            });
        });
    }    

    function btnEmpleadoNuevoLista() {
        // Se carga evento boton editar de lista
        $('#btn-nuevo-lista').on('click', function() {
            $.ajax({
                url: 'source/ABM/empleados/cargarEmpleadoNuevoEnFormulario.php',
                method: 'post',
                dataType: 'html',
                success: function(data){
                    $('#modalNuevoEmpleado .modal-body').html(data);
                }
            }).done(function(){
                
                btnEmpleadoNuevo();
            });
        });
    }

    function btnEmpleadoNuevo() {
        $('#btn-nuevo-empleado').on('click', function() {
            var formData = $('#formNuevoEmpleado').serialize();
            // TODO: validaciones del form con Validate.js
            $.ajax({
                url: 'source/ABM/empleados/nuevo.php',
                method: 'POST',
                data: formData,
                success: function(data){
                    swal({
                        title: 'Usuario de alta con éxito',
                        type: 'success'
                    }, function(){
                        $('#modalNuevoEmpleado').modal('hide');
                    });
                },
                error: function() {
                    swal({
                        title: 'Ocurrió un error al dar alta a usuario',
                        type: 'error'
                    });
                }
            }).done(function(){
                cargarEmpleadosLista();
            });
        });
    }    

    function btnDatosEmpleado() {
        // Se carga evento boton ver empleado
        $('.btn-datos-empleado').on('click', function() {

            var idUsuario = 'id=' + $(this).data('id');

            $.ajax({
                url: 'source/ABM/empleados/datosEmpleado.php',
                method: 'post',
                data: idUsuario,
                dataType: 'html',
                success: function(data){
                    $('#modalDatosEmpleado .modal-body').html(data);
                }
            });
        });
    }    

    function btnExportarPDF() {
        $('.btn-exportar-pdf').on('click', function() {
            var $self = $(this);
            var IdEmpleado = $self.data('id');
            window.open("source/ABM/empleados/PDFDatosEmpleado.php");
        });
    }   

    function btnEmpleadoEditar() {
		$('#btn-editar-empleado').on('click', function() {

	        var formData = $('#formEditarEmpleado').serialize();
	        // TODO: validaciones del form con Validate.js
	        $.ajax({
	            url: 'source/ABM/empleados/editar.php',
	            method: 'POST',
	            data: formData,
	            success: function(data){
	                swal({
	                    title: 'Usuario editado con éxito',
	                    type: 'success'
	                }, function(){
	                    $('#modalEditarEmpleado').modal('hide');
	                });
	            },
	            error: function() {
	                swal({
	                    title: 'Ocurrió un error al editar usuario',
	                    type: 'error'
	                });
	            }
	        }).done(function(){
	        	cargarEmpleadosLista();
	        });
		});
    }    

    function btnEmpleadoEliminarLista() {
        // Baja empleado
        $('.btn-baja-empleado').on('click', function(e) {
            e.preventDefault();
            var $self = $(this);
            var IdEmpleado = $self.data('id-eliminar');

            swal({
                title: '¿Está seguro que desea eliminar este usuario?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#039be5"
            }, function() {
                eliminarEmpleadoPorId(IdEmpleado);
            });        
        });
    }

    function eliminarEmpleadoPorId(id) {
        // TODO: validaciones del form con Validate.js
        var data = 'id=' + id;

        $.ajax({
            url: 'source/ABM/empleados/baja.php',
            method: 'POST',
            data: data,
            success: function(data) {
                swal({
                    title: 'Usuario eliminado con éxito',
                    type: 'success'
                });
            },
            error: function() {
                swal({
                    title: 'Ocurrió un error al eliminar usuario',
                    type: 'error'
                });
            }
        }).done(function(){
        	cargarEmpleadosLista(); // Se vuelve a cargar la lista luego de confirmar borrar usuario
        });
    }                   
};
