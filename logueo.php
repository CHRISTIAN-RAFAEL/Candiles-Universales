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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "menu-admin.php";
  $MM_redirectLoginFailed = "sinacceso.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT usuario, contrasena FROM administradores WHERE usuario=%s AND contrasena=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

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
<body><div id= "principal">
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
											
	      </nav>
		  <div id="registro">
            <a href="administradores2.php"> <p align="left">&nbsp;</p></a>
                    <h1>INICIAR SESIÓN </h1>
                    <p>&nbsp;</p>
            <p>&nbsp;</p> 
          </div>
  <p>&nbsp;</p>
          <center>
          <p align="center">&nbsp;</p>
	         <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
	           <p>
	             <label for="usuario"><img name="login" src="img/login.png" width="380" height="225" alt=""><br>
	               <br>
<br>
                 Nombre de usuario:</label>
	             <input type="text" name="usuario" id="usuario">
               </p>
	           <p>&nbsp;</p>
	           <p>
	             <label for="contrasena">Contraseña:</label>
	             <input type="password" name="contrasena" id="contrasena">
	           </p>
	           <p>&nbsp;</p>
	           <p>
	             <input type="submit" name="button" id="button" value="INGRESAR">
	           </p>
            </form>
          </center>
	         <p align="center"><br>
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