<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$idconcepto = 1;
if (isset($_GET['idConcep'])) {
    $idconcepto = $_GET['idConcep'];
}
$tabla = 1;
if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
     
}
$lang = 1;
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
     
}

if ($tabla == 1){
     $concepto = General::getConceptoSuperviGene($idconcepto); 
}else{
    $concepto = General::getConcepto($idconcepto);
    if ($concepto['idConcepto'] == ''){
         $concepto = General::getConceptoSuperviGene($idconcepto); 
    }
}


$nombre = General::getConceptoTextLang($concepto['idNombreConcepto'],$lang);
$def = General::getDefinicionTextLang($concepto['idDefinicionConcepto'],$lang);
$compl = General::getInfoCompleTextLang($concepto['idInfoCompleConcepto'], $lang);
$doc = General::getDocumAdiciTextLang($concepto['idDocumentacionAdicionalConcepto'], $lang);

if ($concepto['idVeaseConcepto'] == ''){
    $idVease = $_SESSION['idVease'];  
}else{
    $idVease = $concepto['idVeaseConcepto'];
}

if ($concepto['idfuenteConcepto'] == ''){
    $idFuenteCon = $_SESSION['idFuente'];
}else{
     $idFuenteCon = $concepto['idfuenteConcepto'];
}

if ($concepto['idMaterialAudiovisualConcepto'] == ''){
    $idMateAudi = $_SESSION['idMateAudi'];
}else{
    $idMateAudi = $concepto['idMaterialAudiovisualConcepto'];
}

$rowVease = General::getVease($idVease);

$error = "";


