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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM ofertas";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
							<li><a href="ofertas.php">OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores.php">ADMINISTRADORES</a></li>
							<li><a href="nuevo-cliente.php">CLIENTES</a></li>
						</ul>						
					</nav>
				</header>
				<br /><br /><br />
<form name="form1" id="form1" method="post" action="file:///C|/Users/rey_m/Desktop/CATOLOGO/insertar.php" enctype="multipart/form-data">
		<br />
	<center>
<input type="text" name="nombre" id="nombre" />
	<br />
	<label>Nombre de producto</label>
<br /><br /><br />
		<input type="text" name="descripción" id="descripción" />
<br />
<label>Descripción</label>
	

<br />
	<br />
	<br />
<input type="text" id="Precio" name="Precio" />
	<br />
<label>Precio</label>
<br /><br /><br />
<input type="file" name="imagen" id="imagen" />
	<br />
<label>Imagen del producto</label>
<br /><br /><br />
<input type="submit" name="enviar" id="enviar" value="REGISTRO" />
				<br /><br /><br /><br /><br /><br /></center>
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
