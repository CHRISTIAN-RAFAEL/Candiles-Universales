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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_administradores = 4;
$pageNum_administradores = 0;
if (isset($_GET['pageNum_administradores'])) {
  $pageNum_administradores = $_GET['pageNum_administradores'];
}
$startRow_administradores = $pageNum_administradores * $maxRows_administradores;

mysql_select_db($database_conexion, $conexion);
$query_administradores = "SELECT * FROM administradores ORDER BY numempleado ASC";
$query_limit_administradores = sprintf("%s LIMIT %d, %d", $query_administradores, $startRow_administradores, $maxRows_administradores);
$administradores = mysql_query($query_limit_administradores, $conexion) or die(mysql_error());
$row_administradores = mysql_fetch_assoc($administradores);

if (isset($_GET['totalRows_administradores'])) {
  $totalRows_administradores = $_GET['totalRows_administradores'];
} else {
  $all_administradores = mysql_query($query_administradores);
  $totalRows_administradores = mysql_num_rows($all_administradores);
}
$totalPages_administradores = ceil($totalRows_administradores/$maxRows_administradores)-1;

$queryString_administradores = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_administradores") == false && 
        stristr($param, "totalRows_administradores") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_administradores = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_administradores = sprintf("&totalRows_administradores=%d%s", $totalRows_administradores, $queryString_administradores);
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
                
                  
					<?php echo $row_administradores['numempleado']; ?>
					<div id="tabadm"> <a href="nuevo-administradores.php"><img src="img/btn_nuevo.png" width="99" height="49" longdesc="img/btn_nuevo.png" border="0" ></a>
					  <table width="90%" border="1">
					  <tr>
					    <th width="8%" bgcolor="#FFFFFF" scope="col">Número de empleado</th>
                        <th width="10%" bgcolor="#FFFFFF" scope="col">Nombre</th>
					    <th width="9%" bgcolor="#FFFFFF" scope="col">Apellido Paterno</th>
					    <th width="15%" bgcolor="#FFFFFF" scope="col">Apellido Materno</th>
					    <th width="14%" bgcolor="#FFFFFF" scope="col">Sexo</th>
					    <th width="15%" bgcolor="#FFFFFF" scope="col">Correo</th>
					    <th bgcolor="#FFFFFF" scope="col">Usuaro</th>					    
					    <th width="7%" bgcolor="#FFFFFF" scope="col">Eliminar</th>
					    <th width="8%" bgcolor="#FFFFFF" scope="col">Modificar</th>
				      </tr>
                      <?php do { ?>
                        <tr>
                          <td height="52" bgcolor="#FFFFFF"><?php echo $row_administradores['numempleado']; ?></td>
                          <td bgcolor="#FFFFFF"><?php echo $row_administradores['nom']; ?></td>
                          <td bgcolor="#FFFFFF"><?php echo $row_administradores['apellidopa']; ?></td>
                          <td bgcolor="#FFFFFF"><?php echo $row_administradores['apellidoma']; ?></td>
                          <td bgcolor="#FFFFFF"><p><?php echo $row_administradores['sexo']; ?></p></td>
                          <td bgcolor="#FFFFFF"><p>&nbsp;</p>
                            <p><?php echo $row_administradores['correo']; ?></p>
                            <p>&nbsp;</p></td>
                          <td bgcolor="#FFFFFF"><p><?php echo $row_administradores['usuario']; ?></p></td>
                          <td bgcolor="#FFFFFF"><a href="eliminar-admin.php?b=<?php echo $row_administradores['numempleado']; ?>"><img src="img/btn_Borrar.png" width="79" height="39" longdesc="img/btn_Borrar.png"></a></td>
                          <td bgcolor="#FFFFFF"><a href="modificar-admin.php?a=<?php echo $row_administradores['numempleado']; ?>"><img src="img/btn_Editar.png" width="82" height="37" longdesc="img/btn_Editar.png" border="0"></a></td>
                        </tr>
                        <?php } while ($row_administradores = mysql_fetch_assoc($administradores)); ?>
<tr>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
					    <td bgcolor="#FFFFFF">&nbsp;</td>
				      </tr>
	  </table>
			    </div>
			  </header>	  
			</div>
            <div id="paginadoadmin" align="center">
                  <table border="0">
                    <tr>
                      <td><?php if ($pageNum_administradores > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_administradores=%d%s", $currentPage, 0, $queryString_administradores); ?>"><img src="img/btn_inicio.fw.png"></a>
                          <?php } // Show if not first page ?></td>
                      <td><?php if ($pageNum_administradores > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_administradores=%d%s", $currentPage, max(0, $pageNum_administradores - 1), $queryString_administradores); ?>"><img src="img/btn_atrasr.fw.png"></a>
                          <?php } // Show if not first page ?></td>
                      <td><?php if ($pageNum_administradores < $totalPages_administradores) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_administradores=%d%s", $currentPage, min($totalPages_administradores, $pageNum_administradores + 1), $queryString_administradores); ?>"><img src="img/btn_adelante.fw.png"></a>
                          <?php } // Show if not last page ?></td>
                      <td><?php if ($pageNum_administradores < $totalPages_administradores) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_administradores=%d%s", $currentPage, $totalPages_administradores, $queryString_administradores); ?>"><img src="img/btn_final.fw.png"></a>
                          <?php } // Show if not last page ?></td>
                    </tr>
                  </table>
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
mysql_free_result($administradores);
?>
