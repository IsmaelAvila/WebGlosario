<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$idMat = 1;
if (isset($_GET['idMat'])) {
    $idMat = $_GET['idMat'];
}
$rev = "false";
if (isset($_GET['rev'])) {
    $rev = $_GET['rev'];
}

if ($rev == "false"){
    $materia = General::getMateria($idMat);
}else{
    $materia = General::getMateriaSupervi($idMat); 
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
 
       
    $materiaName = $_POST['materia'];
   
    if ($rev == "false"){
        if(General::updateMateria($user_session, $idMat, $materiaName)){
            header("location:Adminis.php"); 
        }else{
            $error = "No se ha podido actualizar los datos";
        }
   }else{
        if(General::updateMateriaRev($user_session, $idMat,$materiaName)){
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

   
    echo "<h1>MATERIA <input type='text' name='materia1' value='".General::getMateriaTextLang($materia['idMateria'], 1)."'>(Español)</h1>";
        echo "<h1>MATERIA <input type='text' name='materia2' value='".General::getMateriaTextLang($materia['idMateria'], 2)."'>(Ingles)</h1>";
        echo "<h1>MATERIA <input type='text' name='materia3' value='".General::getMateriaTextLang($materia['idMateria'], 3)."'>(Frances)</h1>";

     
    ?>
        <input type='submit' name='mod' value='Modificar'/>
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>

</html>