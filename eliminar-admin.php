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

if ((isset($_GET['ELIMINAR'])) && ($_GET['ELIMINAR'] != "")) {
  $deleteSQL = sprintf("DELETE FROM administradores WHERE numempleado=%s",
                       GetSQLValueString($_GET['ELIMINAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "RespuestaEliminar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['numempleado'])) && ($_GET['numempleado'] != "")) {
  $deleteSQL = sprintf("DELETE FROM administradores WHERE numempleado=%s",
                       GetSQLValueString($_GET['numempleado'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());
}

$colname_eliminaradmin = "-1";
if (isset($_GET['b'])) {
  $colname_eliminaradmin = $_GET['b'];
}
mysql_select_db($database_conexion, $conexion);
$query_eliminaradmin = sprintf("SELECT * FROM administradores WHERE numempleado = %s", GetSQLValueString($colname_eliminaradmin, "int"));
$eliminaradmin = mysql_query($query_eliminaradmin, $conexion) or die(mysql_error());
$row_eliminaradmin = mysql_fetch_assoc($eliminaradmin);
$totalRows_eliminaradmin = mysql_num_rows($eliminaradmin);

header('Content-Type: text/html; charset=UTF-8');
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
                  <a href="administradores2.php"> <p align="left">&nbsp;</p></a>
                    <h1> ELIMINAR ADMINISTRADOR</h1> 
                  </div>
	          <p>&nbsp;</p>
	          <table width="60%" border="1">
	            <tr>
	              <th scope="row">Número de empleado:</th>
	              <td><?php echo $row_eliminaradmin['numempleado']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Nombre:</th>
	              <td><?php echo $row_eliminaradmin['nom']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Apellido Paterno:</th>
	              <td><?php echo $row_eliminaradmin['apellidopa']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Apellido Materno:</th>
	              <td><?php echo $row_eliminaradmin['apellidoma']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Sexo:</th>
	              <td><?php echo $row_eliminaradmin['sexo']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Correo:</th>
	              <td><?php echo $row_eliminaradmin['correo']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Usuario:</th>
	              <td><?php echo $row_eliminaradmin['usuario']; ?></td>
                </tr>
	            <tr>
	              <th scope="row">Contraseña:</th>
	              <td><?php echo $row_eliminaradmin['contrasena']; ?></td>
                </tr>
	            <tr>
	              <th scope="row"><form name="form1" method="get" action="">
	                <input name="ELIMINAR" type="hidden" id="ELIMINAR" value="<?php echo $row_eliminaradmin['numempleado']; ?>">
                    <input type="submit" name="button" id="button" value="ELIMINAR">
	              </form></th>
	              <td><form name="form2" method="post" action="administradores2.php">
                    <a href="administradores2.php"><img src="img/btn_cancelar.png" width="99" height="49" longdesc="img/btn_cancelar.png" border="0"></a>
                  </form></td>
                </tr>
	            <tr>
              </table>
	          <p>&nbsp;</p>
		         <p><br>
              </p> 
			      		
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
mysql_free_result($eliminaradmin);
?>
