<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class General
{
    function __construct()
    {
    }

   
    public static function getText($idText, $idLang)
    {
        $consulta = "SELECT `textLanguage` FROM `Language` WHERE idTextLanguage ='$idText' AND idLanguage='$idLang'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
    public static function getConceptoMateria(){
        $consulta = "SELECT * FROM concepto, materia";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    public static function getAutores(){
        $consulta = "SELECT * FROM Autores";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    public static function getMateria(){
        $consulta = "SELECT * FROM materia";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
   
    public static function getConceptoGene(){
        $consulta = "SELECT * FROM concepto ORDER BY nombreConcepto ASC";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
     public static function login($userName, $password){
        $consulta = "SELECT * FROM usuarios WHERE nombreUsuario='$userName' AND password='$password'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
    public static function getUserSession(){
        if (!isset($_SESSION['login_user'])){
           header("location:login.php"); 
        }else{
            
            $userCheck = $_SESSION['login_user'];
            $consulta = "SELECT * FROM usuarios WHERE nombreUsuario='$userCheck'";
        
            try {
                
                // Preparar sentencia
                 $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                 $comando->execute();
                 return $comando->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                
                echo $e;
                return false;
            }  
            }
        
    }
    public static function getMateriaSupervi(){
       $consulta = "SELECT * FROM matSupervisada";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
        
    }
    public static function getMateriaExtendida($idMateria){
       $consulta = "SELECT * FROM concepto WHERE idMateria='$idMateria'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
        
    }
    public static function getConcepto($idConcepto){
       $consulta = "SELECT * FROM concepto WHERE idConcepto='$idConcepto'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
        
    }
     public static function deleteConcept($idConcepto){
       $consulta = "DELETE FROM concepto WHERE idConcepto='$idConcepto'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            return  $comando->execute();

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
        
    }
     
}

?>