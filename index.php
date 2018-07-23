<!--<?php
/*$user = "root";
$password = "root";
$db = "glosario";
$host = "localhost";
$port = 8889;*/


/*$conn = mysqli_connect($host, $user, $password, $db, $port);
$db_selected = mysqli_select_db($db, $conn);

 if ($conn->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}else{
  echo("Conexion correcta").'<br>';
}

  echo "Inicia consulta".'<br>';
  
$sql = "SELECT * FROM concepto, materia";
$result=mysqli_query($conn,$sql);

  

echo "finaliza consulta".'<br>';

echo "finalfin".'<br>';*/

require 'General.php';

function getTextGeneral($idText, $idLang){
     $TEXT = General::getText($idText, $idLang);
     echo $TEXT['TEXT'];

 }

function getRowConceptoNombreMateria(){
     $row = General::getConceptoMateria();
    return $row;
}

function getAutores(){
    $row = General::getAutores();
    return $row;
}

$rows = getRowConceptoNombreMateria();

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '<br>'.$row["conceptonombre_Materia"];
    }
} else {
    echo "0 results".'<br>';
}

echo "antes foreach".'<br>';
$rows = mysqli_query ($conn, $sql);
foreach ($rows as $row)
{
  
echo '<br>'."nombre_materia:".$row["nombre_Materia"];
}*/
?>-->

