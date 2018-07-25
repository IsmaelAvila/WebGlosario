<!DOCTYPE html>
<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();

$rowSupervi = General::getMateriaSupervi();
$rowGeneral = General::getConceptoMateria();

if($_SERVER["REQUEST_METHOD"]=="POST"){
        $idMat = $_POST['idMat'];
        $idConcep = $_POST['idConce'];
    if(isset($_POST['mod'])){
       
        header("location:AdminisDetail.php?idMat=".$idMat."&idConcep=".$idConcep);
    }else if(isset($_POST['del'])){
         
       /* if ($user_session['rol']== "ADMIN"){
             
        }else{
             
        }*/
       
        echo '<script language="Javascript" type="text/javascript">';
        echo 'if (confirm("Estas seguro que quieres borrarlo")){
        
        location.href = "DeleteConcep.php?id=4";
        
        }';
        
        echo '</script>';
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
 <header id="header">
    <div class="container">
      <div><h1><center>Zona Administración</center></h></div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><form action=''><input type="submit" value='Materia/Concepto'/></form></li>
          <li><form action=''><input type="submit" value='Usuario'/></form></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>

<br>
<table frame="void" rules="rows" align='center'>
	<tr>
		<td>
            <br>
		<table frame="void" rules="rows" align='center'>
		          <tr>
		              <td><label> id Concepto </label></td>
		              <td><label> Nombre Concepto </label></td>
                      <td><label> Validar </label></td>
		          </tr>
             <?php 
                

                 foreach ($rowSupervi as $rowSupe)
                  {


                    echo "<tr>";
                    echo "<td><input type='text' name=''/>".$rowSupe['idMateria']."</td>";
                    echo "<td><input type='text' name=''/>".$rowSupe['nombreMateria']."</td>";
                    echo "<td><input type='submit' value='Validar'/></td>";
                    echo "</tr>";
                  }
            ?>
		  
		</table>
		<br>
        </td>
	</tr>

	<tr>
		<td><br>
			<table align="center">
				<tr>
					<td><input type="radio" name="language"
                               <?php if(isset($language) && $language=="ES") echo "checked";?> value="ES">ES</td>
					<td><input type="radio" name="language"
                               <?php if(isset($language) && $language=="EN") echo "checked";?> value="EN">EN</td>
                    <td><input type="radio" name="language"
                               <?php if(isset($language) && $language=="FR") echo "checked";?> value="FR">FR</td>
				</tr>
		</table>
		<br>
		<table align="center">
				<tr>
                    <td><input type="radio" name="tipo"
                               <?php if(isset($tipo) && $tipo=="Concepto") echo "checked";?> value="Concepto">Concepto</td>
					<td><input type="radio" name="tipo"
                               <?php if(isset($tipo) && $tipo=="Materia") echo "checked";?> value="Materia">Materia</td>
				
				</tr>
		</table>
		<br></td>
	</tr>
</table>



<!--Concepto he pensado en estructurarlo primero accediendo alfabeticamente. El siguiente nivel es un listado de todos los conceptos de esa letra. Por último nivel mostrar el detalle de la letra.

En el caso de la materia, sería mostrar listado de todas las materias y al pulsar en una de ellas mandarte al detalle para modificarlo.-->

<table frame="void" rules="rows" align='center'>
                    <tr>
		              <td><a href="">ID </a></td>
		              <td><a href="">Nombre Materia </a></td>
		              <td><a href="">Nombre Concepto </a></td>
                      <td><a href="">Validar </a></td>
		             
		          </tr>
            <?php 
                

                 foreach ($rowGeneral as $rowGene)
                  {
                    echo "<tr>";
                    echo "<td><input type='text' name=''/>".$rowGene['idMateria']."</td>";
                    echo "<td><input type='text' name=''/>".$rowGene['nombreMateria']."</td>";
                    echo "<td><input type='text' name=''/>".$rowGene['nombreConcepto']."</td>";
                    echo "<td><form method='post' name='form' id='form'>
                    <input type='submit' name='mod' value='Modificar'/>
                    <input type='submit' name='del' value='Eliminar'/>
                    <input type='hidden' name='idMat' value='".$rowGene['idMateria']."'/>
                    <input type='hidden' name='idConce' value='".$rowGene['idConcepto']."'/>
                    </form></td>";
                    echo "</tr>";
                  }
            ?>
		          
		</table>
</body>

</html>