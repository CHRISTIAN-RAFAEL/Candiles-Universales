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

if ((isset($_GET['b'])) && ($_GET['b'] != "")) {
  $deleteSQL = sprintf("DELETE FROM productos WHERE productoid=%s",
                       GetSQLValueString($_GET['b'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "RespuestaEliminar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['b'])) {
  $colname_Recordset1 = $_GET['b'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM productos WHERE productoid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
                <a href="productos.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
			      		
			
<h1 align="center">ELEMINAR PRODUCTOS </h1>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<table width="125%" border="1">
  <tr>
    <th scope="row">Código de producto</th>
    <td><?php echo $row_Recordset1['productoid']; ?></td>
  </tr>
  <tr>
    <th scope="row">Nombre de producto</th>
    <td><?php echo $row_Recordset1['productonom']; ?></td>
  </tr>
  <tr>
    <th scope="row">Precio</th>
    <td><?php echo $row_Recordset1['Precio']; ?></td>
  </tr>
  <tr>
    <th scope="row">Descripción</th>
    <td><?php echo $row_Recordset1['Descripcion']; ?></td>
  </tr>
  <tr>
    <th scope="row"><form name="form1" method="post" action="">
      <input type="hidden" name="ELIMINAR" id="ELIMINAR">
      <input type="submit" name="button" id="button" value="ELIMINAR">
    </form></th>
    <td>&nbsp;</td>
  </tr>
</table>
<p align="center">&nbsp;</p>

              </div>
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
mysql_free_result($Recordset1);
?>
