<?php require_once('Connections/conexion.php'); ?>
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

$maxRows_Recordset1 = 4;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes ORDER BY idcliente ASC";
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

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
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
              <div id="tabadm">
                <h1 align="center">CONSULTA GENERAL DE CLIENTES </h1> 
                <a href="nuevo-administradores.php">
                  <p>&nbsp;</p></a>
                  <p><a href="nuevo-clientes.php"><img src="img/btn_nuevo.png" width="99" height="49" longdesc="img/btn_nuevo.png" border="0" ></a></p>
                  <p>&nbsp;</p>
                <table width="90%" border="1">
                    <tr>
                      <th scope="col">Número de cliente</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Apellido Paterno</th>
                      <th scope="col">Apellido Materno</th>
                      <th scope="col">Domicilio</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Correo</th>
                      <th scope="col">Eliminar</th>
                      <th scope="col">Modificar</th>
                    </tr>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_Recordset1['idcliente']; ?></td>
                      <td><?php echo $row_Recordset1['nombre']; ?></td>
                      <td><?php echo $row_Recordset1['apaterno']; ?></td>
                      <td><?php echo $row_Recordset1['amaterno']; ?></td>
                      <td><?php echo $row_Recordset1['domicilio']; ?></td>
                      <td><?php echo $row_Recordset1['telefono']; ?></td>
                      <td><?php echo $row_Recordset1['correo']; ?></td>
                      <td><a href="eliminar-client.php?b=<?php echo $row_Recordset1['idcliente']; ?>"><img src="img/btn_basura.fw.png" width="64" height="64" longdesc="img/btn_basura.fw.png"></a></td>
                      <td><a href="modificar-client.php?a=<?php echo $row_Recordset1['idcliente']; ?>"><img src="img/btn_editar_64px.fw.png" width="64" height="64" longdesc="img/btn_editar_64px.fw.png"></a></td>
                    </tr>
                      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                  </table>
                  <p>&nbsp;</p>
                  <p>&nbsp;
                <table border="0">
                    <tr>
                      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="img/btn_inicio.fw.png"></a>
                          <?php } // Show if not first page ?></td>
                      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="img/btn_atras.fw.png"></a>
                          <?php } // Show if not first page ?></td>
                      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="img/btn_adelante.fw.png"></a>
                          <?php } // Show if not last page ?></td>
                      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="img/btn_final.fw.png"></a>
                          <?php } // Show if not last page ?></td>
                    </tr>
                </table>
              </div>
                  <p>&nbsp;</p>
                  
				
			    </div>
			  </header>	  
			</div>
            
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

mysql_free_result($Recordset1);
?>
