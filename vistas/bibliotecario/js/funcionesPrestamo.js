/*
	function ListarStockLibro(){
	var parametros = {
		"dbusqueda" : $("#txtbusqueda").val()
	};

	$.ajax({
		data: parametros,
		url: 'listarStockLibros.php',
		type: 'POST',
		beforeSend: function(){
			$("#ListaLibros").html("Procesando")
		},
		success: function(datos){
			$('#ListaLibros').load('listarStockLibros.php');
			$("#ListaLibros").html(datos);
			
		}
	});

}  */



	function VerificarLector(){
		var parametros = {
			"codLector" : $('#lector').val(),
		};

		$.ajax({
				type: "POST",
				data: parametros,
				url: "DVerificarLector.php", 
				beforeSend:function(){
					$('#MsjVerificarLector').html("Procesando")
				},
				success:function(datos){
					$('#MsjVerificarLector').slideDown("fast");
					$('#MsjVerificarLector').html(datos);
				}
		});
	}



	function GuardarPrestamo(){
		var parametros = {
			"Lector" : $('#lector').val(),
			"fechaDevolucion" : $('#dtpFecha').val(),
			"CodLibro" : $('#txtCodLibro').val()
		};

		$.ajax({
				type: "POST",
				data: parametros,
				url: "DGuardarPrestamo.php",
				beforeSend:function(){
					$('#CajaMensaje').html("Procesando")
				},
				success:function(datos){
					$('#ListaLibros').load('listarStockLibros.php');

					$('#txtCodLibro').val('');
					$("#MsjVerificarPrestamo").slideDown("fast");
					$('#MsjVerificarPrestamo').html(datos);
				}
		});
	}



	function ListarLibrosPrestados(){
	var parametros = {
		"dbusqueda": $('#txtbusqueda').val()
	};

	$.ajax({
		data: parametros,
		url: "listarLibrosPrestados.php",
		type: "POST",
		beforeSend: function(){
			$('#ListaLP').html("Procesando")
		},
		success: function(datos){
			$('#ListaLP').html(datos);
		}
	});
}







	function VRetornarLibro(Cod){
	var parametros = {
	"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'VRetornarLibro.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLP").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLP").html(datos);
		}
	});

}



	function DRetornarLibro(Cod){

	var parametros = {
		"vcod": Cod
	};

	$.ajax({
		data: parametros,
		url: 'DRetornarLibro.php',
		type: 'POST',
		beforeSend: function(){
			$("#ContenidoLP").html("Procesando")
		},
		success: function(datos){
			$("#ContenidoLP").html(datos);
		}
	});

}




//  Libros Devueltos //

function ListarLibrosDevueltos(){
	var parametros = {
		"dbusqueda": $('#txtbusqueda').val()
	};

	$.ajax({
		data: parametros,
		url: "listarLibrosDevueltos.php",
		type: "POST",
		beforeSend: function(){
			$('#ListaLR').html("Procesando")
		},
		success: function(datos){
			$('#ListaLR').html(datos);
		}
	});

}


	
	function VEliminarLibroDevuelto(Cod){
		var parametros = {
			"vcod" : Cod
		};

		$.ajax({
				type: "POST",
				data: parametros,
				url: "VEliminarLibroDevuelto.php",
				beforeSend:function(){
					$('#ContenidoLR').html("Procesando");
				},
				success:function(datos){
					$('#ContenidoLR').html(datos);
				}
		});
	}




	function DEliminarLibroDevuelto(Cod){
		var parametros = {
			"vcod" : Cod
		};

		$.ajax({
				type: "POST",
				data: parametros,
				url: "DEliminarLibroDevuelto.php",
				beforeSend:function(){
					$('#ContenidoLR').html("Procesando");
				},
				success:function(datos){
					$('#ContenidoLR').html(datos);
				}
		});

	}