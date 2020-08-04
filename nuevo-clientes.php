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
  $insertSQL = sprintf("INSERT INTO clientes (nombre, apaterno, amaterno, telefono,domicilio,correo) VALUES (%s, %s, %s, %s,%s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apaterno'], "text"),
                       GetSQLValueString($_POST['amaterno'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['domicilio'], "text"),
                       GetSQLValueString($_POST['correo'], "text"));
					   
  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "respuesta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
?>
<?php
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
                <a href="administradores2.php"> <p align="left"><img src="img/btn_atrasr.fw.png" width="64" height="64" longdesc="img/btn_atrasr.fw.png"></p></a>
			      		
			
<h1 align="center">REGISTRO DE CLIENTES </h1>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">
  <input type="text" name="idcliente" id="idcliente" />
</p>


<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>
  <center>
    <label for="idcliente">Numero de cliente: </label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="nombre" id="nombre" />
  </p>
  <p>
    <label for="nombre">Nombre: </label>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="apaterno" id="apaterno" />
  </p>
  <p>
    <label for="apaterno">Apellido Paterno: <br>
      <br>
    </label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="amaterno" id="amaterno" />
  </p>
  <p>
    <label for="amaterno">Apellido Materno</label>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <input type="INT" name="telefono" id="telefono" />
</p>
  <p>
    <label for="telefono">Teléfono: <br>
      <br>
    </label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="text" name="domicilio" id="domicilio">
  </p>
  <p>
    <label for="domicilio">
      Domicilio</label>
  </p>
  <p>
    <label for="textfield"></label>
  </p>
  <p>&nbsp; </p>
  <p>
    <input type="text" name="correo" id="correo" />
  </p>
  <p>
    <label for="correo">Email: </label>
  </p>
  <p>&nbsp; </p>
  <p>
  <center>
    <input name="button" type="submit" id="button" value="Guardar" />
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

</div>
</div>
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