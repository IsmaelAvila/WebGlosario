<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$iduser = 1;
if (isset($_GET['idUser'])) {
    $iduser = $_GET['idUser'];
}

$tabla = 1;
if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
     
}

if ($tabla == 2){
   $user = General::getUser($iduser);
}else{ 
    $user = General::getUserSupervi($iduser); 
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
 
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $rol = $_POST['rol'];
 
 if ($tabla == 2){
    if(General::updateUser($user_session, $iduser,$nombre,$pass,$rol)){
        
        header("location:Adminis.php"); 
    }else{
        $error = "No se ha podido actualizar los datos";
    }
   }else{
        if(General::updateUserRev($user_session, $iduser,$nombre,$pass,$rol)){
        
        header("location:Adminis.php"); 
    }else{
        $error = "No se ha podido actualizar los datos";
    }
   }
}

?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Glosario</title>
  <link rel="shortcut icon" href="img/LOGO3.jpg">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="favicon.ico" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate-css/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
 
</head>

<body>
    
    <form method='post' name='form' id='form' align='center'>
        <?php
        echo "<center><h2><b><u>Detalle Usuarios: </u></b></h2></center>";
        echo "<h3>Nombre: <input type='text' name='nombre' value='".$user['nombreUsuario']."'></h3>";
        echo "<h3>Password: <input type='text' name='pass' value='".$user['password']."'></h3>";
        echo "<h3>Rol: <input type='text' name='rol' value='".$user['rol']."'></h3>";
        ?>
        <input type='submit' name='mod' value='Modificar'/>
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>

</html>