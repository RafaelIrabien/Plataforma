<?php 

	session_start();

	if(isset($_SESSION['nombre'])) {

	require_once "../../clases/Conexion.php";

	$c = new Conectar;
	$conexion = $c->conexion();

	$sql = "SELECT  usuario.id_usuario AS idUsuario,
    				usuario.nombre AS nombreUsuario,
    				
    				usuario.email AS Email,
    				rol.rol AS Rol
			FROM
    			usuarios AS usuario
    				
        			INNER JOIN
    			roles AS rol ON usuario.id_rol = rol.id_rol";

    $result = mysqli_query($conexion, $sql);

    $id_Usuario = $_SESSION['id_usuario'];
  	
  	$sql2 = "SELECT id_usuario, id_rol FROM usuarios WHERE id_usuario = '$id_Usuario'";
  	$result2 = mysqli_query($conexion, $sql2);
  	$fila = mysqli_fetch_array($result2);
	 // $id = $fila['id_usuario'];
	   if ($fila['id_rol'] == '2') {
    	
    
 ?>


	<div class="tabla">
		<div class="col-sm-11">
			<div class="table-responsive">
				<h1 class="display-4">Usuarios</h1>
				<br>
				
				<table class="table table-hover" id="tablaUsuariosDatatable">
					<br>
					<thead>
						<tr>
							
							<th style="text-align: center;">Nombre</th>
							<th style="text-align: center;">Foto</th>
							<th style="text-align: center;">Correo</th>
							<th style="text-align: center;">Rol</th>
							<th style="text-align: center;">Ver archivos</th>
							<th style="text-align: center;">Eliminar usuario</th>
						</tr>
					</thead>

					
					<tbody>
						<?php 
							while ($mostrar = mysqli_fetch_array($result)) {
								$id_usuario = $mostrar['idUsuario'];
								

						 ?>
						<tr>
							
							<td><?php echo $mostrar['nombreUsuario']; ?></td>

							<?php 
							 $sql2 = "SELECT foto FROM fotos WHERE id_usuario = '$id_usuario'";
							 $result2 = mysqli_query($conexion, $sql2);

								if ($fila = mysqli_fetch_array($result2)) { 
									$Foto = base64_encode($fila['foto']);
								
							?>
								
							<td><div class="img" style="background-image: url('data:image/jpeg;base64,<?php echo $Foto; ?>');"></div></td>

							<?php 
							  } else { 

							?>

							<td><div class="img" style="background-image: url(../img/Foto_perfil.webp);"></div></td>
						<?php 
							} 

						?>
							<td><?php echo $mostrar['Email']; ?></td>
							<td><?php echo $mostrar['Rol']; ?></td>
							<td>

								<span class="btn btn-primary" data-toggle="modal" data-target="#modalArchivos" onclick="obtenerArchivosUsuario('<?php echo $id_usuario; ?>')">
									<span class="fas fa-regular fa-folder-open"></span>
								</span>
								
							</td>
							<td>
								<span class="btn btn-danger" onclick="eliminarUsuario('<?php  echo $id_usuario; ?>')">
									<span class="fas fa-user-xmark"></span>
								</span>
							</td>
						
						</tr>

						 <?php
						 	} 
						  ?>
						 
						
					</tbody>
				</table>
				<br>
			</div>
		</div>
	</div>





<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaUsuariosDatatable').DataTable();
		
	});
</script>


<?php
} else {
	header("location:../inicio.php");
}


} else {
	header("location:../../index.php");
}

 ?>