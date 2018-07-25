<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$idconcepto = 1;
if (isset($_GET['idConcep'])) {
    $idconcepto = $_GET['idConcep'];
}
echo $idconcepto;
$concepto = General::getConceptoSuperviGene($idconcepto);

if($_SERVER["REQUEST_METHOD"]=="POST"){
 
        $nombre = $_POST['nombre'];
        $materia = $_POST['materia'];
        $def = $_POST['definicion'];
        $vease = $_POST['vease'];
        $fuente = $_POST['fuente'];
        $compl = $_POST['compl'];
        $doc = $_POST['doc'];
        $audiovi = $_POST['audiovi'];
 
   
    if(General::updateConceptRev($user_session, $idconcepto,$nombre,$materia,$def,$vease,$fuente,$compl,$doc,$audiovi)){
        
        header("location:Adminis.php"); 
    }else{
        $error = "No se ha podido actualizar los datos";
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
    echo "<h1>NOMBRE CONCEPTO <input type='text' name='nombre' value=".$concepto['nombreConcepto']."></h1>";
    echo "<h1>MATERIA <input type='text' name='materia' value=".$concepto['idMateria']."></h1>";
     echo "<h1>DEFINICION <input type='text' name='definicion' value=".$concepto['definicionConcepto']."></h1>";
     echo "<h1>VEASE <input type='text' name='vease' value=".$concepto['idVeaseConcepto']."></h1>";
     echo "<h1>FUENTE <input type='text' name='fuente' value=".$concepto['fuenteConcepto']."></h1>";
     echo "<h1>INFORMACION COMPLEMENTARIA <input type='text' name='compl' value=".$concepto['informacionComplementariaConcepto']."></h1>";
    echo "<h1>DOCUMENTACION ADICIONAL <input type='text' name='doc' value=".$concepto['documentacionAdicionalConcepto']."></h1>";
    echo "<h1>MATERIAL AUDIOVISUAL <input type='text' name='audiovi' value=".$concepto['materialAudiovisualConcepto']."></h1>";
    ?>
        <input type='submit' name='mod' value='Modificar'/>
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>

</html>