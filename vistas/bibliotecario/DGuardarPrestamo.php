<?php 
	include('conexion.php');

	$dLector = $_POST['Lector'];
	$dFechaDevolucion = $_POST['fechaDevolucion'];
	$dCodLibro = $_POST['CodLibro'];


	if (!empty($dLector) && !empty($dFechaDevolucion) && !empty($dCodLibro)) {
		


		$sql = "INSERT INTO lectores(nombre) VALUES('$dLector')";
		$result = $cnmysql->query($sql);

		$q = "SELECT id_lector FROM lectores WHERE nombre = '$dLector'";
		$r = $cnmysql->query($q);
		$row = mysqli_fetch_array($r);
		$idLector = $row['id_lector'];


		$sql_2 = "INSERT INTO prestamos (id_lector, fecha_entrega, fecha_devolucion) VALUES('$idLector', CURDATE(), '$dFechaDevolucion')";

		$result_2 = $cnmysql->query($sql_2);


		if ($result_2) {
			
			$query = "SELECT disponibles FROM libros WHERE id_libro = '$dCodLibro'";
			$resultado = $cnmysql->query($query);

			$fila = mysqli_fetch_array($resultado);
			$Disponible = $fila['disponibles'];

			$cantidadNueva = abs($Disponible - 1);

			$query_2 = "UPDATE libros SET disponibles = '$cantidadNueva' WHERE id_libro = '$dCodLibro'";
			$resultado_2 = $cnmysql->query($query_2);




			$sql_3 = "SELECT id_prestamo FROM prestamos ORDER BY id_prestamo DESC LIMIT 1";
			$result_3 = $cnmysql->query($sql_3);
			$dato = mysqli_fetch_array($result_3);
			$idPrestamo = $dato['id_prestamo'];


			$sql_4 = "INSERT INTO detalle_prestamos(id_libro, id_prestamo, id_estado, Fecha_Retorno) VALUES('$dCodLibro', '$idPrestamo', '1', 'NULL')";
			$result_4 = $cnmysql->query($sql_4);

			if ($result_4) {
				echo "<p
				style='	background-color: #8FE397;
				padding: 10px;
				box-sizing: border-box;
				color: #1D7034;
				border:2px dotted #4DA459;
				text-align: center;'
				><strong>¡Éxito!: </strong> El préstamo ha sido guardado</p>";
			} else {
				echo "<p
				style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;
				text-align: center;'
				><strong>¡Error!: </strong>Los datos presentan errores, verifique por favor</p>";
			}

		//Fin de if($Result_2)
		} 


	} else {
		echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;
				text-align: center;'
		><strong>¡Error!: </strong>Falta ingresar datos</p>";
	}

 ?>