<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$iduser = 1;
if (isset($_GET['idUser'])) {
    $iduser = $_GET['idUser'];
}

$rev = "false";
if (isset($_GET['rev'])) {
    $rev = $_GET['rev'];
}

if ($rev == "false"){
    $user = General::getUser($iduser);
}else{
    $user = General::getUserSupervi($iduser); 
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
 
        $nombre = $_POST['nombre'];
        $pass = $_POST['password'];
        $rol = $_POST['rol'];
 
  if ($rev == "false"){
    if(General::updateUser($user_session, $idconcepto,$nombre,$materia,$def,$vease,$fuente,$compl,$doc,$audiovi)){
        
        header("location:Adminis.php"); 
    }else{
        $error = "No se ha podido actualizar los datos";
    }
   }else{
        if(General::updateUserRev($user_session, $idconcepto,$nombre,$materia,$def,$vease,$fuente,$compl,$doc,$audiovi)){
        
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
    
    <form method='post' name='form' id='form'>
<?php
    echo "<h1>NOMBRE <input type='text' name='nombre' value='".$user['nombreUsuario']."'></h1>";
    echo "<h1>PASSWORD <input type='text' name='pass' value='".$user['password']."'></h1>";
     echo "<h1>ROL <input type='text' name='rol' value='".$user['rol']."'></h1>";
    ?>
        <input type='submit' name='mod' value='Modificar'/>
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>

</html>