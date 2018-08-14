<!DOCTYPE html>
<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();


$page = 1;
$method = 0;
$lang = 1;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['method'])) {
    $method = $_GET['method'];
}
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
}

$rowSupervi = General::getConceptoSupervi($page,$method);
$rowGeneral = General::getConceptoMateria($page,$method);


if($_SERVER["REQUEST_METHOD"]=="POST"){
    if ($_POST['add']){
         
        if ($user_session['rol'] == "ADMIN"){
             $revAdd = "false";
         }else{
              $revAdd = "true";
         }
       if ($method == 0){
            header("location:AdminisDetail.php?idConcep=0&rev=".$revAdd."&lang=".$lang);
       }else  if ($method == 1){
             header("location:AdminisMateriaDetail.php?idMat=0&rev=".$revAdd);
       }else  if ($method == 2){
            header("location:AdminisAutoresDetail.php?idAuto=0&rev=".$revAdd);
       }else  if ($method == 3){
            header("location:AdminisUserDetail.php?idUser=0&rev=".$revAdd);
       }
    }else{
    $rev = $_POST['rev'];
     if ($method == 0){
      
        $idConcep = $_POST['idConce'];
       
        if(isset($_POST['mod'])){
            header("location:AdminisDetail.php?idConcep=".$idConcep."&rev=".$rev."&lang=".$lang);
        }else if(isset($_POST['del'])){
            echo '<script language="Javascript" type="text/javascript">';
            echo 'if (confirm("Estas seguro que quieres borrarlo")){';
            echo 'location.href = "DeleteConcep.php?id='.$idConcep.'"; } </script>';
        }
     }else  if ($method == 1){
        
        $idMat = $_POST['idMat'];
       
       if(isset($_POST['mod'])){
            header("location:AdminisMateriaDetail.php?idMat=".$idMat."&rev=".$rev);
        }else if(isset($_POST['del'])){

            echo '<script language="Javascript" type="text/javascript">';
            echo 'if (confirm("Estas seguro que quieres borrarlo")){';
            echo 'location.href = "DeleteMater.php?id='.$idMat.'"; } </script>';


        }
     }else  if ($method == 2){
        
        $idAuto = $_POST['idAuto'];
       if(isset($_POST['mod'])){
            header("location:AdminisAutoresDetail.php?idAuto=".$idAuto."&rev=".$rev);
        }else if(isset($_POST['del'])){

            echo '<script language="Javascript" type="text/javascript">';
            echo 'if (confirm("Estas seguro que quieres borrarlo")){';
            echo 'location.href = "DeleteAutor.php?id='.$idAuto.'"; } </script>';
        }
     }else  if ($method == 3){
        
         $idUser = $_POST['idUser'];
        
        if(isset($_POST['mod'])){
            header("location:AdminisUserDetail.php?idUser=".$idUser."&rev=".$rev);
        }else if(isset($_POST['del'])){

            echo '<script language="Javascript" type="text/javascript">';
            echo 'if (confirm("Estas seguro que quieres borrarlo")){';
            echo 'location.href = "DeleteUser.php?id='.$idUser.'"; } </script>';


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
 <header id="header2">
  <?php
      echo "<h5 style='color: white;'>Bienvenido, <i style='color: red;'>" . $user_session['nombreUsuario']."</i></h5>";
      ?>
  <a href="Logout.php" class="btn">Cerrar Sesión</a>
    <div class="container">
      <div style="color: white;"><h1><center>Zona Privada</center></h1></div>


      <nav id="nav-menu-container">
        <div id="myBtnContainer">
            <button class="btn" onclick="filterSelection('0')"> Concepto</button>
            <button class="btn" onclick="filterSelection('1')"> Materia</button>
            <button class="btn" onclick="filterSelection('2')"> Autores</button>
            <button class="btn" onclick="filterSelection('3')"> Usuarios</button>
        </div>
      </nav>
        <br><br><br>
     <nav id="nav-menu-container">
        <div id="myBtnContainerLang">
            <button class="btn" onclick="filterLanguage('1')"> Español</button>
            <button class="btn" onclick="filterLanguage('2')"> Ingles</button>
            <button class="btn" onclick="filterLanguage('3')"> Frances</button>
        </div>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
       <br>
       <br>
       <br>
       <br>
    <br>
    <?php
            if ($user_session['rol']!="ADMIN"){
    echo "<table frame='void' rules='rows' align='center' id='tableAdmiRev'>
	 <tr class='header'>";
            echo"<h2 style='color: black;'><center>Zona Propietario</center></h2>";
                    if ($method == 0){
                        echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:40%;'><a>Nombre Materia </a></td>
		                  <th style='width:30%;'><a>Nombre Concepto </a></td>";
                    }else  if ($method == 1){
                         echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:70%;'><a>Nombre Materia </a></td>";
		              
                    }else  if ($method == 2){
                         echo "<th style='width:10%;'><a href=''>ID </a></td>
		                  <th style='width:10%;'><a>Nombre  </a></td>
                        <th style='width:30%;'><a>Cargo  </a></td>
                        <th style='width:20%;'><a>Image  </a></td>
                        <th style='width:20%;'><a>Link  </a></td>";
                    }else  if ($method == 3){
                        echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:50%;'><a>Nombre  </a></td>
                          <th style='width:20%;'><a>Rol  </a></td>";
                    }
		              
                       echo " <th style='width:20%;'><a>Validar </a></th>";
                
                foreach ($rowSupervi as $rowSuper)
                  {
                    echo "<tr>";
                     if ($method == 0){
                        echo "<td>".$rowSuper['idConcepto']."</td>";
                        echo "<td>". General::getMateriaTextLang($rowSuper['idMateria'],$lang) ."</td>";
                        echo "<td>".$rowSuper['nombreConcepto']."</td>";
                        echo "<td><form method='post' name='form' id='form'>";
                        if ($rowSuper['borrar'] == 0){
                            echo  "<input type='submit' name='mod' value='Modificar'/>";
                            echo "<input type='submit' name='del' value='Descartar'/>";
                        }else{
                             echo "<input type='submit' name='del' value='Eliminar'/>";
                        }
                        echo "<input type='hidden' name='rev' value='true'/>
                        <input type='hidden' name='idConce' value='".$rowSuper['idConcepto']."'/>
                        </form></td>";
                    }else  if ($method == 1){
                        echo "<td>".$rowSuper['idMateria']."</td>";
                        echo "<td>".$rowSuper['idNombreMateria']."</td>";
                        echo "<td><form method='post' name='form' id='form'>";
                        if ($rowSuper['borrar'] == 0){
                            echo  "<input type='submit' name='mod' value='Modificar'/>";
                            echo "<input type='submit' name='del' value='Descartar'/>";
                        }else{
                             echo "<input type='submit' name='del' value='Eliminar'/>";
                        }
                         echo "<input type='hidden' name='rev' value='true'/>
                        <input type='hidden' name='idMat' value='".$rowSuper['idMateria']."'/>
                        </form></td>";
		              
                    }else  if ($method == 2){
                        echo "<td>".$rowSuper['idAutores']."</td>";
                        echo "<td>".$rowSuper['nombreAutores']."</td>";
                        echo "<td>".$rowSuper['cargoAutores']."</td>";
                        echo "<td>".$rowSuper['imagenAutores']."</td>";
                        echo "<td>".$rowSuper['linkAutores']."</td>";
                        echo "<td><form method='post' name='form' id='form'>";
                        if ($rowSuper['borrar'] == 0){
                            echo  "<input type='submit' name='mod' value='Modificar'/>";
                            echo "<input type='submit' name='del' value='Descartar'/>";
                        }else{
                             echo "<input type='submit' name='del' value='Eliminar'/>";
                        }
                         echo "<input type='hidden' name='rev' value='true'/>
                        <input type='hidden' name='idAuto' value='".$rowSuper['idAutores']."'/>
                        </form></td>";
                    }else  if ($method == 3){
                        echo "<td>".$rowSuper['idUsuario']."</td>";
                        echo "<td>".$rowSuper['nombreUsuario']."</td>";
                        echo "<td>".$rowSuper['rol']."</td>";
                        echo "<td><form method='post' name='form' id='form'>";
                        if ($rowSuper['borrar'] == 0){
                            echo  "<input type='submit' name='mod' value='Modificar'/>";
                            echo "<input type='submit' name='del' value='Descartar'/>";
                        }else{
                             echo "<input type='submit' name='del' value='Eliminar'/>";
                        }
                         echo "<input type='hidden' name='rev' value='true'/>
                        <input type='hidden' name='idUser' value='".$rowSuper['idUsuario']."'/>
                        </form></td>";
                    
                    }
                    
                    echo "</tr>";
                }
		          
		      echo "</table>";
            }
            ?>
		
		<br>
   <br>
       <br>
       <br>
       <br>


<!--Concepto he pensado en estructurarlo primero accediendo alfabeticamente. El siguiente nivel es un listado de todos los conceptos de esa letra. Por último nivel mostrar el detalle de la letra.

En el caso de la materia, sería mostrar listado de todas las materias y al pulsar en una de ellas mandarte al detalle para modificarlo.-->
<input type="text" id="searchInput" onkeyup="search()" placeholder="Buscar....">
            <form method='post' name='formAdd' id='formAdd'>
                        <input type='submit'  name='add' value='Añadir'/>
            </form>
    <br>
    <br>
    <table frame="void" rules="rows" align='center' id="tableAdmi">
    <h2 style='color: black;'><center>Zona Administrador</center></h2>
                   <tr class="header">
                       <?php
                    if ($method == 0){
                        echo "<th style='width:10%;'><a href=''>ID </a></td>
		                  <th style='width:40%;'><a>Nombre Materia </a></td>
		                  <th style='width:30%;'><a>Nombre Concepto </a></td>";
                    }else  if ($method == 1){
                         echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:70%;'><a>Nombre Materia </a></td>";
		              
                    }else  if ($method == 2){
                         echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:10%;'><a>Nombre  </a></td>
                        <th style='width:30%;'><a>Cargo  </a></td>
                        <th style='width:20%;'><a>Image  </a></td>
                        <th style='width:20%;'><a>Link  </a></td>";
                    }else  if ($method == 3){
                        echo "<th style='width:10%;'><a>ID </a></td>
		                  <th style='width:50%;'><a>Nombre  </a></td>
                          <th style='width:20%;'><a>Rol  </a></td>";
                    }
		              
                       echo " <th style='width:20%;'><a>Validar </a></th>";
                    ?>
		          
		             
		          </tr>
            <?php 
                
                   
                 foreach ($rowGeneral as $rowGene)
                  {
                    echo "<tr>";
                     if ($method == 0){
                        echo "<td>".$rowGene['idConcepto']."</td>";
                        echo "<td>". General::getMateriaTextLang($rowGene['idMateria'], $lang) ."</td>";
                        echo "<td>".$rowGene['nombreConcepto']."</td>";
                        echo "<td><form method='post' name='form' id='form'>
                        <input type='submit' name='mod' value='Modificar'/>
                        <input type='submit' name='del' value='Eliminar'/>
                         <input type='hidden' name='rev' value='false'/>
                        <input type='hidden' name='idConce' value='".$rowGene['idConcepto']."'/>
                        </form></td>";
                    }else  if ($method == 1){
                        echo "<td>".$rowGene['idMateria']."</td>";
                        echo "<td>". General::getMateriaTextLang($rowGene['idMateria'], $lang) ."</td>";
                        echo "<td><form method='post' name='form' id='form'>
                        <input type='submit' name='mod' value='Modificar'/>
                        <input type='submit' name='del' value='Eliminar'/>
                         <input type='hidden' name='rev' value='false'/>
                        <input type='hidden' name='idMat' value='".$rowGene['idMateria']."'/>
                        </form></td>";
		              
                    }else  if ($method == 2){
                        echo "<td>".$rowGene['idAutores']."</td>";
                        echo "<td>".$rowGene['nombreAutores']."</td>";
                        echo "<td>".$rowGene['cargoAutores']."</td>";
                        echo "<td>".$rowGene['imagenAutores']."</td>";
                        echo "<td>".$rowGene['linkAutores']."</td>";
                        echo "<td><form method='post' name='form' id='form'>
                        <input type='submit' name='mod' value='Modificar'/>
                        <input type='submit' name='del' value='Eliminar'/>
                         <input type='hidden' name='rev' value='false'/>
                        <input type='hidden' name='idAutores' value='".$rowGene['idAutores']."'/>
                        </form></td>";
                    }else  if ($method == 3){
                        echo "<td>".$rowGene['idUsuario']."</td>";
                        echo "<td>".$rowGene['nombreUsuario']."</td>";
                        echo "<td>".$rowGene['rol']."</td>";
                        echo "<td><form method='post' name='form' id='form'>
                        <input type='submit' name='mod' value='Modificar'/>
                        <input type='submit' name='del' value='Eliminar'/>
                         <input type='hidden' name='rev' value='false'/>
                        <input type='hidden' name='idUser' value='".$rowGene['idUsuario']."'/>
                        </form></td>";
                    
                    }
                    
                    echo "</tr>";
                  }
            ?>
        <tr class="footer">
		              <th colspan= "6" style=" text-align: right;">
                          <?php
                          
                          $totalRecods = General::getCountGeneral($method);
                          $total_pages = ceil($totalRecods/10);
                          
                          $pageLink = "<div class='pagination'>";
                          for($i; $i<=$total_pages;$i++){
                              $pageLink .= "<a href='Adminis.php?page=".$i."&method=".$method."&lang=".$lang."'>".$i."</a>";
                          }
                          echo $pageLink . "</div>";
                          ?>
                         
		             
         </tr>
		</table>
    
    <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/morphext/morphext.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/easing/easing.js"></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>

  <script src="contactform/contactform.js"></script>
<script>
function search() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tableAdmi");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filterSelection(selection) {
    var lang = <?php Print($lang); ?>;
    if (selection == '0'){
        location.href = "Adminis.php?page=1&method=0&lang="+lang;
    }else  if (selection == '1'){
                location.href = "Adminis.php?page=1&method=1&lang="+lang;
    }else  if (selection == '2'){
            location.href = "Adminis.php?page=1&method=2&lang="+lang;
    }else  if (selection == '3'){
           location.href = "Adminis.php?page=1&method=3&lang="+lang;   
    }
            
}
    
function filterLanguage(selection) {
     var method = <?php Print($method); ?>;
    if (selection == '1'){
            location.href = "Adminis.php?page=1&method="+method+"&lang=1";
    }else  if (selection == '2'){
            location.href = "Adminis.php?page=1&method="+method+"&lang=2";
    }else  if (selection == '3'){
           location.href = "Adminis.php?page=1&method="+method+"&lang=3";   
    }
            
}
        
 // Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");

var selec = <?php Print($method); ?>;
btns[selec].className += " active";
    
var btnContainerLang = document.getElementById("myBtnContainerLang");
var btnsLang = btnContainerLang.getElementsByClassName("btn");

var selecLang = <?php Print($lang); ?>;
btnsLang[selecLang - 1].className += " active";
  

</script>
</body>

</html>