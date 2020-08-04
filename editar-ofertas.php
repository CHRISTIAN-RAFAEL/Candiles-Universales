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
  $updateSQL = sprintf("UPDATE ofertas SET ofertanom=%s, ofertades=%s, ofertasprecio=%s, odertasimagen=%s WHERE ofertasid=%s",
                       GetSQLValueString($_POST['ofertanom'], "text"),
                       GetSQLValueString($_POST['ofertades'], "text"),
                       GetSQLValueString($_POST['ofertasprecio'], "double"),
                       GetSQLValueString($_POST['odertasimagen'], "text"),
                       GetSQLValueString($_POST['EDITAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE ofertas SET ofertanom=%s, ofertades=%s, ofertasprecio=%s, odertasimagen=%s WHERE ofertasid=%s",
                       GetSQLValueString($_POST['ofertanom'], "text"),
                       GetSQLValueString($_POST['ofertades'], "text"),
                       GetSQLValueString($_POST['ofertasprecio'], "double"),
                       GetSQLValueString($_POST['odertasimagen'], "text"),
                       GetSQLValueString($_POST['ofertasid'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "respuesta-edit-ofert.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE ofertas SET ofertanom=%s, ofertades=%s, ofertasprecio=%s WHERE ofertasid=%s",
                       GetSQLValueString($_POST['ofertanom'], "text"),
                       GetSQLValueString($_POST['ofertades'], "text"),
                       GetSQLValueString($_POST['ofertasprecio'], "double"),
                       GetSQLValueString($_POST['EDITAR'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "RESPUESTA_EDITAR OFERTA.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_OFERTAS = "-1";
if (isset($_GET['A'])) {
  $colname_OFERTAS = $_GET['A'];
}
mysql_select_db($database_conexion, $conexion);
$query_OFERTAS = sprintf("SELECT * FROM ofertas WHERE ofertasid = %s", GetSQLValueString($colname_OFERTAS, "int"));
$OFERTAS = mysql_query($query_OFERTAS, $conexion) or die(mysql_error());
$row_OFERTAS = mysql_fetch_assoc($OFERTAS);
$totalRows_OFERTAS = mysql_num_rows($OFERTAS);
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
                <BR />
                <BR />
                <BR />
               <center><p>EDITAR UN OFERTA</p>
                 <p>&nbsp;</p>
                 <p>&nbsp;</p>
                 <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
                   <p>
                     <label for="ofertasid">ID DE PRODUCTO</label>
                   </p>
                   <p>
                     <label for="ID DE PRODUCTO"></label>
                     <input name="ID DE PRODUCTO" type="text" id="ID DE PRODUCTO" value="<?php echo $row_OFERTAS['ofertasid']; ?>" disabled="disabled" />
                   </p>
                   <p>
                     
                   </p>
                   <p>&nbsp;</p>
                   <p>
                     <label for="ofertanom">NOMBRE DEL PRODUCTO<br>
                     </label>
                     <input name="ofertanom" type="text" id="ofertanom" value="<?php echo $row_OFERTAS['ofertanom']; ?>">
                   </p>
                   <p>&nbsp;</p>
                   <p>
                     <label for="ofertades">DESCRIPCION<br>
                     </label>
                     <input name="ofertades" type="text" id="ofertades" value="<?php echo $row_OFERTAS['ofertades']; ?>">
                   </p>
                   <p>&nbsp;</p>
                   <p>
                     <label for="ofertasprecio">PRECIO</label>
                   </p>
                   <p>
                     <input name="ofertasprecio" type="text" id="ofertasprecio" value="<?php echo $row_OFERTAS['ofertasprecio']; ?>">
                   </p>
                   <p>&nbsp;</p>
                   <p>IMAGEN</p>
                   <input name="ofertasimagen" type="file" id="ofertasimagen" value="<?php echo $row_OFERTAS['odertasimagen']; ?>" />
	<br />
<br /><br />
                   <p>&nbsp;</p>
                   <p>
                     <input name="EDITAR" type="hidden" id="EDITAR" value="<?php echo $row_OFERTAS['ofertasid']; ?>">
                     <input type="submit" name="button" id="button" value="GUARDAR CAMBIOS">
                   </p>
                   <input type="hidden" name="MM_update" value="form1">
                 </form>
                 <p>&nbsp;</p>
               
               				
        </center></div>
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
mysql_free_result($OFERTAS);
?>
