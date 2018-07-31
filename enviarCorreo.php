<?php
   //Reseteamos variables a 0.
  // $name = $email = $subject = $message = $para = $headers = $msjCorreo = NULL;
   if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
      //Obtenemos valores input formulario
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];   
      $message = $_POST['message'];
      $para = 'p62ramon@gmail.com';

      //Creamos cabecera.
      $headers = 'From: ' . $email . "\r\n".
          'Reply-To: ' .$email. "\r\n".
          'X-Mailer: PHP/' . phpversion();
      
     // $headers .= "Content-type: text/html; charset=utf-8";

      //Componemos cuerpo correo.
      $msjCorreo = "Nombre: " . $name;
      $msjCorreo .= "\r\n";
      $msjCorreo .= "Email: " . $email;
      $msjCorreo .= "\r\n";
      $msjCorreo .= "Asunto: " . $subject;
      $msjCorreo .= "\r\n";
      $msjCorreo .= "Mensaje: " . $message;
      $msjCorreo .= "\r\n";
      
       
       
    if (mail($para, $subject, $msjCorreo, $headers)) {
         echo "<script language='javascript'>
            alert('Mensaje enviado, muchas gracias.');
         </script>";
    } else {
         echo "<script language='javascript'>
            alert('fallado');
         </script>";
    }
  }

?>
