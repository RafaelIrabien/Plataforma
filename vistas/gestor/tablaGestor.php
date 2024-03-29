
<?php 
	
	session_start();

	if (isset($_SESSION['nombre'])) {
		
	
	require_once "../../clases/Conexion.php";
	$c = new Conectar;
	$conexion = $c->conexion();
	$id_Usuario = $_SESSION['id_usuario'];

	$sql = "SELECT 
    				archivo.id_archivo AS idArchivo,
    				usuario.nombre AS nombreUsuario,
    				categoria.nombre AS categoria,
    				archivo.nombre AS nombreArchivo,
    				archivo.tipo AS tipoArchivo,
    				archivo.ruta AS rutaArchivo,
    				archivo.fecha AS fecha
			FROM
    			archivos AS archivo
        			INNER JOIN
    			usuarios AS usuario ON archivo.id_usuario = usuario.id_usuario
					INNER JOIN
				categorias AS categoria ON archivo.id_categoria = categoria.id_categoria
    			WHERE archivo.id_usuario = '$id_Usuario'";

    $result = mysqli_query($conexion, $sql);
 ?>


<div class="tabla">
	<div class="col-sm-11">
		<div class="table-responsive">
			<h1 class="display-4">Mis archivos</h1>
			<br>
			<div id="btn">
			<span class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarArchivos">
				<span class="fa fa-solid fa-cloud-arrow-up"></span>
			 	Agregar Archivos
			</span>
			</div>
		
			
			<table class="table table-hover" id="tablaGestorDataTable">
				<br>
				<thead>
					<tr>
						<th style="text-align: center;">Categoría</th>
						<th style="text-align: center;">Nombre</th>
						<th style="text-align: center;">Tipo de archivo</th>
						<th style="text-align: center;">Acciones</th>
					</tr>
				</thead>

				<tbody>

					<?php
						//Arreglo de extensiones validas
						$extensionesValidas = array(
												'png', 
												'jpg',
												 
												'pdf',
												
												'mp4',
												'mp3',
												'flac'
											);

						while($mostrar = mysqli_fetch_array($result)) {
						$rutaDescarga = "../archivos/"."$id_Usuario"."/".$mostrar['nombreArchivo'];
						$nombreArchivo = $mostrar['nombreArchivo'];
						$id_Archivo = $mostrar['idArchivo'];
					 ?>

					<tr>
						<td><?php echo $mostrar['categoria'];?></td>
						<td><?php echo $mostrar['nombreArchivo']; ?></td>
						<td><?php echo $mostrar['tipoArchivo']; ?></td>
						<td>
							<a href="<?php echo $rutaDescarga; ?>" download="<?php $nombreArchivo ?>">
							  <span class="btn btn-success btn-sm">
							  	<span class="fas fa-download"></span>
							  </span>
							</a>
						
							<?php 
								for ($i=0; $i < count($extensionesValidas); $i++) { 
									if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
							 ?>
							 <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalVisualizarArchivos" onclick="obtenerArchivoPorId('<?php echo $id_Archivo ?>')">
								<span class="fas fa-eye"></span>
							</span>
							<?php	

									}
								}
							 ?>
			
							<span class="btn btn-danger btn-sm" onclick="eliminarArchivo('<?php echo $id_Archivo ?>')">
								<span class="fas fa-thin fa-trash-can"></span>
							</span>
						</td>
					</tr>

					<?php 
						} //Fin del bucle while
					 ?>
				</tbody>
			</table>
			<br>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaGestorDataTable').DataTable();
	});
</script>



<?php 
	} else {
		header("location:../../index.php");
	}

 ?>