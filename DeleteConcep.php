<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if ($user_session['rol']=='ADMIN'){
    if (General::updateConceptToDelete($id)){
        header("location:Adminis.php");
   }
}else{
   if (General::deleteConcept($id) && General::deleteConceptRev($id)){
        header("location:Adminis.php");
   }
}

?>