<?php

require 'General.php';
session_start();

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (General::deleteConcept($id)){
    header("location:Adminis.php");
}
?>