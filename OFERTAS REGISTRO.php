<?php require_once('Connections/conexion.php'); ?>
<?php
include("Connections/conexion.php");
$con=mysqli_connect($hostname_conexion,$database_conexion);

if($con)
echo"SI HAY CONEXIÓN";
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
				</header><br /><br />	
 <form name="form1" id="form1" method="post" action="insertar.php" enctype="multipart/form-data">
		<br />
	<center>
    <label>ID de producto</label>
    <br />
<input type="text" name="ofertasid" id="ofertasid" />
<br /><br /><br />
<label>Nombre de producto</label>
<br />
<input type="text" name="ofertanom" id="ofertanom" />
	<br />
	<br /><br />
    <label>Descripción</label>
<br />
		<input type="text" name="ofertades" id="ofertades" />
<br />

	<br />
	<br />
    <label>Precio</label>
<br />
<input type="text" id="ofertasprecio" name="ofertasprecio" />
	<br />
<br /><br />
<label>Imagen del producto</label>
<br />
<input type="file" name="odertasimagen" id="odertasimagen" />
	<br />
<br /><br />
<input type="submit" name="enviar" id="enviar" value="REGISTRO" />
				<br /><br /><br /><br /><br /><br /></center></form>		
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