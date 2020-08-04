<?php
header('Content-Type: text/html; charset=UTF-8');
?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE administradores SET nom=%s, apellidoma=%s, apellidopa=%s, sexo=%s, correo=%s, usuario=%s, contrasena=%s WHERE numempleado=%s",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['apellidoma'], "text"),
                       GetSQLValueString($_POST['apellidopa'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['contrasena'], "text"),
                       GetSQLValueString($_POST['MODIFICAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "RespuestaModificar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_modificaradmin = "-1";
if (isset($_GET['a'])) {
  $colname_modificaradmin = $_GET['a'];
}
mysql_select_db($database_conexion, $conexion);
$query_modificaradmin = sprintf("SELECT * FROM administradores WHERE numempleado = %s", GetSQLValueString($colname_modificaradmin, "int"));
$modificaradmin = mysql_query($query_modificaradmin, $conexion) or die(mysql_error());
$row_modificaradmin = mysql_fetch_assoc($modificaradmin);
$totalRows_modificaradmin = mysql_num_rows($modificaradmin);
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
							<li><a href="menu-admin.php">INICIO</a></li>
							<li><a href="OFERTAS CATALOGO.php" >OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores.php">ADMINISTRADORES</a></li>
							<li><a href="clientes.php">CLIENTES</a></li>
                            <li><a href="logueo.php">CERRAR SESIÓN</a></li>
						</ul>						
			    </nav>
				  <div id="registro">
                  <a href="administradores2.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
                    <h1> MODIFICAR ADMINISTRADOR</h1> 
                  </div>
			     <br> 
			      <p>&nbsp;</p>
			      <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
			        <p>
			          <label for="numempleado">Número de empleado:</label>
			          <input name="numempleado" type="text" id="numempleado" value="<?php echo $row_modificaradmin['numempleado']; ?>" readonly>
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="nom">Nombre:</label>
			          <input name="nom" type="text" id="nom" value="<?php echo $row_modificaradmin['nom']; ?>">
			        </p>
			        <p>&nbsp;</p>
			        <p>
			          <label for="apellidopa">Apellido Paterno:</label>
			          <input name="apellidopa" type="text" id="apellidopa" value="<?php echo $row_modificaradmin['apellidopa']; ?>">
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="apellidoma">Apellido Materno:</label>
			          <input name="apellidoma" type="text" id="apellidoma" value="<?php echo $row_modificaradmin['apellidoma']; ?>">
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="sexo">Sexo:</label>
			          <input name="sexo" type="text" id="sexo" value="<?php echo $row_modificaradmin['sexo']; ?>">
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="correo">Correo:</label>
			          <input name="correo" type="text" id="correo" value="<?php echo $row_modificaradmin['correo']; ?>">
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="usuario">Usuario:</label>
			          <input name="usuario" type="text" id="usuario" value="<?php echo $row_modificaradmin['usuario']; ?>">
			        </p>
			        <p>&nbsp; </p>
			        <p>
			          <label for="contrasena">Contraseña:</label>
			          <input name="contrasena" type="text" id="contrasena" value="<?php echo $row_modificaradmin['contrasena']; ?>">
			        </p>
			        <p>&nbsp;</p>
			        <p>
			          <input type="submit" name="button" id="button" value="ACTUALIZAR">
                      
                      <input name="MODIFICAR" type="hidden" id="MODIFICAR" value="<?php echo $row_modificaradmin['numempleado']; ?>">
			        </p>
                    
			        <p>&nbsp;</p>
			        <input type="hidden" name="MM_update" value="form1">
			      </form>
			      <p>&nbsp;</p>
			      <p>&nbsp;</p>
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
<?php
mysql_free_result($modificaradmin);
?>
