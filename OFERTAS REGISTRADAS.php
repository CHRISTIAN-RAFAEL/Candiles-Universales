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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_OFERTAS = 10;
$pageNum_OFERTAS = 0;
if (isset($_GET['pageNum_OFERTAS'])) {
  $pageNum_OFERTAS = $_GET['pageNum_OFERTAS'];
}
$startRow_OFERTAS = $pageNum_OFERTAS * $maxRows_OFERTAS;

mysql_select_db($database_conexion, $conexion);
$query_OFERTAS = "SELECT * FROM ofertas ORDER BY ofertasid ASC";
$query_limit_OFERTAS = sprintf("%s LIMIT %d, %d", $query_OFERTAS, $startRow_OFERTAS, $maxRows_OFERTAS);
$OFERTAS = mysql_query($query_limit_OFERTAS, $conexion) or die(mysql_error());
$row_OFERTAS = mysql_fetch_assoc($OFERTAS);

if (isset($_GET['totalRows_OFERTAS'])) {
  $totalRows_OFERTAS = $_GET['totalRows_OFERTAS'];
} else {
  $all_OFERTAS = mysql_query($query_OFERTAS);
  $totalRows_OFERTAS = mysql_num_rows($all_OFERTAS);
}
$totalPages_OFERTAS = ceil($totalRows_OFERTAS/$maxRows_OFERTAS)-1;

$queryString_OFERTAS = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_OFERTAS") == false && 
        stristr($param, "totalRows_OFERTAS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_OFERTAS = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_OFERTAS = sprintf("&totalRows_OFERTAS=%d%s", $totalRows_OFERTAS, $queryString_OFERTAS);
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
				</header>
                <CENTER>
             <p>&nbsp;</P>
             <p>&nbsp;</p>
             <p>OFERTAS REGISTRADAS</p>
             <p>&nbsp;</p>
             <div align="RIGHT"><form name="form1" method="post" action="OFERTAS REGISTRO.php">
               <input type="submit" name="button" id="button" value="REGISTRAR OFERTA">
             </form></div>
             <p>&nbsp;</p>
<table width="70%" border="1">
  <tr>
    <th scope="col">ID DEL PRODUCTO</th>
    <th scope="col">NOMBRE DEL PRODUCTO</th>
    <th scope="col">DESCRIPCION</th>
    <th scope="col">PRECIO</th>
    <th scope="col">IMAGEN</th>
    <th scope="col">EDITAR</th>
    <th scope="col">ELIMINAR</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_OFERTAS['ofertasid']; ?></div></td>
      <td><div align="center"><?php echo $row_OFERTAS['ofertanom']; ?></div></td>
      <td><div align="center"><?php echo $row_OFERTAS['ofertades']; ?></div></td>
      <td><div align="center"><?php echo $row_OFERTAS['ofertasprecio']; ?></div></td>
      <td><div align="center"><?php echo $row_OFERTAS['odertasimagen']; ?></div></td>
      <td><div align="center">
        <div align="center"><a href="editar-ofertas.php?A=<?php echo $row_OFERTAS['ofertasid']; ?>">EDITAR</a></div>
      </div></td>
      <td><a href="eliminar-ofertaS.php?B=<?php echo $row_OFERTAS['ofertasid']; ?>">ELIMINAR</a></td>
    </tr>
    <?php } while ($row_OFERTAS = mysql_fetch_assoc($OFERTAS)); ?>
</table>
<p>&nbsp;
<p>
<p>
<table border="0">
  <tr>
    <td><?php if ($pageNum_OFERTAS > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_OFERTAS=%d%s", $currentPage, 0, $queryString_OFERTAS); ?>"><img src="First.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_OFERTAS > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_OFERTAS=%d%s", $currentPage, max(0, $pageNum_OFERTAS - 1), $queryString_OFERTAS); ?>"><img src="Previous.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_OFERTAS < $totalPages_OFERTAS) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_OFERTAS=%d%s", $currentPage, min($totalPages_OFERTAS, $pageNum_OFERTAS + 1), $queryString_OFERTAS); ?>"><img src="Next.gif" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_OFERTAS < $totalPages_OFERTAS) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_OFERTAS=%d%s", $currentPage, $totalPages_OFERTAS, $queryString_OFERTAS); ?>"><img src="Last.gif" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
              </center></p>			
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