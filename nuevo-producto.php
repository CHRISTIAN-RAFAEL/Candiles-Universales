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
  $insertSQL = sprintf("INSERT INTO productos (productoid, productonom, Precio, Descripcion, imagen) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['productoid'], "int"),
                       GetSQLValueString($_POST['productonom'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Descripcion'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"));

$imagen=$_FILES['imagen']['name'];
$pa='./productos/';
$des=$pa.basename($_FILES['imagen']['name']);
move_uploaded_file($_FILES['imagen']['tmp_name'],$des);

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "respuesta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT serie FROM productos ORDER BY productoid ASC";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM categoria";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

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
							<li><a href="index.php">INICIO</a></li>
							<li><a href="ofertas.php ">OFERTAS</a></li>
							<li><a href="productos-cliente.php">PRODUCTOS</a></li>
							<li><a href="contacto.php">CONTACTO</a></li>
							<li><a href="empresa.php">SOBRE NOSOTROS</a></li>
						</ul>						
			    </nav>
              <div id="registro">
                <a href="producto.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
			      		
			
<h1 align="center">REGISTRO DE PRODUCTOS </h1>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
  <p>
  <center>
    <input type="text" name="productoid" id="productoid">
  </p>
  <p>
    <label for="productoid">Codigo  de producto:</label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="productonom" id="productonom">
  </p>
  <p>
    <label for="productonom">Nombre:</label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="Precio" id="Precio">
  </p>
  <p>
    <label for="Precio">Precio:</label>
</p>
  <p>&nbsp;</p>
  <p>
    <select name="serie" size"3" id="serie">
      <?php
do {  
?>
      <option value="<?php echo $row_Recordset2['serie']?>"<?php if (!(strcmp($row_Recordset2['serie'], $row_Recordset2['serie']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['serie']?></option>
      <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
    </select>
    
    
  </p>
  <p>
    <label for="serie">Categoria</label>
  </p>
  <p>&nbsp;</p>
  <p>
    <textarea name="Descripcion" id="Descripcion"></textarea>
  </p>
  <p>
    <label for="Descripcion">Descripción:</label>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
  <p>
    <label for="imagen">Imagen del producto:</label>
    <input type="file" name="imagen" id="imagen">
  </p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
  <p>
    <input type="submit" name="button" id="button" value="REGISTRAR">
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1">
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

mysql_free_result($Recordset2);
?>
