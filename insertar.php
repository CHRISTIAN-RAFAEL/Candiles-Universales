<?php 
$conexion=include("Connections/conexion.php");
if($conexion)
echo "si hay conexion";


if(
isset($_POST['ofertasid'])&& !empty($_POST['ofertasid'])&&
isset($_POST['ofertanom'])&& !empty($_POST['ofertanom'])&&
isset($_POST['ofertades'])&& !empty($_POST['ofertades'])&&
isset($_POST['ofertasprecio'])&& !empty($_POST['ofertasprecio'])&&
isset($_POST['odertasimagen'])&& !empty($_POST['odertasimagen']))
{
	$ofertasid=$_POST['ofertasid'];
	$ofertanom=$_POST['ofertanom'];
	$ofertades=$_POST['ofertades'];
	$ofertasprecio=$_POST['ofertasprecio'];
	
$con=mysqli_connect($hostname_conexion,$database_conexion,$username_conexion,$password_conexion);
mysqli_query($con, ("INSERT INTO ofertas (ofertasid,ofertanom,ofertades,ofertasprecio) VALUES('$ofertasid',$'ofertanom','$ofertades','$ofertasprecio')"));
echo "REGISTRO";
}
else 
echo "error";
?>