<!DOCTYPE html>
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
  <div id="preloader"></div>

  <!--==========================
  Hero Section
  ============================-->
  <section id="hero">
    
    <div class="hero-container">
      <a href="login.php" class="btn-services2">Zona Privada</a>
      <div class="wow fadeIn">
        <div class="hero-logo">
         <h2><?php echo getTextGeneral(1,1); ?></h2>
          <!--img class="" src="img/GlosarioInteractivoLogo.png" alt="Imperial"-->
        </div>

        <h2>Universidad de Córdoba</h2>
        <!--<h1><?php echo '<br>'.$row["nombre_Materia"]; ?></h1>Ejemplo incrustar html y ph!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

        <h3>Instituciones implicadas: <span class="rotating">Vicerrectorado de Coordinación institucional e infraestructuras, Dirección General de Prevención y Protección Ambiental</span></h3>
        <div class="actions">
          <a href="#about" class="btn-get-started">Presentación</a>
          <a href="#services" class="btn-services">Glosario</a>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <a href="http://www.uco.es/"><img src="img/logoUco.png" alt="" title="" /></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">Presentación</a></li>
          <li><a href="#services">Glosario</a></li>
          <li><a href="#team">Autores</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  <!--==========================
  About Section
  ============================-->
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Presentación</h3>
          <div class="section-title-divider"></div>
          <!--<p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>-->
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">
        <div class="col-md-6 col-md-push-6 about-content">
          <!--<h2 class="about-title">Presentación del Glosario</h2>-->
          <p class="about-text">
            La Prevención de Riesgos Laborales es una materia multidisciplinar que abarca grandes campos de estudio muy dispares entre sí, que sin embargo, tienen un denominador común: preservar la seguridad y salud de los trabajadores en el medio laboral. Por ello, es muy amplia la documentación y bibliografía que hay sobre esta temática en particular.
          </p>
          <p class="about-text">
            Para facilitar la labor de estudio y comprensión del estudiante de Prevención de Riesgos Laborales en particular y de cualquier trabajador en general, se ha creado este glosario, que es una herramienta interactiva que permite recopilar y refundir conceptos en materia de seguridad y salud laboral, que se encuentran en la legislación y documentos técnicos elaborados por instituciones de reconocido prestigio como el Instituto Nacional de Seguridad e Higiene en el Trabajo. Con ello, se pretende lograr que cualquier estudiante o trabajador adquiera los conocimientos básicos de salud laboral que le capacite para identificar, evaluar y controlar los riesgos, generales y específicos, derivados de las condiciones de trabajo, con el fin de evitar daños para la salud.
            id est laborum
          </p>
          <p class="about-text">
            Este glosario se ha estructurado en términos ordenados alfabéticamente y clasificados según la materia a la que se adscribe: autoprotección y emergencias, coordinación de actividades empresariales, ergonomía y psicosociología aplicada, gestión de la prevención, higiene industrial, instalaciones contra incendios, medicina del trabajo y seguridad en el trabajo.

            <!--<br><video src="video/LDtOKO.mp4" width="300" height="200" preload="auto" controls></video>-->
          </p>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  Services Section
  ============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Glosario</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Seleccione las distintas secciones del Glosario Interactivo según:</p>
        </div>
      </div>

      <div class="row">
        
        <div class="col-md-4 col-md-offset-2">
          <div class="service-icon"><i class="fa fa-buysellads"></i></div>
          <h4 class="service-title"><a href="">Por orden alfabético</a></h4>        
        </div>
        <div class="col-md-4">
          <div class="service-icon"><i class="fa fa-book"></i></div>
          <h4 class="service-title"><a href="porMateria.php">Por materia</a></h4>
        </div>
      </div>      
    </div>
  </section>

  <!--==========================
  Team Section
  ============================-->
  <section id="team">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Autores</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>

      <div class="row">
          <?php 
          $autores = getAutores(); 
         
         foreach ($autores as $autor)
          {
         
             
            echo "<div class='col-md-3'>";
            echo "<div class='member'>";
            echo "<div class='pic'><img src=".$autor['IMAGEN']." alt=''></div>";
            echo "<h4>". $autor['NOMBRE']."</h4>";
            echo "<span>".$autor['CARGO']."</span>";
            echo "    <div class='social'>
              <a href=''><i class='fa fa-twitter'></i></a>
              <a href=''><i class='fa fa-facebook'></i></a>
              <a href=''><i class='fa fa-google-plus'></i></a>
              <a href=''><i class='fa fa-linkedin'></i></a>
                </div>
                </div>
                </div>";
          }
          
          
          ?>
       

        <!--div class="col-md-3">
          <div class="member">
            <div class="pic"><img src="img/sara.jpg" alt=""></div>
            <h4>Sara Sepúlveda Orejuela</h4>
            <span>Graduada en Relaciones Laborales y Recursos Humanos</span>
            <div class="social">
              <a href="https://twitter.com/sara_seor?lang=es"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/sara.sepulvedaorejuela"><i class="fa fa-facebook"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="member">
            <div class="pic"><img src="img/team-3.jpg" alt=""></div>
            <h4>William Anderson</h4>
            <span>CTO</span>
            <div class="social">
              <a href=""><i class="fa fa-twitter"></i></a>
              <a href=""><i class="fa fa-facebook"></i></a>
              <a href=""><i class="fa fa-google-plus"></i></a>
              <a href=""><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="member">
            <div class="pic"><img src="img/team-4.jpg" alt=""></div>
            <h4>Amanda Jepson</h4>
            <span>Accountant</span>
            <div class="social">
              <a href=""><i class="fa fa-twitter"></i></a>
              <a href=""><i class="fa fa-facebook"></i></a>
              <a href=""><i class="fa fa-google-plus"></i></a>
              <a href=""><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
        </div-->

      </div>
    </div>
  </section>

  <!--==========================
  Contact Section
  ============================-->
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contacto</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Puede ponerse en contacto con nuestro departamento rellenando los siguientes campos: </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-md-push-2">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Colonia de San José, 4, bajo derecha<br>Campus de Rabanales, Córdoba</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>prevencion@uco.es</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>(+34) 957 21 2259 / 8137 / 8064</p>
            </div>

          </div>
        </div>

        <div class="col-md-5 col-md-push-2">
          <div class="form">
            <div id="sendmessage">Tu mensaje ha sido enviado. !Gracias!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor, introduzca un mínimo 4 caracteres." />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" data-rule="email" data-msg="Por favor, introduzca un correo válido." />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Por favor, introduzca como mínimo 8 caracteres." />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor, escriba algo." placeholder="Escriba aquí su mensaje"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!--==========================
  Footer
============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            &copy; Copyright <strong>Universidad de Córdoba</strong>. Realizado por Ismael Ávila Ojeda
          </div>
          <div class="credits">
            <img src="img/logoUco.png" alt="" title="" width="40" height="30"/></img></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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


</body>

</html>