<?php 
	include('conexion.php');

	$dCod = $_POST['vcod'];
	$dGenero = $_POST['vgen'];

	if (!empty($dGenero) && !empty($dCod)) {
		
		$sql = "UPDATE generos SET genero = '$dGenero' WHERE id_genero = '$dCod'";

		$result = $cnmysql->query($sql);

		if ($result) {
			
			echo "<p
			style='	background-color: #8FE397;
					padding: 10px;
					box-sizing: border-box;
					color: #1D7034;
					border:2px dotted #4DA459;'
			><strong>¡Exito!</strong> Género fué modificado</p>";

		} else {

			echo "<p
			style='	background-color: #EE9393;
					padding: 10px;
					box-sizing: border-box;
					color: #E33E3E;
					border:2px dotted #E33E3E;'
			><strong>¡Error!</strong> Género no fué modificado</p>";

		}

	} else {

		echo "<p
		style='	background-color: #EE9393;
				padding: 10px;
				box-sizing: border-box;
				color: #E33E3E;
				border:2px dotted #E33E3E;'
		><strong>¡Error!</strong> Ingrese un código y un género para modificar</p>";

	}

 ?>