if($_SERVER["REQUEST_METHOD"]=="POST"){

        $nombre = $_POST['nombre'];
        $materia = $_POST['materiaSelec'];
        $def = $_POST['definicion'];
        $compl = $_POST['compl'];
        $doc = $_POST['doc'];
        $idVease = $_POST['vease'];
        $idFuenteCon = $_POST['fuente'];
        $idMateAudi = $_POST['matAudi'];
        
    
     if (isset($_POST['cancel'])){
          echo '<script type="text/javascript">'; 
                echo 'alert("Se ha cancelado la modificación de los datos.");'; 
                echo 'window.location.href = "Adminis.php";';
                echo '</script>';
      
     }else if (isset($_POST['next'])){
  
       if ($tabla == 2){
           if ($user_session['rol']== "ADMIN"){
               $idconceptotemp = General::updateConceptAdmin($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           }else{
                $idconceptotemp = General::updateConceptOwner($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           }
           
           if($idconceptotemp != 0){ 
                
                 header("location:AdminisDetail.php?idConcep=".$idconceptotemp."&tabla=".$tabla."&lang=". ($lang + 1));
            }else{
               
                $error = "No se ha podido actualizar los datos";
            }
            
        }else{
           $idconceptotemp = General::updateConceptRev($user_session, $idconcepto, $nombre, $materia, $def,  $compl, $doc, $lang,$idVease, $idFuenteCon, $idMateAudi, 0);
            if($idconceptotemp != 0){ 
                
                header("location:AdminisDetail.php?idConcep=".$idconceptotemp."&tabla=".$tabla."&lang=".($lang + 1));
            }else{
                
                $error = "No se ha podido actualizar los datos";
            }
        }
     }else if (isset($_POST['back'])){
         
        if ($tabla == 2){
           if ($user_session['rol']== "ADMIN"){
               $idconceptotemp = General::updateConceptAdmin($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           }else{
                $idconceptotemp = General::updateConceptOwner($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           }
            
            if($idconceptotemp != 0){
                 header("location:AdminisDetail.php?idConcep=".$idconceptotemp."&tabla=".$tabla."&lang=".($lang - 1));
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }else{
            $idconceptotemp = General::updateConceptRev($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi, 0);
            if($idconceptotemp != 0){ 
                header("location:AdminisDetail.php?idConcep=".$idconceptotemp."&tabla=".$tabla."&lang=".($lang - 1));
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }
         
    }else if (isset($_POST['end'])){       
        if ($tabla == 2){
             if ($user_session['rol']== "ADMIN"){
               $idconceptotemp = General::updateConceptAdmin($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           }else{
                $idconceptotemp = General::updateConceptOwner($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi);
           } 
            if($idconceptotemp != 0){
                echo '<script type="text/javascript">'; 
                echo 'alert("Se ha guardado con éxito los datos");'; 
                echo 'window.location.href = "Adminis.php";';
                echo '</script>';
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }else{
            $idconceptotemp = General::updateConceptRev($user_session, $idconcepto, $nombre, $materia, $def, $compl, $doc, $lang, $idVease, $idFuenteCon, $idMateAudi, 1);
            if($idconceptotemp != 0){ 
                header("location:Adminis.php");
            }else{
                $error = "No se ha podido actualizar los datos";
            }
        }
         
     }else if (isset($_POST['addVease'])){
        
            echo "<script>";
         
         if ($idVease == ""){
             $idVease = 0;
         }
            echo "var winOpen = window.open('veaseSelec.php?idVease=".$idVease."','_blank', 'width=700,height=700');";
            echo "winOpen.window.focus();";
            echo "</script>";
         
     }else if (isset($_POST['checkVease'])){
       
         General::deleteVease($idVease);
         General::updateVeaseConcepto($idconcepto);
        
         $checkValues = explode(',', $_POST['checkVease']);
         
         foreach ($checkValues as $check){
           $idVease = General::setVease($idVease, $check);
         }
         $_SESSION['idVease'] = $idVease;
         $rowVease = General::getVease($idVease);
         
     }else if (isset($_POST['addFuente'])){
         if ($idFuenteCon == ""){
             $idFuenteCon = 0;
         }
         
          echo "<script>";
            echo "var winOpen2 = window.open('fuenteSelect.php?idFuente=".$idFuenteCon."','_blank', 'width=700,height=700');";
            echo "winOpen2.window.focus();";
            echo "</script>";
         
     }else if (isset($_POST['changeFuente'])){
        
         
         $fuenteValues = explode(',', $_POST['changeFuente']);
         
         $name = $fuenteValues[0];
          
         $link = $fuenteValues[1];
         
         $idFuenteTemp = General::setFuente($idFuenteCon, $name, $link);
         
         if ($idFuente == 0){
             $idFuenteCon = $idFuenteTemp;
         }else{
              General::updateFuenteConcepto($idFuenteCon, $idconcepto);
         }
          $_SESSION['idFuente'] = $idFuenteCon;
     }else if (isset($_POST['addMaterial'])){
      
         if ($idMateAudi == ""){
             $idMateAudi = 0;
         }
        
           echo "<script>";
            echo "var winOpen2 = window.open('MateAudioViSelect.php?idMate=".$idMateAudi."','_blank', 'width=700,height=700');";
            echo "winOpen2.window.focus();";
            echo "</script>";
    
     }else if (isset($_POST['changeMatAV'])){
       
         $MatAVValues = explode(',', $_POST['changeMatAV']);
         
         $name = $MatAVValues[0];
          
         $link = $MatAVValues[1];
         
         $idMat = $MatAVValues[2];
        
         $idMateAV = General::setMaterialAudivo($idMat, $name, $link);
          
        $idMateAudi = General::updateMaterialAudivoConcepto($idMateAV, $idMateAudi, $idconcepto);
         $_SESSION['idMateAudi'] = $idMateAudi;
         
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
        echo " <input type='hidden' name='vease' value='".$idVease."'/>";
        echo " <input type='hidden' name='fuente' value='".$idFuenteCon."'/>";
        echo " <input type='hidden' name='matAudi' value='".$idMateAudi."'/>";
        
        echo "<center><h2><b><u>Detalle Concepto";
        if ($lang == 1){
            echo " - Idioma: Español";
        }else if ($lang == 2){
             echo " - Language: English";
        }else if ($lang == 3){
             echo " - Langage: Française";
        }
        
         echo "</u></b></h2></center>";
       
        echo "<h3>Nombre Concepto: <input type='text' name='nombre' value='".$nombre."'></h1>";
        
        echo "<h3>Materia: </h3>";
        $rowMaterias = General::getMateriaGeneral();
        echo "<select id='materiaSelec' name='materiaSelec'><h3>Materia</h3>";
        
        foreach ($rowMaterias as $rowMateria)
        {
            echo "<option value='".$rowMateria['idMateria']."' ";
           
            if ($rowMateria['idMateria'] == $concepto['idMateria']){
               echo "selected ";
           }
           
            echo " >".General::getMateriaTextLang($rowMateria['idMateria'],$lang)."</option>";
        }
        
        echo "</select>";
        echo "<h3>Definición:  <input type='text' name='definicion' value='".$def."'></h3>";
        echo "<h3>Vease: </h3>";
        foreach ($rowVease as $rowVer)
        {
            $idConceptoRow = $rowVer['idConcepto'];
            $conceptoRow = General::getConcepto($idConceptoRow);
            echo "<li><a class='textoMagenta' href='Concepto.php?id=".$idConceptoRow."'> ".General::getConceptoTextLang($conceptoRow['idNombreConcepto'],$lang)." </a></li>";
        }
       
        
        echo " <input type='submit' name='addVease' value='Añadir Conceptos'/>";
    
        echo "<h3>Fuente: </h3>";
        $fuente = General::getFuente($idFuenteCon);
        if ($fuente != null){
            echo "<li><a class='textoMagenta' href='".$fuente['linkFuente']."'> ".$fuente['nombreFuente']." </a></li>";
        }
        echo " <input type='submit' name='addFuente' value='Añadir Fuente'/>";
        
        echo "<h3>Información complementaria: <input type='text' name='compl' value='". $compl ."'></h3>";
        echo "<h3>Documentación adicional: <input type='text' name='doc' value='".$doc."'></h3>";
        echo "<h3>Material audiovisual: </h3>";
        $audioVisual = General::getAudioVisual($concepto['idMaterialAudiovisualConcepto']);
        foreach ($audioVisual as $audiVi)
        {
            $matAudi = General::getAudioVisualID($audiVi['idMatAudiViConcep']);
            echo "<li><a class='textoMagenta'  href=' " .$matAudi['linkMateAudioViConcep']. " '> " .$matAudi['nombreMateAudioViCon']. " </a></li>";
         }
        
        echo " <input type='submit' name='addMaterial' value='Añadir Material'/>";
        echo "<br>";
        
        if ($lang == 1){
            echo "<br><input type='submit' name='next' value='Siguiente'/>";
       }else  if ($lang == 2){
           echo "<input type='submit' name='back' value='Atras'/>";
           echo "<br><input type='submit' name='next' value='Siguiente'/>";
       }else  if ($lang == 3){
           echo "<input type='submit' name='back' value='Atras'/>";
           echo "<br><input type='submit' name='end' value='Finalizar'/>";
       }
         echo "<br><input type='submit' name='cancel' value='Cancelar'/>";
    ?>

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
        
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "changeFuente");
        hiddenField.setAttribute("value", array);
        form.appendChild(hiddenField);

        form.submit();
    }
        
    function  changeMateAD(nombreMatAV, linkMatAV, idMatAV){
        
        var form = document.getElementById('form');
        var hiddenField = document.createElement("input");
        
        var array = [nombreMatAV, linkMatAV, idMatAV];
       
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "changeMatAV");
        hiddenField.setAttribute("value", array);
        form.appendChild(hiddenField);

        form.submit();
    }
        
       
</script>
</body>

</html>