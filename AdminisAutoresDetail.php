<!DOCTYPE html>
<?php

require 'General.php';
session_start();
$user_session = General::getUserSession();

$idAutor = 1;
if (isset($_GET['idAuto'])) {
    $idAutor = $_GET['idAuto'];
}
$tabla = 1;
if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
     
}

if ($tabla == 2){
    $autor = General::getAutor($idAutor);
}else{
    $autor = General::getAutorSupervi($idAutor); 
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
     
    if (isset($_POST['submitMod'])){
       
        $nombre = $_POST['nombre'];
        $cargo = $_POST['cargo'];
        $imagen = $_POST['imagen'];
        $link = $_POST['link'];
      
        if ($tabla == 2){
         
            if(General::updateAutor($user_session, $idAutor,$nombre,$cargo,$imagen,$link)){

                header("location:Adminis.php"); 
            }else{
               
                $error = "No se ha podido actualizar los datos";
            }
        }else{
          
            if(General::updateAutorRev($user_session, $idAutor,$nombre,$cargo,$imagen,$link)){

                header("location:Adminis.php"); 
            }else{
                   
                $error = "No se ha podido actualizar los datos";
            }
        }
    } else if (isset($_POST['submitImg'])){
   
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $error = "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error  ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo '<script language="Javascript" type="text/javascript">';
            echo 'alert("The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded"){';
            echo 'location.href = "DeleteConcep.php?id='.$idConcep.'"; } </script>';
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $autor['imagenAutores'] = "img/".basename( $_FILES["fileToUpload"]["name"]);
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
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
    
    <form method='post' name='form' id='form' enctype='multipart/form-data' align='center'>
<?php
echo "<center><h2><b><u>Detalle Autores</u></b></h2></center>";
    echo "<h3>Nombre autor: <input type='text' name='nombre' value='".$autor['nombreAutores']."'></h3>";
    echo "<h3>Cargo: <input type='text' name='cargo' value='".$autor['cargoAutores']."'></h3>";
     echo "<h3>Imagen: <input type='text' name='imagen' value='".$autor['imagenAutores']."'></h3>
    Select image to upload:
    <center><input type='file' name='fileToUpload' id='fileToUpload'>
    <input type='submit' value='Upload Image' name='submitImg'></center>";
     echo "<br><h3>Link:  <input type='text' name='link' value='".$autor['linkAutores']."'></h3>";
    if ($idAutor == 0){
        echo "<input type='submit' name='submitMod' value='Añadir'/>";
    }else{
       echo "<input type='submit' name='submitMod' value='Modificar'/>";
    }
    ?>
        
</form>
     <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</body>

</html>