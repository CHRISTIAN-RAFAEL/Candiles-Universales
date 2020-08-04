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
  $updateSQL = sprintf("UPDATE productos SET productonom=%s, Precio=%s, Descripcion=%s, imagen=%s WHERE productoid=%s",
                       GetSQLValueString($_POST['productonom'], "text"),
                       GetSQLValueString($_POST['precio'], "double"),
                       GetSQLValueString($_POST['Descripcion'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
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

$colname_Recordset1 = "-1";
if (isset($_GET['a'])) {
  $colname_Recordset1 = $_GET['a'];
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
							<li><a href="ofertas.php">OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores2.php">ADMINISTRADORES</a></li>
							<li><a href="clientes.php">CLIENTES</a></li>
						</ul>						
			    </nav>
              <div id="registro">
                <a href=".php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
			      		
			
<h1 align="center">MODIFICAR PRODUCTOS </h1>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
  <p>
    <label for="productoid">Codigo de producto:</label>
    <input name="productoid" type="text" id="productoid" value="<?php echo $row_Recordset1['productoid']; ?>" readonly>
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="productonom">Nombre:</label>
    <input name="productonom" type="text" id="productonom" value="<?php echo $row_Recordset1['productonom']; ?>">
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="precio">Precio:</label>
    <input name="precio" type="text" id="precio" value="<?php echo $row_Recordset1['Precio']; ?>">
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="Descripcion">Descripción:</label>
    <textarea name="Descripcion" id="Descripcion"><?php echo $row_Recordset1['Descripcion']; ?></textarea>
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="imagen">Imagen:</label>
    <input name="imagen" type="file" id="imagen" value="<?php echo $row_Recordset1['imagen']; ?>">
  </p>
  <p>&nbsp;</p>
  <p>
    <input name="MODIFICAR" type="hidden" id="MODIFICAR" value="<?php echo $row_Recordset1['productoid']; ?>">
    <input type="submit" name="button" id="button" value="ACTUALIZAR">
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_update" value="form1">
</form>
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
