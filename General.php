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

   /********** General ***********/
    
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
       
    public static function getCountGeneral($method){
         if ($method == 0){
              $consulta = "SELECT COUNT(idMateria) FROM concepto";
         }else if ($method == 1){
              $consulta = "SELECT COUNT(idMateria) FROM materia";
         }else if ($method == 2){
              $consulta = "SELECT COUNT(idAutores) FROM autores";
         }else if ($method == 3){
              $consulta = "SELECT COUNT(idUsuario) FROM usuarios";
         }
         
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            return $comando->fetchColumn();

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
    public static function searchText($text){
       
      
       $consulta = "SELECT a.*, b.nombreMateria FROM concepto a LEFT JOIN materia b ON (b.idMateria = a.idMateria) WHERE nombreConcepto LIKE '%$text%' OR definicionConcepto LIKE '%$text%' OR nombreConcepto LIKE '%$text%'";
       
        
        
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
    
    public static function getVease($idVease){
       $consulta = "SELECT * FROM veaseConcepto WHERE idVeaseConcepto='$idVease'";
        
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
    
     /***** Concepto ********/
     public static function getConceptoSupervi($page, $method){
        
        $start = 10 * ($page - 1);
        $rows = 10;
        if ($method == 0){
             $consulta = "SELECT a.*, b.nombreMateria FROM conceptoSupervi a LEFT JOIN materia b ON (b.idMateria = a.idMateria) LIMIT $start, $rows";
        }else if ($method == 1){
            $consulta = "SELECT * FROM materiaSupervi LIMIT $start, $rows"; 
        }else if ($method == 2){
             $consulta = "SELECT * FROM autoresSupervi LIMIT $start, $rows";
        }else if ($method == 3){
             $consulta = "SELECT * FROM usuariosSupervi LIMIT $start, $rows";
        }
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
     public static function getConceptoMateria($page, $method){
        $start = 10 * ($page - 1);
        $rows = 10;
        if ($method == 0){
             $consulta = "SELECT a.*, b.nombreMateria FROM concepto a LEFT JOIN materia b ON (b.idMateria = a.idMateria) LIMIT $start, $rows";
        }else if ($method == 1){
            $consulta = "SELECT * FROM materia LIMIT $start, $rows"; 
        }else if ($method == 2){
             $consulta = "SELECT * FROM autores LIMIT $start, $rows";
        }else if ($method == 3){
             $consulta = "SELECT * FROM usuarios LIMIT $start, $rows";
        }
       
        
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
    
    public static function getConceptoSuperviGene($idConcepto){
       $consulta = "SELECT * FROM conceptoSupervi WHERE idConcepto='$idConcepto'";
        
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
    
    public static function deleteConceptRev($idConcepto){
       $consulta = "DELETE FROM conceptoSupervi WHERE idConcepto='$idConcepto'";
        
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
    
    public static function updateConcept($user_session, $idconcepto, $nombre, $materia, $def, $vease, $fuente, $compl, $doc, $audiovi){
       
        if ($user_session['rol']== "ADMIN"){
            $consulta = "INSERT INTO conceptoSupervi (`idConcepto`,`nombreConcepto`, `idMateria`, `definicionConcepto`,`idVeaseConcepto`,`fuenteConcepto`,`informacionComplementariaConcepto`,`documentacionAdicionalConcepto`,`materialAudiovisualConcepto`) VALUES ('$idconcepto','$nombre','$materia','$def','$vease','$fuente','$compl','$doc','$audiovi')
            ON DUPLICATE KEY UPDATE 
            nombreConcepto='{$nombre}', 
            idMateria='{$materia}', 
            definicionConcepto='{$def}',
            idVeaseConcepto='{$vease}',
            fuenteConcepto='{$fuente}',
            informacionComplementariaConcepto='{$compl}',
            documentacionAdicionalConcepto='{$doc}',
            materialAudiovisualConcepto='{$audiovi}'";
        }else{
            $consulta = "UPDATE concepto SET nombreConcepto='{$nombre}', 
            idMateria='{$materia}', 
            definicionConcepto='{$def}',
            idVeaseConcepto='{$vease}',
            fuenteConcepto='{$fuente}',
            informacionComplementariaConcepto='{$compl}',
            documentacionAdicionalConcepto='{$doc}',
            materialAudiovisualConcepto='{$audiovi}' WHERE idConcepto='{$idconcepto}'";
        }
        
        
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
    
    public static function updateConceptRev($user_session, $idconcepto, $nombre, $materia, $def, $vease, $fuente, $compl, $doc, $audiovi){
       
            $consulta = "UPDATE concepto SET nombreConcepto='{$nombre}', 
            idMateria='{$materia}', 
            definicionConcepto='{$def}',
            idVeaseConcepto='{$vease}',
            fuenteConcepto='{$fuente}',
            informacionComplementariaConcepto='{$compl}',
            documentacionAdicionalConcepto='{$doc}',
            materialAudiovisualConcepto='{$audiovi}' WHERE idConcepto='{$idconcepto}'";
        
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                return General::deleteConceptRev($idconcepto);
            }else{
                return false; 
            }

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    } 
    
   public static function updateConceptToDelete($idconcepto){
       
       $concepto = General::getConcepto($idconcepto);
       
       $consulta = "UPDATE concepto SET nombreConcepto='{$concepto['nombreConcepto']}', 
            idMateria='{$concepto['nombreConcepto']}', 
            definicionConcepto='{$def}',
            idVeaseConcepto='{$vease}',
            fuenteConcepto='{$fuente}',
            informacionComplementariaConcepto='{$compl}',
            documentacionAdicionalConcepto='{$doc}',
            materialAudiovisualConcepto='{$audiovi}' WHERE idConcepto='{$idconcepto}'";
       
        
        
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
     
    
    /***** Usuarios ********/
   public static function updateUser($user_session, $idUser, $nombre, $pass, $rol){
       
        if ($user_session['rol']== "ADMIN"){
            $consulta = "INSERT INTO usuariosSupervi (`idUsuario`,`nombreUsuario`,`password`, `rol`) VALUES ('$idUser','$nombre','$pass','$rol')
            ON DUPLICATE KEY UPDATE 
            nombreUsuario='{$nombre}', 
            password='{$pass}', 
            rol='{$rol}'";
        }else{
            $consulta = "UPDATE usuarios SET 
            nombreUsuario='{$nombre}', 
            password='{$pass}',
            rol='{$rol}'
            WHERE idUsuario='{$idUser}'";
        }
        
        
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
    
    public static function updateUserRev($user_session, $idUser, $nombre, $pass, $rol){
       
            $consulta = "UPDATE usuarios SET 
            nombreUsuario='{$nombre}', 
            password='{$pass}',
            rol='{$rol}'
            WHERE idUsuario='{$idUser}'";
        
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                return General::deleteUserRev($idUser);
            }else{
                return false; 
            }

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    } 
    
    public static function deleteUser($idUser){
       $consulta = "DELETE FROM usuarios WHERE idUsuario='$idUser'";
        
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
    
    public static function getUser(){
        $consulta = "SELECT * FROM usuarios";
        
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
    
    public static function deleteUserRev($idUser){
       $consulta = "DELETE FROM usuariosRev WHERE idUsuario='$idUser'";
        
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
     
    public static function updateUserToDelete($idMateria){
       
       $materia = General::getMateria($idMateria);
       
       $consulta = "UPDATE materia SET nombreMateria='{$materia['nombreMateria']}', 
             WHERE idMateria='{$idMateria}'";
       
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
    
    /***** Autores ********/
    public static function updateAutor($user_session, $idAutor, $nombre, $cargo, $imagen, $link){
       
        if ($user_session['rol']== "ADMIN"){
            $consulta = "INSERT INTO autoresSupervi (`idAutores`,`nombreAutores`,`cargoAutores`, `imagenAutores`, `linkAutores`) VALUES ('$idAutor','$nombre','$cargo','$imagen','$link')
            ON DUPLICATE KEY UPDATE 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}', 
            imagenAutores='{$imagen}',
            linkAutores='{$link}'";
        }else{
            $consulta = "UPDATE autores SET 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}',
            imagenAutores='{$imagen}',
            linkAutores='{$link}'
            WHERE idAutores='{$idAutor}'";
        }
        
        
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
    
    public static function updateAutorRev($user_session, $idAutor, $nombre, $cargo, $imagen, $link){
       
            $consulta = "UPDATE autores SET 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}',
            imagenAutores='{$imagen}',
            linkAutores='{$link}'
            WHERE idAutores='{$idAutor}'";
        
        
        try {
             
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             
            if($comando->execute()){
                
                return General::deleteAutorRev($idconcepto);
            }else{
                return false; 
            }

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    } 
    
    public static function deleteAutor($idAutor){
       $consulta = "DELETE FROM autores WHERE idAutores='$idAutor'";
        
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
    
    public static function deleteAutorRev($idAutor){
       $consulta = "DELETE FROM autoresSupervi WHERE idAutores='$idAutor'";
        
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
    
    public static function updateAutoToDelete($idAutor){
       
       $materia = General::getAutor($idAutor);
       
       $consulta = "UPDATE materia SET nombreMateria='{$materia['nombreMateria']}', 
             WHERE idMateria='{$idMateria}'";
       
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
                                        
    public static function getAutor($idAutor){
       $consulta = "SELECT * FROM autores WHERE idAutores='$idAutor'";
        
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
    public static function getAutorSupervi($idAutor){
       $consulta = "SELECT * FROM autoresSupervi WHERE idAutores='$idAutor'";
        
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
                                          
                                          
    
     /***** Materia ********/
    public static function updateMateria($user_session, $idMateria, $nombre){
       
        if ($user_session['rol']== "ADMIN"){
            $consulta = "INSERT INTO materiaSupervi (`idMateria`,`nombreMateria`) VALUES ('$idMateria','$nombre')
            ON DUPLICATE KEY UPDATE 
            nombreMateria='{$nombre}'";
        }else{
            $consulta = "UPDATE materia SET 
            nombreMateria='{$nombre}'
            WHERE idMateria='{$idMateria}'";
        }
        
        
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
    
    public static function updateMateriaRev($user_session, $idMateria, $nombre){
       
           $consulta = "UPDATE materia SET 
            nombreMateria='{$nombre}'
            WHERE idMateria='{$idMateria}'";
        
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                return General::deleteMateria($idMateria);
            }else{
                return false; 
            }

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    } 
    
    public static function deleteMateria($idMateria){
       $consulta = "DELETE FROM materia WHERE idMateria='$idMateria'";
        
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
    
    public static function deleteMateriaRev($idMateria){
       $consulta = "DELETE FROM materiaRev WHERE idMateria='$idMateria'";
        
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
    
    public static function updateMateriaToDelete($idMateria){
       
       $materia = General::getMateria($idMateria);
       
       $consulta = "UPDATE materia SET nombreMateria='{$materia['nombreMateria']}', 
             WHERE idMateria='{$idMateria}'";
       
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
    
    
    public static function getMateriaGeneral(){
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
    
    public static function getMateriaSupervi($idMat){
       $consulta = "SELECT * FROM materiaSupervi WHERE idMateria='$idMat'";
        
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
    
    public static function getMateria($idMat){
       $consulta = "SELECT * FROM materia WHERE idMateria='$idMat'";
        
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

?>