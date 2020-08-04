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
  $updateSQL = sprintf("UPDATE clientes SET nombre=%s, apaterno=%s, amaterno=%s, domicilio=%s, telefono=%s, correo=%s WHERE idcliente=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apaterno'], "text"),
                       GetSQLValueString($_POST['amaterno'], "text"),
                       GetSQLValueString($_POST['domicilio'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
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
$query_Recordset1 = sprintf("SELECT * FROM clientes WHERE idcliente = %s", GetSQLValueString($colname_Recordset1, "int"));
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
							<li><a href="OFERTAS CATALOGO.php" >OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores.php">ADMINISTRADORES</a></li>
							<li><a href="clientes.php">CLIENTES</a></li>
                            <li><a href="logueo.php">CERRAR SESIÓN</a></li>
						</ul>							
			    </nav>
			  <div id="registro">
                  <a href="clientes.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
                    <h1> MODIFICAR CLIENTE</h1>
		  </div>
	      <p>&nbsp;</p>
	      <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
	        <p>
	          <label for="idcliente2">Número de cliente:</label>
	          <input name="idcliente" type="text" id="idcliente2" value="<?php echo $row_Recordset1['idcliente']; ?>" readonly>
            </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="nombre">Nombre:</label>
	          <input name="nombre" type="text" id="nombre" value="<?php echo $row_Recordset1['nombre']; ?>">
	        </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="apaterno">Apellido Paterno:</label>
	          <input name="apaterno" type="text" id="apaterno" value="<?php echo $row_Recordset1['apaterno']; ?>">
	        </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="amaterno">Apellido Materno:</label>
	          <input name="amaterno" type="text" id="amaterno" value="<?php echo $row_Recordset1['amaterno']; ?>">
	        </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="domicilio">Domicilio:</label>
	          <textarea name="domicilio" id="domicilio"><?php echo $row_Recordset1['domicilio']; ?></textarea>
	        </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="telefono">Teléfono:</label>
	          <input name="telefono" type="text" id="telefono" value="<?php echo $row_Recordset1['telefono']; ?>">
	        </p>
	        <p>&nbsp;</p>
	        <p>
	          <label for="correo">Correo</label>
	          <input name="correo" type="text" id="correo" value="<?php echo $row_Recordset1['correo']; ?>">
            </p>
	        <p>&nbsp;</p>
	        <p>
	          <input name="MODIFICAR" type="hidden" id="MODIFICAR" value="<?php echo $row_Recordset1['idcliente']; ?>">
	          <input type="submit" name="button" id="button" value="ACTUALIZAR">
	        </p>
	        <p>&nbsp;</p>
	        <input type="hidden" name="MM_update" value="form1">
	      </form>
	      <p>&nbsp;</p>
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
</html><?php
mysql_free_result($Recordset1);

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<head>
<title id="titulo">Candiles Universales</title>
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
							<li><a href="administrador.php">INICIO</a></li>
							<li><a href="ofertas.php">OFERTAS</a></li>
							<li><a href="productos.php">PRODUCTOS</a></li>
							<li><a href="administradores.php">ADMINISTRADORES</a></li>
							<li><a href="clientes.php">CLIENTES</a></li>
						</ul>						
			    </nav>
			  <div id="registro">
                  <a href="administradores2.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
                    <h1> MODIFICAR ADMINISTRADOR</h1> 
              </div>
	          <p>&nbsp;</p>
		         <p><br>
              </p> 
			      		
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