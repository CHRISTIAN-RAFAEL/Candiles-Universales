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

$maxRows_producto = 10;
$pageNum_producto = 0;
if (isset($_GET['pageNum_producto'])) {
  $pageNum_producto = $_GET['pageNum_producto'];
}
$startRow_producto = $pageNum_producto * $maxRows_producto;

mysql_select_db($database_conexion, $conexion);
$query_producto = "SELECT * FROM productos ORDER BY productoid ASC";
$query_limit_producto = sprintf("%s LIMIT %d, %d", $query_producto, $startRow_producto, $maxRows_producto);
$producto = mysql_query($query_limit_producto, $conexion) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);

if (isset($_GET['totalRows_producto'])) {
  $totalRows_producto = $_GET['totalRows_producto'];
} else {
  $all_producto = mysql_query($query_producto);
  $totalRows_producto = mysql_num_rows($all_producto);
}
$totalPages_producto = ceil($totalRows_producto/$maxRows_producto)-1;

$queryString_producto = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_producto") == false && 
        stristr($param, "totalRows_producto") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_producto = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_producto = sprintf("&totalRows_producto=%d%s", $totalRows_producto, $queryString_producto);

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
               
              
              <div id="tabadm">
               <h1 >PRODUCTOS </h1> 
               <br>
              <a href="nuevo-administradores.php"><img src="img/btn_nuevo.png" width="99" height="49" longdesc="img/btn_nuevo.png" border="0" ></a>
			      		
			



              <p>&nbsp;</p>
              <table width="70%" border="1">
                <tr>
                  <th scope="col">CODIGO DE PRODUCTO</th>
                  <th scope="col">NOMBRE DE PRODUCTO</th>
                  <th scope="col">PRECIO</th>
                  <th scope="col">DESCRIPCIÓN</th>
                  <th scope="col">IMAGEN</th>
                  <th scope="col">ELIMINAR</th>
                  <th scope="col">MODIFICAR</th>
                </tr>
                
                <?php do { ?>
                <tr>
                  <td><?php echo $row_producto['productoid']; ?></td>
                  <td><?php echo $row_producto['productonom']; ?></td>
                  <td><?php echo $row_producto['Precio']; ?></td>
                  <td><?php echo $row_producto['Descripcion']; ?></td>
                   <td><?php echo $row_producto['imagen']; ?></td>
                  <td><a href="eliminar-producto.php?b=<?php echo $row_producto['productoid']; ?>"><img src="img/btn_basura.fw.png" width="64" height="64" longdesc="img/btn_basura.fw.png"></a></td>
                  <td><a href="modificar-producto.php?a=<?php echo $row_producto['productoid']; ?>"><img src="img/btn_editar_64px.fw.png" width="64" height="64" longdesc="img/btn_editar_64px.fw.png"></a></td>
                    
                </tr>
                  <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
                 
              </table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;              
              
              <table border="0">
                <tr>
                  <td><?php if ($pageNum_producto > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_producto=%d%s", $currentPage, 0, $queryString_producto); ?>"><img src="img/btn_inicio.fw.png"></a>
                      <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_producto > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_producto=%d%s", $currentPage, max(0, $pageNum_producto - 1), $queryString_producto); ?>"><img src="img/btn_atras.fw.png"></a>
                      <?php } // Show if not first page ?></td>
                  <td><?php if ($pageNum_producto < $totalPages_producto) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_producto=%d%s", $currentPage, min($totalPages_producto, $pageNum_producto + 1), $queryString_producto); ?>"><img src="img/btn_adelante.fw.png"></a>
                      <?php } // Show if not last page ?></td>
                  <td><?php if ($pageNum_producto < $totalPages_producto) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_producto=%d%s", $currentPage, $totalPages_producto, $queryString_producto); ?>"><img src="img/btn_final.fw.png"></a>
                      <?php } // Show if not last page ?></td>
                </tr>
              </table>
              </p>
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
mysql_free_result($producto);
?>
