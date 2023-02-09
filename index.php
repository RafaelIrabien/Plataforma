<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--CSS del Login -->
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <link rel="stylesheet" type="text/css" href="librerias/bootstrap_4/bootstrap.min.css">

</head>
<body>

	<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    	<br>
      <img src="img/logo_2.png" id="icon" alt="User Icon" />
      <h1>Gestor de archivos</h1>
    </div>

    <!-- Login Form -->
    <form method="POST" id="frmLogin" onsubmit="return logear()">
      <input type="text" id="login" class="fadeIn second" name="login" placeholder="Usuario">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña">
      <input type="submit" class="fadeIn fourth" value="iniciar sesion">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="registro.php">Registrarse</a>
    </div>

  </div>
</div>

<script type="text/javascript" src="librerias/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="librerias/sweetalert.min.js"></script>



<script type="text/javascript">
  
  function logear(){
    $.ajax({
      //Tipo de petición
      type: "POST",
      //La información a enviar
      data: $('#frmLogin').serialize(),
      //La url para la petición
      url: "procesos/usuario/login/login.php",

      //Código a ejecutar si la petición es satisfactoria
      success:function(respuesta) {
          //trim elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
          respuesta = respuesta.trim();

          if (respuesta == 1){
            window.location = "vistas/inicio.php";
          } 
            else {
              swal(":(", "Falló al entrar", "error");
          }
      }

    });

    //Se detiene el flujo
    return false;
  }

</script>


</body>
</html>