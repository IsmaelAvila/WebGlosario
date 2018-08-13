<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$idconcepto = 1;
if (isset($_GET['idConcep'])) {
    $idconcepto = $_GET['idConcep'];
}
$rev = "false";
if (isset($_GET['rev'])) {
    $rev = $_GET['rev'];
     
}

if ($rev == "false"){
    $concepto = General::getConcepto($idconcepto);
}else{
   
    $concepto = General::getConceptoSuperviGene($idconcepto); 
}

$rowVease = General::getVease($concepto['idVeaseConcepto']);

$idFuente = $concepto['idfuenteConcepto'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
  
     if (isset($_POST['mod'])){
     
        $nombre = $_POST['nombre'];
        $materia = $_POST['materiaSelec'];
        $def = $_POST['definicion'];
        $vease = $_POST['vease'];
        $fuente = $_POST['fuente'];
        $compl = $_POST['compl'];
        $doc = $_POST['doc'];
        $audiovi = $_POST['audiovi'];
 
        if (!rev){
            if(General::updateConcept($user_session, $idconcepto,$nombre,$materia,$def,$vease,$fuente,$compl,$doc,$audiovi)){
                header("location:Adminis.php"); 
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }else{
            if(General::updateConceptRev($user_session, $idconcepto, $nombre, $materia, $def, $vease, $fuente, $compl, $doc, $audiovi)){
                header("location:Adminis.php"); 
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }
     }else if (isset($_POST['addVease'])){
         
            echo "<script>";
            echo "var winOpen = window.open('veaseSelec.php?idVease=".$concepto['idVeaseConcepto']."','_blank', 'width=700,height=700');";
            echo "winOpen.window.focus();";
            echo "</script>";
     }else if (isset($_POST['checkVease'])){
        
         $idVease = $concepto['idVeaseConcepto'];
         General::deleteVease($idVease);
         if ($idVease == 0 && General::updateVeaseConcepto($idconcepto)){
            $idVease = $idconcepto;
         }
        
         $checkValues = explode(',', $_POST['checkVease']);
         foreach ($checkValues as $check){
            General::setVease($idVease, $check);
         }
         $rowVease = General::getVease($idVease);
     }else if (isset($_POST['addFuente'])){
          echo "<script>";
            echo "var winOpen2 = window.open('fuenteSelect.php?idFuente=".$concepto['idfuenteConcepto']."','_blank', 'width=700,height=700');";
            echo "winOpen2.window.focus();";
            echo "</script>";
         
     }else if (isset($_POST['changeFuente'])){
         
         $fuenteValues = explode(',', $_POST['changeFuente']);
         
         $name = $fuenteValues[0];
          
         $link = $fuenteValues[1];
         
         $idFuente = General::setFuente($idFuente, $name, $link);
         
         General::updateFuenteConcepto($idFuente, $idconcepto);
         
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
    
    <form method='post' name='form' id='form' align="center">
<?php
    
        echo "<h1>NOMBRE CONCEPTO <input type='text' name='nombre' value='".$concepto['nombreConcepto']."'></h1>";
        
        echo "<h1>MATERIA</h1>";
        $rowMaterias = General::getMateriaGeneral();
        echo "<select id='materiaSelec' name='materiaSelec'><h1>MATERIA</h1>";
        
        foreach ($rowMaterias as $rowMateria)
        {
            echo "<option value='".$rowMateria['idMateria']."' ";
           
            if ($rowMateria['idMateria'] == $concepto['idMateria']){
               echo "selected ";
           }
           
            echo " >".$rowMateria['nombreMateria']."</option>";
        }
        echo "</select>";
        echo "<h1>DEFINICION <input type='text' name='definicion' value='".$concepto['definicionConcepto']."'></h1>";
        echo "<h1>VEASE</h1>";
        foreach ($rowVease as $rowVer)
        {
            $idConceptoRow = $rowVer['idConcepto'];
            $concepto = General::getConcepto($idConceptoRow);
            echo "<li><a class='textoMagenta' href='Concepto.php?id=".$idConceptoRow."'> ".$concepto['nombreConcepto']." </a></li>";
        }
        echo " <input type='submit' name='addVease' value='Añadir Conceptos'/>";
    
        echo "<h1>FUENTE</h1>";
        $fuente = General::getFuente($idFuente);
        if ($fuente != null){
            echo "<li><a class='textoMagenta' href='".$fuente['linkFuente']."'> ".$fuente['nombreFuente']." </a></li>";
        }
        echo " <input type='submit' name='addFuente' value='Añadir Fuente'/>";
        
        echo "<h1>INFORMACION COMPLEMENTARIA <input type='text' name='compl' value='".$concepto['informacionComplementariaConcepto']."'></h1>";
    
        echo "<h1>DOCUMENTACION ADICIONAL <input type='text' name='doc' value='".$concepto['documentacionAdicionalConcepto']."'></h1>";
        echo "<h1>MATERIAL AUDIOVISUAL</h1>";
        $audioVisual = General::getAudioVisual($concepto['idMaterialAudiovisualConcepto']);
        foreach ($audioVisual as $audiVi)
        {
            $matAudi = General::getAudioVisualID($audiVi['idMatAudiViConcep']);
            echo "<li><a class='textoMagenta'  href=' " .$matAudi['linkMateAudioViConcep']. " '> " .$matAudi['nombreMateAudioViCon']. " </a></li>";
         }
        echo " <input type='submit' name='addMaterial' value='Añadir Material'/>";
   
    ?>
        <br>
        <input type='submit' name='mod' value='Modificar'/>
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
    <script>
      function selection(array){
         
        var form = document.getElementById('form');
        var hiddenField = document.createElement("input");
        
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "checkVease");
        hiddenField.setAttribute("value", array);
        form.appendChild(hiddenField);
        
        form.submit();
          
       
    }
    function changeFuente(nombrefuente, linkFuente){
       
        var form = document.getElementById('form');
        var hiddenField = document.createElement("input");
        
        var array = [nombrefuente, linkFuente];
         console.log(array);
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "changeFuente");
        hiddenField.setAttribute("value", array);
        form.appendChild(hiddenField);

        form.submit();
    }
</script>
</body>

</html>