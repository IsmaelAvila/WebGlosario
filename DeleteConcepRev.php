<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (General::deleteConcept($id)){
    header("location:Adminis.php");
}
?>