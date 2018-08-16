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
       
      
       $consulta = "SELECT  * FROM concepto a 
       LEFT JOIN conceptoLanguage cl ON (cl.idConceptoLanguage = a.idNombreConcepto) 
       LEFT JOIN materiaLanguage ml ON (ml.idMateriaLanguage = a.idMateria)
       WHERE (cl.textConcepto LIKE '%$text%' AND cl.idLanguaje = 1)  OR (ml.textMateria LIKE '%$text%' AND ml.idLanguaje = 1)";
       
        
        
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
             $consulta = "SELECT a.*, b.idNombreMateria FROM conceptoSupervi a LEFT JOIN materia b ON (b.idMateria = a.idMateria) LIMIT $start, $rows";
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
             $consulta = "SELECT * FROM concepto LIMIT $start, $rows";
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
    
    public static function getConceptoGene($idLang){
        $consulta = "SELECT * FROM concepto a 
        LEFT JOIN conceptoLanguage cl ON (cl.idConceptoLanguage = a.idNombreConcepto) WHERE cl.idLanguaje = '$idLang' ORDER BY textConcepto DESC";
        
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
       
        if($idconcepto == 0){
             if ($user_session['rol']== "ADMIN"){
                 $table = "conceptoSupervi";
             }else{
                $table = "concepto";
             }
            $consulta = "INSERT INTO ".$table." (`nombreConcepto`, `idMateria`, `definicionConcepto`,`idVeaseConcepto`,`idFuenteConcepto`,`informacionComplementariaConcepto`,`documentacionAdicionalConcepto`,`idMaterialAudiovisualConcepto`) VALUES ('$nombre','$materia','$def','$vease','$fuente','$compl','$doc','$audiovi')";
        }else{
            if ($user_session['rol']== "ADMIN"){
                $consulta = "INSERT INTO conceptoSupervi (`idConcepto`,`nombreConcepto`, `idMateria`, `definicionConcepto`,`idVeaseConcepto`,`idFuenteConcepto`,`informacionComplementariaConcepto`,`documentacionAdicionalConcepto`,`idMaterialAudiovisualConcepto`) VALUES ('$idconcepto','$nombre','$materia','$def','$vease','$fuente','$compl','$doc','$audiovi')
                ON DUPLICATE KEY UPDATE 
                nombreConcepto='{$nombre}', 
                idMateria='{$materia}', 
                definicionConcepto='{$def}',
                idVeaseConcepto='{$vease}',
                idFuenteConcepto='{$fuente}',
                informacionComplementariaConcepto='{$compl}',
                documentacionAdicionalConcepto='{$doc}',
                idMaterialAudiovisualConcepto='{$audiovi}'";
            }else{
                $consulta = "UPDATE concepto SET nombreConcepto='{$nombre}', 
                idMateria='{$materia}', 
                definicionConcepto='{$def}',
                idVeaseConcepto='{$vease}',
                idFuenteConcepto='{$fuente}',
                informacionComplementariaConcepto='{$compl}',
                documentacionAdicionalConcepto='{$doc}',
                idMaterialAudiovisualConcepto='{$audiovi}' WHERE idConcepto='{$idconcepto}'";
            }
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
       
        if ($idconcepto != 0){
            $consulta = "UPDATE concepto SET nombreConcepto='{$nombre}', 
            idMateria='{$materia}', 
            definicionConcepto='{$def}',
            idVeaseConcepto='{$vease}',
            idFuenteConcepto='{$fuente}',
            informacionComplementariaConcepto='{$compl}',
            documentacionAdicionalConcepto='{$doc}',
            idMaterialAudiovisualConcepto='{$audiovi}' WHERE idConcepto='{$idconcepto}'";
        }else{
            if ($user_session['rol']== "ADMIN"){
                 $table = "conceptoSupervi";
            }else{
                $table = "concepto";
            }
            $consulta = "INSERT INTO ".$table." (`nombreConcepto`, `idMateria`, `definicionConcepto`,`idVeaseConcepto`,`idFuenteConcepto`,`informacionComplementariaConcepto`,`documentacionAdicionalConcepto`,`idMaterialAudiovisualConcepto`) VALUES ('$nombre','$materia','$def','$vease','$fuente','$compl','$doc','$audiovi')";
        }
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                if ($user_session['rol']== "ADMIN"){
                    return true;
                }else{
                    return General::deleteConceptRev($idconcepto);
                }
                
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
       
       $consulta = "INSERT INTO conceptoSupervi 
       (`idConcepto`,
       `nombreConcepto`, 
       `idMateria`, 
       `definicionConcepto`,
       `idVeaseConcepto`,
       `idfuenteConcepto`,
       `informacionComplementariaConcepto`,
       `documentacionAdicionalConcepto`,
       `idMaterialAudiovisualConcepto`,
       `borrar`) 
       VALUES 
       ('{$concepto['idConcepto']}',
       '{$concepto['nombreConcepto']}',
       '{$concepto['idMateria']}',
       '{$concepto['definicionConcepto']}',
       '{$concepto['idVeaseConcepto']}',
       '{$concepto['fuenteConcepto']}',
       '{$concepto['informacionComplementariaConcepto']}',
       '{$concepto['documentacionAdicionalConcepto']}',
       '{$concepto['materialAudiovisualConcepto']}',
       '1')
        ON DUPLICATE KEY UPDATE borrar='1'";
       
        
        
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
     
    public static function getConceptoTextLang ($idconceptoLan, $idLang){
       
        $consulta = "SELECT * FROM conceptoLanguage WHERE idConceptoLanguage='$idconceptoLan' AND idLanguaje='$idLang'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row['textConcepto'];

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
    public static function getDefinicionTextLang ($idDefinicionLan, $idLang){
       
        $consulta = "SELECT * FROM definicionLanguage WHERE idDefinicion='$idDefinicionLan' AND idLanguaje='$idLang'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row['textDefinicion'];

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
   
    public static function getInfoCompleTextLang ($idInfoLang, $idLang){
        $consulta = "SELECT * FROM infoComplLanguage WHERE idInfoCompl='$idInfoLang' AND idLanguaje='$idLang'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row['textInfoCompl'];

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
    public static function getDocumAdiciTextLang ($idDocuAdiciLang, $idLang){
        $consulta = "SELECT * FROM documAdiciLanguage WHERE idDocumAdici='$idDocuAdiciLang' AND idLanguaje='$idLang'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row['textDocumAdici'];

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    }
    
  
    /***** Usuarios ********/
    public static function updateUser($user_session, $idUser, $nombre, $pass, $rol){
       
       if($idMateria == 0){
          
             if ($user_session['rol']== "ADMIN"){
                 $table = "usuariosSupervi";
                 
             }else{
                $table = "usuarios";
                 
             }
            $consulta = "INSERT INTO ".$table." (`idUsuario`,`nombreUsuario`,`password`, `rol`) VALUES ('$idUser','$nombre','$pass','$rol')
                ON DUPLICATE KEY UPDATE 
                nombreUsuario='{$nombre}', 
                password='{$pass}', 
                rol='{$rol}'";
        }else{
           
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
       
        if ($idUser != 0){
           $consulta = "UPDATE usuarios SET 
            nombreUsuario='{$nombre}', 
            password='{$pass}',
            rol='{$rol}'
            WHERE idUsuario='{$idUser}'";
         }else{
            if ($user_session['rol']== "ADMIN"){
                 $table = "usuariosSupervi";
             }else{
                $table = "usuarios";
             }
             $consulta = "INSERT INTO ".$table." (`idUsuario`,`nombreUsuario`, `password`, `rol`) VALUES ('$idUser','$nombre','$pass','$rol')
            ON DUPLICATE KEY UPDATE 
            nombreUsuario='{$nombre}',
            password = '{$pass}',
            rol = '{$rol}'
            ";
        }
        
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                if ($user_session['rol']== "ADMIN"){
                    return true;
                }else{
                    return General::deleteUserRev($idUser);
                }
                
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
    
    public static function getUserGener(){
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
    
    public static function getUser($idUser){
        $consulta = "SELECT * FROM usuarios WHERE idUsuario ='$idUser'";
        
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
     
    public static function updateUserToDelete($iduser){
       
       $user = General::getUser($iduser);
       
       $consulta = "INSERT INTO usuariosSupervi 
       (`idUsuario`,
       `nombreUsuario`, 
       `password`, 
       `rol`,
       `borrar`) 
       VALUES 
       ('{$user['idUsuario']}',
       '{$user['nombreUsuario']}',
       '{$user['password']}',
       '{$user['rol']}',
       '1')
        ON DUPLICATE KEY UPDATE borrar='1'";
         
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
       
        if($idMateria == 0){
          
             if ($user_session['rol']== "ADMIN"){
                 $table = "autoresSupervi";
                 
             }else{
                $table = "autores";
                 
             }
            $consulta = "INSERT INTO ".$table." (`idAutores`,`nombreAutores`,`cargoAutores`, `imagenAutores`, `linkAutores`) VALUES ('$idAutor','$nombre','$cargo','$imagen','$link')
            ON DUPLICATE KEY UPDATE 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}', 
            imagenAutores='{$imagen}',
            linkAutores='{$link}'";
        }else {
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
       
        if ($idUser != 0){
           $consulta = "UPDATE autores SET 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}',
            imagenAutores='{$imagen}',
            linkAutores='{$link}'
            WHERE idAutores='{$idAutor}'";
         }else{
            if ($user_session['rol']== "ADMIN"){
                 $table = "autoresSupervi";
             }else{
                $table = "autores";
             }
             $consulta = "INSERT INTO ".$table." (`idAutores`,`nombreAutores`,`cargoAutores`, `imagenAutores`, `linkAutores`) VALUES ('$idAutor','$nombre','$cargo','$imagen','$link')
            ON DUPLICATE KEY UPDATE 
            nombreAutores='{$nombre}', 
            cargoAutores='{$cargo}', 
            imagenAutores='{$imagen}',
            linkAutores='{$link}'";
        }
        
           
        
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                if ($user_session['rol']== "ADMIN"){
                    return true;
                }else{
                       return General::deleteAutorRev($idAutor);
                }
                
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
    
    public static function getAutorGeneral(){
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
    
    public static function updateAutorToDelete($idAutor){
       
        $autor = General::getAutor($idAutor);
       
       $consulta = "INSERT INTO autoresSupervi 
       (`idAutores`,
       `nombreAutores`, 
       `cargoAutores`, 
       `imagenAutores`,
       `linkAutores`,
       `borrar`) 
       VALUES 
       ('{$autor['idAutores']}',
       '{$autor['nombreAutores']}',
       '{$autor['cargoAutores']}',
       '{$autor['imagenAutores']}',
       '{$autor['linkAutores']}',
       '1')
        ON DUPLICATE KEY UPDATE borrar='1'";
         
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
    public static function updateMateria($user_session, $idMateria, $idMateriaLan, $nombre1, $nombre2, $nombre3){
       
        $id = General::setMateriaTextLang($idMateriaLan, $nombre1,$nombre2,$nombre3);
       
        if($idMateria == 0){
           if ($user_session['rol']== "ADMIN"){
                 $table = "materiaSupervi";
             }else{
                $table = "materia";
             }
            $consulta = "INSERT INTO ".$table." (`idMateria`,`idNombreMateria`) VALUES ('$idMateria','$id')
            ON DUPLICATE KEY UPDATE 
            idNombreMateria='".$id."'";
        }else{
           
            if ($user_session['rol']== "ADMIN"){
                $consulta = "INSERT INTO materiaSupervi (`idMateria`,`idNombreMateria`) VALUES ('$idMateria','$id')
                                ON DUPLICATE KEY UPDATE idNombreMateria='".$id."'";
             }else{
                $consulta = "UPDATE materia SET idNombreMateria='".$id."' WHERE idMateria='{$idMateria}'";
             }
           
           
        }
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            echo $id;
            return  $comando->execute();

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    }
    
    public static function updateMateriaRev($user_session, $idMateria, $nombre){
       
         if ($idMateria != 0){
           $consulta = "UPDATE materia SET 
            idNombreMateria='{$nombre}'
            WHERE idMateria='{$idMateria}'";
         }else{
            if ($user_session['rol']== "ADMIN"){
                 $table = "materiaSupervi";
             }else{
                $table = "materia";
             }
             
              $consulta = "INSERT INTO ".$table." (`idMateria`,`idNombreMateria`) VALUES ('$idMateria','$nombre')
            ON DUPLICATE KEY UPDATE 
            idNombreMateria='{$nombre}'";
         }
        
        
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            
            if($comando->execute()){
                if ($user_session['rol']== "ADMIN"){
                    return true;
                }else{
                    return General::deleteMateriaRev($idMateria);
                }
                
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
       $consulta = "DELETE FROM materiaSupervi WHERE idMateria='$idMateria'";
        
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
       
       $consulta = "INSERT INTO materiaSupervi 
       (`idMateria`,
       `idNombreMateria`, 
       `borrar`) 
       VALUES 
       ('{$materia['idMateria']}',
       '{$materia['idNombreMateria']}',
       '1')
        ON DUPLICATE KEY UPDATE borrar='1'";
         
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
    
    public static function getMateriaTextLang ($idMateriaLan, $idLang){
        $materia = General::getMateria($idMateriaLan);
        $materiaLangu = $materia['idNombreMateria'];
        $consulta = "SELECT * FROM materiaLanguage WHERE idMateriaLanguage='$materiaLangu' AND idLanguaje='$idLang'";
        
       try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row['textMateria'];

        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
    } 
    
    public static function setMateriaTextLang ($idMateriaLan, $nombre1, $nombre2, $nombre3){
         $consulta = "INSERT INTO materiaLanguage (`idMateriaLanguage`,`idLanguaje`,`textMateria`) 
         VALUES ('$idMateriaLan', 1,'$nombre1')
         ON DUPLICATE KEY UPDATE 
         idLanguaje = 1,
         textMateria = '{$nombre1}'
         ";
        
       try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             if ($comando->execute()){
                  $id = Database::getInstance()->getDb()->lastInsertId();
                  $consulta2 = "INSERT INTO materiaLanguage (`idMateriaLanguage`,`idLanguaje`,`textMateria`) 
                  VALUES ($id, 2,'$nombre2'), ($id, 3,'$nombre3') 
                  ON DUPLICATE KEY UPDATE 
                    idLanguaje = VALUES(idLanguaje),
                    textMateria = VALUES(textMateria)";
                  $comando2 = Database::getInstance()->getDb()->prepare($consulta2);
                  if ($comando2->execute()){
                       return  $id;
                  }else{
                       return false; 
                  }
             }else{
               echo $e;
               return false;  
             }
        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
        
    }
    
     /***** Fuente ********/
    
    public static function getFuente($idFuente){
       $consulta = "SELECT * FROM fuenteconcepto WHERE idFuenteConcepto='$idFuente'";
        
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
    
    public static function setFuente($idFuente, $nombreFuente, $linkFuente){
       
       if ($idFuente == 0){
            $consulta = "INSERT INTO fuenteConcepto 
       (`nombreFuente`,
       `linkFuente`) 
       VALUES 
       ('{$nombreFuente}',
       '{$linkFuente}')";
       }else {
             
           $consulta = "UPDATE fuenteConcepto SET nombreFuente='{$nombreFuente}', linkFuente='{$linkFuente}' WHERE idFuenteConcepto='{$idFuente}' ";
       }
      
       
         
        try {
            
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            $id = Database::getInstance()->getDb()->lastInsertId();
            return  $id;

        } catch (PDOException $e) {
            
        	echo $e;
            return false;
        }
        
    }
    
    public static function updateFuenteConcepto($idFuente, $idConcepto){
       $consulta = "UPDATE concepto SET idfuenteConcepto='{$idFuente}' WHERE idConcepto='{$idConcepto}'";
      
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
        
    /***** Material Audiovisual ********/
    
    public static function getAudioVisual($idAudioVi){
       $consulta = "SELECT * FROM conexionMatAudiViConcep WHERE idConexion='$idAudioVi'";
        
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
    
    public static function getAudioVisualID($idAudioVi){
       $consulta = "SELECT * FROM matAudioViConcepto WHERE idMatAudioViConcepto='$idAudioVi'";
        
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
    
    public static function setAudioVisualID($idMatAV, $nombre, $link){
         $consulta = "INSERT INTO matAudioViConcepto (`idMatAudioViConcepto`,`nombreMateAudioViConcepto`, `linkMateAudioViConcepto`) VALUES ('$idMatAV','$nombre','$link')
                ON DUPLICATE KEY UPDATE 
                nombreMateAudioViConcepto='{$nombre}', 
                linkMateAudioViConcepto='{$link}'";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
             $comando->execute();
            $id = Database::getInstance()->getDb()->lastInsertId();
            return $id;
           
        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
     }
    
     /***** Vease ********/
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
    
    public static function setVease($idVease, $idConcepto){
        $consulta = "INSERT INTO veaseConcepto (`idVeaseConcepto`, `idConcepto`) VALUES ('$idVease','$idConcepto')";
        
        try {
            // Preparar sentencia
             $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            return $comando->execute();
           
        } catch (PDOException $e) {
        	echo $e;
            return false;
        }
     }
        
    public static function deleteVease($idVease){
       $consulta = "DELETE FROM veaseConcepto WHERE idVeaseConcepto='$idVease'";
        
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
    
    public static function updateVeaseConcepto($idConcepto){
       $consulta = "UPDATE concepto SET idVeaseConcepto='{$idConcepto}' WHERE idConcepto='{$idConcepto}'";
      
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