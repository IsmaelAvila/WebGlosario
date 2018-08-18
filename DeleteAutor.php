<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if ($user_session['rol']=='ADMIN'){
    if (General::updateAutorToDelete($id)){
        header("location:Adminis.php");
   }
}else{
   if (General::deleteAutor($id) && General::deleteAutorRev($id)){
        header("location:Adminis.php");
   }
}

?>