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

$colname_Recordset1 = "-1";
if (isset($_GET['A'])) {
  $colname_Recordset1 = $_GET['A'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM ofertas WHERE ofertasid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
							<li><a href="menu-admin.php">INICIO</a></li>
							<li><a href="OFERTAS CATALOGO.php" >OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores.php">ADMINISTRADORES</a></li>
							<li><a href="clientes.php">CLIENTES</a></li>
                            <li><a href="logueo.php">CERRAR SESIÓN</a></li>
						</ul>						
					</nav>
				</header>	
               <center>
                <br />
               
<br />
<DIV class="">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Id del producto:</p>
<p>&nbsp;</p>
<p><?php echo $row_Recordset1['ofertasid']; ?></p>
<br />
<img src="ofertas/<?php echo $row_Recordset1['odertasimagen']; ?>" width="240" height="400"><br />
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Precio:</p>
<p><br />
</p>
<p><?php echo $row_Recordset1['ofertasprecio']; ?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Nombre:</p>
<p>&nbsp;</p>
 <p><?php echo $row_Recordset1['ofertanom']; ?></p>
 <p>&nbsp;</p>
 <p><br />
 </p>
 <p>Descripci&oacute;n:</p>
 <p>&nbsp;</p>
<p><?php echo $row_Recordset1['ofertades']; ?></p>
<br />

<p>&nbsp;</p>	</center>		
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
