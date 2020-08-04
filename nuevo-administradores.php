<?php require_once('Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO administradores (numempleado, nom, apellidoma, apellidopa, sexo, correo, usuario, contrasena) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['numempleado'], "int"),
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['apellidoma'], "text"),
                       GetSQLValueString($_POST['apellidopa'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['contrasena'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "respuesta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
 <!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<head>
		<title id="titulo">Candiles Universales </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, user-scalabe-no, initial-scale-1, maxinum-scale-1, minimum-scale-1">
	</head>
		<body>
			<div id= "principal">
				<header>
					<div id="logo">
						<img src="img/Candiles_Universales.png"
						width="200"
						height="98">
					</div>
				  <div id="bienvenida">
						<img src="img/bienvenida.png"
						width="350"
						height="50">
					</div>
					<nav class="menu">
						<ul>
							<li><a href="administrador.php">INICIO</a></li>
							<li><a href="">OFERTAS</a></li>
							<li><a href="">PRODUCTOS</a></li>
							<li><a href="">ADMINISTRADORES</a></li>
							<li><a href="">CLIENTES</a></li>
                            <li><a href="">CERRAR SESIÓN</a></li>
						</ul>						
					</nav>
					<section id="registro">
                      <h1 align="center">REGISTRO DE ADMINISTRADORES</h1>
                      <p>&nbsp;</p>
                      <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
                        <p>&nbsp;</p>
                        <p>
                        <center>
                          <input type="text" name="numempleado" id="numempleado">
                        </p>
                        <p>
                          <label for="numempleado">Número de empleado:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;                        </p>
                        <p>
                          <input type="text" name="nom" id="nom">
                        </p>
                        <p>
                          <label for="nom">Nombre:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                          <input type="text" name="apellidopa" id="apellidopa">
                        </p>
                        <p>
                          <label for="apellidopa">Apellido Paterno</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                          <input type="text" name="apellidoma" id="apellidoma">
                        </p>
                        <p>
                          <label for="apellidoma">Apellido Materno</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                          <input type="text" name="sexo" id="sexo">
                        </p>
                        <p>
                          <label for="sexo">Sexo:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                          <input type="text" name="correo" id="correo">
                        </p>
                        <p>
                          <label for="correo">Correo:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                          <input type="text" name="usuario" id="usuario">
                        </p>
                        <p>
                          <label for="usuario">Usuario:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;                        </p>
                        <p>
                          <input type="password" name="contrasena" id="contrasena">
                        </p>
                        <p>
                          <label for="contrasena">Contraseña:</label>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p><a href="administradores2.php">
                        <input type="submit" name="button" id="btn_registrar"  value="Registrar" >
                          
                        <img src="img/btn_cancelar.png" width="105" height="51" longdesc="img/btn_cancelar.png"></a>
                        </p>
                        <p>&nbsp;</p>
                        <input type="hidden" name="MM_insert" value="form1">
                      </form>
                      
                      <p>&nbsp;</p>
                      </section>
                    
				</header>				
			</div>
			<footer>
				<div class="contenedor">
					<p class="copy">Candiles universales &copy; 2020</p>
					<div class="sociales">
						<a class="icon-face" href="#"></a>
					</div>
				</div>
			</footer>
		</body>
</html>