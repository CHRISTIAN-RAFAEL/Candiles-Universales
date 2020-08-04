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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM ofertas";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<head>
		<title id="titulo">Candiles Universales </title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
				</header><center>
                <br />
<br /> <br /><br />
<br /> <br />
                <p>OFERTAS</p>
<?php do { ?>
  <DIV class="forma">
    <p><a href="OFERTAS DETALLES.php?A=<?php echo $row_Recordset1['ofertasid']; ?>"><img src="ofertas/<?php echo $row_Recordset1['odertasimagen']; ?>" width="202" height="109"></a></p>
    <p>&nbsp;</p>
    <p>Nombre: <?php echo $row_Recordset1['ofertanom']; ?></p>
    <p>&nbsp;</p>
    <p>Precio:<?php echo $row_Recordset1['ofertasprecio']; ?></p>
    <p>&nbsp;</p>
    <p>Id del producto:<?php echo $row_Recordset1['ofertasid']; ?></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>		
  </div>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</center>
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
