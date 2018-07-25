<?php  
$nombre = $_POST['name'];
$para = "ismaelavilaojeda@gmail.com"; 
$correo = $_POST['email'];
$asunto = $_POST['subject'];
$message1 = $_POST['message'];   

$mensaje .= "Este mensaje fue enviado por " . $nombre . " \n"; 
$mensaje .= "Su e-mail es: " . $correo . " \n"; 
$mensaje .= "Asunto: ".$asunto . " \n"; 
$mensaje .= "Mensaje: ".$message1 . " \n";
$mensaje .= "Enviado el " . date('d/m/Y', time()); 

   

mail($para, $correo, $asunto, utf8_decode($mensaje), $header); 

echo 'mensaje enviado correctamente'; 

?> 
