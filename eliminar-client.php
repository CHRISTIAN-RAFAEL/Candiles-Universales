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

if ((isset($_GET['b'])) && ($_GET['b'] != "")) {
  $deleteSQL = sprintf("DELETE FROM clientes WHERE idcliente=%s",
                       GetSQLValueString($_GET['b'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());

  $deleteGoTo = "RespuestaEliminar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_eliminarcli = "-1";
if (isset($_GET['b'])) {
  $colname_eliminarcli = $_GET['b'];
}
mysql_select_db($database_conexion, $conexion);
$query_eliminarcli = sprintf("SELECT * FROM clientes WHERE idcliente = %s", GetSQLValueString($colname_eliminarcli, "int"));
$eliminarcli = mysql_query($query_eliminarcli, $conexion) or die(mysql_error());
$row_eliminarcli = mysql_fetch_assoc($eliminarcli);
$totalRows_eliminarcli = mysql_num_rows($eliminarcli);

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
                    <h1> ELIMINAR CLIENTE</h1> 
  </div>
  <p>&nbsp;</p>
          <p>&nbsp;</p>
		         <table width="40%" border="1">
		           <tr>
		             <th width="48%" scope="row">Número de Cliente:</th>
		             <td width="52%"><?php echo $row_eliminarcli['idcliente']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row">Nombre:</th>
		             <td><?php echo $row_eliminarcli['nombre']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row">Apellido Paterno:</th>
		             <td><?php echo $row_eliminarcli['apaterno']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row">Apellido Materno:</th>
		             <td><?php echo $row_eliminarcli['amaterno']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row">Domicilio:</th>
		             <td><?php echo $row_eliminarcli['domicilio']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row"><p>Teléfono:</p></th>
		             <td><?php echo $row_eliminarcli['telefono']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row">Correo:</th>
		             <td><?php echo $row_eliminarcli['correo']; ?></td>
	               </tr>
		           <tr>
		             <th scope="row"><form name="form1" method="get" action="">
		               <input name="ELIMINAR" type="hidden" id="ELIMINAR" value="<?php echo $row_eliminarcli['idcliente']; ?>">
	                   <input type="submit" name="button" id="button" value="ELIMINAR">
		             </form></th>
		             <td><form name="form2" method="post" action="clientes.php"><a href="clientes.php"><img src="img/btn_cancelar.png" width="99" height="49" longdesc="img/btn_cancelar.png" border="0"></a>
		             </form></td>
	               </tr>
          </table>
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
<?php
mysql_free_result($eliminarcli);
?>
