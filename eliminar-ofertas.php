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
  $deleteSQL = sprintf("DELETE FROM ofertas WHERE ofertasid=%s",
                       GetSQLValueString($_GET['ELIMINAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "RESELIMINAR.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['ELIMINAR'])) && ($_GET['ELIMINAR'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ofertas WHERE ofertasid=%s",
                       GetSQLValueString($_GET['ELIMINAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "ofertas-registradas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['ELIMINAR'])) && ($_GET['ELIMINAR'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ofertas WHERE ofertasid=%s",
                       GetSQLValueString($_GET['ELIMINAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "RESPUESTA_ELIMINAR OFERTA.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Eliminar = "-1";
if (isset($_GET['B'])) {
  $colname_Eliminar = $_GET['B'];
}
mysql_select_db($database_conexion, $conexion);
$query_Eliminar = sprintf("SELECT * FROM ofertas WHERE ofertasid = %s", GetSQLValueString($colname_Eliminar, "int"));
$Eliminar = mysql_query($query_Eliminar, $conexion) or die(mysql_error());
$row_Eliminar = mysql_fetch_assoc($Eliminar);
$totalRows_Eliminar = mysql_num_rows($Eliminar);
?>
 <!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<head>
		<title id="titulo">Candiles Universales </title>
		<meta http-equiv="content-type" content="text/html/;charset="ISO-8859-1">
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
				</header>
                <br />
                <br />
                <br />
              <center>
                <p>ELIMINAR PRODUCTOS</P>
<br />
                <br />
                <br />
                <table width="50%" border="1">
                  <tr>
                    <th scope="row">ID DEL PRODUCTO</th>
                    <td><?php echo $row_Eliminar['ofertasid']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">NOMBRE DEL PRODUCTO</th>
                    <td><?php echo $row_Eliminar['ofertanom']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">DESCRIPCION</th>
                    <td><?php echo $row_Eliminar['ofertades']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">PRECIO</th>
                    <td><?php echo $row_Eliminar['ofertasprecio']; ?></td>
                    
                  <tr>
                    <th scope="row">IMAGEN</th>
                    <td><?php echo $row_Eliminar['odertasimagen']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><form name="form1" method="get" action="">
                      <a href="RESPUESTA_ELIMINAR OFERTA.php">
                      <input name="ELIMINAR" type="hidden" id="ELIMINAR" value="<?php echo $row_Eliminar['ofertasid']; ?>">
                      <input type="submit" name="button" id="button" value="ELIMINAR">
                      </a>
                    </form></th>
                    <td><form name="form2" method="post" action="OFERTAS REGISTRADAS.php">
                      <div align="center">
                        <input type="submit" name="button2" id="button2" value="CANCELAR">
                      </div>
                    </form></td>
                  </tr>
</table>

                				
		</CENTER></div>
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
mysql_free_result($Eliminar);
?>
